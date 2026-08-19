@props([
    'icon' => null,
    'badge' => null,
    'label' => null,
    'href' => null,
    'active' => null
])

@php
    $classes = [
        'flex items-center justify-center',
        
        // active link state
        'data-active-link:bg-[--alpha(var(--color-primary)_/5%)] 
         data-active-link:!text-[var(--color-primary)] 
         data-active-link:[&_[data-slot=icon]]:!text-[var(--color-primary)]',

        // add hover state only if the item isn't already active 
        '[&:not([data-active-link])]:hover:bg-[--alpha(var(--color-primary)_/5%)]
         [&:not([data-active-link])]:hover:!text-[var(--color-primary)]
         [&:not([data-active-link])]:hover:[&_[data-slot=icon]]:!text-[var(--color-primary)]',
        'dark:text-neutral-200 text-neutral-600',
        // icon styles
        '[&_[data-slot=icon]]:dark:text-neutral-400 [&_[data-slot=icon]]:text-neutral-600 data-[active-link]:text-[var(--color-primary)]',
        
        'px-2 gap-x-1 py-1 rounded-box',
        // if there is a badge reduce the right padding for better UI
        '[&:has([data-slot=badge])]:pr-1'
    ];

    $iconAttributes = new \Illuminate\View\ComponentAttributeBag();
    $badgeAttributes = new \Illuminate\View\ComponentAttributeBag();
 
    foreach ($attributes->getAttributes() as $key => $value) {
        if (str_starts_with($key, 'icon:')) {
            $iconAttributes[substr($key, 5)] = $value;
        } elseif (str_starts_with($key, 'badge:')) {
            $badgeAttributes[substr($key, 6)] = $value;
        }
    }

    // allow other active logic from outside
    $active = $active ?? (url($href) === url()->current());

@endphp

<x-ui.button.abstract
    :$href
    data-slot="navlist-item"
    {{ $attributes
        ->when($active, fn($attrs) => $attrs->merge(['data-active-link' => 'true'] ))
        ->class($classes)
    }}
>
    @if($icon)
        <x-ui.icon 
            :attributes="$iconAttributes->class('[:where(&)]:size-5')"
            :name="$icon"
        />
    @endif

    <span class="text-base">
        {{ $label }}
    </span>

    @if($badge)
        <x-ui.badge
            :attributes="$badgeAttributes->class('ml-auto')->merge([
                'size' => 'sm'
            ])"
        >
            {{ $badge }} 
        </x-ui.badge>
    @endif
</x-ui.button.abstract>