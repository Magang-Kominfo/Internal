<?php

namespace App\Http\Controllers;

use App\Models\Sifat;
use App\Models\Berita;
use App\Http\Requests\StoreBeritaRequest;
use App\Http\Requests\UpdateBeritaRequest;

class BeritaController extends Controller
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
    public function create(StoreBeritaRequest $request)
    {
        // dd($request);

        // Validate the incoming request data
        // $request->validate([
        //     'no_agenda' => 'required',
        //     'id_sifat' => 'nullable',
        //     'no_berita' => 'required',
        //     'jumlah_halaman_berita' => 'required|integer',
        //     'tanggal_buat_berita' => 'required|date',
        //     'isi_berita' => 'required',
        //     'dokumen_surat_berita' => 'nullable',
        // ]);

        // simpan database
        $berita = Berita::create([
            'no_agenda' => $request->no_agenda,
            'id_sifat' => $request->id_sifat,
            'no_berita' =>  $request->no_berita,
            'jumlah_halaman_berita' => $request->jumlah_halaman_berita,
            'tanggal_buat_berita' =>  $request->tanggal_buat_berita,
            'isi_berita' => $request->isi_berita,
            'dokumen_surat_berita' =>  $request->dokumen_surat_berita,

        ]);
       
        return redirect()->route('berita.detail', ['id' => $berita->id])->with('alert', 'Instansi berhasil ditambahkan.');
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function detail(StoreBeritaRequest $request)
    // {
    //     $sifats = Sifat::all();
    //     $beritas = Sifat::all();
    //     return view('berita.form-berita', ['sifats' => $sifats],);
    // }

    /**
     * Display the specified resource.
     */
    public function show($id)
{
    $berita = Berita::find($id);
        return view('berita.detail-berita', compact('berita'));
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
    public function update(UpdateBeritaRequest $request, Berita $berita)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Berita $berita)
    {
        //
    }
}
