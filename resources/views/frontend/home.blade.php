<!DOCTYPE html>
<html>
    <head>
        <title>{{ $global['title'] }}</title>
        <meta name="baseUrl" content="{{ $global['baseUrl'] }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- plugins -->
        <link href="{{ $global['baseUrl'] }}assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="{{ $global['baseUrl'] }}assets/plugins/owl-carousel/owl.carousel.css" rel="stylesheet">
        <link href="{{ $global['baseUrl'] }}assets/plugins/owl-carousel/owl.theme.css" rel="stylesheet">
        <link href="{{ $global['baseUrl'] }}assets/plugins/owl-carousel/owl.transitions.css" rel="stylesheet">
        
        <link href="{{ $global['baseUrl'] }}assets/css/icon/icon.css" rel="stylesheet">
        <link href="{{ $global['baseUrl'] }}assets/css/animate.css" rel="stylesheet">
        <link href="{{ $global['baseUrl'] }}assets/css/custom.css" rel="stylesheet">
        <link href="{{ $global['baseUrl'] }}assets/css/style.css?v=1" rel="stylesheet">
        <link rel="icon" type="image/png" href="{{ $global['baseUrl'] }}assets/icon/favicon.ico">
        
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
    
    <!-- liberies -->
    <script src="{{ $global['baseUrl'] }}assets/js/jquery.js"></script>
    <script src="{{ $global['baseUrl'] }}assets/angular/angular.min.js"></script>
    <script src="{{ $global['baseUrl'] }}assets/angular/angular-route/angular-route.min.js"></script>
    
    <!-- plugins -->
    <script src="{{ $global['baseUrl'] }}assets/plugins/wow.min.js"></script>
    <script src="{{ $global['baseUrl'] }}assets/plugins/bootstrap/js/bootstrap.js"></script>
    <script src="{{ $global['baseUrl'] }}assets/plugins/owl-carousel/owl.carousel.js"></script>
    
    <!-- config -->
    <script src="{{ $global['baseUrl'] }}assets/app/app.js"></script>
    <script src="{{ $global['baseUrl'] }}assets/app/BaseCtrl.js"></script>
    <script src="{{ $global['baseUrl'] }}assets/app/main.js"></script>
    </body>
</html>
