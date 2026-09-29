@extends('layouts.admin')

@section('content')
<div class="space-y-6">

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Data Pelanggan Terdaftar</h1>
            <p class="text-xs text-slate-500">Daftar pengguna terdaftar yang berbelanja di toko buku Bacabuku</p>
        </div>
    </div>

    <!-- Filter & Table Card -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden space-y-4">
        
        <!-- Search Form -->
        <div class="p-4 border-b border-slate-100 bg-slate-50/50">
            <form action="{{ route('admin.users.index') }}" method="GET" class="flex items-center gap-2 max-w-sm">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari nama / email pelanggan..."
                    class="input input-bordered input-sm w-full bg-white text-xs"
                />
                <button type="submit" class="btn btn-sm btn-primary text-xs font-semibold px-4">
                    Cari
                </button>
                @if(request('search'))
                    <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-ghost text-xs text-slate-500 hover:text-error">
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
                        <th class="py-3 px-4 font-semibold">Pelanggan</th>
                        <th class="py-3 px-4 font-semibold">Nomor Telepon</th>
                        <th class="py-3 px-4 font-semibold text-center">Total Pesanan</th>
                        <th class="py-3 px-4 font-semibold text-center">Terdaftar Sejak</th>
                        <th class="py-3 px-4 font-semibold text-center w-24">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($users as $user)
                        <tr class="hover:bg-slate-50/50">
                            <!-- Customer Info -->
                            <td class="py-3 px-4">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-8 h-8 rounded-full bg-primary/10 text-primary flex items-center justify-center font-bold text-xs shrink-0">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="font-bold text-slate-800 text-xs sm:text-sm">{{ $user->name }}</div>
                                        <div class="text-[11px] text-slate-400">{{ $user->email }}</div>
                                    </div>
                                </div>
                            </td>

                            <!-- Phone -->
                            <td class="py-3 px-4 text-slate-600">
                                {{ $user->phone ?? '-' }}
                            </td>

                            <!-- Total Orders -->
                            <td class="py-3 px-4 text-center">
                                <span class="badge badge-sm badge-ghost font-semibold text-slate-700">
                                    {{ $user->orders_count }} transaksi
                                </span>
                            </td>

                            <!-- Date -->
                            <td class="py-3 px-4 text-center text-slate-500">
                                {{ $user->created_at->format('d M Y') }}
                            </td>

                            <!-- Action -->
                            <td class="py-3 px-4 text-center">
                                <a href="{{ route('admin.users.show', $user) }}" class="btn btn-xs btn-ghost border border-slate-200 hover:border-primary">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center text-slate-400 text-xs">
                                Tidak ada data pelanggan yang sesuai.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($users->hasPages())
            <div class="p-4 border-t border-slate-100 flex justify-center">
                {{ $users->links() }}
            </div>
        @endif

    </div>

</div>
@endsection
