<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container-fluid">

        <a class="navbar-brand border-right align-middle py-2 pr-4" href="/"><strong>Tasks</strong>App</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link {{Request::is('tasks') ? 'active' : ''}}" href="{{route('tasks')}}">Tasks</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{Request::is('reports') ? 'active' : ''}}" href="{{route('reports')}}">Reports</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{Request::is('users') ? 'active' : ''}}" href="{{route('users')}}">Users</a>
                </li>
            </ul>

            <li class="navbar-nav mb-2 mb-lg-0 dropdown">
                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                    <svg class="bi mr-2" width="24" height="24" fill="currentColor">
                        <use xlink:href="dist/icons/bootstrap-icons.svg#person-circle" />
                    </svg> {{Auth()->user()->name}}
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item link-danger text-decoration-none mr-2" href="{{route('logout')}}">Logout</a></li>
                </ul>
            </li>

        </div>
    </div>
</nav>