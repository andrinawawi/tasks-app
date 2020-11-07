@extends('layout')
@section('title') Tasks List @endsection
@section('content')

    <form action="{{route('store-task')}}" method="POST" class="my-2">

        @csrf

        <div class="input-group">
            <input type="text" class="form-control" placeholder="Task name" aria-label="Task name" name="name"
                   id="name">
            <select class="form-select ml-3" placeholder="User" aria-label="User" name="user" id="user">
                <option selected>User</option>
                @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>
            <div class="input-group-append">
                <button class="btn btn-outline-primary ml-3" type="submit">Add task</button>
            </div>
        </div>

    </form>

    <ul class="list-group my-3">
        @foreach($tasks as $task)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span>
                <strong>{{$task->user->name}}</strong>
                : {{$task->name}}</span>

                <form action="{{route('destroy-task')}}" method="POST" onsubmit="return confirm('Are you sure?')">
                    @method('DELETE')
                    @csrf
                    <input type="hidden" value="{{$task->id}}" name="id">
                    <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>

@endsection
