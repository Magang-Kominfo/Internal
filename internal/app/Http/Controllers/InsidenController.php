<?php

namespace App\Http\Controllers;

use App\Models\Insiden;
use App\Http\Requests\StoreInsidenRequest;
use App\Http\Requests\UpdateInsidenRequest;
use App\Models\Jenis_insiden;
use App\Models\Master_odp;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class InsidenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function viewProsesInsiden($id)
    {
        $insiden = Insiden::findOrFail($id);
        return view('insiden-dan-aset-aplikasi.view-proses-insiden-uc-1', ['insiden' => $insiden]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createForm()
    {
        $masterOdpList = Master_odp::all();
        $jenisInsidenList = Jenis_insiden::all();
        return view('insiden-dan-aset-aplikasi.menambahkan-proses-insiden-uc-1', compact('masterOdpList','jenisInsidenList'));

    }

    public function daftarProsesInsiden()
    {
        $insidens = Insiden::paginate(5);
        return view('insiden-dan-aset-aplikasi.daftar-proses-insiden-uc-1', ['insidens' => $insidens]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInsidenRequest $request)
    {
        $request->validate([
            'insidens_odp_id_foreign' => 'required|exists:master_odps,odp_id',
            'insidens_id_jenis_insiden_foreign' => 'required|exists:jenis_insidens,id_jenis_insiden',
            'url_insiden' => 'nullable|string',
            'nomor_surat_tte_insiden' => 'nullable|string',
            'tanggal_insiden_diselesaikan' => 'nullable|date',
            'status_insiden' => 'nullable|string',
            'resiko_insiden' => 'nullable|string',
            'tanggal_notifikasi_insiden' => 'nullable|date',
            'jam_temuan_insiden' => 'nullable|date_format:H:i',
            'tanggal_suspend_insiden' => 'nullable|date',
            'tanggal_pemulihan_insiden' => 'nullable|date',
            'status_setelah_unsuspend_insiden' => 'nullable|string',
            'jam_temuan_dikirim_insiden' => 'nullable|date_format:H:i',
            'jam_insiden_diselesaikan' => 'nullable|date_format:H:i',
            'keterangan_insiden' => 'nullable|string',
        ]);

        // Simpan data ke dalam database
        $insiden = new Insiden;
        $insiden->insidens_odp_id_foreign = $request->insidens_odp_id_foreign;
        $insiden->insidens_id_jenis_insiden_foreign = $request->insidens_id_jenis_insiden_foreign;
        $insiden->resiko_insiden = $request->resiko_insiden;
        $insiden->status_insiden = $request->status_insiden;
        $insiden->status_setelah_unsuspend_insiden = $request->status_setelah_unsuspend_insiden;
        $insiden->url_insiden = $request->url_insiden;
        $insiden->nomor_surat_tte_insiden = $request->nomor_surat_tte_insiden;
        $insiden->keterangan_insiden = $request->keterangan_insiden;
        $insiden->tanggal_surat_tte_insiden = $request->tanggal_surat_tte_insiden;
        $insiden->tanggal_suspend_insiden = $request->tanggal_suspend_insiden;
        $insiden->tanggal_pemulihan_insiden = $request->tanggal_pemulihan_insiden;
        $insiden->jam_insiden_diselesaikan = $request->jam_insiden_diselesaikan ? date('H:i', strtotime($request->jam_insiden_diselesaikan)) : null;
        $insiden->tanggal_notifikasi_insiden = $request->tanggal_notifikasi_insiden;
        $insiden->jam_temuan_insiden = $request->jam_temuan_insiden ? date('H:i', strtotime($request->jam_temuan_insiden)) : null;
        $insiden->tanggal_insiden_diselesaikan = $request->tanggal_insiden_diselesaikan;
        $insiden->jam_temuan_dikirim_insiden = $request->jam_temuan_dikirim_insiden ? date('H:i', strtotime($request->jam_temuan_dikirim_insiden)) : null;

        $insiden->save();


        // Redirect dengan message jika berhasil
        return redirect('/daftar_proses_insiden')->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Insiden $insiden)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editForm($id)
    {
        $masterOdpList = Master_odp::all();
        $jenisInsidenList = Jenis_insiden::all();
        $insiden = Insiden::findOrFail($id);
        return view('insiden-dan-aset-aplikasi.daftar-proses-insiden-edit-uc-1',compact('insiden','masterOdpList','jenisInsidenList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInsidenRequest $request, $id)
    {
        $validatedData = $request->validate([
            'insidens_odp_id_foreign' => 'required|exists:master_odps,odp_id',
            'insidens_id_jenis_insiden_foreign' => 'required|exists:jenis_insidens,id_jenis_insiden',
            'url_insiden' => 'nullable|string',
            'nomor_surat_tte_insiden' => 'nullable|string',
            'tanggal_insiden_diselesaikan' => 'nullable|date',
            'status_insiden' => 'nullable|string',
            'resiko_insiden' => 'nullable|string',
            'tanggal_notifikasi_insiden' => 'nullable|date',
            'jam_temuan_insiden' => 'nullable|date_format:H:i',
            'tanggal_suspend_insiden' => 'nullable|date',
            'tanggal_surat_tte_insiden' => 'nullable|date',
            'tanggal_pemulihan_insiden' => 'nullable|date',
            'status_setelah_unsuspend_insiden' => 'nullable|string',
            'jam_temuan_dikirim_insiden' => 'nullable|date_format:H:i',
            'jam_insiden_diselesaikan' => 'nullable|date_format:H:i',
            'keterangan_insiden' => 'nullable|string',
        ]);

        // Perbarui data di database
        $insiden = Insiden::find($id);
        $insiden->insidens_odp_id_foreign = $request->insidens_odp_id_foreign;
        $insiden->insidens_id_jenis_insiden_foreign = $request->insidens_id_jenis_insiden_foreign;
        $insiden->url_insiden = $request->url_insiden;
        $insiden->nomor_surat_tte_insiden = $request->nomor_surat_tte_insiden;
        $insiden->tanggal_insiden_diselesaikan = $request->tanggal_insiden_diselesaikan;
        $insiden->resiko_insiden = $request->resiko_insiden;
        $insiden->status_insiden = $request->status_insiden;
        $insiden->tanggal_notifikasi_insiden = $request->tanggal_notifikasi_insiden;
        $insiden->jam_temuan_insiden = $request->jam_temuan_insiden ? date('H:i', strtotime($request->jam_temuan_insiden)) : null;
        $insiden->status_setelah_unsuspend_insiden = $request->status_setelah_unsuspend_insiden;
        $insiden->tanggal_suspend_insiden = $request->tanggal_suspend_insiden;
        $insiden->tanggal_pemulihan_insiden = $request->tanggal_pemulihan_insiden;
        $insiden->jam_temuan_dikirim_insiden = $request->jam_temuan_dikirim_insiden ? date('H:i', strtotime($request->jam_temuan_dikirim_insiden)) : null;
        $insiden->jam_insiden_diselesaikan = $request->jam_insiden_diselesaikan ? date('H:i', strtotime($request->jam_insiden_diselesaikan)) : null;
        $insiden->keterangan_insiden = $request->keterangan_insiden;
        $insiden->tanggal_surat_tte_insiden = $request->tanggal_surat_tte_insiden;

        $insiden->save();

        return redirect('/daftar_proses_insiden')->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $data = Insiden::find($id);
        $data->delete();

        return redirect('/daftar_proses_insiden')->with('success', 'Data berhasil dihapus');
    }


    public function export(){
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $data = Insiden::with(['master_odps', 'jenis_insidens'])->get();


        // Add header row
        $headers = ['insiden_id', 'nama_instansi', 'nama_jenis_insiden','resiko_insiden','status_insiden','status_setelah_unsuspend_insiden','url_insiden','nomor_surat_tte_insiden','keterangan_insiden','tanggal_surat_tte_insiden','tanggal_suspend_insiden','tanggal_pemulihan_insiden','jam_insiden_diselesaikan','tanggal_insiden_diselesaikan','tanggal_notifikasi_insiden','jam_temuan_insiden','jam_temuan_dikirim_insiden','created_at','updated_at'];
        $columnLetter = 'A';
        foreach ($headers as $header) {
            $sheet->setCellValue($columnLetter . '1', $header);
            $columnLetter++;
        }


        $rowNumber = 2;
        foreach ($data as $row) {
            $sheet->setCellValue('A' . $rowNumber, $row->insiden_id);
            $sheet->setCellValue('B' . $rowNumber, $row->master_odps ? $row->master_odps->nama_instansi : 'Data Tidak Ditemukan');
            $sheet->setCellValue('C' . $rowNumber, $row->jenis_insidens ? $row->jenis_insidens->nama_insiden : 'Data Tidak Ditemukan');
            $sheet->setCellValue('D' . $rowNumber, $row->resiko_insiden);
            $sheet->setCellValue('E' . $rowNumber, $row->status_insiden);
            $sheet->setCellValue('F' . $rowNumber, $row->status_setelah_unsuspend_insiden);
            $sheet->setCellValue('G' . $rowNumber, $row->url_insiden);
            $sheet->setCellValue('H' . $rowNumber, $row->nomor_surat_tte_insiden);
            $sheet->setCellValue('I' . $rowNumber, $row->keterangan_insiden);
            $sheet->setCellValue('J' . $rowNumber, $row->tanggal_surat_tte_insiden);
            $sheet->setCellValue('K' . $rowNumber, $row->tanggal_suspend_insiden);
            $sheet->setCellValue('L' . $rowNumber, $row->tanggal_pemulihan_insiden);
            $sheet->setCellValue('M' . $rowNumber, $row->jam_insiden_diselesaikan);
            $sheet->setCellValue('N' . $rowNumber, $row->tanggal_insiden_diselesaikan);
            $sheet->setCellValue('O' . $rowNumber, $row->tanggal_notifikasi_insiden);
            $sheet->setCellValue('P' . $rowNumber, $row->jam_temuan_insiden);
            $sheet->setCellValue('Q' . $rowNumber, $row->jam_temuan_dikirim_insiden);
            $sheet->setCellValue('R' . $rowNumber, $row->created_at);
            $sheet->setCellValue('S' . $rowNumber, $row->updated_at);

            $rowNumber++;
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'insiden.xlsx';
        $temp_file = tempnam(sys_get_temp_dir(), $fileName);
        $writer->save($temp_file);

        return response()->download($temp_file, $fileName)->deleteFileAfterSend(true);
    }
}
