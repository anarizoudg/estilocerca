<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Mis servicios
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                {{ $establishment->name }}
            </p>
        </div>
    </x-slot>

    <div class="py-12">

        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
            <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-md">
                {{ session('success') }}
            </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6">

                    <div class="flex items-center justify-between mb-6">

                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">
                                Servicios del establecimiento
                            </h3>

                            <p class="mt-1 text-sm text-gray-600">
                                Administra los servicios que ofrece tu negocio.
                            </p>
                        </div>

                        <a
                            href="{{ route('services.create') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                            Agregar servicio
                        </a>

                    </div>

                    @if ($services->isEmpty())

                    <div class="py-8 text-center">

                        <p class="text-gray-600">
                            Aún no has registrado servicios.
                        </p>

                        <p class="mt-1 text-sm text-gray-500">
                            Utiliza el botón "Agregar servicio" para registrar el primero.
                        </p>

                    </div>

                    @else

                    <div class="overflow-x-auto">

                        <table class="min-w-full divide-y divide-gray-200">

                            <thead class="bg-gray-50">
                                <tr>

                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                        Servicio
                                    </th>

                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                        Descripción
                                    </th>

                                    <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">
                                        Precio
                                    </th>

                                    <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">
                                        Acciones
                                    </th>

                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200">

                                @foreach ($services as $service)

                                <tr>

                                    <td class="px-4 py-4 text-sm font-medium text-gray-900">
                                        {{ $service->name }}
                                    </td>

                                    <td class="px-4 py-4 text-sm text-gray-600">
                                        {{ $service->description ?: 'Sin descripción' }}
                                    </td>

                                    <td class="px-4 py-4 text-sm text-gray-900 text-right">

                                        @if ($service->price !== null)
                                        ${{ number_format((float) $service->price, 2) }}
                                        @else
                                        No especificado
                                        @endif

                                    </td>

                                    <td class="px-4 py-4 text-sm text-right">

                                        <div class="flex justify-end items-center gap-3">

                                            <a
                                                href="{{ route('services.edit', $service->id) }}"
                                                class="text-indigo-600 hover:text-indigo-900">
                                                Editar
                                            </a>

                                            <form
                                                method="POST"
                                                action="{{ route('services.destroy', $service->id) }}"
                                                onsubmit="return confirm('¿Deseas eliminar este servicio?');">

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="text-red-600 hover:text-red-900">
                                                    Eliminar
                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                    @endif

                    <div class="mt-6">

                        <a
                            href="{{ route('dashboard') }}"
                            class="text-sm text-gray-600 hover:text-gray-900">
                            ← Volver al panel
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>