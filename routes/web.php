<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AsetController;
use App\Http\Controllers\UserController;

use App\Models\Aset;

Route::get('/', function () {
    return view('login');
})->name('login-1');

Route::get('/dbadmin', function () {
    return view('dbadmin'); 
})->name('dbadmin-1');

Route::get('/tambahaset', function () {
    return view('tambahaset-uc-3'); 
})->name('tambahaset-uc-3');
Route::post('/tambahaset', [AsetController::class, 'create'])->withoutMiddleware('auth');

Route::get('/dbaset-uc-3', function () {
    return view('dbaset-uc-3'); 
})->name('dbaset-uc-3');
Route::get('/dbaset', [AsetController::class, 'index'])->withoutMiddleware('auth');
Route::get('/show/{aset}', [AsetController::class, 'show'])->withoutMiddleware('auth');

Route::get('/editaset-uc-3', function () {
    return view('edit'); 
})->name('edit');
Route::get('/edit/{id}', [AsetController::class, 'edit'])->withoutMiddleware('auth');
Route::put('/update/{id}', [AsetController::class, 'update'])->withoutMiddleware('auth'); 
Route::delete('/delete/{id}', [AsetController::class, 'destroy'])->withoutMiddleware('auth');

Route::get('/testviewprofile', function () {
    return view('profile'); 
})->name('viewprofile');

Route::put('/profile/{id}', function () {
    // controller utk handle edit form profile
})->name('viewprofile');