<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class TaskFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //5 minutes tolerance to due date
        $now = Carbon::now()->subMinutes(5);

        return [
            'name' => 'required|min:3',
            'user' => 'required',
            'dueDate' => "required|date|after_or_equal:$now"
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "The task name is required.",
            'name.min' => "The task name should be at least 3 characters long.",
            'dueDate.required' => 'The task due date is required.',
            'dueDate.date' => 'Invalid date format', 
            'dueDate.after_or_equal' => "The due date can't be earlier than today/now.",
            'user.required' => "You should select a user for this task."

        ];
    }
}
