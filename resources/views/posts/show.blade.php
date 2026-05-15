@extends('layouts.app')

@section('content')

    <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">{{ $post->title }}</h1>
        <p class="text-gray-700 mb-4">{{ $post->content }}</p>

        <p class="text-sm text-gray-500">
            Publicado por: {{ $post->user->name ?? 'Desconocido' }} |
            Categoría: {{ $post->category->name ?? 'Sin categoría' }} |
            {{ $post->created_at ? $post->created_at->format('d/m/Y H:i') : 'Fecha no disponible' }}

        </p>
            {{-- COMENTARIO --}}
        <form action="{{ route('posts.makeComment', $post) }}" method="POST" class="mt-6">
            @csrf
            <textarea name="content" rows="3" class="w-full border rounded p-2" placeholder="Escribí un comentario..."></textarea>
            @error('body') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            <button type="submit" class="mt-2 bg-blue-500 text-white px-4 py-2 rounded">Comentar</button>
        </form>

        {{-- Mostrar comentarios --}}
        <div class="mt-6" 
             x-data="{
                 replyingTo: null,
                 @foreach($post->comments->where('parent_comment_id', null) as $c)
                     expandReplies_{{ $c->id }}: false{{ !$loop->last ? ',' : '' }}
                 @endforeach
             }">
            <h3 class="font-semibold mb-2">Comentarios:</h3>
            @forelse ($post->comments->where('parent_comment_id',null) as $comment)
            {{-- Mostramos el comentario padre solo si NO es respuesta --}}
                <div class="border-t pt-2 mt-2">
                    <p class="text-sm text-gray-700">{{ $comment->content }}</p>
                    <div class="flex">
                        <p class="text-xs text-gray-500">— {{ $comment->user->name ?? 'Anónimo' }}</p>
                        <button @click="replyingTo = {{$comment->id}}" class="text-xs pl-2 pr-2 ml-4 bg-yellow-300 border-2 border-solid rounded-xl">Responder</button>
                    </div>
                    {{-- Formulario para responder (oculto por defecto) --}}
                    @if(Auth::check())
                        <form x-show="replyingTo === {{$comment->id}}" 
                            action="{{route('posts.makeComment',$post)}}"
                            method="POST"
                            class="mt-2 ml-4 bg-gray-50 p-3 rounded">
                            @csrf
                            <input type="hidden" name="parent_comment_id" value="{{$comment->id}}">
                            <textarea name="content" rows="2" class="w-full border rounded p-2" placeholder="Escribe tu respuesta..."></textarea>
                            <button type="submit" class="mt-1 bg-blue-500 text-white px-3 py-1 rounded text-sm">Responder</button>
                            <button type="button" @click="replyingTo = null" class="mt-1 bg-gray-400 text-white px-3 py-1 rounded text-sm">Cancelar</button>
                        </form>
                    @endif

                    {{-- Botón para mostrar respuestas --}}
                    @if($comment->replies->count() > 0)
                        <button @click="expandReplies_{{$comment->id}} = !expandReplies_{{$comment->id}}"
                            class="text-green-500 text-xs mt-1 font-semibold"
                            >
                            <span x-show="!expandReplies_{{ $comment->id }}">Ver respuestas ({{ $comment->replies->count() }})</span>
                            <span x-show="expandReplies_{{ $comment->id }}">Ocultar respuestas</span>
                        </button>
                        {{-- Mostrar respuestas anidadas --}}
                        @include('posts.comment-replies', ['comments' => $comment->replies, 'post' => $post])
                    @endif
                </div>
            @empty
                <p class="text-gray-500 text-sm">Aún no hay comentarios.</p>
            @endforelse
        </div>
    </div>
@endsection
