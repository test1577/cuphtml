<!DOCTYPE html>
<html>
    <head>
        <title>{{ $global['title'] }}</title>
        <meta name="baseUrl" content="{{ $global['baseUrl'] }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="{{ $global['baseUrl'] }}assets/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="{{ $global['baseUrl'] }}assets/css/icon/icon.css" rel="stylesheet">
        <link href="{{ $global['baseUrl'] }}assets/css/animate.css" rel="stylesheet">
        <link href="{{ $global['baseUrl'] }}assets/css/style.css?v=1" rel="stylesheet">
        <link rel="icon" type="image/png" href="{{ $global['baseUrl'] }}assets/icon/favicon.ico">
        
    </head>
    <body ng-app="application" ng-controller="BaseCtrl">   
      @include('frontend/base/menu')
      
      @if ($page === "feed")
        @include('frontend/feed')
      @elseif ($page === "login")
       @include('frontend/login')
      @elseif ($page === "register")
       @include('frontend/register')
      @elseif ($page === "profile")
       @include('frontend/profile')
       @include('frontend/feed')
      @endif
      
    <script src="{{ $global['baseUrl'] }}assets/js/jquery.js"></script>
    <script src="{{ $global['baseUrl'] }}assets/angular/angular.min.js"></script>
    <script src="{{ $global['baseUrl'] }}assets/angular-route/angular-route.min.js"></script>
    <script src="{{ $global['baseUrl'] }}assets/js/wow.min.js"></script>
    <script src="{{ $global['baseUrl'] }}assets/bootstrap/js/bootstrap.js"></script>
    
    <script src="{{ $global['baseUrl'] }}assets/app/app.js"></script>
    <script src="{{ $global['baseUrl'] }}assets/app/BaseCtrl.js"></script>
    <script src="{{ $global['baseUrl'] }}assets/app/main.js"></script>
    </body>
</html>
