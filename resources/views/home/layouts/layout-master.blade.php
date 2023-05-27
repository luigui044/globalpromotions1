<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png' )}}" />

    <title>Global Promotions</title>

    @include('home.layouts.style')

</head>

<body>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <a href="https://api.whatsapp.com/send?phone=50373438825&text=Hola%21%20Quisiera%20m%C3%A1s%20informaci%C3%B3n%20sobre%20boletos." class="float" target="_blank">
    <i class="fa fa-whatsapp my-float"></i>
    </a>
    @yield('content')

    @if($mensaje = Session::get('mensaje'))
        <div class="modal fade" tabindex="-1" role="dialog" id="modal-mensaje">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Información</h4>
              </div>
              <div class="modal-body">
                <p>{{ $mensaje }}</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    @endif
    @include('variables')
    @include('home.layouts.script')
</body>

</html>