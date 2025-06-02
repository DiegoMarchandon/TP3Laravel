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
    </div>
@endsection
