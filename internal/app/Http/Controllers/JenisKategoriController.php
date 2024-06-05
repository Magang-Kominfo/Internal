<?php

namespace App\Http\Controllers;

use App\Models\Jenis_kategori;
use App\Http\Requests\StoreJenis_kategoriRequest;
use App\Http\Requests\UpdateJenis_kategoriRequest;

class JenisKategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function createForm()
    {
        return view('insiden-dan-aset-aplikasi.menambahkan-jenis-aset-aplikasi-uc-1');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function daftarKategori()
    {

        $jenis_kategoris = Jenis_kategori::paginate(5);
        return view('insiden-dan-aset-aplikasi.daftar-jenis-aset-aplikasi-uc-1', ['jenis_kategoris' => $jenis_kategoris]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJenis_kategoriRequest $request)
    {
        $request->validate([
            'nama_jenis_kategori' => 'required|string|max:255',
            'deskripsi_jenis_kategori' => 'required|string',
        ]);

        // Simpan data ke dalam database
        Jenis_kategori::create([
            'nama_jenis_kategori' => $request->nama_jenis_kategori,
            'deskripsi_jenis_kategori' => $request->deskripsi_jenis_kategori,
        ]);

        // Redirect dengan message jika berhasil
        return redirect('/menambahkan_kategori_aset_aplikasi')->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Jenis_kategori $jenis_kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editForm($id)
    {
        $jenis_kategori = Jenis_kategori::findOrFail($id);
        return view('insiden-dan-aset-aplikasi.daftar-jenis-aset-aplikasi-edit-uc-1',compact('jenis_kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJenis_kategoriRequest $request, $id)
    {
        $validatedData = $request->validate([
            'nama_jenis_kategori' => 'required|string|max:255',
            'deskripsi_jenis_kategori' => 'required|string',
        ]);

        // Perbarui data di database
        $jenis_kategori = Jenis_kategori::find($id);
        $jenis_kategori->nama_jenis_kategori = $request->nama_jenis_kategori;
        $jenis_kategori->deskripsi_jenis_kategori = $request->deskripsi_jenis_kategori;
        $jenis_kategori->save();

        return redirect('/daftar_kategori_aset_aplikasi')->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $data = Jenis_kategori::find($id);
        $data->delete();

        return redirect('/daftar_kategori_aset_aplikasi')->with('success', 'Data berhasil dihapus.');
    }
}
