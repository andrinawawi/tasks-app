@extends('template.layout')
@section('title') {{config('app.name')}} : Tasks @endsection
@section('content')
    @include('template.alerts')
    @include('task-edit')

    <form action="{{route('store-task')}}" method="POST" class="my-4">
        @csrf
        <div class="row">

            <div class="col-lg-2 my-2">
                <select class="form-select" aria-label="User" name="user" id="user">

                    @if(empty(old('user')))
                        <option disabled selected>Select user</option>
                    @endif

                    @foreach($users as $user)
                        @if(old('user') == $user->id)
                            <option selected value="{{$user->id}}"> {{$user->name}} </option>
                        @else
                            <option value="{{$user->id}}"> {{$user->name}} </option>
                        @endif
                    @endforeach

                </select>
            </div>

            <div class="col-lg-6 my-2">
                <input type="text" class="form-control" placeholder="Task name" aria-label="Task name" name="name"
                       value="{{old('name')}}" id="name" required>
            </div>

            <div class="col-lg-4 my-2">
                <div class="input-group">
                    <input class="form-control" type="datetime-local" name="dueDate" id="dueDate"
                           value="{{old('dueDate')}}" required>
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary ml-4" type="submit">Add task</button>
                    </div>
                </div>
            </div>

        </div>
    </form>

    <hr>

    @include('tasks-search')

    <ul class="list-group my-3">

        @foreach($tasks as $task)

            <li class="list-group-item">
                <div class="row d-flex align-items-center p-1">

                    <div class="col-lg-6">
                        <div class="row">
                            <span class="col-12"><strong> @php echo ucfirst($task->user->name) @endphp</strong> :</span>
                        </div>

                        <div class="row">
                            <span class="col-12"> {{$task->name}} </span>
                        </div>

                    </div>

                    <div class="col-lg-6">

                        <div class="row text-right mb-2">
                            <span> <i> (Due on {{$task->getFormatedDueDate()}}) </i></span>
                        </div>

                        <div class="row">
                            <div class="col-12 d-flex justify-content-end">
                                <form class="mr-2" action="{{route('finish-task')}}" method="POST"
                                      onsubmit="return confirm('Are you sure you want to finish this task?')">
                                    @method('PUT')
                                    @csrf
                                    <input type="hidden" value="{{$task->id}}" name="id">

                                    <button class="btn btn-success btn-sm" type="submit">Finish</button>
                                </form>

                                <a class="btn btn-primary btn-sm mr-2" id="edit-btn" data-toggle="modal"
                                   data-target="#editModal"
                                   data-task="{{$task->name}}" data-date="{{$task->dueDate}}"
                                   data-user="{{$task->user->id}}" data-taskId="{{$task->id}}">Edit</a>

                                <form action="{{route('destroy-task')}}" method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this task?')">
                                    @method('DELETE')
                                    @csrf
                                    <input type="hidden" value="{{$task->id}}" name="id">
                                    <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                                </form>
                            </div>


                        </div>
                    </div>

                </div>
            </li>
        @endforeach
    </ul>

    <div class="row my-2">
        <div class="d-flex justify-content-center">
            {{ $tasks->links() }}
        </div>
    </div>



    @if(!session('update-failed'))
        <script>

            let editModal = document.getElementById('editModal')

            editModal.addEventListener('show.bs.modal', function (event) {

                let button = event.relatedTarget

                let user = button.getAttribute('data-user')
                let userSelect = editModal.querySelector('.modal-body .form-select')

                for (i = 0; i < userSelect.length; i++) {
                    if (userSelect.options[i].value == user) {
                        userSelect[i].setAttribute('selected', 'selected')
                    }
                }

                let id = editModal.querySelector('.modal-body .id')
                id.value = button.getAttribute('data-taskId')

                let taskName = editModal.querySelector('.modal-body #updName')
                taskName.value = button.getAttribute('data-task')

                let dueDate = editModal.querySelector('.modal-body #updDueDate')
                dueDate.value = button.getAttribute('data-date')
            })
        </script>
    @endif


@endsection


