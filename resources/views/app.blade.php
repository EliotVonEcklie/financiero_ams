<!DOCTYPE html>
<html lang="es" class="!size-full">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        @routes
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @inertiaHead
    </head>
    <body class="bg-white dark:bg-gray-900 antialiased !p-0">
        @inertia
    </body>
</html>
