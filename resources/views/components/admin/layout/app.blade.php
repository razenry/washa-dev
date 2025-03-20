<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? 'Washa Admin' }}</title>

    {{-- Icon --}}
    <link rel="icon" href="{{ asset('logo.png') }}" type="image/x-icon" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <script>
        // On page load or when changing themes, best to add inline in `head` to avoid FOUC
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>



    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    @livewireStyles

</head>

<body class="bg-gray-50 dark:bg-gray-900">

    {{-- {{ define "main" }} --}}
    {{-- {{ partial "navbar-dashboard" . }} --}}
    <x-admin.layout.navbar />
    <div class="flex pt-16 overflow-hidden bg-gray-50 dark:bg-gray-900">

        {{-- {{ partial "sidebar" . }} --}}
        <x-admin.layout.sidebar transactionCount="{{ $transactionCount ?? '' }}" />

        <div id="main-content" class="relative w-full h-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900">
            <main class="p-4 my-6 mx-4">
                {{-- {{ .Content }} --}}
                {{ $slot }}
            </main>
            {{-- {{ if .Params.footer }} {{ partial "footer-dashboard" . }} {{ end }} --}}
            <x-admin.layout.footer />
        </div>

    </div>

    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>   
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            Livewire.on('Alert', (message) => {
                console.log("SweetAlert Data:", message);
                alert = message[0];
                Swal.fire(alert);
            });
        });
    </script>
</body>

</html>
