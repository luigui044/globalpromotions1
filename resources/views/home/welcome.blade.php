@extends('home.layouts.layout-master')

@section('content')
    <!-- Wrapper -->
    <div class="wrapper">
        {{-- nabvar --}}
        @include('home.layouts.navbar')
        <!-- Hero -->
        @include('home.partials.slides-banner')

        <div class="container section" id="afterHeader">
            <div class="row">
                <div class="col-sm-12">
                    prueba
               
                    <hr>

                    @foreach ($eventos as $item)
                        <div class="row mb-2">
                            <div class="col-md-2 col-sm-3">
                                <a href="{{ route('concierto',['id'=>$item->id_evento]) }}">
                                    <img src="{{ asset($item->image_card) }}"
                                        alt="{{ $item->titulo_evento }}" class="carteleraImg"
                                        title="{{  $item->titulo_evento  }}" />
                                </a>
                            </div>
                            <div class="col-md-10 col-sm-9">
                                <h3 class="no-underline">{{ $item->titulo_evento }}</h3>
                                <p><strong>{{ $item->copy_evento }}</strong></p>
                                <p>
                                    <a 
                                       href="{{ route('concierto',['id'=>$item->id_evento]) }}"
                                        class="btn btn-default">
                                        Comprar boletos
                                    </a>
                                </p>
                                <div class="row">
                                    <div class="col-md-8 col-sm-9">
                                        <hr class="space-10" />
                                        <span class="viewing-times">
                                            <i class="material-icons">access_time</i>
                                            Fechas de presentación
                                        </span>
                                        <span class="time ">{{ date('d/m/Y', strtotime($item->fechas)) }}</span>
    
                                    </div>
                                    <div class="col-md-4 col-sm-3 running-time">
                                        <hr class="space-10" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Section establecida como oculta no tocar-->
        <div class="container section remove-top-padding" style="display: none">
            <div class="row">
                <div class="col-sm-12" id="afterHeader">
                    <h2>New in</h2>
                    <div class="slick-carousel" id="newIn">
                        <div class="movie-slide">
                            <div class="movie-poster">
                                <aside>
                                    <div>
                                        <a href="https://youtu.be/ScMzIvxBSi4 data-vbtype="video" class="venobox play">
                                            <i class="material-icons">play_arrow</i>
                                        </a>
                                        <a href="single-movie.html" class="read-more">read more</a>
                                        <span class="date">Released: 7 Mar, 2017</span>
                                    </div>
                                </aside>
                                <a href="https://globalpromotions-ca.com/">
                                    <img src="https://via.placeholder.com/265x340.jpg" alt="Movie title" />
                                </a>
                            </div>
                            <h4 class="no-underline">The last post</h4>
                            <div class="star-rating">
                                <i class="material-icons">star_rate</i>
                                <i class="material-icons">star_rate</i>
                                <i class="material-icons">star_rate</i>
                                <i class="material-icons">star_rate</i>
                                <i class="material-icons">star_rate</i>
                            </div>
                        </div>
                        <div class="movie-slide">
                            <div class="movie-poster">
                                <aside>
                                    <div>
                                        <a href="https://youtu.be/ScMzIvxBSi4 data-vbtype="video" class="venobox play">
                                            <i class="material-icons">play_arrow</i>
                                        </a>
                                        <a href="single-movie.html" class="read-more">read more</a>
                                        <span class="date">Released: 7 Mar, 2017</span>
                                    </div>
                                </aside>
                                <a href="https://globalpromotions-ca.com/">
                                    <img src="https://via.placeholder.com/265x340" alt="Movie title" />
                                </a>
                            </div>
                            <h4 class="no-underline">Dark and lonely</h4>
                            <div class="star-rating">
                                <i class="material-icons">star_rate</i>
                                <i class="material-icons">star_rate</i>
                                <i class="material-icons">star_rate</i>
                                <i class="material-icons">star_rate</i>
                                <i class="material-icons grey">star_rate</i>
                            </div>
                        </div>
                        <div class="movie-slide">
                            <div class="movie-poster">
                                <aside>
                                    <div>
                                        <a href="https://youtu.be/ScMzIvxBSi4 data-vbtype="video" class="venobox play">
                                            <i class="material-icons">play_arrow</i>
                                        </a>
                                        <a href="single-movie.html" class="read-more">read more</a>
                                        <span class="date">Released: 7 Mar, 2017</span>
                                    </div>
                                </aside>
                                <a href="https://globalpromotions-ca.com/">
                                    <img src="https://via.placeholder.com/265x340" alt="Movie title" />
                                </a>
                            </div>
                            <h4 class="no-underline">Venture</h4>
                            <div class="star-rating">
                                <i class="material-icons">star_rate</i>
                                <i class="material-icons">star_rate</i>
                                <i class="material-icons">star_rate</i>
                                <i class="material-icons">star_rate</i>
                                <i class="material-icons">star_rate</i>
                            </div>
                        </div>
                        <div class="movie-slide">
                            <div class="movie-poster">
                                <aside>
                                    <div>
                                        <a href="https://youtu.be/ScMzIvxBSi4 data-vbtype="video" class="venobox play">
                                            <i class="material-icons">play_arrow</i>
                                        </a>
                                        <a href="single-movie.html" class="read-more">read more</a>
                                        <span class="date">Released: 7 Mar, 2017</span>
                                    </div>
                                </aside>
                                <a href="https://globalpromotions-ca.com/">
                                    <img src="https://via.placeholder.com/265x340" alt="Movie title" />
                                </a>
                            </div>
                            <h4 class="no-underline">Hush</h4>
                            <div class="star-rating">
                                <i class="material-icons">star_rate</i>
                                <i class="material-icons">star_rate</i>
                                <i class="material-icons">star_rate</i>
                                <i class="material-icons grey">star_rate</i>
                                <i class="material-icons grey">star_rate</i>
                            </div>
                        </div>
                        <div class="movie-slide">
                            <div class="movie-poster">
                                <aside>
                                    <div>
                                        <a href="https://youtu.be/ScMzIvxBSi4 data-vbtype="video" class="venobox play">
                                            <i class="material-icons">play_arrow</i>
                                        </a>
                                        <a href="single-movie.html" class="read-more">read more</a>
                                        <span class="date">Released: 7 Mar, 2017</span>
                                    </div>
                                </aside>
                                <a href="https://globalpromotions-ca.com/">
                                    <img src="https://via.placeholder.com/265x340" alt="Movie title" />
                                </a>
                            </div>
                            <h4 class="no-underline">Venture</h4>
                            <div class="star-rating">
                                <i class="material-icons">star_rate</i>
                                <i class="material-icons">star_rate</i>
                                <i class="material-icons">star_rate</i>
                                <i class="material-icons">star_rate</i>
                                <i class="material-icons">star_rate</i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section coming soon-->
        @include('home.partials.coming')

        @include('home.partials.contacto')

        <!-- Footer -->
        @include('home.layouts.footer')

    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/tracking.js') }}"></script>
@endsection
