<!DOCTYPE html>
<html>
    <head>
        <title>{{ $global['title'] }}</title>
        @include('backend/base/meta')
    </head>
    
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        @include('backend/base/header')
      <!-- Left side column. contains the logo and sidebar -->
        @include('backend/base/menu')
      <!-- Content Wrapper. Contains page content -->
        @include('backend/dashboard')
      <!-- /.content-wrapper -->
        @include('backend/base/footer')
      <!-- Control Sidebar -->
        @include('backend/base/menu-setting')
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    @include('backend/base/js')
  </body>
</html>
