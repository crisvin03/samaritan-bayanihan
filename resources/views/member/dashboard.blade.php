@extends('member.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-description', 'Welcome to your Bayanihan member portal')

@section('content')

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-200">
            <div class="flex items-center">
                <div class="p-3 bg-yellow-100 rounded-lg">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Contributions</p>
                    <p class="text-2xl font-bold text-gray-900">₱{{ number_format($stats['total_contributions'], 2) }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-200">
            <div class="flex items-center">
                <div class="p-3 bg-blue-100 rounded-lg">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Pending Benefits</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['pending_benefits'] }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-200">
            <div class="flex items-center">
                <div class="p-3 bg-green-100 rounded-lg">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Approved Benefits</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['approved_benefits'] }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-200">
            <div class="flex items-center">
                <div class="p-3 bg-purple-100 rounded-lg">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Disbursed Benefits</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['disbursed_benefits'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Recent Contributions -->
        <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-200">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Recent Contributions</h2>
            @if($recent_contributions->count() > 0)
                <div class="space-y-3">
                    @foreach($recent_contributions as $contribution)
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="flex justify-between items-center">
                                <div>
                                    <div class="text-gray-900 font-medium">₱{{ number_format($contribution->amount, 2) }}</div>
                                    <div class="text-gray-600 text-sm">{{ $contribution->contribution_date->format('M d, Y') }}</div>
                                </div>
                                <div class="text-right">
                                    <span class="px-2 py-1 rounded-full text-xs font-medium
                                        @if($contribution->status === 'validated') bg-green-100 text-green-800
                                        @elseif($contribution->status === 'pending') bg-yellow-100 text-yellow-800
                                        @else bg-gray-100 text-gray-800 @endif">
                                        {{ ucfirst($contribution->status) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <div class="text-gray-500">No contributions yet</div>
                    <div class="text-gray-400 text-sm mt-2">Your contributions will appear here</div>
                </div>
            @endif
        </div>

        <!-- Recent Benefits -->
        <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-200">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Recent Benefits</h2>
            @if($recent_benefits->count() > 0)
                <div class="space-y-3">
                    @foreach($recent_benefits as $benefit)
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="flex justify-between items-center">
                                <div>
                                    <div class="text-gray-900 font-medium">{{ $benefit->benefit_type }}</div>
                                    <div class="text-gray-600 text-sm">₱{{ number_format($benefit->amount, 2) }}</div>
                                </div>
                                <div class="text-right">
                                    <span class="px-2 py-1 rounded-full text-xs font-medium
                                        @if($benefit->status === 'approved') bg-green-100 text-green-800
                                        @elseif($benefit->status === 'pending') bg-yellow-100 text-yellow-800
                                        @elseif($benefit->status === 'disbursed') bg-blue-100 text-blue-800
                                        @else bg-gray-100 text-gray-800 @endif">
                                        {{ ucfirst($benefit->status) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <div class="text-gray-500">No benefits yet</div>
                    <div class="text-gray-400 text-sm mt-2">Your benefit applications will appear here</div>
                </div>
            @endif
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="mt-8">
        <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-200">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Quick Actions</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <a href="{{ route('member.profile.show') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition-all duration-300 transform hover:scale-105 text-center">
                    View Profile
                </a>
                <a href="{{ route('member.benefits.index') }}" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-lg transition-all duration-300 transform hover:scale-105 text-center">
                    Apply for Benefits
                </a>
                <a href="{{ route('member.contributions.index') }}" class="bg-purple-600 hover:bg-purple-700 text-white font-semibold py-3 px-6 rounded-lg transition-all duration-300 transform hover:scale-105 text-center">
                    View Contributions
                </a>
            </div>
        </div>
    </div>
@endsection
