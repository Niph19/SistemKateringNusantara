@props(['align' => 'right', 'width' => '48', 'contentClasses' => ''])

@php
$alignmentClasses = match ($align) {
    'left'  => 'ltr:origin-top-left rtl:origin-top-right start-0',
    'top'   => 'origin-top',
    default => 'ltr:origin-top-right rtl:origin-top-left end-0',
};

$width = match ($width) {
    '48'    => 'w-48',
    default => $width,
};
@endphp

<div class="relative" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
    {{-- Trigger --}}
    <div @click="open = !open">
        {{ $trigger }}
    </div>

    {{-- Dropdown Panel bergaya Batik Legam --}}
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="absolute z-50 mt-2 {{ $width }} rounded-xl shadow-legam {{ $alignmentClasses }}"
        style="display: none; background-color: #2a2218; border: 1px solid rgba(240,180,41,0.20);"
        @click="open = false"
    >
        {{-- Garis aksen emas atas panel --}}
        <div class="h-px w-full rounded-t-xl" style="background: linear-gradient(to right, transparent, #f0b429, transparent); opacity: 0.5;"></div>

        <div class="py-1 {{ $contentClasses }}">
            {{ $content }}
        </div>
    </div>
</div>
