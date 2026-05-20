<div x-data="chatDropdown()" x-init="init()" @mousemove="handleDrag($event)" @mouseup="stopDrag()" class="relative">
    <!-- Botón para abrir chat -->
    <button @click="isOpen = !isOpen" class="block py-2 w-full text-left relative z-10 before:absolute before:inset-0 before:bg-gradient-to-l before:from-yellow-500 before:via-yellow-300/50 before:to-transparent before:opacity-0 hover:before:opacity-100 before:pointer-events-none before:transition-opacity before:duration-300">
        Chat
        <span x-text="isOpen ? '▲' : '▼'"></span>
    </button>

    <!-- Modal de chat -->
    <div x-show="isOpen"
        @click.away="isOpen = false"
        class="fixed border-2 border-gray-700 rounded shadow-xl z-[50] w-96 h-[500px] flex flex-col"
        :style="{ 
            left: posX + 'px', 
            top: posY + 'px', 
            cursor: isDragging ? 'grabbing' : 'default',
            // backgroundImage: 'linear-gradient(135deg, rgba(254, 243, 199, 0.85) 0%, rgba(254, 215, 170, 0.85) 50%, rgba(254, 243, 199, 0.85) 100%)',
            // backgroundColor: '#fef3c7'
        }">
        
        <!-- Encabezado -->
        <div @mousedown="startDrag($event)" class="p-3 border-b border-gray-300 dark:border-stone-700 bg-yellow-400 dark:bg-stone-800 cursor-grab active:cursor-grabbing select-none">
            <h3 class="font-bold text-sm">Mis Chats</h3>
        </div>

        <!-- Contenedor principal: lista + mensajes -->
        <div class="flex flex-1 overflow-hidden">
            
            <!-- Panel izquierdo: Lista de chats -->
            <div class="w-1/3 border-r border-gray-300 dark:border-stone-700 overflow-y-auto">
                <div x-show="chats.length > 0">
                    <template x-for="chat in chats" :key="chat.id">
                        <button @click="selectChat(chat)" 
                            :class="selectedChat?.id === chat.id ? 'bg-yellow-500 dark:bg-stone-700' : 'bg-gray-100 dark:bg-stone-900'"
                            class="w-full p-2 text-left text-xs border-b border-gray-200 dark:border-stone-800 hover:bg-yellow-400 dark:hover:bg-stone-700">
                            <p class="font-semibold" x-text="chat.otherUser.name"></p>
                            <p class="text-gray-500 text-xs truncate" x-text="chat.lastMessage || 'Sin mensajes'"></p>
                        </button>
                    </template>
                </div>

                <div x-show="chats.length === 0" class="p-4 text-center text-gray-500 text-xs">
                    No hay chats aceptados
                </div>
            </div>

            <!-- Panel derecho: Mensajes -->
            <div class="w-2/3 flex flex-col bg-yellow-300/30">
                <div x-show="!selectedChat" class="flex-1 flex items-center justify-center text-gray-600 font-bold text-sm">
                    Selecciona un chat
                </div>

                <div x-show="selectedChat" class="flex flex-col h-full">
                    <!-- Mensajes -->
                    <div class="flex-1 overflow-y-auto p-3 space-y-2 dark:bg-stone-800">
                        <template x-for="message in messages" :key="message.id">
                            <div :class="message.sender_id === currentUserId ? 'justify-end' : 'justify-start'" class="flex">
                                <div :class="message.sender_id === currentUserId ? 'bg-[#FFFF00] border-2 border-black text-black rounded-tl-lg rounded-br-lg' : 'bg-gray-200 dark:bg-stone-700 text-black dark:text-white rounded-tr-lg rounded-bl-lg'"
                                    class="px-3 py-2 text-xs max-w-[200px] break-words">
                                    <p x-text="message.content"></p>
                                    <p class="text-xs mt-1 opacity-75" x-text="formatTime(message.created_at)"></p>
                                </div>
                            </div>
                        </template>
                    </div>

                    <!-- Input para enviar -->
                    <div class="p-2 border-t border-gray-300 dark:border-stone-700">
                        <form @submit.prevent="sendMessage()" class="flex gap-1">
                            <input type="text" x-model="messageContent" placeholder="Escribe un mensaje..." 
                                class="flex-1 text-xs px-2 py-1 border border-gray-300 rounded dark:bg-stone-800 dark:border-stone-600 dark:text-white">
                            <button type="submit" class="px-3 py-1 text-xs bg-amber-500 text-white rounded hover:bg-blue-600">
                                Enviar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function chatDropdown() {
    return {
        isOpen: false,
        chats: [],
        selectedChat: null,
        messages: [],
        messageContent: '',
        currentUserId: {{ Auth::id() }},
        
        // Propiedades para drag
        isDragging: false,
        dragOffsetX: 0,
        dragOffsetY: 0,
        posX: 300,
        posY: 180,

        init() {
            this.fetchChats();
            // Actualizar cada 5 segundos
            setInterval(() => {
                if (this.selectedChat) {
                    this.fetchMessages(this.selectedChat.id);
                }
            }, 5000);
        },

        fetchChats() {
            fetch('/chats')
                .then(res => res.json())
                .then(data => {
                    this.chats = data;
                })
                .catch(err => console.error('Error fetching chats:', err));
        },

        selectChat(chat) {
            this.selectedChat = chat;
            this.fetchMessages(chat.id);
        },

        fetchMessages(chatId) {
            fetch(`/chats/${chatId}/messages`)
                .then(res => res.json())
                .then(data => {
                    this.messages = data;
                    // Auto-scroll al final
                    setTimeout(() => {
                        document.querySelector('[x-ref="messagesContainer"]')?.scrollTo(0, document.querySelector('[x-ref="messagesContainer"]').scrollHeight);
                    }, 100);
                })
                .catch(err => console.error('Error fetching messages:', err));
        },

        sendMessage() {
            if (!this.messageContent.trim() || !this.selectedChat) return;

            fetch(`/chats/${this.selectedChat.id}/messages`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ content: this.messageContent })
            })
            .then(res => res.json())
            .then(() => {
                this.messageContent = '';
                this.fetchMessages(this.selectedChat.id);
            })
            .catch(err => console.error('Error sending message:', err));
        },

        // Métodos para drag
        startDrag(e) {
            this.isDragging = true;
            this.dragOffsetX = e.clientX - this.posX;
            this.dragOffsetY = e.clientY - this.posY;
        },

        handleDrag(e) {
            if (!this.isDragging) return;
            this.posX = e.clientX - this.dragOffsetX;
            this.posY = e.clientY - this.dragOffsetY;
        },

        stopDrag() {
            this.isDragging = false;
        },

        formatTime(date) {
            const d = new Date(date);
            return d.toLocaleTimeString('es-AR', { hour: '2-digit', minute: '2-digit' });
        }
    };
}
</script>
