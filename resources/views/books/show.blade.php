@extends('layouts.app')

@section('content')
<div class="space-y-8">

    <!-- Breadcrumbs -->
    <div class="text-xs breadcrumbs text-slate-500 py-1">
        <ul>
            <li><a href="{{ route('home') }}" class="hover:text-primary">Beranda</a></li>
            <li><a href="{{ route('books.index') }}" class="hover:text-primary">Katalog Buku</a></li>
            <li>
                <a href="{{ route('books.index', ['category' => $book->category->slug]) }}" class="hover:text-primary">
                    {{ $book->category->name ?? 'Umum' }}
                </a>
            </li>
            <li class="text-slate-800 font-semibold truncate max-w-xs">{{ $book->title }}</li>
        </ul>
    </div>

    <!-- Main Detail Card -->
    <div class="bg-white rounded-2xl border border-slate-200 p-6 md:p-8 shadow-sm">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- Left: Book Cover & Badges -->
            <div class="lg:col-span-4 space-y-4">
                <div class="aspect-[3/4] max-w-sm mx-auto bg-slate-50 rounded-xl border border-slate-200 overflow-hidden shadow-sm relative">
                    @if($book->cover)
                        <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex flex-col items-center justify-center p-6 text-center text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mb-2 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            <span class="font-bold text-sm text-slate-500">Bacabuku Original</span>
                        </div>
                    @endif

                    @if($book->stock <= 0)
                        <div class="absolute inset-0 bg-black/60 flex items-center justify-center">
                            <span class="badge badge-error font-bold text-white text-sm py-3 px-4">STOK HABIS</span>
                        </div>
                    @endif
                </div>

                <!-- Trust Points -->
                <div class="bg-slate-50 p-3.5 rounded-xl border border-slate-200 space-y-2 text-xs text-slate-600">
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-emerald-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Jaminan 100% Produk Asli Penerbit</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-emerald-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Gratis Pengemasan Bubble Wrap Tebal</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-emerald-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Mendukung Metode Pembayaran COD</span>
                    </div>
                </div>
            </div>

            <!-- Right: Book Details & Actions -->
            <div class="lg:col-span-8 space-y-6">
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <a href="{{ route('books.index', ['category' => $book->category->slug]) }}" class="badge badge-primary badge-outline text-xs font-semibold">
                            {{ $book->category->name ?? 'Kategori Umum' }}
                        </a>
                        @if($book->stock > 0)
                            <span class="badge badge-success badge-sm text-white font-medium">Stok Tersedia</span>
                        @else
                            <span class="badge badge-error badge-sm text-white font-medium">Stok Kosong</span>
                        @endif
                    </div>

                    <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 leading-snug">
                        {{ $book->title }}
                    </h1>
                    <p class="text-sm text-slate-500 mt-1.5">
                        Penulis: <span class="font-semibold text-slate-800">{{ $book->author }}</span>
                    </p>
                </div>

                <!-- Price Box -->
                <div class="bg-slate-50 border border-slate-200 rounded-xl p-4 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                    <div>
                        <span class="text-xs text-slate-400 font-medium block">Harga Buku:</span>
                        <div class="text-2xl sm:text-3xl font-extrabold text-primary">
                            Rp {{ number_format($book->price, 0, ',', '.') }}
                        </div>
                    </div>
                    <div class="text-xs text-slate-500 text-left sm:text-right">
                        <div>Sisa Stok Gudang: <strong class="text-slate-800">{{ $book->stock }} eksemplar</strong></div>
                        <div class="text-emerald-600 font-medium mt-0.5">Siap Dikirim Hari Ini</div>
                    </div>
                </div>

                <!-- Add to Cart Form -->
                <div>
                    @if($book->stock > 0)
                        <form action="{{ route('cart.add', $book) }}" method="POST" class="flex flex-col sm:flex-row items-center gap-3">
                            @csrf
                            <div class="flex items-center border border-slate-300 rounded-lg overflow-hidden bg-white w-full sm:w-auto">
                                <span class="px-3 py-2 text-xs font-semibold text-slate-500 bg-slate-50 border-r border-slate-300">
                                    Jumlah:
                                </span>
                                <input
                                    type="number"
                                    name="qty"
                                    value="1"
                                    min="1"
                                    max="{{ $book->stock }}"
                                    class="input input-sm border-0 focus:outline-none w-20 text-center font-bold text-slate-800"
                                />
                            </div>

                            <button type="submit" class="btn btn-primary btn-md w-full sm:w-auto font-semibold gap-2 shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                <span>+ Masukkan ke Keranjang</span>
                            </button>

                            <a href="{{ route('books.index') }}" class="btn btn-ghost border border-slate-200 btn-md text-xs text-slate-600 hover:border-slate-400">
                                Kembali ke Katalog
                            </a>
                        </form>
                    @else
                        <div class="p-4 bg-slate-100 rounded-xl border border-slate-200 text-center text-slate-500 text-sm">
                            Buku ini saat ini sedang habis terjual. Silakan cek kembali beberapa hari lagi.
                        </div>
                    @endif
                </div>

                <!-- Description / Synopsis -->
                <div class="pt-4 border-t border-slate-100 space-y-2">
                    <h3 class="font-bold text-slate-900 text-base">Deskripsi & Sinopsis</h3>
                    <div class="text-sm text-slate-600 leading-relaxed whitespace-pre-line bg-slate-50/60 p-4 rounded-xl border border-slate-100">
                        {{ $book->description ?: 'Tidak ada sinopsis atau catatan tambahan untuk buku ini.' }}
                    </div>
                </div>

                <!-- Book Specifications Table -->
                <div class="pt-2 space-y-2">
                    <h3 class="font-bold text-slate-900 text-base">Informasi Produk</h3>
                    <div class="overflow-x-auto">
                        <table class="table table-sm border border-slate-200 text-xs">
                            <tbody>
                                <tr class="border-b border-slate-200">
                                    <td class="font-semibold text-slate-500 w-40 bg-slate-50">Judul Buku</td>
                                    <td class="text-slate-800 font-medium">{{ $book->title }}</td>
                                </tr>
                                <tr class="border-b border-slate-200">
                                    <td class="font-semibold text-slate-500 bg-slate-50">Penulis</td>
                                    <td class="text-slate-800 font-medium">{{ $book->author }}</td>
                                </tr>
                                <tr class="border-b border-slate-200">
                                    <td class="font-semibold text-slate-500 bg-slate-50">Kategori</td>
                                    <td class="text-slate-800 font-medium">{{ $book->category->name ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="font-semibold text-slate-500 bg-slate-50">Status Ketersediaan</td>
                                    <td class="text-slate-800 font-medium">{{ $book->stock > 0 ? 'Tersedia (' . $book->stock . ' eks)' : 'Habis' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Related Books -->
    @if(isset($relatedBooks) && $relatedBooks->isNotEmpty())
        <div class="space-y-4 pt-4">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-bold text-slate-900">Buku Lain dalam Kategori yang Sama</h2>
                    <p class="text-xs text-slate-500">Rekomendasi bacaan serupa yang mungkin menarik perhatian Anda</p>
                </div>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                @foreach($relatedBooks as $related)
                    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-md transition-shadow flex flex-col justify-between group">
                        <div>
                            <a href="{{ route('books.show', $related) }}" class="block aspect-[3/4] bg-slate-100 overflow-hidden">
                                @if($related->cover)
                                    <img src="{{ asset('storage/' . $related->cover) }}" alt="{{ $related->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-slate-300 text-xs">
                                        Cover
                                    </div>
                                @endif
                            </a>
                            <div class="p-3 space-y-1">
                                <h4 class="font-bold text-slate-800 text-xs line-clamp-2 leading-snug group-hover:text-primary">
                                    <a href="{{ route('books.show', $related) }}">{{ $related->title }}</a>
                                </h4>
                                <p class="text-[11px] text-slate-500 line-clamp-1">{{ $related->author }}</p>
                            </div>
                        </div>
                        <div class="p-3 pt-0 border-t border-slate-100 flex items-center justify-between mt-2">
                            <span class="text-xs font-bold text-primary">Rp {{ number_format($related->price, 0, ',', '.') }}</span>
                            <a href="{{ route('books.show', $related) }}" class="btn btn-xs btn-ghost border border-slate-200">
                                Detail
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

</div>
@endsection
