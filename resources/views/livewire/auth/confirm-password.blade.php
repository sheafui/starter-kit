
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
            <button class="mt-4 flex w-full rounded-xl bg-blue-500 px-4 py-2 text-white" type="submit"
                wire:loading.class="opacity-50 duration-300 transition">
                <div class="between flex w-full items-center justify-between">
                    save
                    <div class="hidden" wire:loading>
                        <x-filament::loading-indicator class="h-5 w-5" />
                    </div>
                </div>
            </button>
        </form>
    </x-fieldset>
</div>
