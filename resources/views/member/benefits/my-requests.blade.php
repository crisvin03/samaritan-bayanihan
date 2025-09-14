
@extends('member.layouts.app')

@section('title', 'My Benefit Requests')
@section('page-title', 'My Benefit Requests')
@section('page-description', 'Track the status of your benefit applications')

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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-4xl font-bold text-white mb-2 animate-slide-in-left">My Benefit Requests</h1>
                            <p class="text-blue-100 text-xl animate-slide-in-left-delayed">Monitor and track the progress of your benefit applications</p>
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
        <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-6 border border-blue-200 shadow-sm hover:shadow-md transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-blue-700 mb-1">Total Applications</p>
                    <p class="text-3xl font-bold text-blue-900">{{ $benefits->count() }}</p>
                </div>
                <div class="p-3 bg-blue-500 rounded-xl shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
        </div>
        
        <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-2xl p-6 border border-yellow-200 shadow-sm hover:shadow-md transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-yellow-700 mb-1">Pending Review</p>
                    <p class="text-3xl font-bold text-yellow-900">{{ $benefits->where('status', 'pending')->count() }}</p>
                </div>
                <div class="p-3 bg-yellow-500 rounded-xl shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
        
        <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-2xl p-6 border border-green-200 shadow-sm hover:shadow-md transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-green-700 mb-1">Approved</p>
                    <p class="text-3xl font-bold text-green-900">{{ $benefits->where('status', 'approved')->count() }}</p>
                </div>
                <div class="p-3 bg-green-500 rounded-xl shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
        
        <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-2xl p-6 border border-purple-200 shadow-sm hover:shadow-md transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-purple-700 mb-1">Total Approved</p>
                    <p class="text-3xl font-bold text-purple-900">₱{{ number_format($benefits->where('status', 'approved')->sum('requested_amount'), 0) }}</p>
                </div>
                <div class="p-3 bg-purple-500 rounded-xl shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Professional Applications Section -->
    @if($benefits->count() > 0)
        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
            <!-- Section Header -->
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-8 py-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 flex items-center">
                            <svg class="w-7 h-7 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            Application History
                        </h2>
                        <p class="text-gray-600 mt-1">Detailed view of all your benefit applications</p>
                    </div>
                    <div class="flex items-center space-x-3">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 border border-blue-200">
                            {{ $benefits->count() }} Applications
                        </span>
                    </div>
                </div>
            </div>

            <!-- Applications Grid -->
            <div class="p-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-8">
                    @foreach($benefits as $benefit)
                        <div class="group bg-gradient-to-br from-white to-gray-50 rounded-2xl p-6 border border-gray-200 hover:border-blue-300 hover:shadow-xl transition-all duration-500 hover:-translate-y-2 relative overflow-hidden">
                            <!-- Decorative Background -->
                            <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-blue-50 to-transparent rounded-full -translate-y-16 translate-x-16 opacity-50 group-hover:opacity-100 transition-opacity duration-500"></div>
                            
                            <!-- Status Badge -->
                            <div class="flex justify-between items-start mb-6 relative z-10">
                                <div class="flex items-center space-x-3">
                                    <div class="p-2 bg-blue-100 rounded-lg group-hover:bg-blue-200 transition-colors duration-300">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-bold text-gray-900">#APP-{{ str_pad($benefit->id, 4, '0', STR_PAD_LEFT) }}</h3>
                                        <p class="text-sm text-gray-500">{{ $benefit->created_at->format('M d, Y') }}</p>
                                    </div>
                                </div>
                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold shadow-sm
                                    @if($benefit->status === 'approved') bg-green-100 text-green-800 border border-green-200
                                    @elseif($benefit->status === 'pending') bg-yellow-100 text-yellow-800 border border-yellow-200
                                    @elseif($benefit->status === 'rejected') bg-red-100 text-red-800 border border-red-200
                                    @elseif($benefit->status === 'disbursed') bg-blue-100 text-blue-800 border border-blue-200
                                    @else bg-gray-100 text-gray-800 border border-gray-200 @endif">
                                    @if($benefit->status === 'approved')
                                        <svg class="w-3 h-3 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    @elseif($benefit->status === 'pending')
                                        <svg class="w-3 h-3 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                        </svg>
                                    @elseif($benefit->status === 'rejected')
                                        <svg class="w-3 h-3 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                        </svg>
                                    @elseif($benefit->status === 'disbursed')
                                        <svg class="w-3 h-3 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                        </svg>
                                    @endif
                                    {{ ucfirst($benefit->status) }}
                                </span>
                            </div>

                            <!-- Application Details -->
                            <div class="space-y-4 relative z-10">
                                <div class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-600 mb-1">Benefit Type</p>
                                            <p class="text-lg font-bold text-gray-900">{{ ucfirst(str_replace('_', ' ', $benefit->benefit_type)) }}</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-sm font-medium text-gray-600 mb-1">Amount</p>
                                            <p class="text-xl font-bold text-blue-600">₱{{ number_format($benefit->requested_amount, 2) }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between text-sm text-gray-600">
                                    <div class="flex items-center space-x-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <span>Submitted {{ $benefit->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Button -->
                            <div class="mt-6 pt-4 border-t border-gray-200 relative z-10">
                                <a href="{{ route('member.benefits.show', $benefit) }}" class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-300 flex items-center justify-center space-x-2 shadow-lg hover:shadow-xl transform hover:scale-105">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    <span>View Details</span>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Professional Pagination -->
            @if($benefits->hasPages())
                <div class="px-8 py-6 border-t border-gray-200 bg-gray-50">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-600">
                            Showing {{ $benefits->firstItem() }} to {{ $benefits->lastItem() }} of {{ $benefits->total() }} applications
                        </div>
                        <div class="flex items-center space-x-3">
                            @if($benefits->previousPageUrl())
                                <a href="{{ $benefits->previousPageUrl() }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors duration-200 shadow-sm">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                    </svg>
                                    Previous
                                </a>
                            @endif
                            
                            <span class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg shadow-sm">
                                Page {{ $benefits->currentPage() }} of {{ $benefits->lastPage() }}
                            </span>
                            
                            @if($benefits->nextPageUrl())
                                <a href="{{ $benefits->nextPageUrl() }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors duration-200 shadow-sm">
                                    Next
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>
    @else
        <!-- Professional Empty State -->
        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
            <div class="text-center py-20 px-8">
                <div class="w-24 h-24 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-full flex items-center justify-center mx-auto mb-8 shadow-lg">
                    <svg class="w-12 h-12 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">No Applications Yet</h3>
                <p class="text-lg text-gray-600 mb-8 max-w-md mx-auto">You haven't submitted any benefit applications yet. Start by exploring our available benefits and submit your first application.</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('member.benefits.index') }}" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Apply for Benefits
                    </a>
                    <a href="{{ route('member.dashboard') }}" class="inline-flex items-center px-8 py-4 bg-white border-2 border-gray-300 hover:border-blue-500 text-gray-700 hover:text-blue-600 font-semibold rounded-xl transition-all duration-300 shadow-sm hover:shadow-md">
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
