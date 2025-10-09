<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showLoginSelect()
    {
        return view('auth.login-select');
    }

    public function showAdminLogin()
    {
        return view('auth.admin-login');
    }

    public function showTreasurerLogin()
    {
        return view('auth.treasurer-login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        throw ValidationException::withMessages([
            'email' => ['The provided credentials do not match our records.'],
        ]);
    }

    public function adminLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            
            // Check if user is admin
            if (!$user->isAdmin()) {
                Auth::logout();
                throw ValidationException::withMessages([
                    'email' => ['Access denied. Admin privileges required.'],
                ]);
            }

            $request->session()->regenerate();
            return redirect()->intended('/admin/dashboard');
        }

        throw ValidationException::withMessages([
            'email' => ['The provided credentials do not match our records.'],
        ]);
    }

    public function treasurerLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            
            // Check if user is barangay treasurer
            if (!$user->isBarangayTreasurer()) {
                Auth::logout();
                throw ValidationException::withMessages([
                    'email' => ['Access denied. Treasurer privileges required.'],
                ]);
            }

            $request->session()->regenerate();
            return redirect()->intended('/treasurer/dashboard');
        }

        throw ValidationException::withMessages([
            'email' => ['The provided credentials do not match our records.'],
        ]);
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Rate limiting check
        $ip = $request->ip();
        $userAgent = $request->userAgent();
        
        // Check for suspicious activity
        $recentRegistrations = User::where('ip_address', $ip)
            ->where('created_at', '>', now()->subHours(24))
            ->count();
            
        if ($recentRegistrations >= 3) {
            return back()->with('error', 'Too many registration attempts from this IP. Please try again later.');
        }

        $request->validate([
            'name' => 'required|string|max:255|min:2',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]/',
            'phone_number' => 'required|string|regex:/^\+63\s[0-9]{3}\s[0-9]{3}\s[0-9]{4}$/',
            'address' => 'nullable|string|max:500',
            'birth_date' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'occupation' => 'nullable|string|max:255',
            'barangay' => 'required|string|max:255',
            'terms' => 'required|accepted',
            'g-recaptcha-response' => 'required'
        ], [
            'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
            'phone_number.regex' => 'Please enter a valid Philippine phone number in format: +63 912 345 6789',
            'terms.accepted' => 'You must agree to the Terms of Service and Privacy Policy.',
            'g-recaptcha-response.required' => 'Please complete the reCAPTCHA verification.'
        ]);

        // Verify reCAPTCHA
        $recaptchaResponse = $request->input('g-recaptcha-response');
        $secretKey = config('services.recaptcha.secret_key');
        
        $recaptchaUrl = 'https://www.google.com/recaptcha/api/siteverify';
        $recaptchaData = [
            'secret' => $secretKey,
            'response' => $recaptchaResponse,
            'remoteip' => $request->ip()
        ];
        
        $options = [
            'http' => [
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($recaptchaData)
            ]
        ];
        
        $context = stream_context_create($options);
        $result = file_get_contents($recaptchaUrl, false, $context);
        $resultJson = json_decode($result, true);
        
        if (!$resultJson['success']) {
            return back()->with('error', 'reCAPTCHA verification failed. Please try again.');
        }

        // Get the member role
        $memberRole = \App\Models\Role::getByName('member');

        // Generate email verification token
        $emailToken = \Illuminate\Support\Str::random(64);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $memberRole->id,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'birth_date' => $request->birth_date,
            'gender' => $request->gender,
            'occupation' => $request->occupation,
            'barangay' => $request->barangay,
            'status' => 'pending_verification', // Changed from 'active'
            'email_verification_token' => $emailToken,
            'email_verification_token_expires_at' => now()->addHours(24),
            'ip_address' => $ip,
            'user_agent' => $userAgent,
            'verification_status' => 'pending'
        ]);


        // Send email verification link
        $user->notify(new \App\Notifications\EmailVerificationNotification($emailToken));

        return redirect()->route('verify-email')
            ->with('success', 'Registration successful! A verification link has been sent to your email.')
            ->with('email', $request->email);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}