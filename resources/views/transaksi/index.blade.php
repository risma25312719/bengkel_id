@extends('layouts.app')

@section('title', 'Data Transaksi')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold m-0 text-dark">Data Transaksi</h3>
    <a href="{{ route('transaksi.create') }}" class="btn btn-orange px-3 py-2 rounded-3 shadow-sm">
        <i class="bi bi-plus-lg me-1"></i> Tambah Transaksi
    </a>
</div>

<div class="card card-seamless overflow-hidden">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-seamless align-middle">
                <thead>
                    <tr>
                        <th width="5%" class="text-center">No</th>
                        <th>Kode Transaksi</th>
                        <th>Pelanggan</th>
                        <th>Total Bayar</th>
                        <th>Tanggal</th>
                        <th width="150" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transaksi as $item)
                    <tr>
                        <td class="text-center fw-semibold">{{ $loop->iteration }}</td>
                        <td class="fw-bold text-dark">{{ $item->kode_transaksi ?? 'TRX-'.$item->id }}</td>
                        <td>{{ $item->pelanggan->nama_pelanggan ?? '-' }}</td>
                        <td class="fw-bold text-orange">Rp {{ number_format($item->total_bayar, 0, ',', '.') }}</td>
                        <td>{{ $item->created_at->format('d/m/Y') }}</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-1">
                                <a href="{{ route('transaksi.show', $item->id) }}" class="btn btn-sm btn-info text-white fw-semibold px-2 py-1">
                                    <i class="bi bi-eye"></i> Detail
                                </a>
                                <form action="{{ route('transaksi.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus transaksi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger fw-semibold px-2 py-1">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">Belum ada data transaksi.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection