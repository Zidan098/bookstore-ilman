@extends('layouts.admin')

@section('content')
<div class="space-y-6">

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Kelola Koleksi Buku</h1>
            <p class="text-xs text-slate-500">Daftar inventaris seluruh judul buku dan stok fisik di gudang</p>
        </div>
        <a href="{{ route('admin.books.create') }}" class="btn btn-primary btn-sm text-xs font-semibold gap-1.5 shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            <span>+ Tambah Buku Baru</span>
        </a>
    </div>

    <!-- Filter & Table Card -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden space-y-4">
        
        <!-- Search & Filter Form -->
        <div class="p-4 border-b border-slate-100 bg-slate-50/50">
            <form action="{{ route('admin.books.index') }}" method="GET" class="flex flex-col sm:flex-row items-center gap-2">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari judul atau nama penulis..."
                    class="input input-bordered input-sm w-full sm:w-72 bg-white text-xs"
                />
                <select name="category_id" class="select select-bordered select-sm w-full sm:w-52 bg-white text-xs">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-sm btn-primary text-xs font-semibold px-4 w-full sm:w-auto">
                    Filter
                </button>
                @if(request('search') || request('category_id'))
                    <a href="{{ route('admin.books.index') }}" class="btn btn-sm btn-ghost text-xs text-slate-500 hover:text-error w-full sm:w-auto">
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
                        <th class="py-3 px-4 font-semibold w-16 text-center">Sampul</th>
                        <th class="py-3 px-4 font-semibold">Judul Buku & Penulis</th>
                        <th class="py-3 px-4 font-semibold">Kategori</th>
                        <th class="py-3 px-4 font-semibold text-right">Harga Satuan</th>
                        <th class="py-3 px-4 font-semibold text-center">Sisa Stok</th>
                        <th class="py-3 px-4 font-semibold text-center w-32">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($books as $book)
                        <tr class="hover:bg-slate-50/50">
                            <!-- Cover -->
                            <td class="py-3 px-4 text-center">
                                <div class="w-10 h-14 bg-slate-100 rounded border border-slate-200 overflow-hidden mx-auto flex items-center justify-center">
                                    @if($book->cover)
                                        <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}" class="w-full h-full object-cover">
                                    @else
                                        <span class="text-[9px] text-slate-400 font-bold">BUKU</span>
                                    @endif
                                </div>
                            </td>

                            <!-- Title & Author -->
                            <td class="py-3 px-4">
                                <div class="font-bold text-slate-800 text-xs sm:text-sm line-clamp-1">{{ $book->title }}</div>
                                <div class="text-[11px] text-slate-500">Penulis: {{ $book->author }}</div>
                            </td>

                            <!-- Category -->
                            <td class="py-3 px-4 whitespace-nowrap">
                                <span class="badge badge-sm badge-ghost text-slate-600 font-medium">
                                    {{ $book->category->name ?? '-' }}
                                </span>
                            </td>

                            <!-- Price -->
                            <td class="py-3 px-4 text-right font-bold text-slate-800 whitespace-nowrap">
                                Rp {{ number_format($book->price, 0, ',', '.') }}
                            </td>

                            <!-- Stock -->
                            <td class="py-3 px-4 text-center whitespace-nowrap">
                                @if($book->stock > 5)
                                    <span class="badge badge-sm badge-success text-white font-semibold">{{ $book->stock }} eks</span>
                                @elseif($book->stock > 0)
                                    <span class="badge badge-sm badge-warning font-semibold">{{ $book->stock }} eks</span>
                                @else
                                    <span class="badge badge-sm badge-error text-white font-semibold">Habis</span>
                                @endif
                            </td>

                            <!-- Actions -->
                            <td class="py-3 px-4 text-center whitespace-nowrap">
                                <div class="flex items-center justify-center gap-1">
                                    <a href="{{ route('admin.books.edit', $book) }}" class="btn btn-xs btn-ghost border border-slate-200 hover:border-primary" title="Edit Data Buku">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.books.destroy', $book) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini dari database?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-xs btn-ghost text-rose-500 hover:bg-rose-50" title="Hapus Buku">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center text-slate-400 text-xs">
                                Tidak ada data buku yang ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($books->hasPages())
            <div class="p-4 border-t border-slate-100 flex justify-center">
                {{ $books->links() }}
            </div>
        @endif

    </div>

</div>
@endsection
