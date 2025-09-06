 @php
     $user = Auth::user();
 @endphp

 <x-ui.dropdown position="bottom-end">
    <x-slot:button class="justify-center">
        <button variant="none" class="bg-base-200/6 text-base-100 ring-base-200/10 hover:bg-base-200/10 rounded-field inline-flex h-8 w-8 items-center justify-center text-sm font-medium ring-1 ring-inset">
                <img src="https://gravatar.com/avatar/a8c27f85e99afbf7bc5616fc9409eb62?s=200&d=retro&r=x"
                    alt="{{ $user->username }}"
                    class="rounded-field h-6 w-6 object-cover"
                >
        </button>
    </x-slot:button>

    <x-slot:menu class="w-56">
        <x-ui.dropdown.group label="signed in as">
            <x-ui.dropdown.item>
                {{ $user->email }}
            </x-ui.dropdown.item>
        </x-ui.dropdown.group>

        <x-ui.dropdown.separator />

        <x-ui.dropdown.item :href="route('dashboard')" wire:navigate.live>
            Dashboard
        </x-ui.dropdown.item>

        <x-ui.dropdown.separator />

        <form
            action="{{ route('app.auth.logout') }}"
            method="post"
            class="contents"
        >
            @csrf
            <x-ui.dropdown.item as="button" type="submit">
                Sign Out
            </x-ui.dropdown.item>
        </form>

    </x-slot:menu>
</x-ui.dropdown>
