 @php
     $user = Auth::user();
 @endphp

 <x-ui.dropdown position="bottom-end">
    <x-slot:button class="justify-center">
        <x-ui.avatar
            class="cursor-pointer"
            :name="$user->name"
            {{-- : name="$user->avatar" give avatar's image source if have any!  --}}
            size="sm" 
        />
    </x-slot:button>

    <x-slot:menu class="w-56">
        <x-ui.dropdown.group label="Signed in as">
            <x-ui.dropdown.item>
                {{ $user->email }}
            </x-ui.dropdown.item>
        </x-ui.dropdown.group>

        <x-ui.dropdown.separator />

        <x-ui.dropdown.item :href="route('settings.account')" wire:navigate.live>
            Account
        </x-ui.dropdown.item>

        <x-ui.dropdown.item :href="route('dashboard')" wire:navigate.live>
            Dashboard
        </x-ui.dropdown.item>

        <x-ui.dropdown.separator />

        <form
            action="{{ route('app.auth.logout') }}"
            method="post"
            class="contents" {{-- this make the form does contribute the layotu, so it does not break --}}
        >
            @csrf
            <x-ui.dropdown.item as="button" type="submit">
                Sign Out
            </x-ui.dropdown.item>
        </form>

    </x-slot:menu>
</x-ui.dropdown>
