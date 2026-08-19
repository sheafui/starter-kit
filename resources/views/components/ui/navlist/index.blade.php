@php
    $classes = [
        'flex flex-col w-full [:has([data-collapsed]_&)_&]:items-center gap-y-1',
        'py-1 px-2'
    ];
@endphp

<div
    {{ $attributes->class($classes) }}
    data-slot="navlist"
>
    {{ $slot }}
</div>