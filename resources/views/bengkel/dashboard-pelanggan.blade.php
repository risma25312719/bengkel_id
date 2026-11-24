<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $bengkel->nama_bengkel ?? $bengkel->name }} - Ajukan Servis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <style>
        body { background: #f5f7fb; color: #172033; }
        .portal-nav { background: #fff; border-bottom: 1px solid #e8edf4; }
        .portal-brand { color: #172033; text-decoration: none; font-weight: 800; }
        .portal-brand span { color: #f97316; }
        .portal-hero { background: linear-gradient(120deg, #172033, #283b5b); color: #fff; }
        .shop-icon { width: 58px; height: 58px; display: grid; place-items: center; border-radius: 16px; background: #fff7ed; color: #f97316; font-size: 1.7rem; }
        .portal-card { border: 1px solid #e8edf4; border-radius: 16px; }
        .form-control { padding: .8rem 1rem; border-color: #dce3ed; }
        .form-control:focus { border-color: #f97316; box-shadow: 0 0 0 .2rem #f9731626; }
        .btn-orange { background: #f97316; color: #fff; border: 0; }
        .btn-orange:hover { background: #ea580c; color: #fff; }
        #pickup-map { height: 340px; border-radius: 12px; z-index: 1; }
        .map-pin { display: block; width: 18px; height: 18px; border: 3px solid #fff; border-radius: 50%; box-shadow: 0 1px 5px #0008; }
        .map-pin-customer { background: #f97316; }
        .map-pin-shop { background: #2563eb; }
    </style>
</head>
<body>
    <nav class="navbar portal-nav py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <a class="portal-brand fs-5" href="{{ route('landing') }}">Bengkel<span>Ku</span></a>
            <div class="d-flex align-items-center gap-3">
                <span class="d-none d-sm-inline text-secondary small">Halo, {{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-outline-secondary btn-sm">Keluar</button>
                </form>
            </div>
        </div>
    </nav>

    <header class="portal-hero py-5">
        <div class="container py-2">
            <div class="d-flex align-items-center gap-3 mb-3">
                <div class="shop-icon"><i class="bi bi-shop"></i></div>
                <div>
                    <div class="small text-white-50">HALAMAN PELANGGAN</div>
                    <h1 class="h3 fw-bold mb-0">{{ $bengkel->nama_bengkel ?? $bengkel->name }}</h1>
                </div>
            </div>
            <p class="mb-0 text-white-50">Sampaikan keluhan perangkat Anda langsung ke bengkel pilihan.</p>
        </div>
    </header>

    <main class="container py-4 py-lg-5">
        <div class="row g-4 justify-content-center">
            <div class="col-lg-7">
                <section class="card portal-card shadow-sm">
                    <div class="card-body p-4 p-md-5">
                        <div class="mb-4">
                            <span class="badge rounded-pill text-bg-warning mb-2">Form pengajuan servis</span>
                            <h2 class="h4 fw-bold">Apa kendala perangkat Anda?</h2>
                            <p class="text-secondary mb-0">Pilih jenis perangkat dan tandai lokasi agar kurir dapat menjemputnya.</p>
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                                <div class="small mt-1">Lokasi jemput dan lokasi bengkel ditampilkan pada peta di bawah ini.</div>
                            </div>
                        @endif
                        @if($errors->any())
                            <div class="alert alert-danger">{{ $errors->first() }}</div>
                        @endif

                        <form method="POST" action="{{ route('pengajuan-servis.store', $bengkel) }}">
                            @csrf
                            <div class="mb-3">
                                <label for="jenis_perangkat" class="form-label fw-semibold">Jenis perangkat</label>
                                <select id="jenis_perangkat" name="jenis_perangkat" class="form-select" required>
                                    <option value="">Pilih jenis perangkat</option>
                                    @foreach(\App\Models\PengajuanServis::JENIS_PERANGKAT as $jenis)
                                        <option value="{{ $jenis }}" {{ old('jenis_perangkat', optional($pengajuanTerakhir)->jenis_perangkat) === $jenis ? 'selected' : '' }}>{{ $jenis }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="nama_perangkat" class="form-label fw-semibold">Merek / model perangkat</label>
                                <input id="nama_perangkat" name="nama_perangkat" class="form-control"
                                       value="{{ old('nama_perangkat') }}" placeholder="Contoh: Samsung 32 inci" required maxlength="255">
                            </div>
                            <div class="mb-3">
                                <label for="keluhan_kerusakan" class="form-label fw-semibold">Keluhan atau layanan yang dibutuhkan</label>
                                <textarea id="keluhan_kerusakan" name="keluhan_kerusakan" class="form-control" rows="5"
                                          placeholder="Contoh: TV tidak mau menyala sejak kemarin" required maxlength="5000">{{ old('keluhan_kerusakan') }}</textarea>
                            </div>
                            <div class="mb-4">
                                <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-2">
                                    <label class="form-label fw-semibold mb-0">Titik jemput perangkat</label>
                                    <button type="button" id="locate-customer" class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-crosshair me-1"></i>Gunakan lokasi saya
                                    </button>
                                </div>
                                <p class="small text-secondary mb-2">Kurir akan menjemput perangkat di titik ini. Tekan tombol lokasi saya atau klik peta untuk menandai lokasi.</p>
                                <div id="pickup-map" aria-label="Peta untuk memilih titik jemput dan melihat lokasi bengkel"></div>
                                <div class="d-flex flex-wrap gap-3 small mt-2">
                                    <span><i class="map-pin map-pin-customer d-inline-block align-middle me-1"></i>Lokasi jemput Anda</span>
                                    <span><i class="map-pin map-pin-shop d-inline-block align-middle me-1"></i>Lokasi bengkel</span>
                                </div>
                                <div id="map-message" class="small mt-2 text-secondary" role="status">Memuat peta...</div>
                                <input type="hidden" name="lokasi_jemput_latitude" id="lokasi_jemput_latitude"
                                       value="{{ old('lokasi_jemput_latitude', optional($pengajuanTerakhir)->lokasi_jemput_latitude) }}" required>
                                <input type="hidden" name="lokasi_jemput_longitude" id="lokasi_jemput_longitude"
                                       value="{{ old('lokasi_jemput_longitude', optional($pengajuanTerakhir)->lokasi_jemput_longitude) }}" required>
                                @if(!$bengkel->latitude || !$bengkel->longitude)
                                    <div class="alert alert-warning small mt-2 mb-0">Bengkel belum mengatur titik lokasinya. Peta tetap dapat menyimpan lokasi jemput, tetapi lokasi bengkel belum bisa ditampilkan.</div>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-orange btn-lg w-100 fw-semibold">
                                <i class="bi bi-send me-2"></i>Kirim Keluhan ke Bengkel
                            </button>
                        </form>
                        <div class="small text-secondary mt-3">
                            <i class="bi bi-info-circle me-1"></i>
                            Kurir mengambil perangkat dari lokasi jemput Anda. Setelah selesai diservis, perangkat dapat diambil di bengkel.
                        </div>
                    </div>
                </section>
            </div>

            <aside class="col-lg-4">
                <section class="card portal-card shadow-sm">
                    <div class="card-body p-4">
                        <h2 class="h6 fw-bold mb-3">Informasi Bengkel</h2>
                        <div class="d-flex gap-3 mb-3">
                            <i class="bi bi-person text-warning"></i>
                            <div><div class="small text-secondary">Pemilik</div><strong>{{ $bengkel->name }}</strong></div>
                        </div>
                        <div class="d-flex gap-3 mb-3">
                            <i class="bi bi-geo-alt text-warning"></i>
                            <div><div class="small text-secondary">Alamat</div><strong>{{ $bengkel->alamat ?: 'Alamat belum tersedia' }}</strong></div>
                        </div>
                        @if($bengkel->no_hp)
                            <div class="d-flex gap-3">
                                <i class="bi bi-telephone text-warning"></i>
                                <div><div class="small text-secondary">Telepon</div><strong>{{ $bengkel->no_hp }}</strong></div>
                            </div>
                        @endif
                        @if($bengkel->latitude && $bengkel->longitude)
                            <a class="btn btn-outline-secondary btn-sm mt-3 w-100" target="_blank" rel="noopener"
                               href="https://www.google.com/maps/search/?api=1&query={{ $bengkel->latitude }},{{ $bengkel->longitude }}">
                                <i class="bi bi-map me-1"></i>Buka lokasi bengkel
                            </a>
                        @endif
                        <hr>
                        <p class="small text-secondary mb-0"><i class="bi bi-shield-check text-success me-1"></i> Bengkel telah diverifikasi oleh BengkelKu.</p>
                    </div>
                </section>
                <a href="{{ route('landing') }}" class="btn btn-link text-decoration-none text-secondary mt-3">
                    <i class="bi bi-arrow-left me-1"></i>Kembali cari bengkel
                </a>
            </aside>
        </div>
    </main>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        (function () {
            const message = document.getElementById('map-message');
            const latitudeInput = document.getElementById('lokasi_jemput_latitude');
            const longitudeInput = document.getElementById('lokasi_jemput_longitude');
            const shopLatitude = @json($bengkel->latitude);
            const shopLongitude = @json($bengkel->longitude);
            const customerLatitude = latitudeInput.value ? Number(latitudeInput.value) : null;
            const customerLongitude = longitudeInput.value ? Number(longitudeInput.value) : null;

            if (!window.L) {
                message.textContent = 'Peta gagal dimuat. Periksa koneksi internet lalu muat ulang halaman.';
                message.classList.add('text-danger');
                return;
            }

            const shopPoint = shopLatitude !== null && shopLongitude !== null
                ? [Number(shopLatitude), Number(shopLongitude)]
                : null;
            const customerPoint = customerLatitude !== null && customerLongitude !== null
                ? [customerLatitude, customerLongitude]
                : null;
            const customerIcon = L.divIcon({
                className: '',
                html: '<span class="map-pin map-pin-customer"></span>',
                iconSize: [18, 18],
                iconAnchor: [9, 9]
            });
            const shopIcon = L.divIcon({
                className: '',
                html: '<span class="map-pin map-pin-shop"></span>',
                iconSize: [18, 18],
                iconAnchor: [9, 9]
            });
            const defaultCenter = shopPoint || [-2.5, 118];
            const map = L.map('pickup-map').setView(customerPoint || defaultCenter, shopPoint || customerPoint ? 13 : 5);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            let customerMarker = null;
            if (shopPoint) {
                L.marker(shopPoint, { icon: shopIcon }).addTo(map).bindPopup('<strong>Lokasi bengkel</strong>');
            }

            function setCustomerLocation(point, shouldPan) {
                latitudeInput.value = point[0].toFixed(7);
                longitudeInput.value = point[1].toFixed(7);

                if (customerMarker) {
                    customerMarker.setLatLng(point);
                } else {
                    customerMarker = L.marker(point, { draggable: true, icon: customerIcon }).addTo(map);
                    customerMarker.on('dragend', function (event) {
                        const position = event.target.getLatLng();
                        setCustomerLocation([position.lat, position.lng], false);
                    });
                }

                customerMarker.bindPopup('<strong>Lokasi jemput perangkat</strong>');
                message.textContent = 'Titik jemput sudah ditandai. Klik peta atau geser penanda untuk mengubahnya.';
                message.classList.remove('text-danger');
                if (shouldPan) {
                    map.setView(point, 15);
                }
            }

            if (customerPoint) {
                setCustomerLocation(customerPoint, false);
            }

            if (shopPoint && customerPoint) {
                map.fitBounds([shopPoint, customerPoint], { padding: [30, 30], maxZoom: 14 });
            } else if (shopPoint) {
                map.setView(shopPoint, 14);
            } else if (!customerPoint) {
                message.textContent = 'Klik peta atau gunakan tombol lokasi saya untuk menandai lokasi jemput.';
            }

            map.on('click', function (event) {
                setCustomerLocation([event.latlng.lat, event.latlng.lng], false);
            });

            document.getElementById('locate-customer').addEventListener('click', function () {
                if (!navigator.geolocation) {
                    message.textContent = 'Browser ini tidak mendukung fitur lokasi. Silakan tandai titik jemput dengan klik peta.';
                    message.classList.add('text-danger');
                    return;
                }

                message.textContent = 'Meminta izin lokasi dari browser...';
                navigator.geolocation.getCurrentPosition(function (position) {
                    setCustomerLocation([position.coords.latitude, position.coords.longitude], true);
                }, function (error) {
                    const errorMessages = {
                        1: 'Izin lokasi ditolak. Silakan izinkan akses lokasi atau tandai titik pada peta.',
                        2: 'Lokasi tidak tersedia. Silakan tandai titik jemput pada peta.',
                        3: 'Permintaan lokasi terlalu lama. Silakan coba lagi atau tandai titik pada peta.'
                    };
                    message.textContent = errorMessages[error.code] || 'Lokasi gagal didapatkan. Silakan tandai titik pada peta.';
                    message.classList.add('text-danger');
                }, { enableHighAccuracy: true, timeout: 10000, maximumAge: 60000 });
            });
        })();
    </script>
</body>
</html>
