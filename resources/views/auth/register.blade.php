@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-8">
    <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-sm space-y-6">
        
        <!-- Header -->
        <div class="text-center space-y-2">
            <div class="w-12 h-12 rounded-xl bg-primary/10 text-primary mx-auto flex items-center justify-center font-bold text-xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-slate-900">Daftar Akun Baru</h1>
            <p class="text-xs text-slate-500">Lengkapi formulir di bawah ini untuk membuat akun di Bacabuku</p>
        </div>

        <form action="{{ route('register') }}" method="POST" class="space-y-4 text-xs">
            @csrf

            <!-- Name -->
            <div class="space-y-1.5">
                <label class="font-semibold text-slate-700">Nama Lengkap <span class="text-error">*</span></label>
                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Contoh: Muhammad Ilman"
                    class="input input-bordered input-sm w-full bg-white text-xs @error('name') input-error @enderror"
                    required
                    autofocus
                />
                @error('name') <span class="text-[11px] text-error">{{ $message }}</span> @enderror
            </div>

            <!-- Email & Phone -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="font-semibold text-slate-700">Alamat Email <span class="text-error">*</span></label>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="nama@email.com"
                        class="input input-bordered input-sm w-full bg-white text-xs @error('email') input-error @enderror"
                        required
                    />
                    @error('email') <span class="text-[11px] text-error">{{ $message }}</span> @enderror
                </div>

                <div class="space-y-1.5">
                    <label class="font-semibold text-slate-700">Nomor WhatsApp / HP</label>
                    <input
                        type="text"
                        name="phone"
                        value="{{ old('phone') }}"
                        placeholder="081234567890 (Opsional)"
                        class="input input-bordered input-sm w-full bg-white text-xs @error('phone') input-error @enderror"
                    />
                    @error('phone') <span class="text-[11px] text-error">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Address -->
            <div class="space-y-1.5">
                <label class="font-semibold text-slate-700">Alamat Lengkap Pengiriman</label>
                <textarea
                    name="address"
                    rows="2"
                    placeholder="Tuliskan alamat domisili untuk pengiriman pesanan Anda (Opsional)..."
                    class="textarea textarea-bordered w-full bg-white text-xs leading-relaxed @error('address') textarea-error @enderror"
                >{{ old('address') }}</textarea>
                @error('address') <span class="text-[11px] text-error">{{ $message }}</span> @enderror
            </div>

            <!-- Password & Confirm -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="font-semibold text-slate-700">Kata Sandi <span class="text-error">*</span></label>
                    <input
                        type="password"
                        name="password"
                        placeholder="Minimal 8 karakter"
                        class="input input-bordered input-sm w-full bg-white text-xs @error('password') input-error @enderror"
                        required
                    />
                    @error('password') <span class="text-[11px] text-error">{{ $message }}</span> @enderror
                </div>

                <div class="space-y-1.5">
                    <label class="font-semibold text-slate-700">Konfirmasi Kata Sandi <span class="text-error">*</span></label>
                    <input
                        type="password"
                        name="password_confirmation"
                        placeholder="Ketik ulang sandi"
                        class="input input-bordered input-sm w-full bg-white text-xs"
                        required
                    />
                </div>
            </div>

            <!-- Submit Button -->
            <div class="pt-2">
                <button type="submit" class="btn btn-primary btn-md btn-block font-semibold shadow-sm text-sm">
                    Daftar Akun Sekarang
                </button>
            </div>
        </form>

        <!-- Divider & Login Link -->
        <div class="pt-4 border-t border-slate-100 text-center text-xs text-slate-500 space-y-2">
            <p>Sudah memiliki akun terdaftar?</p>
            <a href="{{ route('login') }}" class="btn btn-sm btn-ghost border border-slate-200 w-full text-slate-700 font-semibold hover:border-primary">
                Masuk ke Akun Anda
            </a>
        </div>

    </div>
</div>
@endsection
