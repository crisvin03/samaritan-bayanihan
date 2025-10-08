<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Samaritan Bayanihan Inc.</title>
    
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
        .selector-gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 25%, #f093fb 50%, #f5576c 75%, #4facfe 100%);
            min-height: 100vh;
        }
        .glass-effect {
            backdrop-filter: blur(20px);
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .card-hover:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.4);
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
        .icon-bounce {
            animation: icon-bounce 2s ease-in-out infinite;
        }
        @keyframes icon-bounce {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }
    </style>
</head>
<body class="min-h-screen selector-gradient-bg flex items-center justify-center p-6">
    <div class="w-full max-w-6xl">
        <!-- Logo and Header -->
        <div class="text-center mb-12">
            <div class="flex items-center justify-center space-x-3 mb-8">
                <div class="w-20 h-20 rounded-xl overflow-hidden shadow-xl border-2 border-white/20 bg-white p-1 floating-animation">
                    <img src="{{ asset('images/logo.png') }}" alt="Bayanihan Logo" class="w-full h-full object-contain">
                </div>
                <div class="text-left">
                    <span class="text-white font-bold text-3xl block">Samaritan</span>
                    <span class="text-yellow-300 font-semibold text-lg">Bayanihan Inc.</span>
                </div>
            </div>
            
            <h1 class="text-5xl font-bold text-white mb-4">Welcome Back</h1>
            <p class="text-purple-100 text-xl">Choose your access portal to continue</p>
        </div>

        <!-- Login Options Grid -->
        <div class="grid md:grid-cols-3 gap-8 mb-12">
            <!-- Member Login -->
            <div class="glass-effect rounded-3xl p-8 card-hover cursor-pointer" onclick="window.location.href='{{ route('login') }}'">
                <div class="text-center">
                    <!-- Member Icon -->
                    <div class="w-20 h-20 mx-auto mb-6 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center icon-bounce">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    
                    <h3 class="text-2xl font-bold text-white mb-3">Member Portal</h3>
                    <p class="text-purple-100 text-sm leading-relaxed mb-6">
                        Access your personal dashboard, apply for benefits, track contributions, and manage your account.
                    </p>
                    
                    <!-- Features List -->
                    <div class="space-y-2 mb-6 text-left">
                        <div class="flex items-center space-x-2 text-purple-100 text-sm">
                            <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Apply for Benefits</span>
                        </div>
                        <div class="flex items-center space-x-2 text-purple-100 text-sm">
                            <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Track Contributions</span>
                        </div>
                        <div class="flex items-center space-x-2 text-purple-100 text-sm">
                            <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>View Notifications</span>
                        </div>
                    </div>
                    
                    <button class="w-full bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-bold py-3 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg">
                        Member Login
                    </button>
                </div>
            </div>

            <!-- Treasurer Login -->
            <div class="glass-effect rounded-3xl p-8 card-hover cursor-pointer" onclick="window.location.href='{{ route('treasurer.login') }}'">
                <div class="text-center">
                    <!-- Treasurer Icon -->
                    <div class="w-20 h-20 mx-auto mb-6 bg-gradient-to-br from-green-400 to-green-600 rounded-full flex items-center justify-center icon-bounce">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                    
                    <h3 class="text-2xl font-bold text-white mb-3">Treasurer Portal</h3>
                    <p class="text-purple-100 text-sm leading-relaxed mb-6">
                        Manage financial records, validate contributions, and oversee barangay financial activities.
                    </p>
                    
                    <!-- Features List -->
                    <div class="space-y-2 mb-6 text-left">
                        <div class="flex items-center space-x-2 text-purple-100 text-sm">
                            <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Record Contributions</span>
                        </div>
                        <div class="flex items-center space-x-2 text-purple-100 text-sm">
                            <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Manage Members</span>
                        </div>
                        <div class="flex items-center space-x-2 text-purple-100 text-sm">
                            <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Financial Reports</span>
                        </div>
                    </div>
                    
                    <button class="w-full bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white font-bold py-3 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg">
                        Treasurer Login
                    </button>
                </div>
            </div>

            <!-- Admin Login -->
            <div class="glass-effect rounded-3xl p-8 card-hover cursor-pointer" onclick="window.location.href='{{ route('admin.login') }}'">
                <div class="text-center">
                    <!-- Admin Icon -->
                    <div class="w-20 h-20 mx-auto mb-6 bg-gradient-to-br from-red-400 to-red-600 rounded-full flex items-center justify-center icon-bounce">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    
                    <h3 class="text-2xl font-bold text-white mb-3">Admin Portal</h3>
                    <p class="text-purple-100 text-sm leading-relaxed mb-6">
                        Full system administration, approve benefits, manage all users, and oversee system operations.
                    </p>
                    
                    <!-- Features List -->
                    <div class="space-y-2 mb-6 text-left">
                        <div class="flex items-center space-x-2 text-purple-100 text-sm">
                            <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Approve Benefits</span>
                        </div>
                        <div class="flex items-center space-x-2 text-purple-100 text-sm">
                            <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Manage All Users</span>
                        </div>
                        <div class="flex items-center space-x-2 text-purple-100 text-sm">
                            <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>System Administration</span>
                        </div>
                    </div>
                    
                    <button class="w-full bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-bold py-3 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg">
                        Admin Login
                    </button>
                </div>
            </div>
        </div>

        <!-- Additional Options -->
        <div class="text-center">
            <div class="glass-effect rounded-2xl p-6 mb-6">
                <h3 class="text-xl font-bold text-white mb-4">New to Bayanihan?</h3>
                <p class="text-purple-100 mb-4">Join our community and start your journey with Samaritan Bayanihan Inc.</p>
                <a href="{{ route('register') }}" class="inline-flex items-center space-x-2 bg-gradient-to-r from-yellow-400 to-yellow-500 hover:from-yellow-500 hover:to-yellow-600 text-purple-900 font-bold px-6 py-3 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg pulse-glow">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                    <span>Create Member Account</span>
                </a>
            </div>
            
            <!-- Back to Home -->
            <a href="/" class="text-white hover:text-yellow-300 transition-colors font-medium flex items-center justify-center space-x-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <span>Back to Home</span>
            </a>
        </div>
    </div>

    <!-- Enhanced JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add click effects to cards
            const cards = document.querySelectorAll('.card-hover');
            
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-8px) scale(1.02)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                });
            });
            
            // Add keyboard navigation
            document.addEventListener('keydown', function(e) {
                if (e.key === '1') {
                    window.location.href = '{{ route('login') }}';
                } else if (e.key === '2') {
                    window.location.href = '{{ route('treasurer.login') }}';
                } else if (e.key === '3') {
                    window.location.href = '{{ route('admin.login') }}';
                }
            });
        });
    </script>
</body>
</html>
