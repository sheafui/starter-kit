<x-ui.input.options.button
    x-data="{
        revealed: false,
        toggleReveal() {
            const input = $el.closest('[data-slot=input-actions]').parentElement.querySelector('input[data-control-id=input]');
            if (!input) return;
            
            this.revealed = !this.revealed;
            input.type = this.revealed ? 'text' : 'password';
        }
    }"
    x-on:click="toggleReveal()"
    x-bind:data-slot-revealed="revealed"
    x-bind:aria-label="revealed ? 'Hide password' : 'Show password'"
    x-bind:title="revealed ? 'Hide password' : 'Show password'"
>     
    <x-ui.icon 
        name="eye-slash" 
        class="hidden [[data-slot-revealed]>&]:inline-flex"
        aria-hidden="true"
    />
    <x-ui.icon 
        name="eye" 
        class="inline-flex [[data-slot-revealed]>&]:hidden"
        aria-hidden="true"
    />
</x-ui.input.options.button>