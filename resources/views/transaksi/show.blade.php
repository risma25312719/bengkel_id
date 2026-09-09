@extends('layouts.app')

@section('title', 'Detail Transaksi')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold m-0 text-dark">Detail Transaksi</h3>
    <a href="{{ route('transaksi.index') }}" class="btn btn-outline-orange px-3 py-2 rounded-3">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
</div>

<div class="row g-4">
    <!-- Informasii Perangkat & Status -->
    <div class="col-md-8">
        <div class="card card-seamless p-4 mb-4">
            <div class="d-flex justify-content-between align-items-start mb-3 border-bottom pb-3">
                <div>
                    <span class="badge bg-warning text-dark fw-bold mb-2">{{ $transaksi->kode_transaksi }}</span>
                    <h4 class="fw-bold text-dark mb-1">{{ $transaksi->nama_perangkat }}</h4>
                    <p class="text-muted small m-0">
                        <i class="bi bi-calendar-event me-1"></i> {{ $transaksi->created_at->format('d F Y, H:i') }} WIB
                    </p>
                </div>
                <div class="text-end">
                    <span class="badge {{ $transaksi->status_bayar == 'lunas' ? 'bg-success' : 'bg-danger' }} fs-6 px-3 py-2 rounded-pill">
                        {{ ucfirst($transaksi->status_bayar) }}
                    </span>
                </div>
            </div>

            <div class="mb-3">
                <h6 class="fw-bold text-dark">Keluhan / Kerusakan:</h6>
                <div class="p-3 bg-light rounded-3 text-secondary">
                    {{ $transaksi->keluhan_kerusakan }}
                </div>
            </div>

            <!-- Detail Biaya Layanan & Barang -->
            <h6 class="fw-bold text-dark mb-2">Rincian Jasa & Sparepart:</h6>
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Item / Jasa</th>
                            <th width="15%" class="text-center">Jumlah</th>
                            <th width="25%" class="text-end">Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($transaksi->layanan)
                        <tr>
                            <td>
                                <strong>Jasa: {{ $transaksi->layanan->nama_layanan }}</strong>
                            </td>
                            <td class="text-center">1</td>
                            <td class="text-end">Rp {{ number_format($transaksi->layanan->biaya_jasa, 0, ',', '.') }}</td>
                        </tr>
                        @endif

                        @if($transaksi->barang)
                        <tr>
                            <td>
                                <strong>Sparepart: {{ $transaksi->barang->nama_barang }}</strong>
                            </td>
                            <td class="text-center">{{ $transaksi->jumlah_barang }}</td>
                            <td class="text-end">Rp {{ number_format($transaksi->barang->harga_jual * $transaksi->jumlah_barang, 0, ',', '.') }}</td>
                        </tr>
                        @endif
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="2" class="text-end fs-6">Total Biaya:</th>
                            <th class="text-end fs-5 text-orange fw-bold">
                                Rp {{ number_format($transaksi->total_biaya, 0, ',', '.') }}
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <!-- Informasi Pelanggan & Kasir -->
    <div class="col-md-4">
        <div class="card card-seamless p-4">
            <h5 class="fw-bold text-dark border-bottom pb-2 mb-3">Informasi Pelanggan</h5>
            <div class="mb-3">
                <span class="text-muted d-block small">Nama Pelanggan</span>
                <strong class="text-dark">{{ $transaksi->pelanggan->nama_pelanggan ?? '-' }}</strong>
            </div>
            <div class="mb-3">
                <span class="text-muted d-block small">No. HP</span>
                <strong class="text-dark">{{ $transaksi->pelanggan->no_hp ?? '-' }}</strong>
            </div>
            <div class="mb-3">
                <span class="text-muted d-block small">Alamat</span>
                <strong class="text-dark">{{ $transaksi->pelanggan->alamat ?? '-' }}</strong>
            </div>
            <hr>
            <div class="mb-0">
                <span class="text-muted d-block small">Petugas/Teknisi</span>
                <strong class="text-dark">{{ $transaksi->user->name ?? 'Admin' }}</strong>
            </div>
        </div>
    </div>
</div>
@endsection