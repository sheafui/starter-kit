@aware([ 
    'collapsable' => true,
    'variant' => 'default',
    'label' => null,
    'icon' => null,
])

<div
    class="
        [:has([data-collapsed]_&)_&]:hidden flex justify-between items-center 
    "
>
    <div 
        @if($collapsable)
            x-on:click="expand()"
        @endif    

        class="
            w-full rounded-box
            hover:bg-[--alpha(var(--color-primary)_/5%)]
            hover:!text-[var(--color-primary)]
            hover:[&_[data-slot=icon]]:!text-[var(--color-primary)]
            flex items-center [:not(:has([data-collapsed]_&))_&]:pl-3
        "
    >
        <x-ui.icon 
            x-show="expanded"
            name="chevron-down" 
            class="size-4"
        />

        <x-ui.icon 
            x-show="!expanded"
            name="chevron-up" 
            style="display:none;"
            class="size-4"
        />
        <h4 class="pl-3 py-1">{{ $label }}</h4>
    </div>
    
  
</div>

<div 
    @if ($collapsable)
        x-show="expanded"
        x-collapse
    @endif
    
    class="
        [:has([data-collapsed]_&)_&]:m-0 ml-[--spacing(4.7)] rtl:mr-[--spacing(4.7)]
        [:has([data-collapsed]_&)_&]:items-center flex flex-col gap-y-1 
        [:has([data-collapsed]_&)_&]:pl-0 pl-2 
        dark:border-white/15 border-neutral-800/15
        border-l [:has([data-collapsed]_&)_&]:border-0 
    "
>
    {{ $slot }}
</div>