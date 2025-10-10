<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\EmailVerificationCode;
use App\Notifications\EmailVerificationNotification;
use App\Notifications\EmailVerificationCodeNotification;
use App\Services\NotificationService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class VerificationController extends Controller
{
    public function showEmailVerification()
    {
        return view('auth.verify-email');
    }

    public function verifyEmail(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
            'email' => 'required|email'
        ]);

        $user = User::where('email', $request->email)
                    ->where('email_verification_token', $request->token)
                    ->where('email_verification_token_expires_at', '>', now())
                    ->first();

        if (!$user) {
            return redirect()->route('register')
                ->with('error', 'Invalid or expired verification link. Please register again.');
        }

        // Update user verification status
        $user->update([
            'email_verified_at' => now(),
            'email_verification_token' => null,
            'email_verification_token_expires_at' => null,
            'verification_status' => 'email_verified'
        ]);

        // Send email verification notification
        $notificationService = new NotificationService();
        $notificationService->createEmailVerificationNotification($user, 'email_verified');

        return redirect()->route('login')
            ->with('success', 'Email verified successfully! You can now log in to your account.');
    }

    public function resendVerification(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user->email_verified_at) {
            return back()->with('info', 'Email is already verified.')
                         ->with('email', $request->email);
        }

        // Check rate limiting (max 3 attempts per hour)
        if ($user->verification_attempts >= 3 && 
            $user->last_verification_attempt && 
            $user->last_verification_attempt->diffInHours(now()) < 1) {
            return back()->with('error', 'Too many verification attempts. Please try again later.')
                         ->with('email', $request->email);
        }

        // Generate new token
        $token = Str::random(64);
        $user->update([
            'email_verification_token' => $token,
            'email_verification_token_expires_at' => now()->addHours(24),
            'verification_attempts' => $user->verification_attempts + 1,
            'last_verification_attempt' => now()
        ]);

        // Send verification email
        $user->notify(new EmailVerificationNotification($token));

        return back()->with('success', 'Verification email sent successfully!')
                     ->with('email', $request->email);
    }

    public function showPhoneVerification()
    {
        $user = auth()->user();
        if (!$user || $user->verification_status !== 'email_verified') {
            return redirect()->route('login');
        }

        return view('auth.verify-phone', compact('user'));
    }

    public function sendPhoneVerification(Request $request)
    {
        $user = auth()->user();
        
        if (!$user || $user->verification_status !== 'email_verified') {
            return redirect()->route('login');
        }

        // Check rate limiting
        if ($user->verification_attempts >= 3 && 
            $user->last_verification_attempt && 
            $user->last_verification_attempt->diffInMinutes(now()) < 60) {
            return back()->with('error', 'Too many verification attempts. Please try again later.');
        }

        // Generate 6-digit verification code
        $code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        
        $user->update([
            'phone_verification_code' => Hash::make($code),
            'phone_verification_code_expires_at' => now()->addMinutes(10),
            'verification_attempts' => $user->verification_attempts + 1,
            'last_verification_attempt' => now()
        ]);

        // TODO: Integrate with SMS service (Twilio, etc.)
        // For now, we'll store the code in session for testing
        session(['phone_verification_code' => $code]);

        return back()->with('success', "Verification code sent to {$user->phone_number}. Code: {$code} (This is for testing only)");
    }

    public function verifyPhone(Request $request)
    {
        $request->validate([
            'verification_code' => 'required|string|size:6'
        ]);

        $user = auth()->user();
        
        if (!$user || !$user->phone_verification_code || 
            $user->phone_verification_code_expires_at < now()) {
            return back()->with('error', 'Invalid or expired verification code.');
        }

        if (!Hash::check($request->verification_code, $user->phone_verification_code)) {
            return back()->with('error', 'Invalid verification code.');
        }

        $user->update([
            'phone_verified' => true,
            'phone_verification_code' => null,
            'phone_verification_code_expires_at' => null,
            'verification_status' => 'phone_verified'
        ]);

        return redirect()->route('member.dashboard')
            ->with('success', 'Phone number verified successfully!');
    }

    public function sendVerificationCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user->email_verified_at) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Email is already verified.']);
            }
            return back()->with('info', 'Email is already verified.');
        }

        // Check rate limiting (max 5 attempts per hour)
        if ($user->verification_attempts >= 5 && 
            $user->last_verification_attempt && 
            $user->last_verification_attempt->diffInHours(now()) < 1) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Too many verification attempts. Please try again later.']);
            }
            return back()->with('error', 'Too many verification attempts. Please try again later.');
        }

        // Create new verification code
        $verificationCode = EmailVerificationCode::createForUser($user->id, 15);

        // Send verification code email
        $user->notify(new EmailVerificationCodeNotification(
            $verificationCode->code, 
            $verificationCode->expires_at
        ));

        // Update user verification attempts
        $user->update([
            'verification_attempts' => $user->verification_attempts + 1,
            'last_verification_attempt' => now()
        ]);

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Verification code sent to your email! Please check your inbox.']);
        }
        return back()->with('success', 'Verification code sent to your email! Please check your inbox.');
    }

    public function verifyEmailCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'code' => 'required|string|size:6'
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user->email_verified_at) {
            return back()->with('info', 'Email is already verified.');
        }

        // Find valid verification code
        $verificationCode = EmailVerificationCode::findValidCode($request->code, $user->id);

        if (!$verificationCode) {
            return back()->with('error', 'Invalid or expired verification code. Please request a new one.');
        }

        // Mark code as used
        $verificationCode->markAsUsed();

        // Update user verification status
        $user->update([
            'email_verified_at' => now(),
            'email_verification_token' => null,
            'email_verification_token_expires_at' => null,
            'verification_status' => 'email_verified',
            'verification_attempts' => 0
        ]);

        // Send email verification notification
        $notificationService = new NotificationService();
        $notificationService->createEmailVerificationNotification($user, 'email_verified');

        return redirect()->route('login')
            ->with('success', 'Email verified successfully! You can now log in to your account.');
    }
}