<div class="mt-6 space-y-4">
    @foreach($users as $user)
        <div class="bg-white shadow rounded p-4 max-w-2xl w-full mx-auto break-words">
            <h2 class="text-lg font-semibold">{{ $user->name }}</h2>
            <p class="text-sm text-gray-500">Email: {{ $user->email }}</p>
            <p class="text-sm text-gray-500">Rol: {{ $user->role }}</p>
            <p class="text-sm text-gray-500">Registrado el: {{ $user->created_at->format('d/m/Y') }}</p>
            @if($user->role !== 'admin')
                <form action="{{ route('admin.users.state', $user->id) }}" method="POST" class="mt-4 inline-block">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="text-blue-500 hover:underline">
                        {{ $user->habilitated ? 'Deshabilitar usuario' : 'Habilitar usuario' }}
                    </button>
                </form>
            @endif
        </div>
    @endforeach
</div>