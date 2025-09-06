@props([
    'label' => null,
    'labelHidden' => false,
])

@php
    $classes = [
        'rounded-box border border-black/10 p-5 dark:border-white/10 text-start',
        // handle the cases when fieldset is a wrapper of field set 😎
        '[&>[data-slot=field]]:my-0 
        [&>[data-slot=field]:not(:first-of-type)]:my-2
        [&>[data-slot=field]:not(:first-of-type)]:my-2',
    ];
@endphp
<fieldset
    {{
        $attributes->class(Arr::toCssClasses($classes))
    }}
>
    @if (filled($label))
        <legend
            @class([
                '-ms-2 px-2 text-sm font-medium leading-6 text-neutral-950 dark:text-white',
                'sr-only' => $labelHidden,
            ])
        >
            {{ $label }}
        </legend>
    @endif

    {{ $slot }}
</fieldset>
