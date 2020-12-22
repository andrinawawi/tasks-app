<div class="row my-4">

    <div class="accordion" id="accordion">

        <div class="card">

            <div class="card-header" id="heading-search">
                <h2 class="mb-0">
                    <button class="btn w-100 d-flex justify-content-between align-items-center link-dark btn-block"
                            type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapse-search" aria-expanded="true"
                            aria-controls="collapse-search">

                        <span class="d-flex align-items-center text-decoration-none">
                            <svg class="bi me-2" width="1em" height="1em" fill="currentColor">
                                <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#search')}}"/>
                            </svg>
                            <span
                                class="text-decoration-underline me-2"> Search </span> <span> {{Request::is('tasks') ? ' (Showing all pending tasks by Due Date)' : ' (Showing custom search)'}}</span>
                        </span>
                        <svg class="bi" width="1em" height="1em" fill="currentColor">
                            <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#chevron-down')}}"/>
                        </svg>
                    </button>
                </h2>
            </div>

            <div id="collapse-search" class="collapse {{$collapseShow ?? ''}}" aria-labelledby="heading-search"
                 data-bs-parent="#accordion">
                <div class="card-body">

                    <form method="GET" action="{{route('search-task')}}">

                        <div class="row">
                            <div class="form-group col-lg-3">
                                <label for="userSearch">User</label>
                                <select class="form-select mb-4" aria-label="User" name="userSearch" id="userSearch">

                                    <option @if( isset($oldRequest) && $oldRequest->userSearch == '')
                                            {{'selected'}}
                                            @endif value="">All users
                                    </option>

                                    @foreach($users as $user)
                                        <option
                                            @if( isset($oldRequest) && $oldRequest->userSearch == $user->id)
                                            {{'selected'}}
                                            @endif value="{{$user->id}}"> {{$user->name}} </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="taskSearch">Task name</label>
                                <input value="{{ $oldRequest->taskSearch ?? ''}}" type="text" name="taskSearch"
                                       class="form-control mb-4" id="taskSearch">
                            </div>

                            <div class="form-group col-lg-3">
                                <label for="dueDateSearch">Due date</label>
                                <input value="{{ $oldRequest->dueDateSearch ?? ''}}" type="date" name="dueDateSearch"
                                       class="form-control mb-4" id="dueDateSearch">
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="d-flex align-items-center">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="searchOrder"
                                           id="inlineRadio2"
                                           value="userName"
                                    @if( isset($oldRequest) && $oldRequest->searchOrder == 'userName')
                                        {{'checked'}}
                                        @endif >
                                    <label class="form-check-label" for="inlineRadio2">Order by User</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="searchOrder"
                                           id="inlineRadio1"
                                           value="dueDate"
                                    @if( isset($oldRequest) && $oldRequest->searchOrder == 'dueDate')
                                        {{'checked'}}
                                        @endif >
                                    <label class="form-check-label" for="inlineRadio1">Order by Due date</label>
                                </div>
                            </div>
                        </div>

                        <div class="row d-flex align-items-center">

                            <div class="col-md-9">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="finished" name="finished"
                                    @if( isset($oldRequest) && $oldRequest->finished == 'on')
                                        {{'checked'}}
                                        @endif >
                                    <label for="finished">Show finished tasks</label>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="d-flex float-end mt-4 mt-sm-0">
                                    <a class="btn btn-sm btn-outline-dark d-flex align-items-center me-2"
                                       href="{{route('tasks')}}">
                                        <svg class="bi mx-1" width="1em" height="1em" fill="currentColor">
                                            <use
                                                xlink:href="{{asset('dist/icons/bootstrap-icons.svg#arrow-clockwise')}}"/>
                                        </svg>
                                    </a>

                                    <button class="btn btn-sm btn-outline-primary d-flex align-items-center">
                                        <svg class="bi me-2" width="1em" height="1em" fill="currentColor">
                                            <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#search')}}"/>
                                        </svg>
                                        Search
                                    </button>
                                </div>
                            </div>

                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
