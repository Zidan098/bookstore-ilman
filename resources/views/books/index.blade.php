@extends('layouts.app')

@section('content')
<div class="space-y-6">

    <!-- Breadcrumbs -->
    <div class="text-xs breadcrumbs text-slate-500 py-1">
        <ul>
            <li><a href="{{ route('home') }}" class="hover:text-primary">Beranda</a></li>
            <li class="text-slate-800 font-semibold">Katalog Buku</li>
            @if(request('category'))
                @php
                    $activeCategory = $categories->firstWhere('slug', request('category')) ?? $categories->firstWhere('id', request('category'));
                @endphp
                @if($activeCategory)
                    <li class="text-primary font-bold">{{ $activeCategory->name }}</li>
                @endif
            @endif
        </ul>
    </div>

    <!-- 2-Column Layout: Sidebar Filter & Book Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

        <!-- Sidebar Filter Card -->
        <aside class="lg:col-span-3 bg-white p-5 rounded-xl border border-slate-200 shadow-sm space-y-5 sticky top-24">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <h3 class="font-bold text-slate-900 text-sm flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                    Filter Katalog
                </h3>
                @if(request('search') || request('category'))
                    <a href="{{ route('books.index') }}" class="text-[11px] text-error font-medium hover:underline">
                        Reset Filter
                    </a>
                @endif
            </div>

            <form action="{{ route('books.index') }}" method="GET" class="space-y-4">
                <!-- Search Input -->
                <div class="space-y-1.5">
                    <label class="text-xs font-semibold text-slate-700">Pencarian Judul / Penulis</label>
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Contoh: Pemrograman..."
                        class="input input-bordered input-sm w-full bg-white text-xs focus:outline-primary"
                    />
                </div>

                <!-- Category Filter -->
                <div class="space-y-1.5">
                    <label class="text-xs font-semibold text-slate-700">Pilih Kategori</label>
                    <select name="category" class="select select-bordered select-sm w-full bg-white text-xs focus:outline-primary">
                        <option value="">Semua Kategori ({{ $categories->sum('books_count') }})</option>
                        @foreach($categories as $category)
                            <option
                                value="{{ $category->slug }}"
                                {{ (request('category') == $category->slug || request('category') == $category->id) ? 'selected' : '' }}
                            >
                                {{ $category->name }} ({{ $category->books_count }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Action Button -->
                <div class="pt-2">
                    <button type="submit" class="btn btn-primary btn-sm w-full font-semibold">
                        Terapkan Filter
                    </button>
                </div>
            </form>

            <!-- Quick Category Badges List -->
            <div class="pt-4 border-t border-slate-100">
                <span class="text-[11px] font-bold text-slate-400 block uppercase tracking-wider mb-2">Daftar Kategori</span>
                <div class="flex flex-col gap-1 text-xs">
                    <a href="{{ route('books.index') }}" class="flex items-center justify-between py-1 px-2 rounded hover:bg-slate-50 {{ !request('category') ? 'font-bold text-primary bg-primary/5' : 'text-slate-600' }}">
                        <span>Semua Koleksi</span>
                        <span class="badge badge-sm badge-ghost">{{ $categories->sum('books_count') }}</span>
                    </a>
                    @foreach($categories as $cat)
                        <a href="{{ route('books.index', ['category' => $cat->slug]) }}" class="flex items-center justify-between py-1 px-2 rounded hover:bg-slate-50 {{ (request('category') == $cat->slug || request('category') == $cat->id) ? 'font-bold text-primary bg-primary/5' : 'text-slate-600' }}">
                            <span class="truncate max-w-[140px]">{{ $cat->name }}</span>
                            <span class="badge badge-sm badge-ghost">{{ $cat->books_count }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </aside>

        <!-- Main Book Catalog Grid -->
        <main class="lg:col-span-9 space-y-5">
            <!-- Catalog Header Bar -->
            <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <div>
                    <h1 class="text-lg font-bold text-slate-900">
                        @if(request('category'))
                            @php
                                $selectedCategory = $categories->firstWhere('slug', request('category')) ?? $categories->firstWhere('id', request('category'));
                            @endphp
                            Kategori: {{ $selectedCategory ? $selectedCategory->name : 'Buku Terpilih' }}
                        @elseif(request('search'))
                            Hasil Pencarian: "{{ request('search') }}"
                        @else
                            Semua Koleksi Buku
                        @endif
                    </h1>
                    <p class="text-xs text-slate-500">
                        Menampilkan {{ $books->firstItem() ?? 0 }} - {{ $books->lastItem() ?? 0 }} dari total {{ $books->total() }} judul buku
                    </p>
                </div>

                @if(request('search') || request('category'))
                    <div class="flex items-center gap-2">
                        @if(request('search'))
                            <span class="badge badge-sm badge-outline gap-1 text-slate-700">
                                Cari: "{{ request('search') }}"
                            </span>
                        @endif
                        @if(request('category'))
                            <span class="badge badge-sm badge-primary gap-1">
                                Kategori
                            </span>
                        @endif
                        <a href="{{ route('books.index') }}" class="btn btn-xs btn-ghost text-error">Hapus Semua Filter</a>
                    </div>
                @endif
            </div>

            <!-- Books Grid -->
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                @forelse($books as $book)
                    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-md transition-shadow flex flex-col justify-between group">
                        <div>
                            <!-- Cover Container -->
                            <a href="{{ route('books.show', $book) }}" class="block aspect-[3/4] bg-slate-100 overflow-hidden relative">
                                @if($book->cover)
                                    <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                @else
                                    <div class="w-full h-full flex flex-col items-center justify-center p-3 text-center text-slate-400 text-xs">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mb-1 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                        <span class="font-medium">Bacabuku</span>
                                    </div>
                                @endif

                                @if($book->stock <= 0)
                                    <div class="absolute inset-0 bg-black/60 flex items-center justify-center">
                                        <span class="badge badge-error font-bold text-white text-xs">HABIS</span>
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
                    <div class="col-span-full py-16 text-center bg-white rounded-xl border border-slate-200 p-8 space-y-3">
                        <div class="w-12 h-12 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center mx-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h4 class="font-bold text-slate-800 text-base">Buku Tidak Ditemukan</h4>
                        <p class="text-xs text-slate-500 max-w-sm mx-auto">
                            Maaf, kami tidak menemukan buku yang sesuai dengan kriteria pencarian atau kategori Anda.
                        </p>
                        <a href="{{ route('books.index') }}" class="btn btn-sm btn-primary mt-2">
                            Tampilkan Semua Buku
                        </a>
                    </div>
                @endforelse
            </div>

            <!-- Pagination Container -->
            <div class="pt-4 flex justify-center">
                {{ $books->links() }}
            </div>
        </main>
    </div>

</div>
@endsection
