@extends('template.layout')
@section('title') {{config('app.name')}} : Reports @endsection
@section('content')
    @include('template.alerts')
    @include('reports-filters')

    <hr>

    @if(isset($tasks) && !session('filter-failed'))

        <div class="row">
            @if($count['total'] == 0)
                <div class="mb-2 fs-5 text-center"> No tasks found with the provided filters</div>
            @else
                <div class="col-12 px-4 text-center">
                    <div class="mb-2 fs-5"> Listing
                        <strong>{{$count['total']}}</strong> {{$count['total'] == 1 ? 'task' : 'tasks'}}.
                    </div>
                    <div class="d-flex align-items-center text-center justify-content-center fw-bold">
                        <span
                            class="bg-success bg-gradient py-1 px-2 rounded mx-1">Finished: {{$count['finished']}}</span>
                        <span
                            class="bg-warning bg-gradient py-1 px-2 rounded mx-1"> Pending: {{$count['pending']}}</span>
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
                    <td>{{ucfirst(strtolower($task->taskName))}}</td>
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

    @endif

    <script>
        document.getElementById('clear-filters').addEventListener('click', function () {
            document.getElementById('dueDateFrom').value="";
            document.getElementById('dueDateUntil').value="";
            document.getElementById('taskSearch').value="";
            document.getElementById('finishingDateFrom').value="";
            document.getElementById('finishingDateUntil').value="";
            document.getElementById('inlineRadio1').checked = false;
            document.getElementById('inlineRadio2').checked = false;
            document.getElementById('inlineRadio3').checked = false;
            document.getElementById('inlineRadio4').checked = false;
            document.getElementById('userSearch').value = "";
        })
    </script>

@endsection
