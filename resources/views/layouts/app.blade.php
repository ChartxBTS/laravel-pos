<!Doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ZuleStore') }}</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/login.js') }}" defer></script> --}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    {{-- <link href="{{ asset('css/register.scss') }}" rel="stylesheet"> --}}
    <!-- Scripts -->
    @vite(['resources/sass/register.scss', 'resources/js/register.js'])
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                @yield('content')
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <!-- <script src="{{ asset('js/login.js') }}"></script> -->

    @yield('js')

</body>
</html>
