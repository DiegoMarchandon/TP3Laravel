
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
        <div class=" h-[25rem] w-[50rem] p-6 rounded-3xl relative backdrop-blur-sm bg-white/10"
        style="
        background-image: url('{{asset('images/texturas/IDBackground.png')}}');
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
            top: 4.8rem;
            left: 7rem;
            "   
            >Nombre:</h2>
            <p
            style="
            position:absolute;
            top: 6.5rem;
            left: 8rem;
            font-family: monospace;
            font-size: 18px;
            "
            >{{auth()->user()->name}}</p>

            <p style="
            position:absolute;
            top: 8.5rem;
            left: 8rem;
            font-family: monospace;
            font-size: 18px;
            "
            >Miembro desde: {{$userStats['joinDate']->format('d/m/Y')}}</p>
            
            <p style="
            position:absolute;
            top: 10.5rem;
            left: 8rem;
            font-family: monospace;
            font-size: 18px;
            ">Cantidad de seguidores: {{$userFollowersCount}}</p>

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
            font-family: monospace;
            font-size: 18px;
            "
            >{{$userStats['postsCount']}} Posts</p>
            {{-- <p>Likes recibidos: {{$userStats['likesReceived']}}</p> --}}
            <p  style="
            position:absolute;
            top: 19.2rem;
            left: 22.5rem;
            font-family: monospace;
            font-size: 18px;
            ">{{$likedPostsCount}} Likes</p>
            <p  style="
            position:absolute;
            top: 19.2rem;
            left: 30rem;
            font-family: monospace;
            font-size: 18px;
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
        @php 
            $buttons = [
                [
                    'tab' => 'liked',
                    'label' => 'Posts Likeados',
                    'count' => $likedPosts->count(),
                ],
                [
                    'tab' => 'commented',
                    'label' => 'Posts Comentados',
                    'count' => $commentedPosts->count(),
                ],
                [
                    'tab' => 'saved',
                    'label' => 'Posts Guardados',
                    'count' => $savedPosts->count(),
                ],
            ];

            $activeClasses = 'bg-red-700 text-amber-400 font-extrabold border-2 border-yellow-400 p-2 outline outline-2 outline-black';
            $inactiveClasses = 'bg-amber-400 text-red-800 font-extrabold border-2 border-black p-2 outline outline-2 outline-red-600';
        @endphp

        {{-- Secciones con tabs/buttons para cambiar  --}}
        <div class="mt-2 mb-4 flex gap-4">
            @foreach ($buttons as $button)
                <button
                    @click = "activeTab = '{{$button['tab']}}'"
                    :class="activeTab === '{{$button['tab']}}' ? '{{$activeClasses}}':'{{$inactiveClasses}}'"
                >
                {{$button['label']}} ({{$button['count']}})
                </button>
            @endforeach
        </div>

        {{-- Contenido de cada sección (aparece/desaparece) --}}
        <div x-show="activeTab === 'liked'">
            @forelse($likedPosts as $post)
            <a href="{{ route('posts.show', $post->id) }}">
                <div class="post-item flex flex-col items-center justify-center h-[12rem] w-full md:w-[50rem] mb-4 p-4 rounded cursor-pointer"
                style="
                    background-image: url('{{asset('images/texturas/PostsLiked.png')}}');
                    background-size: 100% 100%;
                    background-repeat: no-repeat; 
                    background-attachment: local;
                    background-position: center;
                    "
                >
                    <h3 class="font-bold mt-6 mb-2">{{$post->title}}</h3>
                    <p class="text-sm ml-4 md:ml-12 mr-4 md:mr-12">{{Str::limit($post->content, 150)}}</p>
                </div>
            </a>
            @empty
                <p class="text-gray-500">No hay posts con like</p>
            @endforelse
        </div>
        
        <div x-show="activeTab === 'commented'">
            @forelse($commentedPosts as $post)
                <div class="post-item flex flex-col items-center justify-center h-[10rem] md:h-[12rem] w-full md:w-[50rem] mb-4 p-2 md:p-4 rounded cursor-pointer"
                    style="
                    background-image: url('{{asset('images/texturas/PostsCommented.png')}}');
                    background-size: 100% 100%;
                    background-repeat: no-repeat; 
                    background-attachment: local;
                    background-position: center;
                    "
                >
                    <h3 class="font-bold md:ml-4 mt-4 md:mt-6 mb-1 md:mb-2">{{$post->title}}</h3>
                    <p class="text-sm self-end mr-10">{{Str::limit($post->content, 80)}}</p>
                </div>
            @empty
                <p class="text-gray-500">No hay posts comentados</p>
            @endforelse
        </div>
        
        <div x-show="activeTab === 'saved'">
            @forelse($savedPosts as $post)
                <div class="post-item flex flex-col items-center justify-center h-[20rem] md:h-[18rem] w-full md:w-[50rem] mb-4 p-2 md:p-4 rounded cursor-pointer"
                    style="
                    background-image: url('{{asset('images/texturas/PostSaved.png')}}');
                    background-size: 100% 100%;
                    background-repeat: no-repeat; 
                    background-attachment: local;
                    background-position: center;
                    ">
                    <h3 class="font-bold mb-4">{{$post->title}}</h3>
                    <p class="text-sm ml-2 mr-2">{{Str::limit($post->content, 300)}}</p>
                </div>
            @empty
                <p class="text-gray-500">No hay posts guardados</p>
            @endforelse
        </div>
    </div>
    
</div>

