<?php

namespace App\Http\Controllers;

use App\Models\Aset_aplikasi;
use App\Http\Requests\StoreAset_aplikasiRequest;
use App\Http\Requests\UpdateAset_aplikasiRequest;

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
        return view('menambahkan-aset-aplikasi-uc-1');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAset_aplikasiRequest $request)
    {
        $request->validate([
            'nama_aset_aplikasi' => 'required|string|max:255',
            'kategori_aset_aplikasi' => 'required|string',
            'ip_aset_aplikasi' => 'nullable|string',
            'server_aset_aplikasi' => 'nullable|string',
            'indeks_kami_aset_aplikasi' => 'nullable|string',
        ]);

        // Simpan data ke dalam database
        Aset_aplikasi::create([
            'nama_aset_aplikasi' => $request->nama_aset_aplikasi,
            'kategori_aset_aplikasi' => $request->kategori_aset_aplikasi,
            'ip_aset_aplikasi' => $request->ip_aset_aplikasi,
            'server_aset_aplikasi' => $request->server_aset_aplikasi,
            'indeks_kami_aset_aplikasi' => $request->indeks_kami_aset_aplikasi,
        ]);

        // Redirect dengan message jika berhasil
        return redirect('/menambahkan_aset_aplikasi')->with('alert', 'Aset Aplikasi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function daftarProsesInsiden()
    {
        $aset_aplikasis = Aset_aplikasi::all();
        return view('daftar-aset-aplikasi-uc-1', ['aset_aplikasis' => $aset_aplikasis]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editForm($id)
    {
        $aset_aplikasi = Aset_aplikasi::findOrFail($id);
        return view('daftar-aset-aplikasi-edit-uc-1',compact('aset_aplikasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAset_aplikasiRequest $request, $id)
    {
        $validatedData = $request->validate([
            'nama_aset_aplikasi' => 'required|string|max:255',
            'kategori_aset_aplikasi' => 'required|string',
            'ip_aset_aplikasi' => 'nullable|string',
            'server_aset_aplikasi' => 'nullable|string',
            'indeks_kami_aset_aplikasi' => 'nullable|string',
        ]);
        // Perbarui data di database
        $aset_aplikasi = Aset_aplikasi::find($id);
        $aset_aplikasi->nama_aset_aplikasi = $request->nama_aset_aplikasi;
        $aset_aplikasi->kategori_aset_aplikasi = $request->kategori_aset_aplikasi;
        $aset_aplikasi->ip_aset_aplikasi = $request->ip_aset_aplikasi;
        $aset_aplikasi->server_aset_aplikasi = $request->server_aset_aplikasi;
        $aset_aplikasi->indeks_kami_aset_aplikasi = $request->indeks_kami_aset_aplikasi;
        $aset_aplikasi->save();

        return redirect('/daftar_aset_aplikasi')->with('alert', 'Data berhasil diperbarui');
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
}
