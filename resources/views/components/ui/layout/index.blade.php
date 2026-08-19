@props([
    'collapsable' => true,
    'variant' => 'sidebar-main',
])

@php
    $basePath = 'ui.layout.variant';
    $variantPath = match($variant) {
        'sidebar-main', 'header-sidebar' => "{$basePath}.{$variant}",
        default => "{$basePath}.sidebar-main",
    };
@endphp

{{-- use the propriate layout based on the variant --}}
<x-dynamic-component 
    :component="$variantPath" 
    :collapsable="$collapsable" 
> 
    {{ $slot }}
</x-dynamic-component>

{{-- solves alpine limitations 🙂 --}}
<x-ui.layout.runtime 
    :$collapsable
/>