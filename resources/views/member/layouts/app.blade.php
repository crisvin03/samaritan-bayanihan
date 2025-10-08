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
            transition: all 0.3s ease;
        }
        .sidebar-link:hover {
            background-color: #f3f4f6;
            transform: translateX(4px);
        }
        .sidebar-link.active {
            background-color: #e5e7eb;
            border-right: 3px solid #3b82f6;
        }
        .sidebar-link.active .sidebar-icon {
            color: #3b82f6;
        }
        .sidebar-link.active .sidebar-text {
            color: #1f2937;
            font-weight: 600;
        }
        
        /* Collapsible Sidebar Styles */
        .sidebar {
            transition: width 0.3s ease, transform 0.3s ease;
            overflow: hidden;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            z-index: 50;
        }
        .sidebar.collapsed {
            width: 4rem;
        }
        
        /* Mobile Responsive Styles */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                width: 16rem;
            }
            .sidebar.mobile-open {
                transform: translateX(0);
            }
            .sidebar.collapsed {
                width: 16rem;
            }
            .main-content {
                margin-left: 0;
            }
        }
        
        @media (min-width: 769px) {
            .main-content {
                margin-left: 4rem;
                transition: margin-left 0.3s ease;
            }
            .sidebar:not(.collapsed) + .main-content {
                margin-left: 16rem;
            }
        }
        .sidebar.collapsed .sidebar-text {
            opacity: 0;
            transform: translateX(-20px);
            pointer-events: none;
            width: 0;
        }
        .sidebar.collapsed .sidebar-header-text {
            opacity: 0;
            transform: translateX(-20px);
            pointer-events: none;
            width: 0;
        }
        .sidebar.collapsed .user-info-text {
            opacity: 0;
            transform: translateX(-20px);
            pointer-events: none;
            width: 0;
        }
        .sidebar.collapsed .sidebar-link {
            justify-content: center;
            padding: 0.75rem 0.5rem;
        }
        .sidebar.collapsed .sidebar-link .sidebar-icon {
            margin-right: 0;
            flex-shrink: 0;
        }
        .sidebar.collapsed .sidebar-header {
            justify-content: center;
        }
        .sidebar.collapsed .user-section {
            justify-content: center;
        }
        .sidebar.collapsed .user-info-section {
            width: 4rem;
            padding: 0.5rem;
        }
        .sidebar.collapsed .user-info-section .user-section {
            justify-content: center;
            margin-bottom: 0.5rem;
        }
        .sidebar.collapsed .user-info-section .logout-button {
            justify-content: center;
            padding: 0.5rem;
        }
        .sidebar-text, .sidebar-header-text, .user-info-text {
            transition: all 0.3s ease;
            white-space: nowrap;
        }
        .user-info-section {
            transition: all 0.3s ease;
            width: 16rem;
        }
        .sidebar:hover .sidebar-text,
        .sidebar:hover .sidebar-header-text,
        .sidebar:hover .user-info-text {
            opacity: 1;
            transform: translateX(0);
            pointer-events: auto;
            width: auto;
        }
        .sidebar:hover {
            width: 16rem;
        }
        .sidebar:hover .sidebar-link {
            justify-content: flex-start;
            padding: 0.75rem 1rem;
        }
        .sidebar:hover .sidebar-link .sidebar-icon {
            margin-right: 0.75rem;
        }
        .sidebar:hover .sidebar-header {
            justify-content: flex-start;
        }
        .sidebar:hover .user-section {
            justify-content: flex-start;
        }
        .sidebar:hover .user-info-section {
            width: 16rem;
            padding: 0.75rem;
        }
        .sidebar:hover .user-info-section .user-section {
            justify-content: flex-start;
            margin-bottom: 0.75rem;
        }
        .sidebar:hover .user-info-section .logout-button {
            justify-content: flex-start;
            padding: 0.5rem 0.75rem;
        }
        
        /* Mobile overlay for sidebar */
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 40;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }
        .sidebar-overlay.active {
            opacity: 1;
            visibility: visible;
        }
        
        /* Touch-friendly mobile styles */
        @media (max-width: 768px) {
            .sidebar-link {
                padding: 1rem 0.75rem;
                min-height: 3rem;
                touch-action: manipulation;
            }
            .sidebar-link .sidebar-icon {
                width: 1.5rem;
                height: 1.5rem;
            }
            .user-info-section {
                padding: 1rem;
            }
            .user-section {
                margin-bottom: 1rem;
            }
            .logout-button {
                padding: 0.75rem;
                min-height: 3rem;
                touch-action: manipulation;
            }
            .sidebar-header {
                padding: 1rem;
            }
            .sidebar-header .w-10 {
                width: 2.5rem;
                height: 2.5rem;
            }
        }
        
        /* Small mobile devices */
        @media (max-width: 480px) {
            .sidebar {
                width: 14rem;
            }
            .sidebar-link {
                padding: 0.875rem 0.5rem;
                min-height: 2.75rem;
            }
            .user-info-section {
                padding: 0.875rem;
            }
        }
        
        /* Tablet styles */
        @media (min-width: 769px) and (max-width: 1024px) {
            .sidebar.collapsed {
                width: 5rem;
            }
            .sidebar:not(.collapsed) {
                width: 18rem;
            }
            .main-content {
                margin-left: 5rem;
            }
            .sidebar:not(.collapsed) + .main-content {
                margin-left: 18rem;
            }
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Mobile Sidebar Overlay -->
    <div class="sidebar-overlay" id="sidebar-overlay"></div>
    
    <div class="flex">
        <!-- Sidebar -->
        <div class="sidebar w-64 bg-white shadow-lg min-h-screen collapsed flex flex-col" id="sidebar">
            <!-- Sidebar Header -->
            <div class="p-4 border-b border-gray-200">
                <div class="sidebar-header flex items-center">
                    <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center flex-shrink-0">
                        <span class="text-white font-bold text-xl">B</span>
                    </div>
                    <div class="sidebar-header-text ml-3">
                        <h1 class="text-xl font-bold text-gray-800">Member Portal</h1>
                        <p class="text-sm text-gray-500">Samaritan Bayanihan</p>
                    </div>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="mt-4">
                <div class="px-2 space-y-1">
                    <a href="{{ route('member.dashboard') }}" 
                       class="sidebar-link flex items-center px-3 py-3 text-gray-700 rounded-lg {{ request()->routeIs('member.dashboard') ? 'active' : '' }}">
                        <svg class="sidebar-icon w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <span class="sidebar-text">Dashboard</span>
                    </a>

                    <a href="{{ route('member.profile.show') }}" 
                       class="sidebar-link flex items-center px-3 py-3 text-gray-700 rounded-lg {{ request()->routeIs('member.profile.*') ? 'active' : '' }}">
                        <svg class="sidebar-icon w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span class="sidebar-text">Profile Page</span>
                    </a>

                    <a href="{{ route('member.benefits.index') }}" 
                       class="sidebar-link flex items-center px-3 py-3 text-gray-700 rounded-lg {{ request()->routeIs('member.benefits.index') || request()->routeIs('member.benefits.create') || request()->routeIs('member.benefits.show') || request()->routeIs('member.benefits.edit') ? 'active' : '' }}">
                        <svg class="sidebar-icon w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path>
                        </svg>
                        <span class="sidebar-text">Apply for Benefits</span>
                    </a>

                    <a href="{{ route('member.contributions.index') }}" 
                       class="sidebar-link flex items-center px-3 py-3 text-gray-700 rounded-lg {{ request()->routeIs('member.contributions.*') ? 'active' : '' }}">
                        <svg class="sidebar-icon w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <span class="sidebar-text">View Contributions</span>
                    </a>

                    <a href="{{ route('member.benefits.my-requests') }}" 
                       class="sidebar-link flex items-center px-3 py-3 text-gray-700 rounded-lg {{ request()->routeIs('member.benefits.my-requests') ? 'active' : '' }}">
                        <svg class="sidebar-icon w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                        </svg>
                        <span class="sidebar-text">Track Benefit Status</span>
                    </a>

                    <a href="{{ route('member.announcements.index') }}" 
                       class="sidebar-link flex items-center px-3 py-3 text-gray-700 rounded-lg {{ request()->routeIs('member.announcements.*') ? 'active' : '' }}">
                        <svg class="sidebar-icon w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                        </svg>
                        <span class="sidebar-text">Announcements</span>
                    </a>

                    <a href="{{ route('member.notifications.index') }}" 
                       class="sidebar-link flex items-center px-3 py-3 text-gray-700 rounded-lg {{ request()->routeIs('member.notifications.*') ? 'active' : '' }}">
                        <div class="relative">
                            <svg class="sidebar-icon w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM4.828 7l2.586 2.586a2 2 0 002.828 0L12.828 7H4.828zM4.828 17h8l-2.586-2.586a2 2 0 00-2.828 0L4.828 17z"></path>
                            </svg>
                            <!-- Notification Badge -->
                            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-bold" id="notification-count">
                                {{ auth()->user()->benefits()->where('status', 'pending')->count() + (auth()->user()->created_at->isAfter(now()->subDays(7)) ? 1 : 0) }}
                            </span>
                        </div>
                        <span class="sidebar-text">Notifications</span>
                    </a>
                </div>
            </nav>

            <!-- User Info -->
            <div class="mt-auto border-t border-gray-200 bg-white">
                <div class="user-info-section p-3">
                    <div class="user-section flex items-center mb-3">
                        <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-gray-600 text-sm font-semibold">{{ substr(auth()->user()->name, 0, 1) }}</span>
                        </div>
                        <div class="user-info-text ml-3">
                            <p class="text-sm font-medium text-gray-800">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-500">Member</p>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <button type="submit" class="logout-button sidebar-link flex items-center w-full px-3 py-2 text-gray-700 rounded-lg hover:bg-red-50 hover:text-red-600">
                            <svg class="w-4 h-4 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            <span class="sidebar-text">Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content flex-1">
            <!-- Top Bar -->
            <div class="bg-white shadow-sm border-b border-gray-200 px-4 md:px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2 md:space-x-4">
                        <!-- Sidebar Toggle Button -->
                        <button id="sidebar-toggle" class="p-2 rounded-lg hover:bg-gray-100 transition-colors touch-manipulation">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                        <div class="min-w-0 flex-1">
                            <h2 class="text-lg md:text-2xl font-bold text-gray-800 truncate">@yield('page-title', 'Dashboard')</h2>
                            <p class="text-sm md:text-base text-gray-600 truncate">@yield('page-description', 'Welcome to your member portal')</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2 md:space-x-4">
                        <div class="text-xs md:text-sm text-gray-500 hidden sm:block">
                            {{ now()->format('M d, Y') }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Page Content -->
            <main class="p-4 md:p-6">
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
        // Sidebar toggle functionality
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const toggleButton = document.getElementById('sidebar-toggle');
            const overlay = document.getElementById('sidebar-overlay');
            let isCollapsed = true; // Start collapsed
            let isMobile = window.innerWidth <= 768;

            // Check if device is mobile
            function checkMobile() {
                isMobile = window.innerWidth <= 768;
                if (isMobile) {
                    sidebar.classList.add('collapsed');
                    overlay.classList.remove('active');
                }
            }

            // Toggle sidebar on button click
            toggleButton?.addEventListener('click', function() {
                if (isMobile) {
                    // Mobile behavior: slide in/out with overlay
                    sidebar.classList.toggle('mobile-open');
                    overlay.classList.toggle('active');
                } else {
                    // Desktop behavior: collapse/expand
                    isCollapsed = !isCollapsed;
                    if (isCollapsed) {
                        sidebar.classList.add('collapsed');
                    } else {
                        sidebar.classList.remove('collapsed');
                    }
                }
            });

            // Close mobile sidebar when overlay is clicked
            overlay?.addEventListener('click', function() {
                if (isMobile) {
                    sidebar.classList.remove('mobile-open');
                    overlay.classList.remove('active');
                }
            });

            // Desktop hover behavior (only on desktop)
            if (!isMobile) {
                sidebar?.addEventListener('mouseleave', function() {
                    if (!isCollapsed) {
                        isCollapsed = true;
                        sidebar.classList.add('collapsed');
                    }
                });

                sidebar?.addEventListener('mouseenter', function() {
                    if (isCollapsed) {
                        isCollapsed = false;
                        sidebar.classList.remove('collapsed');
                    }
                });
            }

            // Handle window resize
            window.addEventListener('resize', function() {
                const wasMobile = isMobile;
                checkMobile();
                
                // If switching from mobile to desktop or vice versa
                if (wasMobile !== isMobile) {
                    if (isMobile) {
                        sidebar.classList.remove('mobile-open');
                        overlay.classList.remove('active');
                    } else {
                        sidebar.classList.add('collapsed');
                    }
                }
            });

            // Mobile menu toggle functionality (legacy support)
            document.getElementById('mobile-menu-toggle')?.addEventListener('click', function() {
                if (isMobile) {
                    sidebar.classList.toggle('mobile-open');
                    overlay.classList.toggle('active');
                }
            });

            // Close sidebar when clicking on a link (mobile)
            if (isMobile) {
                const sidebarLinks = sidebar.querySelectorAll('.sidebar-link');
                sidebarLinks.forEach(link => {
                    link.addEventListener('click', function() {
                        sidebar.classList.remove('mobile-open');
                        overlay.classList.remove('active');
                    });
                });
            }
        });
    </script>
</body>
</html>
