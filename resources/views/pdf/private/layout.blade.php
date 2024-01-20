<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <script src="https://cdn.tailwindcss.com?plugins=typography,aspect-ratio,line-clamp"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
        @yield('head')
    </head>
    <body class="bg-white dark:bg-gray-900 antialiased !p-0">
        @yield('content')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    </body>
</html>
