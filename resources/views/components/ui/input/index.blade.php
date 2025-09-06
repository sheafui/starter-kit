@props([
    'name' => $attributes->whereStartsWith('wire:model')->first() ?? $attributes->whereStartsWith('x-model')->first(),
    'prefix' => null,
    'suffix' => null,
    'prefixIcon' => null,
    'suffixIcon' => null,
    'iconAfter' => null,
    'clearable' => null,
    'copyable' => null,
    'revealable' => null,
    'invalid' => null,
    'type' => 'text',
    'size' => null,
    'icon' => null,
    'as' => null,
])

@php
    
    $invalid ??= $name && $errors->has($name);

    $classes = [
        // isolate stacking context to prevent z-index and shadow bleed from parent
        'isolate',

        'relative flex items-stretch w-full shadow-xs disabled:shadow-none transition-colors duration-200',

        'rounded-box',
        // Tailwind v4 '_input' means space + 'input'; these selectors target the input child
        '[&:has([data-slot=input-prefix])_input]:rounded-l-none',  // remove left border-radius if prefix exists

        '[&:has([data-slot=input-suffix])_input]:rounded-r-none',  // remove right border-radius if suffix exists

        '[&:has([data-slot=input-prefix]):has([data-slot=input-suffix])_input]:rounded-none', // no border-radius if both exist
    ];

    $iconCount = count(array_filter([$clearable,$copyable,$revealable]));
@endphp

<div {{ $attributes->class(Arr::toCssClasses([...$classes])) }}>
    {{-- HANDLE PREFIX SLOTS --}}
    @if (filled($prefix) || filled($prefixIcon))
        <x-ui.input.extra-slot data-slot="input-prefix">
            @if ($prefix instanceof \Illuminate\View\ComponentSlot)
                {{ $prefix }}
            @elseif ($prefixIcon)
                <x-ui.icon name="{{ $prefixIcon }}" />
            @endif
        </x-ui.input.extra-slot>
    @endif

    <div
        x-data {{-- required for Alpine actions --}}
        @class([
            'w-full grid isolate',

            // Overlap input actions to the right of the input using grid positioning
            '[&>[data-slot=input-actions]]:col-start-2 [&>[data-slot=input-actions]]:row-start-1 [&>[data-slot=input-actions]]:z-10 [&>[data-slot=input-actions]]:place-self-center',

            // Input spans full width, underlying input and actions share grid row/column
            '[&>[data-slot=control]]:col-start-1 [&>[data-slot=control]]:row-start-1 [&>[data-slot=control]]:col-span-2 ',

            // Dynamically pad input's right based on number of action icons present
            '[&:has([data-slot=input-actions]):has([data-slot=input-option])>[data-slot=control]]:pr-[1.9rem]',
            '[&:has([data-slot=input-actions]):has([data-slot=input-option]+[data-slot=input-option])>[data-slot=control]]:pr-[3.8rem]',
            '[&:has([data-slot=input-actions]):has([data-slot=input-option]+[data-slot=input-option]+[data-slot=input-option])>[data-slot=control]]:pr-[5.7rem]',
        ])
        {{-- Set grid columns: input + dynamic width for action icons --}}
        @style([
            '--icon-count: '. $iconCount,
            '--icon-width: 2rem',
            'grid-template-columns: 1fr calc(var(--icon-width) * var(--icon-count))'
        ])
    >
        <input
            @class([
                'z-10',
                'inline-block border p-2 w-full text-base sm:text-sm text-neutral-800 disabled:text-neutral-500 placeholder-neutral-400 disabled:placeholder-neutral-400/70 dark:text-neutral-300 dark:disabled:text-neutral-400 dark:placeholder-neutral-400 dark:disabled:placeholder-neutral-500',
                'bg-white dark:bg-neutral-900 dark:disabled:bg-neutral-800',
                'disabled:cursor-not-allowed transition-colors duration-200',
                'shadow-none dark:shadow-sm disabled:shadow-none rounded-box',
                'focus:ring-2 focus:ring-offset-0 focus:outline-none',
                'border-black/10 focus:border-black/15 focus:ring-neutral-900/15 dark:border-white/15 dark:focus:border-white/20 dark:focus:ring-neutral-100/15' => !$invalid,
                'border-red-600/30 border-2 focus:border-red-600/30 focus:ring-red-600/20 dark:border-red-400/30 dark:focus:border-red-400/30 dark:focus:ring-red-400/20' => $invalid,
            ])
            name="{{ $name }}"
            type="{{ $type }}"
            data-slot="control"
            {{$attributes}}
            x-ref="input"
            @if($invalid) invalid @endif
        />
        <div class="flex items-center h-[92%] mr-1" data-slot="input-actions">
            @if ($copyable)   <x-ui.input.options.copyable />   @endif
            @if ($clearable)  <x-ui.input.options.clearable />  @endif
            @if ($revealable) <x-ui.input.options.revealable /> @endif
        </div>
    </div>

    {{-- HANDLE SUFFIX SLOTS--}}
    @if (filled($suffix) || filled($suffixIcon))
        <x-ui.input.extra-slot data-slot="input-suffix">
            @if ($suffix instanceof \Illuminate\View\ComponentSlot)
                <div class="px-3">
                    {{ $suffix }}
                </div>
            @elseif ($suffixIcon)
                <x-ui.icon name="{{ $suffixIcon }}" />
            @endif
        </x-ui.input.extra-slot>
    @endif
</div>
