@extends('layouts.app')

@section('content')

    <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">{{ $post->title }}</h1>
        <p class="text-gray-700 mb-4">{{ $post->content }}</p>

        <p class="text-sm text-gray-500">
            Publicado por: {{ $post->user->name ?? 'Desconocido' }} |
            Categoría: {{ $post->category->name ?? 'Sin categoría' }} |
            {{ $post->created_at ? $post->created_at->format('d/m/Y H:i') : 'Fecha no disponible' }}

        </p>
            {{-- COMENTARIO --}}
        <form action="{{ route('posts.makeComment', $post) }}" method="POST" class="mt-6">
            @csrf
            <textarea name="content" rows="3" class="w-full border rounded p-2" placeholder="Escribí un comentario..."></textarea>
            @error('body') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            <button type="submit" class="mt-2 bg-blue-500 text-white px-4 py-2 rounded">Comentar</button>
        </form>

        {{-- Mostrar comentarios --}}
        <div class="mt-6">
            <h3 class="font-semibold mb-2">Comentarios:</h3>
            @forelse ($post->comments as $comment)
                <div class="border-t pt-2 mt-2">
                    <p class="text-sm text-gray-700">{{ $comment->content }}</p>
                    <p class="text-xs text-gray-500">— {{ $comment->user->name ?? 'Anónimo' }}</p>
                </div>
            @empty
                <p class="text-gray-500 text-sm">Aún no hay comentarios.</p>
            @endforelse
        </div>
    </div>
@endsection
