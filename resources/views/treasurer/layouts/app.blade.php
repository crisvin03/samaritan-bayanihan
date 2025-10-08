<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Treasurer Portal') - Samaritan Bayanihan Inc.</title>
    
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
        }
        .sidebar-link .sidebar-icon {
            width: 1.25rem;
            height: 1.25rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
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
                overflow-x: hidden;
                max-width: calc(100vw - 4rem);
            }
            .sidebar:not(.collapsed) + .main-content {
                margin-left: 16rem;
                max-width: calc(100vw - 16rem);
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
            padding: 1rem;
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
            padding: 1rem;
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
        
        /* Mobile specific styles */
        @media (max-width: 768px) {
            .sidebar {
                width: 16rem;
            }
            .sidebar-link {
                padding: 0.75rem 1rem;
                min-height: 3rem;
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
<body class="bg-gray-50">
    <!-- Mobile Sidebar Overlay -->
    <div class="sidebar-overlay" id="sidebar-overlay"></div>
    
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="sidebar bg-white shadow-lg border-r border-gray-200 collapsed" id="sidebar">
            <!-- Header -->
            <div class="sidebar-header border-b border-gray-200 p-4">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-lg flex items-center justify-center flex-shrink-0">
                        <span class="text-white font-bold text-xl">T</span>
                    </div>
                    <div class="sidebar-header-text ml-3">
                        <h1 class="text-xl font-bold text-gray-800">Treasurer Portal</h1>
                        <p class="text-sm text-gray-500">Samaritan Bayanihan</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-4 py-6 space-y-2">
                <div class="space-y-1">
                    <a href="{{ route('treasurer.dashboard') }}" 
                       class="sidebar-link flex items-center px-3 py-3 text-gray-700 rounded-lg {{ request()->routeIs('treasurer.dashboard') ? 'active' : '' }}">
                        <svg class="sidebar-icon w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v2H8V5z"></path>
                        </svg>
                        <span class="sidebar-text">Dashboard</span>
                    </a>

                    <a href="{{ route('treasurer.members.index') }}" 
                       class="sidebar-link flex items-center px-3 py-3 text-gray-700 rounded-lg {{ request()->routeIs('treasurer.members.*') ? 'active' : '' }}">
                        <svg class="sidebar-icon w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span class="sidebar-text">Manage Members</span>
                    </a>

                    <a href="{{ route('treasurer.contributions.index') }}" 
                       class="sidebar-link flex items-center px-3 py-3 text-gray-700 rounded-lg {{ request()->routeIs('treasurer.contributions.*') ? 'active' : '' }}">
                        <svg class="sidebar-icon w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                        <span class="sidebar-text">Contributions</span>
                    </a>

            <a href="{{ route('treasurer.benefits.index') }}" 
               class="sidebar-link flex items-center px-3 py-3 text-gray-700 rounded-lg {{ request()->routeIs('treasurer.benefits.*') ? 'active' : '' }}">
                <svg class="sidebar-icon w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <span class="sidebar-text">Monitor Requests</span>
            </a>
            
            <!-- Reports & Analytics -->
            <a href="{{ route('treasurer.reports.index') }}" 
               class="sidebar-link flex items-center px-3 py-3 text-gray-700 rounded-lg {{ request()->routeIs('treasurer.reports.*') ? 'active' : '' }}">
                <svg class="sidebar-icon w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                <span class="sidebar-text">Reports & Analytics</span>
            </a>


                    <a href="{{ route('treasurer.announcements.index') }}" 
                       class="sidebar-link flex items-center px-3 py-3 text-gray-700 rounded-lg {{ request()->routeIs('treasurer.announcements.*') ? 'active' : '' }}">
                        <svg class="sidebar-icon w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                        </svg>
                        <span class="sidebar-text">Announcements</span>
                    </a>
                </div>
            </nav>

            <!-- User Info -->
            <div class="mt-auto border-t border-gray-200 bg-white">
                <div class="user-info-section p-3">
                    <div class="user-section">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-full flex items-center justify-center shadow-lg">
                                <span class="text-white text-lg font-bold">B</span>
                            </div>
                            <div class="user-info-text">
                                <div class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</div>
                                <div class="text-xs text-gray-500">Treasurer</div>
                            </div>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="mt-2">
                        @csrf
                        <button type="submit" class="logout-button sidebar-link flex items-center w-full px-3 py-2 text-gray-700 rounded-lg hover:bg-red-50 hover:text-red-600">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            <span class="sidebar-text">Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content flex-1 flex flex-col overflow-hidden">
            <!-- Top Bar -->
            <div class="bg-white shadow-sm border-b border-gray-200 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <button id="sidebar-toggle" class="p-2 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                        <div>
                            <h1 class="text-xl font-semibold text-gray-900">@yield('page-title', 'Dashboard')</h1>
                            <p class="text-sm text-gray-600">@yield('page-description', 'Treasurer portal for managing contributions')</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="text-sm text-gray-600">
                            <span class="font-medium">{{ auth()->user()->barangay }}</span> • Treasurer
                        </div>
                    </div>
                </div>
            </div>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto bg-gray-50">
                <div class="p-6">
                    @if(session('success'))
                        <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg">
                            {{ session('error') }}
                        </div>
                    @endif

                    @yield('content')
                </div>
            </main>
        </div>
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
