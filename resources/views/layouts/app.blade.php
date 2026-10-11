<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', config('app.name', 'Rasa Nusantara'))</title>

        <!-- Fonts: Figtree (body) + Playfair Display (heading dekoratif) -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&family=playfair-display:400,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts & Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-legam-50">

        <div class="min-h-screen flex flex-col">

            {{-- Navbar --}}
            @include('layouts.navigation')

            {{-- Page Header dengan aksen Batik Legam --}}
            @isset($header)
                <header class="batik-header-bg relative overflow-hidden">
                    {{-- Garis emas bawah --}}
                    <div class="absolute bottom-0 left-0 right-0 h-0.5 bg-gradient-to-r from-transparent via-emas-400 to-transparent opacity-60"></div>

                    <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            {{-- Page Content --}}
            <main class="flex-1">
                {{ $slot }}
            </main>

            {{-- Footer kecil bergaya Batik Legam --}}
            <footer class="batik-navbar-bg border-t mt-auto" style="border-color: rgba(240,180,41,0.15);">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                    <p class="text-center text-xs text-legam-400">
                        &copy; {{ date('Y') }}
                        <span class="text-emas-500 font-semibold">Rasa Nusantara</span>
                        — Sistem Admin Katering
                    </p>
                </div>
            </footer>

        </div>
    </body>
</html>
