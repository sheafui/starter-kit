@props([
    'vertical' => false,
    'variant' => null,
    'label' => null,
])

@php
    $orientation = $vertical ? 'vertical' : 'horizontal';

    $lineClasses = [
        'border-0',
        'bg-gray-300 dark:bg-gray-300/30',
        'mx-1' => $orientation === 'vertical',
        'my-1' => $orientation === 'horizontal',
        match($orientation) {
            'vertical' => filled($label) ? 'w-px grow' : 'w-px self-stretch shrink-0',
            'horizontal' => filled($label) ? 'h-px flex-1' : 'h-px w-full'
        }
    ];

    $lineClasses = Arr::toCssClasses($lineClasses);
@endphp

@if (!filled($label))
    @if ($orientation === 'vertical')
        <div 
            data-orientation="{{ $orientation }}" 
            {{ $attributes->class($lineClasses) }} 
            role="separator" 
            aria-orientation="{{ $orientation }}"
            data-slot="separator"
        ></div>
    @else
        {{-- we need to make the element can contributes to space-y-* likely if we don't use flex --}}
        <div 
            data-orientation="{{ $orientation }}" 
            {{ $attributes->class('w-full') }} 
            data-slot="separator"
            role="separator" 
            aria-orientation="{{ $orientation }}"
        >
            <div class="{{ $lineClasses }}"></div>
        </div>
    @endif
@else
    @if ($orientation === 'vertical')
        <div 
            {{ $attributes->merge(['class' => 'flex flex-col justify-center items-center self-stretch mx-1']) }} 
            data-slot="separator"
            role="separator" 
            aria-orientation="{{ $orientation }}"
            aria-label="{{ $label }}"
        >
            <div class="{{ $lineClasses }}" aria-hidden="true"></div>
            <div class="text-sm leading-none text-gray-500 dark:text-gray-300 pb-[0.22rem] whitespace-nowrap">
                {{ $label }}
            </div>
            <div class="{{ $lineClasses }}" aria-hidden="true"></div>
        </div>
    @else
        <div 
            data-orientation="{{ $orientation }}" 
            {{ $attributes->merge(['class' => 'flex items-center w-full my-4']) }} 
            role="separator" 
            aria-orientation="{{ $orientation }}"
            aria-label="{{ $label }}"
            data-slot="separator"
        >
            <div class="{{ $lineClasses }}" aria-hidden="true"></div>
            <span class="shrink-0 mx-6 font-medium text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                {{ $label }}
            </span>
            <div class="{{ $lineClasses }}" aria-hidden="true"></div>
        </div>
    @endif
@endif
