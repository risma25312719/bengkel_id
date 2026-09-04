<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>BengkelKu — Sistem Manajemen Bengkel</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        primary: '#F97316',
                        dark: '#111827',
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-slate-50 text-slate-800 font-sans antialiased">

    <!-- ================= NAVBAR ================= -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-md border-b border-slate-200">

        <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8">

            <div class="flex items-center justify-between h-20">

                <!-- LOGO -->
                <a href="/" class="flex items-center gap-3 group">

                    <div class="w-10 h-10 rounded-xl bg-orange-500 flex items-center justify-center shadow-lg shadow-orange-500/20 group-hover:scale-105 transition">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-5 h-5 text-white"
                             viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="2">

                            <path d="M14.7 6.3a4 4 0 0 0-5.4 5.4l-5.6 5.6a2 2 0 1 0 2.8 2.8l5.6-5.6a4 4 0 0 0 5.4-5.4l-2.2 2.2-2.8-2.8 2.2-2.2Z"/>
                            <path d="m14 14 6 6"/>

                        </svg>

                    </div>

                    <div>

                        <div class="text-xl font-extrabold text-slate-950 leading-none">
                            Bengkel<span class="text-orange-500">Ku</span>
                        </div>

                        <div class="text-[10px] uppercase tracking-[0.18em] text-slate-400 mt-1">
                            Management System
                        </div>

                    </div>

                </a>


                <!-- NAVIGATION -->
                <div class="hidden md:flex items-center gap-8">

                    <a href="#beranda"
                       class="text-sm font-medium text-slate-600 hover:text-orange-500 transition">
                        Beranda
                    </a>

                    <a href="#fitur"
                       class="text-sm font-medium text-slate-600 hover:text-orange-500 transition">
                        Fitur
                    </a>

                    <a href="#keunggulan"
                       class="text-sm font-medium text-slate-600 hover:text-orange-500 transition">
                        Keunggulan
                    </a>

                </div>


                <!-- AUTH -->
                <div class="flex items-center gap-3">

                    @auth

                        <a href="{{ route('dashboard') }}"
                           class="hidden sm:block text-sm font-semibold text-slate-600 hover:text-orange-500 transition">
                            Dashboard
                        </a>

                        <a href="{{ route('dashboard') }}"
                           class="bg-orange-500 hover:bg-orange-600 text-white text-sm font-semibold px-5 py-2.5 rounded-xl shadow-lg shadow-orange-500/20 transition hover:-translate-y-0.5">
                            Buka Sistem
                        </a>

                    @else

                        <a href="{{ route('login') }}"
                           class="hidden sm:block text-sm font-semibold text-slate-600 hover:text-orange-500 transition">
                            Masuk
                        </a>

                        <a href="{{ route('register') }}"
                           class="bg-orange-500 hover:bg-orange-600 text-white text-sm font-semibold px-5 py-2.5 rounded-xl shadow-lg shadow-orange-500/20 transition hover:-translate-y-0.5">
                            Daftar
                        </a>

                    @endauth

                </div>

            </div>

        </div>

    </nav>


    <!-- ================= HERO ================= -->
    <section id="beranda"
             class="relative overflow-hidden pt-32 pb-20 lg:pt-40 lg:pb-28 bg-white">

        <!-- BACKGROUND -->
        <div class="absolute -top-40 -right-40 w-[500px] h-[500px] bg-orange-100/70 rounded-full blur-3xl"></div>

        <div class="absolute -bottom-40 -left-40 w-[400px] h-[400px] bg-slate-200/60 rounded-full blur-3xl"></div>


        <div class="relative max-w-7xl mx-auto px-5 sm:px-6 lg:px-8">

            <div class="grid lg:grid-cols-2 gap-14 items-center">


                <!-- ================= HERO TEXT ================= -->
                <div>

                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-orange-50 border border-orange-100 text-orange-600 text-xs font-semibold mb-6">

                        <span class="w-2 h-2 bg-orange-500 rounded-full animate-pulse"></span>

                        SISTEM MANAJEMEN BENGKEL

                    </div>


                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-slate-950 leading-[1.08]">

                        Kelola Bengkel
                        <span class="text-orange-500">
                            Lebih Mudah
                        </span>

                    </h1>


                    <p class="mt-6 text-lg text-slate-600 leading-relaxed max-w-xl">

                        Satu sistem untuk mengelola pelanggan,
                        transaksi servis, sparepart, layanan,
                        dan berbagai kebutuhan operasional bengkel
                        secara terintegrasi.

                    </p>


                    <!-- BUTTON -->
                    <div class="mt-8 flex flex-col sm:flex-row gap-4">

                        @auth

                            <a href="{{ route('transaksi.index') }}"
                               class="inline-flex items-center justify-center gap-2 bg-orange-500 hover:bg-orange-600 text-white font-semibold px-6 py-3.5 rounded-xl shadow-xl shadow-orange-500/20 transition hover:-translate-y-1">

                                Kelola Transaksi

                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="w-5 h-5"
                                     viewBox="0 0 24 24"
                                     fill="none"
                                     stroke="currentColor"
                                     stroke-width="2">

                                    <path d="M5 12h14"/>
                                    <path d="m13 6 6 6-6 6"/>

                                </svg>

                            </a>

                        @else

                            <a href="{{ route('login') }}"
                               class="inline-flex items-center justify-center gap-2 bg-orange-500 hover:bg-orange-600 text-white font-semibold px-6 py-3.5 rounded-xl shadow-xl shadow-orange-500/20 transition hover:-translate-y-1">

                                Mulai Sekarang

                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="w-5 h-5"
                                     viewBox="0 0 24 24"
                                     fill="none"
                                     stroke="currentColor"
                                     stroke-width="2">

                                    <path d="M5 12h14"/>
                                    <path d="m13 6 6 6-6 6"/>

                                </svg>

                            </a>


                            <a href="#fitur"
                               class="inline-flex items-center justify-center border border-slate-300 hover:border-orange-300 hover:bg-orange-50 text-slate-700 font-semibold px-6 py-3.5 rounded-xl transition">

                                Lihat Fitur

                            </a>

                        @endauth

                    </div>


                    <!-- TRUST -->
                    <div class="mt-8 flex items-center gap-4">

                        <div class="flex -space-x-2">

                            <div class="w-9 h-9 rounded-full bg-orange-100 border-2 border-white flex items-center justify-center text-orange-600 text-xs font-bold">
                                B
                            </div>

                            <div class="w-9 h-9 rounded-full bg-slate-200 border-2 border-white flex items-center justify-center text-slate-700 text-xs font-bold">
                                K
                            </div>

                            <div class="w-9 h-9 rounded-full bg-slate-100 border-2 border-white flex items-center justify-center text-slate-600 text-xs font-bold">
                                +
                            </div>

                        </div>

                        <p class="text-sm text-slate-500">
                            Solusi digital untuk operasional bengkel
                        </p>

                    </div>

                </div>


                <!-- ================= DASHBOARD PREVIEW ================= -->
                <div class="relative">

                    <div class="absolute inset-0 bg-orange-500/10 blur-3xl rounded-full"></div>


                    <div class="relative bg-white rounded-3xl border border-slate-200 shadow-2xl shadow-slate-900/10 overflow-hidden">


                        <!-- BROWSER HEADER -->
                        <div class="h-12 bg-slate-50 border-b border-slate-200 flex items-center px-5 gap-2">

                            <span class="w-3 h-3 bg-red-300 rounded-full"></span>
                            <span class="w-3 h-3 bg-yellow-300 rounded-full"></span>
                            <span class="w-3 h-3 bg-green-300 rounded-full"></span>

                            <div class="ml-4 flex-1 h-7 bg-white border border-slate-200 rounded-lg"></div>

                        </div>


                        <!-- DASHBOARD -->
                        <div class="p-5 sm:p-7">


                            <div class="flex justify-between items-center mb-6">

                                <div>

                                    <p class="text-xs text-slate-400">
                                        Selamat datang kembali
                                    </p>

                                    <h3 class="text-xl font-bold text-slate-900">
                                        Dashboard Bengkel
                                    </h3>

                                </div>


                                <div class="w-10 h-10 rounded-xl bg-orange-50 flex items-center justify-center">

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="w-5 h-5 text-orange-500"
                                         viewBox="0 0 24 24"
                                         fill="none"
                                         stroke="currentColor"
                                         stroke-width="2">

                                        <path d="M3 3v18h18"/>
                                        <path d="m7 16 4-5 3 3 5-7"/>

                                    </svg>

                                </div>

                            </div>


                            <!-- STAT CARD -->
                            <div class="grid grid-cols-3 gap-3">


                                <div class="p-4 rounded-2xl bg-orange-50">

                                    <p class="text-xs text-slate-500">
                                        Pelanggan
                                    </p>

                                    <p class="text-xl font-bold text-slate-900 mt-1">
                                        248
                                    </p>

                                    <span class="text-[10px] text-orange-600 font-semibold">
                                        +12 bulan ini
                                    </span>

                                </div>


                                <div class="p-4 rounded-2xl bg-slate-100">

                                    <p class="text-xs text-slate-500">
                                        Servis
                                    </p>

                                    <p class="text-xl font-bold text-slate-900 mt-1">
                                        136
                                    </p>

                                    <span class="text-[10px] text-slate-600 font-semibold">
                                        Bulan ini
                                    </span>

                                </div>


                                <div class="p-4 rounded-2xl bg-amber-50">

                                    <p class="text-xs text-slate-500">
                                        Sparepart
                                    </p>

                                    <p class="text-xl font-bold text-slate-900 mt-1">
                                        524
                                    </p>

                                    <span class="text-[10px] text-amber-600 font-semibold">
                                        Item tersedia
                                    </span>

                                </div>

                            </div>


                            <!-- CHART -->
                            <div class="mt-5 p-5 rounded-2xl border border-slate-100">

                                <div class="flex justify-between items-center mb-5">

                                    <div>

                                        <p class="text-sm font-semibold text-slate-900">
                                            Aktivitas Servis
                                        </p>

                                        <p class="text-xs text-slate-400">
                                            Performa bulan berjalan
                                        </p>

                                    </div>

                                    <span class="text-xs font-semibold text-orange-500">
                                        +18.4%
                                    </span>

                                </div>


                                <div class="flex items-end gap-2 h-28">

                                    <div class="flex-1 bg-orange-100 rounded-t-lg h-[35%]"></div>

                                    <div class="flex-1 bg-orange-100 rounded-t-lg h-[52%]"></div>

                                    <div class="flex-1 bg-orange-200 rounded-t-lg h-[42%]"></div>

                                    <div class="flex-1 bg-orange-300 rounded-t-lg h-[68%]"></div>

                                    <div class="flex-1 bg-orange-400 rounded-t-lg h-[58%]"></div>

                                    <div class="flex-1 bg-orange-500 rounded-t-lg h-[82%]"></div>

                                    <div class="flex-1 bg-orange-600 rounded-t-lg h-full"></div>

                                </div>

                            </div>


                            <!-- TRANSAKSI -->
                            <div class="mt-5">

                                <div class="flex justify-between items-center mb-3">

                                    <p class="text-sm font-semibold text-slate-900">
                                        Transaksi Terbaru
                                    </p>

                                    <span class="text-xs text-orange-500 font-medium">
                                        Lihat semua
                                    </span>

                                </div>


                                <div class="flex items-center justify-between py-3 border-b border-slate-100">

                                    <div class="flex items-center gap-3">

                                        <div class="w-9 h-9 rounded-lg bg-slate-100 flex items-center justify-center text-xs font-bold text-slate-600">
                                            TR
                                        </div>

                                        <div>

                                            <p class="text-xs font-semibold text-slate-800">
                                                Servis & Ganti Oli
                                            </p>

                                            <p class="text-[10px] text-slate-400">
                                                Toyota Avanza
                                            </p>

                                        </div>

                                    </div>


                                    <span class="text-xs font-semibold text-emerald-600">
                                        Selesai
                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- ================= STATISTICS ================= -->
    <section class="bg-slate-950 py-10">

        <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8">

            <div class="grid grid-cols-2 lg:grid-cols-4 divide-x divide-slate-800">

                <div class="text-center px-5">

                    <p class="text-2xl sm:text-3xl font-bold text-white">
                        1 Sistem
                    </p>

                    <p class="text-xs sm:text-sm text-slate-400 mt-1">
                        Manajemen Terintegrasi
                    </p>

                </div>


                <div class="text-center px-5">

                    <p class="text-2xl sm:text-3xl font-bold text-orange-500">
                        4+
                    </p>

                    <p class="text-xs sm:text-sm text-slate-400 mt-1">
                        Modul Utama
                    </p>

                </div>


                <div class="text-center px-5 mt-6 lg:mt-0">

                    <p class="text-2xl sm:text-3xl font-bold text-white">
                        Real-Time
                    </p>

                    <p class="text-xs sm:text-sm text-slate-400 mt-1">
                        Pengelolaan Data
                    </p>

                </div>


                <div class="text-center px-5 mt-6 lg:mt-0">

                    <p class="text-2xl sm:text-3xl font-bold text-white">
                        Terorganisir
                    </p>

                    <p class="text-xs sm:text-sm text-slate-400 mt-1">
                        Data Bengkel
                    </p>

                </div>

            </div>

        </div>

    </section>


    <!-- ================= FEATURES ================= -->
    <section id="fitur" class="py-24 bg-slate-50">

        <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8">


            <div class="max-w-2xl mx-auto text-center mb-16">

                <span class="text-sm font-semibold text-orange-500 uppercase tracking-wider">
                    Fitur Utama
                </span>

                <h2 class="mt-3 text-3xl sm:text-4xl font-extrabold text-slate-900">
                    Semua yang Dibutuhkan Bengkel
                </h2>

                <p class="mt-4 text-slate-500 leading-relaxed">
                    Kelola aktivitas operasional bengkel dari satu tempat
                    dengan sistem yang sederhana, rapi, dan efisien.
                </p>

            </div>


            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">


                <!-- PELANGGAN -->
                <div class="group bg-white rounded-2xl border border-slate-200 p-7 hover:-translate-y-1 hover:border-orange-200 hover:shadow-xl hover:shadow-slate-900/5 transition">

                    <div class="w-12 h-12 rounded-xl bg-orange-50 flex items-center justify-center mb-6">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-6 h-6 text-orange-500"
                             viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="2">

                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"/>

                        </svg>

                    </div>


                    <h3 class="font-bold text-lg text-slate-900">
                        Data Pelanggan
                    </h3>

                    <p class="mt-3 text-sm text-slate-500 leading-relaxed">
                        Kelola data pelanggan dan informasi kendaraan
                        dengan lebih terstruktur.
                    </p>

                </div>


                <!-- LAYANAN -->
                <div class="group bg-white rounded-2xl border border-slate-200 p-7 hover:-translate-y-1 hover:border-orange-200 hover:shadow-xl hover:shadow-slate-900/5 transition">

                    <div class="w-12 h-12 rounded-xl bg-orange-50 flex items-center justify-center mb-6">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-6 h-6 text-orange-500"
                             viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="2">

                            <path d="M14.7 6.3a4 4 0 0 0-5.4 5.4l-5.6 5.6a2 2 0 1 0 2.8 2.8l5.6-5.6a4 4 0 0 0 5.4-5.4l-2.2 2.2-2.8-2.8 2.2-2.2Z"/>

                        </svg>

                    </div>


                    <h3 class="font-bold text-lg text-slate-900">
                        Layanan Servis
                    </h3>

                    <p class="mt-3 text-sm text-slate-500 leading-relaxed">
                        Atur berbagai jenis layanan servis kendaraan
                        sesuai kebutuhan bengkel.
                    </p>

                </div>


                <!-- SPAREPART -->
                <div class="group bg-white rounded-2xl border border-slate-200 p-7 hover:-translate-y-1 hover:border-orange-200 hover:shadow-xl hover:shadow-slate-900/5 transition">

                    <div class="w-12 h-12 rounded-xl bg-orange-50 flex items-center justify-center mb-6">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-6 h-6 text-orange-500"
                             viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="2">

                            <circle cx="12" cy="12" r="3"/>

                            <path d="M19.4 15a1.7 1.7 0 0 0 .34 1.88l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.7 1.7 0 0 0-1.88-.34 1.7 1.7 0 0 0-1 1.55V21a2 2 0 1 1-4 0v-.09a1.7 1.7 0 0 0-1-1.55 1.7 1.7 0 0 0-1.88.34l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06A1.7 1.7 0 0 0 4.6 15a1.7 1.7 0 0 0-1.55-1H3a2 2 0 1 1 0-4h.09a1.7 1.7 0 0 0 1.55-1 1.7 1.7 0 0 0-.34-1.88l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06A1.7 1.7 0 0 0 9 4.6a1.7 1.7 0 0 0 1-1.55V3a2 2 0 1 1 4 0v.09a1.7 1.7 0 0 0 1 1.55 1.7 1.7 0 0 0 1.88-.34l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06A1.7 1.7 0 0 0 19.4 9c.14.61.69 1 1.31 1H21a2 2 0 1 1 0 4h-.09c-.62 0-1.17.39-1.51 1Z"/>

                        </svg>

                    </div>


                    <h3 class="font-bold text-lg text-slate-900">
                        Stok Sparepart
                    </h3>

                    <p class="mt-3 text-sm text-slate-500 leading-relaxed">
                        Pantau ketersediaan sparepart dan barang
                        agar pengelolaan stok lebih mudah.
                    </p>

                </div>


                <!-- TRANSAKSI -->
                <div class="group bg-white rounded-2xl border border-slate-200 p-7 hover:-translate-y-1 hover:border-orange-200 hover:shadow-xl hover:shadow-slate-900/5 transition">

                    <div class="w-12 h-12 rounded-xl bg-orange-50 flex items-center justify-center mb-6">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-6 h-6 text-orange-500"
                             viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="2">

                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8Z"/>
                            <path d="M14 2v6h6"/>
                            <path d="M8 13h8"/>
                            <path d="M8 17h5"/>

                        </svg>

                    </div>


                    <h3 class="font-bold text-lg text-slate-900">
                        Transaksi
                    </h3>

                    <p class="mt-3 text-sm text-slate-500 leading-relaxed">
                        Catat transaksi servis dan sparepart secara
                        cepat dan terdokumentasi.
                    </p>

                </div>

            </div>

        </div>

    </section>


    <!-- ================= KEUNGGULAN ================= -->
    <section id="keunggulan" class="py-24 bg-white">

        <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8">

            <div class="grid lg:grid-cols-2 gap-16 items-center">


                <!-- VISUAL -->
                <div class="relative">

                    <div class="absolute -inset-4 bg-orange-50 rounded-3xl rotate-2"></div>


                    <div class="relative bg-slate-950 rounded-3xl p-8 sm:p-10 shadow-2xl">


                        <div class="flex items-center gap-3 mb-8">

                            <div class="w-10 h-10 rounded-xl bg-orange-500 flex items-center justify-center">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="w-5 h-5 text-white"
                                     viewBox="0 0 24 24"
                                     fill="none"
                                     stroke="currentColor"
                                     stroke-width="2">

                                    <path d="M14.7 6.3a4 4 0 0 0-5.4 5.4l-5.6 5.6a2 2 0 1 0 2.8 2.8l5.6-5.6a4 4 0 0 0 5.4-5.4l-2.2 2.2-2.8-2.8 2.2-2.2Z"/>

                                </svg>

                            </div>


                            <div>

                                <p class="text-white font-bold">
                                    BengkelKu
                                </p>

                                <p class="text-xs text-slate-500">
                                    Management Dashboard
                                </p>

                            </div>

                        </div>


                        <div class="space-y-4">


                            <div class="flex items-center justify-between p-4 rounded-xl bg-white/5 border border-white/10">

                                <div class="flex items-center gap-3">

                                    <div class="w-9 h-9 rounded-lg bg-orange-500/10 flex items-center justify-center text-orange-400">
                                        ✓
                                    </div>

                                    <span class="text-sm text-slate-300">
                                        Data Pelanggan
                                    </span>

                                </div>

                                <span class="text-xs text-emerald-400 font-semibold">
                                    Terorganisir
                                </span>

                            </div>


                            <div class="flex items-center justify-between p-4 rounded-xl bg-white/5 border border-white/10">

                                <div class="flex items-center gap-3">

                                    <div class="w-9 h-9 rounded-lg bg-orange-500/10 flex items-center justify-center text-orange-400">
                                        ✓
                                    </div>

                                    <span class="text-sm text-slate-300">
                                        Data Sparepart
                                    </span>

                                </div>

                                <span class="text-xs text-emerald-400 font-semibold">
                                    Tersedia
                                </span>

                            </div>


                            <div class="flex items-center justify-between p-4 rounded-xl bg-white/5 border border-white/10">

                                <div class="flex items-center gap-3">

                                    <div class="w-9 h-9 rounded-lg bg-orange-500/10 flex items-center justify-center text-orange-400">
                                        ✓
                                    </div>

                                    <span class="text-sm text-slate-300">
                                        Transaksi Servis
                                    </span>

                                </div>

                                <span class="text-xs text-emerald-400 font-semibold">
                                    Tercatat
                                </span>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- TEXT -->
                <div>

                    <span class="text-sm font-semibold text-orange-500 uppercase tracking-wider">
                        Mengapa BengkelKu?
                    </span>


                    <h2 class="mt-3 text-3xl sm:text-4xl font-extrabold text-slate-900 leading-tight">
                        Operasional Bengkel
                        Lebih Terstruktur
                    </h2>


                    <p class="mt-5 text-slate-500 leading-relaxed">
                        Tidak perlu lagi mengandalkan pencatatan manual
                        yang berantakan. BengkelKu membantu menyatukan
                        informasi penting bengkel dalam satu sistem.
                    </p>


                    <div class="mt-8 space-y-6">


                        <div class="flex gap-4">

                            <div class="flex-shrink-0 w-10 h-10 rounded-xl bg-orange-50 flex items-center justify-center text-orange-500 font-bold">
                                01
                            </div>

                            <div>

                                <h3 class="font-bold text-slate-900">
                                    Data Lebih Terorganisir
                                </h3>

                                <p class="text-sm text-slate-500 mt-1">
                                    Semua data pelanggan, layanan, barang,
                                    dan transaksi tersimpan secara terstruktur.
                                </p>

                            </div>

                        </div>


                        <div class="flex gap-4">

                            <div class="flex-shrink-0 w-10 h-10 rounded-xl bg-orange-50 flex items-center justify-center text-orange-500 font-bold">
                                02
                            </div>

                            <div>

                                <h3 class="font-bold text-slate-900">
                                    Proses Lebih Efisien
                                </h3>

                                <p class="text-sm text-slate-500 mt-1">
                                    Kurangi pekerjaan pencatatan manual
                                    dan percepat pengelolaan transaksi.
                                </p>

                            </div>

                        </div>


                        <div class="flex gap-4">

                            <div class="flex-shrink-0 w-10 h-10 rounded-xl bg-orange-50 flex items-center justify-center text-orange-500 font-bold">
                                03
                            </div>

                            <div>

                                <h3 class="font-bold text-slate-900">
                                    Informasi Mudah Dipantau
                                </h3>

                                <p class="text-sm text-slate-500 mt-1">
                                    Pantau kondisi operasional bengkel
                                    melalui dashboard yang informatif.
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- ================= CTA ================= -->
    <section class="py-20 bg-orange-500">

        <div class="max-w-4xl mx-auto px-5 text-center">

            <h2 class="text-3xl sm:text-4xl font-extrabold text-white">
                Siap Mengelola Bengkel dengan Lebih Baik?
            </h2>


            <p class="mt-4 text-orange-100 text-lg">
                Gunakan sistem yang membantu pekerjaan bengkel
                menjadi lebih rapi, cepat, dan terorganisir.
            </p>


            <div class="mt-8">

                @auth

                    <a href="{{ route('dashboard') }}"
                       class="inline-flex items-center gap-2 bg-slate-950 text-white hover:bg-slate-900 font-bold px-7 py-3.5 rounded-xl shadow-xl transition hover:-translate-y-1">

                        Masuk ke Dashboard

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-5 h-5"
                             viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="2">

                            <path d="M5 12h14"/>
                            <path d="m13 6 6 6-6 6"/>

                        </svg>

                    </a>

                @else

                    <a href="{{ route('register') }}"
                       class="inline-flex items-center gap-2 bg-slate-950 text-white hover:bg-slate-900 font-bold px-7 py-3.5 rounded-xl shadow-xl transition hover:-translate-y-1">

                        Mulai Menggunakan Sistem

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-5 h-5"
                             viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="2">

                            <path d="M5 12h14"/>
                            <path d="m13 6 6 6-6 6"/>

                        </svg>

                    </a>

                @endauth

            </div>

        </div>

    </section>


    <!-- ================= FOOTER ================= -->
    <footer class="bg-slate-950 text-slate-400">

        <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8 py-12">

            <div class="grid md:grid-cols-2 gap-8 items-center">


                <div>

                    <div class="flex items-center gap-3">

                        <div class="w-9 h-9 rounded-lg bg-orange-500 flex items-center justify-center">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-5 h-5 text-white"
                                 viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-width="2">

                                <path d="M14.7 6.3a4 4 0 0 0-5.4 5.4l-5.6 5.6a2 2 0 1 0 2.8 2.8l5.6-5.6a4 4 0 0 0 5.4-5.4l-2.2 2.2-2.8-2.8 2.2-2.2Z"/>

                            </svg>

                        </div>


                        <span class="text-lg font-bold text-white">
                            Bengkel<span class="text-orange-500">Ku</span>
                        </span>

                    </div>


                    <p class="mt-3 text-sm text-slate-500 max-w-md">
                        Sistem manajemen bengkel untuk membantu
                        mengelola operasional secara lebih terstruktur
                        dan efisien.
                    </p>

                </div>


                <div class="md:text-right">

                    <p class="text-sm text-slate-500">
                        &copy; {{ date('Y') }} BengkelKu Management System.
                    </p>

                    <p class="text-xs text-slate-600 mt-1">
                        All rights reserved.
                    </p>

                </div>

            </div>

        </div>

    </footer>

</body>
</html>
