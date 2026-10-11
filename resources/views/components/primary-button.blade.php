<button {{ $attributes->merge([
    'type' => 'submit',
    'class' => 'inline-flex items-center gap-1.5 px-4 py-2 rounded-lg font-semibold text-sm text-legam-950
                shadow-emas transition-all duration-150 ease-in-out
                focus:outline-none focus:ring-2 focus:ring-emas-400/40 focus:ring-offset-1
                disabled:opacity-50 disabled:cursor-not-allowed'
]) }}
style="background: linear-gradient(135deg, #f0b429, #a87000);">
    {{ $slot }}
</button>
