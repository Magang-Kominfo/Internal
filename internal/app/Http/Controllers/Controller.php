<?php

namespace App\Http\Controllers;
use App\Models\Insiden;
use App\Models\Aset_aplikasi;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Controller

{

    public function viewDashboardInsiden()
    {
        $insidens = Insiden::orderBy('updated_at', 'desc')->take(5)->get();
        $aset_aplikasis = Aset_aplikasi::orderBy('updated_at', 'desc')->take(10)->get();
        return view('insiden-dan-aset-aplikasi.dashboard-uc-1', compact('insidens','aset_aplikasis'));
    }

    public function viewDashboardBerita()
    {
        return view('berita.dashboard-berita');
    }

    public function viewDashboardAset()
    {
        return view('aset-persandian.dashboard-aset');
    }

    public function viewDashboard()
    {
        return view('user-management.dashboard-admin');
    }

    public function userProfil()
    {
        return view('user.profile');
    }

    public function login()
    {
        return view('login');
    }

    public function loginValidate(Request $request)
    {
        $credentials = $request->only('id_user', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $userIdPrefix = substr($user->id_user, 0, 2);

            if ($userIdPrefix === '10') {
                return redirect()->route('dashboard-insiden');
            } elseif ($userIdPrefix === '20') {
                return redirect()->route('dashboard-berita');
            } elseif ($userIdPrefix === '30') {
                return redirect()->route('dashboard-aset');
            } else {
                return redirect()->route('login')->with('error', 'ID pengguna tidak valid.');
            }
        }

        return redirect()->route('login')->with('error', 'Kombinasi email dan password tidak valid.');
    }

}
