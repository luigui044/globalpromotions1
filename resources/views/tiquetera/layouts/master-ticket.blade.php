<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('csrf')
    <title>@yield('titulo') | Global Promotions</title>
    @include('tiquetera.layouts.styles')
</head>
<body>

         @include('sweetalert::alert')
        @yield('content')
        @include('variables')
        @include('tiquetera.layouts.scripts')

</body>
</html>