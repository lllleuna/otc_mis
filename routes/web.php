<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TransportCoopController;
use App\Http\Controllers\ApplicationController;

// Dashboard Route
Route::get('/dashboard', function () {
    if (!auth()->user()) {
        return redirect('auth.login'); // or any other page
    }

    return view('dashboard');
})->middleware('auth');

// Password Update Route
Route::get('/pass-update', function () {
    return view('auth.pass-update');
});

// Transport Cooperative Show Route
Route::get('/tc/show', function () {
    return view('tc.show');
})->middleware('auth');

// Resource Routes for Transport Cooperative and Users
Route::resource('tc', TransportCoopController::class)->middleware('auth');
Route::resource('users', RegisteredUserController::class)->middleware('auth');

// User Password Reset Route
Route::patch('/users/{user}/reset', [RegisteredUserController::class, 'updatePassword']);

// User Search Route
Route::get('/search', [RegisteredUserController::class, 'search']);

// Application Routes
Route::get('application', [ApplicationController::class, 'index']);
Route::get('application/approved', [ApplicationController::class, 'approved']);
Route::get('application/processing', [ApplicationController::class, 'processing'])->name('application.processing');
Route::get('application/{application}', [ApplicationController::class, 'show']);
Route::post('/application/{application}', [ApplicationController::class, 'store']);

// Authentication Routes
Route::get('/', [SessionController::class, 'index'])->name('login');
Route::post('/', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);
