<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\TransaksiController;

/*
|--------------------------------------------------------------------------
| Web Routes (Laravel 7 - Manual Routing dengan Middleware)
|--------------------------------------------------------------------------
*/

// Redirect Halaman Utama ke Login
Route::get('/', function () {
    return redirect()->route('login');
});

// ------------------------------------------------------------------------
// 1. ROUTE GUEST (Hanya bisa diakses kalau BELUM login)
// ------------------------------------------------------------------------
Route::middleware('guest')->group(function () {
    // Auth Login
    Route::get('/login', 'AuthController@showLoginForm')->name('login');
    Route::post('/login', 'AuthController@login')->name('login.post');

    // Auth Registrasi
    Route::get('/register', 'AuthController@showRegisterForm')->name('register');
    Route::post('/register', 'AuthController@register')->name('register.post');
});

// ------------------------------------------------------------------------
// 2. ROUTE AUTH UMUM (Bisa diakses SEMUA User yang sudah Login)
// ------------------------------------------------------------------------
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', 'AuthController@logout')->name('logout');

    // Dashboard Pengguna/User Umum
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// ------------------------------------------------------------------------
// 3. ROUTE KHUSUS (Hanya ADMIN & TEKNISI)
// ------------------------------------------------------------------------
Route::middleware(['auth', 'role:admin,teknisi'])->group(function () {

    // --- PELANGGAN ---
    Route::get('/pelanggan', 'PelangganController@index')->name('pelanggan.index');
    Route::get('/pelanggan/create', 'PelangganController@create')->name('pelanggan.create');
    Route::post('/pelanggan', 'PelangganController@store')->name('pelanggan.store');
    Route::get('/pelanggan/{pelanggan}/edit', 'PelangganController@edit')->name('pelanggan.edit');
    Route::put('/pelanggan/{pelanggan}', 'PelangganController@update')->name('pelanggan.update');
    Route::delete('/pelanggan/{pelanggan}', 'PelangganController@destroy')->name('pelanggan.destroy');

    // --- LAYANAN ---
    Route::get('/layanan', 'LayananController@index')->name('layanan.index');
    Route::get('/layanan/create', 'LayananController@create')->name('layanan.create');
    Route::post('/layanan', 'LayananController@store')->name('layanan.store');
    Route::get('/layanan/{layanan}/edit', 'LayananController@edit')->name('layanan.edit');
    Route::put('/layanan/{layanan}', 'LayananController@update')->name('layanan.update');
    Route::delete('/layanan/{layanan}', 'LayananController@destroy')->name('layanan.destroy');

    // --- BARANG (SPAREPART) ---
    Route::get('/barang', 'BarangController@index')->name('barang.index');
    Route::get('/barang/create', 'BarangController@create')->name('barang.create');
    Route::post('/barang', 'BarangController@store')->name('barang.store');
    Route::get('/barang/{barang}/edit', 'BarangController@edit')->name('barang.edit');
    Route::put('/barang/{barang}', 'BarangController@update')->name('barang.update');
    Route::delete('/barang/{barang}', 'BarangController@destroy')->name('barang.destroy');

    // --- TRANSAKSI ---
    Route::get('/transaksi', 'TransaksiController@index')->name('transaksi.index');
    Route::get('/transaksi/create', 'TransaksiController@create')->name('transaksi.create');
    Route::post('/transaksi', 'TransaksiController@store')->name('transaksi.store');
    Route::get('/transaksi/{transaksi}', 'TransaksiController@show')->name('transaksi.show');
    Route::get('/transaksi/{transaksi}/edit', 'TransaksiController@edit')->name('transaksi.edit');
    Route::put('/transaksi/{transaksi}', 'TransaksiController@update')->name('transaksi.update');
    Route::delete('/transaksi/{transaksi}', 'TransaksiController@destroy')->name('transaksi.destroy');
    Route::patch('/transaksi/{transaksi}/update-status', 'TransaksiController@updateStatus')->name('transaksi.update-status');

});