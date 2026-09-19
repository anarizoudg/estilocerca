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
                        Tu cuenta de propietario se creó correctamente.
                    </p>

                    <p class="mt-1 text-sm text-gray-500">
                        Desde este panel podrás administrar la información de tu negocio en EstiloCerca.
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

            <!-- Próximamente -->
            <div class="mt-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <h3 class="text-lg font-semibold text-gray-900">
                        Tu negocio en EstiloCerca
                    </h3>

                    <p class="mt-2 text-gray-600">
                        Próximamente podrás registrar y administrar la información de tu establecimiento,
                        servicios, ubicación, fotografías y medios de contacto.
                    </p>

                </div>
            </div>

        </div>
    </div>

</x-app-layout>