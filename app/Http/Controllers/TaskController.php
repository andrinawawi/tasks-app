<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskFormRequest;
use App\Models\{Task, User};
use Carbon\Carbon;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $tasks = Task::where('finishedOn', null)->orderBy('name')->simplePaginate(10);
        $users = User::query()->orderBy('name')->get();

        return view('tasks', compact('tasks', 'users'));
    }

    public function store(TaskFormRequest $request)
    {
        $task = Task::create([
            'name' => $request->get('name'),
            'user_id' => $request->get('user'),
            'dueDate' => $request->get('dueDate')
        ]);

        return redirect()
            ->route('tasks')
            ->with("task-added", "'$task->name' created successfully.");
    }

    public function destroy(Request $request)
    {
        $task = Task::where('id', $request->id)->first();

        Task::destroy($request->id);

        return redirect()
            ->route('tasks')
            ->with("task-deleted", "'$task->name' deleted successfully.");
    }

    public function search(Request $request)
    {

        $tasks = Task::where('finishedOn', null)
            ->where('name', 'like', "%$request->taskSearch%")
            ->when($request->userSearch, function ($tasks) use ($request) {
                return $tasks->where('user_id', $request->userSearch);
            })
            ->simplePaginate(10);


        $users = User::query()->orderBy('name')->get();

        return view('tasks', compact('tasks', 'users'));
    }

    public function finish(Request $request)
    {
        $task = Task::find($request->id);
        $task->finishedOn = Carbon::now();
        $task->save();

        return redirect()
            ->route('tasks')
            ->with('task-finished', "'$task->name' finished successfully.");
    }
}
