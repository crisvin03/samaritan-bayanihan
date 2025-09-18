<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Benefits - Samaritan Bayanihan Inc.</title>
    
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
                        <span class="text-white font-bold text-xl">Bayanihan</span>
                    </div>
                </div>
                
                <div class="flex items-center space-x-4">
                    <a href="{{ route('member.dashboard') }}" class="text-white hover:text-yellow-300 transition-colors">Dashboard</a>
                    <a href="{{ route('member.profile.show') }}" class="text-white hover:text-yellow-300 transition-colors">Profile</a>
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
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-white mb-2">Benefits</h1>
                    <p class="text-purple-100">Apply for benefits and track your applications</p>
                </div>
                <a href="{{ route('member.benefits.create') }}" class="bg-yellow-400 hover:bg-yellow-500 text-purple-900 font-semibold py-3 px-6 rounded-lg transition-all duration-300 transform hover:scale-105">
                    Apply for Benefits
                </a>
            </div>
        </div>

        <!-- Benefits Summary -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="glass-effect rounded-xl p-6 text-center">
                <div class="text-3xl font-bold text-yellow-400 mb-2">{{ $totalApplications }}</div>
                <div class="text-white text-sm">Total Applications</div>
            </div>
            
            <div class="glass-effect rounded-xl p-6 text-center">
                <div class="text-3xl font-bold text-blue-400 mb-2">{{ $pendingApplications }}</div>
                <div class="text-white text-sm">Pending Review</div>
            </div>
            
            <div class="glass-effect rounded-xl p-6 text-center">
                <div class="text-3xl font-bold text-green-400 mb-2">{{ $approvedApplications }}</div>
                <div class="text-white text-sm">Approved</div>
            </div>
            
            <div class="glass-effect rounded-xl p-6 text-center">
                <div class="text-3xl font-bold text-purple-400 mb-2">₱{{ number_format($totalApprovedAmount, 2) }}</div>
                <div class="text-white text-sm">Total Approved Amount</div>
            </div>
        </div>

        <!-- Available Benefits -->
        <div class="glass-effect rounded-xl p-6 mb-8">
            <h2 class="text-xl font-bold text-white mb-4">Available Benefits</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-white/10 rounded-lg p-4 hover:bg-white/20 transition-all duration-300">
                    <div class="text-2xl mb-2">🏥</div>
                    <h3 class="text-white font-semibold mb-2">Medical Assistance</h3>
                    <p class="text-purple-200 text-sm mb-3">Financial support for medical expenses and hospitalization</p>
                    <div class="text-yellow-400 font-semibold">Up to ₱10,000</div>
                </div>
                
                <div class="bg-white/10 rounded-lg p-4 hover:bg-white/20 transition-all duration-300">
                    <div class="text-2xl mb-2">🎂</div>
                    <h3 class="text-white font-semibold mb-2">Birthday Gift</h3>
                    <p class="text-purple-200 text-sm mb-3">Annual birthday gift for active members</p>
                    <div class="text-yellow-400 font-semibold">₱500</div>
                </div>
                
                <div class="bg-white/10 rounded-lg p-4 hover:bg-white/20 transition-all duration-300">
                    <div class="text-2xl mb-2">⚰️</div>
                    <h3 class="text-white font-semibold mb-2">Burial Assistance</h3>
                    <p class="text-purple-200 text-sm mb-3">Support for funeral and burial expenses</p>
                    <div class="text-yellow-400 font-semibold">Up to ₱15,000</div>
                </div>
                
                <div class="bg-white/10 rounded-lg p-4 hover:bg-white/20 transition-all duration-300">
                    <div class="text-2xl mb-2">🤱</div>
                    <h3 class="text-white font-semibold mb-2">Maternity Benefit</h3>
                    <p class="text-purple-200 text-sm mb-3">Financial assistance for childbirth and maternity needs</p>
                    <div class="text-yellow-400 font-semibold">Up to ₱8,000</div>
                </div>
                
                <div class="bg-white/10 rounded-lg p-4 hover:bg-white/20 transition-all duration-300">
                    <div class="text-2xl mb-2">🚑</div>
                    <h3 class="text-white font-semibold mb-2">Emergency Assistance</h3>
                    <p class="text-purple-200 text-sm mb-3">Quick financial aid for emergency situations</p>
                    <div class="text-yellow-400 font-semibold">Up to ₱5,000</div>
                </div>
                
                <div class="bg-white/10 rounded-lg p-4 hover:bg-white/20 transition-all duration-300">
                    <div class="text-2xl mb-2">🎓</div>
                    <h3 class="text-white font-semibold mb-2">Educational Support</h3>
                    <p class="text-purple-200 text-sm mb-3">Scholarship and educational assistance</p>
                    <div class="text-yellow-400 font-semibold">Up to ₱20,000</div>
                </div>
            </div>
        </div>

        <!-- My Applications -->
        <div class="glass-effect rounded-xl p-6">
            <h2 class="text-xl font-bold text-white mb-4">My Benefit Applications</h2>
            
            @if($benefits->count() > 0)
                <div class="space-y-4">
                    @foreach($benefits as $benefit)
                        <div class="bg-white/10 rounded-lg p-6 hover:bg-white/20 transition-all duration-300">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <div class="flex items-center space-x-3 mb-2">
                                        <h3 class="text-white font-semibold text-lg">{{ $benefit->benefit_type }}</h3>
                                        <span class="px-2 py-1 rounded-full text-xs font-medium
                                            @if($benefit->status === 'approved') bg-green-500/20 text-green-300
                                            @elseif($benefit->status === 'pending') bg-yellow-500/20 text-yellow-300
                                            @elseif($benefit->status === 'rejected') bg-red-500/20 text-red-300
                                            @elseif($benefit->status === 'disbursed') bg-blue-500/20 text-blue-300
                                            @else bg-gray-500/20 text-gray-300 @endif">
                                            {{ ucfirst($benefit->status) }}
                                        </span>
                                    </div>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                                        <div>
                                            <span class="text-purple-200">Amount:</span>
                                            <span class="text-white font-semibold">₱{{ number_format($benefit->requested_amount, 2) }}</span>
                                        </div>
                                        <div>
                                            <span class="text-purple-200">Applied:</span>
                                            <span class="text-white">{{ $benefit->created_at->format('M d, Y') }}</span>
                                        </div>
                                        <div>
                                            <span class="text-purple-200">Last Updated:</span>
                                            <span class="text-white">{{ $benefit->updated_at->format('M d, Y') }}</span>
                                        </div>
                                    </div>
                                    
                                    @if($benefit->description)
                                        <div class="mt-3">
                                            <span class="text-purple-200">Description:</span>
                                            <p class="text-white mt-1">{{ $benefit->description }}</p>
                                        </div>
                                    @endif
                                    
                                    @if($benefit->status === 'rejected' && $benefit->rejection_reason)
                                        <div class="mt-3 p-3 bg-red-500/20 border border-red-500/50 rounded-lg">
                                            <span class="text-red-300 font-semibold">Rejection Reason:</span>
                                            <p class="text-red-200 mt-1">{{ $benefit->rejection_reason }}</p>
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="flex flex-col space-y-2 ml-4">
                                    <button onclick="viewBenefit({{ $benefit->id }})" class="bg-blue-400 hover:bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg transition-all duration-300 text-sm">
                                        View Details
                                    </button>
                                    
                                    @if($benefit->status === 'pending')
                                        <button onclick="cancelBenefit({{ $benefit->id }})" class="bg-red-400 hover:bg-red-500 text-white font-semibold py-2 px-4 rounded-lg transition-all duration-300 text-sm">
                                            Cancel
                                        </button>
                                    @endif
                                    
                                    @if($benefit->status === 'approved' && $benefit->status !== 'disbursed')
                                        <button onclick="claimBenefit({{ $benefit->id }})" class="bg-green-400 hover:bg-green-500 text-white font-semibold py-2 px-4 rounded-lg transition-all duration-300 text-sm">
                                            Claim
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($benefits->hasPages())
                    <div class="mt-6">
                        {{ $benefits->links() }}
                    </div>
                @endif
            @else
                <div class="text-center py-12">
                    <div class="text-6xl mb-4">🎁</div>
                    <div class="text-white text-xl mb-2">No benefit applications yet</div>
                    <div class="text-purple-200 mb-4">Apply for benefits to get started</div>
                    <a href="{{ route('member.benefits.create') }}" class="bg-yellow-400 hover:bg-yellow-500 text-purple-900 font-semibold py-3 px-6 rounded-lg transition-all duration-300 transform hover:scale-105">
                        Apply for Benefits
                    </a>
                </div>
            @endif
        </div>
    </div>

    <script>
        function viewBenefit(id) {
            // Implement modal or redirect to detailed view
            alert('View benefit details for ID: ' + id);
        }

        function cancelBenefit(id) {
            if (confirm('Are you sure you want to cancel this benefit application?')) {
                // Implement cancel functionality
                alert('Cancel benefit application for ID: ' + id);
            }
        }

        function claimBenefit(id) {
            if (confirm('Are you ready to claim this benefit?')) {
                // Implement claim functionality
                alert('Claim benefit for ID: ' + id);
            }
        }
    </script>
</body>
</html>
