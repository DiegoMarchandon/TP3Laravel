
{{-- Vista general (por defecto). Tendrá:
- SubCarpeta con posts likeados & reaccionados
- subCarpeta con post comentados & respuestas
- subCarpeta con posts guardados/favoritos
- datos del usuario (fecha en la que se unió, cantidad de posts hechos, likes recibidos (en posts y comentarios))
--}}

<div x-data="{ activeTab: 'liked' }">

    {{-- Sección 1: Tarjeta de datos del usuario --}}
    <div class="mb-8">
        
        {{-- ID del usuario --}}
        <div class="bg-blue-500 h-[25rem] w-[50rem] p-6 rounded-lg relative"
        style="
        background-image: url('{{asset('storage/texturas/IDBackground.png')}}');
        background-size: cover;
        background-repeat: no-repeat; 
        background-attachment: local;
        background-position: center;
        ">
            {{-- Fecha de unión, posts creados, likes recibidos --}}
            <svg viewBox="0 0 400 100" style="width: 100%; height: auto; font-size: 1.25rem;" class="absolute top-2 right-1">
                <defs>
                    <path id="wave" d="M 0,75 Q 200,-8 400,75" fill="none"/>
                </defs>
                <text style="font-size: 20px;">
                    <textPath href="#wave" startOffset="50%" text-anchor="middle">
                        {{-- {{auth()->user()->name}} --}}
                        Identificación
                    </textPath>
                </text>
            </svg>
            
            <h2 class="text-2xl font-bold"
            style="
            transform: perspective(500px) rotateX(20deg);
            position:absolute;
            top: 5rem;
            left: 8rem;
            "   
            >Nombre:</h2>
            <p
            style="
            position:absolute;
            top: 6.5rem;
            left: 8rem;
            "
            >{{auth()->user()->name}}</p>

            <p style="
            position:absolute;
            top: 8.5rem;
            left: 8rem;
            "
            >Miembro desde: {{$userStats['joinDate']->format('d/m/Y')}}</p>
            
            <svg viewBox="0 0 400 100" style="width: 100%; height: auto; font-size: 1.25rem;" class="absolute bottom-0.5 right-1">
                <defs>
                    <path id="wave" d="M 0,75 Q 200,-8 400,75" fill="none"/>
                </defs>
                <text style="font-size: 18px;">
                    <textPath href="#wave" startOffset="50%" text-anchor="middle">
                        {{-- {{auth()->user()->name}} --}}
                        Contribuciones
                    </textPath>
                </text>
            </svg>
            
            <p style="
            position:absolute;
            top: 19.2rem;
            left: 13.5rem;
            "
            >{{$userStats['postsCount']}} Posts</p>
            {{-- <p>Likes recibidos: {{$userStats['likesReceived']}}</p> --}}
            <p  style="
            position:absolute;
            top: 19.2rem;
            left: 22.5rem;
            ">{{$likedPostsCount}} Likes</p>
            <p  style="
            position:absolute;
            top: 19.2rem;
            left: 30.5rem;
            ">{{$commentedPostsCount}} Comentarios</p>
            {{-- <p>Reacciones dadas: {{$reactions}}</p> --}}
            {{-- <p>Foto de perfil: {{$userPic}}</p> --}}
            <img src="{{$userPic}}" alt="foto de perfil del usuario"
            style="
            position: absolute;
            top: 5.6rem;
            right: 7.24rem;
            width: 8.75rem;
            height: 9.375rem;
            "
            >
        </div>

        {{-- Botones --}}
        <button @click="activeTab = 'liked'" :class="activeTab === 'liked' ? 'bg-blue-500 text-white' : 'bg-gray-200'">
            Posts Likeados ({{ $likedPosts->count() }})
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

