<div class="row my-4">

    <div class="accordion" id="accordion">

        <div class="card">

            <div class="card-header" id="heading-search">
                <h2 class="mb-0">
                    <button
                        class="btn btn-link w-100 d-flex justify-content-between align-items-center link-dark btn-block"
                        type="button" data-bs-toggle="collapse" data-bs-target="#collapse-search" aria-expanded="true"
                        aria-controls="collapse-search">

                        <span class="d-flex align-items-center">
                            <svg class="bi me-2" width="1em" height="1em" fill="currentColor">
                                <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#search')}}"/>
                            </svg>
                            Filters
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

                    <form method="GET" class="px-2 pt-2" action="{{route('filter-report')}}">

                        <div class="row justify-content-center">
                            <div class="form-group col-lg-3">
                                <label for="userSearch">User</label>
                                <select class="form-select mb-4" aria-label="User" name="userSearch" id="userSearch">

                                    <option @if( isset($oldRequest) && $oldRequest->userSearch == '')
                                            {{'selected'}}
                                            @endif value="">All users
                                    </option>

                                    @foreach($users as $user)
                                        <option @if( isset($oldRequest) && $oldRequest->userSearch == $user->id)
                                                {{'selected'}}
                                                @endif value="{{$user->id}}"> {{$user->name}} </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-lg-9">
                                <label for="taskSearch">Task name</label>
                                <input value="{{ $oldRequest->taskSearch ?? ''}}" type="text" name="taskSearch"
                                       class="form-control mb-4" id="taskSearch">
                            </div>
                        </div>
                        <div class="row justify-content-center">

                            <div class="form-group col-lg-4 mb-4">
                                <span>Due Date</span>
                                <div class="border border-2 rounded p-3">
                                    <label for="dueDateFrom">From</label>
                                    <input value="{{ $oldRequest->dueDateFrom ?? ''}}" type="date" name="dueDateFrom"
                                           class="form-control mb-4" id="dueDateFrom">

                                    <label for="dueDateUntil">Until</label>
                                    <input value="{{ $oldRequest->dueDateUntil ?? ''}}" type="date" name="dueDateUntil"
                                           class="form-control mb-4" id="dueDateUntil">
                                </div>
                            </div>

                            <div class="form-group col-lg-4 mb-4">
                                <span>Finishing Date</span>
                                <div class="border border-2 rounded p-3">
                                    <label for="finishingDateFrom">From</label>
                                    <input value="{{ $oldRequest->finishingDateFrom ?? ''}}" type="date"
                                           name="finishingDateFrom" class="form-control mb-4" id="finishingDateFrom">

                                    <label for="dueDateSearch">Until</label>
                                    <input value="{{ $oldRequest->finishingDateUntil ?? ''}}" type="date"
                                           name="finishingDateUntil" class="form-control mb-4" id="finishingDateUntil">
                                </div>
                            </div>


                            <div class="form-group col-lg-4 mb-4">
                                <span>Oder by (Asc.)</span>

                                <div class="border border-2 founded p-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="searchOrder"
                                               id="inlineRadio1"
                                               value="userName" @if( isset($oldRequest) && $oldRequest->searchOrder == 'userName')
                                            {{'checked'}}
                                            @endif >
                                        <label class="form-check-label" for="inlineRadio1">Order by User</label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="searchOrder"
                                               id="inlineRadio2"
                                               value="taskName" @if( isset($oldRequest) && $oldRequest->searchOrder == 'taskName')
                                            {{'checked'}}
                                            @endif >
                                        <label class="form-check-label" for="inlineRadio2">Order by Task name</label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="searchOrder"
                                               id="inlineRadio3"
                                               value="dueDate" @if( isset($oldRequest) && $oldRequest->searchOrder == 'dueDate')
                                            {{'checked'}}
                                            @endif >
                                        <label class="form-check-label" for="inlineRadio3">Order by Due date</label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="searchOrder"
                                               id="inlineRadio4"
                                               value="finishedOn" @if( isset($oldRequest) && $oldRequest->searchOrder == 'finishedOn')
                                            {{'checked'}}
                                            @endif >
                                        <label class="form-check-label" for="inlineRadio4">Order by Finishing
                                            Date</label>
                                    </div>
                                </div>

                                <div class="mt-4">

                                    <button class="btn btn-outline-secondary d-inline-flex align-items-center"
                                            type="button" id="clear-filters">
                                        <svg class="bi me-2" width="1em" height="1em" fill="currentColor">
                                            <use
                                                xlink:href="{{asset('dist/icons/bootstrap-icons.svg#backspace-fill')}}"/>
                                        </svg>
                                        Clear filters
                                    </button>

                                    <button class="btn btn-outline-primary d-inline-flex align-items-center float-end"
                                            type="submit">
                                        <svg class="bi me-2" width="1em" height="1em" fill="currentColor">
                                            <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#file-text')}}"/>
                                        </svg>
                                        View report
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
