<!DOCTYPE html>
<html class="h-full"
      lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport"
              content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token"
              content="{{ csrf_token() }}">
        <title> Sheaf UI {{ isset($title) ? '| ' . $title : '' }}</title>
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.png') }}">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            /* gives the progress bar primary color */
            :root {
                --livewire-progress-bar-color: var(--color-primary);
            }
        </style>

</head>
    <script>
        // this is script is essentiel to prevent page's flicker at render time
        const loadDarkMode = () => {
            const theme = localStorage.getItem('theme') ?? 'system'

            if (
                theme === 'dark' ||
                (theme === 'system' &&
                    window.matchMedia('(prefers-color-scheme: dark)')
                    .matches)
            ) {
                document.documentElement.classList.add('dark')
            }
        }
        loadDarkMode();
        document.addEventListener('livewire:navigated', function() {
            loadDarkMode();
        });
    </script>
    
    <body class="bg-neutral-100 dark:bg-neutral-900 text-neutral-900 dark:text-neutral-50">

        {{ $slot }}

        @livewireScriptConfig
        {{-- without this it cause flicker when multiple components changes in isolation in the  page --}}
        <script>
            loadDarkMode()
        </script>
        <x-ui.toast :maxToasts="1" />
    </body>

</html>
