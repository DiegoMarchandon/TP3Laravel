<aside class="relative w-64 p-6 min-h-screen text-gray-800 bg-gradient-to-b from-yellow-100 via-yellow-200 to-yellow-100 shadow-inner border-r border-yellow-300
    dark:bg-gradient-to-b dark:from-stone-800 dark:via-stone-900 dark:to-stone-800 dark:text-gray-200 dark:border-stone-700"
    x-data="notificationDropdown()"
    x-init="init()">
    
    <!-- Línea de neón animada a lo largo del borde izquierdo -->
    <div class="hidden dark:block absolute top-0 right-0 w-[3px] h-full overflow-hidden">
        <div class="w-full h-[20%] bg-[radial-gradient(circle,_#00ffcc,_#ff00ff,_#00ffff)] blur-sm animate-neon-line"></div>
    </div>
    
    {{-- Foto de perfil y nombre de usuario --}}
    @auth
        <div class="fixed top-100 h-screen">
            <div class="relative w-[15rem] h-[15rem] flex-shrink-0">
                <img src="{{ asset('images/texturas/MarcoFoto.png') }}" class=" h-full w-full" alt="marco de foto de usuario">
                <img src="{{ Storage::url(Auth::user()->avatar) }}" class="absolute h-[8rem] w-[8rem]" alt="foto de perfil del usuario"
                style="
                bottom:4rem;
                left:3.53rem;
                ">
            </div>
            <p class="text-center text-xl font-bold">
                Hola, {{Auth::user()->name}}
            </p>
        </div>
        
        <nav class="fixed top-[30rem] h-screen w-[14rem]">
            {{-- <div class="flex-1 p-4">
                <h2 class="text-xl font-semibold mb-4">Panel de Control</h2>
                <p>Agregar notificaciones de:<br>
                    - Respuestas a comentarios.<br>
                    - Solicitud de chat.<br>
                    - Cant. interacciones de un post recién subido.<br>
                    - Solicitud de seguidor.<br>
                </p>
            </div> --}}
            <ul>
                @php
                $items = [
                    ['label' => 'Inicio', 'url' => route('home.index'),'dropdown'=>false,'chat'=>false],
                    ['label' => 'Notificaciones', 'url' => '/','dropdown'=>true,'chat'=>false],
                    ['label' => 'Perfil', 'url' => route('dashboard'),'dropdown'=>false,'chat'=>false],
                    ['label' => 'Chat', 'url' => '/','dropdown'=>false,'chat'=>true]
                ]; 
                
                @endphp

                @foreach($items as $item)
                    @if($item['dropdown'])
                        {{-- NOTIFICACIONES DROPDOWN --}}
                        <li class="relative overflow-visible">
                            <button @click="isOpen = !isOpen" class="block py-2 w-full text-left relative z-10 before:absolute before:inset-0 before:bg-gradient-to-l before:from-yellow-500 before:via-yellow-300/50 before:to-transparent before:opacity-0 hover:before:opacity-100 before:pointer-events-none before:transition-opacity before:duration-300">
                                {{ $item['label'] }} 
                                <span x-text="isOpen ? '▲' : '▼'"></span>
                            </button>
                            
                            {{-- Puntito parpadeante si hay notificaciones sin leer --}}
                            <span x-show="unreadCount > 0" 
                                class="absolute inline-block w-2 h-2 bg-red-600 rounded-full animate-pulse z-10"
                                style="top:0.7rem; right:5.5rem;">
                            </span>

                            {{-- Dropdown de notificaciones - Posicionado fijo en la pantalla --}}
                            <div x-show="isOpen"
                                @click.away="isOpen = false"
                                class="fixed bg-white dark:bg-stone-900 border-2 border-gray-700 rounded shadow-xl z-[50] max-h-96 overflow-y-auto w-80"
                                style="left: 14.5rem; top: 30rem;">
                                
                                {{-- Si hay notificaciones --}}
                                <div x-show="notifications.length > 0">
                                    <template x-for="notification in notifications" :key="notification.id">
                                        <div class="border-b p-3 bg-amber-200/50 shadow-[inset_0_0_20px_rgba(255,253,101,0.8)] hover:bg-gray-50 dark:hover:bg-stone-800"
                                            :class="notification.read_at === null ? 'bg-blue-50 dark:bg-stone-800' : ''">
                                            
                                            <!-- Mensaje principal -->
                                            <p class="text-sm font-semibold cursor-pointer" 
                                            x-text="getNotificationMessage(notification)"
                                            @click="openNotification(notification)"></p>
                                            <p class="text-xs text-gray-500" x-text="formatDate(notification.created_at)"></p>
                                            
                                            <!-- Botones para solicitudes de seguidor o chat -->
                                            <div x-show="notification.type === 'follow_request' || notification.type === 'chat_request'" class="flex gap-2 mt-2">
                                                <button @click="acceptRequest(notification)" class="flex-1 h-8 px-2 py-1 text-xs bg-green-500 text-white rounded-tl-lg rounded-br-lg hover:bg-green-600">
                                                    Aceptar
                                                </button>
                                                <button @click="deleteNotification(notification.id)" class="flex-1 h-8 rounded-tl-lg rounded-br-lg px-2 py-1 text-xs bg-red-500 text-white hover:bg-red-600">
                                                    Rechazar
                                                </button>
                                            </div>
                                        </div>
                                    </template>
                                </div>

                                {{-- Si no hay notificaciones --}}
                                <div x-show="notifications.length === 0" class="p-4 text-center text-gray-500 bg-amber-200/50 shadow-[inset_0_0_20px_rgba(255,253,101,0.8)] hover:bg-gray-50">
                                    No hay notificaciones
                                </div>

                                {{-- Botón marcar todo como leído --}}
                                <button x-show="unreadCount > 0" 
                                        @click="markAllAsRead()" 
                                        class="w-full p-2 text-sm bg-yellow-500 text-black border-2 border-solid border-black hover:bg-amber-500
                                        outline outline-3 outline-red-500  hover:outline-red-700
                                        "
                                        style="outline-offset: -6px;"
                                        >
                                    Marcar todo como leído
                                </button>
                            </div>
                        </li>
                    @elseif($item['chat'])
                        {{-- CHAT MODAL --}}
                        <li class="relative overflow-visible">
                            @include('components.chat-modal')
                        </li>
                    @else
                        {{-- ITEMS NORMALES --}}
                        <li class="relative overflow-hidden">
                            <a href="{{$item['url']}}" class="block py-2  before:absolute before:inset-0 before:bg-gradient-to-l before:from-yellow-500 before:via-yellow-300/50 before:to-transparent before:opacity-0 hover:before:opacity-100 before:pointer-events-none before:transition-opacity before:duration-300">{{$item['label']}}</a>
                        </li>
                    @endif
                @endforeach

                @if (Auth::check() && Auth::user()->role == 'admin')
                    <li><a href="/admin" class="block py-2">Admin Panel</a></li>
                @endif
            </ul>
        </nav>

    @else
    <div style="position:absolute; top: 7rem;">
        <img src="{{ asset('images/texturas/PleaseLogInLogo.png') }}" alt="logo de please log in" class="opacity-55">
        <span
         class="italic tracking-wide opacity-75" style="font-family: 'Playfair Display', serif;">
            Loguearse para acceder a las opciones
        </span>
    </div>
    @endauth
</aside>