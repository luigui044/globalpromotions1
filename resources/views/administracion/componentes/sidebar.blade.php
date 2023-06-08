<!-- Sidebar navigation -->
<div id="slide-out" class="side-nav sn-bg-4 fixed">
    <ul class="custom-scrollbar">
        <!-- Logo -->
        <li>
            <div class="logo-wrapper waves-light">
                <a href="#"><img src="{{ asset('img/logovertical.png') }}"
                        style="padding-top: 1%; padding-left: 40px " class="img-fluid flex-center"></a>
            </div>
        </li>
        <!--/. Logo -->
        <li>
            <ul class="collapsible collapsible-accordion">
                <li><a
                        class="collapsible-header waves-effect arrow-r @isset($evento) {{ $evento }} @endisset"><i
                            class="fas fa-chevron-right"></i> Eventos<i class="fas fa-angle-down rotate-icon"></i></a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="{{ route('nuevoEvento') }}"
                                    class="waves-effect  @isset($nEvento) {{ $nEvento }} @endisset">Nuevo
                                    Evento</a>
                            </li>
                            <li><a href="{{ route('eventos') }}"
                                    class="waves-effect  @isset($eventos) {{ $eventos }} @endisset">Eventos</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li><a class="collapsible-header waves-effect arrow-r"><i class="far fa-hand-pointer"></i>
                        Reportes<i class="fas fa-angle-down rotate-icon"></i></a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="{{ route('reporte.ventas') }}" class="waves-effect">Ventas</a>
                            </li>
                            <li><a href="{{ route('reporte.clientes') }}" class="waves-effect">Clientes</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li><a class="collapsible-header waves-effect arrow-r"><i class="far fa-eye"></i> Catálogos<i
                            class="fas fa-angle-down rotate-icon"></i></a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="{{ route('administracion.usuarios') }}" class="waves-effect">Usuarios</a>
                            </li>
                            <li><a href="#" class="waves-effect">Monthly meetings</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li><a class="collapsible-header waves-effect arrow-r"><i class="far fa-envelope"></i> Contact me<i
                            class="fas fa-angle-down rotate-icon"></i></a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="#" class="waves-effect">FAQ</a>
                            </li>
                            <li><a href="#" class="waves-effect">Write a message</a>
                            </li>
                            <li><a href="#" class="waves-effect">FAQ</a>
                            </li>
                            <li><a href="#" class="waves-effect">Write a message</a>
                            </li>
                            <li><a href="#" class="waves-effect">FAQ</a>
                            </li>
                            <li><a href="#" class="waves-effect">Write a message</a>
                            </li>
                            <li><a href="#" class="waves-effect">FAQ</a>
                            </li>
                            <li><a href="#" class="waves-effect">Write a message</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </li>
        <!--/. Side navigation links -->
    </ul>
    <div class="sidenav-bg mask-strong"></div>
</div>
<!--/. Sidebar navigation -->
