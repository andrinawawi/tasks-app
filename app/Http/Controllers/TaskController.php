<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskFormRequest;
use App\Models\{Task, User};
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $tasks = Task::query()->orderBy('name')->get();
        $users = User::query()->orderBy('name')->get();

        return view('tasks', compact('tasks', 'users'));
    }

    public function store(TaskFormRequest $request)
    {
        $task = Task::create([
            'name' => $request->get('name'),
            'user_id' => $request->get('user'),
            'dueDate' => $request->get('due-date')
        ]);

        return redirect()
            ->route('tasks')
            ->with("added", "Task: '$task->name' created successfully.");
    }

    public function destroy(Request $request)
    {
        $task = Task::where('id', $request->id)
            ->first();

        Task::destroy($request->id);

        return redirect()
            ->route('tasks')
            ->with("deleted", "Task: '$task->name' deleted successfully.");
    }
}
