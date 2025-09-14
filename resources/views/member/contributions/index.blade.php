@extends('member.layouts.app')

@section('title', 'My Contributions')
@section('page-title', 'My Contributions')
@section('page-description', 'View your contribution history and payment records')

@push('styles')
<style>
    /* Custom Animations */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    @keyframes slideInLeft {
        from { opacity: 0; transform: translateX(-30px); }
        to { opacity: 1; transform: translateX(0); }
    }
    
    @keyframes slideInRight {
        from { opacity: 0; transform: translateX(30px); }
        to { opacity: 1; transform: translateX(0); }
    }
    
    @keyframes slideInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-10px) rotate(2deg); }
    }
    
    @keyframes bounceGentle {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-5px); }
    }
    
    @keyframes cardFloat {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-3px); }
    }
    
    .animate-fade-in {
        animation: fadeIn 0.8s ease-out;
    }
    
    .animate-fade-in-delayed {
        animation: fadeIn 0.8s ease-out 0.2s both;
    }
    
    .animate-slide-in-left {
        animation: slideInLeft 0.8s ease-out;
    }
    
    .animate-slide-in-left-delayed {
        animation: slideInLeft 0.8s ease-out 0.3s both;
    }
    
    .animate-slide-in-right {
        animation: slideInRight 0.8s ease-out 0.4s both;
    }
    
    .animate-slide-in-up {
        animation: slideInUp 0.8s ease-out 0.5s both;
    }
    
    .animate-float {
        animation: float 6s ease-in-out infinite;
    }
    
    .animate-float-delayed {
        animation: float 6s ease-in-out infinite 2s;
    }
    
    .animate-bounce-gentle {
        animation: bounceGentle 2s ease-in-out infinite;
    }
    
    .animate-card-float {
        animation: cardFloat 4s ease-in-out infinite;
    }
    
    .animate-card-float-delayed {
        animation: cardFloat 4s ease-in-out infinite 1s;
    }
    
    /* Hover Effects */
    .group:hover .group-hover\:scale-110 {
        transform: scale(1.1);
    }
    
    /* Glassmorphism Effect */
    .backdrop-blur-sm {
        backdrop-filter: blur(4px);
    }
</style>
@endpush

@section('content')
    <!-- Professional Page Header Card -->
    <div class="mb-10">
        <div class="relative bg-gradient-to-br from-slate-900 via-blue-900 to-indigo-900 rounded-3xl p-10 shadow-2xl overflow-hidden">
            <!-- Animated Background Elements -->
            <div class="absolute inset-0 bg-gradient-to-r from-blue-600/20 to-purple-600/20 animate-pulse"></div>
            <div class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-br from-blue-500/10 to-transparent rounded-full -translate-y-48 translate-x-48 animate-float"></div>
            <div class="absolute bottom-0 left-0 w-80 h-80 bg-gradient-to-tr from-purple-500/10 to-transparent rounded-full translate-y-40 -translate-x-40 animate-float-delayed"></div>
            
            <div class="relative z-10">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-6">
                        <div class="w-20 h-20 bg-gradient-to-br from-white/20 to-white/10 backdrop-blur-sm rounded-3xl flex items-center justify-center shadow-2xl animate-bounce-gentle">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-4xl font-bold text-white mb-2 animate-slide-in-left">My Contributions</h1>
                            <p class="text-blue-100 text-xl animate-slide-in-left-delayed">Track your payment history and contribution records</p>
                        </div>
                    </div>
                    <div class="hidden lg:flex items-center space-x-8 animate-slide-in-right">
                        <div class="text-right">
                            <div class="text-sm font-medium text-white">{{ now()->format('l, M d, Y') }}</div>
                            <div class="text-xs text-blue-200">{{ now()->format('H:i A') }}</div>
                        </div>
                        <div class="w-16 h-16 bg-white/10 backdrop-blur-sm rounded-2xl flex items-center justify-center shadow-xl">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Professional Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
        <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-2xl p-6 border border-green-200 shadow-sm hover:shadow-md transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-green-700 mb-1">Total Contributions</p>
                    <p class="text-3xl font-bold text-green-900">{{ $contributions->count() }}</p>
                </div>
                <div class="p-3 bg-green-500 rounded-xl shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                </div>
            </div>
        </div>
        
        <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-6 border border-blue-200 shadow-sm hover:shadow-md transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-blue-700 mb-1">Validated</p>
                    <p class="text-3xl font-bold text-blue-900">{{ $contributions->where('status', 'validated')->count() }}</p>
                </div>
                <div class="p-3 bg-blue-500 rounded-xl shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
        
        <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-2xl p-6 border border-yellow-200 shadow-sm hover:shadow-md transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-yellow-700 mb-1">Pending</p>
                    <p class="text-3xl font-bold text-yellow-900">{{ $contributions->where('status', 'pending')->count() }}</p>
                </div>
                <div class="p-3 bg-yellow-500 rounded-xl shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
        
        <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-2xl p-6 border border-purple-200 shadow-sm hover:shadow-md transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-purple-700 mb-1">Total Amount</p>
                    <p class="text-3xl font-bold text-purple-900">₱{{ number_format($totalContributions, 0) }}</p>
                </div>
                <div class="p-3 bg-purple-500 rounded-xl shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Professional Search and Filter Section -->
    <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden mb-8">
        <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-8 py-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 flex items-center">
                        <svg class="w-7 h-7 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Search & Filter
                    </h2>
                    <p class="text-gray-600 mt-1">Find specific contributions using filters</p>
                </div>
            </div>
        </div>
        
        <div class="p-8">
            <form method="GET" action="{{ route('member.contributions.index') }}" class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">Search by Reference</label>
                    <div class="relative">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Enter reference number..." class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                        <svg class="absolute left-3 top-3.5 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">From Date</label>
                    <div class="relative">
                        <input type="date" name="from_date" value="{{ request('from_date') }}" class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                        <svg class="absolute left-3 top-3.5 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">To Date</label>
                    <div class="relative">
                        <input type="date" name="to_date" value="{{ request('to_date') }}" class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                        <svg class="absolute left-3 top-3.5 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Professional Contributions Section -->
    @if($contributions->count() > 0)
        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
            <!-- Section Header -->
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-8 py-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 flex items-center">
                            <svg class="w-7 h-7 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            Contribution History
                        </h2>
                        <p class="text-gray-600 mt-1">Complete record of all your contributions</p>
                    </div>
                    <div class="flex items-center space-x-3">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 border border-green-200">
                            {{ $contributions->count() }} Records
                        </span>
                    </div>
                </div>
            </div>

            <!-- Professional Table -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                        <tr>
                            <th class="text-left py-6 px-8 font-bold text-gray-900 text-sm uppercase tracking-wider">Date</th>
                            <th class="text-left py-6 px-8 font-bold text-gray-900 text-sm uppercase tracking-wider">Amount</th>
                            <th class="text-left py-6 px-8 font-bold text-gray-900 text-sm uppercase tracking-wider">Payment Method</th>
                            <th class="text-left py-6 px-8 font-bold text-gray-900 text-sm uppercase tracking-wider">Status</th>
                            <th class="text-left py-6 px-8 font-bold text-gray-900 text-sm uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($contributions as $contribution)
                            <tr class="hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-300 group">
                                <td class="py-6 px-8">
                                    <div class="flex items-center space-x-3">
                                        <div class="p-2 bg-blue-100 rounded-lg group-hover:bg-blue-200 transition-colors duration-300">
                                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-gray-900 font-semibold">{{ $contribution->contribution_date->format('M d, Y') }}</p>
                                            <p class="text-sm text-gray-500">{{ $contribution->contribution_date->format('l') }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-6 px-8">
                                    <div class="text-right">
                                        <p class="text-2xl font-bold text-green-600">₱{{ number_format($contribution->amount, 0) }}</p>
                                        <p class="text-sm text-gray-500">Contribution</p>
                                    </div>
                                </td>
                                <td class="py-6 px-8">
                                    <div class="flex items-center space-x-2">
                                        <div class="p-1.5 bg-gray-100 rounded-lg">
                                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                            </svg>
                                        </div>
                                        <span class="text-gray-900 font-medium">{{ ucfirst($contribution->payment_method) }}</span>
                                    </div>
                                </td>
                                <td class="py-6 px-8">
                                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold shadow-sm
                                        @if($contribution->status === 'validated') bg-green-100 text-green-800 border border-green-200
                                        @elseif($contribution->status === 'pending') bg-yellow-100 text-yellow-800 border border-yellow-200
                                        @elseif($contribution->status === 'rejected') bg-red-100 text-red-800 border border-red-200
                                        @else bg-gray-100 text-gray-800 border border-gray-200 @endif">
                                        @if($contribution->status === 'validated')
                                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                        @elseif($contribution->status === 'pending')
                                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                            </svg>
                                        @elseif($contribution->status === 'rejected')
                                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                            </svg>
                                        @endif
                                        {{ ucfirst($contribution->status) }}
                                    </span>
                                </td>
                                <td class="py-6 px-8">
                                    <button class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-all duration-300 shadow-sm hover:shadow-md transform hover:scale-105">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        View
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Professional Summary and Pagination -->
            <div class="px-8 py-6 border-t border-gray-200 bg-gradient-to-r from-gray-50 to-gray-100">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-6">
                        <div class="text-sm text-gray-600">
                            Showing {{ $contributions->firstItem() }} to {{ $contributions->lastItem() }} of {{ $contributions->total() }} contributions
                        </div>
                        <div class="text-sm">
                            <span class="font-semibold text-gray-700">Total This Year: </span>
                            <span class="text-2xl font-bold text-green-600">₱{{ number_format($totalContributions, 0) }}</span>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        @if($contributions->hasPages())
                            @if($contributions->previousPageUrl())
                                <a href="{{ $contributions->previousPageUrl() }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors duration-200 shadow-sm">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                    </svg>
                                    Previous
                                </a>
                            @endif
                            
                            <span class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg shadow-sm">
                                Page {{ $contributions->currentPage() }} of {{ $contributions->lastPage() }}
                            </span>
                            
                            @if($contributions->nextPageUrl())
                                <a href="{{ $contributions->nextPageUrl() }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors duration-200 shadow-sm">
                                    Next
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Professional Empty State -->
        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
            <div class="text-center py-20 px-8">
                <div class="w-24 h-24 bg-gradient-to-br from-green-100 to-emerald-100 rounded-full flex items-center justify-center mx-auto mb-8 shadow-lg">
                    <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">No Contributions Found</h3>
                <p class="text-lg text-gray-600 mb-8 max-w-md mx-auto">You haven't made any contributions yet. Start contributing to access our benefits and support the community.</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('member.dashboard') }}" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-semibold rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Make Contribution
                    </a>
                    <a href="{{ route('member.dashboard') }}" class="inline-flex items-center px-8 py-4 bg-white border-2 border-gray-300 hover:border-green-500 text-gray-700 hover:text-green-600 font-semibold rounded-xl transition-all duration-300 shadow-sm hover:shadow-md">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v2H8V5z"></path>
                        </svg>
                        Go to Dashboard
                    </a>
                </div>
            </div>
        </div>
    @endif
@endsection
