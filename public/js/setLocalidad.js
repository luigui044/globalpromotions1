const localidad = document.querySelector('#localidad');
const cantidad = document.querySelector('#cantidad');
const precio = document.querySelector('#precio');
const form = document.querySelector('#formLocalidad');

cantidad.addEventListener('keypress', soloNumeros);

form.addEventListener('submit', (e) => {
    e.preventDefault();
    let errores = 0;

    if (estaVacio(localidad.value)) {
        errores += 1;
        agregarError(
            localidad,
            localidad.nextElementSibling,
            'Seleccione una localidad'
        );
    } else {
        limpiarError(localidad, localidad.nextElementSibling);
    }

    if (estaVacio(cantidad.value)) {
        errores += 1;
        agregarError(
            cantidad,
            cantidad.nextElementSibling,
            'Especifique la cantidad'
        );

    } else if (cantidad.value == 0) {
        errores += 1;
        agregarError(
            cantidad,
            cantidad.nextElementSibling,
            'La cantidad debe ser mayor a cero'
        );
    } else {
        limpiarError(cantidad, cantidad.nextElementSibling);
    }

    if (estaVacio(precio.value)) {
        errores += 1;
        agregarError(
            precio,
            precio.nextElementSibling,
            'Especifique el precio ($)'
        );
    } else if (!esDecimalPositivo(precio.value)) {
        errores += 1;
        agregarError(
            precio,
            precio.nextElementSibling,
            'Ingrese un precio válido'
        );
    } else {
        limpiarError(precio, precio.nextElementSibling);
    }

    if (errores == 0) {
        $.confirm({
            title: "Confirmar información",
            content: "¿Esta seguro/a que desea asignar esta localidad?",
            buttons: {
                si: {
                    text: "SÍ",
                    btnClass: "btn-success",
                    keys: ["enter", "shift"],
                    action: function () {
                        //form.submit();
                        alert('Todo bien');
                    },
                },
                no: {
                    text: "NO",
                    btnClass: "btn-danger",
                    keys: ["enter", "shift"],
                    action: function () {
                        $.alert({
                            title: "Información",
                            content: "Operación agregar localidad cancelada",
                        });
                    },
                },
            },
        });
    }
});