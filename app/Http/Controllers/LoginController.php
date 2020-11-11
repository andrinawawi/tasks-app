<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // If input was not an email, try to authenticate using username
        if (filter_var($request->login, FILTER_VALIDATE_EMAIL)) {
            Auth::attempt([
                'email' => $request->login,
                'password' => $request->password
            ]);
        } else {
            Auth::attempt([
                'name' => $request->login,
                'password' => $request->password
            ]);
        }

        // If Auth == True return to Tasks Page
        if (Auth::check()) {

            $username = Auth::user()->name;

            return redirect()
                ->route('tasks')
                ->with("successful-login", "Welcome, $username!");
        }

        // If Auth everything fails...
        return redirect()
            ->back()
            ->with("failed-login","Invalid Password or Username/Email")
            ->withInput();
    }
}
