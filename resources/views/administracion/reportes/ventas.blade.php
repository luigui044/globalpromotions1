@extends('administracion.layouts.master')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb secondary-color">
            <li class="breadcrumb-item"><a class="white-text" href="#">Reportes</a></li>
            <li class="breadcrumb-item"><a class="white-text" href="{{ route('reporte.ventas') }}">Reporte de ventas</a></li>
        </ol>
    </nav>
    <div class="card">
        <h5 class="card-header text-white">
            <strong>Reporte de ventas</strong>
        </h5>
        <div class="card-body px-lg-5 pt-0">
            <form action="">
                @csrf
                <div class="form-group">
                    <label for="evento">Seleccione un evento:</label>
                    <select class="mdb-select md-form" id="evento" name="evento" searchable="Search here..">
                        @foreach ($eventos as $evento)
                            <option value="{{ $evento->id_evento }}">{{ $evento->titulo_evento }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-check mr-2"></i>
                    Generar
                </button>
            </form>
        </div>
    </div>
@endsection
