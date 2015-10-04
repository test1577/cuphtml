<!DOCTYPE html>
<html>
    <head>
        <title>{{ $title }}</title>
        @include('backend/base/meta')
    </head>
    
  <body class="hold-transition skin-blue sidebar-mini">
      @if(Session::has('systemSuccess'))
      <div cuphtml-alert cuphtml-alert-status="success"></div>
      @elseif(Session::has('systemError'))
      <div cuphtml-alert cuphtml-alert-status="error"></div>
      @endif
      
    <div class="wrapper">

        @include('backend/base/header')
      <!-- Left side column. contains the logo and sidebar -->
        @include('backend/base/menu')
      <!-- Content Wrapper. Contains page content -->
        @if ($page === 'Dashboard')
          @include('backend/dashboard')
        @elseif ($page === 'User')
          @include('backend/user/index')
        @elseif ($page === 'Admin')
          @include('backend/admin/index')
        @endif
      <!-- /.content-wrapper -->
        @include('backend/base/footer')
      <!-- Control Sidebar -->
        @include('backend/base/menu-setting')
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    
    @include('backend/base/js')
    @include('main/push-js')
  </body>
</html>
