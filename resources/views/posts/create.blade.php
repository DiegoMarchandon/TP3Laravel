@extends('layouts.app')

@section('content')
    <h1>Crear nuevo post</h1>

    <form method="POST" action="{{ route('posts.store') }}">
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
            <label for="poster">Imagen</label>
            <input type="file" name="poster" id="poster" accept="image/*">
        </div>

        
        <button type="submit">Publicar</button>
    </form>
@endsection
