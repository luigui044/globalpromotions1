@extends('administracion.layouts.master')

@section('content')
    <div class="card mb-5">
        <h5 class="card-header text-white secondary-color-dark">
            <strong>Editar usuario</strong>
        </h5>
        <!--Card content-->
        <div class="card-body px-lg-5 pt-0">
            <!-- Form -->
            <form method="POST" action="{{ route('administracion.usuarios.actualizar', $usuario->id) }}">
                @csrf
                <!-- Name -->
                <div class="md-form mt-3">
                    <label for="first_name">Primer nombre</label>
                    <input type="text" id="first_name" name="first_name"
                        class="form-control @error('first_name') is-invalid @enderror" value="{{ $usuario->first_name }}">
                    <div class="invalid-feedback">
                        @error('first_name')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="md-form mt-3">
                    <label for="middle_name">Segundo nombre</label>
                    <input type="text" id="middle_name" name="middle_name" value="{{ $usuario->middle_name }}"
                        class="form-control @error('middle_name') is-invalid @enderror">
                    <div class="invalid-feedback">
                        @error('middle_name')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="md-form mt-3">
                    <label for="last_name">Primer apellido</label>
                    <input type="text" id="last_name" name="last_name" value="{{ $usuario->last_name }}"
                        class="form-control @error('last_name') is-invalid @enderror">
                    <div class="invalid-feedback">
                        @error('last_name')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="md-form mt-3">
                    <label for="segundo_apellido">Segundo apellido</label>
                    <input type="text" id="segundo_apellido" value="{{ $usuario->segundo_apellido }}"
                        name="segundo_apellido" class="form-control @error('segundo_apellido') is-invalid @enderror">
                    <div class="invalid-feedback">
                        @error('segundo_apellido')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="md-form mt-3">
                    <label for="telefono">Teléfono</label>
                    <input type="text" id="telefono" value="{{ $usuario->telefono }}" name="telefono"
                        class="form-control @error('telefono') is-invalid @enderror">
                    <div class="invalid-feedback">
                        @error('telefono')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="md-form mt-3">
                    <label for="email">Correo electrónico</label>
                    <input type="email" id="email" name="email" value="{{ $usuario->email }}"
                        class="form-control @error('email') is-invalid @enderror">
                    <div class="invalid-feedback">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="rol">Rol:</label>
                    <select class="mdb-select md-form" id="rol" name="rol" searchable="Search here..">
                        @foreach ($roles as $rol)
                            <option value="{{ $rol->id }}" @if ($rol->id == $usuario->rol) selected @endif>
                                {{ $rol->desc_rol }}</option>
                        @endforeach
                    </select>
                    @error('rol')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="estado">Estado:</label>
                    <select class="mdb-select md-form" id="estado" name="estado" searchable="Search here..">
                        @foreach ($estados as $estado)
                            <option value="{{ $estado->id }}" @if ($estado->id == $usuario->estado) selected @endif>
                                {{ $estado->desc_estado }}</option>
                        @endforeach
                    </select>
                    @error('estado')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <!-- Send button -->
                    <button class="btn btn-primary" type="submit">
                        <i class="fa-solid fa-floppy-disk mr-2"></i>
                        Actualizar
                    </button>
                    <a class="btn btn-info" href="{{ route('administracion.usuarios') }}">
                        <i class="fa-solid fa-arrow-left mr-1"></i>
                        Volver
                    </a>
                </div>
            </form>
            <!-- Form -->
        </div>
    </div>

    <div class="card mb-5">
        <h5 class="bg-danger white-text py-3 px-4">
            <i class="fa-solid fa-key white-text mr-2"></i>
            <strong>Cambiar contraseña</strong>
        </h5>
        <!--Card content-->
        <div class="card-body px-lg-5 pt-0">
            <form method="POST" action="{{ route('usuario.contrasena.actualizar', $usuario->id) }}"
                id="frm-actualizar-password">
                @csrf
                <div class="md-form mt-3 input-with-post-icon">
                    <label for="contrasena_nueva">Contraseña nueva</label>
                    {{-- <i class="fa-solid fa-eye input-prefix icono-password"></i> --}}
                    <input type="password" id="contrasena_nueva" name="contrasena_nueva"
                        class="form-control @error('contrasena_nueva') is-invalid @enderror">
                    <div class="invalid-feedback">
                        @error('contrasena_nueva')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="md-form mt-3 input-with-post-icon">
                    <label for="confirmar_contrasena">Confirmar contraseña</label>
                    {{-- <i class="fa-solid fa-eye input-prefix icono-password"></i> --}}
                    <input type="password" id="confirmar_contrasena" name="confirmar_contrasena"
                        class="form-control @error('confirmar_contrasena') is-invalid @enderror">
                    <div class="invalid-feedback">
                        @error('confirmar_contrasena')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <!-- Send button -->
                    <button class="btn btn-danger" type="submit">
                        <i class="fa-solid fa-key mr-2"></i>
                        Actualizar
                    </button>
                    <a class="btn btn-info" href="{{ route('administracion.usuarios') }}">
                        <i class="fa-solid fa-arrow-left mr-1"></i>
                        Volver
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
