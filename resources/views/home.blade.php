@extends('layouts.app')

@section('content')
    <h1 class="text-xl font-bold text-gray-800 dark:text-gray-200">Pantalla principal</h1>
    <p class="mt-4">Contenido de la pantalla principal de tu aplicación.</p>

    {{-- <div class="mt-6 space-y-6">
        @forelse($posts as $post)
            <div class="bg-white shadow rounded p-4 max-w-2xl w-full mx-auto break-words">
                @if($post->poster)
                    <img src="{{ asset('storage/' . $post->poster) }}" alt="Imagen del post" class="max-w-[300px] h-auto">
                @elseif ($post->poster_url)
                    <img src="{{ $post->poster_url }}" alt="Imagen del post" class="max-w-[300px] h-auto">
                @endif
                <h2 class="text-lg font-semibold">{{ $post->title }}</h2>
                <p class="text-sm text-gray-500">
                    Publicado por {{ $post->user->name ?? 'Anónimo' }} 
                    en la categoría {{ $post->category->name ?? 'Sin categoría' }}
                </p>
                <p class="mt-2 text-gray-800">{{ Str::limit($post->content, 200) }}</p>
    

                <form action="{{ route('posts.toggleLike', $post->id) }}" method="POST" class="mt-4 inline-block">
                    @csrf
                    <button type="submit" class="text-red-500 hover:underline">
                        ❤️ Me gusta ({{ $post->likes->count() }})
                    </button>
                </form>
    
                <a href="{{ route('posts.show', $post->id) }}" class="text-blue-500 hover:underline ml-4">
                    Comentarios ({{ $post->comments->count() }})
                </a>

                <a href="{{ route('posts.show', $post->id) }}" class="text-blue-500 hover:underline ml-4">
                    Leer más
                </a>
                @if($post->user_id ===Auth::id())

                    <a href="{{ route('posts.edit', $post->id) }}" class="text-green-500 hover:underline ml-4">
                        Editar
                    </a>
                @endif

                @if(Auth::check() && (($post->user_id ===Auth::id()) || (Auth::user()->role === 'admin')))
                    <form action="{{ route('posts.disable', $post->id) }}" method="POST" class="inline-block ml-4">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="text-red-500 hover:underline">
                            Deshabilitar
                        </button>
                    </form>
                @endif
            </div>
        @empty
            <p class="text-gray-500">No hay publicaciones aún.</p>
        @endforelse
    </div> --}}
    <div class="mt-6 space-y-6">
        @forelse($posts as $post)
        <div> 
            <div class="bg-gradient-to-br from-yellow-100 via-yellow-50 to-yellow-100 border border-yellow-300 text-gray-800 shadow-md rounded-xl p-6 max-w-2xl w-full mx-auto break-words
              transition-shadow duration-300 hover:shadow-lg 
              dark:bg-gradient-to-br dark:from-stone-800 dark:via-stone-900 dark:to-stone-800 dark:border-stone-600 dark:text-gray-200 
              dark:hover:shadow-[0_0_15px_#00ff75,0_0_25px_#3700ff]">
                        @if($post->poster)
                            <img src="{{ asset('storage/' . $post->poster) }}" alt="Imagen del post" class="max-w-[300px] h-auto rounded mb-4 shadow">
                        @elseif ($post->poster_url)
                            <img src="{{ $post->poster_url }}" alt="Imagen del post" class="max-w-[300px] h-auto rounded mb-4 shadow">
                        @endif
            
                        <h2 class="text-xl font-bold mb-1">{{ $post->title }}</h2>
                        <p class="text-sm text-yellow-800 dark:text-yellow-300 mb-2">
                            Publicado por <span class="font-semibold">{{ $post->user->name ?? 'Anónimo' }}</span> 
                            en <span class="italic">{{ $post->category->name ?? 'Sin categoría' }}</span>
                        </p>
                        <p class="text-base mb-3">{{ Str::limit($post->content, 200) }}</p>
            
                        {{-- Botón de like --}}
                        <form action="{{ route('posts.toggleLike', $post->id) }}" method="POST" class="inline-block">
                            @csrf
                            <button type="submit" class="text-red-600 hover:underline dark:text-red-400">
                                ❤️ Me gusta ({{ $post->likes->count() }})
                            </button>
                        </form>
            
                        {{-- comentarios botón --}}
                        <a href="{{ route('posts.show', $post->id) }}" class="text-blue-600 hover:underline ml-4 dark:text-blue-400">
                            Comentarios ({{ $post->comments->count() }})
                        </a>
            
                        {{-- leer más --}}
                        <a href="{{ route('posts.show', $post->id) }}" class="text-blue-600 hover:underline ml-4 dark:text-blue-400">
                            Leer más
                        </a>
            
                        @if($post->user_id === Auth::id())
                            <a href="{{ route('posts.edit', $post->id) }}" class="text-green-600 hover:underline ml-4 dark:text-green-400">
                                Editar
                            </a>
                        @endif
            
                        @if(Auth::check() && (($post->user_id === Auth::id()) || (Auth::user()->role === 'admin')))
                            <form action="{{ route('posts.disable', $post->id) }}" method="POST" class="inline-block ml-4">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="text-red-600 hover:underline dark:text-red-400">
                                    Deshabilitar
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
                @empty
                    <p class="text-gray-500 dark:text-gray-400">No hay publicaciones aún.</p>
                @endforelse
    </div>
    
@endsection
