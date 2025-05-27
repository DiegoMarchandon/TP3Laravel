@extends('layouts.app') {{-- le indica a Blade que está heredando una plantilla base (en /views/layouts/app.blade.php). Evita repetir HTML, mantiene una estructura uniforme en todas las páginas, es la forma más limpia y profesional de trabajar con vistas en Laravel. --}}
{{-- sólo se debe quitar cuando estamos haciendo una vista totalmente independiente sin layout. --}}
<h1>Listado de Posts</h1>

<ul>
@foreach ($posts as $post)
    <li>
        <a href="{{ url('category/show/' . $post->id) }}">{{ $post->title }}</a>
    </li>
@endforeach
</ul>
