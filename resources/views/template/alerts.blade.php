@if(session('task-added'))
<div class="alert alert-primary p-2 my-4 d-flex align-items-center">
    <svg class="bi mx-2 my-auto" width="24" height="24" fill="currentColor">
        <use xlink:href="dist/icons/bootstrap-icons.svg#calendar-plus" />
    </svg> {{session('task-added')}}</div>
@endif

@if(session('task-deleted'))
<div class="alert alert-dark p-2 my-4 d-flex align-items-center">
<svg class="bi mx-2" width="24" height="24" fill="currentColor">
        <use xlink:href="dist/icons/bootstrap-icons.svg#calendar-x" />
    </svg>
{{session('task-deleted')}}</div>
@endif

@if(session('task-finished'))
<div class="alert alert-success p-2 my-4 d-flex align-items-center">
<svg class="bi mx-2" width="24" height="24" fill="currentColor">
        <use xlink:href="dist/icons/bootstrap-icons.svg#calendar-check" />
    </svg>
{{session('task-finished')}}</div>
@endif

@if(session('failed-login'))
<div class="alert alert-danger p-2 my-2">
    <svg class="bi mb-2" width="24" height="24" fill="currentColor">
        <use xlink:href="dist/icons/bootstrap-icons.svg#dash-circle-fill" />
    </svg> <br>
    {{session('failed-login')}}</div>
@endif

@if(session('successful-login'))
<div class="alert alert-success p-2 my-4 d-flex align-items-center">
    <svg class="bi mx-2 my-auto" width="24" height="24" fill="currentColor">
        <use xlink:href="dist/icons/bootstrap-icons.svg#check2-circle" />
    </svg> {{session('successful-login')}}</div>
@endif