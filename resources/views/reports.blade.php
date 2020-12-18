@extends('template.layout')
@section('title') {{config('app.name')}} : Reports @endsection
@section('content')
@include('template.alerts')
@include('reports-filters')

<hr>

@if(isset($tasks))

<div class="row">
    <div class="col-12 px-4">
        <span class="me-2"> Listing <strong>{{count($tasks)}}</strong> tasks.</span>
        <span class="text-success bg-dark py-1 px-2 rounded"> Finished: <strong>{{count($tasks->where('finishedOn', '<>', null, 'or', 'finishingDate', '<>', ''))}}</strong></span>
        <span class="text-warning bg-dark py-1 px-2 rounded"> Pending: <strong>{{count($tasks->where('finishedOn', '=', null, 'or', 'finishingDate', '=', ''))}}</strong></span>
    </div>
</div>

<table class="table table-responsive table-hover mt-4">
    <thead class="bg-dark text-light">
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
        {{!$task->getFormatedFinishingDate() && $task->isOverDue() ? 'table-danger' : ''}}
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