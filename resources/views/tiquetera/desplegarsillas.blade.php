<section class="p-relative">
    <div class="zoom">
        <button type="button" class="aumentar mb-2" id="aumentar">
            <i class="fa-solid fa-magnifying-glass-plus"></i>
        </button>
        <button type="button" class="disminuir" id="disminuir">
            <i class="fa-solid fa-magnifying-glass-minus"></i>
        </button>
    </div>
    <div class="row justify-content-center p-4" style="width: 1200px; margin: 1.5rem;">
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
    <div class="contenedor-sillas area-zoom">
        @php 
            $tipo = 2; 
        @endphp

        @if ($tipo == 1)
            @php
                // Se guarda la cantidad de sillas por cada una de las 2 columnas
                $cantidadSillasPorColumna = $cantidad / 2;
                // Número de filas por cada columna
                $cantidadFilas = intval($cantidadSillasPorColumna / 35);
                // Se obtiene el residuo de la división para ver si sobran sillas y colocarlas en la última fila
                $sillasSobrantes = $cantidadSillasPorColumna % 35;
            @endphp
            <div>
                @for ($i = 1; $i <= $cantidadFilas; $i++)
                    <div class="row justify-content-center">
                        <span class="numeroFila">{{ $i }}</span>
                        @for ($k = 1; $k <= 35; $k++)
                            <div class="silla"> @include('tiquetera.components.sillas', ['fila' => $i, 'silla' => $k])</div>
                        @endfor
                        <span class="numeroFila">{{ $i }}</span>
                    </div>
                @endfor
            </div>
            <div>
                @for ($i = 1; $i <= $cantidadFilas; $i++)
                    <div class="row justify-content-center">
                        <span class="numeroFila">{{ $i }}</span>
                        @for ($k = 36; $k <= 70; $k++)
                            <div class="silla"> @include('tiquetera.components.sillas', ['fila' => $i, 'silla' => $k])</div>
                        @endfor
                        <span class="numeroFila">{{ $i }}</span>
                    </div>
                @endfor
            </div>
        @else
            @php
                $filas = intval($cantidad / 35);
            @endphp
            <div>
                @for ($i = 1; $i <= $filas; $i++)
                    <div class="row justify-content-center">
                        <span class="numeroFila">{{ $i }}</span>
                        @for ($k = 1; $k <= 35; $k++)
                            <div class="silla"> @include('tiquetera.components.sillas', ['fila' => $i, 'silla' => $k + 35*($i-1)])</div>
                        @endfor
                        <span class="numeroFila">{{ $i }}</span>
                    </div>
                @endfor
            </div>
        @endif
    </div>
    <input type="hidden" name="selectSeats" id="selectSeats" value="">
</section>
