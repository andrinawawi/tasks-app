@extends('template.layout')
@section('title') {{config('app.name')}} : Users @endsection
@section('content')
@include('template.alerts')

<form action="{{route('store-user')}}" method="POST" class="my-4">
    @csrf
    <div class="row">

        <div class="col my-2 d-flex align-items-center">
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="isAdmin" name="isAdmin" value="true">
                <label class="form-check-label" for="isAdmin">Is admin user.</label>
            </div>
        </div>
        <div class="col-lg-3 my-2">
            <input type="text" value="{{old('username')}}" class="form-control" placeholder="Username" aria-label="Username" name="username" id="username">
        </div>

        <div class="col-lg-3 my-2">
            <input type="email" value="{{old('email')}}" class="form-control" placeholder="Email" aria-label="Email" name="email" id="email">
        </div>

        <div class="col-lg-4 my-2">
            <div class="input-group">
                <input class="form-control" value="{{old('username')}}" type="password" name="password" id="password" placeholder="Password">
                <div class="input-group-append">
                    <button class="btn btn-outline-primary ms-4" type="submit">Add user</button>
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
                <strong> {{($user->name)}} </strong> : <a href="mailto:{{$user->email}}">{{$user->email}}</a>  <i> {{$user->isAdminUser ? "(Admin user.)"  : ''}} </i>
            </div>

            <div class="col-lg-6">
                <form class="float-end" action="{{route('destroy-user')}}" method="POST" onsubmit="return confirm('This action will also delete the tasks associated to this user. \nAre you sure?')">
                    @method('DELETE')
                    @csrf
                    <input type="hidden" value="{{$user->id}}" name="id">
                    <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                </form>
                <div class="float-end">
                    <button type="button" class="btn btn-primary btn-sm me-2" id="editBtn" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>
                </div>
            </div>

        </div>
    </li>
    @endforeach
</ul>

@endsection