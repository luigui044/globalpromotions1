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
                                    <span class="indicacion">Recuerda que puedes realizar únicamente una compra por persona
                                        y 8
                                        tickets por compra.</span>
                                    <hr>
                                    <div class="form-group">
                                        <label class="mdb-main-label" for="localidad">Localidad</label>
                                        <select class="mdb-select md-form colorful-select dropdown-primary" id="localidad"
                                            name="localidad">
                                            <option value="" disabled selected>Seleccionar</option>
                                            <option value="1">Mesa Black</option>
                                            <option value="2">Palco</option>
                                            <option value="3">Silla VIP</option>
                                            <option value="4">Dance Floor</option>
                                        </select>
                                        <div class="error" id="error-localidad">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="mdb-main-label" for="cantidad">Cantidad</label>
                                        <select class="mdb-select md-form colorful-select dropdown-primary" id="cantidad"
                                            name="cantidad">
                                            <option value="" disabled selected>Seleccionar</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                        <div class="error" id="error-cantidad"></div>
                                    </div>
                                    <button type="button" id="btn-boletos" class="btn btn-info btn-sm btn-block">
                                        Continuar
                                    </button>
                                </div>
                                <div id="resumen-compra">
                                    <div class="d-flex justify-content-between mb-2">
                                        <div>
                                            <span id="cantidad-boletos"></span>
                                            <span>Mesa Black</span>
                                        </div>
                                        <div>
                                            <span id="precio">$150.00</span>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Subtotal</span>
                                        <span id="subtotal"></span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-info">Descuento</span>
                                        <span class="text-info" id="descuento">$0.00</span>
                                    </div>
                                    {{-- <div class="d-flex justify-content-between mb-2">
                                        <span>Recargos</span>
                                        <span id="recargos">$24.00</span>
                                    </div> --}}
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
                            <div class="card-body scrollable">
                                @include('tiquetera.desplegarmesas')
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
    <script type="text/javascript" src="{{ asset('js/zoom.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/validaciones.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/boletos.js') }}"></script>
@endsection
