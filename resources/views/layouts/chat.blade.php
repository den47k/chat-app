<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ isSidebarOpen: false, screenWidth: window.innerWidth }"
    @resize.window="screenWidth = window.innerWidth; if(screenWidth >= 768) { isSidebarOpen = false; }">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="text-white overflow-hidden">

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        @yield('side-content')

        <!-- Main Content -->
        <div class="flex-1 bg-gray-100 dark:bg-gray-900 p-4 flex-col">
            @yield('main-content')
        </div>
    </div>

    @stack('modals')

    @livewireScripts
</body>

</html>
