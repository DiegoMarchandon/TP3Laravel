<!DOCTYPE html>
<html lang="en" class=" dark:bg-gray-900">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    </head>
    <body class='font-sans min-h-screen antialiased text-black dark:bg-custom-dark dark:text-white'>
        @include('components.own.header')
        <div class="min-h-screen overflow-y-auto bg-with-image dark:bg-gray-900">

            <div class="flex">
                @include('components.own.sidebar')
                <main class="flex-1 p-6 bg-transparent text-gray-900 dark:text-gray-200"
                style="background-image: linear-gradient(rgba(255, 255, 255, 0.45)), url('{{ asset('storage/texturas/blogBackground.png') }}');"
                >
                    @yield('content')
                    
                </main>
            </div>
            
        </div>
        <script>
            function notificationDropdown() {
                return {
                    isOpen: false,
                    notifications: [],
                    unreadCount: 0,
                    
                    init() {
                        this.fetchNotifications();
                        // Actualizar notificaciones cada 10 segundos
                        setInterval(() => this.fetchNotifications(), 10000);
                    },
                    // LOCAL: Trae las notificaciones (y la cantidad) no leídas aún
                    fetchNotifications() {
                        fetch('/notifications')
                            .then(res => res.json())
                            .then(data => {
                                this.notifications = data;
                                this.unreadCount = data.filter(n => n.read_at === null).length;
                            })
                            .catch(err => console.error('Error fetching notifications:', err));
                    },
                    
                    getNotificationMessage(notification) {
                        const senderName = notification.sender?.name || 'Usuario';
                        
                        switch(notification.type) {
                            case 'comment_reply':
                                return `${senderName} respondió tu comentario`;
                            case 'post_interaction':
                                return `Tu post tiene nuevos likes`;
                            case 'chat_request':
                                return `${senderName} quiere interactuar contigo`;
                            case 'follow_request':
                                return `${senderName} desea seguirte`;
                            default:
                                return 'Nueva notificación';
                        }
                    },
                    
                    formatDate(date) {
                        const d = new Date(date);
                        return d.toLocaleString('es-AR', { 
                            year: 'numeric', 
                            month: 'short', 
                            day: 'numeric', 
                            hour: '2-digit', 
                            minute: '2-digit' 
                        });
                    },
                    
                    openNotification(notification) {
                        // Marcar como leído
                        if (!notification.read_at) {
                            fetch(`/notifications/${notification.id}/read`, { 
                                method: 'PATCH',
                                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
                            }).then(() => this.fetchNotifications());
                        }
                        
                        // Redirigir según tipo
                        switch(notification.type) {
                            case 'comment_reply':
                                window.location.href = `/posts/${notification.post_id}#comment-${notification.id}`;
                                break;
                            case 'post_interaction':
                                window.location.href = `/posts/${notification.post_id}`;
                                break;
                            case 'chat_request':
                            case 'follow_request':
                                // TO-DO: Ver notificación completa con botones
                                break;
                        }
                    },
                    // LOCAL: actualiza 'read_at' con la fecha en la que fue marcada como leída (actual)
                    markAllAsRead() {
                        fetch('/notifications/mark-all-read', {
                            method: 'PATCH',
                            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
                        }).then(() => this.fetchNotifications());
                    },
                    
                    // Aceptar solicitud de follow o chat
                    acceptRequest(notification) {
                        const route = notification.type === 'follow_request' 
                            ? `/notifications/${notification.id}/accept-follow`
                            : `/notifications/${notification.id}/accept-chat`;
                        
                        fetch(route, {
                            method: 'PATCH',
                            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
                        })
                        .then(res => res.json())
                        .then(() => this.fetchNotifications())
                        .catch(err => console.error('Error:', err));
                    },
                    
                    // Rechazar solicitud (eliminar notificación)
                    deleteNotification(notificationId) {
                        fetch(`/notifications/${notificationId}`, {
                            method: 'DELETE',
                            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
                        })
                        .then(res => res.json())
                        .then(() => this.fetchNotifications())
                        .catch(err => console.error('Error:', err));
                    }
                };
            }
        </script>
    </body>
</html>
