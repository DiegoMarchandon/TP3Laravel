@extends('layouts.app')

@section('content')
<div x-data="{activeView:'general'}">
    {{-- <h1 class="text-2xl font-bold mb-6">Dashboard</h1> --}}
    {{-- Subnavbar interactivo para el usuario --}}
    <div class="w-2/4 h-[120px] mx-auto flex justify-center bg-gray-200" 
    style="
    /* background-image: linear-gradient(to right, rgba(255,255,255,0) 0%, rgba(255,255,255,1) 15%, rgba(255,255,255,0) 85%, rgba(255,255,255,1) 100%), 
    url('{{asset('storage/texturas/subNavbarBackground.png')}}'); */
    background-image: url('{{asset('storage/texturas/subNavbarBackground.png')}}');
    background-size: 100% auto;
    background-repeat: no-repeat; 
    background-attachment: local;
    background-position: center;
    -webkit-mask-image: linear-gradient(to right, transparent 0%, black 15%, black 85%, transparent 100%);
    mask-image: linear-gradient(to right, transparent 0%, black 15%, black 85%, transparent 100%);
    " 
    >
        <ul class="flex align-center justify-center mt-6 space-x-[25%] tracking-wide"
            style="font-family: 'Playfair Display'"
        >
            <li><button @click="activeView = 'general'" :class="activeView === 'general' ? 'font-extrabold text-lg' : 'font-light'">Vista General</button></li>
            <li><button @click="activeView = 'posts'" :class="activeView === 'posts' ? 'font-extrabold text-lg' : 'font-light'">Publicaciones</button></li>
            <li><button @click="activeView = 'settings'" :class="activeView === 'settings' ? 'font-extrabold text-lg' : 'font-light'">Configuración</button></li>
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
