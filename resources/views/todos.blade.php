@extends('layout')
@section('title') To-do list @endsection
@section('content')

<form action="{{route('store')}}" method="POST" class="my-2">

    @csrf

    <div class="input-group">
        <input type="text" class="form-control" placeholder="To-do name" aria-label="To-do name" name="name" id="name">
        <div class="input-group-append">
            <button class="btn btn-outline-primary ml-3" type="submit">Add To-do</button>
        </div>
    </div>

</form>

<ul class="list-group my-3">
    @foreach($todos as $todo)
    <li class="list-group-item d-flex justify-content-between align-items-center">{{$todo->name}}

        <form action="{{route('destroy')}}" method="POST" onsubmit="return confirm('Are you sure?')">
            @method('DELETE')
            @csrf
            <input type="hidden" value="{{$todo->id}}" name="id">
            <button class="btn btn-danger btn-sm" type="submit">Delete</button>
        </form>
    </li>
    @endforeach
</ul>

@endsection