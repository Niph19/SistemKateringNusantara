@props(['active'])

@php
// Aktif: border kiri emas, background gelap tipis
// Tidak aktif: teks terang, hover emas
$classes = ($active ?? false)
    ? 'block w-full ps-3 pe-4 py-2.5 border-l-4 border-emas-400 text-start text-sm font-semibold text-emas-400 bg-legam-800/60 focus:outline-none transition duration-150 ease-in-out'
    : 'block w-full ps-3 pe-4 py-2.5 border-l-4 border-transparent text-start text-sm font-medium text-legam-300 hover:text-emas-300 hover:bg-legam-800/40 hover:border-emas-500/40 focus:outline-none transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
