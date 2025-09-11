<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Treasurer Dashboard - Samaritan Bayanihan Inc.</title>
    
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
                        <span class="text-white font-bold text-xl">Bayanihan Treasurer</span>
                    </div>
                </div>
                
                <div class="flex items-center space-x-4">
                    <span class="text-white">Welcome, {{ auth()->user()->name }}</span>
                    <span class="text-purple-200 text-sm">{{ auth()->user()->barangay }}</span>
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
            <h1 class="text-3xl font-bold text-white mb-2">Treasurer Dashboard</h1>
            <p class="text-purple-100">Managing contributions for {{ auth()->user()->barangay }}</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="glass-effect rounded-xl p-6 text-center">
                <div class="text-3xl font-bold text-yellow-400 mb-2">{{ $stats['total_members'] }}</div>
                <div class="text-white text-sm">Total Members</div>
            </div>
            
            <div class="glass-effect rounded-xl p-6 text-center">
                <div class="text-3xl font-bold text-green-400 mb-2">₱{{ number_format($stats['total_contributions'], 2) }}</div>
                <div class="text-white text-sm">Total Contributions</div>
            </div>
            
            <div class="glass-effect rounded-xl p-6 text-center">
                <div class="text-3xl font-bold text-blue-400 mb-2">{{ $stats['pending_contributions'] }}</div>
                <div class="text-white text-sm">Pending Contributions</div>
            </div>
            
            <div class="glass-effect rounded-xl p-6 text-center">
                <div class="text-3xl font-bold text-purple-400 mb-2">{{ $stats['pending_benefits'] }}</div>
                <div class="text-white text-sm">Pending Benefits</div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <a href="{{ route('treasurer.members.index') }}" class="glass-effect rounded-xl p-6 text-center hover:bg-white/20 transition-all duration-300">
                <div class="text-3xl font-bold text-yellow-400 mb-2">👥</div>
                <div class="text-white text-sm">Manage Members</div>
            </a>
            
            <a href="{{ route('treasurer.contributions.index') }}" class="glass-effect rounded-xl p-6 text-center hover:bg-white/20 transition-all duration-300">
                <div class="text-3xl font-bold text-blue-400 mb-2">💰</div>
                <div class="text-white text-sm">Record Contributions</div>
            </a>
            
            <a href="#" class="glass-effect rounded-xl p-6 text-center hover:bg-white/20 transition-all duration-300">
                <div class="text-3xl font-bold text-green-400 mb-2">📊</div>
                <div class="text-white text-sm">View Reports</div>
            </a>
        </div>

        <!-- Recent Activity -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Recent Members -->
            <div class="glass-effect rounded-xl p-6">
                <h2 class="text-xl font-bold text-white mb-4">Recent Members</h2>
                @if($recent_members->count() > 0)
                    <div class="space-y-3">
                        @foreach($recent_members as $member)
                            <div class="bg-white/10 rounded-lg p-4">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <div class="text-white font-medium">{{ $member->name }}</div>
                                        <div class="text-purple-200 text-sm">{{ $member->email }}</div>
                                    </div>
                                    <div class="text-right">
                                        <span class="px-2 py-1 rounded-full text-xs font-medium
                                            @if($member->status === 'active') bg-green-500/20 text-green-300
                                            @else bg-gray-500/20 text-gray-300 @endif">
                                            {{ ucfirst($member->status) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <div class="text-purple-200">No members yet</div>
                    </div>
                @endif
            </div>

            <!-- Recent Contributions -->
            <div class="glass-effect rounded-xl p-6">
                <h2 class="text-xl font-bold text-white mb-4">Recent Contributions</h2>
                @if($recent_contributions->count() > 0)
                    <div class="space-y-3">
                        @foreach($recent_contributions as $contribution)
                            <div class="bg-white/10 rounded-lg p-4">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <div class="text-white font-medium">₱{{ number_format($contribution->amount, 2) }}</div>
                                        <div class="text-purple-200 text-sm">{{ $contribution->member->name ?? 'Unknown' }}</div>
                                    </div>
                                    <div class="text-right">
                                        <span class="px-2 py-1 rounded-full text-xs font-medium
                                            @if($contribution->status === 'validated') bg-green-500/20 text-green-300
                                            @elseif($contribution->status === 'pending') bg-yellow-500/20 text-yellow-300
                                            @else bg-gray-500/20 text-gray-300 @endif">
                                            {{ ucfirst($contribution->status) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <div class="text-purple-200">No contributions yet</div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
