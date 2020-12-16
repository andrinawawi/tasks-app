<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserFormRequest;
use App\Models\User;
use App\Services\DeleteUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::query()->orderBy('name')->get();

        return view('users', compact('users'));
    }

    public function store(UserFormRequest $request)
    {

        $user = User::create([
            'name' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'isAdminUser' => (bool) $request->isAdmin
        ]);

        return redirect()->route('users')
            ->with("added", "User: '$user->name' added successfully.");
    }

    public function destroy(Request $request)
    {
        $user = User::where('id', $request->id)
            ->first();

        DeleteUser::delete($request->id);

        return redirect()->route('users')
            ->with("deleted", "User: '$user->name' deleted successfully.");;
    }
}
