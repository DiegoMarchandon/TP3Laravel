@extends('layouts.app')

@section('content')
       
    <h1 class="text-xl font-bold">
        @if($category)
        Posts en la categoría: {{ $category->name }}</h1>
        @else
        Todos los Posts
        @endif    
    </h1>
    <div class="mt-6 space-y-6">
        @forelse($posts as $post)
            <div class="bg-white shadow rounded p-4">
                <h2 class="text-lg font-semibold">{{ $post->title }}</h2>
                <p class="text-sm text-gray-500">
                    Publicado por {{ $post->user->name ?? 'Anónimo' }} |
                    {{ $post->created_at->format('d/m/Y') }}
                </p>
                <p class="mt-2 text-gray-800">{{ Str::limit($post->content, 200) }}</p>
                <a href="{{ route('posts.show', $post->id) }}" class="text-blue-500 hover:underline">
                    Leer más
                </a>
            </div>
        @empty
            <p class="text-gray-500">No hay posts en esta categoría.</p>
        @endforelse
    </div>
    {{-- <h1>FilterPost</h1> --}}
    {{-- {{ route('posts.filterByCategory') }} --}}
@endsection