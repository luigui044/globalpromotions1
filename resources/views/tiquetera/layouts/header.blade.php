<!-- Intro Section -->
<div class="view jarallax" data-jarallax='{"speed": 0.2}'
    style="background-image: url({{ $evento->image_banner }}) !important; margin-top: 56px;">
    <div class="mask rgba-black-light">
        <div class="container h-100 d-flex align-items-center">
            <div class="row pt-5 mt-3">
                <div class="col-md-12">
                    <div style="min-width: 650px;">
                        <h1 class="h1-reponsive titulo-banner white-text text-uppercase font-weight-bold mb-3 wow fadeInDown"
                            data-wow-delay="0.3s"><strong>{{ $evento->titulo_evento }}</strong></h1>
                        <p class="text-white subtitulo-banner"><strong> {{ $evento->copy_evento }}</strong></p>
                        <div class="row text-center">
                            <div class="col-md-2">
                                <div class="bg-primary text-white btn-rounded">{{ $dia }}</div>
                            </div>
                            <div class="col-md-3">
                                <div class="bg-primary text-white btn-rounded">{{ $fecha2 }}</div>
                            </div>
                            <div class="col-md-2">
                                <div class="bg-primary text-white btn-rounded">{{ $evento->hora }}</div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
