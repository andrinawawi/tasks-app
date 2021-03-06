@if(session('user-added'))
<div class="alert alert-primary p-2 my-4 d-flex align-items-center">
    <svg class="bi mx-2 my-auto" width="24" height="24" fill="currentColor">
        <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#person-plus-fill')}}" />
    </svg> {{session('user-added')}}</div>
@endif

@if(session('user-deleted'))
<div class="alert alert-dark p-2 my-4 d-flex align-items-center">
<svg class="bi mx-2" width="24" height="24" fill="currentColor">
        <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#person-dash-fill')}}" />
    </svg>
{{session('user-deleted')}}</div>
@endif

@if(session('user-updated'))
<div class="alert alert-success p-2 my-4 d-flex align-items-center">
<svg class="bi mx-2" width="24" height="24" fill="currentColor">
        <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#arrow-repeat')}}" />
    </svg>
{{session('user-updated')}}</div>
@endif

@if(session('task-added'))
<div class="alert alert-primary p-2 my-4 d-flex align-items-center">
    <svg class="bi mx-2 my-auto" width="24" height="24" fill="currentColor">
        <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#calendar-plus')}}" />
    </svg> {{session('task-added')}}</div>
@endif

@if(session('task-updated'))
<div class="alert alert-success p-2 my-4 d-flex align-items-center">
<svg class="bi mx-2" width="24" height="24" fill="currentColor">
        <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#arrow-repeat')}}" />
    </svg>
{{session('task-updated')}}</div>
@endif

@if(session('task-deleted'))
<div class="alert alert-dark p-2 my-4 d-flex align-items-center">
<svg class="bi mx-2" width="24" height="24" fill="currentColor">
        <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#calendar-x')}}" />
    </svg>
{{session('task-deleted')}}</div>
@endif

@if(session('task-finished'))
<div class="alert alert-success p-2 my-4 d-flex align-items-center">
<svg class="bi mx-2" width="24" height="24" fill="currentColor">
        <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#calendar-check')}}" />
    </svg>
{{session('task-finished')}}</div>
@endif

@if(session('failed-login'))
<div class="alert alert-danger p-2 my-2">
    <svg class="bi mb-2" width="24" height="24" fill="currentColor">
        <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#dash-circle-fill')}}" />
    </svg> <br>
    {{session('failed-login')}}</div>
@endif

@if(session('successful-login'))
<div class="alert alert-success p-2 my-4 d-flex align-items-center">
    <svg class="bi mx-2 my-auto" width="24" height="24" fill="currentColor">
        <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#check2-circle')}}" />
    </svg> {{session('successful-login')}}</div>
@endif

@if($errors->any())
    @foreach($errors->all() as $error)
    <div class="alert alert-danger p-2 my-4 d-flex align-items-center">
        <svg class="bi mx-2 my-auto" width="24" height="24" fill="currentColor">
            <use xlink:href="{{asset('dist/icons/bootstrap-icons.svg#exclamation-triangle')}}" />
        </svg> {{$error}}</div>
    @endforeach
@endif
