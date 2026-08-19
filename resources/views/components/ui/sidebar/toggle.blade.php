@props([
    'tooltip'=>null
])

<x-ui.navlist.has-tooltip
    tooltip="toggle sidebar"
    :condition="true" {{-- always show it when hovering over toggle --}}
>
    <button 
        {{ $attributes->class(
            "relative [:where(&)]:mx-auto inline-flex hover:dark:bg-white/5 hover:bg-neutral-800/5 p-1.5 rounded-box cursor-pointer"
        ) }}
        x-on:click="toggle()"
        data-slot="sidebar-toggle"
    >
        <x-ui.icon
            name="code-bracket-square"
        />
        <span class="absolute size-12 top-1/2 left-1/2 -translate-1/2 pointer-fine:hidden">
            <!--
                Touch target enhancement: Expands clickable area to 48px for thumb-friendly interaction
                Hidden on precise pointer devices (mouse) - only shows for touch/stylus input
                WCAG guideline: minimum 44px touch targets for accessibility
                @see https://tailwindcss.com/docs/hover-focus-and-other-states#pointer
            -->
        </span>
    </button>
</x-ui.navlist.has-tooltip>


