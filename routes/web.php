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
use App\Http\Controllers\GeneralInfoController;
use App\Http\Controllers\GenerateReportController;
use App\Http\Controllers\DashboardController;


Route::get('/download-cgs/{filename}', function ($filename) {
    $filePath = public_path('storage/certificates/' . $filename);

    if (file_exists($filePath)) {
        return response()->download($filePath);
    } else {
        abort(404, 'File not found');
    }
})->name('download.cgs');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard/charts', [DashboardController::class, 'getChartData'])->middleware(['auth', 'verified']);

Route::get('/landing', [DashboardController::class, 'landing'])->name('landing.page');

// password change requirement for new account
Route::post('/auth/update-password', [RegisteredUserController::class, 'changePassword'])->name('password.update');

// OTP verification routes
Route::get('/otp/verification', [SessionController::class, 'showOTPVerificationForm'])->name('otp.verification.form');
Route::post('/otp/verification', [SessionController::class, 'verifyOTP'])->name('otp.verification');
Route::post('/otp/resend', [SessionController::class, 'resendOTP'])->name('otp.resend');

Route::get('/reset-password', function (Request $request) {
    return view('reset-password', ['request' => $request]);
})->name('reset-password');

// Transport Cooperative Show Route
Route::get('/api/cooperatives', function (Request $request) {
    return GeneralInfo::select(
        'accreditation_no',
        'name',
        'status',
        'accreditation_date',
        'region'
    )->get();
});

Route::get('/cooperatives/{accreditation_no}', [TransportCoopController::class, 'show'])->name('cooperative.details');
Route::get('/cooperative/edit/{accreditation_no}', [TransportCoopController::class, 'edit'])->name('edit.cooperative');


// Resource Routes for Transport Cooperative and Users
Route::resource('tc', TransportCoopController::class)->middleware('auth');
Route::resource('users', RegisteredUserController::class)->middleware('auth');

// For Admin to reset user's password
Route::patch('/users/{user}/reset', [RegisteredUserController::class, 'updatePassword'])->middleware('auth');
Route::patch('/users/{user}', [RegisteredUserController::class, 'update'])->middleware('auth')->name('users.updatepass');

// User Search Route
Route::get('/search', [RegisteredUserController::class, 'search'])->middleware('auth');

// Update the default route to the landing page
Route::get('/', function () {
    return view('landing');
})->name('landing.page');

// Move the login route to a different path
Route::get('/login', [SessionController::class, 'index'])->name('login');
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);

// Email Verification Process
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return route('dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Accreditation Module
Route::get('/application/evaluate', [ApplicationController::class, 'index'])->middleware('auth')->name('accreditation.evaluate.index');
Route::get('/application/approval', [ApplicationController::class, 'showApproval'])->middleware('auth')->name('accreditation.approval.index');
Route::get('/application/evaluate/{id}', [ApplicationController::class, 'evaluate'])->middleware('auth')->name('accreditation.evaluate');
Route::post('/application/evaluate/{id}', [ApplicationController::class, 'storeEvaluation'])->middleware('auth')->name('accreditation.storeEvaluation');
Route::get('/application/approval/{id}', [ApplicationController::class, 'approval'])->middleware('auth')->name('accreditation.approval');
Route::post('/application/approval/{id}', [ApplicationController::class, 'storeApproval'])->middleware('auth')->name('accreditation.storeApproval');

Route::get('/application/release/{id}', [ApplicationController::class, 'release'])->middleware('auth')->name('accreditation.release');
Route::post('/application/release/{id}', [ApplicationController::class, 'storeRelease'])->middleware('auth')->name('accreditation.storeRelease');

Route::get('/applications/{id}/history', [ApplicationController::class, 'showHistory'])->middleware('auth')->name('applications.history');

// Admin Feature
Route::middleware(['auth'])->group(function () {
    Route::get('/backup', [BackupController::class, 'index'])->name('backup.index');
    Route::post('/backup/create', [BackupController::class, 'createBackup'])->name('backup.create');
    Route::get('/backup/download/{fileName}', [BackupController::class, 'downloadBackup'])->name('backup.download');
});

// Route::middleware(['auth'])->group(function () {
//     Route::get('/generate-reports', [ReportController::class, 'index'])->name('reports.generate');
//     Route::post('/generate-reports', [ReportController::class, 'generateReport'])->name('reports.generate.submit');
//     Route::get('/reports/download/{id}', [ReportController::class, 'download'])->name('reports.download');
// });

Route::get('/reports', [GenerateReportController::class, 'index'])->name('report.index');
Route::get('/reports/generate', [GenerateReportController::class, 'generate'])->name('report.generate');

Route::get('/user/profile', function () {
    return view('components.view-profile');
})->middleware('auth')->name('user.profile');

Route::get('/settings', function () {
    return view('components.settings');
})->middleware('auth');


Route::get('/general-info', [GeneralInfoController::class, 'index'])->name('general-info.index');
Route::get('/general-info/{accreditation_no}', [GeneralInfoController::class, 'show'])
    ->where('accreditation_no', '.*')
    ->name('general-info.show');
