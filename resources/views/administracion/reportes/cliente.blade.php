@extends('administracion.layouts.master')

@section('content')
    <div class="card mb-5">
        <h5 class="card-header text-white secondary-color-dark">
            <strong>Detalles de cliente</strong>
        </h5>
        <div class="card-body px-lg-5 pt-0">
            <div class="table-responsive">
                <!-- Table  -->
                <table class="table table-striped table-sm table-hover">
                    <!-- Table head -->
                    <thead>
                        <tr>
                            <th><i class="fa-solid fa-user mr-2 blue-text" aria-hidden="true"></i>Nombre</th>
                            <th><i class="fa-solid fa-envelope mr-2 blue-text" aria-hidden="true"></i>Email</th>
                            <th><i class="fa-solid fa-mobile mr-2 blue-text" aria-hidden="true"></i>Teléfono</th>
                            <th><i class="fa-solid fa-calendar-days mr-2 blue-text" aria-hidden="true"></i>Fecha registro</th>
                        </tr>
                    </thead>
                    <!-- Table head -->

                    <!-- Table body -->
                    <tbody>
                        <tr>
                            <td>{{ $cliente->name }}</td>
                            <td>{{ $cliente->email }}</td>
                            <td>{{ $cliente->telefono}}</td>
                            <td>{{ date_format(date_create($cliente->created_at), 'd-m-Y') }}</td>
                        </tr>
                    </tbody>
                    <!-- Table body -->
                </table>
                <!-- Table  -->
            </div>
            <hr>
            <h5 class="text-indigo mt-4 mb-4">Compras realizadas</h5>
            <h6 class="indigo-text"><b>Total de compras: {{ $ventas->total() }}</b></h6>
            <div class="table-responsive">
               <div class="mt-4">
                {{ $ventas->links() }}
               </div>
                <!-- Table  -->
                <table class="table table-hover table-striped table-sm">
                    <!-- Table head -->
                    <thead>
                        <tr>
                            <th><i class="fa-solid fa-star mr-2 blue-text" aria-hidden="true"></i>Evento</th>
                            <th><i class="fa-solid fa-sack-dollar mr-2 blue-text" aria-hidden="true"></i>Total</th>
                            <th><i class="fa-solid fa-calendar mr-2 blue-text" aria-hidden="true"></i>Fecha</th>
                            <th><i class="fa-solid fa-arrow-pointer mr-2 blue-text" aria-hidden="true"></i>Acciones</th>
                        </tr>
                    </thead>
                    <!-- Table head -->

                    <!-- Table body -->
                    <tbody>
                        @foreach ($ventas as $venta)
                            <tr>
                                <td>{{ $venta->evento }}</td>
                                <td><i class="fa-solid fa-dollar-sign mr-2 teal-text" aria-hidden="true"></i>{{ number_format($venta->total,2) }}</td>
                                <td>{{ date_format(date_create($venta->fecha), 'd-m-Y') }}</td>
                                <td>
                                    <a href="{{ route('reporte.cliente.venta', ['idVenta'=>$venta->id_venta, 'idCliente'=>$venta->id_cliente]) }}" class="btn btn-sm btn-primary">Detalles</a>
                                </td>
                            </tr> 
                        @endforeach
                    </tbody>
                    <!-- Table body -->
                </table>

                {{ $ventas->links() }}
                <!-- Table  -->
            </div>
            <a href="{{ route('reporte.clientes') }}" class="btn btn-info">
                <i class="fa-solid fa-arrow-left mr-2"></i>
                Volver
            </a>
        </div>
    </div>
@endsection
