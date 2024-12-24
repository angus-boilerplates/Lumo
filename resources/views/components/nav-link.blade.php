@props(['active'])

@php
$classes = ($active ?? false)
            ? 'text-base items-center justify-center'
            : 'text-base';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
