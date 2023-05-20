@extends('administracion.layouts.master')

@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
                <!-- Card -->
                <div class="card card-cascade narrower">

                    <!-- Card image -->
                    <div class="view view-cascade gradient-card-header blue-gradient" style="padding: 0.6rem 1rem;" >
                    <div class="row">
                        <div class="col-md-1">
                            <a href="{{ route('eventos')  }}" class="text-white" data-toggle="tooltip" data-placement="top"  title="Regresar a eventos">                
                                 <h2>    <i class="far fa-arrow-alt-circle-left"></i></h2> 
                            </a>

                        </div>
                        <div class="col-md-10"> <h2 class="card-header-title">Asignar Localidades</h2></div>
                    </div>
                        <!-- Title -->

                   
               
                
                    </div>
                
                    <!-- Card content -->
                    <div class="card-body card-body-cascade ">
                        <h2>Evento: <u>{{ $eventoSet->titulo_evento }}</u> </h2>
                        <hr>
                        <div class="row">
                            <div class="col-md-8 text-center justify-content-center" id="listLocalidades" >
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
                                                <td>${{ $item->precio }}</td>
                                                <td>{{ $item->descuento }}%</td>
                                      
                                                <td>
                                                    <a class="btn-floating btn-sm btn-secondary" id="modalDesc" data-toggle="tooltip" data-placement="top"  title="Programar Descuento" onclick="mostrarModal({{ $item->id_asignacion }},{{$item->evento }})"><i class="fas fa-percent"></i></a>

                                                    <a class="btn-floating btn-sm btn-warning" onclick="mostrarModalEdicion({{ $item->id_asignacion }},{{$item->evento }})"  data-toggle="tooltip" data-placement="top"  title="Editar localidad"><i class="fas fa-edit"></i></a>
                                                    <a class="btn-floating btn-sm btn-danger" id="desa{{ $item->id_asignacion }}"  onclick="eliminarLocal({{ $item->id_asignacion }},{{$item->evento }})" data-toggle="tooltip" data-placement="top"  title="Eliminar localidad"><i class="fas fa-times-circle"></i></a>
                                                   
                                                </td>
                                            </tr>
                                        @endforeach

                                      
                                 
                                    </tbody>
                                  </table>
                            </div>
                            <div class="col-md-4">
                                <form id="formLocalidad">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="localidad">Seleccione una localidad:</label>
                                            <select class="browser-default custom-select" id='localidad' name='localidad'>
                                                <option  selected>Seleccion una localidad</option>
                                                @foreach ($localidades as $item)
                                                    <option value="{{ $item->id_localidad }}">{{ $item->nombre_localidad }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-12 mt-1">
                                            <!-- Default input -->
                                            <label for="cantidad">Ingrese Cantidad:</label>
                                            <input type="number" min="1" id="cantidad" name="cantidad" class="form-control">
                                            <input type="hidden" name="evento" id="evento" value="{{ $eventoSet->id_evento }}">
                                        </div>
                                        <div class="col-md-12 mt-1">
                                            <!-- Default input -->
                                        <label for="cantidad">Ingrese Precio:</label>
                                        <input type="text"id="precio" name="precio" class="form-control">
                                    </div>
                                        <div class="col-md-12 mt-1">
                                            <a onclick="agregarLocal()" class="btn btn-primary btn-block">Agregar Localidad</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                
                </div>
                <!-- Card -->
        </div>
    </div>
 </div>
@endsection
@section('modal')
        <!-- Central Modal Medium Info -->
        <div class="modal fade" id="centralModalInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-notify modal-info" role="document">
            <!--Content-->
            <div class="modal-content">
                <!--Header-->
                <div class="modal-header">
                <p class="heading lead">Programar Descuento</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
                </div>

                <!--Body-->
                <div class="modal-body">
            
                    <form action="">
                        <label for="descuento">Ingrese el descuento:</label>
                        <input type="text" class="form-control mb-1" id="descuento" name="descuento" placeholder="0.00%">
                        <!--Grid row-->
                        <div class="row">

                            <!--Grid column-->
                            <div class="col-md-6 mb-4">
                        
                            <div class="md-form">
                                <!--The "from" Date Picker -->
                                <input placeholder="Selected starting date" type="text" id="startingDate" class="form-control datepicker">
                                <label for="startingDate">start</label>
                            </div>
                        
                            </div>
                            <!--Grid column-->
                        
                            <!--Grid column-->
                            <div class="col-md-6 mb-4">
                        
                            <div class="md-form">
                                <!--The "to" Date Picker -->
                                <input placeholder="Selected ending date" type="text" id="endingDate" class="form-control datepicker">
                                <label for="endingDate">end</label>
                            </div>
                        
                            </div>
                            <!--Grid column-->
                        
                        </div>
                        <!--Grid row-->
                    
                        
                    </form>
            
                </div>

                <!--Footer-->
                <div class="modal-footer justify-content-center">
                    <a  class="btn btn-primary" id='programarBtn'>Programar <i class="fas fa-check"></i></a>     
                    
                    <a class="btn btn-outline-primary waves-effect" data-dismiss="modal">Cancelar</a>
                </div>
            </div>
            <!--/.Content-->
            </div>
        </div>
        <!-- Central Modal Medium Info-->




        <div class="modal fade" id="modalEdicion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-notify modal-info" role="document">
            <!--Content-->
            <div class="modal-content">
                <!--Header-->
                <div class="modal-header">
                <p class="heading lead">Editar Localidad</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
                </div>

                <!--Body-->
                <div class="modal-body">
            
                    <form action="">
                        <label for="precioEdit">Ingrese nuevo Precio:</label>
                        <input type="text" class="form-control mb-1" id="precioEdit" name="precioEdit" placeholder="$0.00"  >
                        
                        <label for="cantEdit">Ingrese nueva Cantidad:</label>
                        <input type="number" class="form-control mb-1" id="cantEdit" name="cantEdit" placeholder="0" >

                    </form>
            
                </div>

                <!--Footer-->
                <div class="modal-footer justify-content-center">
                    <a  class="btn btn-primary" id='editarBtn'>Actualizar Localidad <i class="fas fa-check"></i></a>     
                    
                    <a class="btn btn-outline-primary waves-effect" data-dismiss="modal">Cancelar</a>
                </div>
            </div>
            <!--/.Content-->
            </div>
        </div>


@endsection
@section('scripts')
    <script>
const fecha = new Date();
         
        function agregarLocal() 
        {
                var localidad=  $('#localidad option:selected').val()   
                var evento = $('#evento').val()
                var cantidad = $('#cantidad').val()
                var precio = $('#precio').val()
                        $.confirm({
                    title: 'Información',
                    content: '¿Desea continuar agregando la localidad?',
                    buttons: {
                        confirm: 
                            {
                                text: 'Confirmar',
                                btnClass: 'btn-success',
                            action: function () {
                                $('#listLocalidades').html('<div class="spinner-grow text-primary" role="status">+<span class="sr-only">Loading...</span>+</div>')
                                $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });
                                $.post( '/agregarLocalidad', { id: evento,localidad:localidad,cantidad:cantidad,precio:precio})
                                .done(function( data ) {
                                
                                    setTimeout(() => {
                                        
                                        $('#cantidad').val('');
                                        $('#precio').val('');
                                        $('#localidad').prop('selectedIndex',0); 
                                        $('#centralModalInfo').modal('hide');
                                        Swal.fire({
                                        title: 'Información',
                                        text: 'Localidad Agregada éxitosamente',
                                        icon: 'success',
                                        confirmButtonText: 'Ok'
                                        }) 
                                        listarLocalidades(evento)
                                        

                                    }, '1000');
                                

                                });
                                }},
                        cancel: {
                            text: 'Cancelar',
                            btnClass: 'btn-danger',
                            action: function (){}
                        },
                    
                    }
                });

            
        }
        //funcion que recarga tabla de localidades con los cambios actuales
        function listarLocalidades(idEvento) 
        {
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post( '/listLocal', { id: idEvento})
            .done(function( data ) {
                    $('#listLocalidades').html(data);
            });
        }


        function eliminarLocal(idLocal,idEvento)
        {
            $.confirm({
                title: 'Información',
                content: '¿Esta seguro de eliminar la localidad?',
                buttons: {
                    confirm: 
                        {
                            text: 'Confirmar',
                        btnClass: 'btn-success',
                        action: function () {
                                $('#listLocalidades').html('<div class="spinner-grow text-primary" role="status">+<span class="sr-only">Loading...</span>+</div>')
                                $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });
                                $.post( '/removerLocalidad', { id: idLocal, idEvento: idEvento})
                                .done(function( data ) {
                                    
                                    console.log(data)
                                    setTimeout(() => {
                                        
                                        listarLocalidades(idEvento)
                                        Swal.fire({
                                        title: 'Información',
                                        text: 'Localidad eliminada éxitosamente',
                                        icon: 'success',
                                        confirmButtonText: 'Ok'
                                        }) 
                                    }, '1000');
                                });
                            }},
                    cancel: {
                        text: 'Cancelar',
                        btnClass: 'btn-danger',
                        action: function (){}
                    },
                
                }
            });
        }

       function agregarDesc(idLocal,idEvento) {
        var descuento = $('#descuento');
        var inicio =  $('#startingDate')
        var final = $('#endingDate');
    
        $.confirm({
                title: 'Información',
                content: 'Confirme para programar el descuento',
                buttons: {
                    confirm:
                        {
                        text: 'Confirmar',
                        btnClass: 'btn-success',
                        action: function (){
                            $('#listLocalidades').html('<div class="spinner-grow text-primary" role="status">+<span class="sr-only">Loading...</span>+</div>')
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });
                                $.post( '/desLocalidad', { id: idLocal, idEvento: idEvento, descuento: descuento.val(),inicio:inicio.val(), final:final.val()})
                                .done(function( data ) {
                                    descuento.val('');
                                    inicio.val('');
                                    final.val('');
                                    $('#centralModalInfo').modal('hide');
                                    Swal.fire({
                                        title: 'Información',
                                        text: data,
                                        icon: 'success',
                                        confirmButtonText: 'Ok'
                                        })
                                    setTimeout(() => {
                                        listarLocalidades(idEvento)  
                                    }, '1000');
                                });


                        }
                      },
                    cancel: {
                        text: 'Cancelar',
                        btnClass: 'btn-danger',
                        action: function (){}
                    },
                
                }
            });
       }

       function mostrarModal(idL,idE) 
        {

            $('#programarBtn').attr('onClick','agregarDesc('+idL+','+idE+')')
             $('#centralModalInfo').modal('show')
        }

        function mostrarModalEdicion(idL,idE)
        {
            $('#editarBtn').attr('onClick','editarLocal('+idL+','+idE+')')

             $('#modalEdicion').modal('show')
        }

        function editarLocal(idL, idE)
        {
            var nPrecio = $('#precioEdit')
            if(!nPrecio.val()){
                nPrecio.val(0)
            }
            


            var nCantidad  = $('#cantEdit')


            if(!nCantidad.val()){
                nCantidad.val(0)
            }
            
            $.confirm({
                title: 'Información',
                content: 'Confirme para programar el descuento',
                buttons: {
                    confirm:
                        {
                        text: 'Confirmar',
                        btnClass: 'btn-success',
                        action: function (){
                            $('#listLocalidades').html('<div class="spinner-grow text-primary" role="status">+<span class="sr-only">Loading...</span>+</div>')
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });
                                $.post( '/updateLocal', { id: idL, nPrecio: nPrecio.val(),nCantidad:nCantidad.val()})
                                .done(function( data ) {
                                    nPrecio.val('');
                                    nPrecio.val('');
                                
                                    $('#modalEdicion').modal('hide');
                                    Swal.fire({
                                        title: 'Información',
                                        text: data,
                                        icon: 'success',
                                        confirmButtonText: 'Ok'
                                        })
                                    setTimeout(() => {
                                        listarLocalidades(idE)  
                                    }, '1000');
                                }).fail(function(e){
                                    console.log(e)
                                    Swal.fire({
                                        title: 'Alerta',
                                        text: 'A ocurrido un error inesperado',
                                        icon: 'error',
                                        confirmButtonText: 'Ok'
                                        })
                                })
                                ;


                        }
                      },
                    cancel: {
                        text: 'Cancelar',
                        btnClass: 'btn-danger',
                        action: function (){}
                    },
                
                }
            });



        }

      


     // Get the elements
        var from_input = $('#startingDate').pickadate(),
        from_picker = from_input.pickadate('picker')
        var to_input = $('#endingDate').pickadate(),
        to_picker = to_input.pickadate('picker')

        // Check if there’s a “from” or “to” date to start with and if so, set their appropriate properties.
        if ( from_picker.get('value') ) {
        to_picker.set('min', from_picker.get('select'))
        }
        if ( to_picker.get('value') ) {
        from_picker.set('max', to_picker.get('select'))
        }

        // Apply event listeners in case of setting new “from” / “to” limits to have them update on the other end. If ‘clear’ button is pressed, reset the value.
        from_picker.on('set', function(event) {
        if ( event.select ) {
        to_picker.set('min', from_picker.get('select'))
        }
        else if ( 'clear' in event ) {
        to_picker.set('min', false)
        }
        })
        to_picker.on('set', function(event) {
        if ( event.select ) {
        from_picker.set('max', to_picker.get('select'))
        }
        else if ( 'clear' in event ) {
        from_picker.set('max', false)
        }
        })
    </script>
@endsection