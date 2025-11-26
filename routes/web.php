<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PemasokController;
use App\Http\Controllers\Admin\PenggunaController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\TransaksiController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('public.home');
})->name('home');

// Autentikasi
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
});

Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Halaman Admin
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::middleware('role:admin,operator')->group(function () {
        Route::resource('produk', ProdukController::class);
        Route::resource('pemasok', PemasokController::class);
        Route::resource('transaksi', TransaksiController::class);

        Route::post('pemasok/{pemasok}/barang', [PemasokController::class, 'storeBarang'])->name('pemasok.barang.store');
        Route::delete('pemasok/{pemasok}/barang/{barang}', [PemasokController::class, 'destroyBarang'])->name('pemasok.barang.destroy');
    });

    Route::middleware('role:admin')->resource('pengguna', PenggunaController::class);
});
