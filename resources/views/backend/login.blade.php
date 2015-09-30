<!DOCTYPE html>
<html>
    <head>
        <title>{{ $title }}</title>
        @include('backend/base/meta')
        <!-- iCheck -->
        <!--<link rel="stylesheet" href="{{ $global['baseUrl'] }}backend/plugins/iCheck/square/blue.css">-->
    </head>
  
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="{{ URL::route('dashboard') }}"><b>{{ $title }}</b></a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        @if(Session::has('systemError'))
        <div class="alert alert-warning alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4><i class="icon fa fa-warning"></i> Alert!</h4>
          {{ Session::get('systemError') }}
        </div>
        @endif
        <form action="{{ URL::route('authen') }}" method="post">
          <div class="form-group has-feedback">
            <input name="email" type="text" class="form-control" placeholder="Email" required>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            <p class="text-red">{{$errors->first('email')}}</p>
          </div>
          <div class="form-group has-feedback">
            <input name="password" type="password" class="form-control" placeholder="Password" required>
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            <p class="text-red">{{$errors->first('password')}}</p>
          </div>
          <div class="row">
            <div class="col-xs-8">
              <div class="checkbox checkbox-info">
                  <input id="remember" name="remember" type="checkbox"> 
                  <label for="remember">Remember Me</label> 
              </div>
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div><!-- /.col -->
          </div>
        </form>
<!--
        <div class="social-auth-links text-center">
          <p>- OR -</p>
          <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using Facebook</a>
          <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using Google+</a>
        </div> /.social-auth-links 

        <a href="#">I forgot my password</a><br>
        <a href="register.html" class="text-center">Register a new membership</a>-->

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="{{ $global['baseUrl'] }}backend/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{ $global['baseUrl'] }}backend/bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <!--<script src="{{ $global['baseUrl'] }}backend/plugins/iCheck/icheck.min.js"></script>-->
    <!-- Service App -->
    <script src="{{ $global['baseUrl'] }}backend/service/api.js"></script>
    <script>
      $(function () {
//        $('input').iCheck({
//          checkboxClass: 'icheckbox_square-blue',
//          radioClass: 'iradio_square-blue',
//          increaseArea: '20%' // optional
//        });
      });
    </script>
  </body>
  
  
</html>
