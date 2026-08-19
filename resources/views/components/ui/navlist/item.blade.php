@aware([
    'collapsible' => true
])
@props([
    'icon' => null,
    'badge' => null,
    'label' => null,
    'href' => '#',
    'active' => null
])

@php
    // quick reference :
        // [:not(:has([data-collapsed]_&))_&]: means if the sidebar is not collapsed
        // [:has([data-collapsed]_&)_&]: means if the sidebar is collapsed
   
    $classes = [
        'isolate',
        'flex items-center [:where(&)]:justify-start',
        // When collapsed: center the content
        '[:has([data-collapsed]_&)_&]:justify-center',

        // active link state
        'data-active-link:bg-[--alpha(var(--color-primary)_/5%)] 
         data-active-link:!text-[var(--color-primary)] 
         data-active-link:[&_[data-slot=icon]]:!text-[var(--color-primary)]',

        // add hover state only if the item isn't already active 
        '[&:not([data-active-link])]:hover:bg-[--alpha(var(--color-primary)_/5%)]
        [&:not([data-active-link])]:hover:!text-[var(--color-primary)]
        [&:not([data-active-link])]:hover:[&_[data-slot=icon]]:!text-[var(--color-primary)]',
        // text styles
        'dark:text-neutral-400 text-neutral-600',
        // icon styles
        '[&_[data-slot=icon]]:dark:text-neutral-400
         [&_[data-slot=icon]]:text-neutral-600 
         data-[active-link]:text-[var(--color-primary)]',
        // gaps and padding
        'gap-x-2 pl-3 pr-1 py-1 rounded-box',
        // When collapsed: remove horizontal padding, keep vertical padding for centering
        '[:has([data-collapsed]_&)_&]:p-2',
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
<a
    href="{{ $href }}"
    
    @if($active)
       data-active-link
    @endif
    
    data-slot="navlist-item"
    {{ $attributes->class($classes) }}
>
    @if($icon)
        <x-ui.navlist.has-tooltip
            :tooltip="$label"
            :condition="$collapsible"
        >
            <x-ui.icon
                :attributes="$iconAttributes->class('[:where(&)]:size-5')"
                :name="$icon"
            />
        </x-ui.navlist.has-tooltip>
    @endif
   
    <span class="text-base [:has([data-collapsed]_&)_&]:hidden">
        {{ $label }}
    </span>
   
    @if($badge)
        <x-ui.badge
            :attributes="$badgeAttributes->merge([
                'size' => 'sm'
            ])"
            class="[:has([data-collapsed]_&)_&]:hidden  ml-auto"
        >{{ $badge }}</x-ui.badge>
    @endif
</a>