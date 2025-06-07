@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Editar Post</h1>
<form action="{{ route('posts.update', $post->id) }}" method="POST">
    @csrf
    @method('PUT')

    <!-- tus campos aquí -->
    <input type="text" name="title" value="{{ $post->title }}">
    <textarea name="content">{{ $post->content }}</textarea>
    <select name="category_id">
        <option value="">Selecciona una categoría</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
    <div>
        <label for="poster" class="mt-2 text-sm text-gray-500 block">Subir imagen:</label>
        <input type="file" name="poster" id="poster" accept="image/*">
        
        <label for="poster_url" class="mt-2 text-sm text-gray-500 block">O pegá un enlace:</p>
        <input type="url" name="poster_url" id="poster_url" value="{{ old('poster_url', $post->poster_url ?? '') }}" class="mt-2">

        <label class="mt-2 text-sm text-gray-500 block" for="poster">Imagen actual:</label>
        @if($post->poster)
            <img src="{{ asset('storage/' . $post->poster) }}" alt="Imagen del post" class="max-w-[300px] h-auto mt-2">
        @elseif($post->poster_url)
            <img src="{{ $post->poster_url }}" alt="Imagen del post" class="max-w-[300px] h-auto mt-2">
        @endif
    </div>
    <button type="submit">Actualizar</button>
</form>

@endsection