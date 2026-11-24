
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verifikasi Bengkel - BengkelKu</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        body {
            background: #f8fafc;
        }

        .top {
            background: #f97316;
            color: #fff;
        }

        .card {
            border: 0;
            box-shadow: 0 4px 16px #0f172a0b;
            border-radius: 14px;
        }

        .btn-orange {
            background: #f97316;
            color: #fff;
        }

        .btn-orange:hover {
            background: #ea580c;
            color: #fff;
        }

        .table th {
            white-space: nowrap;
        }
    </style>
</head>

<body>

<nav class="navbar top">
    <div class="container">
        <a class="navbar-brand text-white fw-bold" href="/">
            BengkelKu · Admin
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-light btn-sm">Logout</button>
        </form>
    </div>
</nav>

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold">Verifikasi Bengkel</h2>
            <p class="text-muted mb-0">
                Periksa pendaftaran pemilik bengkel sebelum ditampilkan ke pelanggan.
            </p>
        </div>

        <span class="badge text-bg-warning">
            {{ $bengkelList->where('status_bengkel', 'pending')->count() }} Menunggu
        </span>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card">
        <div class="table-responsive">

            <table class="table align-middle mb-0">

                <thead class="table-light">
                    <tr>
                        <th>Nama Bengkel</th>
                        <th>Pemilik</th>
                        <th>Kontak</th>
                        <th>Alamat</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($bengkelList as $bengkel)

                    <tr>
                        <td class="fw-semibold">
                            {{ $bengkel->nama_bengkel }}
                        </td>

                        <td>
                            {{ $bengkel->name }}
                        </td>

                        <td>
                            {{ $bengkel->email }}
                            <br>
                            {{ $bengkel->no_hp }}
                        </td>

                        <td>
                            {{ $bengkel->alamat }}
                        </td>

                        <td>
                            @if($bengkel->status_bengkel === 'approved')
                                <span class="badge text-bg-success">
                                    Disetujui
                                </span>
                            @elseif($bengkel->status_bengkel === 'rejected')
                                <span class="badge text-bg-danger">
                                    Ditolak
                                </span>
                            @else
                                <span class="badge text-bg-warning">
                                    Menunggu
                                </span>
                            @endif
                        </td>

                        <td>
                            <a href="{{ route('admin.bengkel.detail', $bengkel->id) }}"
                               class="btn btn-primary btn-sm">
                                <i class="bi bi-eye"></i>
                                Detail
                            </a>
                        </td>
                    </tr>

                    @empty

                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            Belum ada pendaftaran bengkel.
                        </td>
                    </tr>

                    @endforelse

                </tbody>
            </table>

        </div>
    </div>

</div>

</body>
</html>
