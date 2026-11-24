
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Bengkel - BengkelKu</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        body {
            background: #f8fafc;
        }

        .top {
            background: #f97316;
        }

        .card {
            border: none;
            border-radius: 12px;
        }

        .judul {
            font-weight: 700;
            color: #1e293b;
        }

        .label-data {
            color: #64748b;
            font-size: 14px;
        }
    </style>
</head>

<body>

<nav class="navbar top">
    <div class="container">
        <a href="{{ route('admin.bengkel.index') }}"
           class="navbar-brand text-white fw-bold">
            BengkelKu · Admin
        </a>

        <a href="{{ route('admin.bengkel.index') }}"
           class="btn btn-light btn-sm">
            Kembali
        </a>
    </div>
</nav>

<div class="container py-5">

    <div class="mb-4">
        <h2 class="judul">Detail Pendaftaran Bengkel</h2>
        <p class="text-muted">
            Periksa informasi pemilik dan data bengkel sebelum memberikan keputusan.
        </p>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm mb-4">
        <div class="card-body p-4">

            <div class="d-flex justify-content-between mb-4">
                <h5 class="fw-bold">Informasi Pemilik</h5>

                @if($bengkel->status_bengkel == 'approved')
                    <span class="badge bg-success">Disetujui</span>
                @elseif($bengkel->status_bengkel == 'rejected')
                    <span class="badge bg-danger">Ditolak</span>
                @else
                    <span class="badge bg-warning text-dark">Menunggu</span>
                @endif
            </div>

            <div class="row mb-3">
                <div class="col-md-4 label-data">Nama Pemilik</div>
                <div class="col-md-8 fw-semibold">
                    {{ $bengkel->name }}
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 label-data">Email</div>
                <div class="col-md-8">
                    {{ $bengkel->email }}
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 label-data">Nomor HP</div>
                <div class="col-md-8">
                    {{ $bengkel->no_hp ?? '-' }}
                </div>
            </div>

            <hr>

            <h5 class="fw-bold mb-4">Informasi Bengkel</h5>

            <div class="row mb-3">
                <div class="col-md-4 label-data">Nama Bengkel</div>
                <div class="col-md-8 fw-semibold">
                    {{ $bengkel->nama_bengkel ?? '-' }}
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 label-data">Alamat Bengkel</div>
                <div class="col-md-8">
                    {{ $bengkel->alamat ?? '-' }}
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 label-data">Latitude</div>
                <div class="col-md-8">
                    {{ $bengkel->latitude ?? '-' }}
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 label-data">Longitude</div>
                <div class="col-md-8">
                    {{ $bengkel->longitude ?? '-' }}
                </div>
            </div>

            <hr>

            <h5 class="fw-bold mb-3">Keputusan Admin</h5>

            @if($bengkel->status_bengkel == 'pending')

                <p class="text-muted">
                    Apakah kamu yakin ingin menyetujui atau menolak pendaftaran bengkel ini?
                </p>

                <div class="d-flex gap-2">

                    <form method="POST"
                          action="{{ route('admin.bengkel.status', $bengkel->id) }}"
                          onsubmit="return confirm('Yakin ingin menyetujui bengkel ini?')">
                        @csrf
                        @method('PATCH')

                        <input type="hidden"
                               name="status_bengkel"
                               value="approved">

                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-circle"></i>
                            Setujui Bengkel
                        </button>
                    </form>

                    <form method="POST"
                          action="{{ route('admin.bengkel.status', $bengkel->id) }}"
                          onsubmit="return confirm('Yakin ingin menolak bengkel ini?')">
                        @csrf
                        @method('PATCH')

                        <input type="hidden"
                               name="status_bengkel"
                               value="rejected">

                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-x-circle"></i>
                            Tolak Bengkel
                        </button>
                    </form>

                </div>

            @else

                <div class="alert alert-info mb-0">
                    Pendaftaran bengkel ini sudah memiliki keputusan.
                </div>

            @endif

        </div>
    </div>

</div>

</body>
</html>
