<?php
use App\Http\Controllers\CustomerController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\SukuCadangController;
use App\Http\Controllers\PesananPerbaikanController;
use App\Http\Controllers\TransaksiController;


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
    return auth()->check() ? redirect()->route('pesanan.index') : redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('customers', CustomerController::class);

Route::middleware('auth')->group(function () {

    // Pelanggan
    Route::get('/pelanggan', [PelangganController::class, 'index'])->name('pelanggan.index');
    Route::get('/pelanggan/create', [PelangganController::class, 'create'])->name('pelanggan.create');
    Route::get('/pelanggan/{id}/edit', [PelangganController::class, 'edit'])->name('pelanggan.edit');
    
    Route::get('/suku-cadang', [SukuCadangController::class, 'index'])->name('suku-cadang.index');
    Route::get('/suku-cadang/create', [SukuCadangController::class, 'create'])->name('suku-cadang.create');
    Route::get('/suku-cadang/{id}/edit', [SukuCadangController::class, 'edit'])->name('suku-cadang.edit');
    Route::post('/suku-cadang/create', [SukuCadangController::class, 'store'])->name('suku-cadang.store');
    Route::put('/suku-cadang/{id}', [SukuCadangController::class, 'update'])->name('suku-cadang.update');
    Route::delete('/suku-cadang/{id}', [SukuCadangController::class, 'destroy'])->name('suku-cadang.destroy');



    // Pesanan Perbaikan
    Route::get('/pesanan', [PesananPerbaikanController::class, 'index'])->name('pesanan.index');
    Route::get('/pesananperbaikan', [PesananPerbaikanController::class, 'index'])->name('pesananperbaikan.index');
    Route::get('/pesanan/create', [PesananPerbaikanController::class, 'create'])->name('pesanan.create');
    Route::get('/pesanan/{id}/edit', [PesananPerbaikanController::class, 'edit'])->name('pesanan.edit');
    Route::get('/pesanan/{id}/show', [PesananPerbaikanController::class, 'show'])->name('pesanan.show');
    Route::post('/pesanan', [PesananPerbaikanController::class, 'store'])->name('pesanan.store');
    Route::put('/pesanan/{id}', [PesananPerbaikanController::class, 'update'])->name('pesanan.update');
    Route::delete('/pesanan/{id}', [PesananPerbaikanController::class, 'destroy'])->name('pesanan.destroy');
    Route::get('/pesanan/search', [PesananPerbaikanController::class, 'search'])->name('pesanan.search');




    // Transaksi
    Route::prefix('transaksi')->group(function () {
    Route::get('/', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('/create', [TransaksiController::class, 'create'])->name('transaksi.create');
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('/transaksi/create', [TransaksiController::class, 'create'])->name('transaksi.create');
    Route::post('/store', [TransaksiController::class, 'store'])->name('transaksi.store');
    Route::get('/{id}', [TransaksiController::class, 'show'])->name('transaksi.show');
    Route::get('/{id}/edit', [TransaksiController::class, 'edit'])->name('transaksi.edit');
    Route::get('/transaksi/{id}/detail-transaksi', [TransaksiController::class, 'show'])->name('transaksi.detail');
    Route::put('/{id}', [TransaksiController::class, 'update'])->name('transaksi.update');
    Route::delete('/{id}', [TransaksiController::class, 'destroy'])->name('transaksi.destroy');
});



    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
