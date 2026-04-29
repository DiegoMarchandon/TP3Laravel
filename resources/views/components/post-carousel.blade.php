@props(['posts', 'reactions'])

<div x-data="carousel()" class="w-full">
    <div class="relative">
        {{-- Contenedor del carrusel --}}
        <div class="overflow-hidden rounded-lg shadow-lg">
            <div class="flex transition-transform duration-500 ease-in-out" :style="`transform: translateX(-${current * 100}%)`">
                @forelse($posts as $post)
                    <div class="min-w-full" role="listitem">
                        <x-post-card :post="$post" :reactions="$reactions" />
                    </div>
                @empty
                    <div class="min-w-full p-8 text-center">
                        <p class="text-gray-500 dark:text-gray-400">No hay posts para mostrar</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Botones de navegación --}}
        @if($posts->count() > 1)
            <button @click="prev()" class="absolute top-1/2 -translate-y-1/2 bg-blue-600 hover:bg-blue-700 text-white rounded-full p-2 transition" style="left: 21.5rem; transform: translateY(-50%);">
                &#10094;
            </button>
            <button @click="next()" class="absolute top-1/2 -translate-y-1/2 bg-blue-600 hover:bg-blue-700 text-white rounded-full p-2 transition" style="right: 21.5rem; transform: translateY(-50%);">
                &#10095;
            </button>

            {{-- Indicadores de posición --}}
            <div class="flex justify-center gap-2 mt-4">
                @for($i = 0; $i < $posts->count(); $i++)
                    <button 
                        @click="current = {{ $i }}"
                        :class="current === {{ $i }} ? 'bg-blue-600' : 'bg-gray-400'"
                        class="w-2 h-2 rounded-full transition"
                    ></button>
                @endfor
            </div>
        @endif
    </div>
</div>

<script>
function carousel() {
    return {
        current: 0,
        next() {
            const total = document.querySelectorAll('[role="listitem"]').length || 1;
            this.current = (this.current + 1) % total;
        },
        prev() {
            const total = document.querySelectorAll('[role="listitem"]').length || 1;
            this.current = (this.current - 1 + total) % total;
        }
    }
}
</script>
