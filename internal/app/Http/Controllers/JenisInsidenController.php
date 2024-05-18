<?php

namespace App\Http\Controllers;

use App\Models\Jenis_insiden;
use App\Http\Requests\StoreJenis_insidenRequest;
use App\Http\Requests\UpdateJenis_insidenRequest;

class JenisInsidenController extends Controller
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
        return view('menambahkan-jenis-insiden-uc-1');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJenis_insidenRequest $request)
    {
        $request->validate([
            'nama_insiden' => 'required|string|max:255',
            'deskripsi_insiden' => 'required|string',
        ]);

        // Simpan data ke dalam database
        Jenis_insiden::create([
            'nama_insiden' => $request->nama_insiden,
            'deskripsi_insiden' => $request->deskripsi_insiden,
        ]);

        // Redirect dengan message jika berhasil
        return redirect('/menambahkan_insiden')->with('alert', 'Insiden berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function daftarJenisInsiden()
    {
        $jenis_insidens = Jenis_insiden::all();
        return view('daftar-jenis-insiden-uc-1', ['jenis_insidens' => $jenis_insidens]);
    }

    /**
     * Show the form for editing the specified resource.
     */


    public function editForm($id)
    {
        $jenis_insiden = Jenis_insiden::findOrFail($id);
        return view('daftar-jenis-insiden-edit-uc-1',compact('jenis_insiden'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJenis_insidenRequest $request, $id)
    {
        $validatedData = $request->validate([
            'nama_insiden' => 'required|string|max:255',
            'deskripsi_insiden' => 'required|string',
        ]);

        // Perbarui data di database
        $jenis_insiden = Jenis_insiden::find($id);
        $jenis_insiden->nama_insiden = $request->nama_insiden;
        $jenis_insiden->deskripsi_insiden = $request->deskripsi_insiden;
        $jenis_insiden->save();

        return redirect('/daftar_insiden')->with('alert', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jenis_insiden $jenis_insiden)
    {
        //
    }
}
