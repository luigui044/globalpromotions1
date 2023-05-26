const localidad = document.querySelector('#localidad');
const btnBoletos = document.querySelector('#btn-boletos');
const mesas = document.querySelector('.mesas');
const resumen = document.querySelector('#resumen-compra');

// Se oculta el resumen de la compra en un inicio
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

const cantidadAsientosSeleccionada = () => {
    const asientosSeleccionados = document.getElementById("selectSeats");
    const arrayAsientos = asientosSeleccionados.value.split(',');

    if (arrayAsientos[0] == "") {
        return arrayAsientos.length - 1;
    }
    return arrayAsientos.length;
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

// async function agregarReservaUbicacion(ubicacion) {
//     const loader = document.querySelector('.mi-loader');
//     try {
//         loader.className = 'mi-loader animate__animated animate__fadeIn';
//         const response = await fetch(route('reserva-tmp'), {
//             headers: {
//                 'Content-Type': 'application/json',
//                 'X-CSRF-TOKEN': document.getElementsByTagName('meta')['csrf-token'].content 
//             },
//             method: 'POST',
//             body: JSON.stringify({
//                 ubicacion: ubicacion
//             }),
//         });

//         if (response.status === 200) {
//             const data = await response.json();
//             loader.className = 'mi-loader d-none';
//             return data;
//         }
//         loader.className = 'mi-loader d-none';
//         return false;
//     } catch(error) {
//         console.error(error);
//         loader.className = 'mi-loader d-none';
//         return false;
//     }
// }

async function prerreservaMesaAsiento(mesa, asiento) {
    const loader = document.querySelector('.mi-loader');
    try {
        loader.className = 'mi-loader animate__animated animate__fadeIn';
        const response = await fetch(route('prerreserva-mesas'), {
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.getElementsByTagName('meta')['csrf-token'].content 
            },
            method: 'POST',
            body: JSON.stringify({
                mesa: mesa,
                asiento: asiento 
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
        // Se coloca en color rojo (no disponible) el asiento
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

async function reserva(identificador, seleccionado) {
    // Obteniendo circulo del svg
    const asiento = document.getElementById(identificador);
    // Obteniendo enlace del svg
    const link = document.getElementById(asiento.id + "-link");
    // Input oculto donde almacenan los asientos seleccionados
    const selectSeats = document.getElementById("selectSeats");
    // Se guarda el asiento actual
    const asientoActual = document.getElementById('asiento-actual');
    // Cantidad de asientos especificada por el usuario en el select
    const cantidad = document.querySelector('#cantidad');

    if (seleccionado) {
        // Cuando ya se han seleccionado todos los asientos indicados no se pueden escoger más
        if (cantidadAsientosSeleccionada() == cantidad.value) {
            alertify.alert('Información', `Ya han sido seleccionados los ${cantidad.value} asientos.`);
            return false;
        }
        // Guardamos el asiento actual
        asientoActual.value = asiento.id;
        const ubicacion = obtenerNumeroMesaYAsiento(asiento.id);
        const res = await prerreservaMesaAsiento(ubicacion.mesa, ubicacion.asiento);

        if (res) {
            // Con esta función se llena el input de tipo hidden con las ubicaciones
            // seleccionadas por el usuario separadas por coma.
            agregarAsientos(asiento.id);
            // Insertando registro en la base de datos
            //const reserva = await agregarReservaUbicacion(asientoActual.value);
            asiento.style.fill = "#eca72c";
            link.removeAttribute("onclick");
            link.setAttribute("onclick", 'reserva("' + asiento.id + '", false)');
            alertify.notify('Ubicación agregada', 'success', 4);
        } 

        if (!res) 
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
    Escuchando eventos del websocket:
    Se manda a llamar el canal por su nombre y que escuche el evento de dicho canal para poder utilizar
    los datos devueltos por el evento, en este caso el evento devuelve el identificador de la mesa y asiento
    seleccionado por un usuario para que se muestre como NO disponible para los demás usuarios que están comprando
*/

Echo.channel('PreReservaMesa').listen('NewPreReservaMesa', (e) => {
    const mesa = e.mesa;
    const asiento = e.asiento;
    mostrarUbicacionPrerreservada(mesa, asiento);
});

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
        const subTotalDiv = $('#subTotal');
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
                .done(async function(data) {
                    ////se agrega la vista que retorna la funcion ajax al div vistaLocalidad
                    $('#vistaLocalidad').html(data)
               

                    // Se guardan los botones de aumento y disminución de zoom
                    const btnAumentar = document.querySelector('#aumentar');
                    const btnDisminuir = document.querySelector('#disminuir');
                    ////declaro los div de compra y resumen de boletos
                    var comprarBoletos = $('#comprar-boletos');
                    var resumenCompra = $('#resumen-compra');
                    var cantidadBoletos = $('#cantidad-boletos');
                    var localidadBoletos= $('#localidad-boletos');

                    // Si ambos botones son diferentes de undefined quiere decir que la localidad
                    // seleccionada es de tipo Mesa o Silla por lo tanto se debe agregar la funcionalidad
                    // de hacer zoom y el drag and scroll
                    if (btnAumentar && btnDisminuir) {
                        /* 
                            Se manda a llamar la función zoom que contiene todo el código para que funcione
                            tanto el Zoom como el drag and scroll, la función está definida en el archivo zoom.js
                        */
                        zoom();

                        // Se establecen en (No disponible) las ubicaciones ya compradas
                        const ubicaciones = await obtenerUbicacionesReservadas(1);
                        establecerUbicacionesReservadas(ubicaciones);
                    }

                    cantidadBoletos.html(cantidad)
                    localidadBoletos.html(localidadText)
                    precioUnitDiv.html('$'+precioUnit)
                    subTotalDiv.html('$'+subTotal.toFixed(2))
                    totalDiv.html('$'+total.toFixed(2))
                    /////desaparesco el div de compra de boletos y muestro el resumen
                    comprarBoletos.fadeOut();
                    resumenCompra.fadeIn();
                });

        }
    }
