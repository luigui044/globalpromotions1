const form = document.querySelector('#frm-editar-evento');
const inputEvento = document.querySelector('#nombreEvento');
const hora = document.querySelector('#hora');
const artista = document.querySelector('#artista1');
const inputNuevoArtista = document.querySelector('#artista2');
const lugar = document.querySelector('#lugar');
const copy = document.querySelector('#copy');
const chkNuevoArtista = document.querySelector('#nartista');
const imagenLugar = document.querySelector('#fotoLugar');
const imagenBanner = document.querySelector('#fotoBanner');
const imagenPortada = document.querySelector('#fotoPortada');
const errorImgLugar = document.querySelector('#error-img-lugar');
const errorImgBanner = document.querySelector('#error-img-banner');
const errorImgPortada = document.querySelector('#error-img-portada');

form.addEventListener('submit', (e) => {
    e.preventDefault();
    let errores = 0;

    if (estaVacio(inputEvento.value)) {
        errores += 1;
        agregarError(
            inputEvento, 
            inputEvento.nextElementSibling,
            'Ingrese el nombre del evento'
        );
    } else {
        limpiarError(inputEvento, inputEvento.nextElementSibling);
    }

    if (estaVacio(document.querySelector('#fecha').value)) {
        errores += 1;
        agregarError(
            document.querySelector('#fecha'),
            document.querySelector('#fecha').nextElementSibling,
            'Especifique la fecha del evento'
        );
    } else {
        limpiarError(document.querySelector('#fecha'), document.querySelector('#fecha').nextElementSibling);
    }

    if (estaVacio(hora.value)) {
        errores += 1;
        agregarError(
            hora,
            hora.nextElementSibling,
            'Especifique la hora del evento'
        );
    } else {
        limpiarError(hora, hora.nextElementSibling);
    }

    if (estaVacio(lugar.value)) {
        errores += 1;
        agregarError(
            lugar,
            lugar.nextElementSibling,
            'Indique el lugar donde se realizará el evento'
        );
    } else {
        limpiarError(lugar, lugar.nextElementSibling);
    }

    if (estaVacio(copy.value)) {
        errores += 1;
        agregarError(
            copy,
            copy.nextElementSibling,
            'Ingrese el copy del evento'
        );
    } else {
        limpiarError(copy, copy.nextElementSibling);
    }

    // Si se agrega un nuevo artista se valida este campo
    if (chkNuevoArtista.checked) {
        if (estaVacio(inputNuevoArtista.value)) {
            errores += 1;
            agregarError(
                inputNuevoArtista,
                inputNuevoArtista.nextElementSibling,
                'Ingrese el nombre del artista'
            );
        } else {
            limpiarError(inputNuevoArtista, inputNuevoArtista.nextElementSibling);
        }
    } else {
        // Si no se agrega un nuevo artista se valida el select de los artistas 
        if (estaVacio(artista.value)) {
            errores += 1;
            agregarError(
                artista,
                artista.nextElementSibling,
                'Seleccione un artista'
            );
        } else {
            limpiarError(artista, artista.nextElementSibling);
        }
    }

    // if (!archivoSeleccionado(imagenLugar)) {
    //     errores += 1;
    //     errorImgLugar.textContent = 'Escoja una imagen del lugar donde se realizará el evento';
    // } else if (!tipoArchivo(imagenLugar)) { 
    //     errores += 1;
    //     errorImgLugar.textContent = 'Seleccione una imagen con extensión: jpg, jpeg, png, svg, gif';
    // } else {
    //     errorImgLugar.textContent = '';
    // }

    // if (!archivoSeleccionado(imagenBanner)) {
    //     errores += 1;
    //     errorImgBanner.textContent = 'Escoja una imagen de banner para el evento';
    // } else if (!tipoArchivo(imagenBanner)) { 
    //     errores += 1;
    //     errorImgBanner.textContent = 'Seleccione una imagen con extensión: jpg, jpeg, png, svg, gif';
    // } else {
    //     errorImgBanner.textContent = '';
    // }

    // if (!archivoSeleccionado(imagenPortada)) {
    //     errores += 1;
    //     errorImgPortada.textContent = 'Escoja una imagen de portada del evento';
    // } else if (!tipoArchivo(imagenPortada)) { 
    //     errores += 1;
    //     errorImgPortada.textContent = 'Seleccione una imagen con extensión: jpg, jpeg, png, svg, gif';
    // } else {
    //     errorImgPortada.textContent = '';
    // }

    if (errores == 0) {
        $.confirm({
            title: "Confirmar información",
            content: "¿Esta seguro/a que desea agregar el evento?",
            buttons: {
                si: {
                    text: "SÍ",
                    btnClass: "btn-success",
                    keys: ["enter", "shift"],
                    action: function () {
                        form.submit();
                    },
                },
                no: {
                    text: "NO",
                    btnClass: "btn-danger",
                    keys: ["enter", "shift"],
                    action: function () {
                        $.alert({
                            title: "Información",
                            content: "Operación agregar evento cancelada",
                        });
                    },
                },
            },
        });
    }

});

function filePreview(input,iprev,id){
    if(input.files && input.files[0])
    {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#'+iprev).html("<img src='"+e.target.result+"' id='"+id+"' alt='example placeholder'/>")
        }

    }
    reader.readAsDataURL(input.files[0]);
}
$('#fotoBanner').change(function () {
    filePreview(this,'imagePreview1','bannerPreview1')
})

$('#fotoPortada').change(function () {
    filePreview(this,'imagePreview2','portadaPreview2')
})
$('#fotoLugar').change(function () {
    filePreview(this,'imagePreview3','portadaPreview3')
})

function nuevoArtista() {
    limpiarError(artista, artista.nextElementSibling);
    limpiarError(inputNuevoArtista, inputNuevoArtista.nextElementSibling);
    if($('#nartista').is(':checked') ){
            $('#artista1').prop('disabled',true)
            $('#artista2').prop('disabled',false)
   }
   else{
            $('#artista1').prop('disabled',false)
            $('#artista2').prop('disabled',true)
   }
}

$('.datepicker').pickadate(
    {
    monthsFull: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre',
    'Noviembre', 'Diciembre'],
    weekdaysShort: ['Dom', 'Lun', 'Mar', 'Mier', 'Jue', 'Vie', 'Sab'],
    today: 'Hoy',
    clear: 'Limpiar',
    close: 'Cerrar',
    formatSubmit: 'yyyy/mm/dd',
    min: new Date()
});

$('.datepicker').val(new Date($('#fecha2').val()))