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
        $request->validate([
            'id_user' => 'required|exists:users,id_user',
        ],
        [
            'id_user.exists' => 'ID User salah.',
        ]);


        $credentials = $request->only('id_user', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            $userIdPrefix = substr($user->id_user, 0, 2);

            if(auth()->user()->is_admin == true){
                return redirect()->intended('/admin');
            }else{
                if ($userIdPrefix === '10') {
                    return redirect()->intended(route('dashboard-insiden'));
                } elseif ($userIdPrefix === '20') {
                    return redirect()->intended(route('dashboard-berita'));
                } elseif ($userIdPrefix === '30') {
                    return redirect()->intended(route('dashboard-aset'));
                } else {
                    return back()->with('error', 'ID User tidak valid.');
                }
            }
        }

        return back()->with('login-error', 'Login Failed');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate the CSRF token
        $request->session()->regenerateToken();

        return redirect('/');
    }

}
