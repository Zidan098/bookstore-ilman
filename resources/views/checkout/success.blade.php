@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto space-y-6 py-6">

    <!-- Success Header Card -->
    <div class="bg-white rounded-2xl border border-slate-200 p-8 shadow-sm text-center space-y-4">
        <div class="w-16 h-16 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center mx-auto">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
        </div>

        <div class="space-y-1">
            <span class="badge badge-success badge-sm text-white font-semibold">PESANAN DITERIMA</span>
            <h1 class="text-2xl font-bold text-slate-900">Terima Kasih Atas Pesanan Anda!</h1>
            <p class="text-xs text-slate-500 max-w-md mx-auto">
                Pesanan buku Anda telah berhasil dicatat ke sistem kami. Tim Bacabuku akan segera menyiapkan pesanan untuk pengiriman.
            </p>
        </div>

        <div class="inline-block bg-slate-50 border border-slate-200 px-4 py-2 rounded-lg">
            <span class="text-[11px] text-slate-500 block">Kode Pesanan Anda:</span>
            <span class="font-mono font-bold text-slate-800 text-sm tracking-wide">{{ $order->order_code }}</span>
        </div>
    </div>

    <!-- Receipt / Order Detail Card -->
    <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm space-y-5">
        <div class="flex items-center justify-between pb-3 border-b border-slate-100">
            <h2 class="font-bold text-slate-900 text-sm">Rincian Informasi Pengiriman</h2>
            <span class="text-xs text-slate-400">{{ $order->created_at->format('d M Y, H:i') }} WIB</span>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
            <div class="p-3 bg-slate-50 rounded-lg border border-slate-100">
                <span class="text-slate-400 block text-[11px]">Nama Pembeli:</span>
                <span class="font-semibold text-slate-800">{{ $order->customer_name }}</span>
            </div>
            <div class="p-3 bg-slate-50 rounded-lg border border-slate-100">
                <span class="text-slate-400 block text-[11px]">Kontak WhatsApp / HP:</span>
                <span class="font-semibold text-slate-800">{{ $order->customer_phone ?? '-' }}</span>
            </div>
            <div class="p-3 bg-slate-50 rounded-lg border border-slate-100">
                <span class="text-slate-400 block text-[11px]">Metode Pembayaran:</span>
                <span class="font-semibold text-slate-800 uppercase">{{ $order->payment_method }} (Bayar di Tempat)</span>
            </div>
            <div class="p-3 bg-slate-50 rounded-lg border border-slate-100">
                <span class="text-slate-400 block text-[11px]">Status Pesanan:</span>
                <span class="badge badge-warning badge-sm font-semibold capitalize">{{ $order->status }}</span>
            </div>
            <div class="p-3 bg-slate-50 rounded-lg border border-slate-100 sm:col-span-2">
                <span class="text-slate-400 block text-[11px]">Alamat Tujuan:</span>
                <span class="font-medium text-slate-700 leading-relaxed">{{ $order->shipping_address }}</span>
            </div>
        </div>

        <!-- Items Table -->
        <div class="pt-2">
            <h3 class="font-bold text-slate-900 text-xs mb-2">Buku yang Dipesan:</h3>
            <div class="border border-slate-200 rounded-lg overflow-hidden">
                <table class="table table-sm w-full text-xs">
                    <thead class="bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th class="py-2 px-3 font-semibold text-slate-600">Judul Buku</th>
                            <th class="py-2 px-3 font-semibold text-center text-slate-600">Qty</th>
                            <th class="py-2 px-3 font-semibold text-right text-slate-600">Harga Satuan</th>
                            <th class="py-2 px-3 font-semibold text-right text-slate-600">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($order->items as $item)
                            <tr>
                                <td class="py-2.5 px-3 font-medium text-slate-800">{{ $item->book_title }}</td>
                                <td class="py-2.5 px-3 text-center text-slate-600">{{ $item->qty }}</td>
                                <td class="py-2.5 px-3 text-right text-slate-600">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                <td class="py-2.5 px-3 text-right font-semibold text-slate-800">
                                    Rp {{ number_format($item->price * $item->qty, 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-slate-50 border-t border-slate-200">
                        <tr>
                            <td colspan="3" class="py-2.5 px-3 text-right font-bold text-slate-700">Total Tagihan (COD):</td>
                            <td class="py-2.5 px-3 text-right font-extrabold text-primary text-sm">
                                Rp {{ number_format($order->total_price, 0, ',', '.') }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="pt-4 flex flex-col sm:flex-row items-center justify-between gap-3 border-t border-slate-100">
            <button onclick="window.print()" class="btn btn-sm btn-ghost border border-slate-200 text-xs text-slate-700 gap-1.5 w-full sm:w-auto">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                </svg>
                <span>Cetak Nota / Simpan</span>
            </button>
            <a href="{{ route('home') }}" class="btn btn-sm btn-primary text-xs w-full sm:w-auto">
                Kembali ke Beranda
            </a>
        </div>
    </div>

</div>
@endsection
