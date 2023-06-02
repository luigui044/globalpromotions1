<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('csrf')
    @include('usuario.layouts.styles')
    <title>Global Promotions | @yield('titulo')</title>
</head>
<body>
    @include('tiquetera.components.navbar')
    <div class="container_fluid mt-menu">
        @yield('contenido')
    </div>
    @include('usuario.layouts.scripts')
</body>
</html>