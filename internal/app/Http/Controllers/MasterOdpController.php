<?php

namespace App\Http\Controllers;

use App\Models\Master_odp;
use App\Http\Requests\StoreMaster_odpRequest;
use App\Http\Requests\UpdateMaster_odpRequest;

class MasterOdpController extends Controller
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
        return view('insiden-dan-aset-aplikasi.menambahkan-data-master-uc-1');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMaster_odpRequest $request)
    {
        $request->validate([
            'nama_instansi' => 'required|string|max:255',
        ]);

        // Simpan data ke dalam database
        Master_odp::create([
            'nama_instansi' => $request->nama_instansi,
        ]);

        // Redirect dengan message jika berhasil
        return redirect('/data_master/menambahkan_data_master')->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function daftarMasterOPD()
    {
        $master_odps = Master_odp::paginate(5);
        return view('insiden-dan-aset-aplikasi.daftar-data-master-uc-1', ['master_odps' => $master_odps]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editForm($id)
    {
        $master_odp = Master_odp::findOrFail($id);
        return view('insiden-dan-aset-aplikasi.daftar-data-master-edit-uc-1',compact('master_odp'));
    }


    public function edit(Master_odp $master_odp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMaster_odpRequest $request, $id)
    {
        $validatedData = $request->validate([
            'nama_instansi' => 'required|max:255',
        ]);

        // Perbarui data di database
        $master_odp = Master_odp::find($id);
        $master_odp->nama_instansi = $request->nama_instansi;
        $master_odp->save();

        return redirect('/data_master')->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete()
    {

    }
}
