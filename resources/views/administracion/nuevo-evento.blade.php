@extends('administracion.layouts.master')
@section('styles')
    <style>
        textarea{
            resize: none;
        }

        #bannerPreview1{
            width: 100%;
          
        }
        #portadaPreview2{
            width: 100%
        }
        #portadaPreview3{
            width: 100%
        }
    </style>
@endsection
@section('content')
 <div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
                <!-- Card -->
                <div class="card card-cascade narrower">

                    <!-- Card image -->
                    <div class="view view-cascade gradient-card-header blue-gradient" style="padding: 0.6rem 1rem;" >
                
                    <!-- Title -->
                    <h2 class="card-header-title">{{ $titulo }}</h2>
               
                
                    </div>
                
                    <!-- Card content -->
                    <div class="card-body card-body-cascade ">
                        <form action="{{ route('crearEvento') }}" method="POST" enctype="multipart/form-data" >
                            @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <label for="nombreEvento">Nombre de evento:</label>
                                <input class="form-control" id="nombreEvento" name="nombreEvento" type="text" placeholder="" required>
                            </div>
                            <div class="col-md-3">
                                <label for="fecha">Fecha de presentación:</label>
                                <input class="form-control" id="fecha" name="fecha" type="date" placeholder="" required>
                            </div>
                            <div class="col-md-3">
                                <label for="hora">Hora de presentación:</label>
                                <input class="form-control" id="hora" name="hora" type="text" placeholder="" required>
                            </div>
                            <div class="col-md-6">
                                <label for="artista">Artista o Ponente:</label>
                                    <select class="browser-default custom-select" name="artista" id="artista1" required >
                                        <option selected>Seleccione un artista</option>
                                        @foreach ($artistas as $item)
                                            <option value="{{ $item->id_artista }}">{{ $item->nombre }}</option>
                                        @endforeach
                                  </select> 
                                  <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="nartista" onclick="nuevoArtista()" value="1">
                                    <label class="custom-control-label" for="nartista">Nuevo Artista</label>
                                </div>
                                  <input type="text" class="form-control" name="artista" id="artista2" disabled>                           
                            </div>
                            <div class="col-md-6">
                                <label for="artista">lugar:</label>    
                                <input type="text" class="form-control" name="lugar" id="lugar" required>                           
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="copy">Copy de evento:</label>
                                    <textarea class="form-control rounded-0" required id="copy" name="copy" rows="3"></textarea >
                                  </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="fotoBanner">Imagen de lugar</label>
                                <div class="file-field">
                                    <div class="z-depth-1-half mb-4" id="imagePreview3">
                                      <img  src="https://mdbootstrap.com/img/Photos/Others/placeholder.webp" class="img-fluid"
                                        alt="example placeholder">
                                    </div>
                                    <div class="d-flex justify-content-center">
                                      <div class="btn btn-mdb-color btn-rounded float-left">
                                        <span>Choose file</span>
                                        <input type="file" name="fotoLugar" id="fotoLugar" required>
                                      </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="fotoBanner">Imagen de Banner</label>
                                <div class="file-field">
                                    <div class="z-depth-1-half mb-4" id="imagePreview1">
                                      <img  src="https://mdbootstrap.com/img/Photos/Others/placeholder.webp" class="img-fluid"
                                        alt="example placeholder">
                                    </div>
                                    <div class="d-flex justify-content-center">
                                      <div class="btn btn-mdb-color btn-rounded float-left">
                                        <span>Choose file</span>
                                        <input type="file" name="fotoBanner" id="fotoBanner" required>
                                      </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <label for="fotoPortada">Imagen de portada</label>
                                <div class="file-field">
                                    <div class="z-depth-1-half mb-4" id="imagePreview2">
                                      <img src="https://mdbootstrap.com/img/Photos/Others/placeholder.webp" class="img-fluid"
                                        alt="example placeholder">
                                    </div>
                                    <div class="d-flex justify-content-center">
                                      <div class="btn btn-mdb-color btn-rounded float-left">
                                        <span>Choose file</span>
                                        <input type="file" name="fotoPortada" id="fotoPortada" required>
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row justify-content-center text-center">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-secondary">Registrar Evento</button>
                            </div>
                        </div>
                        
                </form>
                    </div>
                
                </div>
                <!-- Card -->
        </div>
    </div>
 </div>
@endsection

@section('scripts')
    
        <script src="{{ asset('js/nuevo-evento.js') }}"></script>
@endsection