<nav class="navbar navbar-expand-lg navbar-dark " style="background-color:  black">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{ route('home') }}">
        <img src="{{ asset('assets/images/logo3.svg')}}" style="width:30% !important">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link " aria-current="page" href="{{ route('home') }}">INICIO</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="{{ route('galeria') }}">GALERÍA</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">SUSCRIBETE</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">CONTACTO</a>
          </li>
       
        </ul>
       
      </div>
    </div>
  </nav>


  <style>
    .nav-link{
      font-family: 'Roboto Condensed', sans-serif;
      font-size: 16px;
      font-weight: normal;
      line-height: .8em;
      display: inline-block;
      padding: 20px 24px;
      letter-spacing: 3px;
      text-transform: uppercase;
      color: #fff;
      border-bottom: 1px solid rgba(255, 255, 255, .2);
    }

    .nav-link.active{
    
    }


   a.active {
   


    background-image: linear-gradient(to right, #223373, #070c19);
    box-shadow: 0 0 20px 0 #223373;
    border-bottom: 1px

}

 a:hover{
  background-image: linear-gradient(to right, #223373, #070c19);
    box-shadow: 0 0 20px 0 #223373;
 }
  </style>