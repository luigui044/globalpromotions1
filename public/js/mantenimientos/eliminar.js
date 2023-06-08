const btns = document.querySelectorAll('.btn-eliminar');

btns.forEach(btn => {
    btn.addEventListener('click', (e) => {
        e.preventDefault();
        swalWithBootstrapButtons.fire({
            title: '¿Está seguro/a de eliminar este registro?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'SÍ',
            cancelButtonText: 'NO',
            reverseButtons: true
          }).then((result) => {
            if (result.isConfirmed) {
              btn.parentElement.submit();
            } else if (
              /* Read more about handling dismissals below */
              result.dismiss === Swal.DismissReason.cancel
            ) {
              swalWithBootstrapButtons.fire(
                'Operación cancelada',
              )
            }
          })
    });
});