<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Admin')</title>
    
    <!-- Bootstrap 5 CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8fafc; /* Slate 50 (Putih Bersih) */
            color: #1e293b; /* Slate 800 */
        }
        #wrapper {
            display: flex;
            width: 100%;
            align-items: stretch;
        }
        #sidebar {
            min-width: 250px;
            max-width: 250px;
            background: #ffffff; /* Sidebar Putih */
            color: #1e293b;
            transition: all 0.3s;
            min-height: 100vh;
            border-right: 1px solid #e2e8f0; /* Slate 200 */
        }
        #sidebar .sidebar-header {
            padding: 20px;
            background: #ffffff;
            border-bottom: 1px solid #e2e8f0;
        }
        #sidebar ul.components {
            padding: 20px 0;
        }
        #sidebar ul li a {
            padding: 12px 20px;
            font-size: 0.95em;
            display: block;
            color: #64748b; /* Slate 500 */
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s;
        }
        #sidebar ul li a:hover, 
        #sidebar ul li.active > a {
            color: #f97316; /* Text Oranye */
            background: #fff7ed; /* Light Orange Tint */
            border-left: 4px solid #f97316; /* Aksen Border Oranye */
        }
        #content {
            width: 100%;
            padding: 0;
            min-height: 100vh;
            background-color: #f8fafc;
        }
        .top-navbar {
            background-color: #ffffff !important; /* Navbar Putih */
            border-bottom: 1px solid #e2e8f0 !important;
        }

        /* --- STYLES CARD & TABEL TEMA PUTIH ORANYE --- */
        
        /* Card Container Putih dengan Shadow Halus & Border Oranye */
        .card-seamless {
            background-color: #ffffff !important;
            border: 1px solid #fed7aa !important; /* Orange Border Light */
            border-radius: 12px !important;
            box-shadow: 0 4px 6px -1px rgba(249, 115, 22, 0.06) !important;
        }

        /* Tabel Terang Tema Oranye */
        .table-seamless {
            color: #334155 !important;
            margin-bottom: 0 !important;
        }

        .table-seamless thead th {
            background-color: #fff7ed !important; /* Oranye Soft Light */
            color: #c2410c !important; /* Text Header Oranye Pekat */
            border-bottom: 2px solid #fdba74 !important;
            font-size: 0.85rem;
            font-weight: 600;
            letter-spacing: 0.03em;
            padding: 14px 16px !important;
        }

        .table-seamless tbody tr {
            border-bottom: 1px solid #f1f5f9 !important;
            transition: background-color 0.2s ease;
        }

        .table-seamless tbody tr:hover {
            background-color: #fff7ed/60 !important; /* Hover Effect Oranye Soft */
        }

        .table-seamless td {
            color: #334155 !important;
            padding: 14px 16px !important;
            vertical-align: middle;
            background-color: transparent !important;
        }

        /* Tombol Utama Oranye */
        .btn-orange {
            background-color: #f97316 !important;
            color: #ffffff !important;
            border: none !important;
            font-weight: 500;
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

        /* Tombol Edit Soft Oranye */
        .btn-orange-soft {
            background-color: #ffedd5 !important;
            color: #c2410c !important;
            border: 1px solid #fed7aa !important;
        }
        .btn-orange-soft:hover {
            background-color: #f97316 !important;
            color: #ffffff !important;
        }

        /* Tombol Hapus Soft Merah */
        .btn-danger-soft {
            background-color: #fee2e2 !important;
            color: #dc2626 !important;
            border: 1px solid #fca5a5 !important;
        }
        .btn-danger-soft:hover {
            background-color: #ef4444 !important;
            color: #ffffff !important;
        }
    </style>
</head>
<body>

<div id="wrapper">
    <!-- Sidebar -->
    <nav id="sidebar">
        <div class="sidebar-header d-flex align-items-center gap-2">
            <i class="bi bi-wrench-adjustable fs-4" style="color: #f97316 !important;"></i>
            <h5 class="m-0 fw-bold" style="color: #0f172a;">BengkelKu</h5>
        </div>

        <ul class="list-unstyled components">
            <li class="{{ request()->is('dashboard*') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a>
            </li>
            <li class="{{ request()->is('pelanggan*') ? 'active' : '' }}">
                <a href="{{ route('pelanggan.index') }}"><i class="bi bi-people me-2"></i> Pelanggan</a>
            </li>
            <li class="{{ request()->is('layanan*') ? 'active' : '' }}">
                <a href="{{ route('layanan.index') }}"><i class="bi bi-gear-wide-connected me-2"></i> Layanan</a>
            </li>
            <li class="{{ request()->is('barang*') ? 'active' : '' }}">
                <a href="{{ route('barang.index') }}"><i class="bi bi-box-seam me-2"></i> Barang</a>
            </li>
            <li class="{{ request()->is('transaksi*') ? 'active' : '' }}">
                <a href="{{ route('transaksi.index') }}"><i class="bi bi-cart-check me-2"></i> Transaksi</a>
            </li>
            @if(Auth::user()->role === 'teknisi')
                <li class="{{ request()->is('pengajuan-servis*') ? 'active' : '' }}">
                    <a href="{{ route('pengajuan-servis.index') }}"><i class="bi bi-inbox me-2"></i> Pengajuan Servis</a>
                </li>
            @endif
        </ul>
    </nav>

    <!-- Page Content -->
    <div id="content">
        <!-- Top Navbar -->
        <nav class="navbar navbar-expand-lg top-navbar px-4 py-3">
            <div class="container-fluid p-0">
                <span class="navbar-text fw-semibold" style="color: #64748b;">
                    Panel Admin Bengkel
                </span>
                <div class="d-flex align-items-center gap-3 ms-auto">
                    <span class="fw-medium" style="color: #1e293b;"><i class="bi bi-person-circle me-1" style="color: #f97316 !important;"></i> {{ Auth::user()->name ?? 'Admin' }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-orange btn-sm">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </nav>

        <!-- Main Body Content -->
        <div class="container-fluid p-4">
            @yield('content')
        </div>
    </div>
</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>