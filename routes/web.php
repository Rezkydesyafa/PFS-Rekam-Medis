<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\RekamMedisController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth', 'superadmin'])->prefix('admin')->name('admin.')->group(function () {
    // User Management (CRUD)
    Route::resource('users', UserController::class);
});


Route::middleware(['auth', 'role:user'])->group(function () {
    // Pasien CRUD
    Route::resource('pasien', PasienController::class);
    
    // Dokter CRUD
    Route::resource('dokter', DokterController::class);
    
    // Obat CRUD
    Route::resource('obat', ObatController::class);
    
    // Rekam Medis CRUD
    Route::resource('rekam-medis', RekamMedisController::class);
});

require __DIR__.'/auth.php';
