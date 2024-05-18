<?php

namespace App\Http\Controllers;
use App\Models\Insiden;
use App\Models\Aset_aplikasi;

class Controller

{

    public function viewDashboard()
    {
        $insidens = Insiden::orderBy('updated_at', 'desc')->take(5)->get();
        $aset_aplikasis = Aset_aplikasi::orderBy('updated_at', 'desc')->take(10)->get();
        return view('dashboard-uc-1', compact('insidens','aset_aplikasis'));
    }
}
