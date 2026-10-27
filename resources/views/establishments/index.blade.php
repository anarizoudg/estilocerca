<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Directorio de establecimientos | EstiloCerca</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-900">

    <header class="bg-white border-b border-gray-200">

        <div class="max-w-6xl mx-auto px-6 py-5 flex justify-between items-center">

            <a
                href="{{ url('/') }}"
                class="text-xl font-bold text-gray-900">
                EstiloCerca
            </a>

            <div class="flex items-center gap-4">

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

        </div>

    </header>

    <main class="py-10">

        <div class="max-w-6xl mx-auto px-6">

            <div class="mb-8">

                <h1 class="text-3xl font-bold text-gray-900">
                    Directorio de establecimientos
                </h1>

                <p class="mt-2 text-gray-600">
                    Descubre negocios de belleza y cuidado personal disponibles en EstiloCerca.
                </p>

            </div>

            <form
                method="GET"
                action="{{ route('establishments.index') }}"
                class="mb-8">

                <div class="flex flex-col sm:flex-row gap-3">

                    <input
                        type="text"
                        name="search"
                        value="{{ $search }}"
                        placeholder="Buscar por nombre o categoría"
                        class="flex-1 rounded-md border-gray-300 shadow-sm
                   focus:border-indigo-500 focus:ring-indigo-500">

                    <button
                        type="submit"
                        class="inline-flex justify-center items-center
                   px-5 py-2 bg-gray-800 border border-transparent
                   rounded-md font-semibold text-xs text-white
                   uppercase tracking-widest hover:bg-gray-700">

                        Buscar

                    </button>

                    @if ($search !== '')

                    <a
                        href="{{ route('establishments.index') }}"
                        class="inline-flex justify-center items-center
                       px-5 py-2 bg-white border border-gray-300
                       rounded-md font-semibold text-xs text-gray-700
                       uppercase tracking-widest hover:bg-gray-50">

                        Limpiar

                    </a>

                    @endif

                </div>

            </form>

            @if ($establishments->isEmpty())

            <div class="bg-white rounded-lg shadow-sm p-10 text-center">

                @if ($search !== '')

                <p class="text-gray-600">
                    No se encontraron establecimientos para
                    "<strong>{{ $search }}</strong>".
                </p>

                @else

                <p class="text-gray-600">
                    Aún no hay establecimientos registrados.
                </p>

                @endif

            </div>

            @else

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                @foreach ($establishments as $establishment)

                <article class="bg-white rounded-lg shadow-sm p-6 flex flex-col">

                    <p class="text-sm font-medium text-indigo-600">
                        {{ $establishment->category }}
                    </p>

                    <h2 class="mt-2 text-xl font-semibold text-gray-900">
                        {{ $establishment->name }}
                    </h2>

                    @if ($establishment->description)

                    <p class="mt-3 text-gray-600 text-sm leading-relaxed">
                        {{ \Illuminate\Support\Str::limit(
                                        $establishment->description,
                                        120
                                    ) }}
                    </p>

                    @endif

                    <div class="mt-4 text-sm text-gray-500">

                        <p>
                            {{ $establishment->address }}
                        </p>

                    </div>

                    <div class="mt-auto pt-6">

                        <a
                            href="{{ route(
                                        'establishments.show',
                                        $establishment->id
                                    ) }}"
                            class="inline-flex items-center px-4 py-2
                                           bg-gray-800 border border-transparent
                                           rounded-md font-semibold text-xs
                                           text-white uppercase tracking-widest
                                           hover:bg-gray-700">

                            Ver perfil

                        </a>

                    </div>

                </article>

                @endforeach

            </div>

            @endif

            <div class="mt-10 text-center">

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