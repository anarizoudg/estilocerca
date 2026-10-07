<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Agregar servicio
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                {{ $establishment->name }}
            </p>
        </div>
    </x-slot>

    <div class="py-12">

        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6">

                    <div class="mb-6">

                        <h3 class="text-lg font-semibold text-gray-900">
                            Información del servicio
                        </h3>

                        <p class="mt-1 text-sm text-gray-600">
                            Registra un servicio ofrecido por tu establecimiento.
                        </p>

                    </div>

                    <form
                        method="POST"
                        action="{{ route('services.store') }}">

                        @csrf

                        <div>

                            <x-input-label
                                for="name"
                                value="Nombre del servicio" />

                            <x-text-input
                                id="name"
                                name="name"
                                type="text"
                                class="block mt-1 w-full"
                                :value="old('name')"
                                required
                                autofocus />

                            <x-input-error
                                :messages="$errors->get('name')"
                                class="mt-2" />

                        </div>

                        <div class="mt-4">

                            <x-input-label
                                for="description"
                                value="Descripción" />

                            <textarea
                                id="description"
                                name="description"
                                rows="4"
                                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description') }}</textarea>

                            <x-input-error
                                :messages="$errors->get('description')"
                                class="mt-2" />

                        </div>

                        <div class="mt-4">

                            <x-input-label
                                for="price"
                                value="Precio" />

                            <x-text-input
                                id="price"
                                name="price"
                                type="number"
                                min="0"
                                step="0.01"
                                class="block mt-1 w-full"
                                :value="old('price')" />

                            <x-input-error
                                :messages="$errors->get('price')"
                                class="mt-2" />

                            <p class="mt-1 text-sm text-gray-500">
                                Puedes dejar el precio vacío si no deseas especificarlo.
                            </p>

                        </div>

                        <div class="mt-6 flex items-center gap-4">

                            <x-primary-button>
                                Guardar servicio
                            </x-primary-button>

                            <a
                                href="{{ route('services.index') }}"
                                class="text-sm text-gray-600 hover:text-gray-900">
                                Cancelar
                            </a>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>