<x-layouts.base>
    <x-slot:title>
        {{ $title ?? 'Sheaf UI' }}
    </x-slot:title>

     <x-layouts.partials.nav />


    {{-- Content --}}
    {{ $slot }}

    <x-layouts.partials.footer />
</x-layouts.base>
