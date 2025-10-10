<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login - Samaritan Bayanihan Inc.</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet" />
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Security Headers -->
    <meta http-equiv="X-Content-Type-Options" content="nosniff">
    <meta http-equiv="X-Frame-Options" content="DENY">
    <meta http-equiv="X-XSS-Protection" content="1; mode=block">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .admin-gradient-bg {
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 25%, #3b82f6 50%, #1d4ed8 75%, #1e3a8a 100%);
            min-height: 100vh;
        }
        .glass-effect {
            backdrop-filter: blur(20px);
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        .input-focus {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .input-focus:focus {
            transform: translateY(-2px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .admin-shield {
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .floating-animation {
            animation: float 3s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        .pulse-glow {
            animation: pulse-glow 2s ease-in-out infinite alternate;
        }
        @keyframes pulse-glow {
            from { box-shadow: 0 0 20px rgba(251, 191, 36, 0.3); }
            to { box-shadow: 0 0 30px rgba(251, 191, 36, 0.6); }
        }
    </style>
</head>
<body class="min-h-screen admin-gradient-bg flex items-center justify-center p-6">
    <div class="w-full max-w-md">
        <!-- Logo and Header -->
        <div class="text-center mb-10">
            <div class="flex items-center justify-center space-x-3 mb-6">
                <div class="w-16 h-16 rounded-xl overflow-hidden shadow-xl border-2 border-white/20 bg-white p-1 floating-animation">
                    <img src="{{ asset('images/logo.png') }}" alt="Bayanihan Logo" class="w-full h-full object-contain">
                </div>
                <div class="text-left">
                    <span class="text-white font-bold text-2xl block">Samaritan</span>
                    <span class="text-yellow-300 font-semibold text-sm">Bayanihan Inc.</span>
                </div>
            </div>
            
            <!-- Admin Badge -->
            <div class="inline-flex items-center space-x-2 bg-yellow-400/20 border border-yellow-400/30 rounded-full px-4 py-2 mb-4 backdrop-blur-sm">
                <svg class="w-5 h-5 text-yellow-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                </svg>
                <span class="text-yellow-300 font-semibold text-sm uppercase tracking-wide">Administrator Access</span>
            </div>
            
            <h1 class="text-4xl font-bold text-white mb-3">Admin Portal</h1>
            <p class="text-blue-100 text-lg">Secure administrative access</p>
        </div>

        <!-- Login Form -->
        <div class="glass-effect rounded-3xl p-10 shadow-2xl">
            <form method="POST" action="{{ route('admin.login') }}" class="space-y-7" id="adminLoginForm" novalidate>
                @csrf
                
                @if ($errors->any())
                    <div class="bg-red-500/20 border border-red-500/50 text-red-100 px-6 py-4 rounded-xl backdrop-blur-sm">
                        <div class="flex items-center space-x-2 mb-2">
                            <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="font-semibold">Authentication Failed</span>
                        </div>
                        <ul class="list-disc list-inside space-y-1 text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Email Address -->
                <div class="relative">
                    <label for="email" class="block text-white font-semibold mb-3 text-sm uppercase tracking-wide">Admin Email</label>
                    <div class="relative">
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required 
                               class="w-full px-5 py-4 rounded-xl bg-white/10 border border-white/30 text-white placeholder-blue-200 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent input-focus backdrop-blur-sm"
                               placeholder="admin@bayanihan.com"
                               maxlength="255" autocomplete="email">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <svg class="w-5 h-5 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Password -->
                <div class="relative">
                    <label for="password" class="block text-white font-semibold mb-3 text-sm uppercase tracking-wide">Password</label>
                    <div class="relative">
                        <input type="password" id="password" name="password" required 
                               class="w-full px-5 py-4 rounded-xl bg-white/10 border border-white/30 text-white placeholder-blue-200 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent input-focus backdrop-blur-sm"
                               placeholder="Enter your admin password"
                               minlength="8" maxlength="128" autocomplete="current-password">
                        <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <svg class="w-5 h-5 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input type="checkbox" id="remember" name="remember" 
                               class="w-4 h-4 text-yellow-400 bg-white/10 border-white/20 rounded focus:ring-yellow-400 focus:ring-2">
                        <label for="remember" class="ml-2 text-sm text-blue-100">
                            Remember me
                        </label>
                    </div>
                    <a href="#" class="text-sm text-yellow-300 hover:underline">
                        Forgot password?
                    </a>
                </div>

                <!-- Submit Button -->
                <button type="submit" id="submitBtn"
                        class="w-full bg-gradient-to-r from-yellow-400 to-yellow-500 hover:from-yellow-500 hover:to-yellow-600 text-blue-900 font-bold py-4 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg pulse-glow">
                    <span id="submitText">Access Admin Portal</span>
                    <svg id="submitSpinner" class="hidden animate-spin -ml-1 mr-3 h-5 w-5 text-blue-900 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </button>
            </form>

            <!-- Security Notice -->
            <div class="mt-6 p-4 bg-blue-500/20 border border-blue-400/30 rounded-xl backdrop-blur-sm">
                <div class="flex items-start space-x-3">
                    <svg class="w-5 h-5 text-blue-300 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                    <div>
                        <h4 class="text-blue-200 font-semibold text-sm mb-1">Security Notice</h4>
                        <p class="text-blue-100 text-xs leading-relaxed">
                            This is a secure administrative portal. All login attempts are monitored and logged for security purposes.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Back to Login Selection -->
        <div class="text-center mt-8">
            <a href="{{ route('login.select') }}" class="text-white hover:text-yellow-300 transition-colors font-medium flex items-center justify-center space-x-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <span>Back to Login Selection</span>
            </a>
        </div>
    </div>

    <!-- Enhanced Security JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Password Toggle Functionality
            const togglePassword = document.getElementById('togglePassword');
            const passwordField = document.getElementById('password');
            
            togglePassword.addEventListener('click', function() {
                const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordField.setAttribute('type', type);
                this.querySelector('svg').innerHTML = type === 'password' ? 
                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>' :
                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>';
            });
            
            // Form Submission Security
            const form = document.getElementById('adminLoginForm');
            const submitBtn = document.getElementById('submitBtn');
            const submitText = document.getElementById('submitText');
            const submitSpinner = document.getElementById('submitSpinner');
            
            form.addEventListener('submit', function(e) {
                // Prevent double submission
                if (submitBtn.disabled) {
                    e.preventDefault();
                    return false;
                }
                
                // Show loading state
                submitBtn.disabled = true;
                submitText.textContent = 'Authenticating...';
                submitSpinner.classList.remove('hidden');
                
                // Re-enable after 10 seconds as fallback
                setTimeout(() => {
                    submitBtn.disabled = false;
                    submitText.textContent = 'Access Admin Portal';
                    submitSpinner.classList.add('hidden');
                }, 10000);
            });
            
            // Input Validation - Clear errors on input
            const inputs = document.querySelectorAll('input');
            inputs.forEach(input => {
                input.addEventListener('input', function() {
                    // Remove error styling
                    this.classList.remove('border-red-400');
                });
                
                input.addEventListener('blur', function() {
                    if (!this.value.trim() && this.hasAttribute('required')) {
                        this.classList.add('border-red-400');
                    } else {
                        this.classList.remove('border-red-400');
                    }
                });
            });

            // Remember Me functionality
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const rememberCheckbox = document.getElementById('remember');
            const loginForm = document.getElementById('adminLoginForm');

            // Load saved credentials on page load
            loadSavedCredentials();

            // Save credentials when remember me is checked and form is submitted
            loginForm.addEventListener('submit', function(e) {
                if (rememberCheckbox.checked) {
                    saveCredentials();
                } else {
                    clearSavedCredentials();
                }
            });

            // Auto-check remember me if credentials are loaded
            if (emailInput.value && passwordInput.value) {
                rememberCheckbox.checked = true;
            }

            // Clear credentials when remember me is unchecked
            rememberCheckbox.addEventListener('change', function() {
                if (!this.checked) {
                    clearSavedCredentials();
                }
            });

            function saveCredentials() {
                const credentials = {
                    email: emailInput.value,
                    password: passwordInput.value,
                    timestamp: Date.now()
                };
                localStorage.setItem('admin_credentials', JSON.stringify(credentials));
            }

            function loadSavedCredentials() {
                try {
                    const saved = localStorage.getItem('admin_credentials');
                    if (saved) {
                        const credentials = JSON.parse(saved);
                        // Check if credentials are not too old (30 days)
                        const thirtyDaysAgo = Date.now() - (30 * 24 * 60 * 60 * 1000);
                        if (credentials.timestamp > thirtyDaysAgo) {
                            emailInput.value = credentials.email || '';
                            passwordInput.value = credentials.password || '';
                            
                            // Add visual feedback that credentials were loaded
                            if (credentials.email && credentials.password) {
                                emailInput.style.borderColor = '#10b981';
                                passwordInput.style.borderColor = '#10b981';
                                
                                // Add a subtle notification
                                showNotification('Admin credentials loaded from saved data', 'success');
                            }
                        } else {
                            // Clear old credentials
                            clearSavedCredentials();
                        }
                    }
                } catch (error) {
                    console.error('Error loading saved credentials:', error);
                    clearSavedCredentials();
                }
            }

            function clearSavedCredentials() {
                localStorage.removeItem('admin_credentials');
            }

            function showNotification(message, type = 'info') {
                // Create notification element
                const notification = document.createElement('div');
                notification.className = `fixed top-4 right-4 px-4 py-2 rounded-lg text-white text-sm font-medium z-50 transition-all duration-300 ${
                    type === 'success' ? 'bg-green-500' : 'bg-blue-500'
                }`;
                notification.textContent = message;
                
                document.body.appendChild(notification);
                
                // Auto-remove after 3 seconds
                setTimeout(() => {
                    notification.style.opacity = '0';
                    notification.style.transform = 'translateX(100%)';
                    setTimeout(() => {
                        if (notification.parentNode) {
                            notification.parentNode.removeChild(notification);
                        }
                    }, 300);
                }, 3000);
            }

            // Clear visual feedback after user starts typing
            [emailInput, passwordInput].forEach(input => {
                input.addEventListener('input', function() {
                    this.style.borderColor = '';
                });
            });
        });
    </script>
</body>
</html>
