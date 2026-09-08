@extends('layouts.app')

@section('title', 'Dashboard Utama')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold m-0 text-white">Ringkasan Sistem</h3>
</div>

<!-- Cards Stats (4 Modul Utama) -->
<div class="row g-3 mb-4">

    <!-- Pelanggan -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 rounded-3 border-start border-4" style="background-color: #0f172a; border-color: #f97316 !important;">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="small" style="color: #94a3b8;">Pelanggan</span>
                    <h4 class="fw-bold m-0 mt-1 text-white">0 Orang</h4>
                </div>
                <div class="rounded-3 p-2" style="background-color: rgba(249, 115, 22, 0.1); color: #f97316;">
                    <i class="bi bi-people fs-2"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Layanan -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 rounded-3 border-start border-4" style="background-color: #0f172a; border-color: #f97316 !important;">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="small" style="color: #94a3b8;">Total Layanan</span>
                    <h4 class="fw-bold m-0 mt-1 text-white">0 Layanan</h4>
                </div>
                <div class="rounded-3 p-2" style="background-color: rgba(249, 115, 22, 0.1); color: #f97316;">
                    <i class="bi bi-gear-wide-connected fs-2"></i>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Total Barang -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 rounded-3 border-start border-4" style="background-color: #0f172a; border-color: #f97316 !important;">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="small" style="color: #94a3b8;">Total Barang</span>
                    <h4 class="fw-bold m-0 mt-1 text-white">0 Item</h4>
                </div>
                <div class="rounded-3 p-2" style="background-color: rgba(249, 115, 22, 0.1); color: #f97316;">
                    <i class="bi bi-box-seam fs-2"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Transaksi -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 rounded-3 border-start border-4" style="background-color: #0f172a; border-color: #f97316 !important;">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="small" style="color: #94a3b8;">Transaksi</span>
                    <h4 class="fw-bold m-0 mt-1 text-white">0 Data</h4>
                </div>
                <div class="rounded-3 p-2" style="background-color: rgba(249, 115, 22, 0.1); color: #f97316;">
                    <i class="bi bi-cart-check fs-2"></i>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Welcome Card -->
<div class="card border-0 shadow-sm p-4 rounded-3" style="background-color: #0f172a; border: 1px solid #1e293b !important;">
    <h5 class="fw-bold text-white mb-2">Selamat Datang di Sistem Kelola Data!</h5>
    <p class="mb-0" style="color: #94a3b8;">
        Silakan pilih menu di sebelah kiri untuk mengelola data <strong style="color: #f97316;">Pelanggan</strong>, <strong style="color: #f97316;">Layanan</strong>, <strong style="color: #f97316;">Barang</strong>, maupun melakukan pencatatan <strong style="color: #f97316;">Transaksi</strong>.
    </p>
</div>
@endsection