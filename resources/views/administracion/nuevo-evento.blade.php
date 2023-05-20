@extends('administracion.layouts.master')
@section('styles')
    <style>
        textarea {
            resize: none;
        }

        #bannerPreview1 {
            width: 100%;

        }

        #portadaPreview2 {
            width: 100%
        }

        #portadaPreview3 {
            width: 100%
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- Card -->
                <div class="card card-cascade narrower">
                    <!-- Card image -->
                    <div class="view view-cascade gradient-card-header blue-gradient" style="padding: 0.6rem 1rem;">

                        <!-- Title -->
                        <h2 class="card-header-title">{{ $titulo }}</h2>

                    </div>

                    <!-- Card content -->
                    <div class="card-body card-body-cascade ">
                        <form action="{{ route('crearEvento') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <label for="nombreEvento">Nombre de evento:</label>
                                    <input class="form-control @error('nombreEvento') is-invalid @enderror" 
                                        id="nombreEvento" name="nombreEvento" type="text" value="{{ old('nombreEvento') }}">
                                    <div class="invalid-feedback">
                                        @error('nombreEvento') {{ $message }} @enderror
                                    </div> 
                                </div>
                                <div class="col-12 col-md-3">
                                    <label for="fecha">Fecha de presentación:</label>
                                    <input class="form-control @error('fecha') is-invalid @enderror" id="fecha" name="fecha" type="date" value="{{ old('fecha') }}">
                                    <div class="invalid-feedback">
                                        @error('fecha') {{ $message }} @enderror
                                    </div> 
                                </div>
                                <div class="col-12 col-md-3">
                                    <label for="hora">Hora de presentación:</label>
                                    <input class="form-control @error('hora') is-invalid @enderror" id="hora" name="hora" type="text" value="{{ old('hora') }}">
                                    <div class="invalid-feedback">
                                        @error('hora') {{ $message }} @enderror
                                    </div> 
                                </div>
                                <div class="col-12 col-md-6 mt-3">
                                    <label for="artista">Artista o Ponente:</label>
                                    <select class="browser-default custom-select @error('artista') is-invalid @enderror" name="artista" id="artista1">
                                        <option value="" selected>Seleccione un artista</option>
                                        @foreach ($artistas as $item)
                                            <option value="{{ $item->id_artista }}" @if(old('artista') == $item->id_artista ) selected @endif>{{ $item->nombre }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        @error('artista') {{ $message }} @enderror
                                    </div> 
                                    <div class="custom-control custom-checkbox mt-3">
                                        <input type="checkbox" class="custom-control-input" id="nartista"
                                            onclick="nuevoArtista()" value="1">
                                        <label class="custom-control-label" for="nartista">Nuevo Artista</label>
                                    </div>
                                    <input type="text" class="form-control" name="artista" id="artista2" disabled>
                                </div>
                                <div class="col-12 col-md-6 mt-3">
                                    <label for="artista">Lugar:</label>
                                    <input type="text" class="form-control @error('lugar') is-invalid @enderror" name="lugar" id="lugar" value="{{ old('lugar') }}">
                                    <div class="invalid-feedback">
                                        @error('lugar') {{ $message }} @enderror
                                    </div> 
                                </div>
                                <div class="col-12 mt-3">
                                    <div class="form-group">
                                        <label for="copy">Copy de evento:</label>
                                        <textarea class="form-control rounded-0 @error('copy') is-invalid @enderror" id="copy" name="copy"
                                            rows="3">{{ old('copy') }}</textarea>
                                        <div class="invalid-feedback">
                                            @error('copy') {{ $message }} @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <label for="fotoBanner">Imagen de lugar</label>
                                    <div class="file-field">
                                        <div class="z-depth-1-half mb-4" id="imagePreview3">
                                            <img src="https://mdbootstrap.com/img/Photos/Others/placeholder.webp"
                                                class="img-fluid" alt="example placeholder">
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <div class="btn btn-mdb-color btn-rounded float-left">
                                                <span>Choose file</span>
                                                <input type="file" name="fotoLugar" id="fotoLugar">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="fotoBanner">Imagen de Banner</label>
                                    <div class="file-field">
                                        <div class="z-depth-1-half mb-4" id="imagePreview1">
                                            <img src="https://mdbootstrap.com/img/Photos/Others/placeholder.webp"
                                                class="img-fluid" alt="example placeholder">
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <div class="btn btn-mdb-color btn-rounded float-left">
                                                <span>Choose file</span>
                                                <input type="file" name="fotoBanner" id="fotoBanner">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-5 mt-3">
                                    <label for="fotoPortada">Imagen de portada</label>
                                    <div class="file-field">
                                        <div class="z-depth-1-half mb-4" id="imagePreview2">
                                            <img src="https://mdbootstrap.com/img/Photos/Others/placeholder.webp"
                                                class="img-fluid" alt="example placeholder">
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <div class="btn btn-mdb-color btn-rounded float-left">
                                                <span>Choose file</span>
                                                <input type="file" name="fotoPortada" id="fotoPortada">
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
