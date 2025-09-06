<x-slot:title>
    {{ $title ?? 'Sheaf UI' }}
</x-slot:title>

<x-layouts.base>
    {{-- <x-layouts.partials.nav /> --}}
    <div class="max-w-3xl mx-auto">
        {{ $slot }}
    </div>
</x-layouts.base>
