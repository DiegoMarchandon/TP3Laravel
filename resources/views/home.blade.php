@extends('layouts.app')

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800;900&display=swap" rel="stylesheet">
@section('content')
    <h1 class="text-xl font-bold text-gray-800 dark:text-gray-200">Pantalla principal</h1>
    <p class="mt-4">Contenido de la pantalla principal de tu aplicación.</p>

    <div class="mt-6 space-y-6">
        @forelse($posts as $post)
            <x-post-card :post="$post" :reactions="$reactions" />
        @empty
            <p class="text-gray-500 dark:text-gray-400">No hay publicaciones aún.</p>
        @endforelse
    </div>
    
@endsection
