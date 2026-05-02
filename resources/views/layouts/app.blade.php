<!DOCTYPE html>
<html lang="en" class=" dark:bg-gray-900">
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
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    </head>
    <body class='font-sans h-screen antialiased text-black dark:bg-custom-dark dark:text-white'>
        <div class="h-screen bg-with-image dark:bg-gray-900">
            @include('components.own.header')

            <div class="flex">
                @include('components.own.sidebar')
                <main class="flex-1 p-6 bg-transparent h-screen text-gray-900 dark:text-gray-200"
                style="background-image: url('{{ asset('storage/texturas/blogBackground.png') }}'); opacity: 0.4;"
                >
                    @yield('content')
                    
                </main>
            </div>
            
        </div>
    </body>
</html>
