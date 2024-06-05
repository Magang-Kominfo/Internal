<?php

namespace App\Http\Controllers;

use App\Models\Email;
use App\Models\Mengirim;
use App\Http\Requests\StoreEmailRequest;
use App\Http\Requests\UpdateEmailRequest;
use Illuminate\Support\Facades\Auth;
class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(StoreEmailRequest $request)
    {
        $query = $request->get('q');
        $EmailOption = Email::with('koresponden')
                        ->where('nama_email', 'like', "%$query%")
                        ->orWhereHas('koresponden', function ($queryBuilder) use ($query) {
                            $queryBuilder->where('nama_koresponden', 'like', "%$query%");
                        })
                        ->get();

        return response()->json($EmailOption);
        // dd($EmailOption);
    }

    public function show(StoreEmailRequest $request, $beritaId)
    {

        if (!$beritaId) {
            return response()->json(['error' => 'ID berita diperlukan'], 400);
        }

        // Ambil semua data email default berdasarkan ID berita
        // Menggunakan Eloquent untuk mengambil data yang berelasi
        $mengirims = Mengirim::where('id_berita', $beritaId)
            ->with('email.koresponden')
            ->get();

        if ($mengirims->isEmpty()) {
            return response()->json(['error' => 'Email default tidak ditemukan'], 404);
        }

        // Membuat array untuk menyimpan hasil berdasarkan role
        $pengirim = [];
        $penerima = [];

        foreach ($mengirims as $mengirim) {
            $email = $mengirim->email;
            $emailData = [
                'id' => $email->id,
                'email' => $email->nama_email,
                'nama' => $email->koresponden->nama_koresponden,
                'tipe' => $email->tipe_email
            ];


            if ($mengirim->role === 0) {
                $pengirim[] = $emailData;
            } elseif ($mengirim->role === 1) {
                $penerima[] = $emailData;
            }

        }


        return response()->json([
            'pengirim' => $pengirim,
            'penerima' => $penerima
        ]);
    }


    public function getDefault(StoreEmailRequest $request){
        // Validasi ID berita
        $idBerita = $request->input('id');

        if (!$idBerita) {
            return response()->json(['error' => 'ID berita diperlukan'], 400);
        }

        // Ambil semua data email default berdasarkan ID berita
        // Menggunakan Eloquent untuk mengambil data yang berelasi
        $mengirims = Mengirim::where('id_berita', $idBerita)
            ->with('email.koresponden')
            ->get();

        if ($mengirims->isEmpty()) {
            return response()->json(['error' => 'Email default tidak ditemukan'], 404);
        }

        // Membuat array untuk menyimpan hasil berdasarkan role
        $pengirim = [];
        $penerima = [];

        foreach ($mengirims as $mengirim) {
            $email = $mengirim->email;
            $emailData = [
                'id' => $email->id,
                'email' => $email->nama_email,
                'nama' => $email->koresponden->nama_koresponden,
                'tipe' => $email->tipe_email
            ];


            if ($mengirim->role === 0) {
                $pengirim[] = $emailData;
            } elseif ($mengirim->role === 1) {
                $penerima[] = $emailData;
            }

        }


        return response()->json([
            'pengirim' => $pengirim,
            'penerima' => $penerima
        ]);


    }

    public function checkDelete($id_email)
    {
         // Periksa apakah email digunakan di tabel lain
         $isUsedInMengirim = Mengirim::where('id_email', $id_email)->exists();

         // Jika ada record terkait di tabel lain, kembalikan respons JSON dengan pesan error
         if ($isUsedInMengirim) {
             return response()->json(['status' => 'error', 'message' => 'Email tidak dapat dihapus karena telah digunakan di tabel lain.']);
         }
 
         // Jika tidak ada, kembalikan respons JSON dengan status success
         return response()->json(['status' => 'success']);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function delete($id_email)
    {
        // $id_koresponden = Email::where('id', $id_email)->value('id_koresponden');
        // dd( $id_email);

        // // Hapus email
        // Email::where('id', $id_email)->delete();

        // // Lakukan operasi lainnya dengan ID koresponden, jika diperlukan

        // return redirect('/koreponden-edit/'.$id_koresponden);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmailRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Email $email)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmailRequest $request, Email $email)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Email $email)
    {
        //
    }
}
