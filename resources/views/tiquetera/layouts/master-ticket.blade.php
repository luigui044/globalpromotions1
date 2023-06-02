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
<body class="deep-purple-skin">

         @include('sweetalert::alert')
         <div class="container mt-3 mb-3">
            <div class="row">
                <div class="col-md-8" id="tickets">
                    @yield('content1')
                </div>
                <div class="col-md-4">
                    @yield('content2')
                </div>
            </div>
           
    
        </div>
  
        @include('variables')
        @include('tiquetera.layouts.scripts')

</body>
</html>