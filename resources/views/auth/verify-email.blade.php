<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Verify Email - Samaritan Bayanihan Inc.</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet" />
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .gradient-bg {
            background: #524890;
            min-height: 100vh;
            position: relative;
        }
        .glass-effect {
            backdrop-filter: blur(30px);
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 
                0 32px 64px -12px rgba(0, 0, 0, 0.4),
                0 0 0 1px rgba(255, 255, 255, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
            position: relative;
        }
        .glass-effect::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0.05) 100%);
            border-radius: inherit;
            pointer-events: none;
        }
        .input-focus {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .input-focus:focus {
            transform: translateY(-2px);
            box-shadow: 
                0 20px 25px -5px rgba(0, 0, 0, 0.1), 
                0 10px 10px -5px rgba(0, 0, 0, 0.04),
                0 0 0 3px rgba(59, 130, 246, 0.3);
        }
        .btn-primary {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            box-shadow: 
                0 10px 15px -3px rgba(59, 130, 246, 0.3),
                0 4px 6px -2px rgba(59, 130, 246, 0.1);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
            transform: translateY(-2px);
            box-shadow: 
                0 20px 25px -5px rgba(59, 130, 246, 0.4),
                0 10px 10px -5px rgba(59, 130, 246, 0.2);
        }
        .floating-animation {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        .logo-glow {
            filter: drop-shadow(0 0 20px rgba(59, 130, 246, 0.3));
        }
        .text-gradient {
            background: linear-gradient(135deg, #ffffff 0%, #e0e7ff 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        /* Enhanced text readability */
        .text-white {
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
        }
        
        .text-white\/90 {
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
        }
        
        .text-white\/80 {
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }
        
        /* Enhanced input field readability */
        input[type="email"] {
            color: #ffffff !important;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
        }
        
        input::placeholder {
            color: rgba(255, 255, 255, 0.7) !important;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }
        
        /* Improve label readability */
        label {
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.4);
            font-weight: 600;
        }
        
        /* Enhanced button text readability */
        .btn-primary {
            color: #ffffff !important;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
            font-weight: 700;
            letter-spacing: 0.025em;
        }
        
        .btn-primary:hover {
            color: #ffffff !important;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.4);
        }
    </style>
</head>
<body class="min-h-screen gradient-bg flex items-center justify-center p-6">
    <div class="w-full max-w-lg">
        <!-- Logo -->
        <div class="text-center mb-6">
            <div class="flex items-center justify-center space-x-3 mb-4 floating-animation">
                <div class="w-16 h-16 rounded-2xl overflow-hidden shadow-2xl border-2 border-white/30 bg-white p-1 logo-glow">
                    <img src="{{ asset('images/logo.png') }}" alt="Samaritan Bayanihan Logo" class="w-full h-full object-contain">
                </div>
                <div class="text-left">
                    <span class="text-gradient font-bold text-2xl block">Samaritan</span>
                    <span class="text-white/80 text-xs font-medium">Bayanihan Inc.</span>
                </div>
            </div>
            <h1 class="text-3xl font-bold text-gradient mb-2">Verify Your Email</h1>
            <p class="text-white/90 text-base font-medium">Check your inbox for verification instructions</p>
        </div>

        <!-- Verification Form -->
        <div class="glass-effect rounded-2xl p-6 shadow-2xl">
            @if (session('success'))
                <div class="bg-green-500/20 border border-green-500/50 text-green-100 px-6 py-4 rounded-xl backdrop-blur-sm mb-6" id="successMessage">
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="font-semibold">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-500/20 border border-red-500/50 text-red-100 px-6 py-4 rounded-xl backdrop-blur-sm mb-6">
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="font-semibold">{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            <div class="text-center mb-6">
                <div class="w-16 h-16 bg-yellow-400/20 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-8 h-8 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-white mb-2">Check Your Email</h2>
                <p class="text-purple-100 text-sm">
                    We've sent a verification link to your email address. Click the link in your email to verify your account.
                </p>
            </div>

            <!-- Email Verification Form -->
            <form method="POST" action="{{ route('resend-verification') }}" class="space-y-4">
                @csrf
                
                <div class="relative">
                    <label for="email" class="block text-white font-semibold mb-2 text-xs uppercase tracking-wide">Email Address</label>
                    <div class="relative">
                        <input type="email" id="email" name="email" value="{{ session('email') ?: old('email') }}" required 
                               class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/30 text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent input-focus backdrop-blur-sm @if(session('email')) opacity-75 cursor-not-allowed @endif"
                               placeholder="Enter your email address"
                               @if(session('email')) readonly @endif>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <svg class="w-4 h-4 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <button type="submit" 
                        class="w-full btn-primary text-white font-bold py-3 rounded-xl transition-all duration-300 shadow-lg hover:scale-105 hover:shadow-xl">
                    Resend Verification Link
                </button>
            </form>


            <div class="mt-4 text-center">
                <p class="text-white/90 text-sm" style="text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);">
                    Didn't receive the email? 
                    <a href="{{ route('register') }}" class="text-blue-300 hover:text-blue-200 transition-colors font-semibold" style="text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);">Try registering again</a>
                </p>
            </div>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-dismiss success message after 4 seconds
            const successMessage = document.getElementById('successMessage');
            if (successMessage) {
                setTimeout(function() {
                    successMessage.style.transition = 'opacity 0.5s ease-out';
                    successMessage.style.opacity = '0';
                    setTimeout(function() {
                        successMessage.remove();
                    }, 500);
                }, 4000);
            }
            
            // Simple form validation
            const emailInput = document.getElementById('email');
            const submitBtn = document.querySelector('button[type="submit"]');
            
            // Auto-focus on email input
            emailInput.focus();
            
            // Form submission with loading state
            const form = document.querySelector('form');
            form.addEventListener('submit', function() {
                submitBtn.disabled = true;
                submitBtn.textContent = 'Sending...';
                submitBtn.classList.add('opacity-50');
            });
        });
    </script>
</body>
</html>
