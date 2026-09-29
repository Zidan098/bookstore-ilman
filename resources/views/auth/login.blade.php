@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto py-8">
    <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-sm space-y-6">
        
        <!-- Header -->
        <div class="text-center space-y-2">
            <div class="w-12 h-12 rounded-xl bg-primary/10 text-primary mx-auto flex items-center justify-center font-bold text-xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-slate-900">Masuk ke Bacabuku</h1>
            <p class="text-xs text-slate-500">Gunakan akun Anda untuk melanjutkan transaksi dan melacak pesanan</p>
        </div>

        <form action="{{ route('login') }}" method="POST" class="space-y-4 text-xs">
            @csrf

            <!-- Email -->
            <div class="space-y-1.5">
                <label class="font-semibold text-slate-700">Alamat Email</label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="nama@email.com"
                    class="input input-bordered input-sm w-full bg-white text-xs @error('email') input-error @enderror"
                    required
                    autofocus
                />
                @error('email') <span class="text-[11px] text-error">{{ $message }}</span> @enderror
            </div>

            <!-- Password -->
            <div class="space-y-1.5">
                <label class="font-semibold text-slate-700">Kata Sandi</label>
                <input
                    type="password"
                    name="password"
                    placeholder="••••••••"
                    class="input input-bordered input-sm w-full bg-white text-xs @error('password') input-error @enderror"
                    required
                />
                @error('password') <span class="text-[11px] text-error">{{ $message }}</span> @enderror
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between text-xs pt-1">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="remember" class="checkbox checkbox-primary checkbox-xs rounded" />
                    <span class="text-slate-600">Ingat saya di perangkat ini</span>
                </label>
            </div>

            <!-- Submit Button -->
            <div class="pt-2">
                <button type="submit" class="btn btn-primary btn-md btn-block font-semibold shadow-sm text-sm">
                    Masuk Sekarang
                </button>
            </div>
        </form>

        <!-- Divider & Register Link -->
        <div class="pt-4 border-t border-slate-100 text-center text-xs text-slate-500 space-y-2">
            <p>Belum memiliki akun pembeli?</p>
            <a href="{{ route('register') }}" class="btn btn-sm btn-ghost border border-slate-200 w-full text-slate-700 font-semibold hover:border-primary">
                Daftar Akun Baru
            </a>
        </div>

    </div>
</div>
@endsection
