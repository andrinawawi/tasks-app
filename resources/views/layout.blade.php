<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.bundle.min.js" integrity="sha384-BOsAfwzjNJHrJ8cZidOg56tcQWfp6y72vEJ8xQ9w6Quywb24iOsW913URv1IS4GD" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous">
    <title>@yield('title')</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">

            <a class="navbar-brand border-right pr-3" href="/"><strong>Tasks</strong>App</a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mr-auto mb-2 mb-lg-0">

                    @auth
                    <li class="nav-item">
                        <a class="nav-link {{Request::is('tasks') ? 'active' : ''}}" href="{{route('tasks')}}">Tasks</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{Request::is('users') ? 'active' : ''}}" href="{{route('users')}}">Users</a>
                    </li>
                    @endauth

                </ul>

                @auth
                <li class="navbar-nav mb-2 mb-lg-0 dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                        {{Auth()->user()->name}}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item link-danger text-decoration-none mr-2" href="{{route('logout')}}">Logout</a></li>
                    </ul>
                </li>
               
                @endauth

            </div>
        </div>
    </nav>

    <div class="container py-4">
        <h1>@yield('title')</h1>
        <hr>

        @if(session('added'))
        <div class="alert alert-success p-2">{{session('added')}}</div>
        @endif

        @if(session('deleted'))
        <div class="alert alert-info p-2">{{session('deleted')}}</div>
        @endif

        @if($errors)
        @foreach($errors->all() as $error)
        <div class="alert alert-danger p-2">{{$error}}</div>
        @endforeach
        @endif

        @yield('content')

    </div>


    <p class="mb-2 text-center mb-4">
        Basic shit, i know...
    </p>


</body>

</html>