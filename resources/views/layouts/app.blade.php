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
            background-color: #020617; /* Slate 950 */
            color: #f8fafc;
        }
        #wrapper {
            display: flex;
            width: 100%;
            align-items: stretch;
        }
        #sidebar {
            min-width: 250px;
            max-width: 250px;
            background: #0f172a; /* Slate 900 */
            color: #fff;
            transition: all 0.3s;
            min-height: 100vh;
            border-right: 1px solid #1e293b; /* Slate 800 */
        }
        #sidebar .sidebar-header {
            padding: 20px;
            background: #020617; /* Slate 950 */
            border-bottom: 1px solid #1e293b;
        }
        #sidebar ul.components {
            padding: 20px 0;
        }
        #sidebar ul li a {
            padding: 12px 20px;
            font-size: 0.95em;
            display: block;
            color: #94a3b8; /* Slate 400 */
            text-decoration: none;
            transition: all 0.2s;
        }
        #sidebar ul li a:hover, 
        #sidebar ul li.active > a {
            color: #fff;
            background: #f97316; /* Orange 500 */
        }
        #content {
            width: 100%;
            padding: 0;
            min-height: 100vh;
            background-color: #020617; /* Slate 950 */
        }
        .top-navbar {
            background-color: #0f172a !important; /* Slate 900 */
            border-bottom: 1px solid #1e293b !important; /* Slate 800 */
        }
        .btn-outline-orange {
            color: #f97316;
            border-color: #f97316;
        }
        .btn-outline-orange:hover {
            background-color: #f97316;
            color: #fff;
        }
    </style>
</head>
<body>

<div id="wrapper">
    <!-- Sidebar -->
    <nav id="sidebar">
        <div class="sidebar-header d-flex align-items-center gap-2">
            <i class="bi bi-wrench-adjustable fs-4 text-warning" style="color: #f97316 !important;"></i>
            <h5 class="m-0 fw-bold text-white">BengkelKu</h5>
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
        </ul>
    </nav>

    <!-- Page Content -->
    <div id="content">
        <!-- Top Navbar -->
        <nav class="navbar navbar-expand-lg top-navbar px-4 py-3">
            <div class="container-fluid p-0">
                <span class="navbar-text fw-semibold text-slate-400" style="color: #94a3b8;">
                    Panel Admin Bengkel
                </span>
                <div class="d-flex align-items-center gap-3 ms-auto">
                    <span class="fw-medium text-white"><i class="bi bi-person-circle me-1 text-warning" style="color: #f97316 !important;"></i> {{ Auth::user()->name ?? 'Admin' }}</span>
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