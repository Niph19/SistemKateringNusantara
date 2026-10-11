<a {{ $attributes->merge([
    'class' => 'flex items-center w-full px-4 py-2.5 text-sm leading-5 text-legam-200
                hover:bg-legam-700 hover:text-emas-300
                focus:outline-none focus:bg-legam-700 focus:text-emas-300
                transition duration-150 ease-in-out'
]) }}>
    {{ $slot }}
</a>
