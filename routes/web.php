<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('users',\App\Http\Controllers\UserController::class)->except('update');
Route::post('users/{id}',[\App\Http\Controllers\UserController::class,'update']);
