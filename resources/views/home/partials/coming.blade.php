<section class="dark">
    <div class="container section remove-bottom-padding">
        <div class="row comingSoon-slides">
            <div class="col-sm-12">

                <h2>Próximamente</h2>

                <div class="row single-slide slideOne">
                    <div class="bg" style="background: url({{ asset('assets/hombresg.jpg') }});background-size: contain !important;"></div>
                    <div class="col-sm-5 col-xs-12 slide-content">
                        {{-- <span class="title">Drama, Thriller</span> --}}
                        <h3 class="no-underline">Hombres G</h3>
                        <div class="star-rating">
                            <i class="material-icons">star_rate</i>
                            <i class="material-icons">star_rate</i>
                            <i class="material-icons">star_rate</i>
                            <i class="material-icons">star_rate</i>
                            <i class="material-icons">star_rate</i>
                        </div>
                        <div class="date">
                            <i class="material-icons">date_range</i> 11 de Mayo, 2023
                        </div>
                        <p>El próximo 11 de Mayo se presentará Hombres G en El Salvador, con su Gira de 40 Aniversario </p>
                        <p><a href="https://gp.probalosv.com/" class="arrow-button">Ver evento</a></p>
                    </div>
                    <div class="col-sm-6 col-xs-12 col-sm-push-1 slide-video">
                        <video src="{{ asset('assets/hombresg.mp4') }}" width="555" height="335" autoplay controls >
                        </video>
                    </div>
                </div>
                @include('home.partials.carrousel')
            </div>
        </div>
    </div>
</section>