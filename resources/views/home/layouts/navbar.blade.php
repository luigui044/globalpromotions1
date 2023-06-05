<!-- Navigation -->

<div class="navbar" role="navigation" style=" ">

    <!-- Heading -->

    <div class="heading">

        <div class="container">

            <div class="row">

                <div class="col-sm-12">

                    {{-- <div class="search">

                        <a href="https://gp.probalosv.com/">

                            <i class="material-icons">search</i>

                        </a>

                    </div> --}}

                    <div class="tel">

                        <a href="https://wa.link/vtspi8" target="_blank">

                            <i class="fa fa-whatsapp"></i> +503 7343 8825

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>



    <div class="container">

        <div class="navbar-header">

            <a href="https://gp.probalosv.com/" class="logo">
                <img src="{{ asset('assets/images/logo3.svg') }}">
            </a>

            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">

                <span class="sr-only">Toggle navigation</span>

                <span class="icon-bar top-bar"></span>

                <span class="icon-bar middle-bar"></span>

                <span class="icon-bar bottom-bar"></span>

            </button>

        </div>

        <div class="navbar-collapse collapse">

            <ul id="menu-primary" class="nav navbar-nav">

                <li class="active">

                    <a href="{{ route('home') }}">Inicio</a>

                </li>

                <li>

                    <a href="{{ route('galeria') }}">Galería</a>

                </li>

                <li>

                    <a href="{{ route('home') }}">Suscríbete</a>

                </li>

                <li>

                    <a href="https://wa.link/vtspi8">Contacto</a>

                </li>

                <li>
                    <a href="{{ route('login') }}">Acceder</a>
                </li>

                <li>
                    @if (auth()->user())
                        <form action="{{ route('logout') }}" method="post" class="d-none" id="frm-logout">
                            @csrf
                        </form>
                        <button type="submit" form="frm-logout">
                            Cerrar sesión
                        </button>
                    @endif

                </li>

            </ul>

        </div>

    </div>

</div>
