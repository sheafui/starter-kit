@props([
    'variant' => 'dropdown',
    'darkIcon'=>'moon',
    'lightIcon'=>'sun',
    'systemIcon'=>'computer-desktop',
    'iconVariant' => "mini"
])

<div 
    class='flex items-center'>
    <label class="sr-only">
        Theme
    </label>

    <div x-data>
        @if ($variant === 'dropdown')
            <x-ui.theme-switcher.variants.dropdown/>
        @elseif($variant === 'stacked')
            <x-ui.theme-switcher.variants.stacked/>
        @elseif($variant === 'inline')
            <x-ui.theme-switcher.variants.inline/>
        @endif
    </div>
</div>
