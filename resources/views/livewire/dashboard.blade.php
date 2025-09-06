{{-- once I build the sidebar, header and navlist components I will refactor to them (asap) --}}
<div class="flex gap-6 mt-50">
    <x-ui.card 
        size="xl"
        class="mx-auto"
    >
        <x-ui.heading class="flex items-center justify-between mb-4" level="h3" size="sm">
            Welcome to Sheaf UI
            <x-ui.link href="https://sheafui.dev" openInNewTab>
                <x-ui.icon name="arrow-up-right" class="text-gray-800 dark:text-white size-4" />
            </x-ui.link>
        </x-ui.heading>
        <x-ui.text>
            Powered by the TALL stack, our components offer speed, elegance,
            and accessibility for modern web development.
        </x-ui.text>
    </x-ui.card>
    
    <x-ui.card 
        size="xl"
        class="mx-auto"
    >
        <x-ui.heading class="flex items-center justify-between mb-4" level="h3" size="sm">
            Start reading about SheafUI
            <x-ui.link href="https://sheafui.dev/docs/guides/overview" openInNewTab>
                <x-ui.icon name="arrow-up-right" class="text-gray-800 dark:text-white size-4" />
            </x-ui.link>
        </x-ui.heading>
        <x-ui.text>
            Our comprehensive documentation is AI-powered, clear, and consistent. Discover our copy-paste philosophy, learn about component architecture, and explore integration patterns.
        </x-ui.text>
    </x-ui.card>
</div>