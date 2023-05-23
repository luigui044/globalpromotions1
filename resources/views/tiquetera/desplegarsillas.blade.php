<div class="card">
    <div class="card-body">
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
        <div class="contenedor-sillas area-zoom">
            <div>
                @for ($i = 1; $i <= 25; $i++)
                    <div class="row justify-content-center ">
                        <span class="numeroFila">{{ $i }}</span>
                        @for ($k = 1; $k <= 35; $k++)
                            <div class="silla"> @include('tiquetera.components.sillas', ['fila' => $i, 'silla' => $k])</div>
                        @endfor
                        <span class="numeroFila">{{ $i }}</span>
                    </div>
                @endfor
            </div>
            <div>
                @for ($i = 1; $i <= 25; $i++)
                    <div class="row justify-content-center">
                        <span class="numeroFila">{{ $i }}</span>
                        @for ($k = 36; $k <= 70; $k++)
                            <div class="silla"> @include('tiquetera.components.sillas', ['fila' => $i, 'silla' => $k])</div>
                        @endfor
                        <span class="numeroFila">{{ $i }}</span>
                    </div>
                @endfor
            </div>
        </div>
        <input type="hidden" name="selectSeats" id="selectSeats" value="">
    </div>
</div>
