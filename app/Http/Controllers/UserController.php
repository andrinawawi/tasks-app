<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserFormRequest;
use App\Models\User;
use App\Services\DeleteUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
            ->with("user-added", "User: '$user->name' added successfully.");
    }

    public function update(Request $request)
    {
        $rules = [
            'updName' => "required|min:3|max:40|alpha_dash|unique:users,name,$request->id",
            'updEmail' => "required|email|unique:users,email,$request->id",
        ];

        $messages =  [
            'updName.unique' => 'The username is already taken',
            'updName.min' => 'The username should be at least 3 characters long.',
            'updName.max' => 'The username shout not have more than 40 characters.',
            'updName.required' => 'The username is required.',
            'updName.alpha_dash' => "The username can't have special characters or blank spaces.",
            'updEmail.required' => 'The email is required',
            'updEmail.unique' => 'The email is already taken'
        ];

        if ($request->updPwd) {
            $rules['updPwd'] = 'min:6';
            $messages['updPwd.min'] = 'The password should be at least 6 charcaters long';
        }

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->with('update-failed', true)
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::find($request->id);

        $oldUserName = $user->name;

        $user->name = $request->updName;
        $user->email = $request->updEmail;
        $user->isAdminUser = (bool) $request->updAdmin;

        if ($request->updPwd) {
            $user->password = Hash::make($request->updPwd);
        }

        $user->save();

        return redirect()
            ->route('users')
            ->with('user-updated', "User '$oldUserName' updated successfully.");
    }

    public function destroy(Request $request)
    {
        $user = User::where('id', $request->id)
            ->first();

        DeleteUser::delete($request->id);

        return redirect()->route('users')
            ->with("user-deleted", "User: '$user->name' deleted successfully.");;
    }
}
