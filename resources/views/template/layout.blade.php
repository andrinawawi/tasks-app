<!DOCTYPE html>
<html lang="pt-BR" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/app.css') }}" rel="stylesheet">
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