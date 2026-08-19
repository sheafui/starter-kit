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
    <div @class([
        "flex items-center",
        "[:not(:has([data-collapsed]_&))_&]:pl-3" => $icon
    ])>
        @if ($icon)
            <x-ui.icon :name="$icon" class="size-5"/>
        @endif

        <h4 class="font-semibold pl-3 py-1">{{ $label }}</h4>
    </div>
    
    @if ($collapsable)
        <button
            x-on:click="expand()"
            class="p-2 rounded-box cursor-pointer hover:dark:bg-white/5 hover:bg-neutral-900/5"
            type="button"
        >
            <x-ui.icon 
                x-show="!expanded"
                style="display:none;"
                name="chevron-down" 
                class="size-4"
            />
            <x-ui.icon 
                x-show="expanded"
                name="chevron-up" 
                style="display:none;"
                class="size-4"
            />
        </button>
    @endif
</div>

<div 
    @if ($collapsable)
        x-show="expanded"
        x-collapse
    @endif
    
    class="
        [:has([data-collapsed]_&)_&]:items-center
        flex flex-col gap-y-1 ml-2 rtl:mr-2
        [:has([data-collapsed]_&)_&]:m-0
    "
>
    {{ $slot }}
</div>