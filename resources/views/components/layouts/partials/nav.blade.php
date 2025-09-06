<header 
    x-data="{ open: false }"
    x-on:keydown.window.escape="open = false"
    class="border-b-neutral-100 dark:border-b-neutral-800 dark:bg-neutral-900 bg-neutral-50 fixed inset-x-0 top-0 z-50 border-b"
>
    <nav 
        class="mx-auto flex items-center justify-between p-6 text-base-100 lg:px-8"
        aria-label="global"
    >
        <div class="flex pr-7">
                <x-app.logo />
        </div>

        <!-- mobile toggle -->
        <div 
            class="flex lg:hidden gap-4 items-center"
        >
            <button type="button"
                    class="bg-base-200/6 text-base-100 ring-base-200/10 hover:bg-base-200/10 inline-flex h-8 w-8 items-center justify-center rounded-field text-sm font-medium ring-1 ring-inset"
                    x-on:click="open = true"
                >
                <span class="sr-only">Open main menu</span>
                <svg class="h-6 w-6"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke-width="1.5"
                     stroke="currentColor">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M3.75 6.75h16.5M3.75 12h16.5M12 17.25h8.25" />
                </svg>
            </button>
        </div>

        <!-- Auth Links or Profile -->
        <div class="hidden gap-4 lg:flex lg:items-center lg:justify-end">
            @guest
                <div class="space-x-4">
                    <a href="{{ route('login') }}"
                       class="text-sm font-semibold leading-6 text-gray-900 dark:text-gray-200">Login</a>
                    <a href="{{ route('register') }}"
                       class="rounded-md border border-gray-300/40 bg-gray-50 px-3 py-1 text-sm font-semibold text-gray-900 dark:border-white/20 dark:bg-white/5 dark:text-white">Register</a>
                </div>
            @endguest
            
            <div 
                class="inline-flex h-8 w-8 items-center justify-center rounded-field text-sm font-medium "
            >
                <a href="https://github.com/sheafui/components" target="_blank">
                    <svg 
                        class="size-6 dark:fill-white fill-neutral-900"
                        viewBox="0 0 24 24" 
                        aria-hidden="true" 
                    ><path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.463 2 11.97c0 4.404 2.865 8.14 6.839 9.458.5.092.682-.216.682-.48 0-.236-.008-.864-.013-1.695-2.782.602-3.369-1.337-3.369-1.337-.454-1.151-1.11-1.458-1.11-1.458-.908-.618.069-.606.069-.606 1.003.07 1.531 1.027 1.531 1.027.892 1.524 2.341 1.084 2.91.828.092-.643.35-1.083.636-1.332-2.22-.251-4.555-1.107-4.555-4.927 0-1.088.39-1.979 1.029-2.675-.103-.252-.446-1.266.098-2.638 0 0 .84-.268 2.75 1.022A9.607 9.607 0 0 1 12 6.82c.85.004 1.705.114 2.504.336 1.909-1.29 2.747-1.022 2.747-1.022.546 1.372.202 2.386.1 2.638.64.696 1.028 1.587 1.028 2.675 0 3.83-2.339 4.673-4.566 4.92.359.307.678.915.678 1.846 0 1.332-.012 2.407-.012 2.734 0 .267.18.577.688.48 3.97-1.32 6.833-5.054 6.833-9.458C22 6.463 17.522 2 12 2Z"></path></svg>
                </a>
            </div>

            <x-ui.separator class="my-2" vertical/>

            <x-ui.theme-switcher variant="inline"/>

        </div>
    </nav>

    <!-- Mobile Menu -->
    <div x-show="open"
         class="lg:hidden"
         x-ref="dialog"
         x-cloak=""
         aria-modal="true">
        <div class="fixed inset-0 z-50 bg-background"></div>
        <div class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-background px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-base-200/10"
             x-on:click.away="open = false">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <x-app.logo />
                </div>

                <div class="flex items-center">
                <button type="button"
                        class="-m-2.5 rounded-md p-2.5 text-base-100"
                        x-on:click="open = false">
                    <span class="sr-only">Close menu</span>
                    <svg class="h-6 w-6"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke-width="1.5"
                         stroke="currentColor">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                </div>
            </div>
            <div class="mt-6 flow-root">
                <div class="-my-6 divide-y divide-base-200/10">
                    <div class="py-6">
                        @guest
                            <a href="{{ route('login') }}"
                               class="-mx-3 block rounded-field px-3 py-2.5 text-base font-semibold leading-7 text hover:bg-base-200/10 bg-base-100/6">Login</a>
                            <a href="{{ route('register') }}"
                               class="mt-2 block rounded-md border ring-1 ring-base-200/10 bg-base-200/20 px-3 py-2.5 text-base font-semibold text-base-100">Register</a>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
