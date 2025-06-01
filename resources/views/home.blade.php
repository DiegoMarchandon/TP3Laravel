@extends('layouts.app')

@section('content')
    <h1 class="text-xl font-bold">Pantalla principal</h1>
    <p class="mt-4">Contenido de la pantalla principal de tu aplicación.</p>

    <div class="mt-6 space-y-6">
        @forelse($posts as $post)
            <div class="bg-white shadow rounded p-4">
                <h2 class="text-lg font-semibold">{{ $post->title }}</h2>
                <p class="text-sm text-gray-500">Publicado por {{ $post->user->name ?? 'Anónimo' }} en la categoría {{ $post->category->name ?? 'Sin categoría' }}</p>
                <p class="mt-2 text-gray-800">{{ Str::limit($post->content, 200) }}</p>
                <a href="{{ route('posts.show', $post) }}" class="text-blue-500 hover:underline">Leer más</a>
            </div>
        @empty
            <p class="text-gray-500">No hay publicaciones aún.</p>
        @endforelse
    </div>
@endsection
