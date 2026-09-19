<x-guest-layout>

    <div class="mb-6 text-center">
        <h1 class="text-2xl font-bold text-gray-900">
            EstiloCerca
        </h1>

        <p class="mt-2 text-sm text-gray-600">
            Inicio de sesión
        </p>

        <p class="mt-1 text-sm text-gray-500">
            Ingresa a tu cuenta para administrar tu negocio.
        </p>
    </div>

    <!-- Estado de la sesión -->
    <x-auth-session-status
        class="mb-4"
        :status="session('status')"
    />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Correo electrónico -->
        <div>
            <x-input-label
                for="email"
                :value="__('Correo electrónico')"
            />

            <x-text-input
                id="email"
                class="block mt-1 w-full"
                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus
                autocomplete="username"
            />

            <x-input-error
                :messages="$errors->get('email')"
                class="mt-2"
            />
        </div>

        <!-- Contraseña -->
        <div class="mt-4">
            <x-input-label
                for="password"
                :value="__('Contraseña')"
            />

            <x-text-input
                id="password"
                class="block mt-1 w-full"
                type="password"
                name="password"
                required
                autocomplete="current-password"
            />

            <x-input-error
                :messages="$errors->get('password')"
                class="mt-2"
            />
        </div>

        <!-- Recordarme -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input
                    id="remember_me"
                    type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                    name="remember"
                >

                <span class="ms-2 text-sm text-gray-600">
                    Recordarme
                </span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-6">

            @if (Route::has('password.request'))
                <a
                    class="underline text-sm text-gray-600 hover:text-gray-900"
                    href="{{ route('password.request') }}"
                >
                    ¿Olvidaste tu contraseña?
                </a>
            @endif

            <x-primary-button class="ms-3">
                Iniciar sesión
            </x-primary-button>

        </div>

        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">
                ¿Aún no tienes una cuenta?

                <a
                    href="{{ route('register') }}"
                    class="font-medium underline text-gray-800 hover:text-gray-900"
                >
                    Regístrate como propietario
                </a>
            </p>
        </div>

    </form>

</x-guest-layout>