<x-ui.input.options.button
    x-on:click="
        $refs.input.value = '';
        $refs.input.dispatchEvent(new Event('input'))"
>     
    <x-ui.icon name="x-mark" />
</x-ui.input.options.button>