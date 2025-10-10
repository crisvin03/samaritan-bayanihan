<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Portal') - Samaritan Bayanihan Inc.</title>
    
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
            background-color: #f8fafc;
            transform: translateX(4px);
        }
        .sidebar-link.active {
            background-color: #e0f2fe;
            border-right: 3px solid #0ea5e9;
        }
        .sidebar-link.active .sidebar-icon {
            color: #0ea5e9;
        }
        .sidebar-link.active .sidebar-text {
            color: #0c4a6e;
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
                overflow-x: hidden;
                max-width: 100vw;
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
<body class="bg-slate-50 min-h-screen">
    <!-- Mobile Sidebar Overlay -->
    <div class="sidebar-overlay" id="sidebar-overlay"></div>
    
    <div class="flex">
        <!-- Sidebar -->
        <div class="sidebar w-64 bg-white shadow-lg min-h-screen collapsed flex flex-col" id="sidebar">
            <!-- Sidebar Header -->
            <div class="p-4 border-b border-gray-200">
                <div class="sidebar-header flex items-center">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-indigo-700 rounded-lg flex items-center justify-center flex-shrink-0">
                        <span class="text-white font-bold text-xl">A</span>
                    </div>
                    <div class="sidebar-header-text ml-3">
                        <h1 class="text-xl font-bold text-gray-800">Admin Portal</h1>
                        <p class="text-sm text-gray-500">Samaritan Bayanihan</p>
                    </div>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="mt-4">
                <div class="px-2 space-y-1">
                    <a href="{{ route('admin.dashboard') }}" 
                       class="sidebar-link flex items-center px-3 py-3 text-gray-700 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <svg class="sidebar-icon w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <span class="sidebar-text">Dashboard</span>
                    </a>

                    <a href="{{ route('admin.members.index') }}" 
                       class="sidebar-link flex items-center px-3 py-3 text-gray-700 rounded-lg {{ request()->routeIs('admin.members.*') ? 'active' : '' }}">
                        <svg class="sidebar-icon w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                        <span class="sidebar-text">Manage Members</span>
                    </a>

                    <a href="{{ route('admin.treasurers.index') }}" 
                       class="sidebar-link flex items-center px-3 py-3 text-gray-700 rounded-lg {{ request()->routeIs('admin.treasurers.*') ? 'active' : '' }}">
                        <svg class="sidebar-icon w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span class="sidebar-text">Manage Treasurers</span>
                    </a>

                    <a href="{{ route('admin.contributions.index') }}" 
                       class="sidebar-link flex items-center px-3 py-3 text-gray-700 rounded-lg {{ request()->routeIs('admin.contributions.*') ? 'active' : '' }}">
                        <svg class="sidebar-icon w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                        <span class="sidebar-text">Contributions</span>
                    </a>

                    <a href="{{ route('admin.benefits.index') }}" 
                       class="sidebar-link flex items-center px-3 py-3 text-gray-700 rounded-lg {{ request()->routeIs('admin.benefits.*') ? 'active' : '' }}">
                        <svg class="sidebar-icon w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path>
                        </svg>
                        <span class="sidebar-text">Benefits Management</span>
                    </a>

                    <a href="{{ route('admin.reports.index') }}" 
                       class="sidebar-link flex items-center px-3 py-3 text-gray-700 rounded-lg {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
                        <svg class="sidebar-icon w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        <span class="sidebar-text">Reports & Analytics</span>
                    </a>

                    <a href="{{ route('admin.announcements.index') }}" 
                       class="sidebar-link flex items-center px-3 py-3 text-gray-700 rounded-lg {{ request()->routeIs('admin.announcements.*') ? 'active' : '' }}">
                        <svg class="sidebar-icon w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                        </svg>
                        <span class="sidebar-text">Announcements</span>
                    </a>

                    <a href="{{ route('admin.notifications.index') }}" 
                       class="sidebar-link flex items-center px-3 py-3 text-gray-700 rounded-lg {{ request()->routeIs('admin.notifications.*') ? 'active' : '' }}">
                        <svg class="sidebar-icon w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM4.828 7l2.586 2.586a2 2 0 002.828 0L12.828 7H4.828zM4.828 17h8l-2.586-2.586a2 2 0 00-2.828 0L4.828 17z"></path>
                        </svg>
                        <span class="sidebar-text">Notifications</span>
                        <span class="ml-auto bg-red-500 text-white text-xs rounded-full px-2 py-1" id="notification-badge" style="display: none;">0</span>
                    </a>

                    <a href="{{ route('admin.settings.index') }}" 
                       class="sidebar-link flex items-center px-3 py-3 text-gray-700 rounded-lg {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                        <svg class="sidebar-icon w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span class="sidebar-text">Organization Settings</span>
                    </a>
                </div>
            </nav>

            <!-- User Info -->
            <div class="mt-auto border-t border-gray-200 bg-white">
                <div class="user-info-section p-3">
                    <div class="user-section flex items-center mb-3">
                        <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-white text-sm font-semibold">{{ substr(auth()->user()->name, 0, 1) }}</span>
                        </div>
                        <div class="user-info-text ml-3">
                            <p class="text-sm font-medium text-gray-800">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-500">Administrator</p>
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
                            <p class="text-sm md:text-base text-gray-600 truncate">@yield('page-description', 'System administration and management')</p>
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
            <main class="p-4 md:p-6 overflow-x-hidden">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Mobile Menu Toggle (Hidden by default) -->
    
    <!-- Admin Notification System -->
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
        // Load notification count on page load
        document.addEventListener('DOMContentLoaded', function() {
            loadNotificationCount();
        });

        // Function to load notification count
        function loadNotificationCount() {
            fetch('/admin/notifications/unread-count')
                .then(response => response.json())
                .then(data => {
                    const badge = document.getElementById('notification-badge');
                    if (data.count > 0) {
                        badge.textContent = data.count;
                        badge.style.display = 'inline-block';
                    } else {
                        badge.style.display = 'none';
                    }
                })
                .catch(error => console.error('Error loading notification count:', error));
        }

        // Initialize Pusher for real-time notifications
        const pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
            cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
            encrypted: true
        });

        // Subscribe to admin notifications channel
        const channel = pusher.subscribe('admin-notifications');
        
        // Listen for new notifications
        channel.bind('new-member-registered', function(data) {
            updateNotificationCount();
            showNotificationToast(data);
        });

        channel.bind('id-document-uploaded', function(data) {
            updateNotificationCount();
            showNotificationToast(data);
        });

        // Function to update notification count
        function updateNotificationCount() {
            loadNotificationCount();
        }

        // Function to show notification toast
        function showNotificationToast(data) {
            const toast = document.createElement('div');
            toast.className = 'fixed top-4 right-4 bg-white border border-gray-200 rounded-lg shadow-lg p-4 z-50 max-w-sm';
            toast.innerHTML = `
                <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM4.828 7l2.586 2.586a2 2 0 002.828 0L12.828 7H4.828zM4.828 17h8l-2.586-2.586a2 2 0 00-2.828 0L4.828 17z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1">
                        <h4 class="text-sm font-semibold text-gray-900">${data.title || 'New Notification'}</h4>
                        <p class="text-sm text-gray-600 mt-1">${data.message || 'You have a new notification'}</p>
                    </div>
                    <button onclick="this.parentElement.parentElement.remove()" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            `;
            
            document.body.appendChild(toast);
            
            // Auto-remove after 5 seconds
            setTimeout(() => {
                toast.remove();
            }, 5000);
        }
    </script>
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
