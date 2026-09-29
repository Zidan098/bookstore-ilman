@extends('layouts.admin')

@section('content')
<div class="space-y-6 max-w-5xl mx-auto">

    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Detail Profil Pelanggan</h1>
            <p class="text-xs text-slate-500">Histori dan informasi akun pembeli di Bacabuku</p>
        </div>
        <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-ghost border border-slate-200 text-xs text-slate-700">
            &larr; Kembali ke Daftar
        </a>
    </div>

    <!-- 2-Column Layout -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-start">
        
        <!-- Left: User Profile Card -->
        <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm space-y-4 md:col-span-1">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-xl bg-primary text-white flex items-center justify-center font-bold text-base">
                    {{ strtoupper(substr($user->name, 0, 2)) }}
                </div>
                <div>
                    <h2 class="font-bold text-slate-900 text-sm sm:text-base">{{ $user->name }}</h2>
                    <span class="badge badge-primary badge-sm font-semibold capitalize">{{ $user->role }}</span>
                </div>
            </div>

            <div class="pt-3 border-t border-slate-100 space-y-3 text-xs text-slate-600">
                <div>
                    <span class="text-slate-400 block text-[11px]">Alamat Email:</span>
                    <span class="font-semibold text-slate-800">{{ $user->email }}</span>
                </div>
                <div>
                    <span class="text-slate-400 block text-[11px]">Nomor WhatsApp / HP:</span>
                    <span class="font-semibold text-slate-800">{{ $user->phone ?? '-' }}</span>
                </div>
                <div>
                    <span class="text-slate-400 block text-[11px]">Alamat Pengiriman Default:</span>
                    <span class="font-medium text-slate-700 leading-relaxed block mt-0.5 bg-slate-50 p-2.5 rounded-lg border border-slate-100">
                        {{ $user->address ?? 'Belum ada alamat tersimpan.' }}
                    </span>
                </div>
                <div>
                    <span class="text-slate-400 block text-[11px]">Waktu Terdaftar:</span>
                    <span class="font-medium text-slate-700">{{ $user->created_at->format('d F Y, H:i') }} WIB</span>
                </div>
            </div>
        </div>

        <!-- Right: Order History -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden md:col-span-2 space-y-3">
            <div class="p-5 pb-3 border-b border-slate-100">
                <h3 class="font-bold text-slate-900 text-sm">Riwayat Pembelian Pelanggan</h3>
            </div>

            <div class="overflow-x-auto">
                <table class="table w-full text-xs">
                    <thead class="bg-slate-50 border-b border-slate-200 text-slate-600">
                        <tr>
                            <th class="py-3 px-4 font-semibold">Kode Transaksi</th>
                            <th class="py-3 px-4 font-semibold text-right">Total Tagihan</th>
                            <th class="py-3 px-4 font-semibold text-center">Status</th>
                            <th class="py-3 px-4 font-semibold text-center">Tanggal</th>
                            <th class="py-3 px-4 font-semibold text-center w-20">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($user->orders as $order)
                            <tr class="hover:bg-slate-50/50">
                                <td class="py-3 px-4 font-mono font-bold text-slate-800">{{ $order->order_code }}</td>
                                <td class="py-3 px-4 text-right font-bold text-slate-800">
                                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                </td>
                                <td class="py-3 px-4 text-center">
                                    @if($order->status === 'pending')
                                        <span class="badge badge-warning badge-sm font-semibold capitalize">{{ $order->status }}</span>
                                    @elseif($order->status === 'paid' || $order->status === 'completed')
                                        <span class="badge badge-success badge-sm text-white font-semibold capitalize">{{ $order->status }}</span>
                                    @else
                                        <span class="badge badge-error badge-sm text-white font-semibold capitalize">{{ $order->status }}</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 text-center text-slate-500">
                                    {{ $order->created_at->format('d M Y') }}
                                </td>
                                <td class="py-3 px-4 text-center">
                                    <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-xs btn-ghost border border-slate-200 hover:border-primary">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-8 text-center text-slate-400 text-xs">
                                    Pelanggan ini belum melakukan pembelian.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</div>
@endsection
