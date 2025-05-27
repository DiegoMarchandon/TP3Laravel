@extends('layouts.app')

@section('content')
        <h1 class="text-xl font-bold">Vista detalle del post {{ $post->id }}</h1>
    @if (isset($post))
        <h1>{{ $post->title }}</h1>
        <p>{{ $post->content }}</p>
        <p>Publicado por: {{ $post->poster }}</p>
    @else
        <p>No se encontró el post.</p>
    @endif
@endsection
