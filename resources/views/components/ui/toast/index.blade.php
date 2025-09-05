@props([
    'position' => 'bottom-right',
    'maxToasts' => 5,
    'progressBarVariant' => 'full',
    'progressBarAlignment' => 'bottom'
])

@php
    $placement = match($position) {
        'bottom-right' => 'bottom-0 right-0 pr-4 pb-4',
        'bottom-left' => 'bottom-0 left-0 pl-4 pb-4',
        'top-right' => 'top-0 right-0 pr-4 pt-4',
        'top-left' => 'top-0 left-0 pl-4 pt-4',
        default => 'bottom-0 right-0 pr-4 pb-4'
    };
    
    $sessionToast = session()->pull('notify');

    $isAlignmentsToBottom = Str::startsWith($position, 'bottom');
@endphp

<div
    x-data="{
        toasts: [],
        maxToasts: @js($maxToasts),
        pausedToastIds: new Set(),

       typeConfig: {
            info: {
                textColor: 'text-gray-600 dark:text-gray-400', // we're using color-mix for making variants color solid and not transparent
                background: 'dark:bg-[color-mix(in_oklab,_var(--color-gray-600)_10%,_var(--color-neutral-900)_90%)] bg-[color-mix(in_oklab,_var(--color-gray-500)_20%,_var(--color-white)_80%)]',
                borderColor: 'border-gray-500/55',
                ariaLabel: 'Information',
            },
            success: {
                textColor: 'text-green-600 dark:text-green-400',
                background: 'dark:bg-[color-mix(in_oklab,_var(--color-green-600)_10%,_var(--color-neutral-900)_90%)] bg-[color-mix(in_oklab,_var(--color-green-500)_20%,_var(--color-white)_80%)]',
                borderColor: 'border-green-500/55',
                ariaLabel: 'Success',
            },
            error: {
                textColor: 'text-red-600 dark:text-red-400',
                background: 'dark:bg-[color-mix(in_oklab,_var(--color-red-600)_10%,_var(--color-neutral-900)_90%)] bg-[color-mix(in_oklab,_var(--color-red-500)_25%,_var(--color-white)_75%)]',
                borderColor: 'border-red-500/55',
                ariaLabel: 'Error',
            },
            warning: {
                textColor: 'text-yellow-600 dark:text-yellow-400',
                background: 'dark:bg-[color-mix(in_oklab,_var(--color-yellow-600)_10%,_var(--color-neutral-900)_90%)] bg-[color-mix(in_oklab,_var(--color-yellow-500)_25%,_var(--color-white)_75%)]',
                borderColor: 'border-yellow-500/55',
                ariaLabel: 'Warning',
            },
        },

        init() {
            // used for toasts used after redirect..., any backend toast. 
            if(@js(filled($sessionToast))){
                const toast = @js($sessionToast);
                this.addToast(toast);
            }
        },

        addToast(details) {
            if (!details?.content) return;

            const toast = {
                id: Date.now() + Math.random(),
                type: details.type || 'info',
                content: details.content,
                duration: details.duration || 4000,
                showProgress: details.showProgress !== false
            };

            this.toasts.unshift(toast); 

            // Limit number of toasts
            if (this.toasts.length > this.maxToasts) {
                this.toasts = this.toasts.slice(0, this.maxToasts);
            }
        },

        removeToast(id) {
            this.toasts = this.toasts.filter(toast => toast.id !== id);
            this.pausedToastIds.delete(id);
        },

        pauseFromToast(targetId) {
            const targetIndex = this.toasts.findIndex(toast => toast.id === targetId);
            
            if (targetIndex === -1) return;
            
            // Pause the target toast and all toasts above it (index 0 to targetIndex)
            this.pausedToastIds.clear();

            for (let i = 0; i <= targetIndex; i++) {
                this.pausedToastIds.add(this.toasts[i].id);
            }
        },

        resumeAllToasts() {
            this.pausedToastIds.clear();
        },

        isToastPaused(id) {
            return this.pausedToastIds.has(id);
        },

        getToastClasses(type) {
            const config = this.typeConfig[type] || this.typeConfig.info;
            return `${config.background} ${config.borderColor}`;
        },

        getIconColor(type) {
            const config = this.typeConfig[type] || this.typeConfig.info;
            return config.textColor;
        },

        getAriaLabel(type) {
            const config = this.typeConfig[type] || this.typeConfig.info;
            return config.ariaLabel;
        }
    }"
    x-on:notify.window="addToast($event.detail)"
    @class([
        'fixed flex w-full max-w-xs gap-4 sm:justify-start z-50',
        'flex-col-reverse' => $isAlignmentsToBottom,
        'flex-col' => !$isAlignmentsToBottom,
        $placement
    ])
    role="status"
    aria-live="polite"
>
    <template x-for="toast in toasts" :key="toast.id">
        <x-ui.toast.item />
    </template>
</div>