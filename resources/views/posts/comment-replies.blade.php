@foreach($comments as $comment)
    <div class="ml-6 border-l-2 pl-3 mt-2" x-show="expandReplies_{{ $comment->parent_comment_id }}">
        <p class="text-sm text-gray-700">{{ $comment->content }}</p>
        <div class="flex">
            <p class="text-xs text-gray-500">— {{ $comment->user->name ?? 'Anónimo' }}</p>
            <button @click="replyingTo = {{$comment->id}}" class="text-xs pl-2 pr-2 ml-4 bg-yellow-300 border-2 border-solid rounded-xl">Responder</button>
        </div>

        {{-- Formulario para responder --}}
        @if(Auth::check())
            <form x-show="replyingTo === {{ $comment->id }}" 
                  action="{{ route('posts.makeComment', $post) }}" 
                  method="POST" 
                  class="mt-2 ml-4 bg-gray-50 p-3 rounded">
                @csrf
                <input type="hidden" name="parent_comment_id" value="{{ $comment->id }}">
                <textarea name="content" rows="2" class="w-full border rounded p-2" placeholder="Escribe tu respuesta..."></textarea>
                <button type="submit" class="mt-1 bg-blue-500 text-white px-3 py-1 rounded text-sm">Responder</button>
                <button type="button" @click="replyingTo = null" class="mt-1 bg-gray-400 text-white px-3 py-1 rounded text-sm">Cancelar</button>
            </form>
        @endif

        {{-- Botón para mostrar respuestas anidadas (recursivo) --}}
        @if($comment->replies->count() > 0)
            <button @click="expandReplies_{{ $comment->id }} = !expandReplies_{{ $comment->id }}" 
                    class="text-green-500 text-xs mt-1 font-semibold">
                <span x-show="!expandReplies_{{ $comment->id }}">Ver respuestas ({{ $comment->replies->count() }})</span>
                <span x-show="expandReplies_{{ $comment->id }}">Ocultar respuestas</span>
            </button>

            {{-- Llamada recursiva --}}
            @include('posts.comment-replies', ['comments' => $comment->replies, 'post' => $post])
        @endif
    </div>
@endforeach