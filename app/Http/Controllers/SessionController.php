<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Vonage\Client;
use Vonage\Client\Credentials\Basic;
use Vonage\SMS\Message\SMS;

class SessionController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            // Generate and send OTP
            $user = Auth::user();
            $otp = $this->generateOTP();
            
            // Store OTP in cache for verification
            Cache::put('otp_' . $user->id, $otp, now()->addMinutes(5));
            
            // Send OTP via Vonage
            $this->sendOTP($user->mobile_number, $otp);
            
            // Store user ID in session for OTP verification
            Session::put('auth_user_id', $user->id);
            
            // Logout user until OTP is verified
            Auth::logout();
            
            return redirect()->route('otp.verification.form');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function showOTPVerificationForm()
    {
        if (!Session::has('auth_user_id')) {
            return redirect()->route('login');
        }

        return view('auth.otp-verification');
    }

    /**
     * Verify OTP
     */
    public function verifyOTP(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric|digits:6',
        ]);

        $userId = Session::get('auth_user_id');
        
        if (!$userId) {
            return redirect()->route('login');
        }

        $storedOTP = Cache::get('otp_' . $userId);
        
        if ($storedOTP == $request->otp) {
            // OTP is valid, log the user in
            Auth::loginUsingId($userId);
            
            // Clear session and cache
            Session::forget('auth_user_id');
            Cache::forget('otp_' . $userId);
            
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'otp' => 'The OTP you entered is invalid.',
        ]);
    }

    /**
     * Resend OTP
     */
    public function resendOTP()
    {
        $userId = Session::get('auth_user_id');
        
        if (!$userId) {
            return redirect()->route('login');
        }

        $user = User::find($userId);
        
        if (!$user) {
            return redirect()->route('login');
        }

        // Generate new OTP
        $otp = $this->generateOTP();
        
        // Store OTP in cache for verification
        Cache::put('otp_' . $userId, $otp, now()->addMinutes(5));
        
        // Send OTP via Vonage
        $this->sendOTP($user->mobile_number, $otp);
        
        return back()->with('status', 'A new OTP has been sent to your mobile number.');
    }

    /**
     * Generate a 6-digit OTP
     */
    private function generateOTP()
    {
        return str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
    }

    /**
     * Send OTP via Vonage
     */
    private function sendOTP($mobileNumber, $otp)
    {
        $basic = new Basic(config('services.vonage.key'), config('services.vonage.secret'));
        $client = new Client($basic);

        $response = $client->sms()->send(
            new SMS($mobileNumber, config('app.name'), "Your OTP is: {$otp}. Valid for 5 minutes.")
        );
    }

    public function destroy()
    {
        Auth::logout();

        return redirect()->route('landing.page');
    }
}
