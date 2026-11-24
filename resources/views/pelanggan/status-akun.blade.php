<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Status Pengajuan Servis - BengkelKu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar bg-white border-bottom">
        <div class="container">
            <a href="{{ route('landing') }}" class="navbar-brand fw-bold">BengkelKu</a>
            <div class="d-flex align-items-center gap-3">
                <span class="text-muted small">{{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-outline-secondary btn-sm">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <main class="container py-5">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <div>
                <h2 class="fw-bold mb-1">Status Pengajuan Servis</h2>
                <p class="text-muted mb-0">Pantau permintaan servis yang sudah Anda kirim.</p>
            </div>
            <a href="{{ route('landing') }}" class="btn text-white" style="background:#f97316">Cari Bengkel</a>
        </div>

        <div class="row g-3">
            @forelse($pengajuan as $item)
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start gap-2 mb-2">
                                <h5 class="fw-bold mb-0">{{ $item->jenis_perangkat ?: 'Perangkat' }}</h5>
                                <span class="badge {{ $item->status === 'menunggu' ? 'text-bg-warning' : ($item->status === 'ditolak' ? 'text-bg-danger' : 'text-bg-success') }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </div>
                            <p class="text-muted small mb-2">
                                Bengkel: <strong>{{ $item->bengkel->nama_bengkel ?? $item->bengkel->name }}</strong>
                            </p>
                            <p class="small text-muted mb-2">{{ $item->nama_perangkat }}</p>
                            <p class="mb-2">{{ $item->keluhan_kerusakan }}</p>
                            <small class="text-muted">Diajukan {{ $item->created_at->format('d/m/Y H:i') }}</small>
                            <div class="d-flex flex-wrap gap-2 mt-3">
                                @if($item->lokasi_jemput_latitude && $item->lokasi_jemput_longitude)
                                    <a class="btn btn-outline-primary btn-sm" target="_blank" rel="noopener"
                                       href="https://www.google.com/maps/search/?api=1&query={{ $item->lokasi_jemput_latitude }},{{ $item->lokasi_jemput_longitude }}">
                                        <i class="bi bi-geo-alt me-1"></i>Lokasi jemput kurir
                                    </a>
                                @endif
                                @if($item->bengkel->latitude && $item->bengkel->longitude)
                                    <a class="btn btn-outline-secondary btn-sm" target="_blank" rel="noopener"
                                       href="https://www.google.com/maps/search/?api=1&query={{ $item->bengkel->latitude }},{{ $item->bengkel->longitude }}">
                                        <i class="bi bi-shop me-1"></i>Lokasi bengkel
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body text-center py-5">
                            <p class="text-muted mb-3">Anda belum mengajukan servis ke bengkel mana pun.</p>
                            <a href="{{ route('landing') }}" class="btn text-white" style="background:#f97316">Pilih Bengkel</a>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </main>
</body>
</html>
