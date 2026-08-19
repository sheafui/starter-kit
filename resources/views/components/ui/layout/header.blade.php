@props([
    'sticky' => true,
    'brand' => null
])

@php
    $classes = [
        '[grid-area:header] z-40 p-2 my-auto min-h-[var(--header-height)] border-b flex items-center dark:border-b-white/5 border-neutral-800/5',
        'sticky top-0 dark:bg-neutral-950 bg-white' => $sticky,
    ];    
@endphp

<div
    {{ $attributes->class($classes) }}
    data-slot="header"
>
    @if (filled($brand))
        <div
            {{ 
                $brand->attributes->class(
                    "flex items-center flex-shrink-0 justify-between items-center flex-shrink-0"
                )
            }} 
            data-slot="header-brand"
        >
            {{ $brand }}
        </div>
    @endif
            
    {{ $slot }}
</div>