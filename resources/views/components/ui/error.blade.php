@props([
    'name' => null,
    'messages' => [],
])

@php
    $errorMessages = [];
    
    // 1. From $errors bag 
    if ($name && $errors->has($name)) {
        $errorMessages = array_merge($errorMessages, $errors->get($name));
    }
    
    // 2. From manual messages prop
    if (filled($messages)) {
        $errorMessages = array_merge($errorMessages, Arr::wrap($messages));
    }
    
    $errorMessages = array_filter(array_unique($errorMessages));
    
    $hasErrors = !empty($errorMessages);
    
    $classes = [
        '[&>[data-slot=icon]]:!text-red-600 [&>[data-slot=icon]]:dark:!text-red-400', // force our icon to take red color 
        'mt-2 text-sm text-red-600 dark:text-red-400',
        'flex items-start gap-2',
        'hidden' => !$hasErrors,
    ];
@endphp

@if ($hasErrors)
    <div 
        aria-live="polite"
        role="alert"
        {{ $attributes->class(Arr::toCssClasses($classes)) }} 
        data-slot="error"
    >
        <x-ui.icon name="exclamation-circle" class="flex-shrink-0 w-4 h-4 mt-0.5" />
        <div class="flex-1">
            @if (count($errorMessages) === 1)
                <span>{{ $errorMessages[0] }}</span>
            @else
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errorMessages as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
@endif