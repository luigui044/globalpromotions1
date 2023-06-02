@extends('tiquetera.layouts.layout-master')

@section('csrf')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('titulo', 'Boletos')

@section('content')
    <div class="container-fluid">

        @if (session('error'))
           {{ session('error') }}
        @endif

        @if(Auth::check())
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Cerrar sesión</button>
            </form>
        @endif

        <div class="row p-5">
            <form action="{{ route('vender',['id'=>$evento->id_evento]) }}" id="form-venta"  method="POST" class="w-100">
                @csrf
                <div class="row">
                    <div class="col-12 col-lg-4">
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
                                    <input type="hidden" name="evento" id="evento" value="{{ $evento->id_evento }}">
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
                                        <span id="subTotalDiv"></span>
                                    </div>
                                  
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-success">Total a pagar</span>
                                        <span class="text-success" id="total"></span>
                                        <input type="hidden" name="subTotal" id="subTotal">
                                        <input type="hidden" name="amount" id="amount">
                                        <input type="hidden" name="orderId" id="orderId">
                                        <input type="hidden" name="payerId" id="payerId">
                                    </div>
                                    <div id="paypal-button-container"></div>
                                    <button type="button" id="btn-desactivado-pagar" class="btn-desactivado-pagar" disabled>
                                        <img src="{{ asset('img/tarjeta.svg') }}" alt="Tarjeta" title="Tarjeta">
                                        Tarjeta de débito o crédito
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-8">
                        <div class="card h-100 p-relative">
                            @include('tiquetera.components.loader')
                            <div class="card-header text-center">
                                <strong>{{ $evento->lugar }}</strong>
                            </div>
                            <div class="card-body scrollable text-center">
                                <div id="vistaLocalidad">
                                    <img src="{{ asset($evento->imagen_lugar) }}" style="width: 50%">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/validaciones.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/zoom.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/boletos.js') }}"></script>
    <script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_SANDBOX_CLIENT_ID') }}&components=buttons,funding-eligibility&currency=USD&locale=es_SV"></script>
    <script>
        paypal.Buttons({
            fundingSource: paypal.FUNDING.CARD,
            createOrder: function(data, actions) {
                return actions.order.create({
                    application_context: {
                        shipping_preference: "NO_SHIPPING"
                    },
                    payer: {
                        email_address:   '{{ auth()->user()->email }}',
                        name:{
                        given_name: '{{ auth()->user()->first_name }}',
                        surname: '{{ auth()->user()->last_name }}'
                      }
                    },
                   
                    purchase_units: [{  
                        amount: {
                            value: $('#amount').val()
                        }
                    }],
                });
            },
            onApprove: function(data, actions) {
                $('#orderId').val(data.orderID)
                $('#payerId').val(data.payerID)
                setTimeout(() => {
                    // Cuando ya se ha procesado el pago del usuario eliminamos la suscripción del canal
                    Echo.leaveChannel(`prerreservamesa.${evento.id_evento}.${localidad.value}`);
                    document.getElementById("form-venta").submit(); 
                }, '500');
            },
            onError:  function(err){
                console.log(err)
                Swal.fire({
                    icon: 'error',
                    title: 'Ups...',
                    text: 'Algo ha ido mal'
                    })
            }
        }).render('#paypal-button-container'); 
    </script>
@endsection

