<?php

namespace App\Http\Controllers;

use App\Models\Sifat;
use App\Http\Requests\StoreSifatRequest;
use App\Http\Requests\UpdateSifatRequest;
use Illuminate\Support\Facades\Auth;
class SifatController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sifats = Sifat::all();
        return view('berita.form-berita-create', ['sifats' => $sifats]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSifatRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Sifat $sifat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sifat $sifat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSifatRequest $request, Sifat $sifat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sifat $sifat)
    {
        //
    }
}
