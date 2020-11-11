@extends('template.layout')
@section('title') {{config('app.name')}} : Users @endsection
@section('content')
@include('template.alerts')

<form action="{{route('store-user')}}" method="POST" class="my-3">
    @csrf
    <div class="row">
        <div class="col-lg-3 my-2">
            <input type="text" value="{{old('username')}}" class="form-control" placeholder="Username" aria-label="Username" name="username" id="username">
        </div>

        <div class="col-lg-5 my-2">
            <input type="email" value="{{old('email')}}" class="form-control" placeholder="Email" aria-label="Email" name="email" id="email">
        </div>

        <div class="col-lg-4 my-2">
            <div class="input-group">
                <input class="form-control" value="{{old('username')}}" type="password" name="password" id="password" placeholder="Password">
                <div class="input-group-append">
                    <button class="btn btn-outline-primary ml-4" type="submit">Add user</button>
                </div>
            </div>
        </div>

    </div>
    
</form>

<hr>

<ul class="list-group my-4">

    @foreach($users as $user)

    <li class="list-group-item ">
        <div class="row d-flex align-items-center">

            <div class="col-lg-6">
                <strong> {{($user->name)}} </strong> : {{$user->email}}
            </div>

            <div class="col-lg-6">
                <form class="float-right" action="{{route('destroy-user')}}" method="POST" onsubmit="return confirm('This action will also delete the tasks associated to this user. \nAre you sure?')">
                    @method('DELETE')
                    @csrf
                    <input type="hidden" value="{{$user->id}}" name="id">
                    <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                </form>
            </div>

        </div>
    </li>
    @endforeach
</ul>

@endsection