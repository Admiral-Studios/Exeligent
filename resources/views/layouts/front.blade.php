<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="New approach for job finding.">
    <meta name="robots" content="noindex, nofollow" />
    <title>@yield('title')</title>
    <!-- Styles -->
    <style>
        .tabs {
            background-color: white
        }
    </style>
    <link href="https://fonts.cdnfonts.com/css/campton" rel="stylesheet">
    @vite('resources/scss/style.scss')
    <link rel="stylesheet" href="{{ asset('/css/ckeditor.css') }}">
    @include('layouts._google-tag')
</head>

<body class="{{ isset($bodyClass) ? $bodyClass : '' }}">

@include('layouts._notifications')

{!! \App\Services\MenuService::renderHeader() !!}

<main>

    @yield('content')

</main>

{!! \App\Services\MenuService::renderFooter() !!}

<!-- Scripts -->
<script src="{{ asset('js/front.js') }}"></script>
@stack('scripts')
</body>
</html>
