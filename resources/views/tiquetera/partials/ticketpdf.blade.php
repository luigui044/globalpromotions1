@extends('tiquetera.layouts.master-ticket')
@section('titulo', 'ticket')
    

@section('content1')
    
      @foreach ($boletos as $clave=> $item)
                    <br>
                    <div class="ticket pl-2 py-2 sinDesborde">
                        <div class="ticket-evento sinDesborde">
                            <div class="datos-usuario sinDesborde py-1 px-2">
                                @if (isset($cliente))
                                <span class="nombre-text left">{{ $cliente }}</span>
            
                                @else
                                <span class="nombre-text left">Global Promotions</span>
            
                                @endif
                                <span class="precio-text right">Valor de boleto: <strong>${{round($item->precio,2) }}</strong> </span>
                                <br>
                                <span class="precio-text right">Localidad: <strong>{{ $item->nombre_localidad }}</strong> </span>
                            </div>
            
                            <div class="datos-evento sinDesborde px-2">
                                <h5 id="titulo-evento">  {{$evento }} </h5>
                                <span id="fecha-evento">{{ $fecha2 }}, {{ $hora }}</span><br>
                                <span id="lugar-evento">{{ $lugar }}</span>
                            </div>
                        </div>
                        <div class="ticket-codigo sinDesborde">
                            <p class="sinDesborde text-center p-cod1 ">Ticket ID serie</p><br>
                        
                        </div>
                        <div class="ticket-codigo sinDesborde ">
                            <p class="sinDesborde text-center p-cod1">{{ $clave.$orderId }}</p>
                        </div>
                
                        <div class="ticket-qr p-2 sinDesborde">
                        
                            {!! $item->codigo_qr !!}
                        
            
                        </div>
                    </div>
                @endforeach
    
  
@endsection







@section('scripts')
    <script >
       
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
        .p-cod1{

            width: 178px;
            height: 185px;
            font-weight: bold;
           font-size: 15px;
        }
    
        .ticket-codigo {
             background: whitesmoke;
     
            width: 20px;
            height: 100%;
            display: inline-block;
        }

        .ticket-codigo p {
            -webkit-transform: rotate(-90deg); 
            -moz-transform: rotate(-90deg);    

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
            width: 198px;      
        }
        .datos-usuario,.datos-evento{
            width: 100%;
            height: 50%;
        }
        .ticket-qr svg{
            border: 5px white solid ;
        }
        .ticket{
            background: rgb(19, 21, 56);
            height: 198px;
            width: 655px;

        }

        .ticket-evento{
            width: 397px; 
            background-image: url('/img/gpPatron.png');
            background-size: cover;
         }


         @media (max-width: 768px) { /* Ajusta el tamaño de pantalla según tus necesidades */
        .ticket {
            margin-top: 250px;
            transform: rotate(90deg);
            /* width: 100px;
            height: 200px;
            line-height: 200px; */
        }
        }


        .left {
        float: left;
        }

        .right {
        float: right;
        }
        
    </style>
@endsection












