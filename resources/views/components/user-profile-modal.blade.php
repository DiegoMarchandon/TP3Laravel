@props(['user'])

<div x-data="{ open:false}" class="relative inline-block">
    {{-- Trigger: El nombre clickeable --}}
    <button @click="open = !open" class="font-semibold text-blue-600 hover:underline dark:text-blue-400">
        {{$user->name}}
    </button>

    {{-- Modal flotante --}}
    <div x-show="open" 
         @click.away="open = false"
         class="absolute border-2 border-gray-300 dark:border-stone-700 rounded shadow-xl z-40 p-4 mt-2"
         style="width: 300px; height:300px; top: 100%; left: 0; background-image: url('{{ asset('images/texturas/MiniProfileModal.png') }}'); background-size: 100% 100%; background-repeat:no-repeat; background-position: center;">
        
        {{-- Foto de perfil --}}
        <div class="text-center mb-3">
            <img src="{{ Storage::url($user->avatar) }}" alt="{{ $user->name }}" class="w-16 h-16 rounded-full mx-auto mb-2">
            <h3 class="font-bold text-lg text-black drop-shadow-lg" style="font-family: 'Playfair Display'">{{ $user->name }}</h3>
        </div>

        {{-- Botones --}}
        <div class="flex gap-2">
            {{-- Botón Seguir --}}
            <form action="{{ route('users.follow', $user->id) }}" method="POST" class="flex-1">
                @csrf
                <x-fancy-button type="submit" color="yellow">
                Seguir
                </x-fancy-button>
                    
            </form>

            {{-- Botón Chat --}}
            <form action="{{ route('users.chat', $user->id) }}" method="POST" class="flex-1">
                @csrf
                <x-fancy-button type="submit" color="orange">
                Chatear
                </x-fancy-button>
            </form>
        </div>

        {{-- Información --}}
        <div class="text-sm text-black drop-shadow-md mb-3 space-y-1" style="font-family: 'Playfair Display'">
            <p class="text-center mb-2"><strong>Posts:</strong> {{ $user->posts()->count() }}</p>
            <span>
                <p class="text-center"><strong>Miembro desde:</strong></p>
                <svg width="200" height="60" viewBox="0 0 200 60">
                    <path id="curve-{{ $user->id }}" 
                        d="M 45,58.5 Q 132.5,-5 220,58.5" 
                        fill="transparent" />
                    <text font-size="14" fill="currentColor" font-weight="600">
                        <textPath href="#curve-{{ $user->id }}" startOffset="50%" text-anchor="middle">
                            {{ $user->created_at->format('d/m/Y') }}
                        </textPath>
                    </text>
                </svg>
                {{-- <p class="inline-block px-4 py-1" style="clip-path: ellipse(100% 80% at 50% 50%);"> {{ $user->created_at->format('d/m/Y') }}</p> --}}
            </span>
        </div>

    </div>
</div>