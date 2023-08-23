<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- owl.carousel css -->
    <link rel="stylesheet" href="{{ asset('assets/skote/libs/owl.carousel/assets/skote/owl.carousel.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/skote/libs/owl.carousel/assets/skote/owl.theme.default.min.css') }}">

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/skote/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/skote/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/skote/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

</head>
<body>
    <div id="app">
            @yield('content')
    </div>

    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/skote/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/skote/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/skote/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/skote/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/skote/libs/node-waves/waves.min.js') }}"></script>

    <!-- owl.carousel js -->
    <script src="{{ asset('assets/skote/libs/owl.carousel/owl.carousel.min.js') }}"></script>

    <!-- auth-2-carousel init -->
    <script src="{{ asset('assets/skote/js/pages/auth-2-carousel.init.js') }}"></script>
    
    <!-- App js -->
    <script src="{{ asset('assets/skote/js/app.js') }}"></script>
</body>
</html>
