<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="robots" content="noindex, nofollow" />

    <title>@yield('title')</title>
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('/css/custom.css') }}">
    @vite('resources/scss/style.scss')
    @include('layouts._google-tag')
</head>
@include('layouts._google-tag')

<body class="login-page">

<header class="header">
    <div class="wrapper-container">
        <div class="header-wrapper flex align-center flex-between">
            <div class="header-logo">
                <a href="{{ route('home') }}">
                    <img width="118" height="44" src="{{ header_logo_url() }}" alt="logo">
                </a>
            </div>
            <div class="header-buttons-auth flex align-center">
                @if(auth()->check() && auth()->user()->hasRole())
                    <a class="btn btn-clear" href="{{ route('page', 'dashboard') }}">Dashboard</a>
                @else
                    @if(request()->routeIs('login'))
                    <a class="btn btn-clear" href="{{ route('register') }}">Sign Up</a>
                    @else
                        @if(App\Services\SettingService::canRegister())
                        <a class="btn btn-clear" href="{{ route('login') }}">Log In</a>
                        @endif
                    @endif
                @endif
                <a class="btn btn-clear" href="{{ route('page', 'contact') }}">Support</a>
            </div>
            <div class="header-burger"></div>
        </div>
    </div>
</header>

<main>
    @include('layouts._notifications')

    @yield('content')
</main>

<!-- Scripts -->
<script src="{{ asset('/js/jquery-3.7.0.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
@stack('scripts')
</body>
</html>
