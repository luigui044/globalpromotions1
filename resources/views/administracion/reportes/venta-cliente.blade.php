@extends('administracion.layouts.master')

@section('content')
    <div class="card mb-5">
        <h5 class="card-header text-white secondary-color-dark">
            <strong>Detalles de la venta</strong>
        </h5>
        <div class="card-body px-lg-5 pt-0">
            <h5 class="indigo-text mb-4 mt-4"><b>Cantidad de boletos comprados: {{ $detalle->count() }}</b></h5>
            <hr>
            @foreach ($detalle as $d)
                <h6 class="indigo-text">
                    <div class="detalle-icono">
                        <i class="fa-solid fa-star yellow-text"></i>
                    </div>
                    <b>Evento: </b> {{ $d->evento }}
                </h6>
                <h6 class="indigo-text">
                    <div class="detalle-icono">
                        <i class="fa-solid fa-location-pin blue-text"></i>
                    </div>
                    <b>Localidad: </b> {{ $d->localidad }}
                </h6>
                @if ($d->mesa != null)
                    <h6 class="indigo-text">
                        <div class="detalle-icono">
                            <i class="fa-solid fa-map-pin teal-text"></i>
                        </div>
                        <b>Mesa: </b> {{ $d->mesa }}
                    </h6>
                @endif
                @if ($d->asiento != null)
                    <h6 class="indigo-text">
                        <div class="detalle-icono">
                            <i class="fa-solid fa-chair teal-text"></i>
                        </div>
                        <b>Asiento: </b> {{ $d->asiento }}
                    </h6>
                @endif
                <h6 class="indigo-text">
                    <div class="detalle-icono">
                        <i class="fa-solid fa-ticket indigo-text"></i>
                    </div>
                    <b>Tipo de boleto: </b> {{ $d->tipo_boleto }}
                </h6>
                <h6 class="indigo-text">
                    <div class="detalle-icono">
                        <i class="fa-solid fa-calendar-days blue-grey-text"></i>
                    </div>
                    <b>Fecha y hora de generación de boleto: </b> {{ date_format(date_create($d->fecha_creacion), 'd-m-Y H:i:s') }}
                </h6>
                <h6 class="indigo-text">
                    <div class="detalle-icono">
                        <i class="fa-solid fa-circle-info red-text"></i>
                    </div>
                    <b>Estado de boleto: </b> {{ $d->estado_boleto }}
                </h6>
                <hr>
            @endforeach

            <a href="{{ route('reporte.cliente', $idCliente) }}" class="btn btn-info">
                <i class="fa-solid fa-arrow-left mr-2"></i>
                Volver
            </a>
        </div>
    </div>
@endsection
