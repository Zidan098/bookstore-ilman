@extends('layouts.admin')

@section('content')
<div class="max-w-xl mx-auto space-y-6">

    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Perbarui Kategori</h1>
            <p class="text-xs text-slate-500">Ubah nama atau klasifikasi kategori buku</p>
        </div>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-sm btn-ghost border border-slate-200 text-xs text-slate-700">
            &larr; Kembali
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl border border-slate-200 p-6 md:p-8 shadow-sm">
        <form action="{{ route('admin.categories.update', $category) }}" method="POST" class="space-y-4 text-xs">
            @csrf
            @method('PUT')

            <div class="space-y-1.5">
                <label class="font-semibold text-slate-700">Nama Kategori Buku <span class="text-error">*</span></label>
                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $category->name) }}"
                    class="input input-bordered input-sm w-full bg-white text-xs @error('name') input-error @enderror"
                    required
                    autofocus
                />
                @error('name') <span class="text-[11px] text-error">{{ $message }}</span> @enderror
            </div>

            <div class="space-y-1.5">
                <label class="font-semibold text-slate-700">Slug URL</label>
                <input
                    type="text"
                    value="{{ $category->slug }}"
                    class="input input-bordered input-sm w-full bg-slate-100 text-slate-500 text-xs font-mono"
                    readonly
                />
            </div>

            <div class="pt-4 flex items-center gap-2 border-t border-slate-100">
                <button type="submit" class="btn btn-primary btn-sm font-semibold shadow-sm px-6">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-ghost btn-sm text-slate-600">
                    Batal
                </a>
            </div>
        </form>
    </div>

</div>
@endsection
