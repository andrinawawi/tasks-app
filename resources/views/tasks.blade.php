@extends('template.layout')
@section('title') {{config('app.name')}} : Tasks @endsection
@section('content')

@if(!session('update-failed'))
@include('template.alerts')
@endif

@if(Auth()->user()->isAdminUser)
@include('task-edit')

<form action="{{route('store-task')}}" method="POST" class="mt-4">
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
            <input type="text" class="form-control" placeholder="Task name" aria-label="Task name" name="name" value="{{old('name')}}" id="name" required>
        </div>

        <div class="col-lg-4 my-2">
            <div class="input-group">
                <input class="form-control" type="datetime-local" name="dueDate" id="dueDate" value="{{old('dueDate')}}" required>
                <div class="input-group-append">
                    <button class="btn btn-outline-primary ms-4" type="submit">Add task</button>
                </div>
            </div>
        </div>

    </div>
</form>

<hr>

@endif

@include('tasks-search')

<ul class="list-group my-3">

    @foreach($tasks as $task)

    <li class="list-group-item list-group-item-action {{$task->getFormatedFinishingDate() ? 'list-group-item-success' : ''}}
        {{!$task->getFormatedFinishingDate() && $task->isOverDue() ? 'list-group-item-danger' : ''}}" >
        <div class="row d-flex align-items-center p-1">

            <div class="col-lg-6">
                <div class="row">
                    <span class="col-12"><strong class="{{($task->getFormatedFinishingDate()) ? 'text-success' : ''}}"> @php echo ucfirst($task->user->name) @endphp</strong> :
                        @if(!empty($task->getFormatedFinishingDate()))
                        <i class="text-success">Finished on {{$task->getFormatedFinishingDate()}}</i>
                        @endif {{!$task->getFormatedFinishingDate() && $task->isOverDue() ? 'Overdue!' : ''}}</span>
                </div>

                <div class="row">
                    <span class="col-12"> {{$task->name}} </span>
                </div>

            </div>

            <div class="col-lg-6">

                <div class="row text-end mb-2">
                    <span> <i> (Due on {{$task->getFormatedDueDate()}}) </i></span>
                </div>

                <div class="row">
                    <div class="col-12 d-flex justify-content-end">
                        @if(!$task->getFormatedFinishingDate())
                        @if(Auth()->user()->isAdminUser || Auth()->user()->id == $task->user_id)
                        <form class="me-2" action="{{route('finish-task')}}" method="POST" onsubmit="return confirm('Are you sure you want to finish this task?')">
                            @method('PUT')
                            @csrf
                            <input type="hidden" value="{{$task->id}}" name="id">

                            <button class="btn btn-success btn-sm" type="submit">Finish</button>
                        </form>
                        @endif

                        @if(Auth()->user()->isAdminUser)
                        <button type="button" class="btn btn-primary btn-sm me-2" id="editBtn" data-bs-toggle="modal" data-bs-target="#editModal" data-task="{{$task->name}}" data-date="{{$task->dueDate}}" data-user="{{$task->user->id}}" data-taskId="{{$task->id}}">Edit</button>
                        @endif

                        @endif
                        @if(Auth()->user()->isAdminUser)
                        <form action="{{route('destroy-task')}}" method="POST" onsubmit="return confirm('Are you sure you want to delete this task?')">
                            @method('DELETE')
                            @csrf
                            <input type="hidden" value="{{$task->id}}" name="id">
                            <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                        </form>
                        @endif
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

<script>
    //Functions used to load edit modal on page-load, close it and add edit values
    function openModal() {
        document.body.classList.add('modal-open')

        let editModal = document.getElementById('editModal')
        editModal.classList.add('show')

        let backdrop = document.createElement('DIV')
        backdrop.classList.add("modal-backdrop", 'fade', 'show')
        backdrop.setAttribute('id', 'backdrop')

        document.body.appendChild(backdrop)
        document.getElementById('editModal').style.display = 'block'
    }

    function addValuesToModal() {

        let editModal = document.getElementById('editModal')

        editModal.addEventListener('show.bs.modal', function(event) {

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
    }
</script>

@if(!session('update-failed'))
<script>
    addValuesToModal();
</script>
@else

<script>
    openModal()

    // Reloads page when clicking outside modal
    let editModal = document.getElementsByClassName('modal-content')[0];

    document.addEventListener('click', function(event) {
        let editModalClick = editModal.contains(event.target);

        if (!editModalClick) {
            document.location.reload(false);
        }
    });

    document.getElementsByClassName('btn-close')[0].addEventListener('click', function() {
        document.location.reload(false);
    }, true)

    document.getElementById('close').addEventListener('click', function() {
        document.location.reload(false);
    }, true)
</script>

@endif

@endsection