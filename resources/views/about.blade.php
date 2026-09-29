@extends('layouts.app')

@section('content')
<div class="space-y-8">

    <!-- Breadcrumbs -->
    <div class="text-xs breadcrumbs text-slate-500 py-1">
        <ul>
            <li><a href="{{ route('home') }}" class="hover:text-primary">Beranda</a></li>
            <li class="text-slate-800 font-semibold">Tentang Kami</li>
        </ul>
    </div>

    <!-- Header Hero Banner -->
    <div class="bg-white rounded-2xl border border-slate-200 p-8 md:p-12 shadow-sm text-center max-w-4xl mx-auto space-y-4">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary/10 text-primary text-xs font-semibold">
            <span>TENTANG BACABUKU</span>
        </div>
        <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
            Menghadirkan Bahan Bacaan Berkualitas untuk Masa Depan Bangsa
        </h1>
        <p class="text-slate-600 text-sm sm:text-base leading-relaxed max-w-2xl mx-auto">
            Bacabuku adalah toko buku daring independen yang berdedikasi memfasilitasi kebutuhan literatur pelajar, mahasiswa, pengajar, dan masyarakat umum dengan jaminan 100% buku original.
        </p>
    </div>

    <!-- Story & Mission Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-5xl mx-auto">
        <!-- Visi -->
        <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm space-y-3">
            <div class="w-10 h-10 rounded-lg bg-primary/10 text-primary flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
            </div>
            <h3 class="font-bold text-slate-900 text-base">Visi Bacabuku</h3>
            <p class="text-xs text-slate-600 leading-relaxed">
                Menjadi platform distribusi buku terkemuka di Indonesia yang menjamin keaslian setiap karya cipta serta mendorong terciptanya ekosistem membaca yang mudah diakses dari seluruh pelosok tanah air.
            </p>
        </div>

        <!-- Misi -->
        <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm space-y-3">
            <div class="w-10 h-10 rounded-lg bg-primary/10 text-primary flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                </svg>
            </div>
            <h3 class="font-bold text-slate-900 text-base">Misi Kami</h3>
            <ul class="text-xs text-slate-600 leading-relaxed space-y-1 list-disc list-inside">
                <li>Menyediakan buku resmi dari penerbit terpercaya dengan harga yang terjangkau.</li>
                <li>Memberikan kemudahan bertransaksi melalui sistem Bayar di Tempat (COD).</li>
                <li>Menjaga kualitas paket pengiriman agar buku sampai dalam kondisi sempurna.</li>
            </ul>
        </div>
    </div>

    <!-- Values Grid -->
    <div class="bg-white rounded-2xl border border-slate-200 p-8 shadow-sm max-w-5xl mx-auto space-y-6">
        <div class="text-center space-y-1">
            <h2 class="text-xl font-bold text-slate-900">Nilai & Komitmen Layanan</h2>
            <p class="text-xs text-slate-500">Standar mutu operasional yang senantiasa kami jaga untuk kepuasan pembaca</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 pt-2">
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-100 space-y-2">
                <span class="font-bold text-primary text-base">01. Originalitas</span>
                <p class="text-xs text-slate-600 leading-relaxed">
                    Kami menolak segala bentuk pembajakan buku. Setiap eksemplar bersumber langsung dari penerbit resmi Indonesia.
                </p>
            </div>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-100 space-y-2">
                <span class="font-bold text-primary text-base">02. Integritas Layanan</span>
                <p class="text-xs text-slate-600 leading-relaxed">
                    Informasi stok, harga, dan deskripsi buku disajikan secara jujur dan transparan sesuai kondisi buku di gudang.
                </p>
            </div>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-100 space-y-2">
                <span class="font-bold text-primary text-base">03. Kecepatan Pengiriman</span>
                <p class="text-xs text-slate-600 leading-relaxed">
                    Pesanan diproses segera pada hari kerja yang sama dengan kemasan berlapis bubble wrap tanpa biaya ekstra.
                </p>
            </div>
        </div>
    </div>

    <!-- CTA -->
    <div class="text-center pt-4">
        <a href="{{ route('books.index') }}" class="btn btn-primary btn-md shadow-sm font-semibold">
            Mulai Belanja Buku Sekarang &rarr;
        </a>
    </div>

</div>
@endsection
