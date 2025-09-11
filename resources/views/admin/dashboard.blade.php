<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - Samaritan Bayanihan Inc.</title>
    
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .glass-effect {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body class="min-h-screen gradient-bg">
    <!-- Navigation -->
    <nav class="bg-white/10 backdrop-blur-md border-b border-white/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center">
                            <span class="text-purple-600 font-bold text-xl">B</span>
                        </div>
                        <span class="text-white font-bold text-xl">Bayanihan Admin</span>
                    </div>
                </div>
                
                <div class="flex items-center space-x-4">
                    <span class="text-white">Welcome, {{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-white hover:text-yellow-300 transition-colors">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <!-- Welcome Message -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-white mb-2">Admin Dashboard</h1>
            <p class="text-purple-100">System administration and management</p>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <a href="{{ route('admin.members.index') }}" class="glass-effect rounded-xl p-6 text-center hover:bg-white/20 transition-all duration-300">
                <div class="text-3xl font-bold text-yellow-400 mb-2">👥</div>
                <div class="text-white text-sm">Manage Members</div>
            </a>
            
            <a href="{{ route('admin.contributions.index') }}" class="glass-effect rounded-xl p-6 text-center hover:bg-white/20 transition-all duration-300">
                <div class="text-3xl font-bold text-blue-400 mb-2">💰</div>
                <div class="text-white text-sm">Contributions</div>
            </a>
            
            <a href="{{ route('admin.benefits.index') }}" class="glass-effect rounded-xl p-6 text-center hover:bg-white/20 transition-all duration-300">
                <div class="text-3xl font-bold text-green-400 mb-2">🎁</div>
                <div class="text-white text-sm">Benefits</div>
            </a>
            
            <a href="#" class="glass-effect rounded-xl p-6 text-center hover:bg-white/20 transition-all duration-300">
                <div class="text-3xl font-bold text-purple-400 mb-2">📊</div>
                <div class="text-white text-sm">Reports</div>
            </a>
        </div>

        <!-- System Status -->
        <div class="glass-effect rounded-xl p-6">
            <h2 class="text-xl font-bold text-white mb-4">System Status</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-green-500/20 border border-green-500/50 rounded-lg p-4">
                    <div class="text-green-300 font-semibold">✅ System Online</div>
                    <div class="text-green-200 text-sm">All services operational</div>
                </div>
                <div class="bg-blue-500/20 border border-blue-500/50 rounded-lg p-4">
                    <div class="text-blue-300 font-semibold">🔒 Database Connected</div>
                    <div class="text-blue-200 text-sm">MySQL connection active</div>
                </div>
                <div class="bg-yellow-500/20 border border-yellow-500/50 rounded-lg p-4">
                    <div class="text-yellow-300 font-semibold">⚡ Performance Good</div>
                    <div class="text-yellow-200 text-sm">Response time optimal</div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
