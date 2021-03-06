<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Mastory') }} | @yield('title')</title>

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

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ route('gallery') }}">
                        {{-- {{ config('app.name', 'Laravel') }} --}}
                        <img src="{{ asset('images/logo_white.png') }}" alt="logo">
                    </a>
                </div>

                    <!-- Titre de la page -->
                    <div class="navbar-text">@yield('page_title')</div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        @if (Auth::user()->hasAnyRole("super_admin"))
                            <li class="{{ add_active_route_class('historic') }}"><a href="{{ route('historic') }}">{{ Lang::get('lang.historic') }}</a></li>
                        @endif
                            <li class="{{ add_active_route_class('jobs') }}"><a href="{{ route('jobs') }}">{{ Lang::get('lang.offres') }}</a></li>
                            <li class="{{ add_active_route_class('cooptation') }}"><a href="{{ route('cooptation') }}">{{ Lang::get('lang.cooptation') }}</a></li>
                        <!-- Authentication Links -->
                        <li>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                {{-- <img style="width: 60%;" src="{{ asset('icons/exit_white.png') }}"  --}}
                                <img class="app-deconnection" src="{{ asset('images/icons/exit_white.png') }}" 
                                    alt="DECONNEXION" srcset="">
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" 
                                style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
