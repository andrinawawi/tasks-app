<!DOCTYPE html>
<html lang="pt-BR" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg+xml" href="{{asset('dist/icons/calendar-check-fill.svg')}}" color="#000"/>
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

    <div class="container text-center fw-bold my-4">
       <div>PRE ALPHA</div>
        <a href="https://github.com/murilomagalhaes/tasks-app" target="_blank">GITHUB</a>
    </div>
</div>


<script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
