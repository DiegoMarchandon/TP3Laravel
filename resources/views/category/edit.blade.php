@extends('layouts.app')

@section('content')
    <h1 class="text-xl font-bold">Modificar post {{ $post->id }}</h1>
    @if (isset($post))
        <h1>Editar Post</h1>

        <form method="POST" action="#">
            @csrf

            <label>Título:</label>
            <input type="text" name="title" value="{{ $post->title }}"><br>

            <label>Contenido:</label>
            <textarea name="content">{{ $post->content }}</textarea><br>

            <label>Poster:</label>
            <input type="text" name="poster" value="{{ $post->poster }}"><br>

            <button type="submit">Guardar cambios</button>
        </form>
    @else
        <p>No se encontró el post.</p>
    @endif
@endsection
