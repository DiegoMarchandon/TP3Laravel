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
            <label for="image">Imagen</label>
            <input type="file" name="image" id="image" accept="image/*">
        </div>

        
        <button type="submit">Publicar</button>
    </form>
@endsection
