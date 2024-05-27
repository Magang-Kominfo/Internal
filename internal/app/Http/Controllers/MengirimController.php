<?php

namespace App\Http\Controllers;

use App\Models\mengirim;
use App\Http\Requests\StoremengirimRequest;
use App\Http\Requests\UpdatemengirimRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MengirimController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id_berita)
    {
        $datas = mengirim::where('id_berita', $id_berita)->get();

        return view('berita.list-koresponden', compact( 'datas'));
    }

    public function show($id_berita, $id_email)
    {
        $data = Mengirim::where('id_berita', $id_berita)
                     ->where('id_email', $id_email)
                     ->first();
                    
        return view('berita.header', compact('data'));
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
    public function store(StoremengirimRequest $request)
    {
        // 
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id_berita, $id_email)
    {
        // Validate the incoming reqest data
        $request->validate([
            'tanggal_kirim_berita' => 'required|date',
            'respon_time' => 'nullable|date',
        ]);

        $now = Carbon::now();
        
        $dataToUpdate = [
            'tanggal_kirim_berita' => $request->tanggal_kirim_berita,
            'respon_time' => $request->respon_time, 
            'updated_at' => $now,
        ];
       
        Mengirim::updateOrInsert(
            ['id_berita' => $id_berita, 'id_email' => $id_email],
            $dataToUpdate
        );

        return redirect()->route('koresponden.index', ['id_berita' => $id_berita], 
      );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatemengirimRequest $request, mengirim $mengirim)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(mengirim $mengirim)
    {
        //
    }
}
