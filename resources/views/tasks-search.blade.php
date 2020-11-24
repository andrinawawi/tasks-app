<div class="row my-2">

    <div class="accordion" id="accordion">

        <div class="card">

            <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                    <button class="btn btn-link link-dark btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Search
                    </button>
                </h2>
            </div>

            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">

                    <form class="row" method="GET" action="{{route('search-task')}}">

                        <div class="form-group mb-4 col-lg-3">
                            <label for="userSearch">User</label>
                            <select class="form-select" aria-label="User" name="userSearch" id="userSearch">
                                <option disabled selected>Select user</option>
                                @foreach($users as $user)
                                <option value="{{$user->id}}"> {{$user->name}} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-4 col-lg-6">
                            <label for="taskSearch">Task name</label>
                            <input type="text" name="taskSearch" class="form-control" id="taskSearch">
                        </div>

                        <div class="form-group mb-4 col-lg-3">
                            <label for="dueDateSearch">Due date</label>
                            <input type="date" name="dueDateSearch" class="form-control" id="dueDateSearch">
                        </div>

                        <div class="d-flex justify-content-between align-items-center">


                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="searchOrder" id="inlineRadio2" value="users.name">
                                    <label class="form-check-label" for="inlineRadio2">Order by User</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="searchOrder" id="inlineRadio1" value="dueDate">
                                    <label class="form-check-label" for="inlineRadio1">Order by Due date</label>
                                </div>
                            </div>

                            <div class="d-flex float-right">

                                <a class="btn btn-sm btn-outline-dark d-flex align-items-center mr-2" href="{{route('tasks')}}">
                                    <svg class="bi mx-1" width="1em" height="1em" fill="currentColor">
                                        <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#arrow-clockwise')}}" />
                                    </svg>
                                </a>

                                <button class="btn btn-sm btn-outline-primary d-flex align-items-center">
                                    <svg class="bi mr-2" width="1em" height="1em" fill="currentColor">
                                        <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#search')}}" />
                                    </svg>
                                    Search
                                </button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>