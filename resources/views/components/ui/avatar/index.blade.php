@props([
    'iconVariant' => 'outline',
    'initials' => null,
    'circle' => null,
    'color' => null,
    'badge' => null,
    'name' => null,
    'icon' => null,
    'size' => 'md',
    'src' => null,
    'href' => null,
    'alt' => null,
    'as' => 'div',
    'class' => '',
    'badgeClass' => ''
])

@php
    if ($name && !$initials) {
        $parts = explode(' ', trim($name));

        if ($attributes->has('initials:single')) {
            $initials = strtoupper(mb_substr($parts[0], 0, 1));
        } else {
            $parts = collect($parts)->filter()->values()->all();

            if (count($parts) > 1) {
                $initials = strtoupper(mb_substr($parts[0], 0, 1) . mb_substr($parts[1], 0, 1));
            } elseif (count($parts) === 1) {
                $initials = strtoupper(mb_substr($parts[0], 0, 1)) . strtolower(mb_substr($parts[0], 1, 1));
            }
        }
    }
    $hasTextContent = $icon ?? ($initials ?? $slot->isNotEmpty());

    if (!$hasTextContent) {
        $icon = 'user';
        $hasTextContent = true;
    }

    $colors = [
        'red',
        'orange',
        'amber',
        'yellow',
        'lime',
        'green',
        'emerald',
        'teal',
        'cyan',
        'sky',
        'blue',
        'indigo',
        'violet',
        'purple',
        'fuchsia',
        'pink',
        'rose',
    ];

    if ($hasTextContent && $color === 'auto') {
        $colorSeed = $attributes->get('color:seed') ?? ($name ?? ($icon ?? ($initials ?? $slot)));
        $hash = crc32((string) $colorSeed);
        $color = $colors[$hash % count($colors)];
    }

    $avatarRadius = $circle
        ? '[--avatar-radius:calc(infinity*1px)]'
        : match ($size) {
            'xl' => '[--avatar-radius:var(--radius-xl)]',
            'lg' => '[--avatar-radius:var(--radius-lg)]',
            default => '[--avatar-radius:var(--radius-lg)]',
            'sm' => '[--avatar-radius:var(--radius-md)]',
            'xs' => '[--avatar-radius:var(--radius-sm)]',
        };
    $avatarSize = match ($size) {
        'xl' => '[:where(&)]:size-16 [:where(&)]:text-base',
        'lg' => '[:where(&)]:size-12 [:where(&)]:text-base',
        default => '[:where(&)]:size-10 [:where(&)]:text-sm',
        'sm' => '[:where(&)]:size-8 [:where(&)]:text-sm',
        'xs' => '[:where(&)]:size-6 [:where(&)]:text-xs',
    };

    $avatarColor = match ($color) {
        'red' => 'bg-red-400 text-red-800',
        'orange' => 'bg-orange-200 text-orange-800',
        'amber' => 'bg-amber-200 text-amber-800',
        'yellow' => 'bg-yellow-200 text-yellow-800',
        'lime' => 'bg-lime-200 text-lime-800',
        'green' => 'bg-green-200 text-green-800',
        'emerald' => 'bg-emerald-200 text-emerald-800',
        'teal' => 'bg-teal-200 text-teal-800',
        'cyan' => 'bg-cyan-200 text-cyan-800',
        'sky' => 'bg-sky-200 text-sky-800',
        'blue' => 'bg-blue-200 text-blue-800',
        'indigo' => 'bg-indigo-200 text-indigo-800',
        'violet' => 'bg-violet-200 text-violet-800',
        'purple' => 'bg-purple-200 text-purple-800',
        'fuchsia' => 'bg-fuchsia-200 text-fuchsia-800',
        'pink' => 'bg-pink-200 text-pink-800',
        'rose' => 'bg-rose-200 text-rose-800',
        default => 'bg-neutral-200 dark:bg-neutral-700 [&>[data-slot=icon]]:text-white!',
    };

    $classes = [
        'flex items-center justify-center rounded-(--avatar-radius) overflow-hidden',
        $avatarRadius,
        $avatarSize,
        $avatarColor,
        $class
    ];

    $iconClasses = [
        'text-black!',
        match ($size) {
            'lg' => 'size-8',
            default => 'size-6',
            'sm' => 'size-5',
            'xs' => 'size-4',
        },
    ];

    $badgeColor = $attributes->get('badge:color') ?: (is_object($badge) ? $badge?->attributes?->get('color') : null);
    $badgeCircle = $attributes->get('badge:circle') ?: (is_object($badge) ? $badge?->attributes?->get('circle') : null);
    $badgePosition =
        $attributes->get('badge:position') ?: (is_object($badge) ? $badge?->attributes?->get('position') : null);
    $badgeVariant =
        $attributes->get('badge:variant') ?: (is_object($badge) ? $badge?->attributes?->get('variant') : null);

    $badgeSize = match ($size) {
        default => 'h-3 min-w-3',
        'sm' => 'h-2 min-w-2',
        'xs' => 'h-2 min-w-2',
    };
    $badgeColor = match ($badgeColor) {
        'red' => 'bg-red-500 dark:bg-red-400',
        'orange' => 'bg-orange-500 dark:bg-orange-400',
        'amber' => 'bg-amber-500 dark:bg-amber-400',
        'yellow' => 'bg-yellow-500 dark:bg-yellow-400',
        'lime' => 'bg-lime-500 dark:bg-lime-400',
        'green' => 'bg-green-500 dark:bg-green-400',
        'emerald' => 'bg-emerald-500 dark:bg-emerald-400',
        'teal' => 'bg-teal-500 dark:bg-teal-400',
        'cyan' => 'bg-cyan-500 dark:bg-cyan-400',
        'sky' => 'bg-sky-500 dark:bg-sky-400',
        'blue' => 'bg-blue-500 dark:bg-blue-400',
        'indigo' => 'bg-indigo-500 dark:bg-indigo-400',
        'violet' => 'bg-violet-500 dark:bg-violet-400',
        'purple' => 'bg-purple-500 dark:bg-purple-400',
        'fuchsia' => 'bg-fuchsia-500 dark:bg-fuchsia-400',
        'pink' => 'bg-pink-500 dark:bg-pink-400',
        'rose' => 'bg-rose-500 dark:bg-rose-400',
        'zinc' => 'bg-zinc-400 dark:bg-zinc-300',
        'gray' => 'bg-neutral-400 dark:bg-neutral-300',
        default => 'bg-white dark:bg-neutral-900',
    };
    $badgePosition = match ($badgePosition) {
        'top left' => 'top-0 left-0',
        'top right' => 'top-0 right-0',
        'bottom left' => 'bottom-0 left-0',
        'bottom right' => 'bottom-0 right-0',
        default => 'bottom-0 right-0',
    };
    $badgeClasses = [
        'absolute ring-[2px] ring-white dark:ring-neutral-900 z-10',
        'flex items-center justify-center tabular-nums overflow-hidden',
        'text-[.625rem] text-black dark:text-white font-medium',
        'after:absolute after:inset-[3px] after:bg-white dark:after:bg-neutral-900' => $badgeVariant === 'outline',
        'rounded-full after:rounded-full' => $badgeCircle,
        'rounded-[3px] after:rounded-[1px]' => !$badgeCircle,
        $badgeSize,
        $badgePosition,
        $badgeColor,
        $badgeClass
    ];

@endphp



<div class="relative w-fit" data-slot="avatar" data-size="{{ $avatarSize }}">
    <x-ui.button.abstract :href="$href" :as="$as" {{ $attributes->class(Arr::toCssClasses($classes)) }}>
        @if ($src)
            <img src="{{ $src }}" alt="{{ $alt || $name }}">
        @elseif ($icon)
            <x-ui.icon name="{{ $icon }}" variant="{{ $iconVariant }}"
                class="{{ Arr::toCssClasses($iconClasses) }}" />
        @elseif ($hasTextContent)
            <span class="select-none">{{ $initials ?? $slot }}</span>
        @endif

        @if ($badge instanceof \Illuminate\View\ComponentSlot)
            <div {{ $badge->attributes->class(Arr::toCssClasses($badgeClasses)) }} aria-hidden="true">{{ $badge }}
            </div>
        @elseif ($badge)
            <div class="{{ Arr::toCssClasses($badgeClasses) }}" aria-hidden="true">{{ is_string($badge) ? $badge : '' }}
            </div>
        @endif
    </x-ui.button.abstract>
</div>
