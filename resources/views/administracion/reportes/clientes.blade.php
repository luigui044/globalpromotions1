@extends('administracion.layouts.master')

@section('token')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb secondary-color">
            <li class="breadcrumb-item"><a class="white-text" href="#">Reportes</a></li>
            <li class="breadcrumb-item"><a class="white-text" href="{{ route('reporte.clientes') }}">Clientes</a></li>
        </ol>
    </nav>
    <div class="card">
        <h5 class="card-header text-white secondary-color-dark">
            <strong>Reporte de clientes</strong>
        </h5>
        <div class="card-body px-lg-5 pt-0">
            <div class="table-responsive">
                <!-- Table  -->
                <table class="table">
                    <!-- Table head -->
                    <thead>
                        <tr>
                            <th><i class="fa-solid fa-user mr-2 blue-text" aria-hidden="true"></i>Nombre</th>
                            <th><i class="fa-solid fa-envelope mr-2 blue-text" aria-hidden="true"></i>Email</th>
                            <th><i class="fa-solid fa-mobile mr-2 blue-text" aria-hidden="true"></i>Teléfono</th>
                            <th><i class="fa-solid fa-calendar-days mr-2 blue-text" aria-hidden="true"></i>Fecha registro</th>
                            <th><i class="fa-solid fa-arrow-pointer mr-2 blue-text" aria-hidden="true"></i>Acciones</th>
                        </tr>
                    </thead>
                    <!-- Table head -->

                    <!-- Table body -->
                    <tbody>
                        @foreach ($clientes as $cliente)
                            <tr>
                                <td>{{ $cliente->nombre }}</td>
                                <td>{{ $cliente->email }}</td>
                                <td>{{ $cliente->telefono}}</td>
                                <td>{{ date_format(date_create($cliente->fecha_registro), 'd-m-Y') }}</td>
                                <td>
                                    <a href="{{ route('reporte.cliente', $cliente->id_cliente) }}" class="btn btn-sm btn-primary">Detalles</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <!-- Table body -->
                </table>
                <!-- Table  -->
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
