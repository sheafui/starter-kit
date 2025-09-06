<x-slot:title>
    Login to Sheaf
</x-slot>

<form 
    wire:submit="login"
    class="mx-auto w-full max-w-md space-y-4"
>

    <div class="space-y-4">
        <x-ui.field>
            <x-ui.label>email address</x-ui.label>
            <x-ui.input
                wire:model="form.email"
            />
            <x-ui.error name="form.email" />
        </x-ui.field>

        <x-ui.field>
            <x-ui.label>password</x-ui.label>
            <x-ui.input
                wire:model="form.password"
                type='password'
                revealable
            />
            <x-ui.error name="form.password" />
        </x-ui.field>
    </div>

    <x-ui.button 
        class="w-full"
        type="submit"
    >
        Log in
    </x-ui.button>

    <x-ui.link
        variant="soft" 
        href="{{ route('register') }}"
    >
        I dont have an account? 
        <span class="underline">Sign up</span>
    </x-ui.link>
</form>
