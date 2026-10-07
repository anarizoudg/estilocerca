<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Panel de propietario
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                EstiloCerca
            </p>
        </div>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Bienvenida -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900">

                    <h3 class="text-xl font-semibold">
                        ¡Bienvenido, {{ Auth::user()->name }}!
                    </h3>

                    <p class="mt-2 text-gray-600">
                        Tu cuenta de propietario está activa.
                    </p>

                    <p class="mt-1 text-sm text-gray-500">
                        Desde este panel puedes administrar la información
                        de tu negocio en EstiloCerca.
                    </p>

                </div>

            </div>

            <!-- Información de la cuenta -->
            <div class="mt-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6">

                    <h3 class="text-lg font-semibold text-gray-900">
                        Información de tu cuenta
                    </h3>

                    <div class="mt-4 space-y-3">

                        <div>

                            <p class="text-sm font-medium text-gray-500">
                                Nombre
                            </p>

                            <p class="text-gray-900">
                                {{ Auth::user()->name }}
                            </p>

                        </div>

                        <div>

                            <p class="text-sm font-medium text-gray-500">
                                Correo electrónico
                            </p>

                            <p class="text-gray-900">
                                {{ Auth::user()->email }}
                            </p>

                        </div>

                        <div>

                            <p class="text-sm font-medium text-gray-500">
                                Tipo de cuenta
                            </p>

                            <p class="text-gray-900 capitalize">
                                {{ Auth::user()->role }}
                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <!-- Administración del negocio -->
            <div class="mt-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6">

                    <h3 class="text-lg font-semibold text-gray-900">
                        Tu negocio en EstiloCerca
                    </h3>

                    @if (Auth::user()->establishment)

                    <p class="mt-2 text-gray-600">
                        Establecimiento registrado:
                    </p>

                    <p class="mt-1 font-semibold text-gray-900">
                        {{ Auth::user()->establishment->name }}
                    </p>

                    <p class="mt-2 text-sm text-gray-500">
                        Desde aquí puedes administrar la información
                        de tu establecimiento y los servicios que ofrece.
                    </p>

                    <!-- Botones disponibles cuando ya existe establecimiento -->
                    <div class="mt-4 flex flex-wrap gap-3">

                        <a
                            href="{{ route('establishment.edit') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                            Administrar mi establecimiento
                        </a>

                        <a
                            href="{{ route('services.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                            Administrar servicios
                        </a>

                    </div>

                    @else

                    <p class="mt-2 text-gray-600">
                        Aún no has registrado la información
                        de tu establecimiento.
                    </p>

                    <p class="mt-1 text-sm text-gray-500">
                        Primero debes registrar tu negocio antes
                        de poder agregar servicios.
                    </p>

                    <!-- Solo se muestra este botón si aún no existe establecimiento -->
                    <div class="mt-4">

                        <a
                            href="{{ route('establishment.edit') }}"
                            class="inline-flex items-center px-4 py-2
                                       bg-gray-800 border border-transparent
                                       rounded-md font-semibold text-xs
                                       text-white uppercase tracking-widest
                                       hover:bg-gray-700">

                            Registrar mi establecimiento

                        </a>

                    </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

</x-app-layout>