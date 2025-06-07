@extends('layouts.app')

@section('content')
    <h1 class="text-xl font-bold">Pantalla principal</h1>
    <p class="mt-4">Contenido de la pantalla principal de tu aplicación.</p>

    <div class="mt-6 space-y-6">
        @forelse($posts as $post)
            <div class="bg-white shadow rounded p-4 max-w-2xl w-full mx-auto break-words">
                @if($post->poster)
                    <img src="{{ asset('storage/' . $post->poster) }}" alt="Imagen del post" class="max-w-[300px] h-auto">
                @endif
                <h2 class="text-lg font-semibold">{{ $post->title }}</h2>
                <p class="text-sm text-gray-500">
                    Publicado por {{ $post->user->name ?? 'Anónimo' }} 
                    en la categoría {{ $post->category->name ?? 'Sin categoría' }}
                </p>
                <p class="mt-2 text-gray-800">{{ Str::limit($post->content, 200) }}</p>
    
                {{-- Botón de like --}}
                <form action="{{ route('posts.toggleLike', $post->id) }}" method="POST" class="mt-4 inline-block">
                    @csrf
                    <button type="submit" class="text-red-500 hover:underline">
                        ❤️ Me gusta ({{ $post->likes->count() }})
                    </button>
                </form>
    
                {{-- comentarios botón --}}
                {{-- <form action="{{ route('posts.makeComment', $post->id) }}" method="POST" class="mt-4 inline-block">
                    @csrf
                    <button type="submit" class="text-blue-500 hover:underline ml-4">
                        Comentarios ({{ $post->comments->count() }})
                    </button>
                </form> --}}
                <a href="{{ route('posts.show', $post->id) }}" class="text-blue-500 hover:underline ml-4">
                    Comentarios ({{ $post->comments->count() }})
                </a>

                {{-- Enlace de leer más --}}
                <a href="{{ route('posts.show', $post->id) }}" class="text-blue-500 hover:underline ml-4">
                    Leer más
                </a>
            </div>
        @empty
            <p class="text-gray-500">No hay publicaciones aún.</p>
        @endforelse
    </div>
    
@endsection
