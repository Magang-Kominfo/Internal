<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use App\Http\Requests\StoreAsetRequest;
use App\Http\Requests\UpdateAsetRequest;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class AsetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $aset;
    public function __construct(){
        $this->aset = new Aset();

    }

    /**
     * Show the form for creating a new resource.
     */
    public function index()
    {
        $aset =Aset::all();

        return view('aset-persandian.dbaset-uc-3', [
            'aset' => $aset
        ]);
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
}
