@php
    $classes = [
        '[grid-area:main]',
        'flex flex-col justify-start', 
        '[&>:has([data-slot=header])]:p-0 [&>:not(:has([data-slot=header]))]:p-2'
    ];    
@endphp

<div
    {{ $attributes->class($classes) }}
    data-slot="main"
>
    {{ $slot }}
</div>