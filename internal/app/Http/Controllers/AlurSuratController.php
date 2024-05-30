<?php

namespace App\Http\Controllers;

use App\Models\AlurSurat;
use App\Http\Requests\StoreAlurSuratRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateAlurSuratRequest;

class AlurSuratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $alursurats = AlurSurat::all();
        return view('berita.form-berita-create', ['alursurats' => $alursurats],compact('user'));
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
    public function store(StoreAlurSuratRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(AlurSurat $alurSurat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AlurSurat $alurSurat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAlurSuratRequest $request, AlurSurat $alurSurat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AlurSurat $alurSurat)
    {
        //
    }
}
