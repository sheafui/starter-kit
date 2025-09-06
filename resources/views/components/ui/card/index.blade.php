@props(['size' => 'md'])

@php
    $variantClasses = match ($size) {
        'xs' => 'max-w-xs',
        'sm' => 'max-w-sm',
        'md' => 'max-w-md',
        'lg' => 'max-w-lg',
        'xl' => 'max-w-xl',
        '2xl' =>  'max-w-2xl',
    };
    
    $classes = [
        'bg-white dark:bg-neutral-900 border border-black/10 dark:border-white/10 ',
        'hover:dark:bg-[--alpha(var(--color-white)/4%)] hover:bg-[--alpha(var(--color-neutral-900)/4%)]',
        '[:where(&)]:p-4 [:where(&)]:rounded-lg',
        $variantClasses
    ];

@endphp

<div {{ $attributes->class(Arr::toCssClasses($classes)) }}>
    {{ $slot }}
</div>