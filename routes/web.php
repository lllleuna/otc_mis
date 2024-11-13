<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::resource('users', RegisteredUserController::class);


Route::get('/', [SessionController::class, 'create']);
Route::post('/', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);


