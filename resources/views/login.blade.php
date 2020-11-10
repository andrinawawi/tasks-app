@extends('layout')
@section('title') Login @endsection
@section('content')

<form method="POST">
    @csrf
    <div class="row">
        <div class="form-group col-lg-6 p-auto mx-auto my-2">
            <div class="input-group">
                <span class="input-group-text" id="addon-wrapping">@</span>
                <input type="text" value="{{old('email')}}" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="addon-wrapping" name="email">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-lg-6 mx-auto my-2">
            <div class="input-group">
                <input type="password" value="{{old('password')}}" name="password" id="password" placeholder="Password" required min="1" class="form-control">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-outline-primary ml-3">
                        Login
                    </button>
                </div>
            </div>
        </div>
    </div>


</form>

@endsection