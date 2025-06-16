
@props(['active'])

@php
$classes = $active
    ? 'inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-purple-500'
    : 'inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-white hover:text-purple-400';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

