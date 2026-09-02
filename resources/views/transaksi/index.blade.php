@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Daftar Transaksi Servis</h3>
    <a href="{{ route('transaksi.create') }}" class="btn btn-primary">+ Buat Transaksi Baru</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-striped table-hover m-0">
            <thead>
                <tr>
                    <th>Kode TRX</th>
                    <th>Pelanggan</th>
                    <th>Perangkat</th>
                    <th>Total Biaya</th>
                    <th>Status Servis</th>
                    <th>Status Bayar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transaksi as $item)
                <tr>
                    <td><code>{{ $item->kode_transaksi }}</code></td>
                    <td>{{ $item->pelanggan->nama_pelanggan ?? '-' }}</td>
                    <td>{{ $item->nama_perangkat }}</td>
                    <td>Rp {{ number_format($item->total_biaya, 0, ',', '.') }}</td>
                    <td>
                        <span class="badge bg-info text-dark">{{ strtoupper(str_replace('_', ' ', $item->status_servis)) }}</span>
                    </td>
                    <td>
                        <span class="badge {{ $item->status_bayar === 'lunas' ? 'bg-success' : 'bg-warning text-dark' }}">
                            {{ strtoupper(str_replace('_', ' ', $item->status_bayar)) }}
                        </span>
                    </td>
                    <td>
                        <!-- Form cepat update status -->
                        <form action="{{ route('transaksi.update-status', $item->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status_servis" value="selesai">
                            <input type="hidden" name="status_bayar" value="lunas">
                            <button class="btn btn-sm btn-outline-success" onclick="return confirm('Tandai transaksi ini Selesai & Lunas?')">Selesai</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">Belum ada transaksi servis.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection