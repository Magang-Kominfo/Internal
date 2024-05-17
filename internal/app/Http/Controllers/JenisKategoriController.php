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
        return view('menambahkan-jenis-aset-aplikasi-uc-1');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function daftarKategori()
    {
        return view('daftar-jenis-aset-aplikasi-uc-1');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJenis_kategoriRequest $request)
    {

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
    public function edit(Jenis_kategori $jenis_kategori)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJenis_kategoriRequest $request, Jenis_kategori $jenis_kategori)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jenis_kategori $jenis_kategori)
    {
        //
    }
}
