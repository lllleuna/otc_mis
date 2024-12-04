<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TransportCoopController;
use App\Http\Controllers\ApplicationController;


Route::get('/dashboard', function () {
    if (!auth()->user()) {
        return redirect('auth.login'); // or any other page
    }

    return view('dashboard');
})->middleware('auth');

Route::resource('tc', TransportCoopController::class)->middleware('auth');

Route::resource('users', RegisteredUserController::class)->middleware('auth');
Route::patch('/users/{user}/reset', [RegisteredUserController::class, 'updatePassword']);
Route::get('/search', [RegisteredUserController::class, 'search']);

Route::get('application', [ApplicationController::class, 'index']);
Route::get('application/approved', function () {
    return view('application/approved');
});

Route::get('/', [SessionController::class, 'index'])->name('login');
Route::post('/', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);


