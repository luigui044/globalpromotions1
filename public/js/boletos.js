const localidad = document.querySelector('#localidad');
const btnBoletos = document.querySelector('#btn-boletos');
const mesas = document.querySelector('.mesas');
const resumen = document.querySelector('#resumen-compra');

const validandoCamposEntrada = () => {
    const errorLocalidad = document.querySelector('#error-localidad');
    const errorCantidad = document.querySelector('#error-cantidad');
    const cantidad = document.querySelector('#cantidad');
    let errores = 0;

    if(estaVacio(localidad.value)) {
        errorLocalidad.textContent = 'Seleccione una localidad';
        errores += 1;
    } else {
        errorLocalidad.textContent = '';
    }

    if(estaVacio(cantidad.value)) {
        errorCantidad.textContent = 'Seleccione la cantidad de entradas';
        errores += 1;
    } else {
        errorCantidad.textContent = '';
    }
    return errores;
}

const ocultarLocalidades = () => {
    const localidades = document.querySelectorAll(`div[id^="localidad"]`);
    localidades.forEach(localidad => {
        localidad.style.display = 'none';
    });
}

const eliminarSignoDolar = (valor) => {
    return valor.replace('$', '');
}

const resumenCompra = () => {
    const titulo = document.querySelector('#titulo');
    const seleccionEntradas = document.querySelector('#comprar-boletos');
    const elPrecio = document.querySelector('#precio');
    const elCantidadBoletos = document.querySelector('#cantidad-boletos');
    const elSubtotal = document.querySelector('#subtotal');
    const elTotal = document.querySelector('#total');
    const elRecargos = document.querySelector('#recargos');
    const elDescuento = document.querySelector('#descuento'); 
    elCantidadBoletos.textContent = cantidad.value;
    const precio = parseFloat(eliminarSignoDolar(elPrecio.textContent));
    const cantidadBoletos = parseFloat(cantidad.value);
    const subtotal = cantidadBoletos * precio;
    const descuento = parseFloat(eliminarSignoDolar(elDescuento.textContent));
    const recargos = parseFloat(eliminarSignoDolar(elRecargos.textContent));
    const total = subtotal - d
    
    escuento  + recargos;
    elSubtotal.textContent = `$${subtotal.toFixed(2)}`;
    elTotal.textContent = `$${total.toFixed(2)}`;

    // Mostrando resumen
    resumen.style.display = 'block';
    // Ocultando selección de entradas
    seleccionEntradas.style.display = 'none';
    // Cambiando titulo de sidebar
    titulo.textContent = 'Resumen de compra'
}

// Ocultando todas las localidades
ocultarLocalidades();
// Ocultando por defecto el resumen de compra
resumen.style.display = 'none';

const cantidadAsientosSeleccionada = () => {
    const asientosSeleccionados = document.getElementById("selectSeats");
    const arrayAsientos = asientosSeleccionados.value.split(',');

    if (arrayAsientos[0] == "") {
        return arrayAsientos.length - 1;
    }
    return arrayAsientos.length
}

async function consultarUbicacion(url, asiento) {
    const loader = document.querySelector('.mi-loader');
    try {
        loader.className = 'mi-loader animate__animated animate__fadeIn';
        const response = await fetch(url, {
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.getElementsByTagName('meta')['csrf-token'].content 
            },
            method: 'POST',
            body: JSON.stringify({
                ubicacion: asiento
            }),
        });

        if (response.status === 200) {
            const data = await response.json();
            loader.className = 'mi-loader d-none';
            return data;
        }
        loader.className = 'mi-loader d-none';
        return false;
    } catch(error) {
        console.error(error);
        loader.className = 'mi-loader d-none';
        return false;
    }
}

async function ubicacionDisponible(asiento) {
    try {
        const url = route('ubicacion-disponible');
        const datos = await consultarUbicacion(url, asiento);
        return datos;
    } catch(error) {
        console.error(error);
        return false;
    }
}

async function agregarReservaUbicacion(ubicacion) {
    const loader = document.querySelector('.mi-loader');
    try {
        loader.className = 'mi-loader animate__animated animate__fadeIn';
        const response = await fetch(route('reserva-tmp'), {
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.getElementsByTagName('meta')['csrf-token'].content 
            },
            method: 'POST',
            body: JSON.stringify({
                ubicacion: ubicacion
            }),
        });

        if (response.status === 200) {
            const data = await response.json();
            loader.className = 'mi-loader d-none';
            return data;
        }
        loader.className = 'mi-loader d-none';
        return false;
    } catch(error) {
        console.error(error);
        loader.className = 'mi-loader d-none';
        return false;
    }
}

async function eliminarReservaUbicacion(ubicacion) {
    const loader = document.querySelector('.mi-loader');
    try {
        loader.className = 'mi-loader animate__animated animate__fadeIn';
        const response = await fetch(route('eliminar-reserva-tmp'), {
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.getElementsByTagName('meta')['csrf-token'].content 
            },
            method: 'POST',
            body: JSON.stringify({
                ubicacion: ubicacion
            }),
        });

        if (response.status === 200) {
            const data = await response.json();
            loader.className = 'mi-loader d-none';
            return data;
        }
        loader.className = 'mi-loader d-none';
        return false;
    } catch(error) {
        console.error(error);
        loader.className = 'mi-loader d-none';
        return false;
    }
}

async function obtenerUbicacionesReservadas(idEvento) {
    try {
        const response = await fetch(route('ubicaciones-reservadas', idEvento), {
            headers: {
                'Content-Type': 'application/json',
            },
        });

        if (response.status === 200) {
            const data = await response.json();
            return data;
        }
        return false;
    } catch(error) {
        console.error(error);
        return false;
    }
}

const obtenerIdEnlaceUbicacion = (mesa, asiento) => {
    return `mesa${mesa}-asiento${asiento}-link`;
}

const obtenerIdCirculo = (idEnlaceUbicacion) => {
    return idEnlaceUbicacion.replace('-link', '');
}

const establecerUbicacionesReservadas = (ubicaciones) => {
    let idEnlace, idCirculo, enlace, circulo;
    ubicaciones.forEach(ubicacion => {
        idEnlace = obtenerIdEnlaceUbicacion(ubicacion.mesa, ubicacion.asiento);
        idCirculo = obtenerIdCirculo(idEnlace);
        enlace = document.getElementById(idEnlace);
        circulo = document.getElementById(idCirculo);
        // Se elimina la función para agregar asiento
        enlace.removeAttribute('onclick');
        circulo.style.fill = '#e63946';
    });
}

const agregarAsientos = (ubicacion) => {
    const asientos = document.getElementById("selectSeats");
    if (asientos.value == "") {
        asientos.value = ubicacion;
    } else {
        asientos.value = asientos.value + "," + ubicacion;
    }
}

async function reserva(identificador, seleccionado) {
    // Obteniendo circulo del svg
    const asiento = document.getElementById(identificador);
    // Obteniendo enlace del svg
    const link = document.getElementById(asiento.id + "-link");
    // Input oculto donde almacenan los asientos seleccionados
    const selectSeats = document.getElementById("selectSeats");
    // Se guarda el asiento actual
    const asientoActual = document.getElementById('asiento-actual');

    if (seleccionado) {
        // Cuando ya se han seleccionado todos los asientos indicados no se pueden escoger más
        if (cantidadAsientosSeleccionada() == cantidad.value) {
            alertify.alert('Información', `Ya han sido seleccionados los ${cantidad.value} asientos.`);
            return false;
        }
        // Guardamos el asiento actual
        asientoActual.value = asiento.id;
        const res = await ubicacionDisponible(asientoActual.value);

        if (res.estado) {
            agregarAsientos(asiento.id);
            // Insertando registro en la base de datos
            const reserva = await agregarReservaUbicacion(asientoActual.value);

            if (reserva) {
                asiento.style.fill = "#eca72c";
                link.removeAttribute("onclick");
                link.setAttribute("onclick", 'reserva("' + asiento.id + '", false)');
                alertify.notify('Ubicación agregada', 'success', 4);
            }

            if (!reserva) {
                alertify.notify('No se pudo agregar la ubicación', 'error', 4);
            }
        } 

        if (!res.estado) 
            alertify.alert('Información', `Esta ubicación no se encuentra disponible.`);

        return true;
    } 

    if (!seleccionado) {
        if (selectSeats.value.indexOf("," + asiento.id) !== -1) {
            var removeSeat = selectSeats.value.replace("," + asiento.id, "");
            selectSeats.value = removeSeat;
        } else if (selectSeats.value.indexOf(asiento.id) !== -1) {
            var removeSeat = selectSeats.value.replace(asiento.id, "");
            selectSeats.value = removeSeat;
        }
        // Se elimina el asiento actual
        asientoActual.value = '';
        // Eliminando registro en la base de datos
        const res = await eliminarReservaUbicacion(asiento.id);

        if (res) {
            asiento.style.fill = "#8ac926";
            link.removeAttribute("onclick");
            link.setAttribute("onclick", 'reserva("' + asiento.id + '", true)');
            alertify.notify('Ubicación deseleccionada', 'success', 4);
        }

        if (!res) {
            alertify.notify('No se pudo eliminar la ubicación seleccionada.', 'error', 4);
        }
        
    }
}


     /////realizamos disparador para cuando la localidad se cambie, se actualice el select de cantidad correspondiendo a la cantidad disponible de esa localidad
     $('#localidad').change(function() {
        var id = $('#localidad option:selected').val()
        
        if(  id !==undefined){
        filtrarDisLocalidad(id)
     }
    })
    //// funcion que filtra la cantidad disponible por lo calidad, si tiene disponible igual o mas de 8, el select devolvera de 1 a 8 opciones y si es menor a 8 solo devolvera la cantidad disponible
    function filtrarDisLocalidad(id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.post('/filDisLocalidad', {
                id: id
            })
            .done(function(data) {
                $('#filtrarCantidad').html(data);
                $("#cantidad").materialSelect();
            }).fail(function(e) {
              
                Swal.fire({
                    title: 'Alerta',
                    text: 'A ocurrido un error inesperado',
                    icon: 'error',
                    confirmButtonText: 'Ok'
                })
            });
    }

    ////funcion que esta como onclick en el boton volver para regresar a la seleccion de localidades
    
    function returnSelectAs()
    {
        var comprarBoletos = $('#comprar-boletos');
        var resumenCompra = $('#resumen-compra');
        Swal.fire({
            title: 'Al regresar se eliminara la localidad seleccionada, ¿Desea continuar?',
 
            showCancelButton: true,
            confirmButtonText: 'Continuar',
            cancelButtonText: `Cancelar`,
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
          
                    resetSelect('#cantidad')
                    resetSelect('#localidad')
                    $('#localidad').attr('disabled','disabled')
                     comprarBoletos.fadeIn();
                     resumenCompra.fadeOut()
                    $('#vistaLocalidad').html('<div id="vistaLocalidad">'+
                                '<img src="'+evento.imagen_lugar+'" style="width: 50%">'+
                            '</div>'+
                            '<input type="hidden" name="selectSeats2" id="selectSeats2" value="">')
            } else if (result.isDenied) {
                Swal.fire('Changes are not saved', '', 'info')
            }
            })
    }

    ///funcion para resetear los material selects
    function resetSelect(id) {
        $(id).materialSelect('destroy');
        $(id).val('0').change();
        if( id == '#cantidad'){
            $(id).prop('disabled',true)
        }
        $(id).materialSelect();
    }

    //////funcion para filtrar mapa de localidad si es que la tiene

    function selectAsientos() {
        const localidad = $('#localidad option:selected').val()
        const localidadText = $('#localidad option:selected').text()
        const localidadIndex = $('#localidad ').index()-1;
        const cantidad = $('#cantidad option:selected').val();
        const precioUnit = localidades[localidadIndex].precio;
        const precioUnitDiv  =$('#precioUnit');
        const subTotal = precioUnit * cantidad;
        const subTotalDiv = $('#subTotalDiv');
        const subTotalInput  = $('#subTotal')
        const total = subTotal;
        const totalDiv = $('#total');


        
       
 
        const errores = validandoCamposEntrada();
        if (errores == 0) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post('/selectAsientos', {
                    id: localidad
                })
                .done(function(data) {
                    ////se agrega la vista que retorna la funcion ajax al div vistaLocalidad
                    $('#vistaLocalidad').html(data)
               

                    const scrollable = document.querySelector('.scrollable');
                    const contenedorUbicaciones = document.querySelector('.area-zoom');
                    const aumentar = document.querySelector('#aumentar');
                    const disminuir = document.querySelector('#disminuir');
                    ////declaro los div de compra y resumen de boletos
                    var comprarBoletos = $('#comprar-boletos');
                    var resumenCompra = $('#resumen-compra');
                    var cantidadBoletos = $('#cantidad-boletos');
                    var localidadBoletos= $('#localidad-boletos');
                    var monto  = $('#amount')
    
                    let contador = 0;

                    if (aumentar && disminuir) {

                        disminuir.disabled = true;

                        const aumentarZoomConClick = () => {
                            contador += 1;

                            switch (contador) {
                                case 1:
                                    contenedorUbicaciones.style.transform = 'scale(140%)';
                                    disminuir.disabled = false;
                                    break;
                                case 2:
                                    contenedorUbicaciones.style.transform = 'scale(165%)';
                                    break;
                                case 3:
                                    contenedorUbicaciones.style.transform = 'scale(195%)';
                                    aumentar.disabled = true;
                                    break;
                                case 4:
                                    contenedorUbicaciones.style.transform = 'scale(100%)';
                                    aumentar.disabled = false;
                                    disminuir.disabled = true;
                                    contador = 0;
                                    break;
                            }
                        }

                        const aumentarZoomConBoton = () => {
                            aumentar.disabled = false;
                            contador += 1;

                            switch (contador) {
                                case 1:
                                    contenedorUbicaciones.style.transform = 'scale(140%)';
                                    disminuir.disabled = false;
                                    break;
                                case 2:
                                    contenedorUbicaciones.style.transform = 'scale(165%)';
                                    break;
                                case 3:
                                    contenedorUbicaciones.style.transform = 'scale(195%)';
                                    aumentar.disabled = true;
                                    break;
                            }
                        }

                        const disminuirZoomConBoton = () => {
                            disminuir.disabled = false;

                            switch (contador) {
                                case 1:
                                    contenedorUbicaciones.style.transform = 'scale(100%)';
                                    disminuir.disabled = true;
                                    break;
                                case 2:
                                    contenedorUbicaciones.style.transform = 'scale(140%)';
                                    break;
                                case 3:
                                    contenedorUbicaciones.style.transform = 'scale(165%)';
                                    aumentar.disabled = false;
                                    break;
                            }

                            contador -= 1;
                        }

                        contenedorUbicaciones.addEventListener('dblclick', aumentarZoomConClick);
                        aumentar.addEventListener('click', aumentarZoomConBoton);
                        disminuir.addEventListener('click', disminuirZoomConBoton);

                        /* * Drag and Scroll */
                        let pos = {
                            top: 0,
                            left: 0,
                            x: 0,
                            y: 0
                        };

                        const mouseMoveHandler = (e) => {
                            const dx = e.clientX - pos.x;
                            const dy = e.clientY - pos.y;

                            // Hacer scroll hasta elemento
                            scrollable.scrollTop = pos.top - dy;
                            scrollable.scrollLeft = pos.left - dx;
                        }

                        const mouseUpHandler = () => {
                            document.removeEventListener('mousemove', mouseMoveHandler);
                            document.removeEventListener('mouseup', mouseUpHandler);
                            contenedorUbicaciones.style.cursor = 'grab';
                            contenedorUbicaciones.style.removeProperty('user-select');
                        }

                        const mouseDownHandler = (e) => {
                            contenedorUbicaciones.style.cursor = 'grabbing';
                            contenedorUbicaciones.style.userSelect = 'none';

                            pos = {
                                // Obteniendo scroll actual
                                top: scrollable.scrollTop,
                                left: scrollable.scrollLeft,
                                // Obtener la ubicación actual del mouse
                                x: e.clientX,
                                y: e.clientY,
                            };

                            document.addEventListener('mousemove', mouseMoveHandler);
                            document.addEventListener('mouseup', mouseUpHandler);
                        }

                        contenedorUbicaciones.addEventListener('mousedown', mouseDownHandler);
                        
                    }

                    cantidadBoletos.html(cantidad)
                    localidadBoletos.html(localidadText)
                    precioUnitDiv.html('$'+precioUnit)
                    subTotalDiv.html('$'+subTotal.toFixed(2))
                    totalDiv.html('$'+total.toFixed(2))
                    monto.val(total.toFixed(2))
                    subTotalInput.val(subTotal.toFixed(2))
                    /////desaparesco el div de compra de boletos y muestro el resumen
                    comprarBoletos.fadeOut();
                    resumenCompra.fadeIn();
                });

        }
    }
