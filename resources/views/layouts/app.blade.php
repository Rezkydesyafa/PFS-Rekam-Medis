<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />

        <style>
            .material-symbols-outlined {
                font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            }
            .fill-1 {
                font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            }
        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-slate-50 overflow-hidden" x-data="{ sidebarExpanded: true }">
        <div class="flex h-screen w-full">
            <!-- Sidebar -->
            <x-sidebar />

            <!-- Main Content -->
            <main class="flex-1 flex flex-col h-full overflow-hidden transition-all duration-300 ease-in-out"
                  :class="sidebarExpanded ? 'lg:ml-72' : 'lg:ml-[5.5rem]'">
                <!-- Top Header for Mobile (Optional) -->
                
                <div class="flex-1 overflow-y-auto p-4 md:p-8">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </body>
</html>
