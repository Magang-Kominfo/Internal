<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\SifatController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/form-new-koresponden', function () {
    return view('berita/form-koresponden');
});

Route::get('/form-koresponden', function () {
    return view('berita/form-berita-koresponden');
});

Route::get('/form-header', function () {
    return view('berita/form-header');
});

Route::get('/koresponden', function () {
    return view('berita/list-koresponden');
});

Route::get('/dashboard', function () {
    return view('berita/list-berita');
});

Route::get('/form-berita-create', [SifatController::class, 'index']);
Route::get('/detailberita/{id}', [BeritaController::class, 'show'])->name('berita.detail');
Route::post('/', [BeritaController::class, 'create'])->name('berita.create');

