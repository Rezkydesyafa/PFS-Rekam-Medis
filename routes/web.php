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

// Group untuk Petugas & Role Lainnya (Dikelompokkan berdasarkan akses)
Route::middleware(['auth'])->group(function () {
    
    // 1. UNIT PENDAFTARAN (Akses: Pasien)
    // 1. UNIT PENDAFTARAN (Akses: Pasien)
    // Petugas RM & Dokter juga biasanya butuh akses data pasien
    Route::middleware('role:unit_pendaftaran,petugas_rekam_medis,petugas,dokter,kasir,superadmin,apoteker')->group(function () {
        Route::resource('pasien', PasienController::class);
    });
    
    // 2. DATA DOKTER (Biasanya Admin / Petugas RM)
    Route::middleware('role:petugas_rekam_medis,petugas,admin,superadmin')->group(function () {
        Route::resource('dokter', DokterController::class);
    });
    
    // 3. APOTEKER (Akses: Obat)
    // Dokter & Petugas RM juga mungkin perlu lihat stok obat
    Route::middleware('role:apoteker,dokter,petugas_rekam_medis,petugas,superadmin')->group(function () {
        Route::resource('obat', ObatController::class);
    });
    
    // 4. DOKTER & PETUGAS RM (Akses: Rekam Medis)
    Route::middleware('role:dokter,petugas_rekam_medis,petugas,kasir,superadmin,apoteker')->group(function () {
        Route::get('rekam-medis/{id}/print', [RekamMedisController::class, 'print'])->name('rekam-medis.print');
        Route::resource('rekam-medis', RekamMedisController::class);
    });

    // 5. KASIR (Akses: Tagihan)
    // Petugas RM & Admin mungkin perlu akses juga
    Route::middleware('role:kasir,petugas_rekam_medis,petugas,superadmin')->group(function () {
        // Print Struk Tagihan
        Route::get('tagihan/{id}/print', [TagihanController::class, 'print'])->name('tagihan.print');
        // Update Status Bayar (Lunas/Belum)
        Route::patch('tagihan/{id}/status', [TagihanController::class, 'updateStatus'])->name('tagihan.updateStatus');
        // CRUD Tagihan (Index, Show, dll)
        Route::resource('tagihan', TagihanController::class);
    });
});

require __DIR__.'/auth.php';