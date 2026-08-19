@props([
    'iconVariant' => 'micro',
    'iconAfter' => null,
    'variant' => 'solid',
    'pill' => false,
    'color' => null,
    'size' => null,
    'icon' => null,
])
@php
    if ($variant === 'outline') {
        $colorClasses = match ($color) {
            default => 'text-neutral-900 dark:text-neutral-50 bg-neutral-900/5 dark:bg-white/5 border-neutral-900 dark:border-white border',
            'red' => 'text-red-700 dark:text-red-400 bg-red-500/5 dark:bg-red-400/5 border-red-400 dark:border-red-400 border',
            'orange' => 'text-orange-700 dark:text-orange-400 bg-orange-500/5 dark:bg-orange-400/5 border-orange-400 dark:border-orange-400 border',
            'amber' => 'text-amber-700 dark:text-amber-400 bg-amber-500/5 dark:bg-amber-400/5 border-amber-400 dark:border-amber-400 border',
            'yellow' => 'text-yellow-800 dark:text-yellow-400 bg-yellow-500/5 dark:bg-yellow-400/5 border-yellow-400 dark:border-yellow-400 border',
            'lime' => 'text-lime-800 dark:text-lime-400 bg-lime-500/5 dark:bg-lime-400/5 border-lime-400 dark:border-lime-400 border',
            'green' => 'text-green-800 dark:text-green-400 bg-green-500/5 dark:bg-green-400/5 border-green-400 dark:border-green-400 border',
            'emerald' => 'text-emerald-800 dark:text-emerald-400 bg-emerald-500/5 dark:bg-emerald-400/5 border-emerald-400 dark:border-emerald-400 border',
            'teal' => 'text-teal-800 dark:text-teal-400 bg-teal-500/5 dark:bg-teal-400/5 border-teal-400 dark:border-teal-400 border',
            'cyan' => 'text-cyan-800 dark:text-cyan-400 bg-cyan-500/5 dark:bg-cyan-400/5 border-cyan-400 dark:border-cyan-400 border',
            'sky' => 'text-sky-800 dark:text-sky-400 bg-sky-500/5 dark:bg-sky-400/5 border-sky-400 dark:border-sky-400 border',
            'blue' => 'text-blue-800 dark:text-blue-400 bg-blue-500/5 dark:bg-blue-400/5 border-blue-400 dark:border-blue-400 border',
            'indigo' => 'text-indigo-700 dark:text-indigo-400 bg-indigo-500/5 dark:bg-indigo-400/5 border-indigo-400 dark:border-indigo-400 border',
            'violet' => 'text-violet-700 dark:text-violet-400 bg-violet-500/5 dark:bg-violet-400/5 border-violet-400 dark:border-violet-400 border',
            'purple' => 'text-purple-700 dark:text-purple-400 bg-purple-500/5 dark:bg-purple-400/5 border-purple-400 dark:border-purple-400 border',
            'fuchsia' => 'text-fuchsia-700 dark:text-fuchsia-400 bg-fuchsia-500/5 dark:bg-fuchsia-400/5 border-fuchsia-400 dark:border-fuchsia-400 border',
            'pink' => 'text-pink-700 dark:text-pink-400 bg-pink-500/5 dark:bg-pink-400/5 border-pink-400 dark:border-pink-400 border',
            'rose' => 'text-rose-700 dark:text-rose-400 bg-rose-500/5 dark:bg-rose-400/5 border-rose-400 dark:border-rose-400 border',
        };
    } else {
        $colorClasses = match ($color) {
            default => 'text-white dark:text-white bg-neutral-900 dark:bg-neutral-600 border-black/5 dark:border-white/5',
            'red' => 'text-white dark:text-white bg-red-500 dark:bg-red-500 border-red-400 dark:border-red-400/90',
            'orange' => 'text-white dark:text-white bg-orange-400 dark:bg-orange-400 border-orange-400 dark:border-orange-400/90',
            'amber' => 'text-white dark:text-white bg-amber-400 dark:bg-amber-400 border-amber-400 dark:border-amber-400/90',
            'yellow' => 'text-white dark:text-white bg-yellow-400 dark:bg-yellow-400 border-yellow-400 dark:border-yellow-400/90',
            'lime' => 'text-white dark:text-white bg-lime-400 dark:bg-lime-400 border-lime-400 dark:border-lime-400/90',
            'green' => 'text-white dark:text-white bg-green-400 dark:bg-green-400 border-green-400 dark:border-green-400/90',
            'emerald' => 'text-white dark:text-white bg-emerald-400 dark:bg-emerald-400 border-emerald-400 dark:border-emerald-400/90',
            'teal' => 'text-white dark:text-white bg-teal-400 dark:bg-teal-400 border-teal-400 dark:border-teal-400/90',
            'cyan' => 'text-white dark:text-white bg-cyan-400 dark:bg-cyan-400 border-cyan-400 dark:border-cyan-400/90',
            'sky' => 'text-white dark:text-white bg-sky-400 dark:bg-sky-400 border-sky-400 dark:border-sky-400/90',
            'blue' => 'text-white dark:text-white bg-blue-400 dark:bg-blue-400 border-blue-400 dark:border-blue-400/90',
            'indigo' => 'text-white dark:text-white bg-indigo-400 dark:bg-indigo-400 border-indigo-400 dark:border-indigo-400/90',
            'violet' => 'text-white dark:text-white bg-violet-400 dark:bg-violet-400 border-violet-400 dark:border-violet-400/90',
            'purple' => 'text-white dark:text-white bg-purple-400 dark:bg-purple-400 border-purple-400 dark:border-purple-400/90',
            'fuchsia' => 'text-white dark:text-white bg-fuchsia-400 dark:bg-fuchsia-400 border-fuchsia-400 dark:border-fuchsia-400/90',
            'pink' => 'text-white dark:text-white bg-pink-400 dark:bg-pink-400 border-pink-400 dark:border-pink-400/90',
            'rose' => 'text-white dark:text-white bg-rose-400 dark:bg-rose-400 border-rose-400 dark:border-rose-400/90',
        };
    }

    $classes = [
        'inline-flex items-center font-medium whitespace-nowrap gap-x-0.5',
        $colorClasses,
        match ($size) {
            'sm' => 'text-xs py-1',
            'lg' => 'text-sm py-1.5',
            default => 'text-sm py-1',
        },
        match ($pill) {
            true => 'rounded-full px-3',
            default => 'rounded-md px-2',
        },
    ];

    $iconClasses = [
        'size-4' => $iconVariant === 'outline',
    ];

@endphp


<x-ui.button.abstract 
    {{ $attributes->class(Arr::toCssClasses($classes)) }}
    data-slot="badge"
>

    @if (is_string($icon) && $icon !== '')
        <x-ui.icon :name="$icon" :variant="$iconVariant" class="{{ Arr::toCssClasses($iconClasses) }}"
            data-slot="badge-icon" />
    @else
        {{ $icon }}
    @endif


    {{ $slot }}

    @if ($iconAfter)
        @if (is_string($iconAfter))
            <x-ui.icon :name="$iconAfter" :variant="$iconVariant" class="{{ Arr::toCssClasses($iconClasses) }}"
                data-slot="badge-icon:after" />
        @else
            {{ $iconAfter }}
        @endif
    @endif
</x-ui.button.abstract>
