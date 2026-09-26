<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>EstiloCerca</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-50 text-gray-900">

    <div class="min-h-screen flex flex-col">

        <!-- Navegación -->
        <header class="bg-white border-b border-gray-200">

            <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

                <a
                    href="{{ url('/') }}"
                    class="text-2xl font-bold text-gray-900">
                    EstiloCerca
                </a>

                <nav class="flex items-center gap-4">

                    @auth

                    <a
                        href="{{ route('dashboard') }}"
                        class="text-sm font-medium text-gray-700 hover:text-gray-900">
                        Mi panel
                    </a>

                    @else

                    <a
                        href="{{ route('login') }}"
                        class="text-sm font-medium text-gray-700 hover:text-gray-900">
                        Iniciar sesión
                    </a>

                    <a
                        href="{{ route('register') }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                        Registrar mi negocio
                    </a>

                    @endauth

                </nav>

            </div>

        </header>


        <!-- Contenido principal -->
        <main class="flex-1">

            <section class="max-w-7xl mx-auto px-6 py-24">

                <div class="max-w-3xl">

                    <p class="text-sm font-semibold uppercase tracking-wider text-gray-500">
                        Belleza y cuidado personal cerca de ti
                    </p>

                    <h1 class="mt-4 text-5xl font-bold tracking-tight text-gray-900">
                        Encuentra el servicio que buscas en EstiloCerca
                    </h1>

                    <p class="mt-6 text-lg leading-8 text-gray-600">
                        Descubre establecimientos de belleza y cuidado personal,
                        consulta sus servicios e información y encuentra la opción
                        adecuada para ti.
                    </p>

                    <div class="mt-10 flex items-center gap-4">

                        @guest

                        <a
                            href="{{ route('register') }}"
                            class="inline-flex items-center px-5 py-3 bg-gray-800 rounded-md font-semibold text-sm text-white hover:bg-gray-700">
                            Registrar mi negocio
                        </a>

                        <a
                            href="{{ route('login') }}"
                            class="text-sm font-semibold text-gray-800">
                            Ya tengo una cuenta →
                        </a>

                        @else

                        <a
                            href="{{ route('dashboard') }}"
                            class="inline-flex items-center px-5 py-3 bg-gray-800 rounded-md font-semibold text-sm text-white hover:bg-gray-700">
                            Ir a mi panel
                        </a>

                        @endguest

                    </div>

                </div>

            </section>

        </main>


        <!-- Pie -->
        <footer class="border-t border-gray-200 bg-white">

            <div class="max-w-7xl mx-auto px-6 py-6 text-sm text-gray-500">
                EstiloCerca
            </div>

        </footer>

    </div>

</body>

</html>