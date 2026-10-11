<button {{ $attributes->merge([
    'type' => 'submit',
    'class' => 'inline-flex items-center gap-1.5 px-4 py-2 bg-tera-600 border border-transparent rounded-lg
                font-semibold text-sm text-white
                hover:bg-tera-500 active:bg-tera-700
                transition-all duration-150 ease-in-out
                focus:outline-none focus:ring-2 focus:ring-tera-500/50 focus:ring-offset-1'
]) }}>
    {{ $slot }}
</button>
