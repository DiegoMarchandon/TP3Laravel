@extends('layouts.app')

@section('content')
<div x-data="{activeView:'general'}">
    <h1 class="text-2xl font-bold mb-6">Dashboard</h1>
    {{-- Subnavbar interactivo para el usuario --}}
    <div class=" bg-gray-200">
        <ul class="w-full flex bg-green-400 justify-center space-x-[10%]
            md:flex-column">
            <li><button @click="activeView = 'general'" :class="activeView === 'general' ? 'font-bold' : ''">Vista General</button></li>
            <li><button @click="activeView = 'posts'" :class="activeView === 'posts' ? 'font-bold' : ''">Publicaciones</button></li>
            <li><button @click="activeView = 'settings'" :class="activeView === 'settings' ? 'font-bold' : ''">Configuración</button></li>
            {{-- <li><button @click="activeView = 'comments'" :class="activeView === 'comments' ? 'font-bold' : ''">Comentarios</button></li> --}}
        </ul>
    </div>

    <h2 class="text-xl font-semibold mb-4">últimos posts votados:</h2>
    <div class="mb-12">
        <x-post-carousel :posts="$topPosts" :reactions="$reactions" />
    </div>

        {{-- Secciones según la vista seleccionada --}}
    <div x-show="activeView === 'general'">
        @include('dashboard.general')
    </div>
    
    <div x-show="activeView === 'posts'">
        Posts section
    </div>
    
    <div x-show="activeView === 'settings'">
        @include('dashboard.edit-profile-form')
    </div>
    
    <div x-show="activeView === 'comments'">
        Comments section
    </div>    

</div>
@endsection
