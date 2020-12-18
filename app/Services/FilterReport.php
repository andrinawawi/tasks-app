<?php


namespace App\Services;

use App\Models\Task;


class FilterReport
{
    public static function filter($request)
    {
        return Task::select('tasks.user_id', 'tasks.finishedOn', 'tasks.name', 'tasks.dueDate', 'tasks.id as id')
            ->selectRaw(" upper('users.name') as userName ")
            ->join('users', 'users.id', '=', 'tasks.user_id')
            ->where('finishedOn', null)
            ->where('tasks.name', 'like', "%$request->taskSearch%")
            ->when($request->userSearch, function ($tasks) use ($request) {
                return $tasks->where('user_id', $request->userSearch);
            })
            ->when($request->dueDateSearch, function ($tasks) use ($request) {
                return $tasks->whereDate('dueDate', $request->dueDateSearch);
            })
            ->when($request->finished, function ($tasks) {
                return $tasks->orWhere('finishedOn', '<>', null);
            })
            ->paginate(10);
    }
}
