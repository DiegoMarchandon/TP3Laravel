@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Dashboard</h1>
    {{-- Subnavbar con opciones específicas del usuario --}}
    <div class=" bg-gray-200">
    <ul class="w-full flex bg-green-400 justify-center space-x-[10%]
    md:flex-column">
            <li>Vista General</li>
            <li>Publicaciones</li>
            <li>Guardado</li>
            <li>Comentarios</li>
        </ul>
    </div>
    <h2 class="text-xl font-semibold mb-4">últimos posts votados:</h2>
    
    <div class="mb-12">
        <x-post-carousel :posts="$topPosts" :reactions="$reactions" />
    </div>

    <h2 class="text-xl font-semibold mb-4">Posts a los que has dado like:</h2>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-500 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
@endsection
