@extends('home.layouts.layout-master')


@section('content')
    <!-- Wrapper -->
    <div class="wrapper">

        @include('home.layouts.navbar')

        <div class="espacio"></div>

        <div class="container">

            <div class="row">

                <section class="seccion">

                    <div class="galeria">

                        <div class="tarjeta">

                            <div class="imagen">

                                <img src="{{ asset('assets/images/portadas/relsb.jpg') }}" alt="Rels B">

                            </div>

                            <div class="contenido">

                                <div>

                                    <p>Reels B Meet & Greet 2023</p>

                                </div>

                                <div class="acciones">

                                    <a href="{{ route('subgaleria', ['idArtista' => 1]) }}" class="btn btn-default">Mostrar
                                        Galería</a>

                                </div>

                            </div>

                        </div>
                        <div class="tarjeta">

                            <div class="imagen">

                                <img src="{{ asset('assets/images/portadas/gilbertosantarosa.jpg') }}"
                                    alt="Gilberto Santa Rosa">

                            </div>

                            <div class="contenido">

                                <div>

                                    <p>Gilberto Santa Rosa 2023</p>

                                </div>

                                <div class="acciones">

                                    <a href="{{ route('subgaleria', ['idArtista' => 8]) }}" class="btn btn-default">Mostrar
                                        Galería</a>

                                </div>

                            </div>

                        </div>

                    </div>

                </section>

            </div>

        </div>

        @include('home.partials.contacto')

        <!-- Footer -->

        @include('home.layouts.footer')



    </div>
@endsection
