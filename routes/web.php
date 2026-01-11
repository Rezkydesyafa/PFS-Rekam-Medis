<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\RekamMedisController;
use App\Http\Controllers\TagihanController; // Ditambahkan
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('landing');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
}); 

// Group untuk Superadmin
Route::middleware(['auth', 'superadmin'])->prefix('admin')->name('admin.')->group(function () {
    // User Management (CRUD)
    Route::resource('users', UserController::class);
});

// Group untuk Petugas (Akses Data Medis & Tagihan)
Route::middleware(['auth', 'role:petugas'])->group(function () {
    // Pasien CRUD
    Route::resource('pasien', PasienController::class);
    
    // Dokter CRUD
    Route::resource('dokter', DokterController::class);
    
    // Obat CRUD
    Route::resource('obat', ObatController::class);
    
    // Rekam Medis (Print & CRUD)
    Route::get('rekam-medis/{id}/print', [RekamMedisController::class, 'print'])->name('rekam-medis.print');
    Route::resource('rekam-medis', RekamMedisController::class);

    // --- BAGIAN BARU: TAGIHAN ---
    // Print Struk Tagihan
    Route::get('tagihan/{id}/print', [TagihanController::class, 'print'])->name('tagihan.print');
    // Update Status Bayar (Lunas/Belum)
    Route::patch('tagihan/{id}/status', [TagihanController::class, 'updateStatus'])->name('tagihan.updateStatus');
    // CRUD Tagihan (Index, Show, dll)
    Route::resource('tagihan', TagihanController::class);
});

require __DIR__.'/auth.php';