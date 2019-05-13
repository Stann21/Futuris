<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="apple-touch-icon" href="/images/favicon.png" />


    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
   <link rel="icon" type="image/png" href="/images/logoSmart.ico" sizes="32x32">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        @include('inc.navbar')

        <div class="container">
            <div class="messageContainer">
                @include('inc.message')
            </div>
            @yield('content')
        </div>
    </div>

    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>

    <script>
        CKEDITOR.replace( 'article-ckeditor' );
    </script>
  <script src="{{ asset('./js/app.js') }}"></script>
</body>
</html>
