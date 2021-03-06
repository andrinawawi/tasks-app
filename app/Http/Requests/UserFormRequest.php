<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserFormRequest extends FormRequest
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
            'username' => 'required|min:3|max:40|alpha_dash|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ];
    }

    public function messages()
    {
        return [
            'username.min' => 'The username should be at least 3 characters long.',
            'username.max' => 'The username shout not have more than 40 characters.',
            'username.required' => 'The username is required.',
            'username.alpha_dash' => "The username can't have special characters or blank spaces.",
            'email.required' => 'The email is required',
            'password.required' => 'The password is required.'
        ];
    }
}
