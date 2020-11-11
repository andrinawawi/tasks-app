@extends('template.layout')
@section('title') Tasks @endsection
@section('content')
@include('template.alerts')

<form action="{{route('store-task')}}" method="POST" class="my-3">
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
            <input type="text" class="form-control" placeholder="Task name" aria-label="Task name" name="name" value="{{old('name')}}" id="name">
        </div>

        <div class="col-lg-4 my-2">
            <div class="input-group">
                <input class="form-control" type="datetime-local" name="dueDate" id="dueDate" value="{{old('dueDate')}}">
                <div class="input-group-append">
                    <button class="btn btn-outline-primary ml-4" type="submit">Add task</button>
                </div>
            </div>
        </div>

    </div>
</form>

<hr>

<ul class="list-group my-4">

    @foreach($tasks as $task)

    <li class="list-group-item ">
        <div class="row d-flex align-items-center">

            <div class="col-lg-6">
                <strong> @php echo ucfirst($task->user->name) @endphp</strong> : {{$task->name}}
            </div>

            <div class="col-lg-6">
                <form class="float-right" action="{{route('destroy-task')}}" method="POST" onsubmit="return confirm('Are you sure?')">
                    @method('DELETE')
                    @csrf
                    <input type="hidden" value="{{$task->id}}" name="id">
                    <span class="mr-2"> <i> (Due on {{$task->getFormatedDueDate()}}) </i></span>
                    <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                </form>
            </div>

        </div>
    </li>
    @endforeach
</ul>


@endsection