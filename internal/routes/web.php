<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\KorespondenController;
use App\Http\Controllers\MengirimController;
use App\Models\Koresponden;
use App\Models\mengirim;

Route::get('/', function () {
    return view('welcome');
});

// Controller Berita
Route::get('dashboard-berita', [BeritaController::class, 'showNews']);
Route::get('/form-berita-create', [BeritaController::class, 'index']);
Route::get('/form-berita-edit/{id_berita}', [BeritaController::class, 'showedit'])->name('berita.update');
Route::put('/form-berita-edit/{id_berita}', [BeritaController::class, 'update'])->name('berita.edit');
Route::get('/detailberita/{id_berita}', [BeritaController::class, 'show'])->name('berita.detail');
Route::delete('/detailberita/{id_berita}', [BeritaController::class, 'delete'])->name('berita.delete');
Route::post('/form-berita-create', [BeritaController::class, 'create'])->name('berita.create');

// Controller Mengirim
Route::get('/detailberita/{id_berita}/listkoresponden', [MengirimController::class, 'index'])->name('koresponden.index');
Route::get('/detailberita/{id_berita}/listkoresponden/{id_email}', [MengirimController::class, 'show'])->name('mengirim.show');
Route::put('/detailberita/{id_berita}/listkoresponden/{id_email}', [MengirimController::class, 'edit'])->name('mengirim.edit');

// Controller Email
Route::get('/email-option', [EmailController::class, 'index'])->name('email.index');
Route::get('/email-option/{beritaId}', [EmailController::class, 'show'])->name('email.show');
Route::get('/email-default-option', [EmailController::class, 'getdefault'])->name('email.get');
Route::delete('/email-delete/{id_email}', [EmailController::class, 'getdefault'])->name('email.delete');

// Controller Koresponden
Route::get('/form-new-koresponden', [KorespondenController::class, 'index'])->name('koresponden.form');
Route::get('/form-koresponden', [KorespondenController::class, 'show'])->name('koresponden.show');
Route::post('/new-koresponden', [KorespondenController::class, 'create'])->name('koresponden.create');
Route::get('/koresponden-edit/{id_koresponden}', [KorespondenController::class, 'edit'])->name('koresponden.edit');
Route::put('/koresponden-edit/{id_koresponden}', [KorespondenController::class, 'update'])->name('koresponden.update');
Route::get('/koresponden-delete/{id_koresponden}', [KorespondenController::class, 'delete'])->name('koresponden.get');
Route::delete('/koresponden-delete/{id_koresponden}', [KorespondenController::class, 'destroy'])->name('koresponden.delete');

