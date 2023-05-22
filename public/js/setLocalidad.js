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