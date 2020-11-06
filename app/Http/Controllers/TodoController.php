<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoFormRequest;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index(Request $request)
    {
        $todos = Todo::query()->orderBy('name')->get();

        return view('todos', compact('todos'));
    }

    public function store(TodoFormRequest $request)
    {
        $todo = Todo::create([
            'name' => $request->get('name')
        ]);

        return redirect()
            ->route('todos')
            ->with("added", "'$todo->name' added successfully");
    }

    public function destroy(Request $request)
    {
        $todo = Todo::where('id', $request->id)
            ->first();

        Todo::destroy($request->id);

        return redirect()
            ->route('todos')
            ->with("deleted", "'$todo->name' deleted successfully");
    }
}
