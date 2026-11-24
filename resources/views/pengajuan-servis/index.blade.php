@extends('layouts.app')

@section('title', 'Pengajuan Servis')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold m-0 text-dark">Pengajuan Servis</h3>
        <p class="text-muted mb-0">Permintaan servis dari pelanggan untuk bengkel Anda.</p>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card card-seamless overflow-hidden">
    <div class="table-responsive">
        <table class="table table-seamless align-middle">
            <thead>
                <tr>
                    <th>Pelanggan</th>
                    <th>Perangkat</th>
                    <th>Keluhan / layanan</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengajuan as $item)
                    <tr>
                        <td>
                            <strong>{{ $item->pelanggan->name }}</strong>
                            @if($item->pelanggan->no_hp)
                                <div class="small text-muted">{{ $item->pelanggan->no_hp }}</div>
                            @endif
                        </td>
                        <td>
                            <strong>{{ $item->jenis_perangkat ?: 'Jenis belum dicatat' }}</strong>
                            <div class="small text-muted">{{ $item->nama_perangkat }}</div>
                        </td>
                        <td class="text-break">{{ $item->keluhan_kerusakan }}</td>
                        <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                        <td><span class="badge {{ $item->status === 'menunggu' ? 'text-bg-warning' : ($item->status === 'ditolak' ? 'text-bg-danger' : 'text-bg-success') }}">{{ ucfirst($item->status) }}</span></td>
                        <td>
                            @if($item->lokasi_jemput_latitude && $item->lokasi_jemput_longitude)
                                <a class="btn btn-outline-primary btn-sm mb-2" target="_blank" rel="noopener"
                                   href="https://www.google.com/maps/search/?api=1&query={{ $item->lokasi_jemput_latitude }},{{ $item->lokasi_jemput_longitude }}">
                                    <i class="bi bi-geo-alt me-1"></i>Lokasi jemput
                                </a>
                            @else
                                <span class="text-muted small d-block mb-2">Lokasi jemput tidak tersedia</span>
                            @endif
                            @if(in_array($item->status, ['menunggu', 'diproses']))
                                <form method="POST" action="{{ route('pengajuan-servis.update-status', $item) }}" class="d-flex gap-2">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" class="form-select form-select-sm" aria-label="Status pengajuan">
                                        <option value="diproses" {{ $item->status === 'diproses' ? 'selected' : '' }}>Diproses</option>
                                        <option value="selesai">Selesai</option>
                                        <option value="ditolak">Ditolak</option>
                                    </select>
                                    <button class="btn btn-orange btn-sm">Simpan</button>
                                </form>
                            @else
                                <span class="text-muted small">Tidak ada aksi</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center py-4 text-muted">Belum ada pengajuan servis.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
