<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800;900&display=swap" rel="stylesheet">
<style>
  .btn-contact {
    clip-path: polygon(0% 0%, 100% 0%, 85% 50%, 100% 100%, 0% 100%, 15% 50%);
    background-image: url('/storage/texturas/45-degree-fabric-dark.png');
    background-size: auto;
    background-repeat: repeat;
    box-shadow: 
        inset 3px 0 0 0 rgba(0,0,0,0.4), 
        inset 0 -3px 0 0 rgba(0,0,0,0.3);  
    }
  
    .btn-contact::after {
        content: '';
        position: absolute;
        inset: 0;
        clip-path: polygon(0% 0%, 100% 0%, 85% 50%, 100% 100%, 0% 100%, 15% 50%);
        border: 2px solid rgba(0,0,0,0.3);
        pointer-events: none;
    }
    
    header {
        box-shadow:
        inset 0 2px 0 rgba(0,0,0,0),
        inset 0 -2px 0 rgba(0,0,0,0.2),
        inset 0 4px 0 rgba(0,0,0,0.1),
        inset 0 -4px 0 rgba(0,0,0,0.1);
    }


  .btn-contact.bg-red-500 {
    background-color: #ef4444;
    background-blend-mode: multiply;
  }
  
  .btn-contact.bg-blue-500 {
    background-color: #3b82f6;
    background-blend-mode: multiply;
  }
  
  .btn-contact.bg-green-500 {
    background-color: #22c55e;
    background-blend-mode: multiply;
  }
  
  .btn-contact:hover {
    filter: brightness(0.9);
  }
</style>

<header class="sticky top-0 z-50 p-4 
    bg-gradient-to-r from-yellow-500 via-yellow-300 to-yellow-100 
    dark:bg-gradient-to-r dark:from-blue-800 dark:via-blue-900 dark:to-blue-950 
    dark:bg-opacity-90 dark:backdrop-blur-md 
    text-amber-900 dark:text-amber-100 
    dark:shadow-lg">
    <div class="flex flex-col p-2 border-b-2 border-t-2 border-black md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
        <!-- Título y toggle modo oscuro -->
        <div class="flex items-center justify-between w-full md:w-auto">
            <h1 class="text-xl mx-2" style="font-family: 'Playfair Display', serif;">Mi Blog</h1>
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
            
            <!-- Filtros -->
            <div class="flex flex-wrap items-center gap-2">
                <span>Filtrar por:</span>
                <form action="{{ route('posts.filterByCategory') }}" method="GET" class="inline">
                    <select name="id" class="px-3 py-2 rounded bg-amber-50 text-amber-900 border border-amber-200 dark:bg-gray-800 dark:text-amber-100" onchange="this.form.submit()">
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

            @auth
                <span>Hola, {{ Auth::user()->name }}</span>
                <img src="/storage/logos/NauticStar.png" alt="separador" class="h-12 w-14 opacity-80">
                <a href="{{ route('posts.create') }}" class="px-3 py-2 rounded bg-yellow-500 hover:bg-yellow-600 text-white dark:bg-blue-600 dark:hover:bg-blue-700">Nuevo Post</a>
                <img src="/storage/logos/NauticStar.png" alt="separador" class="h-12 w-14 opacity-80">
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="px-7 py-2 bg-red-500 hover:bg-red-600 text-white btn-contact relative" style="font-family: 'Playfair Display'">CERRAR SESIÓN</button>
                </form>
            @endauth

            @guest
                <a href="{{ route('login') }}" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white btn-contact relative" style="font-family: 'Playfair Display'">INICIAR SESIÓN</a>
                <a href="{{ route('register') }}" class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white btn-contact relative" style="font-family: 'Playfair Display'">REGISTRARSE</a>
            @endguest

        </div>
    </div>
</header>

