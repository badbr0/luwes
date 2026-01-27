<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SewaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FrontendAlatController;
use App\Http\Controllers\Admin\AlatController;
use App\Http\Controllers\Admin\PesananController;

// ====================
// ROUTE PUBLIK (tanpa login)
// ====================
Route::get('/', [FrontendAlatController::class, 'index'])->name('home');
Route::get('/sewa/{alat}', [SewaController::class, 'show'])->name('sewa.form');
Route::post('/pesan', [SewaController::class, 'store'])->name('pesan.store');

// ====================
// ROUTE AUTHENTICATED
// ====================
Route::middleware('auth')->group(function () {

    // Dashboard admin (ganti default Breeze)
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Profile Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ====================
    // ADMIN PANEL
    // ====================
    Route::prefix('admin')->group(function () {

        // CRUD Alat
        Route::get('/alat', [AlatController::class, 'index'])->name('admin.alat.index');
        Route::get('/alat/create', [AlatController::class, 'create'])->name('admin.alat.create');
        Route::post('/alat', [AlatController::class, 'store'])->name('admin.alat.store');
        Route::get('/alat/{alat}/edit', [AlatController::class, 'edit'])->name('admin.alat.edit');
        Route::put('/alat/{alat}', [AlatController::class, 'update'])->name('admin.alat.update');
        Route::delete('/alat/{alat}', [AlatController::class, 'destroy'])->name('admin.alat.destroy');

        // Pesanan
        Route::get('/pesanan', [PesananController::class, 'index'])->name('admin.pesanan.index');
        Route::get('/pesanan/{pesanan}', [PesananController::class, 'show'])->name('admin.pesanan.show');
        Route::patch('/pesanan/{pesanan}/status', [PesananController::class, 'updateStatus'])->name('admin.pesanan.updateStatus');
    });
});

// ====================
// AUTH ROUTES (dari Breeze)
// ====================
require __DIR__ . '/auth.php';
