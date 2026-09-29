@extends('layouts.app')

@section('content')
<div class="space-y-6">

    <!-- Breadcrumbs -->
    <div class="text-xs breadcrumbs text-slate-500 py-1">
        <ul>
            <li><a href="{{ route('home') }}" class="hover:text-primary">Beranda</a></li>
            <li class="text-slate-800 font-semibold">Hubungi Kami</li>
        </ul>
    </div>

    <!-- 2-Column Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        <!-- Left: Form -->
        <div class="lg:col-span-7 bg-white rounded-2xl border border-slate-200 p-6 md:p-8 shadow-sm space-y-5">
            <div>
                <h1 class="text-2xl font-bold text-slate-900">Hubungi Layanan Pengelola</h1>
                <p class="text-xs text-slate-500 mt-1">
                    Silakan isi formulir di bawah ini untuk menyampaikan pertanyaan, konsultasi pesanan buku, atau masukan.
                </p>
            </div>

            <!-- Sender Info Card -->
            <div class="bg-slate-50 p-3.5 rounded-xl border border-slate-200 text-xs flex items-center justify-between">
                <div>
                    <span class="text-slate-400 block text-[10px] font-semibold">PENGIRIM:</span>
                    <span class="font-bold text-slate-800">{{ auth()->user()->name }}</span>
                    <span class="text-slate-500">({{ auth()->user()->email }})</span>
                </div>
                <span class="badge badge-primary badge-sm font-semibold">Akun Terverifikasi</span>
            </div>

            <form action="{{ route('contact.store') }}" method="POST" class="space-y-4 text-xs">
                @csrf

                <div class="space-y-1.5">
                    <label class="font-semibold text-slate-700">Subjek Pesan <span class="text-error">*</span></label>
                    <input
                        type="text"
                        name="subject"
                        value="{{ old('subject') }}"
                        placeholder="Contoh: Pertanyaan Ketersediaan Stok Buku Pemrograman"
                        class="input input-bordered input-sm w-full bg-white text-xs @error('subject') input-error @enderror"
                        required
                    />
                    @error('subject') <span class="text-[11px] text-error">{{ $message }}</span> @enderror
                </div>

                <div class="space-y-1.5">
                    <label class="font-semibold text-slate-700">Rincian Isi Pesan <span class="text-error">*</span></label>
                    <textarea
                        name="body"
                        rows="5"
                        placeholder="Tuliskan pertanyaan atau informasi Anda secara terperinci..."
                        class="textarea textarea-bordered w-full bg-white text-xs leading-relaxed @error('body') textarea-error @enderror"
                        required
                    >{{ old('body') }}</textarea>
                    @error('body') <span class="text-[11px] text-error">{{ $message }}</span> @enderror
                </div>

                <div class="pt-2">
                    <button type="submit" class="btn btn-primary btn-md w-full sm:w-auto font-semibold gap-2 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                        </svg>
                        <span>Kirimkan Pesan Sekarang</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Right: Contact Information & Hours -->
        <div class="lg:col-span-5 space-y-4">
            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm space-y-4">
                <h3 class="font-bold text-slate-900 text-sm pb-3 border-b border-slate-100">
                    Informasi Kontak & Layanan
                </h3>

                <div class="space-y-3 text-xs text-slate-600">
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <span class="font-bold text-slate-800 block">Jam Operasional Layanan</span>
                            <span class="text-slate-500">Senin – Sabtu: 08:00 – 20:00 WIB</span>
                            <p class="text-[11px] text-slate-400 mt-0.5">Hari Minggu & Libur Nasional libur</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                        <div>
                            <span class="font-bold text-slate-800 block">Kontak WhatsApp</span>
                            <span class="text-slate-500">0812-3456-7890</span>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg bg-purple-50 text-purple-600 flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <span class="font-bold text-slate-800 block">Email Resmi</span>
                            <span class="text-slate-500">bantuan@bacabuku.id</span>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div>
                            <span class="font-bold text-slate-800 block">Gudang & Kantor Distribusi</span>
                            <span class="text-slate-500">Jl. Salemba Raya No. 45, Senen, Jakarta Pusat, DKI Jakarta 10440</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
