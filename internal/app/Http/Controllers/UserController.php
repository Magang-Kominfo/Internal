<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function daftarUser()
    {
        $users = User::all();
        return view('user-management.daftar-user-management-admin', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createForm()
    {
        return view('user-management.menambahkan-user-management-admin');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $request->validate([
            'id_user' => 'required|string|max:255',
            'role' => 'required|string',
            'password' => 'required|string',
        ]);

        // Simpan data ke dalam database
        User::create([
            'id_user' => $request->id_user,
            'role' => $request->role,
            'password' => $request->password,
        ]);

        // Redirect dengan message jika berhasil
        return redirect('/admin/user_management')->with('alert', 'User berhasil ditambahkan.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $data = User::find($id);
        $data->delete();

        return redirect('/admin/user_management')->with('success', 'Data berhasil dihapus secara lunak.');
    }
}
