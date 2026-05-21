    <form action="{{route('profile.update')}}" method="POST" enctype="multipart/form-data"
        class="relative mx-auto w-full max-w-2xl p-6 md:p-8 border-2 border-black shadow-[6px_6px_0_0_rgba(0,0,0,0.8)]"
        style="
        background-image: url('{{asset('storage/texturas/selectBackground3.png')}}');
        /* background-size: cover; */
        background-repeat: no-repeat;
        background-position: center;
        font-family: 'Playfair Display', serif;
        ">
        @csrf
        @method('PUT')

        <div class="mb-6 text-center">
            <h2 class="text-2xl md:text-3xl font-extrabold tracking-wide">Editar perfil</h2>
            <p class="text-sm text-gray-700">Ajusta tus datos y tu avatar</p>
        </div>

        {{-- Avatar actual --}}
        @if (auth()->user()->avatar)
            <div class="mb-6 flex items-center gap-4 border-2 border-black bg-amber-100/70 p-3 shadow-[3px_3px_0_0_rgba(0,0,0,0.7)]">
                <div class="w-20 h-20 rounded-full overflow-hidden border-2 border-black">
                    <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="Avatar" class="w-full h-full object-cover">
                </div>
                <div>
                    <p class="text-sm font-bold">Avatar actual</p>
                    <p class="text-xs text-gray-700">Mantenelo o subi uno nuevo</p>
                </div>
            </div>
        @endif

        {{-- Campo nombre --}}
        <div class="mb-5">
            <label class="block text-sm font-extrabold tracking-wide mb-2">Nombre</label>
            <input type="text" name="name" value="{{auth()->user()->name}}"
                class="w-full bg-transparent border-0 border-b-2 border-black px-1 py-2 focus:outline-none focus:ring-0 focus:border-b-2 focus:border-amber-600"
                required>
        </div>

        {{-- Campo de email --}}
        <div class="mb-5">
            <label class="block text-sm font-extrabold tracking-wide mb-2">Email</label>
            <input type="email" name="email" value="{{auth()->user()->email}}"
                class="w-full bg-transparent border-0 border-b-2 border-black px-1 py-2 focus:outline-none focus:ring-0 focus:border-b-2 focus:border-amber-600"
                required>
        </div>

        {{-- Campo de avatar --}}
        <div class="mb-8">
            <label class="block text-sm font-extrabold tracking-wide mb-2">Avatar (Imagen de Perfil)</label>
            <input type="file" name="avatar" accept="image/*"
                class="block w-full text-sm text-gray-800 border-2 border-black bg-amber-100/70
                file:mr-4 file:py-2 file:px-4 file:border-0 file:bg-red-600 file:text-amber-100 file:font-bold
                hover:file:bg-red-700">
            <small class="text-xs text-gray-700">Maximo 2MB. Formatos: JPEG, PNG, JPG, GIF</small>
        </div>

        {{-- Botones --}}
        <div class="flex flex-wrap gap-3">
            <button type="submit"
                class="bg-red-600 text-amber-100 px-6 py-2 border-2 border-black shadow-[3px_3px_0_0_rgba(0,0,0,0.8)] hover:bg-red-700">
                Guardar cambios
            </button>
            <a href="{{ route('dashboard') }}"
                class="bg-amber-400 text-black px-6 py-2 border-2 border-black shadow-[3px_3px_0_0_rgba(0,0,0,0.8)] hover:bg-amber-500">
                Cancelar
            </a>
        </div>
    </form>