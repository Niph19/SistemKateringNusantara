<x-guest-layout>
    {{-- Judul --}}
    <div class="mb-6 text-center">
        <h1 class="text-xl font-bold text-legam-900 font-serif">Masuk ke Sistem</h1>
        <p class="mt-1 text-sm text-legam-500">Gunakan akun admin Anda untuk melanjutkan.</p>
    </div>

    {{-- Session Status --}}
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        {{-- Email --}}
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input
                id="email"
                class="block mt-1 w-full"
                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus
                autocomplete="username"
                placeholder="admin@contoh.com"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        {{-- Password --}}
        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input
                id="password"
                class="block mt-1 w-full"
                type="password"
                name="password"
                required
                autocomplete="current-password"
                placeholder="••••••••"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        {{-- Remember Me --}}
        <div>
            <label for="remember_me" class="inline-flex items-center gap-2 cursor-pointer">
                <input
                    id="remember_me"
                    type="checkbox"
                    name="remember"
                    class="rounded text-emas-500 focus:ring-emas-400/30"
                    style="border-color: #c9ae92;"
                >
                <span class="text-sm text-legam-600">{{ __('Ingat saya') }}</span>
            </label>
        </div>

        {{-- Divider --}}
        <div class="batik-divider my-2">
            <span>⬥</span>
        </div>

        {{-- Tombol & Link --}}
        <div class="flex items-center justify-between gap-3">
            @if (Route::has('password.request'))
                <a class="text-sm text-legam-500 hover:text-emas-600 underline underline-offset-2 transition-colors"
                   href="{{ route('password.request') }}">
                    {{ __('Lupa password?') }}
                </a>
            @endif

            <x-primary-button class="ms-auto">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                </svg>
                {{ __('Masuk') }}
            </x-primary-button>
        </div>

        {{-- Link daftar --}}
        @if (Route::has('register'))
            <p class="text-center text-sm text-legam-500 mt-4 pt-4" style="border-top: 1px solid #e8d9c4;">
                Belum punya akun?
                <a href="{{ route('register') }}"
                   class="text-emas-600 hover:text-emas-700 font-semibold underline underline-offset-2 transition-colors">
                    Daftar sekarang
                </a>
            </p>
        @endif
    </form>
</x-guest-layout>
