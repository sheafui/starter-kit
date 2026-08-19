<button
    {{ $attributes }}
    data-slot="input-option"
    type="button"  
    class="mx-0.5 flex  cursor-pointer [&_[data-slot=icon]]:!text-neutral-500 dark:[&_[data-slot=icon]]:!text-neutral-500 hover:dark:[&_[data-slot=icon]]:!text-neutral-400 [&_[data-slot=icon]]:transition"
>     
    {{ $slot }}
</button>