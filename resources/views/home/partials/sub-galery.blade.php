@extends('layouts.layout-master')

@section('styles')
    <link href="{{ asset('assets/css/simple-lightbox.min.css') }}" rel="stylesheet">
@endsection


@section('content')
    <!-- Wrapper -->
    <div class="wrapper">

        @include('layouts.navbar')

        <div class="espacio"></div>

        <section class="seccion">

            <div class="paginacion">

                {{ $galeria->links() }}

            </div>

            <div class="galeria">

                @foreach ($galeria as $imagen)
                    <div class="elemento">

                        <div class="img">

                            <a href="{{ $imagen->link_previo }}" class="enlace_imagen">

                                <img src="{{ $imagen->link_previo }}">

                            </a>

                        </div>

                        <a class="btn btn-default descargar" href="{{ $imagen->link_download }}"
                            download="{{ $imagen->id_artista }} 2023">

                            <i class="fa fa-download icono-descarga"></i>

                            Descargar

                        </a>

                    </div>

                    <div class="clear"></div>
                @endforeach

            </div>

            <div class="paginacion">

                {{ $galeria->links() }}

            </div>

        </section>



        <!-- Modal -->

        <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

            <div class="modal-dialog" role="document">

                <div class="modal-content">

                    <div class="modal-header">

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>

                        <h4 class="modal-title" id="myModalLabel">Completa el formulario con tu información</h4>

                    </div>

                    <div class="modal-body">

                        <form method="POST" action="{{ route('usuario.guardar') }}">

                            @csrf

                            <div class="form-group">

                                <label for="nombre">Nombre:</label>

                                <input type="text" class="form-control" id="nombre" placeholder="Nombre"
                                    name="nombre" required>

                            </div>

                            <div class="form-group">

                                <label for="email">Correo electrónico:</label>

                                <input type="email" class="form-control" id="email" placeholder="email@ejemplo.com"
                                    name="email" required>

                            </div>

                            <div class="form-group">

                                <label for="telefono">Teléfono:</label>

                                <input type="text" class="form-control" id="telefono" placeholder="12345678"
                                    name="telefono" required>

                            </div>

                            <button type="submit" class="btn btn-success">Aceptar</button>

                            <button type="button" class="btn btn-danger ml-3" data-dismiss="modal">

                                Cancelar

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

        @include('partials.contacto')

        <!-- Footer -->

        @include('layouts.footer')
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('assets/js/simple-lightbox.min.js') }}"></script>

    <script>
        (function() {
            var $gallery = new SimpleLightbox('.galeria .elemento .img .enlace_imagen', {});
        })();
    </script>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script type="text/javascript">
        const btns = document.querySelectorAll('.elemento a.descargar');

        btns.forEach(btn => {

            btn.addEventListener('click', e => {

                e.preventDefault();

                fetch(`https://api.ipify.org?format=json`)

                    .then(response => response.json())

                    .then(json => {

                        if (json) {

                            const ip = json.ip;

                            fetch(`https://globalpromotions-ca.com/existe-ip/${ip}`)

                                .then(response => response.json())

                                .then(direccion => {

                                    if (direccion) {

                                        if (direccion.existe) {

                                            //Se redirige al enlace de descarga

                                            window.location.href = btn.href;

                                        } else {

                                            // Se solicita la información en el formulario

                                            $('#modal-form').modal('show');

                                        }

                                    }

                                })

                                .catch(err => {

                                    console.log(err);

                                });

                        }

                    })

                    .catch(err => {

                        console.log(err);

                    });

            });

        });
    </script>
@endsection
