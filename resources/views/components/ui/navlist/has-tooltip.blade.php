@props(['tooltip' => null, 'condition' => false])

@if ($condition)
{{-- 
    Sidebar tooltips inside scrollable containers (overflow-auto) create a new stacking context.
    This means a normal absolute/fixed tooltip would be clipped or mispositioned. 
    To fix this, we dynamically append the tooltip to <body> so it always floats on top and is not bound by the sidebar's box.
--}}

<div 
    x-data="{
        tooltipEl: null,

        showTooltip() {
            if (this.tooltipEl) return; // Prevent duplicates
            
            if(!this.$data.collapsedSidebar) return; // show tooltips only when it collapsed, if expanded return
            
            const rect = this.$el.getBoundingClientRect()
            
            this.tooltipEl = document.createElement('div')
            this.tooltipEl.className = 
                'fixed z-[99999] px-2 py-2 mx-1 text-sm rounded-md shadow-md bg-neutral-200 dark:bg-neutral-700 dark:text-white text-black whitespace-nowrap pointer-events-none opacity-0 transition-opacity duration-150'
            this.tooltipEl.textContent = @js($tooltip)
            // show it only when collapsed

            // Simple positioning with bounds check
            let left = rect.right + 8
            let top = rect.top + rect.height / 2
            
            document.body.appendChild(this.tooltipEl)
            
            // Check if it goes off-screen
            const tooltipRect = this.tooltipEl.getBoundingClientRect()
            if (left + tooltipRect.width > window.innerWidth) {
                left = rect.left - tooltipRect.width - 8 // Show on left instead
            }
            
            this.tooltipEl.style.left = `${left}px`
            this.tooltipEl.style.top = `${top}px`
            this.tooltipEl.style.transform = 'translateY(-50%)'
            
            requestAnimationFrame(() => {
                if (this.tooltipEl) this.tooltipEl.style.opacity = '1'
            })
        },
        
        hideTooltip() {
            if (!this.tooltipEl) return
            
            this.tooltipEl.style.opacity = '0'
            
            // Wait for transition to complete
            setTimeout(() => {
                this.tooltipEl?.remove()
                this.tooltipEl = null
            }, 150)
        }
    }"
    x-on:mouseenter="showTooltip()"
    x-on:mouseleave="hideTooltip()"
    x-on:destroy="hideTooltip()" {{-- Cleanup on unmount --}}
    class="inline-flex"
>
    {{ $slot }}
</div>
@else
    {{ $slot }}
@endif