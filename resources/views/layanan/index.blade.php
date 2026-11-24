@extends('layouts.app')

@section('title', 'Data Layanan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold m-0 text-dark">Data Layanan / Jasa</h3>
    <a href="{{ route('layanan.create') }}" class="btn btn-orange px-3 py-2 rounded-3 shadow-sm">
        <i class="bi bi-plus-lg me-1"></i> Tambah Layanan
    </a>
</div>

<div class="card card-seamless overflow-hidden">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-seamless align-middle">
                <thead>
                    <tr>
                        <th width="5%" class="text-center">No</th>
                        <th>Nama Layanan</th>
                        <th>Deskripsi</th>
                        <th>Biaya Jasa</th>
                        <th width="150" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($layanan as $item)
                    <tr>
                        <td class="text-center fw-semibold">{{ $loop->iteration }}</td>
                        <td class="fw-bold text-dark">{{ $item->nama_layanan }}</td>
                        <td>{{ $item->deskripsi ?? '-' }}</td>
                        <td class="fw-bold text-orange">Rp {{ number_format($item->biaya_jasa, 0, ',', '.') }}</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-1">
                                <a href="{{ route('layanan.edit', $item->id) }}" class="btn btn-sm btn-warning text-white fw-semibold px-2 py-1">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ route('layanan.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus layanan ini?')">
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
                        <td colspan="5" class="text-center py-4 text-muted">Belum ada data layanan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection