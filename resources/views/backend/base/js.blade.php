
<!-- jQuery 2.1.4 -->
<script src="{{ $global['baseUrl'] }}backend/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="{{ $global['baseUrl'] }}backend/bootstrap/js/bootstrap.min.js"></script>
<!-- daterange picker -->
<script src="{{ $global['baseUrl'] }}backend/plugins/daterangepicker/moment.min.js"></script>
<script src="{{ $global['baseUrl'] }}backend/plugins/daterangepicker/daterangepicker.js"></script>
<!-- ChartJS 1.0.1 -->
<script src="{{ $global['baseUrl'] }}backend/plugins/chartjs/Chart.min.js"></script>
<!-- FastClick -->
<script src="{{ $global['baseUrl'] }}backend/plugins/fastclick/fastclick.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ $global['baseUrl'] }}backend/dist/js/app.min.js"></script>
<!-- Service App -->
<script src="{{ $global['baseUrl'] }}backend/service/api.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ $global['baseUrl'] }}backend/dist/js/demo.js"></script>

<!-- page script -->
<script>
$(function () {
  //Date range picker with time picker
  var $daterange = $('input[name="daterange"]').daterangepicker();
  var $daterange.data('daterangepicker').setStartDate('2014-03-01');
  var $daterange.data('daterangepicker').setEndDate('2014-03-31');
  $daterange.on('apply.daterangepicker', function (ev, picker) {
    $('input[name="started_at"]').val(picker.startDate.format('YYYY-MM-DD'));
    $('input[name="end_at"]').val(picker.endDate.format('YYYY-MM-DD'));
  });
});
</script>