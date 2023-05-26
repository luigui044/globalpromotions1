@extends('tiquetera.layouts.master-ticket')
@section('titulo', 'ticket')
    

@section('content')

    <div class="container mt-3 mb-3">
        @foreach ($boletos as $item)
        <div class="ticket pl-2 py-2 sinDesborde">
            <div class="ticket-evento sinDesborde">
                <div class="datos-usuario sinDesborde py-1 px-2">
                        <span class="nombre-text">Luis Humberto Medrano Lemus</span>
                        <span class="precio-text">Valor de boleto:  $80.00 </span>

                </div>
                <div class="datos-evento sinDesborde px-2">
                    <h5 id="titulo-evento">  {{ $evento->titulo_evento }} </h5>
                    <span id="fecha-evento">{{ $fecha2 }}, {{ $evento->hora }}</span><br>
                    <span id="lugar-evento">{{ $evento->lugar }}</span>
                </div>
            </div>
            <div class="ticket-codigo sinDesborde">
                <p class="sinDesborde text-center p-cod1 ">Ticket ID serie</p><br>
               
            </div>
            <div class="ticket-codigo sinDesborde ">
                <p class="sinDesborde text-center p-cod1">000000000000</p>
            </div>
    
            <div class="ticket-qr p-2 sinDesborde">
               
             {{ $item->codigo_qr }}
            
   
            </div>
        </div>
             @endforeach

    </div>
  
@endsection

@section('styles')

    <style>
        .p-cod1{

            width: 178px;
            height: 185px;
            font-weight: bold;
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
        span,#titulo-evento,#lugar-evento, .p-cod1{    
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
        
    </style>
@endsection