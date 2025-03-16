<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TransportCoopController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\BackupController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Models\GeneralInfo;

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
})->middleware(['auth', 'verified'])->name('dashboard');

// password change requirement for new account
Route::post('/auth/update-password', [RegisteredUserController::class, 'changePassword'])->name('password.update');

// OTP verification routes
Route::get('/otp/verification', [SessionController::class, 'showOTPVerificationForm'])->name('otp.verification.form');
Route::post('/otp/verification', [SessionController::class, 'verifyOTP'])->name('otp.verification');
Route::post('/otp/resend', [SessionController::class, 'resendOTP'])->name('otp.resend');

// Transport Cooperative Show Route
Route::get('/api/cooperatives', function (Request $request) {
    return GeneralInfo::select(
        'accreditation_no',
        'name',
        'common_bond_membership',
        'accreditation_date',
        'region'
    )->get();
});

Route::get('/cooperatives/{accreditation_no}', [TransportCoopController::class, 'show'])->name('cooperative.details');
Route::get('/cooperative/edit/{accreditation_no}', [TransportCoopController::class, 'edit'])->name('edit.cooperative');



// Route::get('/tc/show', function () {
//     return view('tc.show');
// })->middleware('auth');


// Resource Routes for Transport Cooperative and Users
Route::resource('tc', TransportCoopController::class)->middleware('auth');
Route::resource('users', RegisteredUserController::class)->middleware('auth');

// For Admin to reset user's password
Route::patch('/users/{user}/reset', [RegisteredUserController::class, 'updatePassword']);
Route::patch('/users/{user}', [RegisteredUserController::class, 'update'])->name('users.update');

// User Search Route
Route::get('/search', [RegisteredUserController::class, 'search']);

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
 
    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');
 
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Accreditation Module
Route::get('/application/evaluate', [ApplicationController::class, 'index'])->name('accreditation.evaluate.index');
Route::get('/application/approval', [ApplicationController::class, 'showApproval'])->name('accreditation.approval.index');
Route::get('/application/evaluate/{id}', [ApplicationController::class, 'evaluate'])->name('accreditation.evaluate');
Route::post('/application/evaluate/{id}', [ApplicationController::class, 'storeEvaluation'])->name('accreditation.storeEvaluation');
Route::get('/application/approval/{id}', [ApplicationController::class, 'approval'])->name('accreditation.approval');
Route::post('/application/approval/{id}', [ApplicationController::class, 'storeApproval'])->name('accreditation.storeApproval');

// Admin Feature
Route::middleware(['auth'])->group(function () {
    Route::get('/backup', [BackupController::class, 'index'])->name('backup.index');
    Route::post('/backup/create', [BackupController::class, 'createBackup'])->name('backup.create');
    Route::get('/backup/download/{fileName}', [BackupController::class, 'downloadBackup'])->name('backup.download');
});