<header class="bg-blue-500 text-white p-4">
    <h1 class="text-lg">Mi Blog</h1>
    <button id="darkModeToggle" class="bg-gray-300 dark:bg-gray-700 px-4 py-2 rounded">
        🌙
    </button>
    <div class="flex justify-end space-x-4">
        @auth
            <span>Hola, {{ Auth::user()->name }}</span>
            <a href="{{ route('posts.create') }}">Nuevo Post</a>
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="bg-white text-blue-500 px-4 py-2 rounded hover:bg-blue-100">Cerrar Sesión</button>
            </form>
        @endauth

        @guest
            <a href="{{ route('login') }}" class="bg-white text-blue-500 px-4 py-2 rounded hover:bg-blue-100">Iniciar Sesión</a>
            <a href="{{ route('register') }}" class="bg-white text-blue-500 px-4 py-2 rounded hover:bg-blue-100">Registrarse</a>
        @endguest

    </div>
    {{-- <button>iniciar sesión</button> --}}
    {{-- <button>registrarse</button> --}}
</header>
<div class="container mx-auto mt-4">
    <nav class="bg-white shadow rounded-lg p-4">
        <ul class="flex space-x-4">
            {{-- <li><a href="{{ route('home') }}" class="text-blue-500 hover:underline">Inicio</a></li> --}}
            {{-- <li><a href="{{ route('posts.index') }}" class="text-blue-500 hover:underline">Posts</a></li> --}}
            {{-- <li><a href="{{ route('posts.create') }}" class="text-blue-500 hover:underline">Crear Post</a></li> --}}
        </ul>
    </nav>