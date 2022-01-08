<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Mastory') }} - @yield('title')</title>

    <!-- meta logo -->
    <link rel="icon" href="{{ asset('images/logo.png') }}">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <!-- Branding Image -->
                    <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                    {{-- <img style="width: 60%;" src="{{ asset('icons/exit_white.png') }}"  --}}
                        <img src="{{ asset('images/logo_white.png') }}" alt="logo">
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" 
                        style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>

                <!-- Titre de la page -->
                <div class="navbar-text">@yield('page_title')</div>
            </div>
        </nav>
        @yield('content')
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
