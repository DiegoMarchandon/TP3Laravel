@extends('layouts.app')

@section('content')
    <h1>Crear nuevo post</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
        @csrf

        <div>
            <label for="title">Título</label>
            <input type="text" name="title" id="title" required>
        </div>

        <div>
            <label for="content">Contenido</label>
            <textarea name="content" id="content" rows="5" required></textarea>
        </div>

        <div>
            <label for="category_id">Categoría</label>
            <select name="category_id" id="category_id" required>
                <option value="">Selecciona una categoría</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        
        <div>
            <label for="poster">Subir Imagen</label>
            <input type="file" name="poster" id="poster" accept="image/*">

            <p class="mt-2 text-sm text-gray-500">O pegá un enlace:</p>
            <input type="url" name="poster_url" id="poster_url" value="{{ old('poster_url', $post->poster_url ?? '') }}">
        </div>

        
        <button type="submit">Publicar</button>
    </form>
@endsection
