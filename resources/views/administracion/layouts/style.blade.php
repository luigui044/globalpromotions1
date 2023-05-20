 <!-- MDB icon -->
 <link rel="icon" href="{{ asset('img/logohorizontal.jpg') }}" type="image/jpg">

 <!-- Font Awesome -->
 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
 <!-- Google Fonts Roboto -->
 <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
 <!-- Bootstrap core CSS -->
 <link rel="stylesheet" href="{{ asset('mdb/css/bootstrap.min.css') }}">
 <!-- Material Design Bootstrap -->
 <link rel="stylesheet" href="{{ asset('mdb/css/mdb.min.css') }}">
 <!-- Your custom styles (optional) -->
 <link rel="stylesheet" href="{{ asset('mdb/css/style.css') }}">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
 <style>
 .navbar {
  z-index: 1040;
}
.side-nav {
  margin-top: 57px !important;
}
.button-collapse{
    display: none !important;
}

@media (min-width: 1200px){
.fixed-sn main {
    margin-left: 20% !important;
    margin-right: 10% !important;
  }

 
}
@media(max-width: 1200px){
    .button-collapse{ 
    display: block !important;
  }
}
 </style>

 @yield('styles')