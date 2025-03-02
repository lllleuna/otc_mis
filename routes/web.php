<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TransportCoopController;
use App\Http\Controllers\ApplicationController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;


Route::get('/dashboard', function () {
    if (!auth()->user()) {
        return redirect('auth.login'); // or any other page
    }

    return view('dashboard');
})->middleware(['auth', 'verified']);

Route::get('/pass-update', function () {
    return view('auth.pass-update');
});


Route::resource('tc', TransportCoopController::class)->middleware('auth');

Route::resource('users', RegisteredUserController::class)->middleware('auth');
Route::patch('/users/{user}/reset', [RegisteredUserController::class, 'updatePassword']);
Route::get('/search', [RegisteredUserController::class, 'search']);

// Route::get('application', [ApplicationController::class, 'index']);
// Route::get('application/approved', [ApplicationController::class, 'approved']);
// Route::get('application/{application}', [ApplicationController::class, 'show']);
// Route::post('/application/{application}', [ApplicationController::class, 'store']);

Route::get('/', [SessionController::class, 'index'])->name('login');
Route::post('/', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);

// Email Verification Process
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');
 
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');
 
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Accreditation Module
Route::get('/accreditation', [ApplicationController::class, 'index'])->name('accreditation.index');
Route::get('/accreditation/evaluate/{id}', [ApplicationController::class, 'evaluate'])->name('accreditation.evaluate');
Route::post('/accreditation/evaluate/{id}', [ApplicationController::class, 'storeEvaluation'])->name('accreditation.storeEvaluation');