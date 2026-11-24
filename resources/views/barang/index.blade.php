@extends('layouts.app')

@section('title', 'Data Barang')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold m-0 text-dark">Data Barang / Sparepart</h3>
    <a href="{{ route('barang.create') }}" class="btn btn-orange px-3 py-2 rounded-3 shadow-sm">
        <i class="bi bi-plus-lg me-1"></i> Tambah Barang
    </a>
</div>

<div class="card card-seamless overflow-hidden">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-seamless align-middle">
                <thead>
                    <tr>
                        <th width="5%" class="text-center">No</th>
                        <th>Nama Barang</th>
                        <th>Stok</th>
                        <th>Harga</th>
                        <th width="150" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($barang as $item)
                    <tr>
                        <td class="text-center fw-semibold">{{ $loop->iteration }}</td>
                        <td class="fw-bold text-dark">{{ $item->nama_barang }}</td>
                        <td><span class="badge bg-light text-dark border">{{ $item->stok }} Pcs</span></td>
                        <td class="fw-bold text-orange">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-1">
                                <a href="{{ route('barang.edit', $item->id) }}" class="btn btn-sm btn-warning text-white fw-semibold px-2 py-1">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ route('barang.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus barang ini?')">
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
                        <td colspan="5" class="text-center py-4 text-muted">Belum ada data barang.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection