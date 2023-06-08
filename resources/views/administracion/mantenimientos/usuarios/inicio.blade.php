@extends('administracion.layouts.master')

@section('content')
    <div class="card mb-5">
        <h5 class="card-header text-white secondary-color-dark">
            <strong>Usuarios</strong>
        </h5>
        <div class="row mt-2">
            <div class="col-12 pl-4">
                <a href="{{ route('administracion.usuarios.crear') }}" class="btn btn-primary">
                    <i class="fa-solid fa-circle-plus mr-2"></i>
                    Agregar usuario
                </a>
            </div>
        </div>
        <hr>
        <div class="card-body pt-0">
            <div class="table-responsive">
                <div class="mt-3">
                    {{ $usuarios->links() }}
                </div>
                <!-- Table  -->
                <table class="table table-hover">
                    <!-- Table head -->
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Rol</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <!-- Table head -->

                    <!-- Table body -->
                    <tbody>
                        @foreach ($usuarios as $usuario)
                            <tr>
                                <td>{{ $usuario->name }}</td>
                                <td>{{ $usuario->nombrerol->desc_rol }}</td>
                                <td>{{ $usuario->email }}</td>
                                <td>{{ $usuario->telefono }}</td>
                                <td>{{ $usuario->nombreestado->desc_estado }}</td>
                                <td>
                                    <div class="d-flex flex-wrap justify-content-center">
                                        <a href="{{ route('administracion.usuarios.editar', $usuario->id) }}"
                                            class="btn btn-info btn-sm mb-2">Editar</a>
                                        <form action="{{ route('administracion.usuarios.eliminar', $usuario->id) }}"
                                            method="POST">
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
                {{ $usuarios->links() }}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/mantenimientos/eliminar.js') }}"></script>
@endsection
