<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous">
    <title>@yield('title')</title>
</head>

<body>

    <div class="container py-4">
        <h1>@yield('title')</h1>
        <hr>

        @if(session('added'))
        <div class="alert alert-success">{{session('added')}}</div>
        @endif

        @if(session('deleted'))
        <div class="alert alert-info">{{session('deleted')}}</div>
        @endif

        @if($errors)
        @foreach($errors->all() as $error)
        <div class="alert alert-danger">{{$error}}</div>
        @endforeach
        @endif

        @yield('content')

    </div>


    <p class="mb-2 text-center mb-4">
        Basic shit, i know...
    </p>


</body>
</html>