<section class="contenedor-ubicaciones">
    <div class="zoom">
        <button type="button" class="aumentar mb-2" id="aumentar">
            <i class="fa-solid fa-magnifying-glass-plus"></i>
        </button>
        <button type="button" class="disminuir" id="disminuir">
            <i class="fa-solid fa-magnifying-glass-minus"></i>
        </button>
    </div>

    <div class="row justify-content-center p-4" style="width: 1650px;">
        <div class="mr-4">
            <span> Disponible </span>
            <div class="caja-verde"></div>
        </div>
        <div class="mr-4">
            <span> Reservado </span>
            <div class="caja-naranja"></div>
        </div>
        <div>
            <span> No Disponible </span>
            <div class="caja-roja"></div>
        </div>
    </div>

    <div class="area-zoom contenedor-mesas">
        @if ($asignacion->localidad == 2)
            {{-- for para primera fila: 19 mesas --}}
            <div class="fila-1 d-flex justify-content-center">
                @for ($i = 1; $i <= 19; $i++)
                    <div class="mesasCol">
                        @include('tiquetera.components.mesas', ['mesa' => $i])
                    </div>
                @endfor
            </div>
            {{-- for para segunda fila: 25 mesas --}}
            <div class="fila-2 d-flex justify-content-center">
                @for ($i = 20; $i <= 44; $i++)
                    <div class="mesasCol">
                        @include('tiquetera.components.mesas', ['mesa' => $i])
                    </div>
                @endfor
            </div>

            {{-- variable para generar los id de las mesas ya que con el for no se lograria por si solo --}}
            @php
                $mesaid = 45;
                // Se calcula la cantidad de mesas restantes luego de pintar las primeras 3 filas con 14,18 y 20 mesas respectivamente
                $mesasRestantes = $cantidad - (19 + 25);
                // Como las demás filas iran de 21 mesas cada una dividimos entre 21 para obtener la cantidad de filas
                // a iterar
                $filasRestantes = intval($mesasRestantes / 29);
                // Si existe un sobrante lo pintaremos al final en la última fila
                $ultimasMesas = $mesasRestantes % 29;
            @endphp

            {{-- for para generar de la tercera fila en adelante: 29 mesas --}}
            @for ($i = 1; $i <= $filasRestantes; $i++)
                <div class="fila-3 d-flex justify-content-center">
                    @for ($k = 1; $k <= 29; $k++)
                        <div class="mesasCol">
                            @include('tiquetera.components.mesas', ['mesa' => $mesaid])
                        </div>
                        @php
                            $mesaid = $mesaid + 1;
                        @endphp
                    @endfor
                </div>
            @endfor

            {{-- Se va pintar una fila más si quedan mesas restantes por mostrar --}}
            <div class="d-flex justify-content-center">
                @for ($i = 1; $i <= $ultimasMesas; $i++)
                    <div class="mesasCol">
                        @include('tiquetera.components.mesas', ['mesa' => $mesaid])
                    </div>
                    @php
                        $mesaid = $mesaid + 1;
                    @endphp
                @endfor
            </div>
        @elseif($asignacion->localidad == 3)
            @php
               $filas = intval($cantidad / 29);
            @endphp

            @for ($i = 1; $i <= $filas; $i++)
                <div class="d-flex justify-content-center">
                    @for ($k = 1; $k <= 29; $k++)
                        <div class="mesasCol">
                            @include('tiquetera.components.mesas', ['mesa' => $k + 29*($i-1)])
                        </div>
                    @endfor
                </div>
            @endfor
        @endif
    </div>
    <input type="hidden" name="selectSeats" id="selectSeats">
</section>
