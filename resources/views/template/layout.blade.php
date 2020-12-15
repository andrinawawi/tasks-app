<!DOCTYPE html>
<html lang="pt-BR" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg+xml" href="{{asset('dist/icons/calendar-check-fill.svg')}}" color="#000"/>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>

    <title>@yield('title')</title>
</head>

<body class="h-100">

@auth
    @include('template.nav')
@endauth

@yield('login-form')

<div class="container">
    @yield('content')
</div>

</body>

</html>
