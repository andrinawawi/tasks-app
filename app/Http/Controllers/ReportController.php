<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Services\FilterReport;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
        $validator = Validator::make($request->all(), [
            'dueDateFrom' => Rule::requiredIf($request->dueDateUntil),
            'dueDateUntil' => Rule::requiredIf($request->dueDateFrom),
            'finishingDateFrom' => Rule::requiredIf($request->finishingDateUntil),
            'finishingDateUntil' => Rule::requiredIf($request->finishingDateFrom)
        ]);

        if($validator->fails()){
            return redirect()
                ->back()
                ->withErrors($validator)
                ->with('filter-failed', true)
                ->withInput();
        }

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
