<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
});

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/alat', [App\Http\Controllers\Admin\AlatController::class, 'index'])->name('admin.alat.index');
    Route::get('/alat/create', [App\Http\Controllers\Admin\AlatController::class, 'create'])->name('admin.alat.create');
    Route::post('/alat', [App\Http\Controllers\Admin\AlatController::class, 'store'])->name('admin.alat.store');
    Route::get('/alat/{alat}/edit', [App\Http\Controllers\Admin\AlatController::class, 'edit'])->name('admin.alat.edit');
    Route::put('/alat/{alat}', [App\Http\Controllers\Admin\AlatController::class, 'update'])->name('admin.alat.update');
    Route::delete('/alat/{alat}', [App\Http\Controllers\Admin\AlatController::class, 'destroy'])->name('admin.alat.destroy');
});

require __DIR__.'/auth.php';
