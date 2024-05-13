<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JenisInsidenController;
use App\Http\Controllers\MasterOdpController;
use App\Http\Controllers\InsidenController;
use App\Http\Controllers\AsetAplikasiController;


## DASHBOARD
Route::get('/', function () {
    return view('dashboard-uc-1');
})->name('dashboard');


## ASET APLIKASI
Route::get('/menambahkan_aset_aplikasi',  [AsetAplikasiController::class, 'createForm'])->name('tambah-aset-aplikasi');
Route::post('/menambahkan_aset_aplikasi', [AsetAplikasiController::class, 'store'])->name('tambah-aset-aplikasi.post')->withoutMiddleware(['auth']);
Route::get('/daftar_aset_aplikasi',  [AsetAplikasiController::class, 'daftarProsesInsiden'])->name('aset-aplikasi');
Route::get('/{id}/edit_aset_aplikasi',  [AsetAplikasiController::class, 'editForm'])->name('edit-aset-aplikasi');
Route::put('/{id}/edit_aset_aplikasi', [AsetAplikasiController::class, 'update'])->name('update-aset-aplikasi.update')->withoutMiddleware(['auth']);
Route::delete('/{id}/delete_aset_aplikasi', [AsetAplikasiController::class, 'delete'])->name('delete-aset.softDelete');


# PROSES INSIDEN
Route::get('/{id}/proses_insiden',  [InsidenController::class, 'view'])->name('view-proses-insiden');
Route::get('/daftar_proses_insiden',  [InsidenController::class, 'daftarProsesInsiden'])->name('proses-insiden');
Route::get('/proses_insiden',  [InsidenController::class, 'createForm'])->name('tambah-proses-insiden');
Route::post('/proses_insiden', [InsidenController::class, 'store'])->name('proses-insiden.post')->withoutMiddleware(['auth']);
Route::get('/{id}/edit_proses_insiden',  [InsidenController::class, 'editForm'])->name('edit-proses-insiden');
Route::put('/{id}/edit_proses_insiden', [InsidenController::class, 'update'])->name('update-proses-insiden.update')->withoutMiddleware(['auth']);
Route::delete('/{id}/delete_proses_insiden', [InsidenController::class, 'delete'])->name('delete-proses.softDelete');


## JENIS INSIDEN
Route::get('/menambahkan_insiden',  [JenisInsidenController::class, 'createForm'])->name('tambah-insiden');
Route::post('/menambahkan_insiden', [JenisInsidenController::class, 'store'])->name('tambahkan-insiden.post')->withoutMiddleware(['auth']);
Route::get('/daftar_insiden', [JenisInsidenController::class, 'daftarInsiden'])->name('daftar-insiden');
Route::get('/{id}/edit_daftar_insiden',  [JenisInsidenController::class, 'editForm'])->name('edit-jenis-insiden');
Route::put('/{id}/edit_daftar_insiden', [JenisInsidenController::class, 'update'])->name('update-jenis-insiden.update')->withoutMiddleware(['auth']);


## DATA MASTER
Route::get('/data_master', [MasterOdpController::class, 'daftarMasterOPD'])->name('data-master');
Route::get('/data_master/menambahkan_data_master',  [MasterOdpController::class, 'createForm'])->name('menambahkan-data-master');
Route::get('/{id}/edit_data_master',  [MasterOdpController::class, 'editForm'])->name('edit-data-master');
Route::put('/{id}/edit_data_master', [MasterOdpController::class, 'update'])->name('update-data-master.update')->withoutMiddleware(['auth']);
Route::post('/data_master/menambahkan_data_master', [MasterOdpController::class, 'store'])->name('tambahkan-instansi.post')->withoutMiddleware(['auth']);
Route::delete('/data_master/menambahkan_data_master/{id}', [MasterOdpController::class, 'delete'])->name('delete-data-master.delete');



