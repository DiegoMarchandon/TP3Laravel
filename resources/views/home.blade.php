@extends('layouts.app') {{-- <-- hereda de app.blade.php --}}

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800;900&display=swap" rel="stylesheet">
@section('content') {{-- <-- Define la sección 'content' --}}
    {{-- <h1 class="text-xl font-bold text-gray-800 dark:text-gray-200">Pantalla principal</h1> --}}
    {{-- <p class="mt-4">Contenido de la pantalla principal de tu aplicación.</p> --}}

    <div class="mt-6 flex justify-center flex-col space-y-6">
        @forelse($posts as $post)
            <x-post-card :post="$post" :reactions="$reactions" />
        @empty
            <p class="text-black p-4 inline border-4 border-gray-900 bg-yellow-300 dark:text-blue-200 dark:bg-blue-800">No hay publicaciones aún.</p>
        @endforelse
    </div>
    
@endsection
