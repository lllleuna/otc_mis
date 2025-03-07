<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TransportCoopController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\BackupController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

// Dashboard Route
Route::get('/dashboard', function () {
    $user = auth()->user();
    
    if (!$user) {
        return redirect()->route('auth.login'); // Redirect to login if not authenticated
    }

    if (!$user->password_changed) {
        return view('auth.update-password'); // Redirect to password change page
    }

    return view('dashboard');
})->middleware(['auth', 'verified']);

// password change requirement for new account
Route::post('/auth/update-password', [RegisteredUserController::class, 'changePassword'])->name('password.update');

// Transport Cooperative Show Route
Route::get('/tc/show', function () {
    return view('tc.show');
})->middleware('auth');

Route::get('/edit-cooperative', function () {
    return view('components.edit-content');
})->name('edit.cooperative');

// Resource Routes for Transport Cooperative and Users
Route::resource('tc', TransportCoopController::class)->middleware('auth');
Route::resource('users', RegisteredUserController::class)->middleware('auth');

// For Admin to reset user's password
Route::patch('/users/{user}/reset', [RegisteredUserController::class, 'updatePassword']);

// User Search Route
Route::get('/search', [RegisteredUserController::class, 'search']);

// Route::get('application', [ApplicationController::class, 'index']);
// Route::get('application/approved', [ApplicationController::class, 'approved']);
// Route::get('application/{application}', [ApplicationController::class, 'show']);
// Route::post('/application/{application}', [ApplicationController::class, 'store']);

// Authentication Routes
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
Route::get('/accreditation/approval/{id}', [ApplicationController::class, 'approval'])->name('accreditation.approval');
Route::post('/accreditation/approval/{id}', [ApplicationController::class, 'storeApproval'])->name('accreditation.storeApproval');

// Admin Feature
Route::middleware(['auth'])->group(function () {
    Route::get('/backup', [BackupController::class, 'index'])->name('backup.index');
    Route::post('/backup/create', [BackupController::class, 'createBackup'])->name('backup.create');
    Route::get('/backup/download/{fileName}', [BackupController::class, 'downloadBackup'])->name('backup.download');
});