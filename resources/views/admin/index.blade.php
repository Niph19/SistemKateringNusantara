@section('title', 'Kelola Data | Rasa Nusantara')

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <div>
                <p class="text-xs font-semibold tracking-widest uppercase text-emas-500/70 mb-1">
                    ✦ Manajemen Data ✦
                </p>
                <h1 class="text-2xl font-bold tracking-tight text-gradient-emas font-serif">
                    Kelola Data
                </h1>
                <p class="mt-1 text-sm text-legam-300">
                    Pilih entitas data yang ingin ditampilkan atau dikelola.
                </p>
            </div>
            <a href="{{ route('dashboard') }}"
               class="hidden sm:inline-flex items-center gap-1.5 text-sm text-legam-300 hover:text-emas-300 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Kembali ke Dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-6 sm:py-8">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">

            {{-- Grid kartu resource --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                @php
                    // Ikon SVG per resource
                    $icons = [
                        'Kota'              => '<path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>',
                        'Kategori'          => '<path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>',
                        'Metode pembayaran' => '<path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>',
                        'Kurir'             => '<path stroke-linecap="round" stroke-linejoin="round" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"/>',
                        'Pelanggan'         => '<path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>',
                        'Menu'              => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>',
                        'Pesanan'           => '<path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>',
                        'Item pesanan'      => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>',
                    ];
                @endphp

                @foreach ($resources as $resource)
                    <a href="{{ route($resource['route']) }}"
                       class="group relative card-nusantara flex items-center gap-4 p-5
                              hover:shadow-md transition-all duration-150
                              hover:border-emas-300/50">

                        {{-- Ornamen pojok emas --}}
                        <div class="batik-corner-ornament"></div>

                        {{-- Ikon --}}
                        <div class="w-11 h-11 rounded-xl flex items-center justify-center shrink-0
                                    bg-legam-900 group-hover:bg-legam-800 transition-colors duration-150"
                             style="border: 1px solid rgba(240,180,41,0.20);">
                            <svg class="w-5 h-5 text-emas-400" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true">
                                {!! $icons[$resource['name']] ?? '<circle cx="12" cy="12" r="9"/>' !!}
                            </svg>
                        </div>

                        {{-- Label --}}
                        <div class="flex-1 min-w-0">
                            <p class="text-base font-semibold text-legam-900 group-hover:text-legam-700 transition-colors">
                                {{ $resource['name'] }}
                            </p>
                            <p class="text-xs text-legam-400 mt-0.5">
                                Lihat, tambah, ubah, dan hapus data
                            </p>
                        </div>

                        {{-- Panah --}}
                        <svg class="w-4 h-4 text-legam-400 group-hover:text-emas-400 shrink-0 transition-colors duration-150" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                @endforeach

            </div>

            {{-- Link kembali mobile --}}
            <div class="mt-6 sm:hidden">
                <a href="{{ route('dashboard') }}"
                   class="inline-flex items-center gap-1.5 text-sm text-legam-500 hover:text-emas-600 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Dashboard
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
