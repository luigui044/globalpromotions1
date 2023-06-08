const btnGuardar = document.querySelector('#btn-guardar');
const btnAgregar = document.querySelector('#btn-agregar');
const form = document.querySelector('#frm-localidad');
const inputLocalidad = document.querySelector('#localidad');
const btnsEditar = document.querySelectorAll('.btn-editar');

const guardarinputLocalidad = (e) => {
    e.preventDefault();

    // Por si se está mostrando un error se limpia
    limpiarError(inputLocalidad, inputLocalidad.nextElementSibling);

    // Validando entrada de datos
    if (estaVacio(inputLocalidad.value)) {
        agregarError(
            inputLocalidad,
            inputLocalidad.nextElementSibling,
            'Ingrese el nombre de la localidad'
        );
        return true;
    }
    
    // Si ya ingresó la inputLocalidad se muestra un modal para confirmar la acción
    swalWithBootstrapButtons.fire({
        title: '¿Está seguro/a que desea continuar?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'SÍ',
        cancelButtonText: 'NO',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
                'Operación cancelada',
            )
        }
    })           
}


btnAgregar.addEventListener('click', () => {
    // Se limpia el input de inputLocalidad cuando se va agregar una nueva
    inputLocalidad.value = '';
    // Se establece el action del formulario con la ruta para agregar inputLocalidad
    form.action = route('administracion.localidades.guardar');
});

// Se agrega la acción de editar a cada boton
btnsEditar.forEach(btn => {
    btn.addEventListener('click', () => {
        const localidad = JSON.parse(btn.dataset.localidad);
        // Se muestra en el input del modal el valor de la inputLocalidad seleccionada
        inputLocalidad.value = localidad.des_tipo;
        // Se establece el action del formulario con la ruta para editar la inputLocalidad
        form.action = route('administracion.localidades.actualizar', localidad.id_tipo_localidad)
        // Por si se está mostrando un error se limpia
        limpiarError(inputLocalidad, inputLocalidad.nextElementSibling);
        inputLocalidad.focus();
        // Se muestra el modal
        $('#modalLocalidad').modal();
    });
});

btnGuardar.addEventListener('click', guardarinputLocalidad);