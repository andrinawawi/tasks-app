<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskFormRequest;
use App\Services\FindTask;
use App\Models\{Task, User};
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $tasks = Task::where('finishedOn', null)->orderBy('dueDate')->simplePaginate(10);
        $users = User::query()->get()->sortBy('name', SORT_FLAG_CASE | SORT_NATURAL);

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
        $tasks = FindTask::find($request);
        $users = User::query()->get()->sortBy('name', SORT_FLAG_CASE | SORT_NATURAL);

        return view('tasks')->with([
            'tasks' => $tasks,
            'users' => $users,
            'collapseShow' => 'show',
            'oldRequest' => $request
        ]);
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

    public function update(Request $request)
    {
        //Form request validation is not being used so it's easier to redirect to another action;
        $now = Carbon::now()->subMinutes(5);

        $rules = [
            'updName' => 'required|min:3',
            'updUser' => 'required',
            'updDueDate' => "required|date|after_or_equal:$now"
        ];

        $messages = [
            'updName.required' => "The task name is required.",
            'updName.min' => "The task name should be at least 3 characters long.",
            'updDueDate.required' => 'The task due date is required.',
            'updDueDate.date' => 'Invalid date format',
            'updDueDate.after_or_equal' => "The due date can't be earlier than today/now.",
            'updUser.required' => "You should select a user for this task."
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()
                ->route('tasks')
                ->with('update-failed', true)
                ->withErrors($validator)
                ->withInput();

        }

        $task = Task::find($request->id);

        $oldTaskName = $task->name;

        $task->name = $request->updName;
        $task->user_id = $request->updUser;
        $task->dueDate = $request->updDueDate;
        $task->save();

        return redirect()
            ->route('tasks')
            ->with('task-updated', "'$oldTaskName' updated successfully.");
    }
}
