<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
 | --------------------------------------------
 | Login/Out Routes
 */


Route::get('/login', function () {
    if (!Auth::check()) {
        return view('login');
    } else {
        return redirect()->route('tasks');
    }
})->name('login');


Route::post('/login', [LoginController::class, 'login'])
    ->name('login-submit');

Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');

// --------------------------------------------

Route::get('/', function () {
    return redirect()->route('tasks');
});


Route::get('/tasks', [TaskController::class, 'index'])->name('tasks');
Route::post('/tasks', [TaskController::class, 'store'])->name('store-task');
Route::delete('/tasks', [TaskController::class, 'destroy'])->name('destroy-task');

Route::get('/users', [UserController::class, 'index'])->name('users');
Route::post('/users', [UserController::class, 'store'])->name('store-user');
Route::delete('/users', [UserController::class, 'destroy'])->name('destroy-user');
