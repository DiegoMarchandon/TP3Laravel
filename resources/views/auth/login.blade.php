<x-guest-layout >
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" >
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-black font-extrabold text-lg" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Contraseña')" class="text-black font-extrabold text-lg" />

            <x-text-input id="password" class="block mt-1 w-full focus:border-gray-800"
                type="password"
                name="password"
                required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-2 border-amber-900 border-solid bg-transparent text-yellow-600 shadow-sm focus:ring-amber-600" name="remember">
                <span class="ms-2 text-sm text-amber-800 font-bold">{{ __('Recordarme') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-900 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Olvidé mi contraseña') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Ingresar') }}
            </x-primary-button>
        </div>
        <div class="flex mt-4 justify-center underline text-sm text-amber-800 font-extrabold hover:text-gray-900">
            <a href="{{ route('register') }}">{{__('¿No tienes cuenta? Registrate')}}</a>
        </div>
    </form>
</x-guest-layout>
