@extends('layouts.admin')

@section('content')
<div class="space-y-6">

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Dashboard Utama</h1>
            <p class="text-xs text-slate-500">Ringkasan aktivitas toko, inventaris buku, dan status transaksi</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.books.create') }}" class="btn btn-primary btn-sm text-xs font-semibold gap-1.5 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span>Tambah Buku</span>
            </a>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-ghost border border-slate-200 btn-sm text-xs text-slate-700 hover:border-slate-400">
                Lihat Pesanan
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Total Buku -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between">
            <div class="space-y-1">
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Koleksi Judul Buku</span>
                <div class="text-3xl font-extrabold text-slate-900">{{ $totalBooks }}</div>
                <span class="text-[11px] text-emerald-600 font-medium">Katalog Aktif</span>
            </div>
            <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
            </div>
        </div>

        <!-- Total Kategori -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between">
            <div class="space-y-1">
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Kategori Buku</span>
                <div class="text-3xl font-extrabold text-slate-900">{{ $totalCategories }}</div>
                <span class="text-[11px] text-slate-500 font-medium">Bidang Literasi</span>
            </div>
            <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                </svg>
            </div>
        </div>

        <!-- Pelanggan Terdaftar -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between">
            <div class="space-y-1">
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Pelanggan Member</span>
                <div class="text-3xl font-extrabold text-slate-900">{{ $totalUsers }}</div>
                <span class="text-[11px] text-slate-500 font-medium">Akun Terdaftar</span>
            </div>
            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </div>
        </div>

        <!-- Pesanan Menunggu -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between">
            <div class="space-y-1">
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Pesanan Pending</span>
                <div class="text-3xl font-extrabold text-amber-600">{{ $totalPendingOrders }}</div>
                <span class="text-[11px] text-amber-600 font-medium">Perlu Diproses</span>
            </div>
            <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Recent Orders Table -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden space-y-3">
        <div class="p-5 pb-3 border-b border-slate-100 flex items-center justify-between">
            <div>
                <h2 class="font-bold text-slate-900 text-sm sm:text-base">Pesanan Terbaru Masuk</h2>
                <p class="text-xs text-slate-500">Daftar transaksi terakhir yang membutuhkan tindak lanjut</p>
            </div>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-ghost border border-slate-200 text-xs text-primary font-semibold hover:border-primary">
                Lihat Semua &rarr;
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="table w-full text-xs">
                <thead class="bg-slate-50 border-b border-slate-200 text-slate-600">
                    <tr>
                        <th class="py-3 px-4 font-semibold">Kode Transaksi</th>
                        <th class="py-3 px-4 font-semibold">Pembeli</th>
                        <th class="py-3 px-4 font-semibold text-right">Total Tagihan</th>
                        <th class="py-3 px-4 font-semibold text-center">Metode</th>
                        <th class="py-3 px-4 font-semibold text-center">Status</th>
                        <th class="py-3 px-4 font-semibold text-center">Tanggal</th>
                        <th class="py-3 px-4 font-semibold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($recentOrders as $order)
                        <tr class="hover:bg-slate-50/50">
                            <td class="py-3 px-4 font-mono font-bold text-slate-800">{{ $order->order_code }}</td>
                            <td class="py-3 px-4">
                                <div class="font-semibold text-slate-800">{{ $order->customer_name }}</div>
                                <div class="text-[11px] text-slate-400">{{ $order->user_id ? 'Member' : 'Tamu (Guest)' }}</div>
                            </td>
                            <td class="py-3 px-4 text-right font-bold text-slate-800">
                                Rp {{ number_format($order->total_price, 0, ',', '.') }}
                            </td>
                            <td class="py-3 px-4 text-center">
                                <span class="badge badge-sm badge-ghost font-mono uppercase font-bold">{{ $order->payment_method }}</span>
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
                            <td class="py-3 px-4 text-center text-slate-500">{{ $order->created_at->format('d M Y, H:i') }}</td>
                            <td class="py-3 px-4 text-center">
                                <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-xs btn-ghost border border-slate-200 hover:border-primary">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-8 text-center text-slate-400 text-xs">
                                Belum ada pesanan terbaru yang masuk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
