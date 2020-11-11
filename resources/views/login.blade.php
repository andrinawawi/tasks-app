@extends('template.layout')
@section('title') {{config('app.name')}} : Login @endsection

@section('login-form')

<div class="container h-100">

    <div class="row h-100 align-items-center">
        <div class="m-auto">

            <h1 class="text-center display-6"> <strong>{{config('app.name')}} </strong> : Login </h2>
                <hr class="m-3">

                <form method="POST" action="{{route('login-submit')}}">

                    @csrf

                    <div class="row">
                        <div class="col-lg-6 mx-auto text-center"> @include('template.alerts') </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-lg-6 p-auto mx-auto my-2">
                            <div class="input-group">
                                <input type="text" value="{{old('login')}}" class="form-control shadow" placeholder="Email or Username" aria-label="Login" aria-describedby="addon-wrapping" name="login">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-lg-6 mx-auto my-2">
                            <div class="input-group">
                                <input type="password" value="{{old('password')}}" name="password" id="password" placeholder="Password" required min="1" class="form-control shadow">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-outline-primary shadow ml-3">
                                        Login
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
        </div>
    </div>

</div>

@endsection