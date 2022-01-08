<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Mastory') }} | Palmarès</title>

    <!-- meta logo -->
    <link rel="icon" href="{{ asset('images/logo.png') }}">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid gallery-navbar" >
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
                        <img src="{{ asset('images/logo_white.png') }}" alt="logo">
                    </a>
                </div>
                    <!-- Titre de la page -->
                <div class="navbar-text">PALMARÈS</div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        @if (Auth::user()->hasAnyRole("super_admin"))
                            <li><a href="{{ route('historic') }}">{{ Lang::get('lang.historic') }}</a></li>
                        @endif
                            <li><a href="{{ route('jobs') }}">{{ Lang::get('lang.offres') }}</a></li>
                            <li><a href="{{ route('cooptation') }}">{{ Lang::get('lang.cooptation') }}</a></li>
                        <!-- Authentication Links -->
                        <li>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
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
            @include('layouts.partials.filter')
        </nav>

        <div class="container">
            <div class="gallery-container">
                @if (count($stories) <= 0)
                    <h1>Aucun résultat trouvé !</h1>
                @else
                    @foreach ($stories as $storie)
                        <div class="gallery-container-image" > 
                            <a class="lien-image" href="{{ url('/gallery/' . $storie->userId) }}">
                                <div class="gallery-image" 
                                    style="background-image: url({{ asset('resources/pictures/' . $storie->picture_path) }});
                                            background-position-x: {{ $storie->bg_position_x }}%;
                                            background-position-y: {{ $storie->bg_position_y }}%;
                                    ">
                                    <div class="gallery-name">
                                        {{ strtoupper($storie->lastname) }} {{ strtoupper($storie->firstname) }}
                                    </div>
                                    <div class="zoom"><img src="{{ asset('images/icons/add.png') }}" alt="add"/></div> 
                                    <div class="gallery-like-image" 
                                                style="background-image: url({{ asset('images/icons/like_3.png') }})">
                                        <div class="gallery-like">{{ $storie->nbrOfLike }}</div>
                                    </div>     
                                </div>
                            </a>
                        </div>
                    @endforeach  
                @endif
            </div>
        </div>
        <div class="row text-center">
            <p>{{ $stories->links() }}</p>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>