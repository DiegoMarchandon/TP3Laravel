<header class="sticky top-0 z-50 p-4 
    bg-gradient-to-r from-yellow-200 via-yellow-300 to-yellow-100 
    dark:bg-gradient-to-r dark:from-blue-800 dark:via-blue-900 dark:to-blue-950 
    dark:bg-opacity-90 dark:backdrop-blur-md 
    text-gray-900 dark:text-gray-100 
    dark:shadow-lg">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
        <!-- Título y toggle modo oscuro -->
        <div class="flex items-center justify-between w-full md:w-auto">
            <h1 class="text-xl font-semibold">Mi Blog</h1>
            {{-- <button id="darkModeToggle" class="ml-4 bg-yellow-400 hover:bg-yellow-500 dark:bg-blue-700 dark:hover:bg-blue-800 text-white px-3 py-2 rounded">
                🌙
            </button> --}}
            <label id="darkModeToggle" class="switch-container">
                <input type="checkbox">
                <span class="slider"></span>
              </label>
        </div>

        <!-- Controles -->
        <div class="flex flex-wrap items-center justify-end gap-2 md:gap-4">
            @auth
                <span>Hola, {{ Auth::user()->name }}</span>
                <a href="{{ route('posts.create') }}" class="px-3 py-2 rounded bg-yellow-500 hover:bg-yellow-600 text-white dark:bg-blue-600 dark:hover:bg-blue-700">Nuevo Post</a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="px-3 py-2 rounded bg-red-500 hover:bg-red-600 text-white">Cerrar Sesión</button>
                </form>
            @endauth

            @guest
                <a href="{{ route('login') }}" class="px-3 py-2 rounded bg-blue-500 hover:bg-blue-600 text-white">Iniciar Sesión</a>
                <a href="{{ route('register') }}" class="px-3 py-2 rounded bg-green-500 hover:bg-green-600 text-white">Registrarse</a>
            @endguest

            <!-- Filtros -->
            <div class="flex flex-wrap items-center gap-2">
                <span>Filtrar por:</span>
                <form action="{{ route('posts.filterByCategory') }}" method="GET" class="inline">
                    <select name="id" class="px-3 py-2 rounded bg-white text-gray-800 dark:bg-gray-700 dark:text-white" onchange="this.form.submit()">
                        <option value="">Todas las categorías</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </form>

                <span>Ordenar por:</span>
                <form action="{{ route('posts.orderPostsBy') }}" method="GET" class="inline flex gap-2">
                    <select name="metric" class="px-3 py-2 rounded bg-white text-gray-800 dark:bg-gray-700 dark:text-white" onchange="this.form.submit()">
                        <option value="likes" @selected(request('metric') === 'likes')>Likes</option>
                        <option value="comments" @selected(request('metric') === 'comments')>Comentarios</option>
                    </select>
                    <select name="order" class="px-3 py-2 rounded bg-white text-gray-800 dark:bg-gray-700 dark:text-white" onchange="this.form.submit()">
                        <option value="asc" @selected(request('order') === 'asc')>Menos a más</option>
                        <option value="desc" @selected(request('order') === 'desc')>Más a menos</option>
                    </select>
                </form>
            </div>
        </div>
    </div>
</header>

