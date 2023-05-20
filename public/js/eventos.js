$(document).ready(function () {
    $('#dtBasicExample').DataTable();
    $('.dataTables_length').addClass('bs-select');
});




function detaEvento(id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.post( '/detEvento', { id: id})
    .done(function( data ) {
        $('.modal-body').html(data);
        $('#centralModalSm').modal('toggle');
    });
}

setTimeout(() => {
    $('#temp').fadeOut();
}, '2000');

function desactivarEvento(id){
    $.confirm({
    title: 'Alerta',
    content: '¿Esta seguro de desactivar evento?',
    buttons: {
        confirm: { 
            btnClass: 'btn-blue',
            action: function () {
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
                $.post( '/desEvento', { id: id})
                .done(function( data ) {
                    $('#estado'+id).html('<span class="badge badge-danger">Inactivo</span>');
                    $('#desa'+id).hide();
                    $('#asig'+id).hide();
                });
            }
        },
        cancel: { 
            btnClass: 'btn-danger',
        }
    }
});
}