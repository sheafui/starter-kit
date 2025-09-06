<x-slot:title>
    Login to Sheaf
</x-slot>

<form wire:submit="login"
      class="mx-auto w-full max-w-md space-y-4">

    {{-- Socialite action buttons --}}
    <div class="w-full text-center">
        <x-ui.button
            class="w-full"
            href="{{ route('github.redirect') }}"
            iconAfter="arrow-trending-up"
        >Log in with GitHub</x-ui.button>

    </div>

    {{-- Divide --}}
    <x-ui.separator label="Or"/>


    {{-- Form --}}
    <div class="space-y-4">
        <x-ui.field>
            <x-ui.label>email address</x-ui.label>
            <x-ui.input
                wire:model.blur="form.email"
            />
            <x-ui.error name="form.email" />
        </x-ui.field>

        <x-ui.field>
            <x-ui.label>password</x-ui.label>
            <x-ui.input
                wire:model.blur="form.password"
                type='password'
                revealable
            />
            <x-ui.error name="form.password" />
        </x-ui.field>
    </div>

    {{-- Action button --}}
    <x-ui.button 
        class="w-full"
        type="submit"
    >
        Log in
    </x-ui.button>

    <a class="text-base-200 text-sm underline"
       href="{{ route('register') }}">I dont have an account? <span class="font-bold">Sign up</span></a>
</form>
