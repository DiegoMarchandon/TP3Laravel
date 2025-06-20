<!DOCTYPE html>
<html lang="en" class="bg-gray-100 dark:bg-gray-900">
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
    <body class='font-sans min-h-screen antialiased bg-custom-light shadow text-black dark:bg-custom-dark dark:text-white'>
        <div class="min-h-screen dark:bg-gray-900">
            {{-- @include('layouts.navigation') --}}
            @include('components.own.header')
            <!-- Page Heading -->
            {{-- @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset --}}
            <div class="flex">
                @include('components.own.sidebar')
                <main class="flex-1 p-6 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-200">
                    <!-- Page Content -->
                    {{-- {{ $slot }} --}}
                    @yield('content')
                    
                </main>
            </div>
            
        </div>
    </body>
</html>
