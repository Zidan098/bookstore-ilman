@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Perbarui Data Buku</h1>
            <p class="text-xs text-slate-500">Ubah informasi atau sesuaikan stok untuk buku "{{ $book->title }}"</p>
        </div>
        <a href="{{ route('admin.books.index') }}" class="btn btn-sm btn-ghost border border-slate-200 text-xs text-slate-700">
            &larr; Kembali
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl border border-slate-200 p-6 md:p-8 shadow-sm">
        <form action="{{ route('admin.books.update', $book) }}" method="POST" enctype="multipart/form-data" class="space-y-4 text-xs">
            @csrf
            @method('PUT')

            <!-- Category -->
            <div class="space-y-1.5">
                <label class="font-semibold text-slate-700">Kategori Buku <span class="text-error">*</span></label>
                <select name="category_id" class="select select-bordered select-sm w-full bg-white text-xs @error('category_id') select-error @enderror" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') <span class="text-[11px] text-error">{{ $message }}</span> @enderror
            </div>

            <!-- Title -->
            <div class="space-y-1.5">
                <label class="font-semibold text-slate-700">Judul Buku <span class="text-error">*</span></label>
                <input
                    type="text"
                    name="title"
                    value="{{ old('title', $book->title) }}"
                    class="input input-bordered input-sm w-full bg-white text-xs @error('title') input-error @enderror"
                    required
                />
                @error('title') <span class="text-[11px] text-error">{{ $message }}</span> @enderror
            </div>

            <!-- Author -->
            <div class="space-y-1.5">
                <label class="font-semibold text-slate-700">Penulis / Pengarang <span class="text-error">*</span></label>
                <input
                    type="text"
                    name="author"
                    value="{{ old('author', $book->author) }}"
                    class="input input-bordered input-sm w-full bg-white text-xs @error('author') input-error @enderror"
                    required
                />
                @error('author') <span class="text-[11px] text-error">{{ $message }}</span> @enderror
            </div>

            <!-- Price & Stock -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="font-semibold text-slate-700">Harga Jual (Rp) <span class="text-error">*</span></label>
                    <input
                        type="number"
                        name="price"
                        value="{{ old('price', (int)$book->price) }}"
                        min="0"
                        step="1000"
                        class="input input-bordered input-sm w-full bg-white text-xs @error('price') input-error @enderror"
                        required
                    />
                    @error('price') <span class="text-[11px] text-error">{{ $message }}</span> @enderror
                </div>

                <div class="space-y-1.5">
                    <label class="font-semibold text-slate-700">Jumlah Stok Fisik <span class="text-error">*</span></label>
                    <input
                        type="number"
                        name="stock"
                        value="{{ old('stock', $book->stock) }}"
                        min="0"
                        class="input input-bordered input-sm w-full bg-white text-xs @error('stock') input-error @enderror"
                        required
                    />
                    @error('stock') <span class="text-[11px] text-error">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Cover Image Preview & Upload -->
            <div class="space-y-1.5">
                <label class="font-semibold text-slate-700">Gambar Sampul</label>
                @if($book->cover)
                    <div class="flex items-center gap-3 p-3 bg-slate-50 rounded-xl border border-slate-200 mb-2">
                        <div class="w-12 h-16 bg-white rounded border border-slate-200 overflow-hidden shrink-0">
                            <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}" class="w-full h-full object-cover">
                        </div>
                        <div class="text-[11px] text-slate-500">
                            <span class="font-semibold text-slate-700 block">Sampul saat ini</span>
                            Unggah file baru di bawah ini bila ingin mengganti cover buku.
                        </div>
                    </div>
                @endif
                <input
                    type="file"
                    name="cover"
                    accept="image/*"
                    class="file-input file-input-bordered file-input-sm w-full bg-white text-xs @error('cover') file-input-error @enderror"
                />
                <p class="text-[11px] text-slate-400">Kosongkan jika tidak ingin mengganti sampul.</p>
                @error('cover') <span class="text-[11px] text-error">{{ $message }}</span> @enderror
            </div>

            <!-- Description -->
            <div class="space-y-1.5">
                <label class="font-semibold text-slate-700">Deskripsi / Sinopsis Buku <span class="text-error">*</span></label>
                <textarea
                    name="description"
                    rows="5"
                    class="textarea textarea-bordered w-full bg-white text-xs leading-relaxed @error('description') textarea-error @enderror"
                    required
                >{{ old('description', $book->description) }}</textarea>
                @error('description') <span class="text-[11px] text-error">{{ $message }}</span> @enderror
            </div>

            <!-- Action Buttons -->
            <div class="pt-4 flex items-center gap-2 border-t border-slate-100">
                <button type="submit" class="btn btn-primary btn-sm font-semibold shadow-sm px-6">
                    Perbarui Data Buku
                </button>
                <a href="{{ route('admin.books.index') }}" class="btn btn-ghost btn-sm text-slate-600">
                    Batal
                </a>
            </div>
        </form>
    </div>

</div>
@endsection
