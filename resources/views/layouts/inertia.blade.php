<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        @routes
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @inertiaHead
    </head>
    <body class="bg-white dark:bg-gray-900 antialiased !p-0">
        @inertia
    </body>
</html>
