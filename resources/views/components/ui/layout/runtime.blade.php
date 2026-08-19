{{--
    This runtime logic solves the **Alpine.js flicker problem** that happens before state hydration.
    It ensures layout attributes like `data-collapsed` and viewport flags are set **before Alpine initializes**,
    so the UI renders in the correct state instantly without visual jumps or misaligned transitions.
--}}

<script>
    (function () {
        try {
            const layout = document.querySelector('[data-slot="layout"]')
            if (!layout) return
            
        //  BLADE DIRECTIVE
        @if($collapsable) 
            // Restore collapsed state from localStorage
            if (localStorage.getItem('_x_collapsedSidebar') === 'true') {
                layout.setAttribute('data-collapsed', 'true')
            }
        @endif
        // END BLADE DIRECTIVE

        // Breakpoints
        const mqMobile = window.matchMedia('(max-width: 767px)')
        const mqTablet = window.matchMedia('(min-width: 768px) and (max-width: 1023px)')

        if (mqMobile.matches) layout.setAttribute('data-in-mobile', 'true')
        if (mqTablet.matches) layout.setAttribute('data-in-tablet', 'true')
    } catch (e) {
        console.warn('Init layout failed:', e)
    }
})()
</script>
