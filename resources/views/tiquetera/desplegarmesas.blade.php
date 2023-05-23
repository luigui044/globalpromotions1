<section class="contenedor-ubicaciones">
    <div class="zoom">
        <button type="button" class="aumentar mb-2" id="aumentar">
            <i class="fa-solid fa-magnifying-glass-plus"></i>
        </button>
        <button type="button" class="disminuir" id="disminuir">
            <i class="fa-solid fa-magnifying-glass-minus"></i>
        </button>
    </div>

    <div class="row justify-content-center p-4">
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

    <div class="area-zoom">
        {{-- for para primera fila --}}
        <div class="mt-1 d-flex justify-content-center">
            @for ($i = 1; $i <= 14; $i++)
                <div class="mesasCol">
                    @include('tiquetera.components.mesas', ['mesa' => $i])
                </div>
            @endfor
        </div>
        {{-- for para segunda fila --}}
        <div class="d-flex justify-content-center">
            @for ($i = 15; $i <= 32; $i++)
                <div class="mesasCol">
                    @include('tiquetera.components.mesas', ['mesa' => $i])
                </div>
            @endfor
        </div>
        {{-- for para tercera fila --}}
        <div class="d-flex justify-content-center">
            @for ($i = 33; $i <= 52; $i++)
                <div class="mesasCol">
                    @include('tiquetera.components.mesas', ['mesa' => $i])
                </div>
            @endfor
        </div>

        {{-- variable para generar los id de las mesas ya que con el for no se lograria por si solo --}}
        @php
            $mesaid = 53;
        @endphp

        {{-- for para genrar de la cuarta mesa en adelante --}}
        @for ($i = 1; $i <= 7; $i++)
            <div class="d-flex justify-content-center">
                @for ($k = 1; $k <= 21; $k++)
                    <div class="mesasCol">
                        @include('tiquetera.components.mesas', ['mesa' => $mesaid])
                    </div>
                    @php
                        $mesaid = $mesaid + 1;
                    @endphp
                @endfor
            </div>
        @endfor
    </div>
    <input type="hidden" name="selectSeats" id="selectSeats">
    <input type="hidden" id="asiento-actual">
</section>
