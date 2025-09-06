<div class="flex items-center gap-2">
    <a data-slot="button"
       class="dark:hover:bg-white/6 text-primary-brand bg-base-200/6 relative inline-flex h-[32px] w-[32px] items-center justify-center gap-2 whitespace-nowrap rounded-[3px] text-sm font-medium hover:bg-neutral-200"
       href="/">
        <svg xmlns="http://www.w3.org/2000/svg"
             viewBox="0 0 100 100"
             class="size-5">
            <rect x="15"
                  y="10"
                  width="80"
                  height="15"
                  fill="currentColor"
                  rx="5"
                  ry="0" />

            <rect x="15"
                  y="30"
                  width="60"
                  height="15"
                  fill="currentColor" />

            <rect x="15"
                  y="50"
                  width="30"
                  height="15"
                  fill="currentColor" />
            <rect x="15"
                  y="55"
                  width="10"
                  height="30"
                  fill="currentColor" />
        </svg>
    </a>
    <a class="inline-flex items-center"
       href="{{ route('home') }}"
       wire:navigate>
        <h1 class='text-primary-brand text-lg font-bold leading-8'>Sheaf UI</h1>
    </a>
</div>
