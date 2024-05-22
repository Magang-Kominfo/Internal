<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aset;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class AsetController extends Controller
{
    protected $aset;
    public function __construct(){
        $this->aset = new Aset();

    }
    public function index()
    {
        $aset =Aset::all();
    
        return view('dbaset-uc-3', [
            'aset' => $aset
        ]);
    }

    /**
     * Show the form for creating a new resource.
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

    public function show(Aset $aset,Request $request)
    {
        return view('show-uc-3', [
            'aset' => $aset
        ]);
    }

    public function edit($id)
    {
        $aset =Aset::find($id);

        return view('editaset-uc-3', compact('aset'));
    }

    public function update(Request $request, $id)
    {
        $aset =Aset::find($id);

        $formFields=$request->all();

        for ($i = 0; $i < count($request->file('images')); $i++) {
            $formFields['images'][$i] =  $request->file('images')[$i]->storeOnCloudinary('magangpkl')->getSecurePath();
        }

        $aset->update($formFields);

        return view('show-uc-3', [
            'aset' => $aset
        ]);
    }


    public function destroy($id)
    {
        $aset = Aset::findOrFail($id);
        $aset->delete();
        return redirect('/dbaset');
    }
}
