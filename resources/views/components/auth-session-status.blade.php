@props(['status'])

@if ($status)
    <div {{ $attributes->merge([
        'class' => 'flex items-center gap-2 text-sm font-medium text-green-700 rounded-lg px-4 py-3'
    ]) }}
    style="background: #f0fdf4; border: 1px solid #bbf7d0;">
        <svg class="w-4 h-4 text-green-500 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        {{ $status }}
    </div>
@endif
