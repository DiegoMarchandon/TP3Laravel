<aside class="relative w-64 p-6 text-gray-800 bg-gradient-to-b from-yellow-100 via-yellow-200 to-yellow-100 shadow-inner border-r border-yellow-300
    dark:bg-gradient-to-b dark:from-stone-800 dark:via-stone-900 dark:to-stone-800 dark:text-gray-200 dark:border-stone-700">
    
    <!-- Línea de neón animada a lo largo del borde izquierdo -->
    <div class="hidden dark:block absolute top-0 right-0 w-[3px] h-full overflow-hidden">
        <div class="w-full h-[20%] bg-[radial-gradient(circle,_#00ffcc,_#ff00ff,_#00ffff)] blur-sm animate-neon-line"></div>
    </div>
            
    <nav>
        <div class="flex-1 p-4">
            <h2 class="text-xl font-semibold mb-4">Panel de Control</h2>
            <p>Bienvenido al panel de control. Aquí puedes gestionar tu contenido.</p>
        </div>
        <ul>
            <li><a href="/" class="block py-2">Inicio</a></li>
            <li><a href="/dashboard" class="block py-2">Dashboard</a></li>
            @if (Auth::check() && Auth::user()->role == 'admin')
                <li><a href="/admin" class="block py-2">Admin Panel</a></li>
            @endif
        </ul>
    </nav>
</aside>