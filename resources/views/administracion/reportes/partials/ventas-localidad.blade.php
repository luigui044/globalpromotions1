@php
   $entradas = 0;
   $total = 0; 
@endphp
@foreach ($ventas as $venta)
    @php 
        $entradas += $venta->cantidad;
        $total += $venta->total;
    @endphp
    <tr>
        <td><i class="fa-solid fa-location-pin mr-2 blue-text" aria-hidden="true"></i>{{ $venta->localidad }}</td>
        <td><i class="fa-solid fa-dollar-sign mr-2 teal-text" aria-hidden="true"></i>{{ number_format($venta->precio, 2) }}</td>
        <td><i class="fa-solid fa-ticket mr-2 indigo-text" aria-hidden="true"></i>{{ $venta->cantidad }}</td>
        <td><i class="fa-solid fa-dollar-sign mr-2 teal-text" aria-hidden="true"></i>{{ number_format($venta->total, 2) }}</td>
    </tr>
@endforeach
<tr class="deep-purple lighten-4">
    <td><i class="fa-solid fa-sack-dollar mr-2 blue-text" aria-hidden="true"></i>Total </td>
    <td></td>
    <td><i class="fa-solid fa-ticket mr-2 indigo-text" aria-hidden="true"></i>{{ $entradas }}</td>
    <td><i class="fa-solid fa-dollar-sign mr-2 teal-text" aria-hidden="true"></i>{{ number_format($total, 2) }}</td>
</tr>
