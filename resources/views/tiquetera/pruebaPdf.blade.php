
<html lang="en">
<head>
   
    <title>Document</title>
  
</head>
<body>
    @for ($i = 0; $i < 3; $i++)
            <br>
            <div id="ticket-fondo">
                <div id="ticket-evento">
                  <img  src="{{ asset('/img/gpPatron.jpg') }}" width="125" height="130" alt="" srcset="">
             
                  
             
             
                </div>
            
            </div>

    @endfor
    
          
    
 <style>
    #ticket-fondo{
        height: 220px;
        width: 610px;
        background: rgb(19, 21, 56);
        overflow: hidden;
    }

    #ticket-evento{
                        width: 397px; 
                        height: 100%;
                        /* background-image: url("{{ asset('/img/gpPatron.svg') }}");
                        background-size: cover; */
                        overflow: hidden;
                     }
 </style>
</body>
</html>