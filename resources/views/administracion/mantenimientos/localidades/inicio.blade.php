@extends('administracion.layouts.master')

@section('content')
    <div class="card mb-5">
        <h5 class="card-header text-white secondary-color-dark">
            <strong>Localidades</strong>
        </h5>
        <div class="row mt-2">
            <div class="col-12 pl-4">
                <a class="btn btn-primary" id="btn-agregar" data-toggle="modal" data-target="#modalLocalidad">
                    <i class="fa-solid fa-circle-plus mr-2"></i>
                    Agregar Localidad
                </a>
            </div>
        </div>
        <hr>
        <div class="card-body pt-0">
            <div class="table-responsive">
                <div class="mt-3">
                    {{ $localidades->links() }}
                </div>
                <!-- Table  -->
                <table class="table table-hover table-striped table-sm">
                    <!-- Table head -->
                    <thead>
                        <tr>
                            <th class="text-center"><i class="fa-solid fa-location-pin mr-2 blue-text"
                                    aria-hidden="true"></i>Localidad</th>
                            <th class="text-center"><i class="fa-solid fa-arrow-pointer mr-2 blue-text"
                                    aria-hidden="true"></i>Acciones</th>
                        </tr>
                    </thead>
                    <!-- Table head -->

                    <!-- Table body -->
                    <tbody>
                        @foreach ($localidades as $localidad)
                            <tr>
                                <td class="text-center">{{ $localidad->des_tipo }}</td>
                                <td>
                                    <div class="d-flex flex-wrap justify-content-center align-items-center">
                                        <a class="btn btn-info btn-sm btn-editar" data-localidad="{{ $localidad }}">Editar</a>
                                        <form method="POST" action="{{ route('administracion.localidades.eliminar', $localidad->id_tipo_localidad) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm btn-eliminar">
                                                Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <!-- Table body -->
                </table>
                <!-- Table  -->
                {{ $localidades->links() }}
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalLocalidad" tabindex="-1" role="dialog" aria-labelledby="modalLocalidadTitle"
        aria-hidden="true">

        <!-- Add .modal-dialog-centered to .modal-dialog to vertically center the modal -->
        <div class="modal-dialog modal-dialog-centered" role="document">


            <div class="modal-content">
                <div class="modal-header secondary-color">
                    <h5 class="modal-title text-white">Datos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frm-localidad" method="POST" action="{{ route('administracion.localidades.guardar') }}">
                        @csrf
                        <div class="md-form mt-3">
                            <label for="localidad">Nombre de localidad:</label>
                            <input type="text" id="localidad" value="{{ old('localidad') }}"
                                name="localidad" class="form-control @error('localidad') is-invalid @enderror" autofocus />
                            <div class="invalid-feedback">
                                @error('localidad')
                                    {{ $message }}
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-success btn-sm mt-2" id="btn-guardar">
                                <i class="fa-solid fa-floppy-disk mr-2"></i>
                                Guardar
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/validaciones.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/mantenimientos/sweetmodal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/mantenimientos/localidades/localidad.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/mantenimientos/eliminar.js') }}"></script>
@endsection
