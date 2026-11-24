@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="m-0">Edit Transaksi ({{ $transaksi->kode_transaksi }})</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Pelanggan</label>
                        <select name="pelanggan_id" class="form-select" required>
                            @foreach($pelanggan as $p)
                                <option value="{{ $p->id }}" {{ $transaksi->pelanggan_id == $p->id ? 'selected' : '' }}>
                                    {{ $p->nama_pelanggan }} ({{ $p->no_hp }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama Perangkat</label>
                        <input type="text" name="nama_perangkat" class="form-control" value="{{ $transaksi->nama_perangkat }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Keluhan Kerusakan</label>
                        <textarea name="keluhan_kerusakan" class="form-control" rows="3" required>{{ $transaksi->keluhan_kerusakan }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jenis Layanan</label>
                            <select name="layanan_id" class="form-select">
                                <option value="">-- Tanpa Layanan --</option>
                                @foreach($layanan as $l)
                                    <option value="{{ $l->id }}" {{ $transaksi->layanan_id == $l->id ? 'selected' : '' }}>
                                        {{ $l->nama_layanan }} (Rp {{ number_format($l->biaya_jasa, 0, ',', '.') }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Sparepart yang Digunakan</label>
                            <select name="barang_id" class="form-select">
                                <option value="">-- Tanpa Sparepart --</option>
                                @foreach($barang as $b)
                                    <option value="{{ $b->id }}" {{ $transaksi->barang_id == $b->id ? 'selected' : '' }}>
                                        {{ $b->nama_barang }} (Rp {{ number_format($b->harga_jual, 0, ',', '.') }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Jumlah Sparepart</label>
                            <input type="number" name="jumlah_barang" class="form-control" value="{{ $transaksi->jumlah_barang }}" min="1">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Status Servis</label>
                            <select name="status_servis" class="form-select" required>
                                <option value="proses" {{ $transaksi->status_servis == 'proses' ? 'selected' : '' }}>Proses</option>
                                <option value="menunggu_sparepart" {{ $transaksi->status_servis == 'menunggu_sparepart' ? 'selected' : '' }}>Menunggu Sparepart</option>
                                <option value="selesai" {{ $transaksi->status_servis == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="batal" {{ $transaksi->status_servis == 'batal' ? 'selected' : '' }}>Batal</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Status Bayar</label>
                            <select name="status_bayar" class="form-select" required>
                                <option value="belum_bayar" {{ $transaksi->status_bayar == 'belum_bayar' ? 'selected' : '' }}>Belum Bayar</option>
                                <option value="lunas" {{ $transaksi->status_bayar == 'lunas' ? 'selected' : '' }}>Lunas</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-warning w-100">Perbarui Transaksi</button>
                    <a href="{{ route('transaksi.index') }}" class="btn btn-link w-100 mt-2 text-decoration-none text-muted">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection