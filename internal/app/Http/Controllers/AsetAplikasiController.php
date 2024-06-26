<?php

namespace App\Http\Controllers;

use App\Models\Aset_aplikasi;
use App\Http\Requests\StoreAset_aplikasiRequest;
use App\Http\Requests\UpdateAset_aplikasiRequest;
use App\Models\Jenis_kategori;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class AsetAplikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createForm()
    {
        $jenisKategoriList = Jenis_kategori::all();
        return view('insiden-dan-aset-aplikasi.menambahkan-aset-aplikasi-uc-1', compact('jenisKategoriList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAset_aplikasiRequest $request)
    {
        $request->validate([
            'nama_aset_aplikasi' => 'required|string|max:255',
            'aa_id_jenis_kategori_foreign' => 'required|exists:jenis_kategoris,id_jenis_kategori',
            'ip_aset_aplikasi' => 'nullable|string',
            'server_aset_aplikasi' => 'nullable|string',
            'indeks_kami_aset_aplikasi' => 'nullable|string',
        ]);

        // Simpan data ke dalam database

        $aset_aplikasi = new Aset_aplikasi;
        $aset_aplikasi->nama_aset_aplikasi = $request->nama_aset_aplikasi;
        $aset_aplikasi->aa_id_jenis_kategori_foreign = $request->aa_id_jenis_kategori_foreign;
        $aset_aplikasi->ip_aset_aplikasi = $request->ip_aset_aplikasi;
        $aset_aplikasi->server_aset_aplikasi = $request->server_aset_aplikasi;
        $aset_aplikasi->indeks_kami_aset_aplikasi = $request->indeks_kami_aset_aplikasi;

        $aset_aplikasi->save();

        // Redirect dengan message jika berhasil
        return redirect('/menambahkan_aset_aplikasi')->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function daftarAsetAplikasi()
    {
        $aset_aplikasis = Aset_aplikasi::paginate(5);
        return view('insiden-dan-aset-aplikasi.daftar-aset-aplikasi-uc-1', ['aset_aplikasis' => $aset_aplikasis]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editForm($id)
    {
        $jenisKategoriList = Jenis_kategori::all();
        $aset_aplikasi = Aset_aplikasi::findOrFail($id);
        return view('insiden-dan-aset-aplikasi.daftar-aset-aplikasi-edit-uc-1',compact('aset_aplikasi','jenisKategoriList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAset_aplikasiRequest $request, $id)
    {
        $validatedData = $request->validate([
            'nama_aset_aplikasi' => 'required|string|max:255',
            'aa_id_jenis_kategori_foreign' => 'required|exists:jenis_kategoris,id_jenis_kategori',
            'ip_aset_aplikasi' => 'nullable|string',
            'server_aset_aplikasi' => 'nullable|string',
            'indeks_kami_aset_aplikasi' => 'nullable|string',
        ]);
        // Perbarui data di database
        $aset_aplikasi = Aset_aplikasi::find($id);
        $aset_aplikasi->nama_aset_aplikasi = $request->nama_aset_aplikasi;
        $aset_aplikasi->aa_id_jenis_kategori_foreign = $request->aa_id_jenis_kategori_foreign;
        $aset_aplikasi->ip_aset_aplikasi = $request->ip_aset_aplikasi;
        $aset_aplikasi->server_aset_aplikasi = $request->server_aset_aplikasi;
        $aset_aplikasi->indeks_kami_aset_aplikasi = $request->indeks_kami_aset_aplikasi;
        $aset_aplikasi->save();

        return redirect('/daftar_aset_aplikasi')->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $data = Aset_aplikasi::find($id);
        $data->delete();

        return redirect('/daftar_aset_aplikasi')->with('success', 'Data berhasil dihapus secara lunak.');
    }

    public function export(){

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $data = Aset_aplikasi::with(['jenis_kategoris'])->get();


        // Add header row
        $headers = ['id_aset_aplikasi', 'nama_kategori_aset_aplikasi', 'nama_aset_aplikasi','ip_aset_aplikasi','server_aset_aplikasi','indeks_kami_aset_aplikasi','created_at','updated_at'];
        $columnLetter = 'A';
        foreach ($headers as $header) {
            $sheet->setCellValue($columnLetter . '1', $header);
            $columnLetter++;
        }


        $rowNumber = 2;
        foreach ($data as $row) {
            $sheet->setCellValue('A' . $rowNumber, $row->id_aset_aplikasi);
            $sheet->setCellValue('B' . $rowNumber, $row->jenis_kategoris ? $row->jenis_kategoris->nama_jenis_kategori : 'Data Tidak Ditemukan');
            $sheet->setCellValue('C' . $rowNumber, $row->nama_aset_aplikasi);
            $sheet->setCellValue('D' . $rowNumber, $row->ip_aset_aplikasi);
            $sheet->setCellValue('E' . $rowNumber, $row->server_aset_aplikasi);
            $sheet->setCellValue('F' . $rowNumber, $row->indeks_kami_aset_aplikasi);
            $sheet->setCellValue('G' . $rowNumber, $row->created_at);
            $sheet->setCellValue('H' . $rowNumber, $row->updated_at);

            $rowNumber++;
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'aset-aplikasi.xlsx';
        $temp_file = tempnam(sys_get_temp_dir(), $fileName);
        $writer->save($temp_file);

        return response()->download($temp_file, $fileName)->deleteFileAfterSend(true);
    }
}
