<div id="hero" class="carousel slide carousel-fade mt-5" data-ride="carousel">
    <a href="#afterHeader" class="anchor">
        <img src="{{ asset('assets/images/scroll-arrow.svg')}}" alt="Scroll down" class="scroll" />
    </a>
    <!-- Indicators -->

    <div class="container mt-5">	
        <ol class="carousel-indicators">
            @php
                $posicion = 0;
            @endphp
            @foreach ($eventos as $index=> $item)
                <li data-target="#hero" data-slide-to="{{ $posicion }}" class="@if($index == 0) active @endif" ></li>
                
            @endforeach
        </ol>
    </div>

    <!-- Wrapper for slides -->

    <div class="carousel-inner">
        @foreach ($eventos as $index=>$item)

            <div class="item @if($index == 0) active @endif img-banner" style="background-image:url('{{ $item->image_banner }}');"  >
                <!-- Content -->
                <div class="container">
                    <div class="row blurb scrollme animateme" data-when="exit" data-from="0" data-to="1" data-opacity="0" data-translatey="100">
                        <div class="col-md-9">
                 
                            <h1>{{ $item->titulo_evento }}</h1>
                            <p>{{ $item->copy_evento }}</p>
                            <div class="buttons">
                                <a href="{{  route('concierto',['id'=>$item->id_evento]) }}" class="btn btn-default" >
                                    <span>Comprar boletos</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        
    </div>
</div>