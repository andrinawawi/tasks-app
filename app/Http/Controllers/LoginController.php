<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if(! Auth::attempt($request->only('email', 'password')) ){
            return redirect()
            ->back()
            ->withErrors('Invalid email or password.')
            ->withInput();
        }

        $username = Auth::user()->name;

        return redirect()->route('tasks')->with(['added' => "Welcome, $username!"]);
    }
}
