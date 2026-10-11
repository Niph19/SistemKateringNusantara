<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Rasa Nusantara') }}</title>

        <!-- Fonts: Figtree + Playfair Display -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&family=playfair-display:400,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts & Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased batik-navbar-bg min-h-screen">

        {{-- Pola kawung seluruh layar --}}
        <div class="min-h-screen flex flex-col items-center justify-center px-4 py-10"
             style="background-color: #1a1610; background-image: url('data:image/svg+xml,%3Csvg width=\'40\' height=\'40\' viewBox=\'0 0 40 40\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'%23f0b429\' fill-opacity=\'0.05\'%3E%3Cellipse cx=\'20\' cy=\'5\' rx=\'4\' ry=\'3\'/%3E%3Cellipse cx=\'20\' cy=\'35\' rx=\'4\' ry=\'3\'/%3E%3Cellipse cx=\'5\' cy=\'20\' rx=\'3\' ry=\'4\'/%3E%3Cellipse cx=\'35\' cy=\'20\' rx=\'3\' ry=\'4\'/%3E%3Ccircle cx=\'20\' cy=\'20\' r=\'2\'/%3E%3C/g%3E%3C/svg%3E');">

            {{-- Logo / Brand --}}
            <a href="/" class="flex flex-col items-center gap-3 mb-8 group">
                <div class="w-16 h-16 rounded-2xl flex items-center justify-center shadow-emas-lg"
                     style="background: linear-gradient(135deg, #f0b429, #a87000);">
                    <svg class="w-8 h-8 text-legam-950" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v6h-2zm0 8h2v2h-2z"/>
                    </svg>
                </div>
                <div class="text-center">
                    <p class="text-xl font-bold text-gradient-emas font-serif tracking-tight">
                        Rasa Nusantara
                    </p>
                    <p class="text-xs tracking-widest uppercase text-legam-400 mt-0.5">
                        Sistem Admin Katering
                    </p>
                </div>
            </a>

            {{-- Card Form --}}
            <div class="w-full max-w-md rounded-2xl overflow-hidden shadow-legam"
                 style="background: #ffffff; border: 1px solid rgba(240,180,41,0.15);">

                {{-- Garis aksen emas atas --}}
                <div class="h-1 w-full" style="background: linear-gradient(to right, #a87000, #f0b429, #a87000);"></div>

                <div class="px-7 py-7">
                    {{ $slot }}
                </div>
            </div>

            {{-- Footer kecil --}}
            <p class="mt-8 text-xs text-legam-500">
                &copy; {{ date('Y') }} Rasa Nusantara. Semua hak dilindungi.
            </p>

        </div>
    </body>
</html>
