<!DOCTYPE html>
<html>
    <head>
        <title>{{ $global['title'] }}</title>
        <meta name="baseUrl" content="{{ $global['baseUrl'] }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{csrf_token()}}">
        <!-- plugins -->
<!--        <link href="{{ $global['baseUrl'] }}frontend/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="{{ $global['baseUrl'] }}frontend/assets/plugins/bootstrap-dialog/css/bootstrap-dialog.min.css" rel="stylesheet">
        <link href="{{ $global['baseUrl'] }}frontend/assets/plugins/owl-carousel/owl.carousel.css" rel="stylesheet">
        <link href="{{ $global['baseUrl'] }}frontend/assets/plugins/owl-carousel/owl.theme.css" rel="stylesheet">
        
        <link href="{{ $global['baseUrl'] }}frontend/assets/css/icon/icon.css" rel="stylesheet">
        <link href="{{ $global['baseUrl'] }}frontend/assets/css/animate.css" rel="stylesheet">
        <link href="{{ $global['baseUrl'] }}frontend/assets/css/custom.css" rel="stylesheet">
        <link href="{{ $global['baseUrl'] }}frontend/assets/css/style.css?v=1" rel="stylesheet">-->
        <link href="{{ $global['baseUrl'] }}frontend/assets/plugins/font-awesome-4.4.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="{{ $global['baseUrl'] }}frontend/assets/css/source.min.css" rel="stylesheet">
        <link rel="icon" type="image/png" href="{{ $global['baseUrl'] }}frontend/assets/icon/favicon.ico">
        
    </head>
    <body ng-app="application" ng-controller="BaseCtrl">  
      @include('frontend/base/menu')
      
      @if ($page === "feed")
        @include('frontend/home/slide')
        @include('frontend/home/feed')
      @elseif ($page === "login")
       @include('frontend/home/login')
      @elseif ($page === "register")
       @include('frontend/home/register')
      @elseif ($page === "profile")
       @include('frontend/home/profile')
       @include('frontend/home/feed')
      @endif
<!--    
     liberies 
    <script src="{{ $global['baseUrl'] }}frontend/assets/js/jquery.js"></script>
    <script src="{{ $global['baseUrl'] }}frontend/assets/angular/angular.min.js"></script>
    <script src="{{ $global['baseUrl'] }}frontend/assets/angular/angular-route/angular-route.min.js"></script>
    
     plugins 
    <script src="{{ $global['baseUrl'] }}frontend/assets/plugins/wow.min.js"></script>
    <script src="{{ $global['baseUrl'] }}frontend/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{ $global['baseUrl'] }}frontend/assets/plugins/bootstrap-dialog/js/bootstrap-dialog.min.js"></script>
    <script src="{{ $global['baseUrl'] }}frontend/assets/plugins/owl-carousel/owl.carousel.js"></script>
    
     config 
    <script src="{{ $global['baseUrl'] }}frontend/assets/app/app.js"></script>
    <script src="{{ $global['baseUrl'] }}frontend/assets/app/BaseCtrl.js"></script>
    <script src="{{ $global['baseUrl'] }}frontend/assets/app/main.js"></script>
-->

    <script src="{{ $global['baseUrl'] }}frontend/assets/js/source.min.js"></script>
    
    
    <script src="{{ $global['baseUrl'] }}frontend/assets/app/app.js"></script>
    <script src="{{ $global['baseUrl'] }}frontend/assets/app/BaseCtrl.js"></script>
    <script src="{{ $global['baseUrl'] }}frontend/assets/app/main.js"></script>
    <script src="{{ $global['baseUrl'] }}frontend/assets/service/api.js"></script>
    
      @if ($page === "feed")
      @elseif ($page === "login")
      <script src="{{ $global['baseUrl'] }}frontend/assets/app/LoginCtrl.js"></script>
      @endif
    
    
    @include('main/push-js')
    </body>
</html>
