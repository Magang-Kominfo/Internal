<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use App\Http\Requests\StoreAsetRequest;
use App\Http\Requests\UpdateAsetRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class AsetController extends Controller
{
    protected $aset;
    public function __construct(){
        $this->aset = new Aset();

    }

    public function index()
    {
        $user = Auth::user();
        $aset =Aset::all();

        return view('aset-persandian.dbaset-uc-3', compact('aset','user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create(Request $request)
    {
        // dd($request);
        $formFields = $request->validate([
            'nomor_aset' => ['required', 'numeric'],
            'nama' => 'required',
            'jumlah' => ['required', 'numeric'],
            'pemanfaatan' => 'required',
            'kondisi' => 'required',

        ]);
        // dd($request->file('images'));
        // if ($request->file('images')) {
            for ($i = 0; $i < count($request->file('images')); $i++) {
                $formFields['images'][$i] =  $request->file('images')[$i]->storeOnCloudinary('magangpkl')->getSecurePath();
            }
        // }

        $aset = Aset::create($formFields);
        $aset->save();
        // public/images/...png

        return redirect("/dbaset/");
    }

    /**
     * Display the specified resource.
     */
    public function show(Aset $aset,Request $request)
    {
        return view('aset-persandian.show-uc-3', [
            'aset' => $aset
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $aset =Aset::find($id);

        return view('aset-persandian.editaset-uc-3', compact('aset'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $aset =Aset::find($id);

        $formFields=$request->all();

        for ($i = 0; $i < count($request->file('images')); $i++) {
            $formFields['images'][$i] =  $request->file('images')[$i]->storeOnCloudinary('magangpkl')->getSecurePath();
        }

        $aset->update($formFields);

        return view('aset-persandian.show-uc-3', [
            'aset' => $aset
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $aset = Aset::findOrFail($id);
        $aset->delete();
        return redirect('/dbaset');
    }

    public function export(){
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $data = aset::all();


        // Add header row
        $headers = ['id', 'nomor_aset', 'nama','jumlah','pemanfaatan','kondisi','created_at','updated_at'];
        $columnLetter = 'A';
        foreach ($headers as $header) {
            $sheet->setCellValue($columnLetter . '1', $header);
            $columnLetter++;
        }


        $rowNumber = 2;
        foreach ($data as $row) {
            $sheet->setCellValue('A' . $rowNumber, $row->id);
            $sheet->setCellValue('B' . $rowNumber, $row->nomor_aset);
            $sheet->setCellValue('C' . $rowNumber, $row->nama);
            $sheet->setCellValue('D' . $rowNumber, $row->jumlah);
            $sheet->setCellValue('E' . $rowNumber, $row->pemanfaatan);
            $sheet->setCellValue('F' . $rowNumber, $row->kondisi);
            $sheet->setCellValue('G' . $rowNumber, $row->created_at);
            $sheet->setCellValue('H' . $rowNumber, $row->updated_at);
            $rowNumber++;
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'aset.xlsx';
        $temp_file = tempnam(sys_get_temp_dir(), $fileName);
        $writer->save($temp_file);

        return response()->download($temp_file, $fileName)->deleteFileAfterSend(true);
    }
}
