<table class="table table-sm table-striped table-bordered">
    <thead>
      <tr>
   
        <th scope="col">Localidad</th>
        <th scope="col">Cantidad</th>
        <th scope="col">Precio</th>
        <th scope="col">Descuento</th>
        <th scope="col">Accion</th>
      </tr>
    </thead>
    <tbody>

        @foreach ($localEvento as $item)
            <tr>
                <td>{{ $item->nombre_localidad }}</td>
                <td>{{ $item->cantidad }}</td>
              
                <td>${{$item->precio }}</td>
                <td>{{$item->descuento }}%</td>

                <td>
                  <a class="btn-floating btn-sm btn-secondary" id="modalDesc" data-toggle="tooltip" data-placement="top"  title="Programar Descuento" onclick="mostrarModal({{ $item->id_asignacion }},{{$item->evento }})"><i class="fas fa-percent"></i></a>
                  <a class="btn-floating btn-sm btn-warning" onclick="mostrarModalEdicion({{ $item->id_asignacion }},{{$item->evento }})"  data-toggle="tooltip" data-placement="top"  title="Editar localidad"><i class="fas fa-edit"></i></a>
                  <a class="btn-floating btn-sm btn-danger" id="desa{{ $item->id_asignacion }}"  onclick="eliminarLocal({{ $item->id_asignacion }},{{$item->evento }})" data-toggle="tooltip" data-placement="top"  title="Eliminar localidad"><i class="fas fa-times-circle"></i></a>
                   
                </td>
            </tr>
        @endforeach

      
 
    </tbody>
  </table>