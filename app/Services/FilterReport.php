<?php


namespace App\Services;

use App\Models\Task;
use Carbon\Carbon;

class FilterReport
{
    public static function filter($request)
    {
        dd($request->dueDateFrom . ' 00:00:00', $request->dueDateUntil . ' 23:59:59');

        $tasks = Task::select('tasks.user_id', 'tasks.finishedOn', 'tasks.name', 'tasks.dueDate', 'tasks.id as id')
            ->selectRaw(" upper('users.name') as userName ")
            ->join('users', 'users.id', '=', 'tasks.user_id')
            ->where('tasks.name', 'like', "%$request->taskSearch%")
            ->when($request->userSearch, function ($tasks) use ($request) {
                return $tasks->where('user_id', $request->userSearch);
            })
            ->when($request->dueDateFrom, function ($tasks) use ($request) {
                return $tasks->whereBetween('dueDate', [$request->dueDateFrom, $request->dueDateUntil . ' 23:59:59']);
            })
            ->when($request->finishingDateFrom, function ($tasks) use ($request) {
                return $tasks->whereBetween('finishedOn', [$request->finishingDateFrom, $request->finishingDateUntil]);
            });

        $countableTasks = $tasks->get();

        $count = [
            'total' => $countableTasks->count(),
            'finished' => $countableTasks->where('finishedOn', '<>', null, 'or', 'finishedOn', '<>', '')->count(),
            'pending' => $countableTasks->where('finishedOn', '=', null, 'or', 'finishedOn', '=', '')
                ->where('dueDate', '>', now())->count(),
            'overDue' => $countableTasks->where('finishedOn', '=', null, 'or', 'finishedOn', '=', '')
                ->where('dueDate', '<', now())->count()
        ];

        return [
            'tasks' => $tasks->paginate('10'),
            'count' => $count
        ];
    }
}
