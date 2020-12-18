<?php

use App\Http\Controllers\{LoginController, TaskController, UserController, ReportController};
use Illuminate\Support\Facades\{Auth, Route};

/*
 | --------------------------------------------
 | Login/Out Routes
 | --------------------------------------------
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
Route::get('/tasks/search', [TaskController::class, 'search'])->name('search-task');
Route::post('/tasks', [TaskController::class, 'store'])->name('store-task');
Route::delete('/tasks', [TaskController::class, 'destroy'])->name('destroy-task');
Route::patch('/tasks', [TaskController::class, 'update'])->name('update-task');
Route::put('/tasks', [TaskController::class, 'finish'])->name('finish-task');

Route::get('/reports', [ReportController::class, 'index'])->name('reports');
Route::get('/reports/filter', [ReportController::class, 'filter'])->name('filter-report');

Route::get('/users', [UserController::class, 'index'])->name('users');
Route::post('/users', [UserController::class, 'store'])->name('store-user');
Route::delete('/users', [UserController::class, 'destroy'])->name('destroy-user');
Route::patch('/users', [USerController::class, 'update'])->name('update-user');
