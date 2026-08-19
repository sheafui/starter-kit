@props([
    'openInNewTab' => null,
    'primary' => true,
    'variant' => null,
])

@php
$classes = [
    'inline font-medium text-base text-start',
    'underline-offset-[6px] hover:decoration-current',
    match ($variant) {
        'ghost' => 'no-underline hover:underline',
        'soft' => 'no-underline',
        default => 'underline',
    },
    match ($variant) {
        'soft' => 'text-neutral-500 dark:text-white/70 hover:text-neutral-800 dark:hover:text-white',
        default => match ($primary) {
            true => 'text-[var(--color-primary-content)] decoration-[color-mix(in_oklab,var(--color-primary-content),transparent_80%)]',
            false => 'text-neutral-800 dark:text-white decoration-neutral-800/20 dark:decoration-white/20',
        },
    },
];
@endphp

<a {{ $attributes->class(Arr::toCssClasses($classes)) }} data-slot="link" @if($openInNewTab) target="_blank" @endif>{{ $slot }}</a>
