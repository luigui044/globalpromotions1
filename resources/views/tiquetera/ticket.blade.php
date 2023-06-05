@extends('tiquetera.layouts.master-ticket')
@section('titulo', 'ticket')
    
@section('csrf')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
@endsection
@section('content1')

    
                @foreach ($boletos as $clave=> $item)
                    <br>
                    <div class="ticket scaling-div  pl-2 py-2 sinDesborde">
                        <div class="ticket-evento sinDesborde">
                            <div class="datos-usuario sinDesborde py-1 px-2">
                                @if (isset($nombreCliente))
                                <span class="nombre-text left">{{ $nombreCliente }}</span>
            
                                @else
                                <span class="nombre-text left">Global Promotions</span>
            
                                @endif
                                <span class="precio-text right">Valor de boleto: <strong>${{round($precioBoleto,2) }}</strong> </span>
                                <br>
                                <span class="precio-text right">Localidad: <strong>{{ $nombreLocalidad }}</strong> </span>
                            </div>
            
                            <div class="datos-evento sinDesborde px-2">
                                <h5 id="titulo-evento">  {{ $evento->titulo_evento }} </h5>
                                <span id="fecha-evento">{{ $fecha2 }}, {{ $evento->hora }}</span><br>
                                <span id="lugar-evento">{{ $evento->lugar }}</span>
                                <span class="sinDesborde text-center ">{{ $clave.$orderId }}</span>
                            </div>
                        </div>
                        {{-- <div class="ticket-codigo sinDesborde">
                            <p class="sinDesborde text-center p-cod2 ">Ticket ID serie</p><br>
                        
                        </div>
                        <div class="ticket-codigo sinDesborde ">
                            <span class="sinDesborde text-center p-cod1">{{ $clave.$orderId }}</span>
                        </div> --}}
                
                        <div class="ticket-qr p-2 sinDesborde">
                            <img  class="img-qr" src="data:image/svg+xml;base64,{{ base64_encode( $item->codigo_qr ) }}" alt="QR Code">
                          
            
                        </div>
                        
                       
                    </div>
                @endforeach
    
  
@endsection





@section('content2')
            
        <h2 class="text-center texto-usuario"><b> {{ $nombreCliente }} </b></h2>
        <h5 class="text-justify texto-compra">Agradecemos tu compra, ya puedes descargar tus tickets, de igual manera estarán disponibles en tu cuenta de Global Promotions</h5>
            
        

        <a onclick="genPDF()" class="btn btn-primary">Descargar</a>
        {{-- <a onclick="sendPDF()" class="btn btn-primary">enviar</a> --}}

@endsection

@section('scripts')
    <script >
        //se ejecuta cuando se carga la pagina para enviar el pdf
        // $(document).ready(function(){
        //     sendPDF();
        // });
            //funcion para generar pdf y enviarlo por correo automaticante
            function sendPDF()
            {
            

                html2canvas(document.getElementById('tickets'),{
                onrendered:function(canvas){

                    var img=canvas.toDataURL("image/png");
                    var doc = new jsPDF();
                    doc.addImage(img,'JPEG',20,20);


                    var pdfData =     doc.output('blob')
                    var formData = new FormData();
                    formData.append('pdf', pdfData, 'archivo.pdf');
                
                    
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                        });

                    $.ajax({    
                        url: "/tiquetera/sendPDF",
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (data) {
                            console.log(data);
                        },
                        error: function (data) {
                            console.log(data);
                        }
                    });


           
                //fin de onrendered              
                }
                //fin de html2canvas
                });
                //fin de sendPDF
            }
            //funcion para generar pdf y descargarlo
            function genPDF()
            {
                
                html2canvas(document.getElementById('tickets'),{
                onrendered:function(canvas){

                    var img=canvas.toDataURL("image/png");
                    var doc = new jsPDF();
                    doc.addImage(img,'JPEG',20,20);
                    doc.save('ticket.pdf');
                }

                });

            }

    </script>
@endsection



@section('styles')

    <style>
        body,.ticket, #tickets {
            background-color: white
        }
        .img-qr{
            margin-top: 4px;
        }
        .serie{
           display: inline-block;
        }
        .p-cod1{
            position: relative;
            top: 16px;
            width: 198px;
            height: 144px;
            right: 28px;
            font-weight: bold;
            font-size: 15px;
        }
    
        .ticket-codigo {
             background: whitesmoke;
            width: 20px;
            height: 100%;
            display: inline-block;
            overflow: hidden;
            position: relative;
            
        }

        .ticket-codigo p {
            position: absolute;
            height: 20px;
            width: 182px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-90deg);
            transform-origin: center;
        z-index: 999;
        }
        .nombre-text{
            font-size: 12px;
            font-weight: bold;
        }
        #fecha-evento,#lugar-evento{
            font-size: 12px;
        }
        .precio-text{
            font-size: 12px;
            margin-left: 35px;
        }
        span,#titulo-evento,#lugar-evento, .p-cod1, .texto-usuario, .texto-compra{    
            font-family: 'Poppins', sans-serif !important;
        }
        #titulo-evento{
            margin: 0;
            font-weight: bold !important;
            font-size: 16px !important;
        }
        .sinDesborde{
            overflow: hidden !important;
        }
        .ticket-qr,.ticket-evento{
            display: inline-block;
            height: 100%;
        }
        .ticket-qr{
            width: 195px;      
        }
        .datos-usuario,.datos-evento{
            width: 100%;
            height: 50%;
        }
        .ticket-qr img{
            border: 3px white solid ;
            width: 100%;
        }
        .ticket{
            background: rgb(19, 21, 56);
            height: 220px;
            width: 610px;

        }

        .ticket-evento{
            width: 397px; 
            background-image: url('/img/gpPatron.png');
            background-size: cover;
         }


         @media (max-width: 768px) { /* Ajusta el tamaño de pantalla según tus necesidades */
            /* .ticket {
                margin-top: 250px;
                margin-bottom: 150px;
                transform: rotate(90deg); */

            /* } */

            .scaling-div {
            transform: scale(0.55); /* Escala el div al 80% de su tamaño original */
            transform-origin: top left; /* Establece el punto de origen de la transformación */
            }
                /*necesito un css para reescalar el div con la clase ticket y por consiguiente su contenido como lo hago */
       
        }


        .left {
        float: left;
        }

        .right {
        float: right;
        }
        
    </style>
@endsection