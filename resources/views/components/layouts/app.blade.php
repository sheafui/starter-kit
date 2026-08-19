<x-slot:title>
    {{ $title ?? 'Sheaf UI' }}
</x-slot:title>

<x-layouts.base>
    <x-ui.layout variant="sidebar-main">
        <x-ui.sidebar>
            <x-slot:brand>
                <x-ui.brand name="Sheaf UI" :href="route('home')">
                    <x-slot:logo>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" class="size-5">
                            <rect x="15" y="10" width="80" height="15" fill="currentColor" rx="5" ry="0" />
                            <rect x="15" y="30" width="60" height="15" fill="currentColor" />
                            <rect x="15" y="50" width="30" height="15" fill="currentColor" />
                            <rect x="15" y="55" width="10" height="30" fill="currentColor" />
                        </svg>
                    </x-slot:logo>
                </x-ui.brand>
            </x-slot:brand>

            <x-ui.navlist class="mt-4">
                <x-ui.navlist.group label="Platform">
                    <x-ui.navlist.item
                        label="Dashboard"
                        icon="home"
                        :href="route('dashboard')"
                        wire:navigate.hover
                    />
                    <x-ui.navlist.item
                        label="Account"
                        icon="cog-6-tooth"
                        :href="route('settings.account')"
                        wire:navigate.hover
                    />
                </x-ui.navlist.group>
            </x-ui.navlist>

            <x-ui.sidebar.push />

            <x-ui.navlist>
                <x-ui.navlist.item
                    label="Repository"
                    icon="code-bracket"
                    href="https://github.com/sheafui/starter-kit"
                    target="_blank"
                />
                <x-ui.navlist.item
                    label="Documentation"
                    icon="book-open"
                    href="https://sheafui.dev/docs"
                    target="_blank"
                />
            </x-ui.navlist>
        </x-ui.sidebar>

        <x-ui.layout.main class="max-h-screen overflow-y-auto">
            <div
                data-slot="header"
                class="sticky top-0 z-40 flex min-h-[var(--header-height)] items-center gap-3 border-b border-neutral-800/5 bg-white px-4 dark:border-b-white/5 dark:bg-neutral-950"
            >
                <x-ui.sidebar.toggle class="md:hidden" />

                <div class="ml-auto flex items-center gap-3">
                    @auth
                        <x-user-dropdown />
                    @endauth

                    <x-ui.separator class="my-2" vertical />

                    <x-ui.theme-switcher variant="inline" />
                </div>
            </div>

            <div class="mx-auto w-full max-w-5xl p-6">
                {{ $slot }}
            </div>
        </x-ui.layout.main>
    </x-ui.layout>
</x-layouts.base>
