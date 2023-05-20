<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('token')
    <title>Global Promotions @yield('title')</title>
    @include('administracion.layouts.style')
</head>
<body class="fixed-sn deep-purple-skin">

    <!--Double navigation-->
    <header>
      <!-- Sidebar navigation -->
      <div id="slide-out" class="side-nav sn-bg-4 fixed">
        <ul class="custom-scrollbar">
          <!-- Logo -->
          <li>
            <div class="logo-wrapper waves-light">
              <a href="#"><img src="{{ asset('img/logovertical.png') }}" style="padding-top: 1%; padding-left: 40px "  class="img-fluid flex-center"></a>
            </div>
          </li>
          <!--/. Logo -->
      
          <li>
            <ul class="collapsible collapsible-accordion">
              <li><a class="collapsible-header waves-effect arrow-r @isset($evento) {{ $evento }} @endisset"><i class="fas fa-chevron-right"></i> Eventos<i class="fas fa-angle-down rotate-icon"></i></a>
                <div class="collapsible-body">
                  <ul>
                    <li><a href="{{ route('nuevoEvento') }}" class="waves-effect  @isset($nEvento) {{ $nEvento }} @endisset">Nuevo Evento</a>
                    </li>
                    <li><a href="{{ route('eventos') }}" class="waves-effect  @isset($eventos) {{ $eventos }} @endisset">Eventos</a>
                    </li>
                  </ul>
                </div>
              </li>
              <li><a class="collapsible-header waves-effect arrow-r"><i class="far fa-hand-pointer"></i>
                  Instruction<i class="fas fa-angle-down rotate-icon"></i></a>
                <div class="collapsible-body">
                  <ul>
                    <li><a href="#" class="waves-effect">For bloggers</a>
                    </li>
                    <li><a href="#" class="waves-effect">For authors</a>
                    </li>
                  </ul>
                </div>
              </li>
              <li><a class="collapsible-header waves-effect arrow-r"><i class="far fa-eye"></i> About<i class="fas fa-angle-down rotate-icon"></i></a>
                <div class="collapsible-body">
                  <ul>
                    <li><a href="#" class="waves-effect">Introduction</a>
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
      <!-- Navbar -->
      <nav class="navbar fixed-top navbar-toggleable-md navbar-expand-lg double-nav">
        <!-- SideNav slide-out button -->
        <div class="float-left">
          <a href="#" data-activates="slide-out" class="button-collapse"><i class="fa fa-bars"></i></a>
        </div>
        <!-- Breadcrumb-->
        {{-- <div class="breadcrumb-dn mr-auto">
          <p>Global Promotions</p>
        </div> --}}
        <ul class="nav navbar-nav nav-flex-icons ml-auto">
          <li class="nav-item">
            <a class="nav-link"><i class="fa fa-envelope"></i> <span class="clearfix d-none d-sm-inline-block">Contact</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link"><i class="fa fa-comments-o"></i> <span class="clearfix d-none d-sm-inline-block">Support</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link"><i class="fa fa-user"></i> <span class="clearfix d-none d-sm-inline-block">Account</span></a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              Dropdown
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li>
        </ul>
      </nav>
      <!-- /.Navbar -->
    </header>
    <!--/.Double navigation-->
  
    <!--Main Layout-->
    <main>
        @yield('content')

      @yield('modal')
    </main>
    <!--Main Layout-->
    @include('administracion.layouts.script')
</body>
</html>