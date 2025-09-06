<div class="relative z-10 w-full">

<!-- Top Border Pattern -->
<div class="grid grid-cols-5">
    <div class="border-neutral-600/30 border !border-l-0 !border-r-0 !border-t-0 border-dashed py-6"
        style="mask: linear-gradient(to right, transparent 0%, black 80%, black 100%); -webkit-mask: linear-gradient(to right, transparent 0%, black 80%, black 100%);">
    </div>
    <div class="border-neutral-600/30 bg-background z-40 col-span-3 border !border-t-0 border-dashed py-10 lg:py-20">
    </div>
    <div class="border-neutral-600/30 border !border-l-0 !border-r-0 !border-t-0 border-dashed py-6"
        style="mask: linear-gradient(to left, transparent 0%, black 80%, black 100%); -webkit-mask: linear-gradient(to left, transparent 0%, black 80%, black 100%);">
    </div>
</div>

<!-- Main Title Section -->
<div class="grid grid-cols-5">
    <div class="hover:bg-neutral-600/6 border-neutral-600/30 hidden border !border-l-0 !border-r-0 border-t-0 border-dashed py-6 lg:flex"
        style="mask: linear-gradient(to right, transparent 0%, black 80%, black 100%); -webkit-mask: linear-gradient(to right, transparent 0%, black 80%, black 100%);">
    </div>

    <!-- Title Content -->
    <div
        class="hover:bg-neutral-600/6 border-neutral-600/30 before:border-neutral-600/30 before: relative col-span-5 border border-t-0 border-dashed py-10 before:absolute before:-left-16 before:-top-16 before:h-32 before:w-32 before:animate-pulse before:rounded-full before:border before:border-dashed before:content-[''] lg:col-span-3 dark:before:border-white/20">

        <h1 class="text-base-100 mx-auto px-4 text-3xl font-bold tracking-tight sm:text-5xl md:max-w-lg md:px-0">
            Own Every Line of Your <br> Laravel UI
        </h1>
    </div>

    <div class="hover:bg-neutral-600/6 border-neutral-600/30 hidden border !border-l-0 !border-r-0 border-t-0 border-dashed py-6 lg:flex"
        style="mask: linear-gradient(to left, transparent 0%, black 80%, black 100%); -webkit-mask: linear-gradient(to left, transparent 0%, black 80%, black 100%);">
    </div>
</div>

<!-- Subtitle Section -->
<div class="grid grid-cols-5">
    <div class="hover:bg-neutral-600/6 border-neutral-600/30 hidden border !border-l-0 !border-r-0 border-t-0 border-dashed py-6 lg:flex"
        style="mask: linear-gradient(to right, transparent 0%, black 80%, black 100%); -webkit-mask: linear-gradient(to right, transparent 0%, black 80%, black 100%);">
    </div>

    <!-- Subtitle Content -->
    <div
        class="hover:bg-neutral-600/6 border-neutral-600/30  relative col-span-5 border border-t-0 border-dashed py-10 before:absolute before:-right-10 before:-top-10 before:z-40 before:h-20 before:w-20 before:rotate-45 before:border before:border-dashed before:content-[''] lg:col-span-3 before:border-neutral-600/30 dark:before:border-white/20 before:bg-background">

        <p class="text-neutral-600 mx-auto max-w-2xl px-4 text-center text-base sm:text-lg md:px-0">
            {{-- Sheaf UI is a CLI-driven UI framework that scaffolds elegant Blade + Livewire components right into your codebase. It’s open source, production-ready, and fully yours. --}}
            Skip the copy-paste workflow. Sheaf UI delivers beautiful Blade components with Alpine.js and Livewire
            support to your Laravel project through intelligent CLI scaffolding. Open source, production-ready, and
            built for better developer experience.
        </p>
        <p class="text-neutral-600 mt-6 mx-auto max-w-lg px-4 text-center text-base sm:text-lg md:px-0">
            Inspired by the popular <x-ui.link href="https://ui.shadcn.com">shadcn/ui</x-ui.link> design system
        </p>
    </div>

    <div class="hover:bg-neutral-600/6 border-neutral-600/30 hidden border !border-l-0 !border-r-0 border-t-0 border-dashed py-6 lg:flex"
        style="mask: linear-gradient(to left, transparent 0%, black 80%, black 100%); -webkit-mask: linear-gradient(to left, transparent 0%, black 80%, black 100%);">
    </div>
</div>

<!-- Call-to-Action Section -->
<div class="grid grid-cols-5">
    <div class="hover:bg-neutral-600/6 border-neutral-600/30 border !border-l-0 !border-r-0 border-t-0 border-dashed py-6"
        style="mask: linear-gradient(to right, transparent 0%, black 80%, black 100%); -webkit-mask: linear-gradient(to right, transparent 0%, black 80%, black 100%);">
    </div>

    <div
        class="hover:bg-neutral-600/6 border-neutral-600/30 hidden border border-r-0 border-t-0 border-dashed py-6 lg:flex">
    </div>

    <!-- CTA Button -->
    <div
        class="border-neutral-600/30 before:border-neutral-600/30 relative col-span-3 border border-t-0 border-dashed py-6 before:absolute before:-bottom-5 before:-right-6 before:z-10 before:h-10 before:w-12 before:rounded-none before:border before:border-dashed before:content-[''] lg:col-span-1 dark:before:border-white/20 before:bg-background">

        <!-- SVG avec animation carrée -->

        <x-ui.button 
            href="https://sheafui.dev/docs/guides/overview" 
            icon-after="plus"
            class="dark:bg-neutral-800 bg-neutral-100 dark:text-white text-neutral-900 hover:bg-neutral-800" 
            icon-classes="w-4">Get
            started
        </x-ui.button>
    </div>

    <div
        class="hover:bg-neutral-600/6 border-neutral-600/30 hidden border border-l-0 border-t-0 border-dashed py-6 lg:flex">
    </div>

    <div class="hover:bg-neutral-600/6 border-neutral-600/30 border !border-l-0 !border-r-0 border-t-0 border-dashed py-6"
        style="mask: linear-gradient(to left, transparent 0%, black 80%, black 100%); -webkit-mask: linear-gradient(to left, transparent 0%, black 80%, black 100%);">
    </div>
</div>

<!-- Bottom Border Pattern -->
<div class="grid grid-cols-5">
    <div class="hover:bg-neutral-600/6 border-neutral-600/30 border !border-b-0 !border-l-0 !border-r-0 border-t-0 border-dashed py-6"
        style="mask: linear-gradient(to right, transparent 0%, black 80%, black 100%); -webkit-mask: linear-gradient(to right, transparent 0%, black 80%, black 100%);">
    </div>

    <div class="hover:bg-neutral-600/6 lg:py-15 border-neutral-600/30 hidden border !border-b-0 border-r-0 border-t-0 border-dashed py-6 md:flex"
        style="mask: linear-gradient(to top, transparent 0%, black 80%, black 100%);">
    </div>

    <div class="hover:bg-neutral-600/6 border-neutral-600/30 col-span-3 border !border-b-0 border-r-0 border-t-0 border-dashed md:col-span-1"
        style="mask: linear-gradient(to top, transparent 0%, black 80%, black 100%);">
    </div>

    <div class="hover:bg-neutral-600/6 border-neutral-600/30 hidden border !border-b-0 border-t-0 border-dashed md:flex"
        style="mask: linear-gradient(to top, transparent 0%, black 80%, black 100%);">
    </div>

    <div class="hover:bg-neutral-600/6 border-neutral-600/30 border !border-b-0 !border-l-0 !border-r-0 border-t-0 border-dashed py-6"
        style="mask: linear-gradient(to left, transparent 0%, black 80%, black 100%); -webkit-mask: linear-gradient(to left, transparent 0%, black 80%, black 100%);">
    </div>
</div>

</div>