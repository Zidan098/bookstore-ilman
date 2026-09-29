@extends('layouts.admin')

@section('content')
<div class="space-y-6">

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Kelola Pesanan Masuk</h1>
            <p class="text-xs text-slate-500">Daftar transaksi penjualan buku dan manajemen status pengiriman</p>
        </div>
    </div>

    <!-- Filter & Table Card -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden space-y-4">
        
        <!-- Filter Form -->
        <div class="p-4 border-b border-slate-100 bg-slate-50/50">
            <form action="{{ route('admin.orders.index') }}" method="GET" class="flex flex-col sm:flex-row items-center gap-2">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari kode pesanan / nama pembeli..."
                    class="input input-bordered input-sm w-full sm:w-72 bg-white text-xs"
                />
                <select name="status" class="select select-bordered select-sm w-full sm:w-44 bg-white text-xs">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="paid" {{ request('status') === 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
                <button type="submit" class="btn btn-sm btn-primary text-xs font-semibold px-4 w-full sm:w-auto">
                    Filter
                </button>
                @if(request('search') || request('status'))
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-ghost text-xs text-slate-500 hover:text-error w-full sm:w-auto">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="table w-full text-xs">
                <thead class="bg-slate-50 border-b border-slate-200 text-slate-600">
                    <tr>
                        <th class="py-3 px-4 font-semibold">Kode Transaksi</th>
                        <th class="py-3 px-4 font-semibold">Pembeli</th>
                        <th class="py-3 px-4 font-semibold text-right">Total Tagihan</th>
                        <th class="py-3 px-4 font-semibold text-center">Status</th>
                        <th class="py-3 px-4 font-semibold text-center">Ubah Status Cepat</th>
                        <th class="py-3 px-4 font-semibold text-center">Tanggal</th>
                        <th class="py-3 px-4 font-semibold text-center w-20">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($orders as $order)
                        <tr class="hover:bg-slate-50/50">
                            <!-- Code -->
                            <td class="py-3 px-4 font-mono font-bold text-slate-800">{{ $order->order_code }}</td>

                            <!-- Customer -->
                            <td class="py-3 px-4">
                                <div class="font-semibold text-slate-800">{{ $order->customer_name }}</div>
                                <div class="text-[11px] text-slate-400">{{ $order->user_id ? 'Member' : 'Tamu (Guest)' }}</div>
                            </td>

                            <!-- Total -->
                            <td class="py-3 px-4 text-right font-bold text-slate-800 whitespace-nowrap">
                                Rp {{ number_format($order->total_price, 0, ',', '.') }}
                            </td>

                            <!-- Status Badge -->
                            <td class="py-3 px-4 text-center whitespace-nowrap">
                                @if($order->status === 'pending')
                                    <span class="badge badge-warning badge-sm font-semibold capitalize">{{ $order->status }}</span>
                                @elseif($order->status === 'paid' || $order->status === 'completed')
                                    <span class="badge badge-success badge-sm text-white font-semibold capitalize">{{ $order->status }}</span>
                                @else
                                    <span class="badge badge-error badge-sm text-white font-semibold capitalize">{{ $order->status }}</span>
                                @endif
                            </td>

                            <!-- Quick Update -->
                            <td class="py-3 px-4 text-center whitespace-nowrap">
                                <form action="{{ route('admin.orders.status', $order) }}" method="POST" class="inline-flex items-center gap-1">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" class="select select-bordered select-xs bg-white text-xs">
                                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="paid" {{ $order->status === 'paid' ? 'selected' : '' }}>Paid</option>
                                        <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                    <button type="submit" class="btn btn-xs btn-primary font-medium">
                                        Set
                                    </button>
                                </form>
                            </td>

                            <!-- Date -->
                            <td class="py-3 px-4 text-center text-slate-500 whitespace-nowrap">
                                {{ $order->created_at->format('d M Y, H:i') }}
                            </td>

                            <!-- Action -->
                            <td class="py-3 px-4 text-center whitespace-nowrap">
                                <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-xs btn-ghost border border-slate-200 hover:border-primary">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center text-slate-400 text-xs">
                                Tidak ada data pesanan yang sesuai filter.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($orders->hasPages())
            <div class="p-4 border-t border-slate-100 flex justify-center">
                {{ $orders->links() }}
            </div>
        @endif

    </div>

</div>
@endsection
