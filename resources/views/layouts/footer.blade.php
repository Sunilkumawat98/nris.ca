<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <!-- <b>Version</b> 3.2.0 -->
    </div>
    <strong>Copyright &copy; {{ date('Y') }}</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ URL::asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ URL::asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ URL::asset('plugins/bootstrap/js/bootstrap.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ URL::asset('dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="{{ URL::asset('dist/js/demo.js') }}"></script> -->

<script src="{{ URL::asset('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>

<script src="{{ URL::asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ URL::asset('plugins/select2/js/select2.full.min.js') }}"></script>

<script src="{{ URL::asset('plugins/moment/moment.min.js') }}"></script>

<!-- date-range-picker -->
<script src="{{ URL::asset('plugins/daterangepicker/daterangepicker.js') }}"></script>

<!-- <script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script> -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

<script>
    $(function () {
      
        //Initialize Select2 Elements
        $('.select2').select2()


        //Colorpicker
        $('.my-colorpicker1').colorpicker()
        //color picker with addon      
    })


    
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
        timePicker: false,
        timePickerIncrement: 30,
        locale: {
          format: 'MM/DD/YYYY'
        }
    })
    
    $('#datepicker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight: true,
    });




</script>
</body>
</html>