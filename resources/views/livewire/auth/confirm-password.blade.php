
<div class="mx-auto mt-24 max-w-xl">
    <x-ui.fieldset>
        <form wire:submit="confirmPasswordm">
            <x-ui.field>
                <x-ui.label>password</x-ui.label>
                <x-ui.input
                    wire:model.blur="form.password"
                    type='password'
                    revealable
                />
                <x-ui.error name="password" />
            </x-ui.field>
            <x-ui.button 
                class="mt-4 flex w-full rounded-xl bg-blue-500 px-4 py-2 text-white" 
                type="submit"
            >
                save
            </x-ui.button>
        </form>
    </x-ui.fieldset>
</div>
