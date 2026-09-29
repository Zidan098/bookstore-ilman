@extends('layouts.app')

@section('content')
<div class="space-y-6">

    <!-- Breadcrumbs -->
    <div class="text-xs breadcrumbs text-slate-500 py-1">
        <ul>
            <li><a href="{{ route('home') }}" class="hover:text-primary">Beranda</a></li>
            <li><a href="{{ route('cart.index') }}" class="hover:text-primary">Keranjang</a></li>
            <li class="text-slate-800 font-semibold">Checkout & Pengiriman</li>
        </ul>
    </div>

    <!-- Step Progress Indicator -->
    <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm max-w-2xl mx-auto">
        <ul class="steps steps-horizontal w-full text-xs">
            <li class="step step-primary font-semibold">Keranjang Belanja</li>
            <li class="step step-primary font-semibold">Data Pengiriman</li>
            <li class="step font-medium text-slate-400">Konfirmasi / Selesai</li>
        </ul>
    </div>

    <form action="{{ route('checkout.store') }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
            
            <!-- Left Form: Shipping Details -->
            <div class="lg:col-span-7 space-y-6">

                <!-- 1. Customer Information -->
                <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm space-y-4">
                    <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                        <div class="flex items-center gap-2">
                            <span class="w-6 h-6 rounded-full bg-primary text-white text-xs font-bold flex items-center justify-center">1</span>
                            <h2 class="font-bold text-slate-900 text-sm sm:text-base">Informasi Pembeli</h2>
                        </div>
                        @guest
                            <a href="{{ route('login') }}" class="text-xs text-primary font-medium hover:underline">
                                Sudah punya akun? Masuk
                            </a>
                        @endguest
                    </div>

                    @auth
                        <div class="bg-slate-50 p-4 rounded-xl border border-slate-200 space-y-2 text-xs">
                            <div class="flex justify-between py-1 border-b border-slate-200/60">
                                <span class="text-slate-500">Nama Akun:</span>
                                <span class="font-bold text-slate-800">{{ auth()->user()->name }}</span>
                            </div>
                            <div class="flex justify-between py-1 border-b border-slate-200/60">
                                <span class="text-slate-500">Alamat Email:</span>
                                <span class="font-bold text-slate-800">{{ auth()->user()->email }}</span>
                            </div>
                            @if(auth()->user()->phone)
                                <div class="flex justify-between py-1">
                                    <span class="text-slate-500">Nomor Telepon:</span>
                                    <span class="font-bold text-slate-800">{{ auth()->user()->phone }}</span>
                                </div>
                            @endif
                            <p class="text-[11px] text-emerald-600 font-medium pt-1">
                                &check; Anda checkout menggunakan akun terdaftar.
                            </p>
                        </div>
                    @else
                        <div class="space-y-4 text-xs">
                            <div class="space-y-1.5">
                                <label class="font-semibold text-slate-700">Nama Lengkap Penerima <span class="text-error">*</span></label>
                                <input
                                    type="text"
                                    name="guest_name"
                                    value="{{ old('guest_name') }}"
                                    placeholder="Contoh: Muhammad Ilman"
                                    class="input input-bordered input-sm w-full bg-white text-xs @error('guest_name') input-error @enderror"
                                    required
                                />
                                @error('guest_name') <span class="text-[11px] text-error">{{ $message }}</span> @enderror
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="space-y-1.5">
                                    <label class="font-semibold text-slate-700">Alamat Email <span class="text-error">*</span></label>
                                    <input
                                        type="email"
                                        name="guest_email"
                                        value="{{ old('guest_email') }}"
                                        placeholder="nama@email.com"
                                        class="input input-bordered input-sm w-full bg-white text-xs @error('guest_email') input-error @enderror"
                                        required
                                    />
                                    @error('guest_email') <span class="text-[11px] text-error">{{ $message }}</span> @enderror
                                </div>

                                <div class="space-y-1.5">
                                    <label class="font-semibold text-slate-700">Nomor WhatsApp / HP <span class="text-error">*</span></label>
                                    <input
                                        type="text"
                                        name="guest_phone"
                                        value="{{ old('guest_phone') }}"
                                        placeholder="081234567890"
                                        class="input input-bordered input-sm w-full bg-white text-xs @error('guest_phone') input-error @enderror"
                                        required
                                    />
                                    @error('guest_phone') <span class="text-[11px] text-error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    @endauth
                </div>

                <!-- 2. Shipping Address -->
                <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm space-y-4">
                    <div class="flex items-center gap-2 pb-3 border-b border-slate-100">
                        <span class="w-6 h-6 rounded-full bg-primary text-white text-xs font-bold flex items-center justify-center">2</span>
                        <h2 class="font-bold text-slate-900 text-sm sm:text-base">Alamat Pengiriman</h2>
                    </div>

                    <div class="space-y-1.5 text-xs">
                        <label class="font-semibold text-slate-700">Alamat Lengkap Tujuan <span class="text-error">*</span></label>
                        <textarea
                            name="shipping_address"
                            rows="4"
                            placeholder="Tuliskan nama jalan, nomor rumah, RT/RW, kelurahan, kecamatan, kota/kabupaten, dan kode pos tujuan pengiriman..."
                            class="textarea textarea-bordered w-full bg-white text-xs leading-relaxed @error('shipping_address') textarea-error @enderror"
                            required
                        >{{ old('shipping_address') }}</textarea>
                        @error('shipping_address') <span class="text-[11px] text-error">{{ $message }}</span> @enderror
                        <p class="text-[11px] text-slate-400">Pastikan alamat jelas agar kurir dapat mengantarkan paket dengan cepat.</p>
                    </div>
                </div>

                <!-- 3. Payment Method -->
                <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm space-y-4">
                    <div class="flex items-center gap-2 pb-3 border-b border-slate-100">
                        <span class="w-6 h-6 rounded-full bg-primary text-white text-xs font-bold flex items-center justify-center">3</span>
                        <h2 class="font-bold text-slate-900 text-sm sm:text-base">Metode Pembayaran</h2>
                    </div>

                    <div class="bg-slate-50 p-4 rounded-xl border border-primary/30 flex items-start gap-3">
                        <input type="radio" name="payment_method" value="cod" checked class="radio radio-primary radio-sm mt-0.5" />
                        <div class="space-y-1">
                            <div class="flex items-center gap-2">
                                <span class="font-bold text-slate-800 text-xs sm:text-sm">Bayar di Tempat (Cash on Delivery / COD)</span>
                                <span class="badge badge-primary badge-sm font-semibold">Aktif</span>
                            </div>
                            <p class="text-xs text-slate-500 leading-relaxed">
                                Bayar tunai kepada kurir saat buku telah sampai di alamat tujuan Anda. Aman, praktis, dan tanpa repot transfer bank.
                            </p>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Right Sidebar: Order Review & Submit -->
            <div class="lg:col-span-5 space-y-4">
                <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm space-y-4 sticky top-24">
                    <h3 class="font-bold text-slate-900 text-base pb-3 border-b border-slate-100">
                        Ringkasan Pesanan
                    </h3>

                    <!-- Mini Cart List -->
                    <div class="space-y-3 max-h-60 overflow-y-auto pr-1">
                        @foreach($cart as $item)
                            <div class="flex items-center gap-3 text-xs">
                                <div class="w-10 h-14 bg-slate-100 rounded border border-slate-200 overflow-hidden shrink-0">
                                    @if(!empty($item['cover']))
                                        <img src="{{ asset('storage/' . $item['cover']) }}" alt="{{ $item['title'] }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-[9px] text-slate-400 font-bold">
                                            BUKU
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-bold text-slate-900 line-clamp-1">{{ $item['title'] }}</h4>
                                    <p class="text-[11px] text-slate-500">{{ $item['qty'] }} x Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                                </div>
                                <div class="font-semibold text-slate-800 shrink-0">
                                    Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="border-t border-slate-100 pt-3 space-y-2 text-xs text-slate-600">
                        <div class="flex justify-between">
                            <span>Subtotal Buku</span>
                            <span class="font-semibold text-slate-800">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Biaya Pengiriman</span>
                            <span class="text-emerald-600 font-semibold">Gratis Ongkir</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Biaya Layanan COD</span>
                            <span class="text-emerald-600 font-semibold">Gratis</span>
                        </div>
                    </div>

                    <div class="border-t border-slate-100 pt-3 flex justify-between items-center">
                        <span class="font-bold text-slate-900 text-sm">Total Pembayaran:</span>
                        <span class="text-xl font-extrabold text-primary">
                            Rp {{ number_format($total, 0, ',', '.') }}
                        </span>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="btn btn-primary btn-md btn-block font-semibold shadow-sm gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Konfirmasi Pesanan Sekarang</span>
                        </button>
                    </div>

                    <div class="text-[11px] text-center text-slate-400">
                        Dengan menekan tombol di atas, Anda menyetujui pemesanan buku dengan metode bayar COD di Bacabuku.
                    </div>
                </div>
            </div>

        </div>
    </form>

</div>
@endsection
