{{-- Accreditation Module --}}

@props(['active' => false, 'href'])

@php
$classes = $active
    ? 'block py-2.5 px-4 rounded transition duration-200 bg-blue-900 text-white'
    : 'block py-2.5 px-4 rounded transition duration-200 text-gray-900 hover:bg-blue-200';
@endphp

<a {{ $attributes->merge(['class' => $classes, 'href' => $href]) }}>
    {{ $slot }}
</a>

