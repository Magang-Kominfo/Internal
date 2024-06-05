<?php

namespace App\Http\Controllers;


use App\Models\Sifat;
use App\Models\AlurSurat;
use App\Models\Email;
use App\Models\Berita;
use App\Models\Mengirim;
use App\Http\Requests\StoreBeritaRequest;
use App\Http\Requests\UpdateBeritaRequest;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Exception;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
    $user = Auth::user();
    // Ambil data dari model Sifat
    $sifats = Sifat::all();

    // Ambil data dari model AlurSurat
    $alursurats = AlurSurat::all();

    $beritas = Berita::all();

    // Ambil data dari model email
    $emails = Email::select('emails.*', 'korespondens.nama_koresponden')
    ->join('korespondens', 'emails.id_koresponden', '=', 'korespondens.id')
    ->get();;

    // Gabungkan set data menjadi satu
    $data = [
        'sifats' => $sifats,
        'alursurats' => $alursurats,
        'beritas' => $beritas,
        'emails' => $emails,
    ];

    // Kembalikan tampilan dengan data yang digabungkan
    return view('berita.form-berita-create', ['data' => $data],compact('user'));
}

public function showedit($id_berita)
{
    $user = Auth::user();
    // Ambil data dari model Sifat
    $sifats = Sifat::all();

    // Ambil data dari model AlurSurat
    $alursurats = AlurSurat::all();

    $berita = Berita::find($id_berita);

    // Ambil data dari model email
    $emails = Email::select('emails.*', 'korespondens.nama_koresponden')
    ->join('korespondens', 'emails.id_koresponden', '=', 'korespondens.id')
    ->get();;

    // Gabungkan set data menjadi satu
    $edit = [
        'sifats' => $sifats,
        'alursurats' => $alursurats,
        'berita' => $berita,
        'emails' => $emails,
    ];
    // dd( $edit['berita']->id);

    // Kembalikan tampilan dengan data yang digabungkan
    return view('berita.form-berita-edit', ['edit' => $edit],compact('user'));

}


    public function showNews() {
        $user = Auth::user();
        $beritas = Berita::all(); 
        return view('berita.dashboard', ['beritas' => $beritas],compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create(StoreBeritaRequest $request)
    {

        // Validate the incoming request data
        $request->validate([
            'no_agenda' => 'required',
            'id_sifat' => 'required',
            'id_alur_surat' => 'required',
            'no_berita' => 'required',
            'jumlah_halaman_berita' => 'required|integer',
            'tanggal_buat_berita' => 'required|date',
            'isi_berita' => 'required',
            'dokumen_surat_berita' => 'nullable|mimes:doc,docx,pdf',
        ]);

        $now = Carbon::now();

        if ($request->hasFile('dokumen_surat_berita')) {
            $dokumen = $request->file('dokumen_surat_berita');
            $nama_dokumen = 'Berita'.date('Ymdhis').'.'.$dokumen->getClientOriginalExtension();
            $dokumen->move('dokumen/', $nama_dokumen);

        } else {
            $nama_dokumen = null;
        }



        // simpan database
        $berita = Berita::create([
            'no_agenda' => $request->no_agenda,
            'id_sifat' => $request->id_sifat,
            'id_alur_surat' => $request->id_alur_surat,
            'no_berita' =>  $request->no_berita,
            'jumlah_halaman_berita' => $request->jumlah_halaman_berita,
            'tanggal_buat_berita' =>  $request->tanggal_buat_berita,
            'isi_berita' => $request->isi_berita,
            'dokumen_surat_berita' =>  $nama_dokumen,
        ]);

        try {
            // Get data
            $beritaId = $berita->id; // Ambil ID berita yang baru saja disimpan
            $emailIds = $request->emailpenerima_id; // Ambil ID koresponden yang dipilih

            $insertData = [];

            // Tambahkan data penerima dengan role 1 ke dalam array
            for ($i = 0; $i < count($emailIds); $i++) {
                $insertData[] = [
                    'id_berita' => $beritaId,
                    'id_email' => $emailIds[$i],
                    'role' => 1,// Role 1 untuk penerima
                    'respon_time' => null,
                    'tanggal_kirim_berita' => null,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }

            $pengirimId = $request->emailpengirim_id; // Ambil ID koresponden pengirim

            // Tambahkan data pengirim dengan role 0 ke dalam array
            $insertData[] = [
                'id_berita' => $beritaId,
                'id_email' => $pengirimId,
                'role' => 0, // Role 0 untuk pengirim
                'respon_time' => null,
                'tanggal_kirim_berita' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ];


            // Simpan semua data ke dalam tabel Mengirim
            Mengirim::insertOrIgnore($insertData);

            // Return JSON response
            return response()->json(['status' => true, 'message' => 'Berita berhasil ditambahkan.', 'beritaId' => $berita->id]);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }


    }


    /**
     * Display the specified resource.
     */
    public function show($id){
        $user = Auth::user();
        $berita = Berita::find($id);

        return view('berita.detail-berita', compact('berita','user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Berita $berita)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBeritaRequest $request, $id_berita)
    {
        // Validate the incoming request data
        $request->validate([
            'no_agenda' => 'required',
            'id_sifat' => 'required',
            'id_alur_surat' => 'required',
            'no_berita' => 'required',
            'jumlah_halaman_berita' => 'required|integer',
            'tanggal_buat_berita' => 'required|date',
            'isi_berita' => 'required',
            'dokumen_surat_berita' => 'nullable|mimes:doc,docx,pdf',
        ]);

        $now = Carbon::now();

        // Ambil berita berdasarkan ID
        $berita = Berita::findOrFail($id_berita);

        // Tentukan nama dokumen
        $nama_dokumen = $berita->dokumen_surat_berita;

        if ($request->hasFile('dokumen_surat_berita')) {
            $dokumen = $request->file('dokumen_surat_berita');
            $nama_dokumen = 'Berita' . date('Ymdhis') . '.' . $dokumen->getClientOriginalExtension();
            $dokumen->move('dokumen/', $nama_dokumen);

        }

        // Update data berita
        $berita->update([
            'no_agenda' => $request->no_agenda,
            'id_sifat' => $request->id_sifat,
            'id_alur_surat' => $request->id_alur_surat,
            'no_berita' =>  $request->no_berita,
            'jumlah_halaman_berita' => $request->jumlah_halaman_berita,
            'tanggal_buat_berita' =>  $request->tanggal_buat_berita,
            'isi_berita' => $request->isi_berita,
            'dokumen_surat_berita' =>  $nama_dokumen,
        ]);

        try {
            // Get data
            $beritaId = $berita->id; // Ambil ID berita yang baru saja disimpan
            $emailIds = $request->emailpenerima_id; // Ambil ID koresponden yang dipilih

            $insertData = [];

            // Tambahkan data penerima dengan role 1 ke dalam array
            for ($i = 0; $i < count($emailIds); $i++) {
                $insertData[] = [
                    'id_berita' => $beritaId,
                    'id_email' => $emailIds[$i],
                    'role' => 1,// Role 1 untuk penerima
                    'respon_time' => null,
                    'tanggal_kirim_berita' => null,
                    'updated_at' => $now,
                ];
            }

            $pengirimId = $request->emailpengirim_id; // Ambil ID koresponden pengirim

            // Tambahkan data pengirim dengan role 0 ke dalam array
            $insertData[] = [
                'id_berita' => $beritaId,
                'id_email' => $pengirimId,
                'role' => 0, // Role 0 untuk pengirim
                'respon_time' => null,
                'tanggal_kirim_berita' => null,
                'updated_at' => $now,
            ];

            // dd($insertData);

            $existingData = Mengirim::where('id_berita', $beritaId)->get();

            // Loop melalui setiap entri dalam $existingData
            foreach ($existingData as $data) {
                // Periksa apakah entri ini ada dalam array $insertData
                $found = false;
                foreach ($insertData as $newData) {
                    if ($newData['id_email'] == $data['id_email']) {
                        $found = true;
                        break;
                    }
                }

                // Jika entri tidak ditemukan dalam $insertData, hapus entri ini dari tabel Mengirim
                if (!$found) {
                    $data->delete();
                }
            }

            foreach ($insertData as $data) {
                // dd($data);
                Mengirim::updateOrCreate(
                    [
                        'id_berita' => $data['id_berita'],
                        'id_email' => $data['id_email'],
                    ],
                    [
                        'id_berita' => $data['id_berita'],
                        'id_email' => $data['id_email'],
                        'role' => $data['role'],
                        'respon_time' => null,
                        'tanggal_kirim_berita' => null,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]
                );


            }

            return response()->json(['status' => true, 'message' => 'Berita berhasil ditambahkan.', 'beritaId' => $berita->id]);

        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }


    }

    /**
     * Remove the specified resource from storage.
     */

    public function delete($id_berita)
    {
        Mengirim::where('id_berita', $id_berita)->delete();

        $data = Berita::find($id_berita);
        $data->delete();

        return redirect('/dashboard-berita')->with('success', 'Data berhasil dihapus secara lunak.');
    }

    
    public function export(){
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $data = Berita::all();
        
        // Add header row
        $headers = ['ID Berita', 'Nomor Surat Berita', 'Nomor Agenda','Sifat Berita','Jenis Surat',
                    'Jumlah Halaman Berita','Tanggal Buat Berita','Isi Berita',
                    'Dokumen Surat Berita','Pengirim Berita', 'Penerima Berita',
                    'created_at','updated_at','deleted_at'];

        $columnLetter = 'A';
        foreach ($headers as $header) {
            $sheet->setCellValue($columnLetter . '1', $header);
            $columnLetter++;
        }


        $rowNumber = 2;
        foreach ($data as $row) {
            $sheet->setCellValue('A' . $rowNumber, $row->id);
            $sheet->setCellValue('B' . $rowNumber, $row->no_berita);
            $sheet->setCellValue('C' . $rowNumber, $row->no_agenda);
            $sheet->setCellValue('D' . $rowNumber, $row->sifat->nama_sifat);
            $sheet->setCellValue('E' . $rowNumber, $row->alursurat->nama_alur_surat);
            $sheet->setCellValue('F' . $rowNumber, $row->jumlah_halaman_berita);
            $sheet->setCellValue('G' . $rowNumber, $row->tanggal_buat_berita);
            $sheet->setCellValue('H' . $rowNumber, $row->isi_berita);
            $sheet->setCellValue('I' . $rowNumber, $row->dokumen_surat_berita ?? "Tidak ada dokumen");

            $KorespondenPengirim = null;
            $KorespondenPenerimaList = [];

            foreach ($row->mengirims as $mengirim) {
                if ($mengirim->role === 1) {
                    $KorespondenPenerimaList[] = $mengirim->email->koresponden->nama_koresponden;
                } else {
                    if ($mengirim->role === 0) {
                        $KorespondenPengirim = $mengirim->email->koresponden->nama_koresponden;
                    }
                }
            }
            $PenerimaString = implode(', ', $KorespondenPenerimaList);

            $sheet->setCellValue('J' . $rowNumber, $KorespondenPengirim);
            $sheet->setCellValue('K' . $rowNumber, $PenerimaString);
            $sheet->setCellValue('L' . $rowNumber, $row->created_at);
            $sheet->setCellValue('M' . $rowNumber, $row->updated_at);
            $sheet->setCellValue('N' . $rowNumber, $row->deleted_at);

            $rowNumber++;
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'Data Master Berita.xlsx';
        $temp_file = tempnam(sys_get_temp_dir(), $fileName);
        $writer->save($temp_file);

        return response()->download($temp_file, $fileName)->deleteFileAfterSend(true);
    }


    public function destroy(Berita $berita)
    {
        //
    }
}
