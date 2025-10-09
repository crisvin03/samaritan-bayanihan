<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Bayanihan System</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .gradient-bg {
            background: #524890;
            height: 100vh;
            overflow: hidden;
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
    </style>
</head>
<body class="min-h-screen gradient-bg flex items-center justify-center p-6">
    <div class="w-full max-w-md">
        <!-- Logo -->
        <div class="text-center mb-6">
            <div class="flex items-center justify-center space-x-3 mb-4 floating-animation">
                <div class="w-16 h-16 rounded-2xl overflow-hidden shadow-2xl border-2 border-white/30 bg-white p-1 logo-glow">
                    <img src="{{ asset('images/logo.png') }}" alt="Samaritan Bayanihan Logo" class="w-full h-full object-contain">
                </div>
                <div class="text-left">
                    <span class="text-gradient font-bold text-2xl block">Bayanihan</span>
                    <span class="text-white/80 text-xs font-medium">Community Platform</span>
                </div>
            </div>
            <h1 class="text-3xl font-bold text-gradient mb-2">Welcome Back</h1>
            <p class="text-white/90 text-base font-medium">Sign in to your secure account</p>
        </div>

        <!-- Login Form -->
        <div class="glass-effect rounded-2xl p-6 shadow-2xl">
            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf
                
                @if ($errors->any())
                    <div class="bg-red-500/20 border border-red-500/50 text-red-100 px-4 py-3 rounded-lg">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div>
                    <label for="email" class="block text-white font-semibold mb-2 text-xs uppercase tracking-wide">Email Address</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required 
                           class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/30 text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent input-focus backdrop-blur-sm"
                           placeholder="Enter your email address">
                </div>

                <div>
                    <label for="password" class="block text-white font-semibold mb-2 text-xs uppercase tracking-wide">Password</label>
                    <input type="password" id="password" name="password" required 
                           class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/30 text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent input-focus backdrop-blur-sm"
                           placeholder="Enter your password">
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input type="checkbox" id="remember" name="remember" 
                               class="w-5 h-5 text-blue-400 bg-white/10 border-white/30 rounded focus:ring-blue-400 focus:ring-2">
                        <label for="remember" class="ml-3 text-white font-medium">
                            Remember me
                        </label>
                    </div>
                    <a href="#" class="text-blue-300 hover:text-blue-200 transition-colors font-medium">
                        Forgot password?
                    </a>
                </div>

                <button type="submit" 
                        class="w-full btn-primary text-white font-bold py-3 rounded-xl transition-all duration-300 shadow-lg hover:scale-105">
                    <span class="flex items-center justify-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                        </svg>
                        Sign In
                    </span>
                </button>
            </form>

            <div class="mt-4 text-center">
                <p class="text-white/90 text-sm">
                    Don't have an account? 
                    <a href="{{ route('register') }}" class="text-blue-300 hover:text-blue-200 transition-colors font-semibold">Create one now</a>
                </p>
            </div>
        </div>

    </div>
</body>
</html>
