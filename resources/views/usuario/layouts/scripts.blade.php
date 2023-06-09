@routes
<!-- jQuery -->
<script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="{{ asset('js/popper.min.js') }}"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="{{ asset('js/mdb.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/html2canvas.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/canvg/1.5/canvg.min.js"></script>
<script src="{{ asset('js/jspdf.min.js') }}"></script>
<script src="{{ asset('js/minimap.min.js') }}"></script>

<script type="text/javascript">
    // Material Select Initialization
    $(document).ready(function () {
        $(".mdb-select").materialSelect();
        $('[data-toggle="popover"]').popover()
    });
</script>
@include('sweetalert::alert')
@yield('scripts')