@extends('layouts.app')

@section('content')
    <h1 class="text-xl font-bold text-gray-800 dark:text-gray-200">Pantalla principal</h1>
    <p class="mt-4">Contenido de la pantalla principal de tu aplicación.</p>

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
                        {{-- Reacciones con emojis --}}
                        <div class="flex flex-wrap gap-2 mt-3">
                            @foreach($reactions as $reaction)
                                <form action="{{ route('posts.react', ['post' => $post->id, 'reaction' => $reaction->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit" title="{{ $reaction->name }}" class="flex items-center gap-1 px-2 py-1 bg-black/10 hover:bg-black/20 rounded-full transition duration-200 shadow text-sm dark:bg-white/10 dark:hover:bg-white/20">
                                        
                                        <img src="{{ asset('storage/' . $reaction->imagen_url) }}" alt="{{ $reaction->name }}" class="w-7 h-7">
                                        <span class="font-semibold">
                                            {{ $post->reactions()->where('reaction_id', $reaction->id)->count() }}
                                        </span>
                                    </button>
                                </form>
                            @endforeach
                        </div>
                    </div>
                </div>
                @empty
                    <p class="text-gray-500 dark:text-gray-400">No hay publicaciones aún.</p>
                @endforelse
    </div>
    
@endsection
