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

$('.datepicker').val( new Date$('#fecha2').val() )