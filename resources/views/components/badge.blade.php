{{-- Badge Component --}}
@props(['color' => 'teal', 'text'])

@php
    $classes = match($color) {
        'green' => 'bg-green-mint text-pharma-green',
        'amber' => 'bg-amber-50 text-amber-700',
        'red' => 'bg-red-50 text-red-700',
        'blue' => 'bg-blue-50 text-blue-700',
        default => 'bg-teal-mint text-primary-700',
    };
@endphp

<span {{ $attributes->merge(['class' => "badge {$classes}"]) }}>
    {{ $text }}
</span>
