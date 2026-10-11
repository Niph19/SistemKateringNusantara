<x-guest-layout>
    {{-- Ilustrasi verifikasi --}}
    <div class="text-center mb-6">
        <div class="w-14 h-14 mx-auto mb-3 rounded-full flex items-center justify-center"
             style="background: linear-gradient(135deg, rgba(240,180,41,0.15), rgba(168,112,0,0.10)); border: 1px solid rgba(240,180,41,0.25);">
            <svg class="w-7 h-7 text-emas-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
        </div>
        <h1 class="text-lg font-bold text-legam-900 font-serif">Verifikasi Email Anda</h1>
    </div>

    <p class="text-sm text-legam-600 mb-4 text-center leading-relaxed">
        Terima kasih telah mendaftar! Silakan verifikasi email Anda dengan mengklik tautan yang telah kami kirimkan.
        Jika tidak menerima email, kami siap mengirimkan ulang.
    </p>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 flex items-center gap-2 text-sm font-medium text-green-700 rounded-lg px-4 py-3"
             style="background: #f0fdf4; border: 1px solid #bbf7d0;">
            <svg class="w-4 h-4 text-green-500 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Tautan verifikasi baru telah dikirim ke email Anda.
        </div>
    @endif

    <div class="batik-divider my-2">
        <span>⬥</span>
    </div>

    <div class="flex items-center justify-between gap-3 mt-4">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <x-primary-button>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
                Kirim Ulang Email
            </x-primary-button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                    class="text-sm text-legam-500 hover:text-tera-600 underline underline-offset-2 transition-colors">
                Keluar
            </button>
        </form>
    </div>
</x-guest-layout>
