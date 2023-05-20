<div class="containerMesa">
    <svg version="1.1" id="Capa1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
        x="0px" y="0px" viewBox="0 0 121 180"style="enable-background:new 0 0 180 136;" xml:space="preserve">

        <a xlink:title="Mesa {{ $mesa }} | Asiento 8" id="mesa{{ $mesa }}-asiento8-link"
            onclick="reserva('mesa{{ $mesa }}-asiento8',true)">
            <circle id="mesa{{ $mesa }}-asiento8" class="st0" cx="16" cy="160" r="15.5" />
        </a>
        <a xlink:title="Mesa {{ $mesa }} | Asiento 7" id="mesa{{ $mesa }}-asiento7-link"
            onclick="reserva('mesa{{ $mesa }}-asiento7',true)">
            <circle id="mesa{{ $mesa }}-asiento7" class="st0" cx="16" cy="115" r="15.5" />
        </a>
        <a xlink:title="Mesa {{ $mesa }} | Asiento 6" id="mesa{{ $mesa }}-asiento6-link"
            onclick="reserva('mesa{{ $mesa }}-asiento6',true)">
            <circle id="mesa{{ $mesa }}-asiento6" class="st0" cx="16" cy="70" r="15.5" />
        </a>
        <a xlink:title="Mesa {{ $mesa }} | Asiento 5" id="mesa{{ $mesa }}-asiento5-link"
            onclick="reserva('mesa{{ $mesa }}-asiento5',true)">
            <circle id="mesa{{ $mesa }}-asiento5" class="st0" cx="16" cy="25" r="15.5"/>
        </a>
        <a xlink:title="Mesa {{ $mesa }} | Asiento 4" id="mesa{{ $mesa }}-asiento4-link"
            onclick="reserva('mesa{{ $mesa }}-asiento4',true)">
            <circle id="mesa{{ $mesa }}-asiento4" class="st0" cx="105" cy="160" r="15.5"/>
        </a>
        <a xlink:title="Mesa {{ $mesa }} | Asiento 3" id="mesa{{ $mesa }}-asiento3-link"
            onclick="reserva('mesa{{ $mesa }}-asiento3',true)">
            <circle id="mesa{{ $mesa }}-asiento3" class="st0" cx="105" cy="115" r="15.5"/>
        </a>
        <a xlink:title="Mesa {{ $mesa }} | Asiento 2" id="mesa{{ $mesa }}-asiento2-link"
            onclick="reserva('mesa{{ $mesa }}-asiento2',true)">
            <circle id="mesa{{ $mesa }}-asiento2" class="st0" cx="105" cy="70" r="15.5"/>
        </a>
        <a xlink:title="Mesa {{ $mesa }} | Asiento 1" id="mesa{{ $mesa }}-asiento1-link"
            onclick="reserva('mesa{{ $mesa }}-asiento1',true)">
            <circle id="mesa{{ $mesa }}-asiento1" class="st0" cx="105" cy="25" r="15.5"/>
        </a>
        <g stroke="black" stroke-width="1px" fill="white">
            <rect id="mesa" x="30.5" y="0.5" class="st1" width="60" height="179"/>
            <text x="50%" y="50%" alignment-baseline="middle" text-anchor="middle" fill="black"
                stroke="none">{{ $mesa }}</text>
        </g>
    </svg>
</div>
