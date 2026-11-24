<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BengkelKu - Cari Jasa Servis Elektronik</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
        }

        .bg-orange {
            background-color: #f97316 !important;
        }

        .text-orange {
            color: #f97316 !important;
        }

        .btn-orange {
            background-color: #f97316 !important;
            color: #ffffff !important;
            border: none !important;
        }

        .btn-orange:hover {
            background-color: #ea580c !important;
            color: #ffffff !important;
        }

        .btn-outline-orange {
            color: #f97316 !important;
            border-color: #f97316 !important;
        }

        .btn-outline-orange:hover {
            background-color: #f97316 !important;
            color: #ffffff !important;
        }

        .logo-bengkel-avatar {
            width: 50px;
            height: 50px;
            background-color: #fff7ed;
            color: #f97316;
            border: 2px solid #fed7aa;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: bold;
        }
    </style>
</head>

<body>

<!-- Header / Navbar -->
<nav class="navbar navbar-expand-lg bg-white border-bottom py-3">
    <div class="container">

        <a class="navbar-brand d-flex align-items-center gap-2 fw-bold text-dark fs-4" href="/">
            <div class="rounded-3 bg-orange text-white p-2 d-flex align-items-center justify-content-center"
                 style="width: 38px; height: 38px;">
                <i class="bi bi-wrench-adjustable fs-5"></i>
            </div>

            <span>Bengkel<span class="text-orange">Ku</span></span>
        </a>

        <div class="ms-auto d-flex gap-2">

            @if (Route::has('login'))
                @auth

                    @if(Auth::user()->role === 'admin')

                        <a href="{{ route('admin.bengkel.index') }}"
                           class="btn btn-orange btn-sm px-3 rounded-2 fw-semibold">
                            Dashboard Admin
                        </a>

                    @elseif(Auth::user()->role === 'teknisi')

                        @if(Auth::user()->status_bengkel === 'approved')
                            <a href="{{ route('dashboard') }}"
                               class="btn btn-orange btn-sm px-3 rounded-2 fw-semibold">
                                <i class="bi bi-speedometer2 me-1"></i>
                                Dashboard Bengkel
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                               class="btn btn-outline-orange btn-sm px-3 rounded-2 fw-semibold">
                                Menunggu Verifikasi
                            </a>
                        @endif

                    @else

                        <a href="{{ route('pelanggan.status') }}"
                           class="btn btn-orange btn-sm px-3 rounded-2 fw-semibold">
                            <i class="bi bi-clock-history me-1"></i>
                            Status Servis Saya
                        </a>

                    @endif

                @else

                    <a href="{{ route('login') }}"
                       class="btn btn-outline-orange btn-sm px-3 rounded-2 fw-semibold">
                        Masuk
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                           class="btn btn-orange btn-sm px-3 rounded-2 fw-semibold">
                            Daftarkan Bengkel
                        </a>
                    @endif

                @endauth
            @endif

        </div>
    </div>
</nav>

<!-- Hero Section -->
<div class="bg-orange text-white py-5 text-center shadow-sm">
    <div class="container py-4">

        <div class="mb-3">
            <span class="bg-white text-orange p-3 rounded-circle d-inline-flex align-items-center justify-content-center shadow-sm"
                  style="width: 70px; height: 70px;">
                <i class="bi bi-cpu-fill fs-2"></i>
            </span>
        </div>

        <h1 class="fw-bold display-5">
            Cari Jasa Servis Elektronik Terpercaya
        </h1>

        <p class="lead opacity-90">
            Temukan bengkel elektronik terdekat dan tepercaya di sekitar Anda.
        </p>

    </div>
</div>

<!-- Section Mitra Bengkel -->
<div class="container py-5">

    <div class="text-center mb-5">
        <h2 class="fw-bold text-dark">
            Mitra Bengkel Kami
        </h2>

        <p class="text-muted">
            Daftar bengkel elektronik yang sudah diverifikasi dan siap melayani Anda.
        </p>
    </div>

    <div class="row g-4" id="daftar-bengkel">

        @forelse ($bengkelList as $bengkel)

            <div class="col-md-4 bengkel-card"
                 data-lat="{{ $bengkel->latitude }}"
                 data-lng="{{ $bengkel->longitude }}">

                <div class="card h-100 border-0 shadow-sm rounded-3">

                    <div class="card-body p-4">

                        <div class="d-flex align-items-center gap-3 mb-3">

                            <div class="logo-bengkel-avatar flex-shrink-0">
                                <i class="bi bi-shop"></i>
                            </div>

                            <div class="overflow-hidden">

                                <h5 class="fw-bold text-dark m-0 text-truncate">
                                    {{ $bengkel->nama_bengkel ?? $bengkel->name }}
                                </h5>

                                <span class="badge bg-success small">
                                    <i class="bi bi-patch-check-fill me-1"></i>
                                    Mitra Aktif
                                </span>

                            </div>
                        </div>

                        <hr class="my-3">

                        <p class="text-muted small mb-2 text-truncate">
                            <i class="bi bi-geo-alt me-1 text-orange"></i>
                            {{ $bengkel->alamat ?? 'Alamat belum diatur' }}
                        </p>

                        <p class="text-muted small mb-0">
                            <i class="bi bi-person me-1 text-orange"></i>
                            Pemilik: {{ $bengkel->name }}
                        </p>

                    </div>

                    <div class="card-footer bg-white border-0 p-3 pt-0 d-flex gap-2">

                        <a href="{{ route('bengkel.dashboard', $bengkel) }}"
                           class="btn btn-orange w-100 btn-sm rounded-2 fw-semibold">

                            <i class="bi bi-wrench me-1"></i>
                            Pilih Bengkel Ini

                        </a>

                        @if(!empty($bengkel->no_hp))

                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $bengkel->no_hp) }}"
                               target="_blank"
                               rel="noopener noreferrer"
                               class="btn btn-outline-orange btn-sm rounded-2 fw-semibold"
                               title="Hubungi via WhatsApp">

                                <i class="bi bi-whatsapp"></i>

                            </a>

                        @endif

                    </div>
                </div>
            </div>

        @empty

            <div class="col-12 text-center py-5 text-muted">

                <i class="bi bi-shop-window fs-1 d-block mb-2 text-secondary"></i>

                <h5 class="fw-semibold">
                    Belum Ada Bengkel Terdaftar
                </h5>

                <p class="small text-muted">
                    Daftarkan akun bengkel Anda untuk tampil di halaman ini.
                </p>

            </div>

        @endforelse

    </div>
</div>

<!-- Tombol Pendaftaran -->
<div class="text-center mb-4">

    <a href="{{ route('register.customer') }}"
       class="btn btn-outline-orange me-2">
        Daftar sebagai Pelanggan
    </a>

    <a href="{{ route('register') }}"
       class="btn btn-orange">
        Daftarkan Bengkel Anda
    </a>

</div>

<!-- Footer -->
<footer class="bg-white border-top py-4 text-center text-muted small mt-5">

    <div class="container">
        <p class="m-0">
            &copy; {{ date('Y') }} BengkelKu. Platform Bengkel Elektronik Indonesia.
        </p>
    </div>

</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Urutkan Bengkel Berdasarkan Lokasi Terdekat -->
<script>
(function () {

    const container = document.getElementById('daftar-bengkel');

    if (!container || !navigator.geolocation) return;

    navigator.geolocation.getCurrentPosition(function (position) {

        const lat = position.coords.latitude;
        const lng = position.coords.longitude;

        const cards = Array.from(
            container.querySelectorAll('.bengkel-card')
        );

        const distance = (a, b, c, d) => {

            const rad = x => x * Math.PI / 180;

            const x = rad(c - a);
            const y = rad(d - b);

            const h =
                Math.sin(x / 2) ** 2 +
                Math.cos(rad(a)) *
                Math.cos(rad(c)) *
                Math.sin(y / 2) ** 2;

            return 6371 * 2 *
                Math.atan2(Math.sqrt(h), Math.sqrt(1 - h));
        };

        cards.sort((a, b) => {

            const aLat = parseFloat(a.dataset.lat);
            const aLng = parseFloat(a.dataset.lng);

            const bLat = parseFloat(b.dataset.lat);
            const bLng = parseFloat(b.dataset.lng);

            const da =
                Number.isFinite(aLat) && Number.isFinite(aLng)
                    ? distance(lat, lng, aLat, aLng)
                    : Infinity;

            const db =
                Number.isFinite(bLat) && Number.isFinite(bLng)
                    ? distance(lat, lng, bLat, bLng)
                    : Infinity;

            return da - db;
        });

        cards.forEach(card => container.appendChild(card));

    }, function () {
        // Jika izin lokasi ditolak, gunakan urutan default.
    });

})();
</script>

</body>
</html>
