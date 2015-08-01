<!DOCTYPE html>
<html>
    <head>
        <title>{{ $global['title'] }}</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="{{ $global['baseUrl'] }}assets/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="{{ $global['baseUrl'] }}assets/css/animate.css" rel="stylesheet">
        <link href="{{ $global['baseUrl'] }}assets/css/style.css?v=1" rel="stylesheet">
        <link rel="icon" type="image/png" href="{{ $global['baseUrl'] }}assets/icon/favicon.ico">
        
    </head>
    <body>   
      @include('frontend/base/menu')
      
      @if ($page === "feed")
        @include('frontend/feed')
      @elseif ($page === "login")
       @include('frontend/login')
      @endif
      
    <script src="{{ $global['baseUrl'] }}assets/js/jquery.js"></script>
    <script src="{{ $global['baseUrl'] }}assets/js/wow.min.js"></script>
    <script src="{{ $global['baseUrl'] }}assets/bootstrap/js/bootstrap.js"></script>
    <script src="{{ $global['baseUrl'] }}assets/js/main.js"></script>
    </body>
</html>
