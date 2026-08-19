@php
$classes = [
    'flex items-center gap-x-2',
    'py-1 px-2'
];
@endphp

<div
    {{ $attributes->class($classes) }}
    data-slot="navbar"
>
    {{ $slot }}
</div>