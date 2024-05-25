<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JenisInsidenController;
use App\Http\Controllers\MasterOdpController;
use App\Http\Controllers\InsidenController;
use App\Http\Controllers\AsetAplikasiController;
use App\Http\Controllers\JenisKategoriController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;

## ADMIN
Route::get('/admin',  [Controller::class, 'viewDashboard'])->name('admin')->middleware('auth');
Route::get('/admin/user_management',  [UserController::class, 'daftarUser'])->name('user-management')->middleware('auth');
Route::get('/admin/menambahkan_user',  [UserController::class, 'createForm'])->name('tambah-user')->middleware('auth');
Route::post('/admin/menambahkan_user',  [UserController::class, 'store'])->name('tambah-user.post')->middleware('auth');
Route::delete('/{id}/delete_user', [UserController::class, 'delete'])->name('delete-user.softDelete')->middleware('auth');
Route::get('/{id}/edit_user_management',  [UserController::class, 'editForm'])->name('edit-user-management')->middleware('auth');
Route::put('/{id}/edit_user_management', [UserController::class, 'update'])->name('update-user-management.update')->middleware('auth');


## USER
Route::get('/user',  [Controller::class, 'userProfil'])->name('user-profile')->middleware('auth');
Route::get('/',  [Controller::class, 'login'])->name('login')->middleware('guest');
Route::post('/login',  [Controller::class, 'loginValidate'])->name('login.post');

## DASHBOARD
Route::get('/dashboard-insiden',  [Controller::class, 'viewDashboardInsiden'])->name('dashboard-insiden')->middleware('auth');
Route::get('/dashboard-berita',  [Controller::class, 'viewDashboardBerita'])->name('dashboard-berita')->middleware('auth');
Route::get('/dashboard-aset',  [Controller::class, 'viewDashboardAset'])->name('dashboard-aset')->middleware('auth');

## ASET APLIKASI
Route::get('/menambahkan_aset_aplikasi',  [AsetAplikasiController::class, 'createForm'])->name('tambah-aset-aplikasi')->middleware('auth');
Route::post('/menambahkan_aset_aplikasi', [AsetAplikasiController::class, 'store'])->name('tambah-aset-aplikasi.post')->middleware('auth');
Route::get('/daftar_aset_aplikasi',  [AsetAplikasiController::class, 'daftarAsetAplikasi'])->name('aset-aplikasi')->middleware('auth');
Route::get('/{id}/edit_aset_aplikasi',  [AsetAplikasiController::class, 'editForm'])->name('edit-aset-aplikasi')->middleware('auth');
Route::put('/{id}/edit_aset_aplikasi', [AsetAplikasiController::class, 'update'])->name('update-aset-aplikasi.update')->middleware('auth');
Route::delete('/{id}/delete_aset_aplikasi', [AsetAplikasiController::class, 'delete'])->name('delete-aset.softDelete')->middleware('auth');

## KATEGORI ASET APLIKASI
Route::get('/menambahkan_kategori_aset_aplikasi',  [JenisKategoriController::class, 'createForm'])->name('tambah-kategori-aset-aplikasi')->middleware('auth');
Route::post('/menambahkan_kategori_aset_aplikasi',  [JenisKategoriController::class, 'store'])->name('tambahkan-kategori-aset-aplikasi.post')->middleware('auth');
Route::get('/daftar_kategori_aset_aplikasi',  [JenisKategoriController::class, 'daftarKategori'])->name('kategori-aset-aplikasi')->middleware('auth');
Route::get('/{id}/edit_kategori_aset_aplikasi',  [JenisKategoriController::class, 'editForm'])->name('edit-jenis-kategori-aset-aplikasi')->middleware('auth');
Route::put('/{id}/edit_kategori_aset_aplikasi', [JenisKategoriController::class, 'update'])->name('update-jenis-kategori-aset-aplikasi.update')->middleware('auth');

# PROSES INSIDEN
Route::get('/{id}/proses_insiden',  [InsidenController::class, 'viewProsesInsiden'])->name('view-proses-insiden')->middleware('auth');
Route::get('/daftar_proses_insiden',  [InsidenController::class, 'daftarProsesInsiden'])->name('proses-insiden')->middleware('auth');
Route::get('/proses_insiden',  [InsidenController::class, 'createForm'])->name('tambah-proses-insiden')->middleware('auth');
Route::post('/proses_insiden', [InsidenController::class, 'store'])->name('proses-insiden.post')->middleware('auth');
Route::get('/{id}/edit_proses_insiden',  [InsidenController::class, 'editForm'])->name('edit-proses-insiden')->middleware('auth');
Route::put('/{id}/edit_proses_insiden', [InsidenController::class, 'update'])->name('update-proses-insiden.update')->middleware('auth');
Route::delete('/{id}/delete_proses_insiden', [InsidenController::class, 'delete'])->name('delete-proses.softDelete')->middleware('auth');

## JENIS INSIDEN
Route::get('/menambahkan_insiden',  [JenisInsidenController::class, 'createForm'])->name('tambah-insiden')->middleware('auth');
Route::post('/menambahkan_insiden', [JenisInsidenController::class, 'store'])->name('tambahkan-insiden.post')->middleware('auth');
Route::get('/daftar_insiden', [JenisInsidenController::class, 'daftarJenisInsiden'])->name('daftar-insiden')->middleware('auth');
Route::get('/{id}/edit_daftar_insiden',  [JenisInsidenController::class, 'editForm'])->name('edit-jenis-insiden')->middleware('auth');
Route::put('/{id}/edit_daftar_insiden', [JenisInsidenController::class, 'update'])->name('update-jenis-insiden.update')->middleware('auth');


## DATA MASTER
Route::get('/data_master', [MasterOdpController::class, 'daftarMasterOPD'])->name('data-master')->middleware('auth');
Route::get('/data_master/menambahkan_data_master',  [MasterOdpController::class, 'createForm'])->name('menambahkan-data-master')->middleware('auth');
Route::get('/{id}/edit_data_master',  [MasterOdpController::class, 'editForm'])->name('edit-data-master')->middleware('auth');
Route::put('/{id}/edit_data_master', [MasterOdpController::class, 'update'])->name('update-data-master.update')->middleware('auth');
Route::post('/data_master/menambahkan_data_master', [MasterOdpController::class, 'store'])->name('tambahkan-instansi.post')->middleware('auth');
Route::delete('/data_master/menambahkan_data_master/{id}', [MasterOdpController::class, 'delete'])->name('delete-data-master.delete')->middleware('auth');



