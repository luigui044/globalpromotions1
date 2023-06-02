@extends('usuario.layouts.master')

@section('titulo', 'Mi perfil')

@section('contenido')
    <div class="w-100 d-flex justify-content-center">
        <section class="contenedor-perfil">
            <h1 class="text-center">Mi perfil</h1>
            <div class="icono-perfil">
                <i class="fa-regular fa-user"></i>
            </div>
            <div class="informacion">
                <span class="encabezado">Nombre: </span>
                <span class="valor">{{ Auth::user()->first_name . " " . Auth::user()->middle_name . " " . Auth::user()->last_name . " " . Auth::user()->segundo_apellido }}</span>
            </div>
            <div class="informacion">
                <span class="encabezado">Correo electrónico: </span>
                <span class="valor">{{ Auth::user()->email }}</span>
            </div>
            <div class="informacion">
                <span class="encabezado">Teléfono: </span>
                <span class="valor">{{ Auth::user()->telefono }}</span>
            </div>

            <section class="mt-4">
                <a href="{{ route('perfil.editar') }}" class="btn btn-primary">
                    <i class="fa-solid fa-user-pen mr-1"></i>
                    Editar mi perfil
                </a>
                <a href="" class="btn btn-default">
                    <i class="fa-solid fa-ticket mr-1"></i>
                    Mis compras
                </a>
                <a href="{{ route('home') }}" class="btn btn-info">
                    <i class="fa-solid fa-arrow-left mr-1"></i>
                    Volver
                </a>
            </section>
        </section>
    </div>
@endsection
