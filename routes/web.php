<?php

use App\Http\Controllers\AdministrasiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PasienController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('dokter', DokterController::class);
Route::get('/dokter/laporan/cetak', [DokterController::class, 'laporan']);

Route::resource('administrasi',AdministrasiController::class);
Route::get('adminsitrasi/laporan/cetak',[AdministrasiController::class, 'laporan']);

Route::resource('pasien', PasienController::class);