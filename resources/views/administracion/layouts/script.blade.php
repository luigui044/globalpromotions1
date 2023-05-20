 <!-- jQuery -->
 <script type="text/javascript" src="{{ asset('mdb/js/jquery.min.js') }}"></script>
 
 <!-- Bootstrap tooltips -->
 <script type="text/javascript" src="{{ asset('mdb/js/popper.min.js') }}"></script>
 <!-- Bootstrap core JavaScript -->
 <script type="text/javascript" src="{{ asset('mdb/js/bootstrap.min.js') }}"></script>
 <!-- MDB core JavaScript -->
 <script type="text/javascript" src="{{ asset('mdb/js/mdb.min.js') }}"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 <!-- Your custom scripts (optional) -->
 <script type="text/javascript">
      $(document).ready(function() {

      // SideNav Button Initialization
      $(".button-collapse").sideNav({
        breakpoint: 1200
      });
      // SideNav Scrollbar Initialization
      var sideNavScrollbar = document.querySelector('.custom-scrollbar');
      var ps = new PerfectScrollbar(sideNavScrollbar);
      })

      $(function () {
    $('[data-toggle="tooltip"]').tooltip()
})
</script>

@include('sweetalert::alert')

@yield('scripts')