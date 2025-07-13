<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\SukuCadangController;
use App\Http\Controllers\PesananPerbaikanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // Arahkan ke halaman login atau langsung ke daftar pelanggan jika sudah login
    return auth()->check() ? redirect()->route('pelanggan.index') : redirect()->route('login');
});

Route::middleware('auth')->group(function () {

    // Pelanggan
    Route::get('/pelanggan', [PelangganController::class, 'index'])->name('pelanggan.index');
    Route::get('/pelanggan/create', [PelangganController::class, 'create'])->name('pelanggan.create');
    Route::get('/pelanggan/{id}/edit', [PelangganController::class, 'edit'])->name('pelanggan.edit');
    
    // Suku Cadang
    Route::get('/suku-cadang', [SukuCadangController::class, 'index'])->name('suku-cadang.index');
    Route::get('/suku-cadang/create', [SukuCadangController::class, 'create'])->name('suku-cadang.create');
    Route::get('/suku-cadang/{id}/edit', [SukuCadangController::class, 'edit'])->name('suku-cadang.edit');

    // Pesanan Perbaikan
    Route::get('/pesanan', [PesananPerbaikanController::class, 'index'])->name('pesanan.index');
    Route::get('/pesanan/create', [PesananPerbaikanController::class, 'create'])->name('pesanan.create');
    Route::get('/pesanan/{id}/edit', [PesananPerbaikanController::class, 'edit'])->name('pesanan.edit');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
