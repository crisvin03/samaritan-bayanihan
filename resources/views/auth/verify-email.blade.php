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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        .glass-effect {
            backdrop-filter: blur(20px);
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
    </style>
</head>
<body class="min-h-screen gradient-bg flex items-center justify-center p-6">
    <div class="w-full max-w-lg">
        <!-- Logo -->
        <div class="text-center mb-10">
            <div class="flex items-center justify-center space-x-3 mb-6">
                <div class="w-16 h-16 rounded-xl overflow-hidden shadow-xl border-2 border-white/20 bg-white p-1">
                    <img src="{{ asset('images/logo.png') }}" alt="Bayanihan Logo" class="w-full h-full object-contain">
                </div>
                <div class="text-left">
                    <span class="text-white font-bold text-2xl block">Samaritan</span>
                    <span class="text-yellow-300 font-semibold text-sm">Bayanihan Inc.</span>
                </div>
            </div>
            <h1 class="text-4xl font-bold text-white mb-3">Verify Your Email</h1>
            <p class="text-purple-100 text-lg">Check your inbox for verification instructions</p>
        </div>

        <!-- Verification Form -->
        <div class="glass-effect rounded-3xl p-10 shadow-2xl">
            @if (session('success'))
                <div class="bg-green-500/20 border border-green-500/50 text-green-100 px-6 py-4 rounded-xl backdrop-blur-sm mb-6">
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

            <div class="text-center mb-8">
                <div class="w-20 h-20 bg-yellow-400/20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-white mb-2">Check Your Email</h2>
                <p class="text-purple-100 leading-relaxed">
                    We've sent a verification link to your email address. Please check your inbox and click the verification link to activate your account.
                </p>
            </div>

            <!-- Resend Verification Form -->
            <form method="POST" action="{{ route('resend-verification') }}" class="space-y-6">
                @csrf
                
                <div class="relative">
                    <label for="email" class="block text-white font-semibold mb-3 text-sm uppercase tracking-wide">Email Address</label>
                    <div class="relative">
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required 
                               class="w-full px-5 py-4 rounded-xl bg-white/10 border border-white/30 text-white placeholder-purple-200 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent backdrop-blur-sm"
                               placeholder="Enter your email address">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <svg class="w-5 h-5 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <button type="submit" 
                        class="w-full bg-gradient-to-r from-yellow-400 to-yellow-500 hover:from-yellow-500 hover:to-yellow-600 text-purple-900 font-bold py-4 rounded-xl transition-all duration-300 shadow-lg hover:scale-105 hover:shadow-xl">
                    Resend Verification Email
                </button>
            </form>

            <div class="mt-8 text-center">
                <p class="text-purple-100 text-lg">
                    Didn't receive the email? 
                    <a href="{{ route('register') }}" class="text-yellow-300 hover:underline font-semibold">Try registering again</a>
                </p>
            </div>
        </div>

        <!-- Back to Home -->
        <div class="text-center mt-8">
            <a href="/" class="text-white hover:text-yellow-300 transition-colors font-medium">
                ← Back to Home
            </a>
        </div>
    </div>
</body>
</html>
