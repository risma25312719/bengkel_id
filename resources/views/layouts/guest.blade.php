
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BengkelKu - Servis Elektronik Terpercaya</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
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
            background-color: transparent;
        }

        .btn-outline-orange:hover {
            background-color: #f97316 !important;
            color: #ffffff !important;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg bg-white border-bottom py-3">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2 fw-bold text-dark" href="/">
            <i class="bi bi-tools text-orange fs-4"></i> BengkelKu
        </a>

        <div class="ms-auto d-flex gap-2">
            @if (Route::has('login'))
                @auth
                    @if (Auth::user()->role === 'admin')
                        <a href="{{ route('admin.bengkel.index') }}" class="btn btn-orange btn-sm px-3 rounded-2">
                            <i class="bi bi-speedometer2 me-1"></i> Dashboard Admin
                        </a>
                    @elseif (Auth::user()->role === 'pelanggan')
                        <a href="{{ route('pelanggan.status') }}" class="btn btn-orange btn-sm px-3 rounded-2">
                            <i class="bi bi-clock-history me-1"></i> Status Servis
                        </a>
                    @elseif (Auth::user()->role === 'teknisi' && Auth::user()->status_bengkel === 'approved')
                        <a href="{{ route('dashboard') }}" class="btn btn-orange btn-sm px-3 rounded-2">
                            <i class="bi bi-speedometer2 me-1"></i> Dashboard
                        </a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-orange btn-sm px-3 rounded-2">
                        Masuk
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-orange btn-sm px-3 rounded-2">
                            Daftar Bengkel
                        </a>
                    @endif
                @endauth
            @endif
        </div>
    </div>
</nav>

<main>
    @yield('content')
</main>

<footer class="bg-white border-top py-4 text-center text-muted small mt-5">
    <div class="container">
        <p class="m-0">&copy; {{ date('Y') }} BengkelKu. Platform Bengkel Elektronik Indonesia.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
