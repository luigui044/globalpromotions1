<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('token')
    <title>Global Promotions @yield('title')</title>
    @include('administracion.layouts.style')
</head>
<body class="fixed-sn deep-purple-skin">

    <!--Double navigation-->
    <header>
      @include('administracion.componentes.sidebar')
      @include('administracion.componentes.navbar')
    </header>
    <!--/.Double navigation-->
  
    <!--Main Layout-->
    <main>
        @yield('content')

      @yield('modal')
    </main>
    <!--Main Layout-->
    @include('administracion.layouts.script')
</body>
</html>