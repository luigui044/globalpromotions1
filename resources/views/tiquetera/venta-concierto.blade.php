@extends('tiquetera.layouts.layout-master')

@section('csrf')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('titulo', 'Boletos')

@section('content')
    <div class="container-fluid">
        <div class="row p-5">
            {{-- <form action="{{ route('vender',['id'=>$evento->id_evento]) }}" method="POST" class="w-100"> --}}
                <form action="{{ route('paypal.checkout') }}"  method="POST" class="w-100">
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
                                        <span id="subTotal"></span>
                                    </div>
                                  
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-success">Total a pagar</span>
                                        <span class="text-success" id="total"></span>
                                        <input type="hidden" name="amount" id="amount">
                                    </div>
                                    <div class="md-form">
                                        <input type="text" name="card_number" id="card_number"  class="form-control">
                                        <label for="card_number">Número de tarjeta</label>
                                       
                                      </div>
                                    <div class="md-form">
                                        <input type="text" name="card_holder_name" id="card_holder_name"  class="form-control">
                                        <label for="card_holder_name">Nombre de titular</label>
                                    </div>
                                     <!-- Grid row -->
                                    <div class="row">
                                        <!-- Grid column -->
                                        <div class="col">
                                        <!-- Material input -->
                                        <div class="md-form mt-0">
                                            <input type="text" name="expiration_date" id="expiration_date" class="form-control">
                                            <label for="expiration_date">Expiración</label>

                                        </div>
                                        </div>
                                        <!-- Grid column -->

                                        <!-- Grid column -->
                                        <div class="col">
                                        <!-- Material input -->
                                        <div class="md-form mt-0">
                                            <input type="text" class="form-control" id="cvv" name="cvv" >
                                            <label for="expiration_date">cvv</label>

                                        </div>
                                        </div>
                                        <!-- Grid column -->
                                    </div>
                                    <!-- Grid row -->



                                    <button type="submit" class="btn btn-success btn-sm btn-block" id="btnPagar">
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
@endsection

