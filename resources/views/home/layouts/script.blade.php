@routes
<script src="{{ asset('assets/js/jquery-2.2.4.min.js')}}"></script>

<script src="{{ asset('assets/js/jquery-ui.min.js')}}"></script>

<script src="{{ asset('assets/js/bootstrap.min.js')}}"></script>

<script src="{{ asset('assets/js/headhesive.min.js')}}"></script>

<script src="{{ asset('assets/js/matchHeight.min.js')}}"></script>

<script src="{{ asset('assets/js/modernizr.custom.js')}}"></script>

<script src="{{ asset('assets/js/slick.min.js')}}"></script>

<script src="{{ asset('assets/js/venobox.min.js')}}"></script>

<script src="{{ asset('assets/js/custom.js')}}"></script>

<script>function loadScript(a){var b=document.getElementsByTagName("head")[0],c=document.createElement("script");c.type="text/javascript",c.src="https://tracker.metricool.com/resources/be.js",c.onreadystatechange=a,c.onload=a,b.appendChild(c)}loadScript(function(){beTracker.t({hash:"a7f25f90fce26eb0ca91e05c5e6672fb"})});</script>
		
@if($mensaje = Session::get('mensaje'))
    <script>
            $('#modal-mensaje').modal('show');
    </script>
@endif

@yield('scripts')