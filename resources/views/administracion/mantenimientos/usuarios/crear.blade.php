@extends('administracion.layouts.master')

@section('content')
    <div class="card mb-5">
        <h5 class="card-header text-white secondary-color-dark">
            <strong>Crear usuario</strong>
        </h5>
        <!--Card content-->
        <div class="card-body px-lg-5 pt-0">
            <!-- Form -->
            <form method="POST" action="{{ route('administracion.usuarios.guardar') }}">
                @csrf
                <!-- Name -->
                <div class="md-form mt-3">
                    <label for="first_name">Primer nombre</label>
                    <input type="text" id="first_name" name="first_name"
                        class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}">
                    <div class="invalid-feedback">
                        @error('first_name')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="md-form mt-3">
                    <label for="middle_name">Segundo nombre</label>
                    <input type="text" id="middle_name" name="middle_name" value="{{ old('middle_name') }}"
                        class="form-control @error('middle_name') is-invalid @enderror">
                    <div class="invalid-feedback">
                        @error('middle_name')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="md-form mt-3">
                    <label for="last_name">Primer apellido</label>
                    <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}"
                        class="form-control @error('last_name') is-invalid @enderror">
                    <div class="invalid-feedback">
                        @error('last_name')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="md-form mt-3">
                    <label for="segundo_apellido">Segundo apellido</label>
                    <input type="text" id="segundo_apellido" value="{{ old('segundo_apellido') }}"
                        name="segundo_apellido" class="form-control @error('segundo_apellido') is-invalid @enderror">
                    <div class="invalid-feedback">
                        @error('segundo_apellido')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="md-form mt-3">
                    <label for="telefono">Teléfono</label>
                    <input type="text" id="telefono" value="{{ old('telefono') }}" name="telefono"
                        class="form-control @error('telefono') is-invalid @enderror">
                    <div class="invalid-feedback">
                        @error('telefono')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="md-form mt-3">
                    <label for="email">Correo electrónico</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
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
                            <option value="{{ $rol->id }}" @if ($rol->id == old('rol')) selected @endif>
                                {{ $rol->desc_rol }}
                            </option>
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
                            <option value="{{ $estado->id }}" @if ($estado->id == old('estado')) selected @endif>
                                {{ $estado->desc_estado }}
                            </option>
                        @endforeach
                    </select>
                    @error('estado')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="md-form mt-3">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password"
                        class="form-control @error('password') is-invalid @enderror">
                    <div class="invalid-feedback">
                        @error('password')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <!-- Send button -->
                    <button class="btn btn-primary" type="submit">
                        <i class="fa-solid fa-floppy-disk mr-2"></i>
                        Agregar
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
@endsection
