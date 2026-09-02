@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="m-0">Buat Transaksi Servis Baru</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('transaksi.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Pelanggan</label>
                        <select name="pelanggan_id" class="form-select" required>
                            <option value="">-- Pilih Pelanggan --</option>
                            @foreach($pelanggan as $p)
                                <option value="{{ $p->id }}">{{ $p->nama_pelanggan }} ({{ $p->no_hp }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama Perangkat</label>
                        <input type="text" name="nama_perangkat" class="form-control" placeholder="Contoh: Laptop Asus ROG / TV Samsung 32 inch" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Keluhan Kerusakan</label>
                        <textarea name="keluhan_kerusakan" class="form-control" rows="3" required></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jenis Layanan (Opsional)</label>
                            <select name="layanan_id" class="form-select">
                                <option value="">-- Tanpa Layanan --</option>
                                @foreach($layanan as $l)
                                    <option value="{{ $l->id }}">{{ $l->nama_layanan }} (Rp {{ number_format($l->biaya_jasa, 0, ',', '.') }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Sparepart yang Digunakan (Opsional)</label>
                            <select name="barang_id" class="form-select">
                                <option value="">-- Tanpa Sparepart --</option>
                                @foreach($barang as $b)
                                    <option value="{{ $b->id }}">{{ $b->nama_barang }} - Stok: {{ $b->stok }} (Rp {{ number_format($b->harga_jual, 0, ',', '.') }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jumlah Sparepart</label>
                        <input type="number" name="jumlah_barang" class="form-control" value="1" min="1">
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Simpan Transaksi</button>
                    <a href="{{ route('transaksi.index') }}" class="btn btn-link w-100 mt-2 text-decoration-none text-muted">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection