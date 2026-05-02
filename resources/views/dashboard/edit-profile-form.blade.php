    <form action="{{route('profile.update')}}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')

        {{-- Avatar actual --}}
        @if (auth()->user()->avatar)
            <div class="mb-4">
                <p class="font-semibold mb-2">Avatar actual:</p>
                <img src="{{Storage::url(auth()->user()->avatar)}}" alt="Avatar" class="w-24 h-24 rounded-full">
            </div>
        @endif

        {{-- Campo nombre --}}
        <div class="mb-4">
            <label class="block font-semibold mb-2">Nombre</label>
            <input type="text" name="name" value="{{auth()->user()->name}}" class="w-full border rounded px-3 py-2" required>
        </div>

        {{-- Campo de email --}}
        <div class="mb-4">
            <label class="block font-semibold mb-2">Email</label>
            <input type="email" name="email" value="{{auth()->user()->email}}" class="w-full border rounded px-3 py-2" required>
        </div>

        {{-- Campo de avatar --}}
        <div class="mb-6">
            <label class="block font-semibold mb-2">Avatar (Imagen de Perfil)</label>
            <input type="file" name="avatar" accept="image/*" class="w-full border rounded px-3 py-2">
            <small class="text-gray-500">Máximo 2MB. Formatos: JPEG, PNG, JPG, GIF</small>
        </div>

        {{-- Botones --}}
        <div class="flex gap-4">
            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">
                Guardar cambios
            </button>
            <a href="{{ route('dashboard') }}" class="bg-gray-400 text-white px-6 py-2 rounded hover:bg-gray-500">
                Cancelar
            </a>
        </div>
    </form>