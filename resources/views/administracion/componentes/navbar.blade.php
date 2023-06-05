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
             <a class="nav-link"><i class="fa fa-envelope"></i> <span
                     class="clearfix d-none d-sm-inline-block">Contact</span></a>
         </li>
         <li class="nav-item">
             <a class="nav-link"><i class="fa fa-comments-o"></i> <span
                     class="clearfix d-none d-sm-inline-block">Support</span></a>
         </li>
         <li class="nav-item">
             <a class="nav-link"><i class="fa fa-user"></i> <span
                     class="clearfix d-none d-sm-inline-block">Account</span></a>
         </li>
         <li class="nav-item dropdown">
             <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                 aria-haspopup="true" aria-expanded="false">
                {{ Auth::user()->first_name . " " . Auth::user()->last_name }}
             </a>
             <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                <form method="POST" action="{{ route('logout') }}" id="frm-logout" class="d-none">
                    @csrf
                </form>
                <button class="dropdown-item" type="submit" form="frm-logout">
                    Cerrar sesión
                </button>
             </div>
         </li>
     </ul>
 </nav>
 <!-- /.Navbar -->
