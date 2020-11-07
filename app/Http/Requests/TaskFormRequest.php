<?php

namespace App\Http\Requests;

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
        return [
            'name' => 'required|min:3',
            'user' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "The task name is required.",
            'name.min' => "The task name should be at least 3 characters long.",
            'user.required' => "You should select a user for this task"

        ];
    }
}
