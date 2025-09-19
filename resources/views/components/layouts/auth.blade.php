<x-layouts.base>
    <div class="relative z-10 mx-auto flex h-screen flex-col">

            <!-- Top Border Pattern -->
            <div class="grid grid-cols-5">
                <div class="dark:border-neutral-800 border-neutral-400 border !border-l-0 !border-r-0 !border-t-0 border-dashed py-6"
                     style="mask: linear-gradient(to right, transparent 0%, black 80%, black 100%); -webkit-mask: linear-gradient(to right, transparent 0%, black 80%, black 100%);">
                </div>
                <div class="dark:border-neutral-800 border-neutral-400 bg-background z-40 col-span-3 border !border-t-0 border-dashed py-10">
                </div>
                <div class="dark:border-neutral-800 border-neutral-400 border !border-l-0 !border-r-0 !border-t-0 border-dashed py-6"
                     style="mask: linear-gradient(to left, transparent 0%, black 80%, black 100%); -webkit-mask: linear-gradient(to left, transparent 0%, black 80%, black 100%);">
                </div>
            </div>

            <!-- Main Section -->
            <div class="grid grid-cols-5">
                <div class="dark:border-neutral-800 border-neutral-400 hidden border !border-l-0 !border-r-0 border-t-0 border-dashed py-6 lg:flex"
                     style="mask: linear-gradient(to right, transparent 0%, black 80%, black 100%); -webkit-mask: linear-gradient(to right, transparent 0%, black 80%, black 100%);">
                </div>
                <!-- Form section -->
                <div
                     class="dark:border-neutral-800 border-neutral-400 before:dark:border-neutral-800 relative col-span-5 border border-t-0 border-dashed before:absolute before:-left-16 before:-top-16 before:h-32 before:w-32 before:animate-pulse before:rounded-full before:border before:border-dashed before:content-[''] lg:col-span-3 dark:before:border-white/20">
                    <div class="mx-auto flex max-w-sm flex-col items-center justify-center py-4 md:min-h-[60vh]">
                        <div class="py-6">
                            <x-app.logo />
                        </div>
                        {{ $slot }}
                    </div>
                </div>

                <div class="dark:border-neutral-800 border-neutral-400 hidden border !border-l-0 !border-r-0 border-t-0 border-dashed py-6 lg:flex"
                     style="mask: linear-gradient(to left, transparent 0%, black 80%, black 100%); -webkit-mask: linear-gradient(to left, transparent 0%, black 80%, black 100%);">
                </div>
            </div>

            <!-- Empty bottom -->
            <div class="grid grow grid-cols-5">
                <div class="dark:border-neutral-800 border-neutral-400 hidden border !border-b-0 !border-l-0 !border-r-0 border-t-0 border-dashed py-6 lg:flex"
                     style="mask: linear-gradient(to right, transparent 0%, black 80%, black 100%); -webkit-mask: linear-gradient(to right, transparent 0%, black 80%, black 100%);">
                </div>
                <div
                     class="dark:border-neutral-800 border-neutral-400 before:dark:border-neutral-800 relative col-span-5 border !border-b-0 border-t-0 border-dashed py-10 before:absolute before:-right-10 before:-top-10 before:z-40 before:h-20 before:w-20 before:rotate-45 before:border before:border-dashed before:bg-background before:content-[''] lg:col-span-3 dark:before:border-white/20">

                    <!-- SVG -->
                    {{-- <svg class="pointer-events-none absolute -right-10 -top-10 z-50 h-20 w-20 rotate-45"
                         viewBox="0 0 80 80">
                        <defs>
                            <radialGradient id="particle-glow"
                                            cx="50%"
                                            cy="50%"
                                            r="4">
                                <stop offset="0%"
                                      style="stop-color:#3b82f6;stop-opacity:1" />
                                <stop offset="100%"
                                      style="stop-color:#60a5fa;stop-opacity:0.8" />
                                <stop offset="100%"
                                      style="stop-color:#93c5fd;stop-opacity:0" />
                            </radialGradient>
                            <path id="diamond-path"
                                  d="M 80,80 L 80,0 L 0,0 L 0,80 Z"
                                  fill="none"
                                  stroke="none" />
                        </defs>
                        <g>
                            <line x1="-30"
                                  y1="2"
                                  x2="20"
                                  y2="0"
                                  stroke="var(--color-primary-brand)"
                                  stroke-width="3"
                                  opacity="1"
                                  stroke-linecap="round">
                                <animateMotion dur="3.8s"
                                               repeatCount="indefinite"
                                               rotate="auto">
                                    <mpath href="#diamond-path" />
                                </animateMotion>
                            </line>

                            <line x1="-6"
                                  y1="3"
                                  x2="6"
                                  y2="1"
                                  stroke="var(--color-primary-brand)"
                                  stroke-width="2"
                                  opacity="0.7"
                                  stroke-linecap="round">
                                <animateMotion dur="3.8s"
                                               repeatCount="indefinite"
                                               rotate="auto"
                                               begin="-0.2s">
                                    <mpath href="#diamond-path" />
                                </animateMotion>
                            </line>
                        </g>
                    </svg> --}}
                </div>
                <div class="dark:border-neutral-800 border-neutral-400 hidden border !border-b-0 !border-l-0 !border-r-0 border-t-0 border-dashed py-6 lg:flex"
                     style="mask: linear-gradient(to left, transparent 0%, black 80%, black 100%); -webkit-mask: linear-gradient(to left, transparent 0%, black 80%, black 100%);">
                </div>
            </div>
    </div>
</x-layouts.base>
