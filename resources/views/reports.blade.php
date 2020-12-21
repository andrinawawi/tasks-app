@extends('template.layout')
@section('title') {{config('app.name')}} : Reports @endsection
@section('content')
@include('template.alerts')
@include('reports-filters')

<hr>

@if(isset($tasks))

<div class="row">
    <div class="col-12 px-4 text-center">
        <div class="mb-2 fs-5"> Listing <strong>{{$count['total']}}</strong> tasks.</div>
        <div class="d-flex align-items-center text-center justify-content-center fw-bold">
            <span class="bg-success bg-gradient py-1 px-2 rounded mx-1">Finished: {{$count['finished']}}</span>
            <span class="bg-warning bg-gradient py-1 px-2 rounded mx-1"> Pending: {{$count['pending']}}</span>
            <span class="bg-danger bg-gradient py-1 px-2 rounded mx-1">Overdue: {{$count['overDue']}}</span>
        </div>
    </div>
</div>

<table class="table table-responsive table-hover mt-4">
    <thead class="thead-light">
        <tr>
            <th scope="col">Task</th>
            <th scope="col">User</th>
            <th scope="col">Due Date</th>
            <th scope="col" class="text-end">Finish. Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tasks as $task)
        <tr class="
        {{$task->getFormatedFinishingDate() ? 'table-success' : ''}}
        {{$task->isOverDue() ? 'table-danger' : ''}}
        {{$task->isPending() ? 'table-warning' : ''}}
        ">
            <td>{{$task->name}}</td>
            <td>{{$task->user->name}}</td>
            <td>{{$task->getFormatedDueDate()}}</td>
            <td class="text-end">{{$task->getFormatedFinishingDate()}}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="row my-2">
    <div class="d-flex justify-content-center">
        {{ $tasks->links() }}
    </div>
</div>

@endif

@endsection