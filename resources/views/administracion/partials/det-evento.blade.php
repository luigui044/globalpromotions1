<div class="row justify-content-center">
    <div class="col-md-6">
        <p><b>Nombre de evento:</b><br> {{ $evento->titulo_evento }}</p>
    </div>
    <div class="col-md-3">
        <p><b>Fecha de presentación:</b> {{ date('d/m/Y' , strtotime($evento->fechas)) }}</p>
    </div>
    <div class="col-md-3">
        <p><b>Hora de presentación:</b> {{ $evento->hora }}</p>
    </div>
    <div class="col-md-6">
        <p><b>Artista o banda:</b><br> {{ $artista->nombre }}</p>
    </div>
    <div class="col-md-6">
        <p><b>Lugar:</b><br> {{ $evento->lugar }}</p>
    </div>
    <div class="col-md-12">
        <p><b>Copy de evento:</b><br>{{ $evento->copy_evento }} </p>
        <hr>
    </div>
    <div class="col-md-12">
        <p><b>Localidades:</b> </p>

        <table class="table table-sm table-striped">
            <thead>
              <tr>
                
                <th scope="col">Localidad</th>
                <th scope="col">Cantitad</th>
                <th scope="col">Vendidos</th>
                <th scope="col">Estado</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($localidades as $item)
                <tr>
          
                    <td>{{ $item->nombre_localidad }}</td>
                    <td>{{ $item->cantidad }}</td>
                    <td>{{ $item->vendidos }}</td>
                    <td> @switch( $item->estado )
                        @case(1)
                                Disponible
                            @break
                        @case(2)
                                Agotado
                            @break
                        @default
                            
                    @endswitch</td>
                  </tr>
                @endforeach

            </tbody>
          </table>
          <hr>
    </div>
    <div class="col-md-4">
        <p><b>Imagen de banner:</b> </p>
        <img src="{{ $evento->image_banner  }}" style="width: 100%" alt="banner_image">
    </div>
    <div class="col-md-4">
        <p><b>Imagen de portada:</b> </p>
        <img src="{{ $evento->image_card  }}" style="width: 100%" alt="banner_image">
    </div>
    <div class="col-md-4">
        <p><b>Imagen de localidades:</b> </p>
        <img src="{{ $evento->imagen_lugar  }}" style="width: 100%" alt="banner_image">
    </div>
</div>