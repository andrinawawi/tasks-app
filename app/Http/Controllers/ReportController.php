<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Services\FilterReport;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::query()->get()->sortBy('name', SORT_FLAG_CASE | SORT_NATURAL);
        return view('reports', compact('users'));
    }

    public function filter(Request $request)
    {
        $tasks = FilterReport::filter($request);
        $users = User::query()->get()->sortBy('name', SORT_FLAG_CASE | SORT_NATURAL);

        return view('reports')->with([
            'tasks' => $tasks['tasks'],
            'users' => $users,
            'collapseShow' => 'show',
            'oldRequest' => $request,
            'count' => $tasks['count']
        ]);
    }
}
