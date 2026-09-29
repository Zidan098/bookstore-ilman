<!DOCTYPE html>
<html lang="id" data-theme="corporate">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Panel - Bacabuku' }}</title>

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
<body class="min-h-screen bg-slate-100 text-slate-800 antialiased flex flex-col">

    <!-- Top Admin Header -->
    <header class="bg-white border-b border-slate-200 sticky top-0 z-30">
        <div class="px-4 lg:px-8 py-3 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <!-- Mobile Drawer Toggle -->
                <label for="admin-drawer" class="btn btn-ghost btn-sm btn-square lg:hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </label>
                <!-- Brand -->
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded bg-primary text-primary-content flex items-center justify-center font-bold text-sm">
                        B
                    </div>
                    <div>
                        <span class="font-bold text-lg text-slate-900">Bacabuku</span>
                        <span class="badge badge-primary badge-sm ml-1 font-semibold text-[10px]">ADMIN</span>
                    </div>
                </a>
            </div>

            <!-- Header Right Menu -->
            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}" target="_blank" class="btn btn-sm btn-ghost border border-slate-200 text-xs gap-1.5 font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                    <span>Lihat Toko</span>
                </a>

                <div class="dropdown dropdown-end">
                    <div tabindex="0" role="button" class="btn btn-sm btn-ghost gap-2 border border-slate-200">
                        <div class="w-6 h-6 rounded-full bg-primary text-primary-content flex items-center justify-center text-xs font-bold">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <span class="hidden sm:inline text-xs font-semibold">{{ auth()->user()->name }}</span>
                    </div>
                    <ul tabindex="0" class="dropdown-content menu bg-white rounded-lg z-50 w-52 p-2 shadow-lg border border-slate-200 mt-2 text-xs">
                        <li class="menu-title px-3 py-1.5 text-slate-500">
                            Administrator: <strong class="text-slate-800">{{ auth()->user()->name }}</strong>
                        </li>
                        <div class="divider my-1"></div>
                        <li>
                            <form action="{{ route('logout') }}" method="POST" class="w-full">
                                @csrf
                                <button type="submit" class="text-error font-medium w-full text-left">Keluar (Logout)</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <!-- Admin Drawer Layout -->
    <div class="drawer lg:drawer-open flex-1">
        <input id="admin-drawer" type="checkbox" class="drawer-toggle" />
        
        <!-- Main Content Area -->
        <div class="drawer-content flex flex-col p-4 lg:p-8">
            <!-- Flash Alerts -->
            @if(session('success'))
                <div class="alert alert-success text-sm py-2.5 mb-6 shadow-sm border border-emerald-300 bg-emerald-50 text-emerald-900 rounded-lg flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error text-sm py-2.5 mb-6 shadow-sm border border-rose-300 bg-rose-50 text-rose-900 rounded-lg flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-rose-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-error text-sm py-2.5 mb-6 shadow-sm border border-rose-300 bg-rose-50 text-rose-900 rounded-lg">
                    <div class="font-bold mb-1">Perhatian:</div>
                    <ul class="list-disc list-inside text-xs space-y-0.5 ml-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </div>

        <!-- Sidebar Navigation -->
        <div class="drawer-side z-40">
            <label for="admin-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
            <aside class="w-64 min-h-full bg-white border-r border-slate-200 flex flex-col justify-between p-4 text-xs font-medium">
                <div>
                    <div class="px-3 py-2 text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                        Menu Utama
                    </div>
                    <ul class="menu menu-sm w-full gap-1 p-0">
                        <li>
                            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active bg-primary text-white font-semibold' : 'text-slate-700 hover:bg-slate-100' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.books.index') }}" class="{{ request()->routeIs('admin.books.*') ? 'active bg-primary text-white font-semibold' : 'text-slate-700 hover:bg-slate-100' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                Kelola Buku
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories.*') ? 'active bg-primary text-white font-semibold' : 'text-slate-700 hover:bg-slate-100' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                                Kelola Kategori
                            </a>
                        </li>
                    </ul>

                    <div class="px-3 py-2 mt-4 text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                        Transaksi & User
                    </div>
                    <ul class="menu menu-sm w-full gap-1 p-0">
                        <li>
                            <a href="{{ route('admin.orders.index') }}" class="{{ request()->routeIs('admin.orders.*') ? 'active bg-primary text-white font-semibold' : 'text-slate-700 hover:bg-slate-100' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                </svg>
                                Pesanan Masuk
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'active bg-primary text-white font-semibold' : 'text-slate-700 hover:bg-slate-100' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                                Data Pengguna
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Admin Footer Info -->
                <div class="pt-4 border-t border-slate-200">
                    <div class="bg-slate-50 p-3 rounded-lg border border-slate-200 mb-3">
                        <span class="text-[10px] text-slate-400 block font-semibold">LOGIN SEBAGAI</span>
                        <div class="font-bold text-slate-800 text-xs truncate">{{ auth()->user()->name }}</div>
                        <div class="text-[10px] text-slate-500 truncate">{{ auth()->user()->email }}</div>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline btn-error w-full text-xs">
                            Keluar dari Panel
                        </button>
                    </form>
                </div>
            </aside>
        </div>
    </div>

</body>
</html>
