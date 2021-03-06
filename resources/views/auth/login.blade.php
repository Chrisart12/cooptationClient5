<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Saira&display=swap" rel="stylesheet"> 
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" 
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body> 
    <div class="login-container_flex">           
        <div>
            <div class="login_mastory">MASTORY</div>
        </div>
        <div class="login-info">
            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <div class="input-icons">
                        <i class="fa fa-envelope-o icon"></i>
                        <input id="email" type="email" class="login-form" name="email" value="{{ old('email') }}" 
                            placeholder="Email*" required autofocus />
                            
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <div class="input-icons">

                        <i class="fa fa-key icon"></i>
                        <input id="password" type="password" class="login-form displayPassword" name="password"
                            placeholder="Mot de passe*" required />
                        <i id="fa_eye" class="fa fa-eye icon_eyes"></i>
                        {{-- <i id="fa_eye_slash" class="fa fa-eye-slash icon_eyes"></i> --}}

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="">
                        <button type="submit" class="login-btn">CONNEXION</button>
                    </div>
                </div>
            </form>
        </div>
    </div> 
    {{-- script --}}
    <script defer src="{{ asset('js/login.js') }}"></script>
</body>
</html>
