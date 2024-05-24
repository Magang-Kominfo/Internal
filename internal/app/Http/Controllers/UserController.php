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
            'nama_user' => 'nullable|string|max:255',
            'role' => 'required|string',
            'password' => 'required|string',
        ]);

        // Simpan data ke dalam database
        User::create([
            'id_user' => $request->id_user,
            'nama_user'=>$request->nama_user,
            'role' => $request->role,
            'password' => $request->password,
        ]);

        // Redirect dengan message jika berhasil
        return redirect('/admin/user_management')->with('alert', 'User berhasil ditambahkan.');
    }

    public function editForm($id)
    {
        $user = User::findOrFail($id);
        return view('user-management.daftar-user-management-edit-admin',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $validatedData = $request->validate([
            'id_user' => 'required|string|max:255',
            'nama_user' => 'nullable|string|max:255',
            'role' => 'required|string',
            'password' => 'required|string',
        ]);
        // Perbarui data di database
        $user = User::find($id);
        $user->id_user = $request->id_user;
        $user->nama_user = $request->nama_user;
        $user->role = $request->role;
        $user->password = $request->password;
        $user->save();

        return redirect('/admin/user_management')->with('alert', 'Data berhasil diperbarui');
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
