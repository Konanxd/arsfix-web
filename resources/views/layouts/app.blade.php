<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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
    </head>
    <body class="font-sans antialiased">
        {{-- Gunakan Alpine.js untuk state management sidebar --}}
        <div x-data="{ sidebarOpen: false }" class="relative min-h-screen bg-gray-50 md:flex">

            <div class="bg-white text-gray-600 flex justify-between md:hidden">
                <a href="{{ route('pelanggan.index') }}" class="block p-4 text-2xl font-bold text-black">
                    Arsfix.
                </a>
                <button @click="sidebarOpen = !sidebarOpen" class="p-4 focus:outline-none focus:bg-gray-100">
                    <svg class="h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
            </div>

            <div :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" 
                 class="fixed inset-y-0 left-0 z-30 w-64 bg-white shadow-md transform transition duration-300 ease-in-out md:relative md:translate-x-0">
                <x-sidebar />
            </div>

            <main class="flex-1">
                {{ $slot }}
            </main>

        </div>
    </body>
</html>
