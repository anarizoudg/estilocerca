<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $establishment->name }} | EstiloCerca</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-900">

    <!-- Encabezado -->
    <header class="bg-white border-b border-gray-200">

        <div class="max-w-5xl mx-auto px-6 py-5 flex justify-between items-center">

            <a
                href="{{ url('/') }}"
                class="text-xl font-bold text-gray-900">

                EstiloCerca

            </a>

            @auth

            <a
                href="{{ route('dashboard') }}"
                class="text-sm text-gray-600 hover:text-gray-900">

                Mi panel

            </a>

            @else

            <a
                href="{{ route('login') }}"
                class="text-sm text-gray-600 hover:text-gray-900">

                Iniciar sesión

            </a>

            @endauth

        </div>

    </header>

    <main class="py-10">

        <div class="max-w-5xl mx-auto px-6">

            <!-- Datos principales -->
            <section class="bg-white shadow-sm rounded-lg p-8">

                <div class="border-b border-gray-200 pb-6">

                    <p class="text-sm font-medium text-indigo-600">
                        {{ $establishment->category }}
                    </p>

                    <h1 class="mt-2 text-3xl font-bold text-gray-900">
                        {{ $establishment->name }}
                    </h1>

                    @if ($establishment->description)

                    <p class="mt-4 text-gray-600 leading-relaxed">
                        {{ $establishment->description }}
                    </p>

                    @endif

                </div>

                <!-- Información -->
                <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>

                        <h2 class="font-semibold text-gray-900">
                            Dirección
                        </h2>

                        <p class="mt-1 text-gray-600">
                            {{ $establishment->address }}
                        </p>

                    </div>

                    @if ($establishment->phone)

                    <div>

                        <h2 class="font-semibold text-gray-900">
                            Teléfono
                        </h2>

                        <p class="mt-1 text-gray-600">
                            {{ $establishment->phone }}
                        </p>

                    </div>

                    @endif

                    @if ($establishment->whatsapp)

                    <div>

                        <h2 class="font-semibold text-gray-900">
                            WhatsApp
                        </h2>

                        <p class="mt-1 text-gray-600">
                            {{ $establishment->whatsapp }}
                        </p>

                    </div>

                    @endif

                    @if ($establishment->opening_time || $establishment->closing_time)

                    <div>

                        <h2 class="font-semibold text-gray-900">
                            Horario
                        </h2>

                        <p class="mt-1 text-gray-600">

                            @if ($establishment->opening_time)
                            {{ substr($establishment->opening_time, 0, 5) }}
                            @endif

                            @if ($establishment->opening_time && $establishment->closing_time)
                            -
                            @endif

                            @if ($establishment->closing_time)
                            {{ substr($establishment->closing_time, 0, 5) }}
                            @endif

                        </p>

                    </div>

                    @endif

                </div>

            </section>

            <!-- Servicios -->
            <section class="mt-8 bg-white shadow-sm rounded-lg p-8">

                <h2 class="text-2xl font-semibold text-gray-900">
                    Servicios
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Servicios disponibles en este establecimiento.
                </p>

                @if ($establishment->services->isEmpty())

                <div class="mt-6 py-8 text-center">

                    <p class="text-gray-600">
                        Este establecimiento todavía no ha publicado servicios.
                    </p>

                </div>

                @else

                <div class="mt-6 space-y-4">

                    @foreach ($establishment->services as $service)

                    <div class="border border-gray-200 rounded-lg p-5">

                        <div class="flex justify-between items-start gap-6">

                            <div>

                                <h3 class="text-lg font-semibold text-gray-900">
                                    {{ $service->name }}
                                </h3>

                                @if ($service->description)

                                <p class="mt-2 text-gray-600">
                                    {{ $service->description }}
                                </p>

                                @endif

                            </div>

                            @if ($service->price !== null)

                            <div class="text-lg font-semibold text-gray-900 whitespace-nowrap">

                                ${{ number_format((float) $service->price, 2) }}

                            </div>

                            @endif

                        </div>

                    </div>

                    @endforeach

                </div>

                @endif

            </section>

            <div class="mt-8 text-center">

                <a
                    href="{{ url('/') }}"
                    class="text-sm text-gray-600 hover:text-gray-900">

                    ← Volver a EstiloCerca

                </a>

            </div>

        </div>

    </main>

</body>

</html>