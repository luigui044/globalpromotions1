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

async function agregarPrerreservaUbicacion(ubicacion) {
    try {
        const response = await fetch(route('prerreserva'), {
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.getElementsByTagName('meta')['csrf-token'].content 
            },
            method: 'POST',
            body: JSON.stringify({
                id_evento: ubicacion.idEvento,
                id_localidad: ubicacion.idLocalidad,
                mesa: ubicacion.mesa,
                asiento: ubicacion.asiento,
                prerreserva: ubicacion.prerreserva,
            }),
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

async function obtenerUbicacionesVendidas(datos) {
    const loader = document.querySelector('.mi-loader');
    try {
        loader.className = 'mi-loader animate__animated animate__fadeIn';
        const response = await fetch(route('ubicaciones-vendidas', [datos.id_evento, datos.id_localidad]), {
            headers: {
                'Content-Type': 'application/json',
            },
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

const obtenerIdEnlaceUbicacion = (mesa, asiento) => {
    return `mesa${mesa}-asiento${asiento}-link`;
}

const obtenerIdCirculo = (idEnlaceUbicacion) => {
    return idEnlaceUbicacion.replace('-link', '');
}

/*
    Coloca en color rojo los asientos vendidos (círculos) y elimina el evento onclick para
    que no haga ninguna acción al presionar el círculo
*/
const establecerUbicacionesVendidas = (ubicaciones) => {
    let idEnlace, idCirculo, enlace, circulo;

    if (Array.isArray(ubicaciones)) {
        if (ubicaciones.length > 0) {
            ubicaciones.forEach(ubicacion => {
                idEnlace = obtenerIdEnlaceUbicacion(ubicacion.mesa, ubicacion.asiento);
                idCirculo = obtenerIdCirculo(idEnlace);
                enlace = document.getElementById(idEnlace);
                circulo = document.getElementById(idCirculo);
                enlace.removeAttribute('onclick');
                circulo.style.fill = '#e63946';
            });
        }
    } else {
        idEnlace = obtenerIdEnlaceUbicacion(ubicaciones.mesa, ubicaciones.asiento);
        idCirculo = obtenerIdCirculo(idEnlace);
        enlace = document.getElementById(idEnlace);
        circulo = document.getElementById(idCirculo);
        enlace.removeAttribute('onclick');
        circulo.style.fill = '#e63946';
    } 
}

// Agrega los id de asientos en el input de tipo hidden separados por coma (,)
const agregarAsiento = (ubicacion) => {
    const asientos = document.getElementById("selectSeats");
    if (asientos.value == "") {
        asientos.value = ubicacion;
    } else {
        asientos.value = asientos.value + "," + ubicacion;
    }
}

// Con esta función se elimina del input de tipo hidden el identificador de la mesa y el asiento 
const eliminarAsiento = (ubicacion) => {
    const asientos = document.getElementById('selectSeats');
    if (asientos.value.indexOf("," + ubicacion) !== -1) {
        const borrarAsiento = asientos.value.replace("," + ubicacion, "");
        asientos.value = borrarAsiento;
    } else if (asientos.value.indexOf(ubicacion) !== -1) {
        const borrarAsiento = selectSeats.value.replace(ubicacion, "");
        asientos.value = borrarAsiento;
    }
}

// Objeto Toast de SweetAlert para mostrar notificaciones
const Toast = Swal.mixin({
    toast: true,
    position: 'bottom-right',
    iconColor: 'white',
    customClass: {
      popup: 'colored-toast'
    },
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true
});

const mensajeCantidadAsientos = (cantidadAsientos) => {
    if (cantidadAsientos == 1)
        return 'Solo puede seleccionar un asiento';
    return `Ya han sido seleccionados los ${cantidadAsientos} asientos.`
}

/* 
    Con esta función se cambia el color del asiento seleccionado a anaranjado (reservado)
    y se elimina el evento onclick para que no pueda ejecutar ninguna acción
*/
const mostrarUbicacionPrerreservada = (mesa, asiento) => {
    const idEnlaceUbicacion = obtenerIdEnlaceUbicacion(mesa, asiento);
    const idCirculo = obtenerIdCirculo(idEnlaceUbicacion);
    const enlaceUbicacion = document.getElementById(idEnlaceUbicacion);
    const circulo = document.getElementById(idCirculo);
    circulo.style.fill = "#eca72c";
    enlaceUbicacion.removeAttribute("onclick");
}

/* 
    Con esta función se cambia el color del asiento seleccionado a verde (disponible)
    y se agrega nuevamente la función onclick para que puedan prerreservar el asiento
*/
const mostrarUbicacionDisponible = (mesa, asiento) => {
    const idEnlaceUbicacion = obtenerIdEnlaceUbicacion(mesa, asiento);
    const idCirculo = obtenerIdCirculo(idEnlaceUbicacion);
    const enlaceUbicacion = document.getElementById(idEnlaceUbicacion);
    const circulo = document.getElementById(idCirculo);
    circulo.style.fill = "#8ac926";
    enlaceUbicacion.removeAttribute("onclick");
    enlaceUbicacion.setAttribute("onclick", 'reserva("' + idCirculo + '", true)');
}

const obtenerNumeroMesaYAsiento = (identificador) => {
    const mesaSilla = identificador.replace('mesa', '').replace('asiento', '');
    const partes = mesaSilla.split('-');
    const mesa = partes[0];
    const asiento = partes[1];
    const ubicacion = {
        mesa: mesa,
        asiento: asiento
    }
    return ubicacion;
}

// En esta función se gestiona la prerreserva del asiento
async function reserva(identificador, seleccionado) {
    // Obteniendo circulo del svg
    const asiento = document.getElementById(identificador);
    // Obteniendo enlace del svg
    const link = document.getElementById(asiento.id + "-link");
    // Se guarda el asiento actual
    const asientoActual = document.getElementById('asiento-actual');
    // Cantidad de asientos indicada por el usuario
    const cantidad = document.querySelector('#cantidad');
    // En este objeto se guarda la mesa y asiento seleccionado por el usuario
    const ubicacion = obtenerNumeroMesaYAsiento(identificador);
    // Objeto donde se guarda la información enviada al evento del websockets
    const datosWS = ubicacion;
    datosWS.idEvento = evento.id_evento; // Variable pasada desde controlador de Laravel
    datosWS.idLocalidad = localidad.value;

    if (seleccionado) {
        // Cuando ya se han seleccionado todos los asientos indicados no se pueden escoger más
        if (cantidadAsientosSeleccionada() == cantidad.value) {
            Swal.fire(
                'Información',
                mensajeCantidadAsientos(cantidad.value)
            );
            return true;
        }

        // Guardamos el asiento actual
        asientoActual.value = asiento.id;
        agregarAsiento(asiento.id);
        datosWS.prerreserva = true;
        const prerreserva = await agregarPrerreservaUbicacion(datosWS);

        if (prerreserva) {
            // Se cambia el color del asiento a anaranjado y se cambian los parámetros de la función reserva
            // llamada en el onclick
            asiento.style.fill = "#eca72c";
            link.removeAttribute("onclick");
            link.setAttribute("onclick", 'reserva("' + asiento.id + '", false)');
            
            await Toast.fire({
                icon: 'success',
                title: `Ubicación seleccionada. Mesa: ${ubicacion.mesa} | Asiento: ${ubicacion.asiento}`
            });

            return true;
        }

        if (!prerreserva) {
            await Toast.fire({
                icon: 'error',
                title: `Ocurrió un error al intentar seleccionar la ubicación. Mesa: ${ubicacion.mesa} | Asiento: ${ubicacion.asiento}`
            });
            return true;
        }
    } 

    if (!seleccionado) {
        eliminarAsiento(asiento.id);
        // Se elimina el asiento actual
        asientoActual.value = '';
        datosWS.prerreserva = false;
        const prerreserva = await agregarPrerreservaUbicacion(datosWS);

        if (prerreserva) {
            // Se coloca el asiento de nuevo en color verde y se ajustan los parámetros de la función reserva() 
            asiento.style.fill = "#8ac926";
            link.removeAttribute("onclick");
            link.setAttribute("onclick", 'reserva("' + asiento.id + '", true)');

            await Toast.fire({
                icon: 'info',
                title: `Ubicación deseleccionada. Mesa: ${ubicacion.mesa} | Asiento: ${ubicacion.asiento}`
            });
            return true;
        }

        if (!prerreserva) {
            await Toast.fire({
                icon: 'error',
                title: `Ocurrió un error al intentar deseleccionar la ubicación. Mesa: ${ubicacion.mesa} | Asiento: ${ubicacion.asiento}`
            });
            return true;
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
                    resetSelect('#cantidad');
                    resetSelect('#localidad');
                    $('#localidad').prop('disabled',false);
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
        const subTotalDiv = $('#subTotalDiv');
        const subTotalInput  = $('#subTotal');
        const precioUnitDiv  =$('#precioUnit');
        const totalDiv = $('#total');
        const cantidad = $('#cantidad option:selected').val();
        const localidad = $('#localidad option:selected').val();
        const localidadText = $('#localidad option:selected').text();
        ///es importante que el index lleve el -1 ya que eso sirve para navegar en el array localidades y seleccionar el precio
        let localidadIndex = $('#localidad').prop('selectedIndex')-1;
        let precioUnit = localidades[localidadIndex].precio;
        let subTotal = precioUnit * cantidad;
        let total = subTotal;
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
                .done(async function(data) {

         
                    ////se agrega la vista que retorna la funcion ajax al div vistaLocalidad
                    $('#vistaLocalidad').html(data)
                    // Botones para aumentar y disminuir zoom del mapa de las ubicaciones
                    const btnAumentar = document.querySelector('#aumentar');
                    const btnDisminuir = document.querySelector('#disminuir');
                    ////declaro los div de compra y resumen de boletos
                    var comprarBoletos = $('#comprar-boletos');
                    var resumenCompra = $('#resumen-compra');
                    var cantidadBoletos = $('#cantidad-boletos');
                    var localidadBoletos= $('#localidad-boletos');
                    var monto  = $('#amount')

                    /* Si se muestran en el html los botones de aumentar y disminuir zoom se deben agregar las funcionalidades
                        para que realicen la acción de zoom     
                    */ 
                    if (btnAumentar && btnDisminuir) {
                        zoom();  
                        // Se muestran en el mapa las ubicaciones vendidas
                        const datosEvento = {
                            id_evento: evento.id_evento, // Variable pasada desde el controlador de Laravel
                            id_localidad: localidad
                        };
                        const ubicacionesVendidas = await obtenerUbicacionesVendidas(datosEvento);
                        establecerUbicacionesVendidas(ubicacionesVendidas);

                        /*
                            Escuchando eventos del websocket:
                            Se manda a llamar el canal por su nombre y que escuche el evento de dicho canal para poder utilizar
                            los datos devueltos por el evento, en este caso el evento devuelve el identificador de la mesa y asiento
                            seleccionado por un usuario para que se muestre como NO disponible para los demás usuarios que están comprando
                        */

                        Echo.channel(`prerreservamesa.${evento.id_evento}.${localidad}`)
                            .listen('NewPreReservaMesa', (e) => {
                                const mesa = e.mesa;
                                const asiento = e.asiento;
                                const prerreserva = e.prerreserva;

                                // Si el estado de prerreserva es verdadero
                                if (prerreserva) {
                                    mostrarUbicacionPrerreservada(mesa, asiento);
                                } else {
                                    // Si el estado de prerreserva es falso, es decir, se ha liberado este asiento
                                    mostrarUbicacionDisponible(mesa, asiento);
                                }
                        
                            })
                            .listen('NewVentaTicketMesa', (e) => {
                                // Cuando un nuevo ticket es vendido se actualiza en tiempo real como no disponible
                                const mesa = e.mesa;
                                const asiento = e.asiento; 
                                const ubicacion = {
                                    mesa: mesa,
                                    asiento: asiento
                                };
                                establecerUbicacionesVendidas(ubicacion);
                            });
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

