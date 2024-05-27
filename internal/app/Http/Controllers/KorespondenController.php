<?php

namespace App\Http\Controllers;

use App\Models\Koresponden;
use App\Models\Email;
use App\Models\mengirim;
use App\Http\Requests\StoreKorespondenRequest;
use App\Http\Requests\UpdateKorespondenRequest;
use Exception;

class KorespondenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('berita.koresponden-create');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(StoreKorespondenRequest $request)
    {

        // Validasi
        $request->validate([
            'nama_koresponden' => 'required|unique:korespondens,nama_koresponden',
            'email' => 'required',
            'tipe_email' => 'required',

        ]);

        // Menyimpan data ke tabel Koresponden
        $koresponden = new Koresponden();
        $koresponden->nama_koresponden = $request->input('nama_koresponden');
        $koresponden->save();

        // Menyimpan data ke tabel Email dengan menghubungkannya ke Koresponden
        foreach ($request->email as $key => $email) {
            $emailModel = new Email();
            $emailModel->id_koresponden = $koresponden->id;
            $emailModel->nama_email = $email;
            $emailModel->tipe_email = $request->tipe_email[$key]; // Memastikan tipe email sesuai dengan indeks email yang sesuai
            $emailModel->save();
        }
        
       
        return redirect('/form-koresponden');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKorespondenRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Koresponden $koresponden)
    {
        $korespondens = Koresponden::with('emails')->get();

        
        return view('berita.form-berita-koresponden', compact('korespondens'));
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Koresponden $koresponden, $id_koresponden)
    {
        $koresponden = Koresponden::findOrFail($id_koresponden);

        return view('berita.koresponden-edit', compact('koresponden'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKorespondenRequest $request, Koresponden $koresponden, $id_koresponden)
    {
        // Validasi
        $request->validate([
            'nama_koresponden' => 'required|unique:korespondens,nama_koresponden',
            'email' => 'required',
            'tipe_email' => 'required',

        ]);
        
        
       // Mengambil data koresponden berdasarkan ID yang diberikan
        $koresponden = Koresponden::findOrFail($id_koresponden);

        
        // Memperbarui data koresponden
        $koresponden->nama_koresponden = $request->input('nama_koresponden');
        $koresponden->save();

        try {
            // Get data
            $existingEmails = $koresponden->emails;
            $receivedEmailIds = [];

            $KorId = $id_koresponden;
            $emails = $request->input('email');
            $tipe_emails = $request->input('tipe_email');
            $email_ids = $request->input('email_id');
        
            // Loop melalui setiap email yang dikirim dari formulir
            foreach ($emails as $index => $email) {
                // Periksa apakah ada ID email yang terkait
                if (isset($email_ids[$index])) {
                    // Jika ada, lakukan pembaruan entri email
                    $emailModel = Email::findOrFail($email_ids[$index]);
                    $emailModel->id_koresponden = $KorId;
                    $emailModel->nama_email = $email;
                    $emailModel->tipe_email = $tipe_emails[$index];
                    $emailModel->save();

                    // Tambahkan email ID ke array receivedEmailIds
                    $receivedEmailIds[] = $email_ids[$index];
                } else {
                    // Jika tidak, buat entri email baru
                    $emailModel = new Email();
                    $emailModel->id_koresponden = $KorId;
                    $emailModel->nama_email = $email;
                    $emailModel->tipe_email = $tipe_emails[$index];
                    $emailModel->save();

                    // Tambahkan email ID baru yang dibuat ke array receivedEmailIds
                    $receivedEmailIds[] = $emailModel->id;
                }
            }

            // Hapus email yang tidak ada dalam daftar receivedEmailIds
            foreach ($existingEmails as $existingEmail) {
                if (!in_array($existingEmail->id, $receivedEmailIds)) {
                    $existingEmail->delete();
                }
            }

            // Redirect atau kembalikan respons sesuai kebutuhan
            return redirect()->route('koresponden.show');
        
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }


    public function delete($id_koresponden)
    {
        // Periksa apakah koresponden digunakan di tabel lain
        $isUsedInMengirim = Mengirim::whereIn('id_email', function($query) use ($id_koresponden) {
            $query->select('id')->from('emails')->where('id_koresponden', $id_koresponden);
        })->exists();

        // Jika ada record terkait di tabel lain, kembalikan respons JSON dengan pesan error
        if ($isUsedInMengirim) {
            return response()->json(['status' => 'error', 'message' => 'Koresponden tidak dapat dihapus karena telah digunakan di tabel lain.']);
        }

        // Jika tidak ada, kembalikan respons JSON dengan status success
        return response()->json(['status' => 'success']);

    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Koresponden $koresponden,  $id_koresponden)
    {
        Email::where('id_koresponden', $id_koresponden)->delete();
    
        // Kemudian soft delete koresponden itu sendiri
        $data = Koresponden::find($id_koresponden);
        $data->delete();

        return redirect('/form-koresponden');
    }
}
