@props(['active'])

@php
// Aktif: garis bawah emas + teks emas
// Tidak aktif: teks abu terang, hover emas
$classes = ($active ?? false)
    ? 'inline-flex items-center px-3 pt-1 border-b-2 text-sm font-semibold leading-5 text-emas-400 transition duration-150 ease-in-out focus:outline-none focus:text-emas-300'
    : 'inline-flex items-center px-3 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-legam-300 hover:text-emas-400 hover:border-emas-500/40 focus:outline-none focus:text-emas-300 transition duration-150 ease-in-out';

$borderClass = ($active ?? false) ? 'border-emas-400' : 'border-transparent';
@endphp

<a {{ $attributes->merge(['class' => $classes . ' ' . $borderClass]) }}>
    {{ $slot }}
</a>
