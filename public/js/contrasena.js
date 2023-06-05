const mostrarContrasena = (boton) => {
    const input = boton.nextElementSibling;
    if (input.type == 'password') {
        input.type = 'text',
        boton.className = 'fa-solid fa-eye-slash input-prefix icono-password';
    } else {
        input.type = 'password'
        boton.className = 'fa-solid fa-eye input-prefix icono-password';
    }
}

const form = document.querySelector('#frm-actualizar-password');
const inputPasswordActual = document.querySelector('#contrasena_actual');
const inputPasswordNueva = document.querySelector('#contrasena_nueva');
const inputPasswordConfirmar = document.querySelector('#confirmar_contrasena');

const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: 'btn btn-success',
      cancelButton: 'btn btn-danger'
    },
    buttonsStyling: false
});
  
form.addEventListener('submit', (e) => {
    e.preventDefault();
    let errores = 0;

    if (estaVacio(inputPasswordActual.value)) {
        errores += 1;
        agregarError(
            inputPasswordActual,
            inputPasswordActual.nextElementSibling,
            'Ingrese su contraseña actual'
        );
    } else {
        limpiarError(inputPasswordActual, inputPasswordActual.nextElementSibling);
    }

    if (estaVacio(inputPasswordNueva.value)) {
        errores += 1;
        agregarError(
            inputPasswordNueva,
            inputPasswordNueva.nextElementSibling,
            'Ingrese su nueva contraseña'
        );
    } else if (!longitudMinima(inputPasswordNueva.value, 8)) {
        errores += 1;
        agregarError(
            inputPasswordNueva,
            inputPasswordNueva.nextElementSibling,
            'La contraseña debe tener mínimo 8 caracteres'
        );
    } else {
        limpiarError(inputPasswordNueva, inputPasswordNueva.nextElementSibling);
    }

    if (estaVacio(inputPasswordConfirmar.value)) {
        errores += 1;
        agregarError(
            inputPasswordConfirmar,
            inputPasswordConfirmar.nextElementSibling,
            'Confirme su contraseña nueva'
        );
    } else if (inputPasswordConfirmar.value != inputPasswordNueva.value) {
        errores += 1;
        agregarError(
            inputPasswordConfirmar,
            inputPasswordConfirmar.nextElementSibling,
            'Las contraseñas nuevas ingresadas no coinciden'
        );
    } else {
        limpiarError(inputPasswordConfirmar, inputPasswordConfirmar.nextElementSibling);
    }

    if (errores == 0) {
        swalWithBootstrapButtons.fire({
            title: '¿Está seguro/a de actualizar su contraseña?',
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
});