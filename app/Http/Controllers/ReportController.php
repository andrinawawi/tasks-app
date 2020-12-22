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
        $rules = [
            'dueDateFrom' => [Rule::requiredIf($request->dueDateUntil)],
            'dueDateUntil' => [Rule::requiredIf($request->dueDateFrom)],
            'finishingDateFrom' => [Rule::requiredIf($request->finishingDateUntil)],
            'finishingDateUntil' => [Rule::requiredIf($request->finishingDateFrom)]
        ];

        if ($request->dueDateUntil && $request->dueDateFrom) {
            array_push($rules['dueDateUntil'], "after_or_equal:$request->dueDateFrom");
        }

        if ($request->finishingDateUntil && $request->finishingDateFrom) {
            array_push($rules['finishingDateUntil'], "after_or_equal:$request->finishingDateFrom");
        }


        $messages = [
            'dueDateFrom.required' => 'Please, inform the whole due date period (From / Until).',
            'dueDateUntil.required' => 'Please, inform the whole due date period (From / Until).',
            'finishingDateFrom.required' => 'Please, inform the whole finishing period (From / Until).',
            'finishingDateUntil.required' => 'Please, inform the whole finishing period (From / Until).',
            'dueDateUntil.after_or_equal' => "The due date's last period can't be earlier than the first!",
            'finishingDateUntil.after_or_equal' => "The finishing date's last period can't be earlier than the first!",
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->with('collapseShow', 'show')
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
