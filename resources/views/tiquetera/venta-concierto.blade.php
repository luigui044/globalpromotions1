@extends('tiquetera.layouts.layout-master')

@section('csrf')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('titulo', 'Boletos')

@section('content')
    <div class="container-fluid">
        <div class="row p-5">
            <form action="{{ route('vender') }}" method="POST" class="w-100">
                @csrf
                <div class="row">
                    <div class="col-12 col-lg-3">
                        <div class="card h-100">
                            <div class="card-header">
                                <strong id="titulo">Selecciona tus boletos</strong>
                            </div>
                            <div class="card-body">
                                <div id="comprar-boletos">
                                    <span class="indicacion">Recuerda que puedes realizar únicamente una compra por persona y 8 tickets por compra.</span>
                                    <hr>
                                    <div class="form-group">
                                        <label class="mdb-main-label" for="localidad">Localidad</label>
                                        <select class="mdb-select md-form colorful-select dropdown-primary" id="localidad"
                                            name="localidad">
                                            <option value="" disabled selected>Seleccionar</option>
                                            @foreach ($localidades as $item)
                                                <option value="{{ $item->id_asignacion }}">{{ $item->nombre_localidad }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="error" id="error-localidad">
                                        </div>
                                    </div>
                                    <div id="filtrarCantidad">
                                        <div class="form-group">
                                            <label class="mdb-main-label" for="cantidad">Cantidad</label>
                                            <select disabled class="mdb-select md-form colorful-select dropdown-primary"
                                                id="cantidad" name="cantidad">
                                                <option value="" disabled selected>Seleccionar</option>
                                            </select>
                                            <div class="error" id="error-cantidad"></div>
                                        </div>
                                    </div>
                                    <a onclick="selectAsientos()" class="btn btn-info btn-sm btn-block">
                                        Continuar
                                    </a>
                                </div>
                                <div id="resumen-compra">
                                    <a class="btn btn-sm btn-block btn-rounded btn-outline-secondary waves-effect" onclick="returnSelectAs()"><i class="fas fa-arrow-circle-left"></i> Volver</a>
                                    <div class="d-flex justify-content-between mb-2 mt-4">
                                        <div>
                                            <span id="cantidad-boletos"></span>
                                            <span id="localidad-boletos"></span>
                                        </div>
                                        <div>
                                            <span id="precioUnit"></span>
                                        </div>
                                    </div>
                                    <br><br>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Subtotal</span>
                                        <span id="subTotal"></span>
                                    </div>
                                  
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-success">Total a pagar</span>
                                        <span class="text-success" id="total"></span>
                                    </div>
                                    <button type="button" class="btn btn-success btn-sm btn-block" id="btnPagar">
                                        Pagar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-9">
                        <div class="card h-100 p-relative">
                            @include('tiquetera.components.loader')
                            <div class="card-header text-center">
                                <strong>{{ $evento->lugar }}</strong>
                            </div>
                            <div class="card-body scrollable text-center">
                                <div id="vistaLocalidad">
                                    <img src="{{ asset($evento->imagen_lugar) }}" style="width: 50%">
                                </div>
                                <input type="hidden" name="selectSeats2" id="selectSeats2" value="">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/validaciones.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/boletos.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/sillas.js') }}"></script>

    <script>
        /////realizamos disparador para cuando la localidad se cambie, se actualice el select de cantidad correspondiendo a la cantidad disponible de esa localidad
        $('#localidad').change(function() {
            var id = $('#localidad option:selected').val()
            
            if(  id !==undefined){
            filtrarDisLocalidad(id)
         }
        })
        //// funcion que filtra la cantidad disponible por lo calidad, si tiene disponible igual o mas de 8, el select devolvera de 1 a 8 opciones y si es menor a 8 solo devolvera la cantidad disponible
        function filtrarDisLocalidad(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post('/filDisLocalidad', {
                    id: id
                })
                .done(function(data) {
                    $('#filtrarCantidad').html(data);
                    $("#cantidad").materialSelect();
                }).fail(function(e) {
                  
                    Swal.fire({
                        title: 'Alerta',
                        text: 'A ocurrido un error inesperado',
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    })
                });
        }
        function returnSelectAs()
        {
            var comprarBoletos = $('#comprar-boletos');
            var resumenCompra = $('#resumen-compra');
            Swal.fire({
                title: 'Al regresar se eliminara la localidad seleccionada, ¿Desea continuar?',
     
                showCancelButton: true,
                confirmButtonText: 'Continuar',
                cancelButtonText: `Cancelar`,
                }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
              
                        resetSelect('#cantidad')
                        resetSelect('#localidad')
                        $('#localidad').attr('disabled','disabled')
                         comprarBoletos.fadeIn();
                         resumenCompra.fadeOut()
                        $('#vistaLocalidad').html('<div id="vistaLocalidad">'+
                                    '<img src="{{ asset($evento->imagen_lugar) }}" style="width: 50%">'+
                                '</div>'+
                                '<input type="hidden" name="selectSeats2" id="selectSeats2" value="">')
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')
                }
                })
        }


        function resetSelect(id) {
            $(id).materialSelect('destroy');
            $(id).val('0').change();
            if( id == '#cantidad'){
                $(id).prop('disabled',true)
            }
            $(id).materialSelect();
        }

        //////funcion para filtrar mapa de localidad si es que la tiene

        function selectAsientos() {
            const localidad = $('#localidad option:selected').val()
            const localidadText = $('#localidad option:selected').text()
            const localidadIndex = $('#localidad ').index()-1;
            const cantidad = $('#cantidad option:selected').val();
            const precioUnit = localidades[localidadIndex].precio;
            const precioUnitDiv  =$('#precioUnit');
            const subTotal = precioUnit * cantidad;
            const subTotalDiv = $('#subTotal');
            const total = subTotal;
            const totalDiv = $('#total');


            
           
   
            const errores = validandoCamposEntrada();
            if (errores == 0) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.post('/selectAsientos', {
                        id: localidad
                    })
                    .done(function(data) {
                        ////se agrega la vista que retorna la funcion ajax al div vistaLocalidad
                        $('#vistaLocalidad').html(data)
                   

                        const scrollable = document.querySelector('.scrollable');
                        const contenedorUbicaciones = document.querySelector('.area-zoom');
                        const aumentar = document.querySelector('#aumentar');
                        const disminuir = document.querySelector('#disminuir');
                        ////declaro los div de compra y resumen de boletos
                        var comprarBoletos = $('#comprar-boletos');
                        var resumenCompra = $('#resumen-compra');
                        var cantidadBoletos = $('#cantidad-boletos');
                        var localidadBoletos= $('#localidad-boletos');

                        let contador = 0;

                        if (aumentar && disminuir) {

                            disminuir.disabled = true;

                            const aumentarZoomConClick = () => {
                                contador += 1;

                                switch (contador) {
                                    case 1:
                                        contenedorUbicaciones.style.transform = 'scale(140%)';
                                        disminuir.disabled = false;
                                        break;
                                    case 2:
                                        contenedorUbicaciones.style.transform = 'scale(165%)';
                                        break;
                                    case 3:
                                        contenedorUbicaciones.style.transform = 'scale(195%)';
                                        aumentar.disabled = true;
                                        break;
                                    case 4:
                                        contenedorUbicaciones.style.transform = 'scale(100%)';
                                        aumentar.disabled = false;
                                        disminuir.disabled = true;
                                        contador = 0;
                                        break;
                                }
                            }

                            const aumentarZoomConBoton = () => {
                                aumentar.disabled = false;
                                contador += 1;

                                switch (contador) {
                                    case 1:
                                        contenedorUbicaciones.style.transform = 'scale(140%)';
                                        disminuir.disabled = false;
                                        break;
                                    case 2:
                                        contenedorUbicaciones.style.transform = 'scale(165%)';
                                        break;
                                    case 3:
                                        contenedorUbicaciones.style.transform = 'scale(195%)';
                                        aumentar.disabled = true;
                                        break;
                                }
                            }

                            const disminuirZoomConBoton = () => {
                                disminuir.disabled = false;

                                switch (contador) {
                                    case 1:
                                        contenedorUbicaciones.style.transform = 'scale(100%)';
                                        disminuir.disabled = true;
                                        break;
                                    case 2:
                                        contenedorUbicaciones.style.transform = 'scale(140%)';
                                        break;
                                    case 3:
                                        contenedorUbicaciones.style.transform = 'scale(165%)';
                                        aumentar.disabled = false;
                                        break;
                                }

                                contador -= 1;
                            }

                            contenedorUbicaciones.addEventListener('dblclick', aumentarZoomConClick);
                            aumentar.addEventListener('click', aumentarZoomConBoton);
                            disminuir.addEventListener('click', disminuirZoomConBoton);

                            /* * Drag and Scroll */
                            let pos = {
                                top: 0,
                                left: 0,
                                x: 0,
                                y: 0
                            };

                            const mouseMoveHandler = (e) => {
                                const dx = e.clientX - pos.x;
                                const dy = e.clientY - pos.y;

                                // Hacer scroll hasta elemento
                                scrollable.scrollTop = pos.top - dy;
                                scrollable.scrollLeft = pos.left - dx;
                            }

                            const mouseUpHandler = () => {
                                document.removeEventListener('mousemove', mouseMoveHandler);
                                document.removeEventListener('mouseup', mouseUpHandler);
                                contenedorUbicaciones.style.cursor = 'grab';
                                contenedorUbicaciones.style.removeProperty('user-select');
                            }

                            const mouseDownHandler = (e) => {
                                contenedorUbicaciones.style.cursor = 'grabbing';
                                contenedorUbicaciones.style.userSelect = 'none';

                                pos = {
                                    // Obteniendo scroll actual
                                    top: scrollable.scrollTop,
                                    left: scrollable.scrollLeft,
                                    // Obtener la ubicación actual del mouse
                                    x: e.clientX,
                                    y: e.clientY,
                                };

                                document.addEventListener('mousemove', mouseMoveHandler);
                                document.addEventListener('mouseup', mouseUpHandler);
                            }

                            contenedorUbicaciones.addEventListener('mousedown', mouseDownHandler);
                            
                        }

                        cantidadBoletos.html(cantidad)
                        localidadBoletos.html(localidadText)
                        precioUnitDiv.html('$'+precioUnit)
                        subTotalDiv.html('$'+subTotal.toFixed(2))
                        totalDiv.html('$'+total.toFixed(2))
                        /////desaparesco el div de compra de boletos y muestro el resumen
                        comprarBoletos.fadeOut();
                        resumenCompra.fadeIn();
                    });

            }
        }

        
    </script>
@endsection

