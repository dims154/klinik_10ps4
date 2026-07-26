<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\AdministrasiController;

Route::get('/', function () {
    return redirect('/home');
});

// ==================== AUTH ====================
Auth::routes();

// ==================== HOME ====================
Route::get('/home', [HomeController::class, 'index'])->name('home');

// ==================== DOKTER ====================
Route::resource('dokter', DokterController::class);

Route::get('/laporan/dokter', [DokterController::class, 'laporan'])
    ->name('dokter.laporan');

// ==================== PASIEN ====================
Route::resource('pasien', PasienController::class);

Route::get('/laporan/pasien', [PasienController::class, 'laporan'])
    ->name('pasien.laporan');

// ==================== ADMINISTRASI ====================
Route::resource('administrasi', AdministrasiController::class);

Route::get('/laporan/administrasi', [AdministrasiController::class, 'laporan'])
    ->name('administrasi.laporan');