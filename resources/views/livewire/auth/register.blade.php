<x-slot:title>
    Register an account
</x-slot>

<form 
    wire:submit="register"
    class="mx-auto w-full max-w-md space-y-4"
>
    <div class="space-y-4 gap-y-1">
        <x-ui.field >
            <x-ui.label>name</x-ui.label>
            <x-ui.input
                wire:model="form.name"
                placeholder="Enter your name"
            />
            <x-ui.error name="form.name" />
        </x-ui.field>

        <x-ui.field >
            <x-ui.label>email address</x-ui.label>
            <x-ui.input
                wire:model="form.email"
                type="email"
                placeholder="Enter your email"
            />
            <x-ui.error name="form.email" />
        </x-ui.field>

        <x-ui.field >
            <x-ui.label>password</x-ui.label>
            <x-ui.input
                wire:model="form.password"
                type="password"
                revealable
                placeholder="Create a secure password"
            />
            <x-ui.error name="form.password" />
        </x-ui.field>

        <x-ui.field >
            <x-ui.label>password confirmation</x-ui.label>
            <x-ui.input
                wire:model="form.password_confirmation"
                type="password"
                revealable
                placeholder="Confirm your password"
            />
            <x-ui.error name="form.password_confirmation" />
        </x-ui.field>
    </div>

    <x-ui.button
        class="w-full"
        type="submit"
    >
        Register
    </x-ui.button>

    <x-ui.link 
        variant="soft"
        href="{{ route('login') }}"
    >
        Already have an account? <span class="underline">Log in</span>
    </x-ui.link>
</form>
