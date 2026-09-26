<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Mi establecimiento
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                EstiloCerca
            </p>
        </div>
    </x-slot>

    <div class="py-12">

        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6">

                    @if (session('success'))
                    <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-md">
                        {{ session('success') }}
                    </div>
                    @endif

                    <div class="mb-6">

                        <h3 class="text-lg font-semibold text-gray-900">
                            Información de tu negocio
                        </h3>

                        <p class="mt-1 text-sm text-gray-600">
                            Registra o actualiza los datos de tu establecimiento.
                        </p>

                    </div>

                    <form
                        method="POST"
                        action="{{ route('establishment.update') }}">

                        @csrf
                        @method('PUT')

                        <!-- Nombre -->
                        <div>

                            <x-input-label
                                for="name"
                                value="Nombre del establecimiento" />

                            <x-text-input
                                id="name"
                                name="name"
                                type="text"
                                class="block mt-1 w-full"
                                :value="old('name', $establishment?->name)"
                                required
                                autofocus />

                            <x-input-error
                                :messages="$errors->get('name')"
                                class="mt-2" />

                        </div>

                        <!-- Descripción -->
                        <div class="mt-4">

                            <x-input-label
                                for="description"
                                value="Descripción" />

                            <textarea
                                id="description"
                                name="description"
                                rows="4"
                                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $establishment?->description) }}</textarea>

                            <x-input-error
                                :messages="$errors->get('description')"
                                class="mt-2" />

                        </div>

                        <!-- Categoría -->
                        <div class="mt-4">

                            <x-input-label
                                for="category"
                                value="Categoría" />

                            <select
                                id="category"
                                name="category"
                                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                required>

                                <option value="">
                                    Selecciona una categoría
                                </option>

                                @foreach ([
                                'Barbería',
                                'Estética',
                                'Salón de uñas',
                                'Spa',
                                'Cuidado personal',
                                'Otro'
                                ] as $category)

                                <option
                                    value="{{ $category }}"
                                    @selected(
                                    old( 'category' ,
                                    $establishment?->category
                                    ) === $category
                                    )
                                    >
                                    {{ $category }}
                                </option>

                                @endforeach

                            </select>

                            <x-input-error
                                :messages="$errors->get('category')"
                                class="mt-2" />

                        </div>

                        <!-- Dirección -->
                        <div class="mt-4">

                            <x-input-label
                                for="address"
                                value="Dirección" />

                            <x-text-input
                                id="address"
                                name="address"
                                type="text"
                                class="block mt-1 w-full"
                                :value="old(
                                    'address',
                                    $establishment?->address
                                )"
                                required />

                            <x-input-error
                                :messages="$errors->get('address')"
                                class="mt-2" />

                        </div>

                        <!-- Teléfono -->
                        <div class="mt-4">

                            <x-input-label
                                for="phone"
                                value="Teléfono" />

                            <x-text-input
                                id="phone"
                                name="phone"
                                type="text"
                                class="block mt-1 w-full"
                                :value="old(
                                    'phone',
                                    $establishment?->phone
                                )" />

                        </div>

                        <!-- WhatsApp -->
                        <div class="mt-4">

                            <x-input-label
                                for="whatsapp"
                                value="WhatsApp" />

                            <x-text-input
                                id="whatsapp"
                                name="whatsapp"
                                type="text"
                                class="block mt-1 w-full"
                                :value="old(
                                    'whatsapp',
                                    $establishment?->whatsapp
                                )" />

                        </div>

                        <!-- Horarios -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

                            <div>

                                <x-input-label
                                    for="opening_time"
                                    value="Hora de apertura" />

                                <input
                                    id="opening_time"
                                    type="time"
                                    name="opening_time"
                                    class="block mt-1 w-full border-gray-300 rounded-md shadow-sm"
                                    value="{{ old(
                                        'opening_time',
                                        $establishment?->opening_time
                                            ? substr(
                                                $establishment->opening_time,
                                                0,
                                                5
                                            )
                                            : ''
                                    ) }}">

                                <x-input-error
                                    :messages="$errors->get('opening_time')"
                                    class="mt-2" />

                            </div>

                            <div>

                                <x-input-label
                                    for="closing_time"
                                    value="Hora de cierre" />

                                <input
                                    id="closing_time"
                                    type="time"
                                    name="closing_time"
                                    class="block mt-1 w-full border-gray-300 rounded-md shadow-sm"
                                    value="{{ old(
                                        'closing_time',
                                        $establishment?->closing_time
                                            ? substr(
                                                $establishment->closing_time,
                                                0,
                                                5
                                            )
                                            : ''
                                    ) }}">

                                <x-input-error
                                    :messages="$errors->get('closing_time')"
                                    class="mt-2" />

                            </div>

                        </div>

                        <div class="mt-6">

                            <x-primary-button>
                                Guardar información
                            </x-primary-button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>