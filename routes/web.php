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
use App\Http\Controllers\ReportController;

// Secure CGS Download Route
Route::get('/download-cgs/{filename}', function ($filename) {
    $filePath = public_path('storage/certificates/' . $filename);

    if (!auth()->check()) {
        return redirect()->route('login');
    }

    if (file_exists($filePath)) {
        return response()->download($filePath);
    } else {
        abort(404, 'File not found');
    }
})->middleware('auth')->name('download.cgs');

// Secure Dashboard Route
Route::get('/dashboard', function () {
    $user = auth()->user();

    if (!$user->password_changed) {
        return view('auth.update-password');
    }

    return ($user->role === 'Admin') ? view('dashboard') : view('tc.index');

})->middleware(['auth', 'verified'])->name('dashboard');

// Protect API Cooperatives Endpoint
Route::get('/api/cooperatives', function (Request $request) {
    return GeneralInfo::select('accreditation_no', 'name', 'status', 'accreditation_date', 'region')->get();
})->middleware('auth');

// Protect Routes for Cooperative Details
Route::get('/cooperatives/{accreditation_no}', [TransportCoopController::class, 'show'])
    ->middleware('auth')
    ->name('cooperative.details');

Route::get('/cooperative/edit/{accreditation_no}', [TransportCoopController::class, 'edit'])
    ->middleware('auth')
    ->name('edit.cooperative');

// Secure Other Routes with Authentication Middleware
Route::middleware(['auth'])->group(function () {
    Route::resource('tc', TransportCoopController::class);
    Route::resource('users', RegisteredUserController::class);

    Route::patch('/users/{user}/reset', [RegisteredUserController::class, 'updatePassword']);
    Route::patch('/users/{user}', [RegisteredUserController::class, 'update'])->name('users.updatepass');

    Route::get('/search', [RegisteredUserController::class, 'search']);

    // Admin Feature (Backup)
    Route::get('/backup', [BackupController::class, 'index'])->name('backup.index');
    Route::post('/backup/create', [BackupController::class, 'createBackup'])->name('backup.create');
    Route::get('/backup/download/{fileName}', [BackupController::class, 'downloadBackup'])->name('backup.download');

    // Report Generation
    Route::get('/generate-reports', [ReportController::class, 'index'])->name('reports.generate');
    Route::post('/generate-reports', [ReportController::class, 'generateReport'])->name('reports.generate.submit');
    Route::get('/reports/download/{id}', [ReportController::class, 'download'])->name('reports.download');

    // User Profile & Settings
    Route::get('/user/profile', function () {
        return view('components.view-profile');
    })->name('user.profile');

    Route::get('/settings', function () {
        return view('components.settings');
    });
});

// Authentication Routes
Route::get('/', [SessionController::class, 'index'])->name('login');
Route::post('/', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);

// OTP Verification Routes
Route::get('/otp/verification', [SessionController::class, 'showOTPVerificationForm'])->name('otp.verification.form');
Route::post('/otp/verification', [SessionController::class, 'verifyOTP'])->name('otp.verification');
Route::post('/otp/resend', [SessionController::class, 'resendOTP'])->name('otp.resend');

// Email Verification Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/dashboard');
    })->middleware('signed')->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    })->middleware('throttle:6,1')->name('verification.send');
});

// Accreditation Module (Protected)
Route::middleware(['auth'])->group(function () {
    Route::get('/application/evaluate', [ApplicationController::class, 'index'])->name('accreditation.evaluate.index');
    Route::get('/application/approval', [ApplicationController::class, 'showApproval'])->name('accreditation.approval.index');
    Route::get('/application/evaluate/{id}', [ApplicationController::class, 'evaluate'])->name('accreditation.evaluate');
    Route::post('/application/evaluate/{id}', [ApplicationController::class, 'storeEvaluation'])->name('accreditation.storeEvaluation');
    Route::get('/application/approval/{id}', [ApplicationController::class, 'approval'])->name('accreditation.approval');
    Route::post('/application/approval/{id}', [ApplicationController::class, 'storeApproval'])->name('accreditation.storeApproval');

    Route::get('/application/release/{id}', [ApplicationController::class, 'release'])->name('accreditation.release');
    Route::post('/application/release/{id}', [ApplicationController::class, 'storeRelease'])->name('accreditation.storeRelease');

    Route::get('/applications/{id}/history', [ApplicationController::class, 'showHistory'])->name('applications.history');
});
