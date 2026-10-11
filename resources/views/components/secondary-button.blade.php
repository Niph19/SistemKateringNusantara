<button {{ $attributes->merge([
    'type' => 'button',
    'class' => 'inline-flex items-center gap-1.5 px-4 py-2 bg-white border rounded-lg font-semibold text-sm
                text-legam-700 hover:bg-legam-50 hover:border-legam-300
                shadow-sm transition-all duration-150 ease-in-out
                focus:outline-none focus:ring-2 focus:ring-emas-400/30 focus:ring-offset-1
                disabled:opacity-25 disabled:cursor-not-allowed'
]) }}
style="border-color: #c9ae92;">
    {{ $slot }}
</button>
