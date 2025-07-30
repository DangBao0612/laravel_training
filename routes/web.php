<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return ('Hello World from Laravel');
});

/* resource của Laravel tự động sinh 7 route REST chỉ trong 1 dòng, ko cần phải tọa thủ công */

//Route::resource('user', UserController::class)->names('user');     

//Route::resource('task', TaskController::class)->names('task');

/* ---------Route của user----------*/
// index
Route::get('/user', [UserController::class, 'index'])
    ->name('user.index');

// create form
Route::get('/user/create', [UserController::class, 'create'])
    ->name('user.create');

// store
Route::post('/user', [UserController::class, 'store'])
    ->name('user.store');

// show single user
Route::get('/user/{user}', [UserController::class, 'show'])
    ->name('user.show');

// edit form
Route::get('/user/{user}/edit', [UserController::class, 'edit'])
    ->name('user.edit');

// update
Route::put('/user/{user}', [UserController::class, 'update'])
    ->name('user.update');

// destroy
Route::delete('/user/{user}', [UserController::class, 'destroy'])
    ->name('user.destroy');

/*-------Route của task-------*/
// index
Route::get('/task', [TaskController::class, 'index'])
    ->name('task.index');

// create form
Route::get('/task/create', [TaskController::class, 'create'])
    ->name('task.create');

// store
Route::post('/task', [TaskController::class, 'store'])
    ->name('task.store');

// show single task
Route::get('/task/{task}', [TaskController::class, 'show'])
    ->name('task.show');

// edit form
Route::get('/task/{task}/edit', [TaskController::class, 'edit'])
    ->name('task.edit');

// update
Route::put('/task/{task}', [TaskController::class, 'update'])
    ->name('task.update');

// destroy
Route::delete('/task/{task}', [TaskController::class, 'destroy'])
    ->name('task.destroy');

