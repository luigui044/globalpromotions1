const localidad = document.querySelector('#localidad');
const btnBoletos = document.querySelector('#btn-boletos');
const mesas = document.querySelector('.mesas');
const resumen = document.querySelector('#resumen-compra');
const btnPagarPayPal = document.getElementById('paypal-button-container');
// Botón que simula el btn de PayPal desactivado
const btnDesactivadoPayPal = document.getElementById('btn-desactivado-pagar')
// Ocultando por defecto el resumen de compra
resumen.style.display = 'none';

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

const eliminarSignoDolar = (valor) => {
    return valor.replace('$', '');
}

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

async function guardarPrerreservaUbicacion(ubicacion) {
    try {
        const response = await fetch(route('prerreserva.guardar'), {
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

async function eliminarPrerreservaUbicacion(ubicacion) {
    try {
        const response = await fetch(route('prerreserva.eliminar'), {
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

async function liberarPrerreserva(datos) {
    try {
        const response = await fetch(route('prerreserva.liberar'), {
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.getElementsByTagName('meta')['csrf-token'].content 
            },
            method: 'POST',
            body: JSON.stringify({
                id_localidad: datos.idLocalidad,
                id_evento: datos.idEvento,
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

async function obtenerUbicacionesPrerreservadas(datos) {
    const loader = document.querySelector('.mi-loader');
    try {
        loader.className = 'mi-loader animate__animated animate__fadeIn';
        const response = await fetch(route('ubicaciones-prerreservadas', [datos.id_evento, datos.id_localidad]), {
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
                if (enlace != null && circulo != null) {
                    enlace.removeAttribute('onclick');
                    circulo.style.fill = '#e63946';
                }
            });
        }
    } else {
        idEnlace = obtenerIdEnlaceUbicacion(ubicaciones.mesa, ubicaciones.asiento);
        idCirculo = obtenerIdCirculo(idEnlace);
        enlace = document.getElementById(idEnlace);
        circulo = document.getElementById(idCirculo);
        if (enlace != null && circulo != null) {
            enlace.removeAttribute('onclick');
            circulo.style.fill = '#e63946';
        }
    } 
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

const establecerUbicacionesPrerreservadas = (ubicaciones) => {
    if (Array.isArray(ubicaciones)) {
        if (ubicaciones.length > 0) {
            ubicaciones.forEach(ubicacion => {
                mostrarUbicacionPrerreservada(ubicacion.mesa, ubicacion.asiento);
            });
        }
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
    let borrarAsiento = '';
    if (asientos.value.indexOf("," + ubicacion) !== -1) {
        borrarAsiento = asientos.value.replace("," + ubicacion, "");
        asientos.value = borrarAsiento;
    } else if (asientos.value.indexOf(ubicacion) !== -1) {
        const cantidadAsientos = asientos.value.split(',').length;
        if (cantidadAsientos == 1)
            borrarAsiento = selectSeats.value.replace(ubicacion, "");
        if (cantidadAsientos > 1)
            borrarAsiento = selectSeats.value.replace(ubicacion + ",", "");
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

        agregarAsiento(asiento.id);

        datosWS.prerreserva = true;
        // Aquí se dispara el evento del websockets para la prerreserva del asiento
        const prerreserva = await agregarPrerreservaUbicacion(datosWS);

        if (prerreserva) {
            // Se cambia el color del asiento a anaranjado y se cambian los parámetros de la función reserva()
            // llamada en el onclick
            asiento.style.fill = "#eca72c";
            link.removeAttribute("onclick");
            link.setAttribute("onclick", 'reserva("' + asiento.id + '", false)');
            
            // Se habilita el botón de pago cuando ya seleccionó todos los asientos indicados
            if (cantidadAsientosSeleccionada() == cantidad.value) {
                btnDesactivadoPayPal.style.display = 'none';
                btnPagarPayPal.style.display = 'block';
            }
            
            await Toast.fire({
                icon: 'success',
                title: `Ubicación seleccionada. ${link.getAttribute('xlink:title')}`
            });

            // Se almacena la prerreserva temporalmente en la base de datos
            //await guardarPrerreservaUbicacion(datosWS);
            return true;
        }

        if (!prerreserva) {
            await Toast.fire({
                icon: 'error',
                title: `Ocurrió un error al intentar seleccionar la ubicación. ${link.getAttribute('xlink:title')}`
            });
            return true;
        }
    } 

    if (!seleccionado) {
        eliminarAsiento(asiento.id);
        // Actualizando visibilidad de los botones de pago
        btnDesactivadoPayPal.style.display = 'flex';
        btnPagarPayPal.style.display = 'none';

        datosWS.prerreserva = false;
        const prerreserva = await agregarPrerreservaUbicacion(datosWS);

        if (prerreserva) {
            // Se coloca el asiento de nuevo en color verde y se ajustan los parámetros de la función reserva() 
            asiento.style.fill = "#8ac926";
            link.removeAttribute("onclick");
            link.setAttribute("onclick", 'reserva("' + asiento.id + '", true)');

            await Toast.fire({
                icon: 'info',
                title: `Ubicación deseleccionada. ${link.getAttribute('xlink:title')}`
            });

            // Se elimina la prerreserva de la base de datos
            //await eliminarPrerreservaUbicacion(datosWS);
            return true;
        }

        if (!prerreserva) {
            await Toast.fire({
                icon: 'error',
                title: `Ocurrió un error al intentar deseleccionar la ubicación. ${link.getAttribute('xlink:title')}`
            });
            return true;
        }
    }
}


/////realizamos disparador para cuando la localidad se cambie, se actualice el select de cantidad correspondiendo a la cantidad disponible de esa localidad
$('#localidad').change(function() {
    var id = $('#localidad option:selected').val()
    if (id !==undefined) {
        filtrarDisLocalidad(id)
    }
});

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

// Función que esta como onclick en el boton volver para regresar a la seleccion de localidades
function returnSelectAs() {
    var comprarBoletos = $('#comprar-boletos');
    var resumenCompra = $('#resumen-compra');
    Swal.fire({
        title: 'Al regresar se eliminara la localidad seleccionada, ¿Desea continuar?',
        showCancelButton: true,
        confirmButtonText: 'Continuar',
        cancelButtonText: `Cancelar`,
    }).then((result) => {
        if (result.isConfirmed) {
            // Se debe dejar de escuchar el canal y se deben liberar los asientos
            Echo.leaveChannel(`prerreservamesa.${evento.id_evento}.${localidad.value}`);
            // liberarPrerreserva({
            //     idLocalidad: localidad.value,
            //     idEvento: evento.id_evento
            // });
            // Se resetea el estado de los botones de pago de PayPal
            btnDesactivadoPayPal.style.display = 'flex';
            btnPagarPayPal.style.display = 'none';

            resetSelect('#cantidad');
            resetSelect('#localidad');
            $('#localidad').prop('disabled',false);
            comprarBoletos.fadeIn();
            resumenCompra.fadeOut();
            $('#vistaLocalidad').html('<div id="vistaLocalidad">'+
                        '<img src="'+evento.imagen_lugar+'" style="width: 50%">'+
                    '</div>'+
                    '<input type="hidden" name="selectSeats2" id="selectSeats2" value="">');
        } else if (result.isDenied) {
            Swal.fire('Changes are not saved', '', 'info')
        }
    });
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

// Función para filtrar mapa de localidad si es que la tiene
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
    // Configurando visualización de botones de pago
    btnDesactivadoPayPal.style.display = 'none';
    btnPagarPayPal.style.display = 'block';

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
                    // Se oculta el boton de paypal y se muestra hasta que se seleccione la cantidad de entradas definida por el usuario
                    btnPagarPayPal.style.display = 'none';  
                    btnDesactivadoPayPal.style.display = 'flex';

                    // Se muestran en el mapa las ubicaciones vendidas y prerreservadas
                    const datosEvento = {
                        id_evento: evento.id_evento, // Variable pasada desde el controlador de Laravel
                        id_localidad: localidad
                    };

                    const ubicacionesVendidas = await obtenerUbicacionesVendidas(datosEvento);
                    const ubicacionesPrerreservadas = await obtenerUbicacionesPrerreservadas(datosEvento);
                    establecerUbicacionesVendidas(ubicacionesVendidas);
                    establecerUbicacionesPrerreservadas(ubicacionesPrerreservadas);

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

