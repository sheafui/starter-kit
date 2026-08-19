@props([
    'collapsable' => false,
    'variant' => 'default',
    'label' => false
])

@php

$classes = [
    'flex flex-col gap-y-1'
];
@endphp

<div
    {{ $attributes->class($classes) }}
    data-slot="navlist-group"
    x-data="{
        expanded: true,
        expand(){
            this.expanded = !this.expanded; 
        }
    }"
>
    @switch($variant)
        @case('compact')
            <x-ui.navlist.group.variant.compact
                :$collapsable  {{-- using @aware in this case isn't proper way !  --}}
            >
                {{ $slot }}
            </x-ui.navlist.group.variant.compact>
            @break
        @default
            <x-ui.navlist.group.variant.default            
                :$collapsable  {{-- using @aware in this case isn't proper way !  --}}
            >
                {{ $slot }}
            </x-ui.navlist.group.variant.default>
    @endswitch
</div>