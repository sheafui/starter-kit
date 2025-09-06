
<div class="mx-auto mt-24 max-w-xl">
    <x-fieldset>
        <x-slot name="label">
            Confirm Password
        </x-slot>
        <form wire:submit="confirmPasswordm" x-data="form">
            <x-form.element label="password">
                <x-input.wrapper>
                    <x-input type="password" wire:model="password" x-ref="password" />
                    <x-slot name="suffix">
                        <x-input.password-suffix trigger="password" method="togglePasswordVisibility('password')" />
                    </x-slot>
                </x-input.wrapper>
                <x-error class="mt-2" :messages="$errors->get('password')" />
            </x-form.element>
            <x-ui.button 
                class="mt-4 flex w-full rounded-xl bg-blue-500 px-4 py-2 text-white" 
                type="submit"
            >
                save
            </x-ui.button>
        </form>
    </x-fieldset>
</div>
