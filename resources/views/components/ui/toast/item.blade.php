@aware([
    'progressBarAlignment' => 'bottom',
    'progressBarVariant' => 'full',
])
<div 
    x-data="{
        visible: false,
        progress: 100,
        startTime: null,
        animationId: null,
        totalPausedTime: 0,
        pauseStartTime: null,

        init() {
            // Show toast with slight delay for smooth animation
            this.$nextTick(() => {
                this.visible = true;
                this.startTimer();
            });
        },

        startTimer() {
            if (!toast.duration || toast.duration <= 0) return;
            
            this.startTime = performance.now();
            this.updateProgress();
        },

        updateProgress() {
            // OK OK I know this is not simple, let me explain to you 

            // This method updates the progress bar also the dismiss logic  for this **specific** toast.
            // It starts counting down as soon as the toast appears on screen.

            const now = performance.now();  // Get the current high-resolution timestamp.
            const shouldPauseNow = this.$data.isToastPaused(toast.id); // Check if this toast is currently paused (e.g., hovered).

            // Detect when pause starts: if toast just entered paused state, record the time pause started.
            if (shouldPauseNow && !this.pauseStartTime) {
                this.pauseStartTime = now;
            }
            // Detect when pause ends: if toast just resumed, add paused duration to totalPausedTime.
            else if (!shouldPauseNow && this.pauseStartTime) {
                this.totalPausedTime += now - this.pauseStartTime;
                this.pauseStartTime = null;
            }

            // Calculate elapsed time since start, excluding any paused time.
            let elapsed = now - this.startTime - this.totalPausedTime;

            // If toast is paused, do not update progress, but keep requesting new frames . @todo: find better logic for this case.
            if (shouldPauseNow) {
                this.animationId = requestAnimationFrame(() => this.updateProgress());
                return; 
            }

            // Calculate progress percentage (from 100% down to 0%), clamp minimum to 0.
            this.progress = Math.max(0, 100 - (elapsed / toast.duration) * 100);

            // If the toast has been visible longer than its duration, dismiss it.
            if (elapsed >= toast.duration) {
                this.dismiss();
                return; // Stop updating since the toast is being removed.
            }

            // Request next animation frame to keep the progress bar updating smoothly.
            this.animationId = requestAnimationFrame(() => this.updateProgress());
        },


        onMouseEnter() {
            $data.pauseFromToast(toast.id);
        },

        onMouseLeave() {
            $data.resumeAllToasts();
        },

        dismiss() {
            this.visible = false;

            if (this.animationId) {
                cancelAnimationFrame(this.animationId);
            }
            // Wait for exit animation before removing
            setTimeout(() => {
                $data.removeToast(toast.id);
            }, 200);
        },

        destroy() {
            if (this.animationId) {
                cancelAnimationFrame(this.animationId);
            }
        }
    }"
    x-show="visible"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform translate-y-2 scale-95"
    x-transition:enter-end="opacity-100 transform translate-y-0 scale-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 transform translate-y-0 scale-100"
    x-transition:leave-end="opacity-0 transform translate-y-2 scale-95"
    x-bind:class="[
        'pointer-events-auto relative w-full max-w-sm rounded-xl border py-2 pl-4 pr-2 shadow-lg  dark:border-white/15 border-gray-200 overflow-hidden',
        '[--alpha(var(--color-green-500) / 50%)]',
        getToastClasses(toast.type)
    ]"
    x-on:mouseenter="onMouseEnter()"
    x-on:mouseleave="onMouseLeave()"
>
    <div class="flex items-center">
        <!-- Icon -->
        <div class="shrink-0" x-bind:class="getIconColor(toast.type)">
            <div aria-hidden="true" class="flex items-center justify-center">
                <template x-if="toast.type === 'info'">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                    </svg>
                </template>
                <template x-if="toast.type === 'success'">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </template>
                <template x-if="toast.type === 'error'">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </template>
                <template x-if="toast.type === 'warning'">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                    </svg>
                </template>
            </div>
            <span class="sr-only" x-text="getAriaLabel(toast.type)"></span>
        </div>

        <!-- Content -->
        <div class="ml-3 flex-1 w-0">
            <p x-text="toast.content" class="text-sm font-medium leading-5 text-gray-900 dark:text-white break-words"></p>
        </div>

        <!-- Close Button -->
        <div 
            class="ml-4 flex "
            x-on:click="dismiss()"
        >
            <button 
                type="button" 
                class="hover:bg-white/5 z-10 p-2 focus:ring-0 rounded-full cursor-pointer text-gray-400 transition-colors focus:outline-none"
                x-bind:aria-label="`Close ${getAriaLabel(toast.type).toLowerCase()} notification`"
            >
                <svg aria-hidden="true" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Progress Bar -->
    <template x-if="toast.showProgress !== false && toast.duration > 0">
        <div 
            @class([
                'bottom-0' => $progressBarAlignment === 'bottom',
                'top-0' => $progressBarAlignment === 'top',
                'absolute left-0 right-0 overflow-hidden h-full'
            ])
        >
            <div 
                @class([
                    $progressBarVariant === 'full' ? 'h-full bg-current/10' : 'h-1 bg-current',
                    'transition-all duration-100 ease-linear'
                ])
                x-bind:class="[
                    getIconColor(toast.type),
                    $data.isToastPaused(toast.id) ? 'opacity-30' : 'opacity-50',
                ]"
                x-bind:style="`width: ${progress}%`"
            ></div>
        </div>
    </template>
</div>