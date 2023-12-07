<!DOCTYPE html>
<html lang="es">
    <head>
        <title>@yield('title')</title>
    </head>
    <body>
        <div class="flex flex-row h-28 shrink-0 items-end justify-center bg-gray-50 p-4 md:h-28 sticky top-0">
            <a href="{{ route('app.predios') }}">
                <img src="{{ asset('img/escudo.png') }}" alt="Imagen del escudo" width=75 height=75>
            </a>

            <div class='pl-2 md:pl-5'>
                <h1 class="text-sm font-bold md:text-xl">
                    ALCALDIA MUNICIPAL DE VILLAVICENCIO META
                </h1>
                <h3 class="text-xs text-gray-500 md:text-sm">
                    Secretaría de Hacienda Municipal y del Tesoro
                </h3>
            </div>
        </div>
 
        <main class="container">
            @yield('content')
        </main>
    </body>
</html>
