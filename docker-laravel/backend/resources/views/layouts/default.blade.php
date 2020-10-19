<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', '2020/10/19') }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" charset="UTF-8"></script>
    <!-- Styles -->
    @hasSection('css')
        @yield('css')
    @endif

<!-- Javascript -->
    @hasSection('js')
        @yield('js')
    @endif
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="description" content="description">
    <meta name="keywords" content="keywords">
    <meta content="" name="author">

</head>
<body>
    <div class="container">
        @hasSection('content')
            @yield('content')
        @endif
    </div>

</body>
</html>
