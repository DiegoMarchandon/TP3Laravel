
{{-- Vista general (por defecto). Tendrá:
- SubCarpeta con posts likeados & reaccionados
- subCarpeta con post comentados & respuestas
- subCarpeta con posts guardados/favoritos
- datos del usuario (fecha en la que se unió, cantidad de posts hechos, likes recibidos (en posts y comentarios))
--}}

<div x-data="{ activeTab: 'liked' }">

    {{-- Sección 1: Tarjeta de datos del usuario --}}
    <div class="user-profile-card mb-8">
        
        <div class="bg-blue-100 p-6 rounded-lg">
            {{-- Fecha de unión, posts creados, likes recibidos --}}
            <h2 class="text-2xl font-bold">{{auth()->user()->name}}</h2>
            <p>Miembro desde: {{auth()->user()->created_at->format('d/m/Y')}}</p>
            <p>Posts creados: {{$userStats['postsCount']}}</p>
            <p>Likes recibidos: {{$userStats['likesReceived']}}</p>
        </div>

        {{-- Botones --}}
        <button @click="activeTab = 'liked'" :class="activeTab === 'liked' ? 'bg-blue-500 text-white' : 'bg-gray-200'">
            Posts con Like ({{ $likedPosts->count() }})
        </button>
        <button @click="activeTab = 'commented'" :class="activeTab === 'commented' ? 'bg-blue-500 text-white' : 'bg-gray-200'">
            Posts Comentados ({{ $commentedPosts->count() }})
        </button>
        <button @click="activeTab = 'saved'" :class="activeTab === 'saved' ? 'bg-blue-500 text-white' : 'bg-gray-200'">
            Posts Guardados ({{ $savedPosts->count() }})
        </button>



        {{-- Secciones con tabs/buttons para cambiar  --}}
        <div class="tabs mb-4">
            {{-- Usar el componente post-card o parecido --}}
            <button @click="activeTab = 'liked'"></button>
            <button @click="activeTab= 'commented'"></button>
            <button @click="activeTab = 'saved'"></button>
        </div>
        
        {{-- Contenido de cada sección (aparece/desaparece) --}}
        <div x-show="activeTab === 'liked'">
            @forelse($likedPosts as $post)
                <div class="post-item mb-4 p-4 bg-gray-100 rounded">
                    <h3 class="font-bold">{{$post->title}}</h3>
                    <p class="text-sm">{{Str::limit($post->content, 150)}}</p>
                </div>
            @empty
                <p class="text-gray-500">No hay posts con like</p>
            @endforelse
        </div>
        
        <div x-show="activeTab === 'commented'">
            @forelse($commentedPosts as $post)
                <div class="post-item mb-4 p-4 bg-gray-100 rounded">
                    <h3 class="font-bold">{{$post->title}}</h3>
                    <p class="text-sm">{{Str::limit($post->content, 150)}}</p>
                </div>
            @empty
                <p class="text-gray-500">No hay posts comentados</p>
            @endforelse
        </div>
        
        <div x-show="activeTab === 'saved'">
            @forelse($savedPosts as $post)
                <div class="post-item mb-4 p-4 bg-gray-100 rounded">
                    <h3 class="font-bold">{{$post->title}}</h3>
                    <p class="text-sm">{{Str::limit($post->content, 150)}}</p>
                </div>
            @empty
                <p class="text-gray-500">No hay posts guardados</p>
            @endforelse
        </div>
    </div>
    
</div>

