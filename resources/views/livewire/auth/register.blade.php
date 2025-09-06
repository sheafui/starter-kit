<x-slot:title>
    Register an account
</x-slot>

<form wire:submit="register"
      class="mx-auto w-full max-w-md space-y-4">

    {{-- Socialite action buttons --}}
    <div class="w-full text-center">
        <x-ui.button
            class="w-full"
            color="outline"
            href="{{ route('github.redirect') }}"
            iconAfter="arrow-trending-up"
        >
        register with GitHub
        </x-ui.button>

    </div>

    <x-ui.separator label="Or"/>

    {{-- Form --}}
    <div class="space-y-4 gap-y-1">
                <x-ui.field >
            <x-ui.label>username</x-ui.label>
            <x-ui.input
                wire:model.blur="form.username"
                placeholder="Enter your username"
            />
            <x-ui.error name="form.username" />
        </x-ui.field>

        <x-ui.field >
            <x-ui.label>email address</x-ui.label>
            <x-ui.input
                wire:model.blur="form.email"
                type="email"
                placeholder="Enter your email"
            />
            <x-ui.error name="form.email" />
        </x-ui.field>

        <x-ui.field >
            <x-ui.label>password</x-ui.label>
            <x-ui.input
                wire:model.blur="form.password"
                type="password"
                revealable
                placeholder="Create a secure password"
            />
            <x-ui.error name="form.password" />
        </x-ui.field>

        <x-ui.field >
            <x-ui.label>password confirmation</x-ui.label>
            <x-ui.input
                wire:model.blur="form.password_confirmation"
                type="password"
                revealable
                placeholder="Confirm your password"
            />
            <x-ui.error name="form.password_confirmation" />
        </x-ui.field>
    </div>

    {{-- Action button --}}
    <x-ui.button class="w-full"
                 type="submit"
                 wire:loading.class="opacity-50 duration-300 transition"
                 wire:target="register">
        Register
        <div class="hidden"
             wire:loading
             wire:target="register">
            <x-filament::loading-indicator class="h-5 w-5" />
        </div>
    </x-ui.button>

    <a class="text-base-200 text-sm underline"
       href="{{ route('login') }}">Already have an account? <span class="font-bold">Log in</span></a>
</form>
