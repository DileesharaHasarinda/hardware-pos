<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Hardware POS' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-slate-100 text-slate-800 antialiased">
    <div
        x-data="{ sidebarOpen: false }"
        class="min-h-screen"
    >
        <div
            x-show="sidebarOpen"
            x-transition.opacity
            class="fixed inset-0 z-40 bg-slate-900/50 lg:hidden"
            @click="sidebarOpen = false"
            x-cloak
        ></div>

        @include('layouts.partials.admin-sidebar')

        <div class="lg:pl-72 min-h-screen">
            @include('layouts.partials.admin-topbar')

            <main class="px-4 py-6 sm:px-6 lg:px-8">
                {{ $slot }}
            </main>
        </div>
    </div>

    @livewireScripts
</body>
</html>