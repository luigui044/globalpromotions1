@extends('administracion.layouts.master')

@section('token')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb secondary-color">
            <li class="breadcrumb-item"><a class="white-text" href="#">Reportes</a></li>
            <li class="breadcrumb-item"><a class="white-text" href="{{ route('reporte.ventas') }}">Ventas</a></li>
        </ol>
    </nav>
    <div class="card">
        <h5 class="card-header text-white secondary-color-dark">
            <strong>Reporte de ventas</strong>
        </h5>
        <div class="card-body px-lg-5 pt-0">
            <form id="frm-evento">
                @csrf
                <div class="form-group">
                    <label for="id_evento">Seleccione un evento:</label>
                    <select class="mdb-select md-form" id="id_evento" name="id_evento" searchable="Search here..">
                        @foreach ($eventos as $evento)
                            <option value="{{ $evento->id_evento }}">{{ $evento->titulo_evento }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="chk-fechas">
                    <label class="custom-control-label" for="chk-fechas">Seleccionar rango de fechas y horas</label>
                </div>
                <div class="form-group mt-3" id="contenedor-fechas">
                    <input type="text" id="fechas-reporte" class="form-control"
                        placeholder="Rango de fechas y horas" readonly>
                    <input type="hidden" name="fechas_reporte" id="submit-fechas" disabled>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-check mr-2"></i>
                    Generar
                </button>
            </form>
        </div>
    </div>
    <div id="contenedor-loader">
    </div>
    <div class="card mt-4 mb-5 d-none" id="contenedor-reporte">
        <h5 class="card-header text-white secondary-color-dark">
            <strong>Detalles del reporte</strong>
        </h5>
        <div class="card-body px-lg-5 pt-0">
            <h5 class="card-header text-white mt-3">
                <strong>Entradas comerciales</strong>
            </h5>
            <div class="table-responsive">
                <!-- Table  -->
                <table class="table table-striped table-hover table-sm">
                    <!-- Table head -->
                    <thead>
                        <tr>
                            <th><i class="fa-solid fa-location-pin mr-2 blue-text" aria-hidden="true"></i>Localidad</th>
                            <th><i class="fa-solid fa-dollar-sign mr-2 teal-text" aria-hidden="true"></i>Precio</th>
                            <th><i class="fa-solid fa-ticket mr-2 indigo-text" aria-hidden="true"></i>Cantidad de entradas
                                vendidas</th>
                            <th><i class="fa-solid fa-sack-dollar mr-2 teal-text" aria-hidden="true"></i>Total</th>
                        </tr>
                    </thead>
                    <!-- Table head -->

                    <!-- Table body -->
                    <tbody id="tbody-venta-localidad">
                    </tbody>
                    <!-- Table body -->
                </table>
                <!-- Table  -->
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/reportes/ventas-localidad.js') }}"></script>
@endsection
