<div class="mx-auto space-y-20 mt-20">
    <div class="rounded-box flex flex-col w-full gap-4 lg:flex-row  mt-6 bg-white p-6 dark:bg-neutral-800/10">
        <div class="grow">
            <form 
                wire:submit="saveChanges"
                class="space-y-4"
            >
                <x-ui.field>
                    <x-ui.label>name</x-ui.label>
                    <x-ui.input wire:model="name" />
                    <x-ui.error name="name" />
                </x-ui.field>
                
                <x-ui.field>
                    <x-ui.label>email address</x-ui.label>
                    <x-ui.input 
                        wire:model="email"
                        type="email"
                        copyable 
                    />
                    <x-ui.error name="email" />
                </x-ui.field>
                
                <x-ui.button 
                    type="submit"
                >Save changes</x-ui.button>
            </form>
        </div>
    </div>
    
    <div>
        <h2 class="text-base-100 text-base font-semibold leading-7">Change password</h2>
        <p class="text-base-200 mt-1 text-sm leading-6">Update your security credentials</p>
        <form wire:submit="updatePassword"
              class="mt-8 space-y-4 rounded-lg bg-white p-6 dark:bg-neutral-800/10">
            
            <x-ui.field>
                <x-ui.label>Current Password</x-ui.label>
                <x-ui.input 
                    wire:model="current_password"
                    type="password"
                    revealable 
                />
                <x-ui.error name="current_password" />
            </x-ui.field>
            
            <x-ui.field>
                <x-ui.label>New Password</x-ui.label>
                <x-ui.input 
                    wire:model="password"
                    type="password"
                    revealable 
                />
                <x-ui.error name="password" />
            </x-ui.field>
            
            <x-ui.field>
                <x-ui.label>Confirm New Password</x-ui.label>
                <x-ui.input 
                    wire:model="password_confirmation"
                    type="password"
                    revealable
                />
                <x-ui.error name="password_confirmation" />
            </x-ui.field>
            
            <x-ui.button 
                type="submit"
                class="mt-6"
            >
                Change Password
            </x-ui.button>
        </form>
    </div>
</div>