@extends('layouts.admin')

@section('content')
<div class="space-y-6">

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Kelola Kategori Buku</h1>
            <p class="text-xs text-slate-500">Daftar klasifikasi kategori untuk pengelompokan buku di katalog</p>
        </div>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-sm text-xs font-semibold gap-1.5 shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            <span>+ Tambah Kategori</span>
        </a>
    </div>

    <!-- Filter & Table Card -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden space-y-4">
        
        <!-- Search Form -->
        <div class="p-4 border-b border-slate-100 bg-slate-50/50">
            <form action="{{ route('admin.categories.index') }}" method="GET" class="flex items-center gap-2 max-w-sm">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari nama kategori..."
                    class="input input-bordered input-sm w-full bg-white text-xs"
                />
                <button type="submit" class="btn btn-sm btn-primary text-xs font-semibold px-4">
                    Cari
                </button>
                @if(request('search'))
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-sm btn-ghost text-xs text-slate-500 hover:text-error">
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
                        <th class="py-3 px-4 font-semibold w-16 text-center">No</th>
                        <th class="py-3 px-4 font-semibold">Nama Kategori</th>
                        <th class="py-3 px-4 font-semibold">Slug URL</th>
                        <th class="py-3 px-4 font-semibold text-center">Jumlah Judul Buku</th>
                        <th class="py-3 px-4 font-semibold text-center w-32">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($categories as $index => $category)
                        <tr class="hover:bg-slate-50/50">
                            <td class="py-3 px-4 text-center font-bold text-slate-400">
                                {{ $categories->firstItem() + $index }}
                            </td>
                            <td class="py-3 px-4 font-bold text-slate-800 text-sm">
                                {{ $category->name }}
                            </td>
                            <td class="py-3 px-4 font-mono text-slate-500">
                                {{ $category->slug }}
                            </td>
                            <td class="py-3 px-4 text-center">
                                <span class="badge badge-sm badge-ghost text-slate-700 font-semibold">
                                    {{ $category->books_count }} buku
                                </span>
                            </td>
                            <td class="py-3 px-4 text-center whitespace-nowrap">
                                <div class="flex items-center justify-center gap-1">
                                    <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-xs btn-ghost border border-slate-200 hover:border-primary">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-xs btn-ghost text-rose-500 hover:bg-rose-50">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center text-slate-400 text-xs">
                                Tidak ada kategori yang ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($categories->hasPages())
            <div class="p-4 border-t border-slate-100 flex justify-center">
                {{ $categories->links() }}
            </div>
        @endif

    </div>

</div>
@endsection
