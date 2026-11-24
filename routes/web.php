
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BengkelController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PengajuanServisController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\AdminBengkelController;
use App\Models\User;


// LANDING PAGE
Route::get('/', function () {
    $bengkelList = User::where('role', 'teknisi')
        ->where('status_bengkel', 'approved')
        ->latest()
        ->get();

    return view('landing', compact('bengkelList'));
})->name('landing');

// LOGIN DAN REGISTER
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');

    Route::get('/register-pelanggan', [AuthController::class, 'showCustomerRegisterForm'])->name('register.customer');
    Route::post('/register-pelanggan', [AuthController::class, 'registerCustomer'])->name('register.customer.post');
});


// LOGOUT
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});


// ADMIN
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/bengkel', [AdminBengkelController::class, 'index'])
            ->name('bengkel.index');

        Route::get('/bengkel/{bengkel}/detail', [AdminBengkelController::class, 'show'])
            ->name('bengkel.detail');

        Route::patch('/bengkel/{bengkel}/status', [AdminBengkelController::class, 'updateStatus'])
            ->name('bengkel.status');
    });


// DASHBOARD TEKNISI
Route::middleware(['auth', 'role:teknisi'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/pengajuan-servis', [PengajuanServisController::class, 'index'])
        ->name('pengajuan-servis.index');

    Route::patch('/pengajuan-servis/{pengajuanServis}', [PengajuanServisController::class, 'updateStatus'])
        ->name('pengajuan-servis.update-status');

    Route::get('/pelanggan', [PelangganController::class, 'index'])
        ->name('pelanggan.index');

    Route::get('/pelanggan/create', [PelangganController::class, 'create'])
        ->name('pelanggan.create');

    Route::post('/pelanggan', [PelangganController::class, 'store'])
        ->name('pelanggan.store');

    Route::get('/pelanggan/{pelanggan}/edit', [PelangganController::class, 'edit'])
        ->name('pelanggan.edit');

    Route::put('/pelanggan/{pelanggan}', [PelangganController::class, 'update'])
        ->name('pelanggan.update');

    Route::delete('/pelanggan/{pelanggan}', [PelangganController::class, 'destroy'])
        ->name('pelanggan.destroy');

    Route::resource('layanan', LayananController::class)->except(['show']);

    Route::resource('barang', BarangController::class)->except(['show']);

    Route::resource('transaksi', TransaksiController::class)->except(['store']);

    Route::post('/transaksi', [TransaksiController::class, 'store'])
        ->name('transaksi.store');

    Route::patch('/transaksi/{transaksi}/update-status', [TransaksiController::class, 'updateStatus'])
        ->name('transaksi.update-status');
});


// PELANGGAN
Route::middleware(['auth', 'role:pelanggan'])->group(function () {

    Route::get('/bengkel/{bengkel}/dashboard', [BengkelController::class, 'customerDashboard'])
        ->name('bengkel.dashboard');

    Route::post('/bengkel/{bengkel}/pengajuan-servis', [PengajuanServisController::class, 'store'])
        ->name('pengajuan-servis.store');

    Route::get('/status-servis', [PengajuanServisController::class, 'customerIndex'])
        ->name('pelanggan.status');
});
