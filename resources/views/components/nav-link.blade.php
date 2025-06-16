<!-- 
@props(['active'])

@php
$classes = $active
    ? 'inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-purple-500'
    : 'inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-white hover:text-purple-400';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a> -->

@props(['active'])

@php
$classes = $active
    ? 'inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-purple-500'
    : 'inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-white hover:text-purple-400';
@endphp

<a {{ $attributes->merge(['class' => $classes . ' relative loader-link']) }}>
    <span class="link-text">{{ $slot }}</span>

    <!-- Spinner nascosto -->
    <svg class="hidden loader-spinner animate-spin ml-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
        viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor"
            d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
    </svg>
</a>
