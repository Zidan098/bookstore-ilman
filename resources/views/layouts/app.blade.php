<!DOCTYPE html>
<html lang="id" data-theme="corporate">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Bacabuku - Toko Buku Online Terlengkap' }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col bg-slate-50 text-slate-800 antialiased">

    <!-- Top Utility Bar -->
    <header class="border-b border-slate-200 bg-white">
        <div class="bg-primary text-primary-content text-xs py-2 px-4">
            <div class="max-w-7xl mx-auto flex flex-col sm:flex-row justify-between items-center gap-1">
                <div class="flex items-center gap-2">
                    <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-semibold bg-white/20">INFO</span>
                    <span>Toko Buku Online Terpercaya — Uji Kompetensi Keahlian (UKK) RPL</span>
                </div>
                <div class="flex items-center gap-4 text-xs opacity-90">
                    <span>Layanan: 08:00 - 20:00 WIB</span>
                    <span class="hidden md:inline">|</span>
                    <span class="hidden md:inline">WhatsApp: 0812-3456-7890</span>
                </div>
            </div>
        </div>

        <!-- Main Header Bar -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3.5">
            <div class="flex items-center justify-between gap-4">
                <!-- Brand Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
                    <div class="w-10 h-10 rounded-lg bg-primary text-primary-content flex items-center justify-center shadow-sm group-hover:scale-105 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <div>
                        <span class="text-2xl font-extrabold tracking-tight text-primary">Baca<span class="text-slate-900">buku</span></span>
                        <span class="block text-[11px] font-medium text-slate-500 -mt-1 tracking-wide">Toko Buku & Referensi Edukasi</span>
                    </div>
                </a>

                <!-- Search Bar -->
                <div class="hidden md:flex flex-1 max-w-xl mx-4">
                    <form action="{{ route('books.index') }}" method="GET" class="w-full">
                        <div class="join w-full">
                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Cari judul buku, penulis, atau penerbit..."
                                class="input input-bordered input-sm join-item w-full bg-white focus:outline-primary"
                            />
                            <button type="submit" class="btn btn-primary btn-sm join-item px-5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                                <span>Cari</span>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Right Actions: Cart & User -->
                <div class="flex items-center gap-3">
                    <!-- Cart Button -->
                    @php
                        $cartItems = session('cart', []);
                        $cartCount = 0;
                        foreach($cartItems as $item) {
                            $cartCount += $item['qty'] ?? 1;
                        }
                    @endphp
                    <a href="{{ route('cart.index') }}" class="btn btn-sm btn-ghost border border-slate-200 hover:border-primary gap-2 relative bg-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <span class="hidden sm:inline font-medium text-xs">Keranjang</span>
                        @if($cartCount > 0)
                            <span class="badge badge-primary badge-sm font-bold">{{ $cartCount }}</span>
                        @else
                            <span class="badge badge-ghost badge-sm text-slate-400">0</span>
                        @endif
                    </a>

                    <!-- Auth State -->
                    @auth
                        <div class="dropdown dropdown-end">
                            <div tabindex="0" role="button" class="btn btn-sm btn-ghost gap-2 border border-slate-200 bg-white">
                                <div class="w-6 h-6 rounded-full bg-primary text-primary-content flex items-center justify-center text-xs font-bold">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                                <span class="hidden lg:inline text-xs font-semibold max-w-[120px] truncate">{{ auth()->user()->name }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                            <ul tabindex="0" class="dropdown-content menu bg-white rounded-lg z-50 w-56 p-2 shadow-lg border border-slate-200 mt-2 text-xs">
                                <li class="menu-title px-3 py-1.5 text-slate-500">
                                    Halo, <span class="font-bold text-slate-800">{{ auth()->user()->name }}</span>
                                    <span class="badge badge-sm badge-outline mt-1 capitalize">{{ auth()->user()->role }}</span>
                                </li>
                                <div class="divider my-1"></div>
                                @if(auth()->user()->role === 'admin')
                                    <li>
                                        <a href="{{ route('admin.dashboard') }}" class="text-primary font-semibold">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                            </svg>
                                            Panel Administrator
                                        </a>
                                    </li>
                                @endif
                                <li>
                                    <a href="{{ route('contact.index') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                        </svg>
                                        Hubungi Admin
                                    </a>
                                </li>
                                <div class="divider my-1"></div>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="w-full">
                                        @csrf
                                        <button type="submit" class="text-error font-medium w-full text-left flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                            </svg>
                                            Keluar
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <div class="flex items-center gap-2">
                            <a href="{{ route('login') }}" class="btn btn-sm btn-ghost text-xs font-semibold">Masuk</a>
                            <a href="{{ route('register') }}" class="btn btn-sm btn-primary text-xs font-semibold">Daftar</a>
                        </div>
                    @endauth
                </div>
            </div>

            <!-- Mobile Search Bar -->
            <div class="mt-3 md:hidden">
                <form action="{{ route('books.index') }}" method="GET" class="w-full">
                    <div class="join w-full">
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Cari buku..."
                            class="input input-bordered input-sm join-item w-full bg-white text-xs"
                        />
                        <button type="submit" class="btn btn-primary btn-sm join-item">Cari</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Secondary Navigation Menu Bar -->
        <nav class="border-t border-slate-200 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-11 text-xs font-semibold text-slate-700">
                    <div class="flex items-center gap-6 overflow-x-auto py-1">
                        <a href="{{ route('home') }}" class="hover:text-primary transition-colors flex items-center gap-1.5 {{ request()->routeIs('home') ? 'text-primary font-bold border-b-2 border-primary py-2.5 -mb-px' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Beranda
                        </a>
                        <a href="{{ route('books.index') }}" class="hover:text-primary transition-colors flex items-center gap-1.5 {{ request()->routeIs('books.*') ? 'text-primary font-bold border-b-2 border-primary py-2.5 -mb-px' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            Katalog Buku
                        </a>
                        <a href="{{ route('about') }}" class="hover:text-primary transition-colors {{ request()->routeIs('about') ? 'text-primary font-bold border-b-2 border-primary py-2.5 -mb-px' : '' }}">
                            Tentang Kami
                        </a>
                        @auth
                            <a href="{{ route('contact.index') }}" class="hover:text-primary transition-colors {{ request()->routeIs('contact.*') ? 'text-primary font-bold border-b-2 border-primary py-2.5 -mb-px' : '' }}">
                                Hubungi Kami
                            </a>
                        @endauth
                    </div>
                    <div class="hidden md:flex items-center gap-2 text-slate-500 font-medium">
                        <span class="inline-block w-2 h-2 rounded-full bg-emerald-500"></span>
                        <span>Stok Selalu Diperbarui</span>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content Container -->
    <main class="flex-1 max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-6">
        <!-- Flash Alerts -->
        @if(session('success'))
            <div class="alert alert-success text-sm py-3 mb-6 shadow-sm border border-emerald-300 bg-emerald-50 text-emerald-900 rounded-lg flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error text-sm py-3 mb-6 shadow-sm border border-rose-300 bg-rose-50 text-rose-900 rounded-lg flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-rose-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-error text-sm py-3 mb-6 shadow-sm border border-rose-300 bg-rose-50 text-rose-900 rounded-lg">
                <div>
                    <div class="font-bold flex items-center gap-2 mb-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        Terdapat kesalahan pengisian data:
                    </div>
                    <ul class="list-disc list-inside text-xs space-y-0.5 ml-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Clean Natural Footer -->
    <footer class="bg-white border-t border-slate-200 mt-12 text-slate-600 text-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Col 1: About -->
                <div class="space-y-3">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded bg-primary text-primary-content flex items-center justify-center font-bold">
                            B
                        </div>
                        <span class="text-lg font-bold text-slate-900">Baca<span class="text-primary">buku</span></span>
                    </div>
                    <p class="text-slate-500 leading-relaxed">
                        Toko buku daring yang menyediakan buku pendidikan, fiksi, pengembangan diri, dan referensi akademik terlengkap dengan jaminan 100% original.
                    </p>
                    <div class="space-y-1 text-slate-500">
                        <p>📍 Jl. Salemba Raya No. 45, Jakarta Pusat</p>
                        <p>📧 redaksi@bacabuku.id</p>
                    </div>
                </div>

                <!-- Col 2: Navigation Links -->
                <div>
                    <h4 class="font-bold text-slate-900 text-sm mb-3">Navigasi Cepat</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="hover:text-primary transition-colors">Beranda Utama</a></li>
                        <li><a href="{{ route('books.index') }}" class="hover:text-primary transition-colors">Katalog Semua Buku</a></li>
                        <li><a href="{{ route('cart.index') }}" class="hover:text-primary transition-colors">Keranjang Belanja</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-primary transition-colors">Tentang Bacabuku</a></li>
                        @auth
                            <li><a href="{{ route('contact.index') }}" class="hover:text-primary transition-colors">Hubungi Layanan</a></li>
                        @endauth
                    </ul>
                </div>

                <!-- Col 3: Layanan & Kebijakan -->
                <div>
                    <h4 class="font-bold text-slate-900 text-sm mb-3">Layanan Pembeli</h4>
                    <ul class="space-y-2 text-slate-500">
                        <li>Bayar di Tempat (COD) Tersedia</li>
                        <li>Garansi Tukar Jika Cacat Cetak</li>
                        <li>Pengemasan Bubble Wrap Tebal</li>
                        <li>Pengiriman Seluruh Nusantara</li>
                        <li>Buku 100% Asli Penerbit</li>
                    </ul>
                </div>

                <!-- Col 4: Pembayaran & Sertifikasi -->
                <div class="space-y-3">
                    <h4 class="font-bold text-slate-900 text-sm mb-1">Informasi Uji Kompetensi</h4>
                    <div class="bg-slate-50 p-3.5 rounded-lg border border-slate-200 space-y-2">
                        <span class="badge badge-primary badge-sm font-semibold">UKK RPL 2026</span>
                        <p class="text-[11px] text-slate-500 leading-relaxed">
                            Aplikasi Toko Buku Bacabuku dirancang dan dibangun untuk memenuhi standar Ujian Kompetensi Keahlian Rekayasa Perangkat Lunak.
                        </p>
                    </div>
                    <div class="pt-1">
                        <span class="text-[11px] font-semibold text-slate-700 block mb-1">Metode Transaksi:</span>
                        <div class="flex flex-wrap gap-1.5">
                            <span class="px-2 py-1 bg-slate-100 rounded border border-slate-200 font-mono text-[10px] font-bold">COD</span>
                            <span class="px-2 py-1 bg-slate-100 rounded border border-slate-200 font-mono text-[10px] font-bold">TRANSFER</span>
                            <span class="px-2 py-1 bg-slate-100 rounded border border-slate-200 font-mono text-[10px] font-bold">QRIS</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Copyright -->
            <div class="border-t border-slate-200 mt-8 pt-6 flex flex-col sm:flex-row items-center justify-between text-slate-500 text-[11px] gap-2">
                <p>&copy; {{ date('Y') }} Bacabuku Bookstore. Seluruh hak cipta dilindungi.</p>
                <p>Dibangun dengan Laravel, Tailwind CSS, & daisyUI.</p>
            </div>
        </div>
    </footer>

</body>
</html>
