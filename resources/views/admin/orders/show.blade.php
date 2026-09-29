@extends('layouts.admin')

@section('content')
<div class="space-y-6 max-w-5xl mx-auto">

    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Rincian Pesanan #{{ $order->order_code }}</h1>
            <p class="text-xs text-slate-500">Waktu Transaksi Masuk: {{ $order->created_at->format('d F Y, H:i') }} WIB</p>
        </div>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-ghost border border-slate-200 text-xs text-slate-700">
            &larr; Kembali ke Daftar
        </a>
    </div>

    <!-- 2-Column Detail Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
        
        <!-- Left: Ordered Items Table -->
        <div class="lg:col-span-8 bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden space-y-4">
            <div class="p-5 pb-3 border-b border-slate-100">
                <h2 class="font-bold text-slate-900 text-sm">Daftar Buku yang Dipesan</h2>
            </div>

            <div class="overflow-x-auto">
                <table class="table w-full text-xs">
                    <thead class="bg-slate-50 border-b border-slate-200 text-slate-600">
                        <tr>
                            <th class="py-3 px-4 font-semibold">Judul Buku</th>
                            <th class="py-3 px-4 font-semibold text-right">Harga Satuan</th>
                            <th class="py-3 px-4 font-semibold text-center">Qty</th>
                            <th class="py-3 px-4 font-semibold text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($order->items as $item)
                            <tr>
                                <td class="py-3 px-4">
                                    <div class="font-bold text-slate-800 text-xs sm:text-sm">{{ $item->book_title }}</div>
                                    @if($item->book)
                                        <div class="text-[11px] text-slate-400">Kategori: {{ $item->book->category->name ?? '-' }}</div>
                                    @endif
                                </td>
                                <td class="py-3 px-4 text-right text-slate-600">
                                    Rp {{ number_format($item->price, 0, ',', '.') }}
                                </td>
                                <td class="py-3 px-4 text-center font-bold text-slate-800">
                                    {{ $item->qty }}
                                </td>
                                <td class="py-3 px-4 text-right font-bold text-primary">
                                    Rp {{ number_format($item->price * $item->qty, 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-slate-50 border-t border-slate-200 font-bold">
                        <tr>
                            <td colspan="3" class="py-3 px-4 text-right text-slate-700">Total Tagihan (COD):</td>
                            <td class="py-3 px-4 text-right text-primary text-sm font-extrabold">
                                Rp {{ number_format($order->total_price, 0, ',', '.') }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <!-- Right: Customer Info & Status Update -->
        <div class="lg:col-span-4 space-y-4">
            
            <!-- Status Update Card -->
            <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm space-y-3">
                <h3 class="font-bold text-slate-900 text-xs pb-2 border-b border-slate-100">
                    Status Pesanan Saat Ini
                </h3>

                <div class="flex items-center justify-between">
                    <span class="text-xs text-slate-500">Status Sekarang:</span>
                    @if($order->status === 'pending')
                        <span class="badge badge-warning badge-sm font-semibold capitalize">{{ $order->status }}</span>
                    @elseif($order->status === 'paid' || $order->status === 'completed')
                        <span class="badge badge-success badge-sm text-white font-semibold capitalize">{{ $order->status }}</span>
                    @else
                        <span class="badge badge-error badge-sm text-white font-semibold capitalize">{{ $order->status }}</span>
                    @endif
                </div>

                <form action="{{ route('admin.orders.status', $order) }}" method="POST" class="space-y-2 pt-2 border-t border-slate-100 text-xs">
                    @csrf
                    @method('PATCH')
                    <label class="font-semibold text-slate-700 block">Perbarui Status Transaksi:</label>
                    <select name="status" class="select select-bordered select-sm w-full bg-white text-xs">
                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending (Menunggu)</option>
                        <option value="paid" {{ $order->status === 'paid' ? 'selected' : '' }}>Paid (Lunas / Selesai)</option>
                        <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled (Dibatalkan)</option>
                    </select>
                    <button type="submit" class="btn btn-primary btn-sm w-full font-semibold mt-1">
                        Simpan Perubahan Status
                    </button>
                </form>
            </div>

            <!-- Customer Details Card -->
            <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm space-y-3 text-xs">
                <h3 class="font-bold text-slate-900 pb-2 border-b border-slate-100">
                    Informasi Penerima Paket
                </h3>

                <div class="space-y-2 text-slate-600">
                    <div>
                        <span class="text-slate-400 block text-[11px]">Nama Pembeli:</span>
                        <span class="font-bold text-slate-800">{{ $order->customer_name }}</span>
                    </div>
                    <div>
                        <span class="text-slate-400 block text-[11px]">Email:</span>
                        <span class="font-medium text-slate-700">{{ $order->customer_email ?? '-' }}</span>
                    </div>
                    <div>
                        <span class="text-slate-400 block text-[11px]">Nomor Telepon:</span>
                        <span class="font-medium text-slate-700">{{ $order->customer_phone ?? '-' }}</span>
                    </div>
                    <div>
                        <span class="text-slate-400 block text-[11px]">Metode Pembayaran:</span>
                        <span class="font-semibold text-slate-800 uppercase">{{ $order->payment_method }}</span>
                    </div>
                    <div class="pt-2 border-t border-slate-100">
                        <span class="text-slate-400 block text-[11px]">Alamat Pengiriman Lengkap:</span>
                        <p class="font-medium text-slate-700 leading-relaxed mt-0.5 bg-slate-50 p-2.5 rounded-lg border border-slate-100">
                            {{ $order->shipping_address }}
                        </p>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
@endsection
