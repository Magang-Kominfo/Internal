<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JenisInsidenController;
use App\Http\Controllers\MasterOdpController;
use App\Http\Controllers\InsidenController;
use App\Http\Controllers\AsetAplikasiController;
use App\Http\Controllers\JenisKategoriController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AsetController;


## LOGIN
Route::middleware('web')->group(function () {
    Route::get('/',  [Controller::class, 'login'])->name('login')->middleware(['user']);
    Route::get('/logout-confirm', [Controller::class, 'logoutConfirm'])->name('logout.confirm')->middleware(['auth']);
});
Route::post('/login',  [Controller::class, 'loginValidate'])->name('login.post');
Route::post('/logout', [Controller::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {
    ## USER
    Route::get('/profile',  [Controller::class, 'userProfil'])->name('user-profile');
    Route::put('/profile/update',  [Controller::class, 'editProfil'])->name('user-profile.update');
    Route::post('/validate-password', [Controller::class, 'validatePassword'])->name('validate-user-password');
});

Route::middleware(['auth','admin'])->group(function () {
    ## ADMIN
    Route::get('/admin',  [Controller::class, 'viewDashboard'])->name('admin');
    Route::get('/admin/user_management',  [UserController::class, 'daftarUser'])->name('user-management');
    Route::get('/admin/menambahkan_user',  [UserController::class, 'createForm'])->name('tambah-user');
    Route::post('/admin/menambahkan_user',  [UserController::class, 'store'])->name('tambah-user.post');
    Route::delete('/{id}/delete_user', [UserController::class, 'delete'])->name('delete-user.softDelete');
    Route::get('/{id}/edit_user_management',  [UserController::class, 'editForm'])->name('edit-user-management');
    Route::put('/{id}/edit_user_management', [UserController::class, 'update'])->name('update-user-management.update');
});


Route::middleware(['auth', 'user_insiden'])->group(function () {
    ## DASHBOARD
    Route::get('/dashboard-insiden',  [Controller::class, 'viewDashboardInsiden'])->name('dashboard-insiden');

    ## ASET APLIKASI
    Route::get('/menambahkan_aset_aplikasi',  [AsetAplikasiController::class, 'createForm'])->name('tambah-aset-aplikasi');
    Route::post('/menambahkan_aset_aplikasi', [AsetAplikasiController::class, 'store'])->name('tambah-aset-aplikasi.post');
    Route::get('/daftar_aset_aplikasi',  [AsetAplikasiController::class, 'daftarAsetAplikasi'])->name('aset-aplikasi');
    Route::get('/{id}/edit_aset_aplikasi',  [AsetAplikasiController::class, 'editForm'])->name('edit-aset-aplikasi');
    Route::put('/{id}/edit_aset_aplikasi', [AsetAplikasiController::class, 'update'])->name('update-aset-aplikasi.update');
    Route::delete('/{id}/delete_aset_aplikasi', [AsetAplikasiController::class, 'delete'])->name('delete-aset.softDelete');

    ## KATEGORI ASET APLIKASI
    Route::get('/menambahkan_kategori_aset_aplikasi',  [JenisKategoriController::class, 'createForm'])->name('tambah-kategori-aset-aplikasi');
    Route::post('/menambahkan_kategori_aset_aplikasi',  [JenisKategoriController::class, 'store'])->name('tambahkan-kategori-aset-aplikasi.post');
    Route::get('/daftar_kategori_aset_aplikasi',  [JenisKategoriController::class, 'daftarKategori'])->name('kategori-aset-aplikasi');
    Route::get('/{id}/edit_kategori_aset_aplikasi',  [JenisKategoriController::class, 'editForm'])->name('edit-jenis-kategori-aset-aplikasi');
    Route::put('/{id}/edit_kategori_aset_aplikasi', [JenisKategoriController::class, 'update'])->name('update-jenis-kategori-aset-aplikasi.update');

    # PROSES INSIDEN
    Route::get('/{id}/proses_insiden',  [InsidenController::class, 'viewProsesInsiden'])->name('view-proses-insiden');
    Route::get('/daftar_proses_insiden',  [InsidenController::class, 'daftarProsesInsiden'])->name('proses-insiden');
    Route::get('/proses_insiden',  [InsidenController::class, 'createForm'])->name('tambah-proses-insiden');
    Route::post('/proses_insiden', [InsidenController::class, 'store'])->name('proses-insiden.post');
    Route::get('/{id}/edit_proses_insiden',  [InsidenController::class, 'editForm'])->name('edit-proses-insiden');
    Route::put('/{id}/edit_proses_insiden', [InsidenController::class, 'update'])->name('update-proses-insiden.update');
    Route::delete('/{id}/delete_proses_insiden', [InsidenController::class, 'delete'])->name('delete-proses.softDelete');

    ## JENIS INSIDEN
    Route::get('/menambahkan_insiden',  [JenisInsidenController::class, 'createForm'])->name('tambah-insiden');
    Route::post('/menambahkan_insiden', [JenisInsidenController::class, 'store'])->name('tambahkan-insiden.post');
    Route::get('/daftar_insiden', [JenisInsidenController::class, 'daftarJenisInsiden'])->name('daftar-insiden');
    Route::get('/{id}/edit_daftar_insiden',  [JenisInsidenController::class, 'editForm'])->name('edit-jenis-insiden');
    Route::put('/{id}/edit_daftar_insiden', [JenisInsidenController::class, 'update'])->name('update-jenis-insiden.update');


    ## DATA MASTER
    Route::get('/data_master', [MasterOdpController::class, 'daftarMasterOPD'])->name('data-master');
    Route::get('/data_master/menambahkan_data_master',  [MasterOdpController::class, 'createForm'])->name('menambahkan-data-master');
    Route::get('/{id}/edit_data_master',  [MasterOdpController::class, 'editForm'])->name('edit-data-master');
    Route::put('/{id}/edit_data_master', [MasterOdpController::class, 'update'])->name('update-data-master.update');
    Route::post('/data_master/menambahkan_data_master', [MasterOdpController::class, 'store'])->name('tambahkan-instansi.post');
    Route::delete('/data_master/menambahkan_data_master/{id}', [MasterOdpController::class, 'delete'])->name('delete-data-master.delete');

});


Route::middleware(['auth', 'user_berita'])->group(function () {
    ## DASHBOARD
    Route::get('/dashboard-berita',  [Controller::class, 'viewDashboardBerita'])->name('dashboard-berita');
});


## ASET
Route::middleware(['auth', 'user_aset'])->group(function () {

    Route::get('/tambahaset', function () {
        return view('aset-persandian.tambahaset-uc-3');
    })->name('tambahaset-uc-3');
    Route::post('/tambahaset', [AsetController::class, 'create']);



    Route::get('/dbaset-uc-3', function () {
        return view('aset-persandian.dbaset-uc-3');
    })->name('dbaset-uc-3');

    Route::get('/dbaset', [AsetController::class, 'index']);
    Route::get('/show/{aset}', [AsetController::class, 'show']);



    Route::get('/editaset-uc-3', function () {
        return view('aset-persandian.edit');
    })->name('edit');

    Route::get('/edit/{id}', [AsetController::class, 'edit']);
    Route::put('/update/{id}', [AsetController::class, 'update']);
    Route::delete('/delete/{id}', [AsetController::class, 'destroy']);

});

