@extends('admin.layouts.app')

@section('title', 'Organization Settings')
@section('page-title', 'Organization Settings')
@section('page-description', 'Manage Bayanihan organization settings and policies')

@section('content')
    <!-- Header Section -->
    <div class="mb-8">
        <div class="bg-gradient-to-r from-slate-800 via-blue-900 to-indigo-900 rounded-2xl p-8 text-white relative overflow-hidden">
            <div class="absolute inset-0 bg-black opacity-10"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold mb-2">Organization Settings</h1>
                        <p class="text-blue-100 text-lg">Manage Bayanihan organization settings and policies</p>
                        <div class="mt-4 flex items-center space-x-4">
                            <div class="flex items-center space-x-2">
                                <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                                <span class="text-sm text-blue-100">System Online</span>
                            </div>
                        </div>
                    </div>
                    <div class="hidden md:block">
                        <div class="w-24 h-24 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Decorative elements -->
            <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-5 rounded-full -translate-y-16 translate-x-16"></div>
            <div class="absolute bottom-0 left-0 w-24 h-24 bg-white opacity-5 rounded-full translate-y-12 -translate-x-12"></div>
        </div>
    </div>

    <!-- Organization Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Members -->
        <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-gradient-to-br from-blue-400 to-blue-500 rounded-xl shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <span class="text-sm text-gray-500">Total Members</span>
            </div>
            <h3 class="text-2xl font-bold text-gray-900">{{ number_format($orgStats['total_members']) }}</h3>
            <p class="text-sm text-gray-600 mt-1">Registered Members</p>
        </div>

        <!-- Total Contributions -->
        <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-gradient-to-br from-green-400 to-green-500 rounded-xl shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                </div>
                <span class="text-sm text-gray-500">Total Contributions</span>
            </div>
            <h3 class="text-2xl font-bold text-gray-900">₱{{ number_format($orgStats['total_contribution_amount'], 2) }}</h3>
            <p class="text-sm text-gray-600 mt-1">Total Amount</p>
        </div>

        <!-- Pending Benefits -->
        <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-gradient-to-br from-orange-400 to-orange-500 rounded-xl shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <span class="text-sm text-gray-500">Pending Benefits</span>
            </div>
            <h3 class="text-2xl font-bold text-gray-900">{{ number_format($orgStats['pending_benefits']) }}</h3>
            <p class="text-sm text-gray-600 mt-1">Awaiting Approval</p>
        </div>

        <!-- Treasurers -->
        <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-gradient-to-br from-purple-400 to-purple-500 rounded-xl shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <span class="text-sm text-gray-500">Treasurers</span>
            </div>
            <h3 class="text-2xl font-bold text-gray-900">{{ number_format($orgStats['total_treasurers']) }}</h3>
            <p class="text-sm text-gray-600 mt-1">Barangay Treasurers</p>
        </div>
    </div>

    <!-- Organization Settings -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Organization Information -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-4 border-b border-gray-100">
                <h2 class="text-xl font-bold text-gray-800 flex items-center">
                    <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    Organization Information
                </h2>
            </div>
            <div class="p-6">
                <form method="POST" action="{{ route('admin.settings.update') }}">
                    @csrf
                    @method('PUT')
                    <div class="space-y-4">
                        <div>
                            <label for="organization_name" class="block text-sm font-medium text-gray-700 mb-2">Organization Name</label>
                            <input type="text" id="organization_name" name="organization_name" value="Samaritan Bayanihan Inc." class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="organization_address" class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                            <textarea id="organization_address" name="organization_address" rows="3" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">123 Main Street, Barangay Center, City, Province</textarea>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="organization_phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                                <input type="text" id="organization_phone" name="organization_phone" value="+63 123 456 7890" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label for="organization_email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                                <input type="email" id="organization_email" name="organization_email" value="info@samaritanbayanihan.com" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-3 rounded-lg font-medium transition-colors duration-200">
                            Update Organization Info
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Bayanihan Policies -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-green-50 to-emerald-50 px-6 py-4 border-b border-gray-100">
                <h2 class="text-xl font-bold text-gray-800 flex items-center">
                    <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                    Bayanihan Policies
                </h2>
            </div>
            <div class="p-6">
                <form method="POST" action="{{ route('admin.settings.update') }}">
                    @csrf
                    @method('PUT')
                    <div class="space-y-4">
                        <div>
                            <label for="minimum_contribution" class="block text-sm font-medium text-gray-700 mb-2">Minimum Contribution Amount</label>
                            <input type="number" id="minimum_contribution" name="minimum_contribution" value="10" step="0.01" min="0" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                        </div>
                        <div>
                            <label for="maximum_benefit_amount" class="block text-sm font-medium text-gray-700 mb-2">Maximum Benefit Amount</label>
                            <input type="number" id="maximum_benefit_amount" name="maximum_benefit_amount" value="50000" step="0.01" min="0" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                        </div>
                        <div>
                            <label for="benefit_processing_days" class="block text-sm font-medium text-gray-700 mb-2">Benefit Processing Days</label>
                            <select id="benefit_processing_days" name="benefit_processing_days" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                <option value="3">3 Days</option>
                                <option value="5" selected>5 Days</option>
                                <option value="7">7 Days</option>
                                <option value="10">10 Days</option>
                                <option value="14">14 Days</option>
                            </select>
                        </div>
                        <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-3 rounded-lg font-medium transition-colors duration-200">
                            Update Policies
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden mb-8">
        <div class="bg-gradient-to-r from-purple-50 to-indigo-50 px-6 py-4 border-b border-gray-100">
            <h2 class="text-xl font-bold text-gray-800 flex items-center">
                <svg class="w-5 h-5 text-purple-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
                Recent Activity
            </h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Recent Contributions -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Contributions</h3>
                    <div class="space-y-3">
                        @forelse($recentActivity['recent_contributions'] as $contribution)
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <div>
                                    <div class="font-medium text-gray-900">{{ $contribution->user->name }}</div>
                                    <div class="text-sm text-gray-600">₱{{ number_format($contribution->amount, 2) }}</div>
                                </div>
                                <div class="text-xs text-gray-500">{{ $contribution->created_at->format('M d') }}</div>
                            </div>
                        @empty
                            <div class="text-sm text-gray-500">No recent contributions</div>
                        @endforelse
                    </div>
                </div>

                <!-- Recent Benefits -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Benefits</h3>
                    <div class="space-y-3">
                        @forelse($recentActivity['recent_benefits'] as $benefit)
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <div>
                                    <div class="font-medium text-gray-900">{{ $benefit->user->name }}</div>
                                    <div class="text-sm text-gray-600">{{ ucfirst($benefit->status) }}</div>
                                </div>
                                <div class="text-xs text-gray-500">{{ $benefit->created_at->format('M d') }}</div>
                            </div>
                        @empty
                            <div class="text-sm text-gray-500">No recent benefits</div>
                        @endforelse
                    </div>
                </div>

                <!-- Recent Announcements -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Announcements</h3>
                    <div class="space-y-3">
                        @forelse($recentActivity['recent_announcements'] as $announcement)
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <div>
                                    <div class="font-medium text-gray-900">{{ Str::limit($announcement->title, 20) }}</div>
                                    <div class="text-sm text-gray-600">{{ $announcement->user->name }}</div>
                                </div>
                                <div class="text-xs text-gray-500">{{ $announcement->created_at->format('M d') }}</div>
                            </div>
                        @empty
                            <div class="text-sm text-gray-500">No recent announcements</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Monthly Statistics Chart -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-r from-indigo-50 to-blue-50 px-6 py-4 border-b border-gray-100">
            <h2 class="text-xl font-bold text-gray-800 flex items-center">
                <svg class="w-5 h-5 text-indigo-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                Monthly Statistics ({{ now()->year }})
            </h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach($monthlyStats as $month)
                    <div class="text-center p-4 bg-gray-50 rounded-lg">
                        <div class="text-lg font-bold text-gray-900">{{ $month['month'] }}</div>
                        <div class="text-sm text-gray-600 mt-2">
                            <div>Contributions: {{ $month['contributions'] }}</div>
                            <div>Amount: ₱{{ number_format($month['contribution_amount'], 0) }}</div>
                            <div>Benefits: {{ $month['benefits'] }}</div>
                            <div>Members: {{ $month['members'] }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
