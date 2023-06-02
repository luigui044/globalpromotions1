<!--Navbar -->
<nav class="mb-1 navbar navbar-expand-lg fixed-top navbar-dark elegant-color-dark">
    <a class="navbar-brand" href="#">
        <img src="{{ asset('assets/images/logo3.svg') }}" alt="Global Promotions">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4"
        aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-4" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user"></i> Mi cuenta </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-info" aria-labelledby="navbarDropdownMenuLink-4">
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-user mr-2"></i>
                        Perfil
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="d-none" id="frm-logout">
                        @csrf
                    </form>
                    <button type="submit" form="frm-logout" class="dropdown-item">
                        <i class="fa-solid fa-arrow-right-from-bracket mr-2"></i>
                        Cerrar sesión
                    </button>
                </div>
            </li>
        </ul>
    </div>
</nav>
<!--/.Navbar -->
