<x-slot:title>
    {{ $title ?? 'Sheaf UI' }}
</x-slot:title>

<x-layouts.base>

    <x-layouts.partials.header />
    
    {{ $slot }}

    <x-layouts.partials.footer />
</x-layouts.base>
