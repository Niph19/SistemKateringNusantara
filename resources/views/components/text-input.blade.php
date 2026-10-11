@props(['disabled' => false])

<input
    @disabled($disabled)
    {{ $attributes->merge([
        'class' => 'block w-full rounded-lg text-sm text-legam-900 bg-white
                    placeholder-legam-400 transition-colors duration-150
                    focus:outline-none focus:ring-2 focus:ring-emas-400/20
                    disabled:opacity-60 disabled:cursor-not-allowed disabled:bg-legam-50'
    ]) }}
    style="border: 1px solid #c9ae92; padding: 0.5rem 0.75rem;"
    onfocus="this.style.borderColor='#f0b429'"
    onblur="this.style.borderColor='#c9ae92'"
>
