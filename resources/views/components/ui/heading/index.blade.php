{{-- resources/views/components/ui/heading/index.blade.php --}}
@props([
    'level' => 'h2',
    'size' => 'sm',
])

@php
    $tag = in_array($level, ['h1', 'h2', 'h3', 'h4', 'h5', 'h6']) ? $level : 'h2';

    $variantClasses = match ($size) {
        'xs' => 'text-sm',
        'sm' => 'text-base',
        'md' => 'text-lg',
        'lg' => 'text-xl',
        'xl' => 'text-2xl',
        '2xl' => 'text-4xl',
        '3xl' => 'text-6xl',
        '4xl' => 'text-8xl',
        default => 'text-base'
    };

    $classes = [
        'font-semibold text-neutral-800 dark:text-white',
        $variantClasses
    ];

@endphp

<{{ $tag }} 
    {{ $attributes->class(Arr::toCssClasses($classes)) }} 
    data-slot="heading"
>
    {{ $slot }}
</{{ $tag }}>
