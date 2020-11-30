<?php


namespace App\Services;

use App\Models\Task;
use Illuminate\Support\Facades\DB;


class FindTask
{
    public static function find($request)
    {
        return Task::select('tasks.user_id', 'tasks.name', 'tasks.dueDate', 'tasks.id as id')
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
            ->when($request->finished, function ($tasks) use ($request) {
                return $tasks->orWhere('finishedOn', '<>', null);
            })
            ->simplePaginate(10);

    }

}
