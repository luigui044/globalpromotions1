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
                        <form action="{{ route('actEvento', ['id' => $detEvento->id_evento]) }}" method="POST"
                            enctype="multipart/form-data" id="frm-editar-evento">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="nombreEvento">Nombre de evento:</label>
                                    <input class="form-control @error('nombreEvento') is-invalid @enderror"
                                        id="nombreEvento" name="nombreEvento" value="{{ $detEvento->titulo_evento }}"
                                        type="text">
                                    <div class="invalid-feedback">
                                        @error('nombreEvento')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="fecha">Fecha de presentación:</label>
                                    <div class="md-form mt-0">
                                        <input type="text"
                                            placeholder="{{ date('d F, Y', strtotime($detEvento->fechas)) }}" id="fecha"
                                            name="fecha" class="form-control datepicker" >
                                    </div>
                                    <input type="hidden" name="fecha2" id="fecha2"
                                        value="{{ date('d F, Y', strtotime($detEvento->fechas)) }}">
                                </div>
                                <div class="col-md-3">
                                    <label for="hora">Hora de presentación:</label>
                                    <input class="form-control @error('hora') is-invalid @enderror" id="hora" name="hora" type="text"
                                        value="{{ $detEvento->hora }}">
                                    <div class="invalid-feedback">
                                        @error('hora')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="artista">Artista o Ponente:</label>
                                    <select class="browser-default custom-select @error('artista') is-invalid @enderror" name="artista" id="artista1" >
                                        <option>Seleccione un artista</option>
                                        {{-- selecciono por default el artista registrado --}}
                                        @foreach ($artistas as $item)
                                            @if ($item->id_artista === $detEvento->id_artista)
                                                <option value="{{ $item->id_artista }}" selected="selected">
                                                    {{ $item->nombre }}</option>
                                            @else
                                                <option value="{{ $item->id_artista }}">{{ $item->nombre }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        @error('artista')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="nartista"
                                            onclick="nuevoArtista()" value="1">
                                        <label class="custom-control-label" for="nartista">Nuevo Artista</label>
                                    </div>
                                    <input type="text" class="form-control" name="artista" id="artista2" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label for="artista">Lugar:</label>
                                    <input type="text" class="form-control @error('lugar') is-invalid @enderror" name="lugar" id="lugar"
                                        value="{{ $detEvento->lugar }}" >
                                    <div class="invalid-feedback">
                                        @error('lugar')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="copy">Copy de evento:</label>
                                        <textarea class="form-control rounded-0 @error('copy') is-invalid @enderror"  id="copy" name="copy"
                                            rows="3">{{ $detEvento->copy_evento }}</textarea>
                                        <div class="invalid-feedback">
                                            @error('copy')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="fotoBanner">Imagen de lugar</label>
                                    <div class="file-field">
                                        <div class="z-depth-1-half mb-4" id="imagePreview3">
                                            <img src="{{ asset($detEvento->imagen_lugar) }}" class="img-fluid"
                                                alt="example placeholder">
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <div class="btn btn-mdb-color btn-rounded float-left">
                                                <span>Choose file</span>
                                                <input type="file" name="fotoLugar" id="fotoLugar">
                                            </div>
                                        </div>
                                        <div class="mi-error" id="error-img-lugar">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="fotoBanner">Imagen de Banner</label>
                                    <div class="file-field">
                                        <div class="z-depth-1-half mb-4" id="imagePreview1">
                                            <img src="{{ asset($detEvento->image_banner) }}" class="img-fluid"
                                                alt="example placeholder">
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <div class="btn btn-mdb-color btn-rounded float-left">
                                                <span>Choose file</span>
                                                <input type="file" name="fotoBanner" id="fotoBanner">
                                            </div>
                                        </div>
                                        <div class="mi-error" id="error-img-banner">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <label for="fotoPortada">Imagen de portada</label>
                                    <div class="file-field">
                                        <div class="z-depth-1-half mb-4" id="imagePreview2">
                                            <img src="{{ asset($detEvento->image_card) }}" class="img-fluid"
                                                alt="example placeholder">
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <div class="btn btn-mdb-color btn-rounded float-left">
                                                <span>Choose file</span>
                                                <input type="file" name="fotoPortada" id="fotoPortada">
                                            </div>
                                        </div>
                                        <div class="mi-error" id="error-img-portada">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row justify-content-center text-center">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-secondary">Actualizar Evento</button>
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
    <script type="text/javascript" src="{{ asset('js/validaciones.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/editar-evento.js') }}"></script>
@endsection
