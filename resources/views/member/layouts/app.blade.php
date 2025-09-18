<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Member Portal') - Samaritan Bayanihan Inc.</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .sidebar-link {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }
        .sidebar-link:hover {
            background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
            transform: translateX(4px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .sidebar-link.active {
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            border-right: 4px solid #3b82f6;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
        }
        .sidebar-link.active .sidebar-icon {
            color: #3b82f6;
            transform: scale(1.1);
        }
        .sidebar-link.active .sidebar-text {
            color: #1e40af;
            font-weight: 600;
        }
        .sidebar-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 0;
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            transition: width 0.3s ease;
            border-radius: 0 8px 8px 0;
        }
        .sidebar-link:hover::before {
            width: 4px;
        }
        .sidebar-link.active::before {
            width: 4px;
        }
        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        .animate-pulse-slow {
            animation: pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="flex">
        <!-- Sidebar -->
        <div class="w-64 bg-white shadow-xl min-h-screen border-r border-gray-100">
            <!-- Sidebar Header -->
            <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-indigo-50">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-indigo-700 rounded-xl flex items-center justify-center shadow-lg">
                        <span class="text-white font-bold text-xl">B</span>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold gradient-text">Member Portal</h1>
                        <p class="text-sm text-gray-600 font-medium">Samaritan Bayanihan</p>
                    </div>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="mt-6">
                <div class="px-4 space-y-2">
                    <a href="{{ route('member.dashboard') }}" 
                       class="sidebar-link flex items-center px-4 py-3 text-gray-700 rounded-lg {{ request()->routeIs('member.dashboard') ? 'active' : '' }}">
                        <svg class="sidebar-icon w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <span class="sidebar-text">Dashboard</span>
                    </a>

                    <a href="{{ route('member.profile.show') }}" 
                       class="sidebar-link flex items-center px-4 py-3 text-gray-700 rounded-lg {{ request()->routeIs('member.profile.*') ? 'active' : '' }}">
                        <svg class="sidebar-icon w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span class="sidebar-text">Profile Page</span>
                    </a>

                    <a href="{{ route('member.benefits.index') }}" 
                       class="sidebar-link flex items-center px-4 py-3 text-gray-700 rounded-lg {{ request()->routeIs('member.benefits.*') ? 'active' : '' }}">
                        <svg class="sidebar-icon w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path>
                        </svg>
                        <span class="sidebar-text">Apply for Benefits</span>
                    </a>

                    <a href="{{ route('member.contributions.index') }}" 
                       class="sidebar-link flex items-center px-4 py-3 text-gray-700 rounded-lg {{ request()->routeIs('member.contributions.*') ? 'active' : '' }}">
                        <svg class="sidebar-icon w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <span class="sidebar-text">View Contributions</span>
                    </a>

                    <a href="{{ route('member.benefits.index') }}?tab=tracking" 
                       class="sidebar-link flex items-center px-4 py-3 text-gray-700 rounded-lg">
                        <svg class="sidebar-icon w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                        </svg>
                        <span class="sidebar-text">Track Benefit Status</span>
                    </a>

                    <a href="#" 
                       class="sidebar-link flex items-center px-4 py-3 text-gray-700 rounded-lg">
                        <svg class="sidebar-icon w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM4.828 7l2.586 2.586a2 2 0 002.828 0L12.828 7H4.828zM4.828 17h8l-2.586-2.586a2 2 0 00-2.828 0L4.828 17z"></path>
                        </svg>
                        <span class="sidebar-text">Notifications</span>
                    </a>
                </div>
            </nav>

            <!-- User Info -->
            <div class="absolute bottom-0 w-64 p-4 border-t border-gray-200 bg-white">
                <div class="flex items-center space-x-3 mb-3">
                    <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center">
                        <span class="text-gray-600 text-sm font-semibold">{{ substr(auth()->user()->name, 0, 1) }}</span>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-800">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-500">Member</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit" class="sidebar-link flex items-center w-full px-4 py-2 text-gray-700 rounded-lg hover:bg-red-50 hover:text-red-600">
                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1">
            <!-- Top Bar -->
            <div class="bg-white shadow-sm border-b border-gray-200 px-6 py-6 bg-gradient-to-r from-white to-gray-50">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-800">@yield('page-title', 'Dashboard')</h2>
                        <p class="text-gray-600 text-lg">@yield('page-description', 'Welcome to your member portal')</p>
                    </div>
                    <div class="flex items-center space-x-6">
                        <div class="text-right">
                            <div class="text-sm text-gray-500 font-medium">{{ now()->format('l, M d, Y') }}</div>
                            <div class="text-xs text-gray-400">{{ now()->format('h:i A') }}</div>
                        </div>
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center shadow-lg">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM4.828 7l2.586 2.586a2 2 0 002.828 0L12.828 7H4.828zM4.828 17h8l-2.586-2.586a2 2 0 00-2.828 0L4.828 17z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Page Content -->
            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Mobile Menu Toggle (Hidden by default) -->
    <div class="lg:hidden fixed top-4 left-4 z-50">
        <button id="mobile-menu-toggle" class="bg-white p-2 rounded-lg shadow-lg">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
    </div>

    <script>
        // Mobile menu toggle functionality
        document.getElementById('mobile-menu-toggle')?.addEventListener('click', function() {
            const sidebar = document.querySelector('.w-64');
            sidebar.classList.toggle('-translate-x-full');
        });
    </script>
</body>
</html>
