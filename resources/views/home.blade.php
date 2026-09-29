@extends('layouts.app')

@section('content')
<div class="space-y-12">

    <!-- Hero Section: Clean 2-Column Banner -->
    <section class="bg-white rounded-2xl border border-slate-200 p-6 md:p-10 shadow-sm">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            <!-- Left Headline & CTA -->
            <div class="lg:col-span-7 space-y-5">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary/10 text-primary text-xs font-semibold">
                    <span class="w-2 h-2 rounded-full bg-primary"></span>
                    <span>Toko Buku Online Resmi & Terpercaya</span>
                </div>
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-900 tracking-tight leading-tight">
                    Temukan Wawasan Baru Lewat <span class="text-primary">Buku Pilihan</span> Berkualitas
                </h1>
                <p class="text-slate-600 text-sm sm:text-base leading-relaxed max-w-xl">
                    Jelajahi ribuan judul buku pendidikan, novel populer, sains, dan literatur akademik. Kami berkomitmen menyediakan buku 100% original langsung dari penerbit resmi.
                </p>
                
                <div class="flex flex-wrap items-center gap-3 pt-2">
                    <a href="{{ route('books.index') }}" class="btn btn-primary btn-md shadow-sm gap-2">
                        <span>Jelajahi Katalog Buku</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                    <a href="{{ route('about') }}" class="btn btn-ghost border border-slate-200 btn-md text-slate-700 hover:border-slate-400">
                        Tentang Bacabuku
                    </a>
                </div>

                <!-- Mini Trust Stats -->
                <div class="pt-4 border-t border-slate-100 flex flex-wrap items-center gap-6 text-xs text-slate-500 font-medium">
                    <div class="flex items-center gap-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>100% Produk Original</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Bisa Bayar di Tempat (COD)</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Packing Bubble Wrap Aman</span>
                    </div>
                </div>
            </div>

            <!-- Right Featured Book Spotlight -->
            <div class="lg:col-span-5">
                @if($latestBooks->isNotEmpty())
                    @php $featured = $latestBooks->first(); @endphp
                    <div class="bg-slate-50 rounded-xl border border-slate-200 p-5 shadow-sm">
                        <div class="flex items-center justify-between mb-3">
                            <span class="badge badge-primary badge-sm font-semibold">REKOMENDASI PEKAN INI</span>
                            <span class="text-xs text-slate-400 font-medium">Buku Pilihan</span>
                        </div>
                        <div class="flex gap-4 items-start">
                            <div class="w-28 sm:w-32 shrink-0 aspect-[3/4] bg-white rounded-lg overflow-hidden border border-slate-200 shadow-sm">
                                @if($featured->cover)
                                    <img src="{{ asset('storage/' . $featured->cover) }}" alt="{{ $featured->title }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex flex-col items-center justify-center p-2 text-center text-slate-400 text-xs">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mb-1 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                        <span>Cover Buku</span>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1 space-y-2">
                                <span class="text-xs font-semibold text-primary uppercase tracking-wider">{{ $featured->category->name ?? 'Umum' }}</span>
                                <h3 class="font-bold text-slate-900 text-base line-clamp-2 leading-snug">
                                    <a href="{{ route('books.show', $featured) }}" class="hover:text-primary transition-colors">
                                        {{ $featured->title }}
                                    </a>
                                </h3>
                                <p class="text-xs text-slate-500">Penulis: <span class="font-medium text-slate-700">{{ $featured->author }}</span></p>
                                <div class="text-primary font-extrabold text-lg">
                                    Rp {{ number_format($featured->price, 0, ',', '.') }}
                                </div>
                                <div class="pt-2 flex items-center gap-2">
                                    <a href="{{ route('books.show', $featured) }}" class="btn btn-sm btn-primary">
                                        Beli Sekarang
                                    </a>
                                    <form action="{{ route('cart.add', $featured) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="qty" value="1">
                                        <button type="submit" class="btn btn-sm btn-ghost border border-slate-200 hover:border-primary" title="Tambah ke Keranjang">
                                            + Keranjang
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Trust Features Bar -->
    <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white p-4 rounded-xl border border-slate-200 flex items-center gap-3.5">
            <div class="w-10 h-10 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
            </div>
            <div>
                <h4 class="font-bold text-slate-800 text-xs sm:text-sm">100% Buku Asli</h4>
                <p class="text-[11px] text-slate-500">Koleksi resmi dari penerbit</p>
            </div>
        </div>

        <div class="bg-white p-4 rounded-xl border border-slate-200 flex items-center gap-3.5">
            <div class="w-10 h-10 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
            <div>
                <h4 class="font-bold text-slate-800 text-xs sm:text-sm">Bisa Bayar COD</h4>
                <p class="text-[11px] text-slate-500">Bayar saat buku sampai rumah</p>
            </div>
        </div>

        <div class="bg-white p-4 rounded-xl border border-slate-200 flex items-center gap-3.5">
            <div class="w-10 h-10 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
            </div>
            <div>
                <h4 class="font-bold text-slate-800 text-xs sm:text-sm">Kemasan Rapi & Aman</h4>
                <p class="text-[11px] text-slate-500">Lapisan bubble wrap tebal</p>
            </div>
        </div>

        <div class="bg-white p-4 rounded-xl border border-slate-200 flex items-center gap-3.5">
            <div class="w-10 h-10 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <h4 class="font-bold text-slate-800 text-xs sm:text-sm">Pengiriman Cepat</h4>
                <p class="text-[11px] text-slate-500">Diproses di hari yang sama</p>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="space-y-4">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-bold text-slate-900 tracking-tight">Kategori Buku Pilihan</h2>
                <p class="text-xs text-slate-500">Temukan buku berdasarkan bidang keilmuan dan minat Anda</p>
            </div>
            <a href="{{ route('books.index') }}" class="text-xs font-semibold text-primary hover:underline flex items-center gap-1">
                Lihat Semua &rarr;
            </a>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-3">
            @forelse($categories as $category)
                <a href="{{ route('books.index', ['category' => $category->slug]) }}" class="bg-white hover:bg-slate-50 rounded-xl border border-slate-200 p-3.5 text-center transition-all hover:border-primary hover:shadow-sm group">
                    <div class="w-10 h-10 rounded-lg bg-primary/10 text-primary mx-auto flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <div class="font-bold text-slate-800 text-xs truncate">{{ $category->name }}</div>
                    <div class="text-[11px] text-slate-400 mt-0.5">{{ $category->books_count }} Judul</div>
                </a>
            @empty
                <div class="col-span-full py-4 text-center text-slate-400 text-xs">
                    Belum ada kategori yang terdaftar.
                </div>
            @endforelse
        </div>
    </section>

    <!-- Latest Books Catalog -->
    <section class="space-y-4">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-bold text-slate-900 tracking-tight">Koleksi Buku Terbaru</h2>
                <p class="text-xs text-slate-500">Judul buku terbitan teranyar yang siap dikirim ke alamat Anda</p>
            </div>
            <a href="{{ route('books.index') }}" class="btn btn-sm btn-ghost border border-slate-200 text-xs font-semibold hover:border-primary">
                Katalog Lengkap &rarr;
            </a>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
            @forelse($latestBooks as $book)
                <div class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-md transition-shadow flex flex-col justify-between group">
                    <div>
                        <!-- Cover Container -->
                        <a href="{{ route('books.show', $book) }}" class="block aspect-[3/4] bg-slate-100 overflow-hidden relative">
                            @if($book->cover)
                                <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            @else
                                <div class="w-full h-full flex flex-col items-center justify-center p-4 text-center text-slate-400 text-xs">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mb-2 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                    <span class="font-medium">Bacabuku</span>
                                </div>
                            @endif

                            @if($book->stock <= 0)
                                <div class="absolute inset-0 bg-black/60 flex items-center justify-center">
                                    <span class="badge badge-error font-bold text-white text-xs">STOK HABIS</span>
                                </div>
                            @endif
                        </a>

                        <!-- Book Info -->
                        <div class="p-3.5 space-y-1.5">
                            <div class="flex items-center justify-between text-[11px]">
                                <span class="badge badge-ghost badge-sm text-slate-600 px-2 py-0.5 truncate max-w-[120px]">
                                    {{ $book->category->name ?? 'Umum' }}
                                </span>
                                @if($book->stock > 0)
                                    <span class="text-emerald-600 font-semibold text-[10px]">Stok: {{ $book->stock }}</span>
                                @endif
                            </div>

                            <h3 class="font-bold text-slate-900 text-sm line-clamp-2 leading-snug group-hover:text-primary transition-colors">
                                <a href="{{ route('books.show', $book) }}">
                                    {{ $book->title }}
                                </a>
                            </h3>
                            <p class="text-[11px] text-slate-500 line-clamp-1">
                                Oleh: <span class="font-medium text-slate-700">{{ $book->author }}</span>
                            </p>
                        </div>
                    </div>

                    <!-- Bottom Price & Action -->
                    <div class="p-3.5 pt-0 border-t border-slate-100 flex items-center justify-between gap-2 mt-2">
                        <div>
                            <span class="text-[10px] text-slate-400 block font-medium">Harga:</span>
                            <span class="text-sm font-extrabold text-primary">
                                Rp {{ number_format($book->price, 0, ',', '.') }}
                            </span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <a href="{{ route('books.show', $book) }}" class="btn btn-xs btn-ghost border border-slate-200 hover:border-primary">
                                Detail
                            </a>
                            @if($book->stock > 0)
                                <form action="{{ route('cart.add', $book) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="qty" value="1">
                                    <button type="submit" class="btn btn-xs btn-primary font-medium" title="Tambah ke Keranjang">
                                        + Beli
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 text-center bg-white rounded-xl border border-slate-200">
                    <p class="text-slate-400 text-sm">Belum ada koleksi buku yang tersedia.</p>
                </div>
            @endforelse
        </div>
    </section>

    <!-- Student / Exam Callout Banner -->
    <section class="bg-gradient-to-r from-primary/10 via-primary/5 to-slate-100 rounded-2xl border border-primary/20 p-6 md:p-8 flex flex-col md:flex-row items-center justify-between gap-6">
        <div class="space-y-2 text-center md:text-left">
            <span class="badge badge-primary badge-sm font-semibold">LAYANAN PESANAN SEKOLAH & KAMPUS</span>
            <h3 class="text-xl md:text-2xl font-bold text-slate-900">Perlu Pengadaan Buku untuk Institusi atau Komunitas?</h3>
            <p class="text-xs md:text-sm text-slate-600 max-w-xl">
                Kami siap melayani pembelian buku dalam jumlah banyak untuk perpustakaan sekolah, universitas, maupun taman bacaan masyarakat.
            </p>
        </div>
        <div class="shrink-0">
            <a href="{{ route('about') }}" class="btn btn-primary btn-sm md:btn-md shadow-sm">
                Pelajari Selengkapnya
            </a>
        </div>
    </section>

</div>
@endsection
