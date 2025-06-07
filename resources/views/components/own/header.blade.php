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
        <span>filtrar por:</span>
        
        <span>Categoria</span>
        <form action="{{ route('posts.filterByCategory') }}" method="GET" class="inline">
            <select name="id" class="bg-white text-blue-500 px-4 py-2 rounded hover:bg-blue-100" onchange="this.form.submit()">
                <option value="">Todas las categorías</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="bg-white text-blue-500 px-4 py-2 rounded hover:bg-blue-100">Filtrar</button>
        </form> 
        <span>Ordenar por:</span>
        <form action="{{ route('posts.orderPostsBy') }}" method="GET" class="inline">
            <select name="metric" class="bg-white text-blue-500 px-4 py-2 rounded hover:bg-blue-100" onchange="this.form.submit()">
                <option value="likes" @selected(request('metric') === 'likes')>Likes</option>
                <option value="comments" @selected(request('metric') === 'comments')>Comentarios</option>
            </select>
            <select name="order" class="bg-white text-blue-500 px-4 py-2 rounded hover:bg-blue-100" onchange="this.form.submit()">
                <option value="asc" @selected(request('order') === 'asc')>Menos a mas</option>
                <option value="desc" @selected(request('order') === 'desc')>Mas a menos</option>
            </select>
        </form>
        

        {{-- <a href="{{ route('posts.filterByCategory', ['id' => 3]) }}">Probar Filtro ID 3</a> --}}
        {{-- <a href="/posts/filter">Probar directo</a> --}}
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