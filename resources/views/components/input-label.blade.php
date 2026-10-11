@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-sm font-medium text-legam-700']) }}>
    {{ $value ?? $slot }}
</label>
