{{--
    ╔═══════════════════════════════════════════════════════════════════════════════╗
    ║                    HEADER-SIDEBAR LAYOUT VARIANT                              ║
    ║                                                                               ║
    ║  A responsive layout with HEADER ON TOP and SIDEBAR ON SIDE:                  ║
    ║                                                                               ║
    ║  Layout Structure:                                                            ║
    ║          ┌─────────────────────────────────────────────────────────┐          ║
    ║          │                      HEADER                             │          ║
    ║          ├──────────┬──────────────────────────────────────────────┤          ║
    ║          │          │                                              │          ║
    ║          │ SIDEBAR  │             MAIN CONTENT                     │          ║
    ║          │          │                                              │          ║
    ║          └──────────┴──────────────────────────────────────────────┘          ║
    ║                                                                               ║
    ║   MOBILE (< 768px):                                                           ║
    ║     • Header spans full width at top                                          ║
    ║     • Overlay sidebar (slides in from left)                                   ║
    ║     • Backdrop overlay when sidebar is open                                   ║
    ║     • Full-width main content below header                                    ║
    ║                                                                               ║
    ║   TABLET (768px - 1024px):                                                    ║
    ║     • Header spans full width at top                                          ║
    ║     • Always collapsed sidebar (visible, narrow)                              ║
    ║     • Sidebar and main content side-by-side below header                      ║
    ║                                                                               ║
    ║    DESKTOP (>= 1024x):                                                        ║
    ║     • Header spans full width at top                                          ║
    ║     • Expandable/collapsible sidebar below header                             ║
    ║     • State persists via localStorage                                         ║
    ║     • Smooth width transitions                                                ║
    ║                                                                               ║
    ║  Key Features:                                                                ║
    ║  • CSS Grid with named areas for semantic layout                              ║
    ║  • Header always visible at top across all breakpoints                        ║
    ║  • Sidebar height: 100vh - header height                                      ║
    ║  • Alpine.js for state management                                             ║
    ║  • $persist for localStorage integration                                      ║
    ║  • Pre-hydration flicker prevention                                           ║
    ╚═══════════════════════════════════════════════════════════════════════════════╝
--}}

@props([
    'collapsible' => true
])

@php
    $classes = [
        // ═══════════════════════════════════════════════════════════════════════
        // CSS CUSTOM PROPERTIES
        // ═══════════════════════════════════════════════════════════════════════
        '[--sidebar-width:16rem]',                      // Default: 256px expanded
        'data-[collapsed]:[--sidebar-width:4rem]',      // Collapsed: 64px (icon only)
        
        '[--header-height:4rem]',                       // Header: 64px height
        // Optional: Change header height when sidebar collapses
        // 'data-[collapsed]:[--header-height:3rem]',

        // ═══════════════════════════════════════════════════════════════════════
        // BASE GRID CONFIGURATION
        // ═══════════════════════════════════════════════════════════════════════
        'grid',                                        
        'h-screen overflow-hidden',                     
        'min-h-screen text-slate-950 dark:text-slate-50', 

        // ═══════════════════════════════════════════════════════════════════════
        // 📱 MOBILE LAYOUT (< 768px)
        // Header at top, overlay sidebar, full-width main content
        // ═══════════════════════════════════════════════════════════════════════
        
        // Grid structure: header row + content row
        'grid-cols-1',                                  // Single column
        'grid-rows-[var(--header-height)_1fr]',        // Header height + remaining space
        "[grid-template-areas:'header'_'main']",       // Header on top, main below
        
        // Header positioning
        '[&_[data-slot=header]]:sticky',               // Sticky header
        '[&_[data-slot=header]]:top-0',                // Stick to top
        '[&_[data-slot=header]]:z-50',                 // Above content
        '[&_[data-slot=header]]:h-[var(--header-height)]', // Use CSS variable height
        
        // Mobile: Sidebar positioning (overlay mode)
        '[&_[data-slot=sidebar]]:fixed',               // Fixed overlay
        '[&_[data-slot=sidebar]]:inset-y-0',           // Full height
        '[&_[data-slot=sidebar]]:left-0',              // Left edge
        '[&_[data-slot=sidebar]]:top-[var(--header-height)]', // Below header
        '[&_[data-slot=sidebar]]:h-[calc(100vh_-_var(--header-height))]', // Height minus header
        '[&_[data-slot=sidebar]]:z-40',                // Below header, above content
        '[&_[data-slot=sidebar]]:w-[var(--sidebar-width)]', // Use CSS variable
        
        // Mobile: Sidebar animation
        '[&_[data-slot=sidebar]]:transition-transform', 
        '[&_[data-slot=sidebar]]:duration-300',         
        '[&_[data-slot=sidebar]]:ease-in-out',          
        '[&_[data-slot=sidebar]]:-translate-x-full',    // Hidden by default
        'data-[sidebar-open]:[&_[data-slot=sidebar]]:translate-x-0', // Visible when open
        
        // ═══════════════════════════════════════════════════════════════════════
        // 📱 TABLET LAYOUT (768px - 1024px)
        // Header at top, collapsed sidebar and main content below
        // ═══════════════════════════════════════════════════════════════════════
        
        // Grid structure: header row spanning full width, sidebar + main below
        'md:grid-cols-[var(--sidebar-width)_1fr]',     // Sidebar + main columns
        'md:grid-rows-[var(--header-height)_1fr]',     // Header row + content row
        "md:[grid-template-areas:'header_header'_'sidebar_main']", // Header spans both columns
        
        // Tablet: Header positioning
        'md:[&_[data-slot=header]]:col-span-2',        // Span both columns
        
        // Tablet: Sidebar positioning (in-flow, not overlay)
        'md:[&_[data-slot=sidebar]]:relative',         // Relative positioning
        'md:[&_[data-slot=sidebar]]:translate-x-0',    // Always visible
        'md:[&_[data-slot=sidebar]]:z-auto',           // Normal stacking
        'md:[&_[data-slot=sidebar]]:h-auto',           // Auto height (fills grid cell)
        'md:[&_[data-slot=sidebar]]:top-0',            // Reset top position
        'md:[&_[data-slot=sidebar]]:inset-y-auto',     // Reset inset
        'md:[&_[data-slot=sidebar]]:overflow-visible', // Show overflow on hover
        
        // ═══════════════════════════════════════════════════════════════════════
        // 🖥️ DESKTOP LAYOUT (>= 1024px)
        // Header at top, expandable/collapsible sidebar below
        // ═══════════════════════════════════════════════════════════════════════
        
        // Desktop: Same structure as tablet
        'lg:grid-cols-[var(--sidebar-width)_1fr]',     // Sidebar + main columns
        'lg:grid-rows-[var(--header-height)_1fr]',     // Header + content rows
        "lg:[grid-template-areas:'header_header'_'sidebar_main']", // Header spans full width
        
        // Desktop: Collapsed state grid adjustment
        'data-[collapsed]:lg:grid-cols-[var(--sidebar-width)_1fr]', // Narrower sidebar when collapsed
        
        // Desktop: Header
        'lg:[&_[data-slot=header]]:col-span-2',        // Span both columns
        
        // Desktop: Sidebar
        'lg:[&_[data-slot=sidebar]]:overflow-visible', // Show content on hover when collapsed
    ];
@endphp

{{--
    ┌─────────────────────────────────────────────────────────────────────────────┐
    │ LAYOUT CONTAINER                                                             │
    │                                                                              │
    │ Alpine.js manages all interactive state and behavior                        │
    └─────────────────────────────────────────────────────────────────────────────┘
--}}
<div 
    {{ $attributes->class($classes) }}
    @if($collapsible)
        {{--
            ═══════════════════════════════════════════════════════════════════════
            ALPINE.JS STATE MANAGEMENT
            ═══════════════════════════════════════════════════════════════════════
            
            State Properties:
            • collapsedSidebar: Persisted in localStorage (_x_collapsedSidebar)
            • sidebarOpen: Mobile-only, controls overlay visibility
            • isMobile: True when viewport < 768px
            • isTablet: True when viewport 768px-1024px
        --}}
        x-data="{
            collapsedSidebar: $persist(false), // Syncs with localStorage automatically
            sidebarOpen: false,                // Mobile overlay state (not persisted)
            isMobile: false,                   // Viewport detection flag
            isTablet: false,                   // Viewport detection flag
            
            {{--
                ───────────────────────────────────────────────────────────────────
                TOGGLE FUNCTION
                
                Behavior changes based on viewport:
                • Mobile: Toggles overlay (sidebarOpen)
                • Tablet/Desktop: Toggles collapse (collapsedSidebar)
                ───────────────────────────────────────────────────────────────────
            --}}
            toggle() {
                if (this.isMobile) {
                    // Mobile: toggle sidebar overlay
                    this.sidebarOpen = !this.sidebarOpen;
                } else {
                    // Desktop: toggle collapse
                    this.collapsedSidebar = !this.collapsedSidebar;
                }
            },
            
            {{--
                ───────────────────────────────────────────────────────────────────
                CLOSE SIDEBAR (Mobile Only)
                
                Used when clicking backdrop or navigation links
                ───────────────────────────────────────────────────────────────────
            --}}
            closeSidebar() {
                if (this.isMobile) {
                    this.sidebarOpen = false;
                }
            },
            
            {{--
                ───────────────────────────────────────────────────────────────────
                UPDATE BREAKPOINTS
                
                Detects current viewport size and updates flags.
                Also closes mobile sidebar when switching to larger screens.
                ───────────────────────────────────────────────────────────────────
            --}}
            updateBreakpoints() {
                this.isMobile = window.matchMedia('(max-width: 767px)').matches;
                this.isTablet = window.matchMedia('(min-width: 768px) and (max-width: 1023px)').matches;
                
                // Close mobile sidebar when switching breakpoints
                if (!this.isMobile) {
                    this.sidebarOpen = false;
                }
            },
            
            {{--
                ───────────────────────────────────────────────────────────────────
                INITIALIZATION
                
                Runs when Alpine mounts this component:
                1. Force collapse on tablet if page loads on tablet
                2. Watch mobile state to prevent collapsed attribute on mobile
                3. Set initial breakpoint flags
                4. Listen for window resize events
                ───────────────────────────────────────────────────────────────────
            --}}
            init() {
                // Tablet: Always start collapsed
                if (this.$root.dataset.inTablet === 'true') {
                    this.collapsedSidebar = true
                }

                // Mobile: Remove collapse state (uses sidebarOpen instead)
                // This prevents CSS conflicts between overlay and collapse states
                this.$watch('isMobile', (val) => {
                    if (val) {
                        this.collapsedSidebar = false
                    } 
                });

                // Set initial state
                this.updateBreakpoints();
                        
                // Listen for breakpoint changes (window resize)
                const mobileQuery = window.matchMedia('(max-width: 767px)');
                const tabletQuery = window.matchMedia('(min-width: 768px) and (max-width: 1023px)');
                
                mobileQuery.addEventListener('change', () => this.updateBreakpoints());
                tabletQuery.addEventListener('change', () => this.updateBreakpoints());
            }
        }"
        
        {{--
            ═══════════════════════════════════════════════════════════════════════
            DATA ATTRIBUTES API
            
            These attributes are bound to Alpine state and used for CSS targeting.
            This creates a clean separation between state (Alpine) and style (CSS).
            
            Usage in CSS:
            [data-collapsed] { ... }              - Target collapsed state
            [data-in-mobile] { ... }              - Target mobile viewport
            [data-in-tablet] { ... }              - Target tablet viewport
            [data-sidebar-open] { ... }           - Target mobile sidebar open
            ═══════════════════════════════════════════════════════════════════════
        --}}
        x-bind:data-in-mobile="isMobile"
        x-bind:data-in-tablet="isTablet" 
        x-bind:data-collapsed="collapsedSidebar"
        x-bind:data-sidebar-open="sidebarOpen"
    @endif
    data-slot="layout"
>
    {{--
        ═══════════════════════════════════════════════════════════════════════════
        LAYOUT CONTENT
        
        Slot accepts header, sidebar and main content components.
        Grid areas are assigned via data-slot attributes:
        • [data-slot="header"] → grid-area: header (spans full width)
        • [data-slot="sidebar"] → grid-area: sidebar
        • [data-slot="main"] → grid-area: main
        
        USAGE EXAMPLE:
        <x-layout variant="header-sidebar">
            <x-header data-slot="header">...</x-header>
            <x-sidebar data-slot="sidebar">...</x-sidebar>
            <x-main data-slot="main">...</x-main>
        </x-layout>
        ═══════════════════════════════════════════════════════════════════════════
    --}}
    {{ $slot }}
    
    {{--
        ═══════════════════════════════════════════════════════════════════════════
        MOBILE BACKDROP OVERLAY
        
        Appears behind the sidebar when open on mobile.
        Clicking it closes the sidebar.
        
        Features:
        • Only visible on mobile (md:hidden)
        • Positioned below header (top-[var(--header-height)])
        • Smooth fade in/out transitions
        • Semi-transparent black overlay
        • Z-index 30 (below sidebar at 40, below header at 50)
        ═══════════════════════════════════════════════════════════════════════════
    --}}
    <div 
        x-show="isMobile && sidebarOpen"
        style="display: none;" 
        x-transition:enter="transition-opacity duration-300"
        x-transition:leave="transition-opacity duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        x-on:click="closeSidebar()"
        class="fixed inset-0 top-[var(--header-height)] bg-black/50 z-30 md:hidden"
    ></div>
</div>