<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/', [SessionController::class, 'create']);
Route::post('/', [SessionController::class, 'store']);

Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);

