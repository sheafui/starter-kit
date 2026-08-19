{{--
    ╔═══════════════════════════════════════════════════════════════════════════════╗
    ║                         SIDEBAR COMPONENT                                     ║
    ║                                                                               ║
    ║  A responsive sidebar that adapts to different screen sizes:                  ║
    ║  • Mobile (< 768px): Overlay sidebar with backdrop                            ║
    ║  • Tablet (768px-1024px): Always collapsed, visible sidebar                   ║
    ║  • Desktop (>= 1024px): Expandable/collapsible sidebar                        ║
    ║                                                                               ║
    ║  Features:                                                                    ║
    ║  • Touch device support (tap anywhere to toggle on tablets)                   ║
    ║  • Sticky header option                                                       ║
    ║  • Scrollable content area                                                    ║
    ║  • Brand/logo slot                                                            ║
    ║  • Toggle button with auto-hide on collapse                                   ║
    ╚═══════════════════════════════════════════════════════════════════════════════╝
--}}


@aware([
    'collapsable' => true,
])

{{--
    ┌─────────────────────────────────────────────────────────────────────────────┐
    │ COMPONENT PROPS                                                             │
    │                                                                             │
    │ @param bool $stickyHeader - Makes the sidebar header stick to top on scroll │
    │ @param bool $scrollable   - Enables vertical scrolling for sidebar content  │
    │ @param bool $collapsable  - Allows sidebar to be collapsed/expanded         │
    │ @param string $brand      - Brand name/logo content                         │
    └─────────────────────────────────────────────────────────────────────────────┘
--}}

@props([
    'stickyHeader' => true,
    'scrollable' => true,
    'collapsable' => true,
    'brand' => null
])

@php
    $classes = [
        'isolate',
        '[grid-area:sidebar]',
        'z-40 dark:bg-neutral-950 bg-white lg:block',
        'border-r dark:border-white/5 border-black/5',
        'transition-[width] duration-500',
        'overflow-x-visible',
        '!overflow-y-auto' => $scrollable, // Only make scrollable if needed
    ];
@endphp

{{--
    ┌─────────────────────────────────────────────────────────────────────────────┐
    │ SIDEBAR CONTAINER                                                           │
    │                                                                             │
    │ data-slot="sidebar" - Used by parent layout for CSS targeting               │
    │ style="z-index:9999" - Ensures sidebar stays above other content            │
    └─────────────────────────────────────────────────────────────────────────────┘
--}}
<div
    {{ $attributes->class($classes) }}
    data-slot="sidebar"
    style="z-index:99;"
    @if ($collapsable)
        x-data="{
            collapsable: @js($collapsable)
        }"        
    @endif
    
    {{--
        ┌─────────────────────────────────────────────────────────────────────────┐
        │ TOUCH DEVICE INTERACTION                                                │
        │                                                                         │
        │ On touch devices (tablets), clicking anywhere on sidebar toggles it     │
        │ EXCEPT when clicking:                                                   │
        │ • The brand/logo area                                                   │
        │ • The toggle button itself                                              │
        │ • On mobile devices (uses overlay instead)                              │
        │                                                                         │
        │ Why? Better UX on tablets where hover doesn't exist                     │
        └─────────────────────────────────────────────────────────────────────────┘
    --}}
    x-init="
        if(window.matchMedia('(pointer: coarse)').matches) {
            $el.addEventListener('click', (event) => {
                // Don't toggle if clicking brand area
                if(event.target.closest('[data-slot=sidebar-brand]')) {
                    return;
                }
                
                // Don't toggle if clicking the toggle button
                if(event.target.closest('[data-slot=sidebar-toggle]')) {
                    return;
                }
                
                // Don't toggle on mobile (uses overlay mode)
                if($data.isMobile) {
                    return;
                }
                
                // Toggle collapse state
                toggle();
            });
        }
    "
>
    @if(filled($brand))
        <div 
            @class([
                // Base layout
                "justify-between items-center group w-full 
                [:not(:has([data-collapsed]_&))_&]:flex 
                min-h-[var(--header-height)] 
                [:not(:has([data-collapsed]_&))_&]:px-4
                mx-auto flex-shrink-0",
                
                // Optional sticky positioning
                'sticky z-10 top-0 dark:bg-neutral-950 bg-white' => $stickyHeader,
            ])
        >
            <div
                @class([
                    "[:not(:has([data-collapsed]_&))_&]:mx-auto grow 
                    [:has([data-collapsed]_&)_&]:[&_[data-slot=brand-name]]:hidden",
                    "[:has([data-collapsed]_&)_&]:group-hover:hidden" => $collapsable
                ])
                data-slot="sidebar-brand"
            >
                {{ $brand }}
            </div>
            
            @if ($collapsable)
                <x-ui.sidebar.toggle
                    x-bind:data-collapsable="collapsable"
                    class="
                        [&:not([data-collapsable=true])]:hidden
                        [:has([data-collapsed]_&)_&]:group-hover:inline-flex
                        [:has([data-collapsed]_&)_&]:hidden
                        [:has([data-collapsed]_&)_&]:cursor-ew-resize
                    "
                />                
            @endif
        </div>
    @endif
   
    <div 
        @class([
            'flex flex-col min-h-[calc(100vh-var(--header-height))]',
            'z-0' => $stickyHeader,
        ])
    >
        {{ $slot }}
    </div>
</div>