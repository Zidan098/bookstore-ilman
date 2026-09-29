@extends('layouts.app')

@section('content')
<div class="space-y-6">

    <!-- Breadcrumbs -->
    <div class="text-xs breadcrumbs text-slate-500 py-1">
        <ul>
            <li><a href="{{ route('home') }}" class="hover:text-primary">Beranda</a></li>
            <li class="text-slate-800 font-semibold">Keranjang Belanja</li>
        </ul>
    </div>

    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-2 border-b border-slate-200">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Keranjang Belanja</h1>
            <p class="text-xs text-slate-500">Periksa kembali buku dan kuantitas yang ingin Anda pesan</p>
        </div>
        @if(count($cart) > 0)
            <form action="{{ route('cart.clear') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mengosongkan seluruh keranjang belanja?')">
                @csrf
                <button type="submit" class="btn btn-sm btn-ghost text-error hover:bg-rose-50 border border-rose-200 text-xs gap-1.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    <span>Kosongkan Keranjang</span>
                </button>
            </form>
        @endif
    </div>

    @if(count($cart) > 0)
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
            
            <!-- Left: Items Table -->
            <div class="lg:col-span-8 space-y-4">
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm">
                    <div class="overflow-x-auto">
                        <table class="table w-full text-xs">
                            <thead class="bg-slate-50 border-b border-slate-200 text-slate-600">
                                <tr>
                                    <th class="py-3 px-4 font-semibold">Produk Buku</th>
                                    <th class="py-3 px-4 font-semibold text-center">Harga</th>
                                    <th class="py-3 px-4 font-semibold text-center">Jumlah</th>
                                    <th class="py-3 px-4 font-semibold text-right">Subtotal</th>
                                    <th class="py-3 px-4 font-semibold text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach($cart as $item)
                                    <tr class="hover:bg-slate-50/50">
                                        <!-- Product Info -->
                                        <td class="py-3 px-4">
                                            <div class="flex items-center gap-3">
                                                <div class="w-12 h-16 bg-slate-100 rounded border border-slate-200 overflow-hidden shrink-0">
                                                    @if(!empty($item['cover']))
                                                        <img src="{{ asset('storage/' . $item['cover']) }}" alt="{{ $item['title'] }}" class="w-full h-full object-cover">
                                                    @else
                                                        <div class="w-full h-full flex items-center justify-center text-[10px] text-slate-400 font-bold">
                                                            BUKU
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="space-y-0.5">
                                                    <h3 class="font-bold text-slate-900 text-xs sm:text-sm line-clamp-1">
                                                        {{ $item['title'] }}
                                                    </h3>
                                                    <p class="text-[11px] text-slate-500">Penulis: {{ $item['author'] }}</p>
                                                    @if(isset($item['stock']))
                                                        <span class="text-[10px] text-emerald-600 font-medium">Stok: {{ $item['stock'] }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Price -->
                                        <td class="py-3 px-4 text-center font-medium text-slate-700 whitespace-nowrap">
                                            Rp {{ number_format($item['price'], 0, ',', '.') }}
                                        </td>

                                        <!-- Qty Form -->
                                        <td class="py-3 px-4 text-center whitespace-nowrap">
                                            <form action="{{ route('cart.update', $item['id']) }}" method="POST" class="inline-flex items-center gap-1.5">
                                                @csrf
                                                @method('PATCH')
                                                <input
                                                    type="number"
                                                    name="qty"
                                                    value="{{ $item['qty'] }}"
                                                    min="1"
                                                    max="{{ $item['stock'] ?? 99 }}"
                                                    class="input input-bordered input-xs w-14 text-center font-bold bg-white"
                                                />
                                                <button type="submit" class="btn btn-xs btn-ghost border border-slate-200 text-slate-600 hover:border-primary" title="Perbarui Jumlah">
                                                    Update
                                                </button>
                                            </form>
                                        </td>

                                        <!-- Subtotal -->
                                        <td class="py-3 px-4 text-right font-bold text-primary text-sm whitespace-nowrap">
                                            Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}
                                        </td>

                                        <!-- Remove Action -->
                                        <td class="py-3 px-4 text-center whitespace-nowrap">
                                            <form action="{{ route('cart.remove', $item['id']) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-xs btn-ghost text-rose-500 hover:bg-rose-50" title="Hapus dari Keranjang">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="flex items-center justify-between pt-2">
                    <a href="{{ route('books.index') }}" class="btn btn-sm btn-ghost border border-slate-200 text-xs text-slate-700 hover:border-slate-400 gap-1.5">
                        &larr; Lanjut Pilih Buku Lain
                    </a>
                </div>
            </div>

            <!-- Right: Order Summary Card -->
            <div class="lg:col-span-4 space-y-4">
                <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm space-y-4">
                    <h3 class="font-bold text-slate-900 text-base pb-3 border-b border-slate-100">
                        Ringkasan Belanja
                    </h3>

                    <div class="space-y-2 text-xs text-slate-600">
                        <div class="flex justify-between">
                            <span>Total Item</span>
                            <span class="font-semibold text-slate-800">
                                @php
                                    $itemQtySum = 0;
                                    foreach($cart as $c) { $itemQtySum += $c['qty']; }
                                @endphp
                                {{ $itemQtySum }} eksemplar
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span>Subtotal Buku</span>
                            <span class="font-semibold text-slate-800">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Biaya Pengiriman</span>
                            <span class="badge badge-success badge-sm text-white font-medium">Gratis (Promo UKK)</span>
                        </div>
                    </div>

                    <div class="pt-3 border-t border-slate-100 flex justify-between items-center">
                        <span class="font-bold text-slate-900 text-sm">Total Tagihan</span>
                        <span class="text-xl font-extrabold text-primary">
                            Rp {{ number_format($total, 0, ',', '.') }}
                        </span>
                    </div>

                    <div class="pt-2">
                        <a href="{{ route('checkout.index') }}" class="btn btn-primary btn-md btn-block font-semibold shadow-sm gap-2">
                            <span>Lanjut ke Pembayaran</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                    </div>

                    <div class="bg-slate-50 p-3 rounded-lg border border-slate-200 space-y-1.5 text-[11px] text-slate-500">
                        <p class="font-semibold text-slate-700">Catatan Pembelian:</p>
                        <ul class="list-disc list-inside space-y-0.5">
                            <li>Bisa bayar langsung saat kurir tiba (COD).</li>
                            <li>Buku dicek kondisinya sebelum dikirim.</li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    @else
        <!-- Empty Cart State -->
        <div class="bg-white rounded-2xl border border-slate-200 p-12 text-center max-w-lg mx-auto shadow-sm space-y-4">
            <div class="w-16 h-16 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center mx-auto">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
            <div class="space-y-1">
                <h3 class="font-bold text-slate-900 text-lg">Keranjang Belanja Kosong</h3>
                <p class="text-xs text-slate-500 max-w-xs mx-auto">
                    Anda belum memasukkan buku apapun ke dalam keranjang belanja.
                </p>
            </div>
            <div>
                <a href="{{ route('books.index') }}" class="btn btn-primary btn-sm font-semibold">
                    Mulai Jelajahi Katalog Buku
                </a>
            </div>
        </div>
    @endif

</div>
@endsection
