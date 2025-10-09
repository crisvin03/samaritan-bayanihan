@extends('member.layouts.app')

@section('title', 'My Profile')
@section('page-title', 'My Profile')
@section('page-description', 'Manage your personal information and account settings')

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
    <!-- Premium Header Section with Animation -->
    <div class="mb-4 sm:mb-6 lg:mb-8 xl:mb-12 animate-fade-in">
        <div class="relative bg-gradient-to-br from-slate-900 via-blue-900 to-indigo-900 rounded-xl sm:rounded-2xl lg:rounded-3xl p-3 sm:p-4 lg:p-6 xl:p-10 shadow-2xl overflow-hidden">
            <!-- Animated Background Elements -->
            <div class="absolute inset-0 bg-gradient-to-r from-blue-600/20 to-purple-600/20 animate-pulse"></div>
            <div class="absolute top-0 right-0 w-48 h-48 sm:w-64 sm:h-64 lg:w-96 lg:h-96 bg-gradient-to-br from-blue-500/10 to-transparent rounded-full -translate-y-24 sm:-translate-y-32 lg:-translate-y-48 translate-x-24 sm:translate-x-32 lg:translate-x-48 animate-float"></div>
            <div class="absolute bottom-0 left-0 w-40 h-40 sm:w-56 sm:h-56 lg:w-80 lg:h-80 bg-gradient-to-tr from-purple-500/10 to-transparent rounded-full translate-y-20 sm:translate-y-28 lg:translate-y-40 -translate-x-20 sm:-translate-x-28 lg:-translate-x-40 animate-float-delayed"></div>
            
            <div class="relative z-10">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between space-y-4 sm:space-y-0">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center space-y-3 sm:space-y-0 sm:space-x-4 lg:space-x-6">
                        <div class="w-12 h-12 sm:w-16 sm:h-16 lg:w-20 lg:h-20 bg-gradient-to-br from-white/20 to-white/10 backdrop-blur-sm rounded-2xl sm:rounded-3xl flex items-center justify-center shadow-2xl animate-bounce-gentle">
                            <svg class="w-6 h-6 sm:w-8 sm:h-8 lg:w-10 lg:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h1 class="text-xl sm:text-2xl lg:text-3xl xl:text-4xl font-bold text-white mb-1 sm:mb-2 animate-slide-in-left">My Profile</h1>
                            <p class="text-blue-100 text-xs sm:text-sm lg:text-base xl:text-xl animate-slide-in-left-delayed leading-tight">Manage your personal information and account settings</p>
                        </div>
                    </div>
                    <div class="hidden sm:flex items-center space-x-4 lg:space-x-8 animate-slide-in-right">
                        <div class="text-right">
                            <div class="text-xs sm:text-sm font-medium text-white">{{ now()->format('l, M d, Y') }}</div>
                            <div class="text-xs text-blue-200">{{ now()->format('H:i A') }}</div>
                        </div>
                        <div class="w-12 h-12 sm:w-14 sm:h-14 lg:w-16 lg:h-16 bg-white/10 backdrop-blur-sm rounded-xl sm:rounded-2xl flex items-center justify-center shadow-xl">
                            <svg class="w-6 h-6 sm:w-7 sm:h-7 lg:w-8 lg:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Premium Profile Card with Animations -->
    <div class="bg-white rounded-2xl sm:rounded-3xl shadow-2xl border border-gray-100 overflow-hidden animate-slide-in-up">
        <div class="bg-gradient-to-r from-slate-50 via-blue-50 to-indigo-50 px-4 sm:px-6 lg:px-10 py-4 sm:py-6 lg:py-8 border-b border-gray-100">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between space-y-2 sm:space-y-0">
                <div class="flex-1 min-w-0">
                    <h2 class="text-lg sm:text-xl lg:text-2xl xl:text-3xl font-bold text-gray-900 mb-1 sm:mb-2 animate-fade-in">Profile Information</h2>
                    <p class="text-gray-600 text-xs sm:text-sm lg:text-base xl:text-lg animate-fade-in-delayed leading-tight">View and manage your personal details</p>
                </div>
                <div class="hidden sm:flex items-center space-x-2 lg:space-x-3 animate-pulse">
                    <div class="w-2 h-2 sm:w-3 sm:h-3 bg-green-500 rounded-full animate-ping"></div>
                    <span class="text-xs sm:text-sm font-medium text-gray-700">Profile Active</span>
                </div>
            </div>
        </div>
        
        <div class="p-3 sm:p-4 lg:p-6">
            <!-- Success Messages -->
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg" id="successMessage">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ session('error') }}
                    </div>
                </div>
            @endif

            <!-- Profile Picture and Name Section -->
            <div class="flex flex-col sm:flex-row items-center sm:items-start space-y-3 sm:space-y-0 sm:space-x-4 lg:space-x-6 mb-4 sm:mb-6 lg:mb-8 animate-card-float">
                <div class="relative group flex-shrink-0">
                    <div class="w-16 h-16 sm:w-20 sm:h-20 lg:w-24 lg:h-24 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg sm:rounded-xl lg:rounded-2xl flex items-center justify-center shadow-xl group-hover:scale-105 transition-transform duration-300">
                        <span class="text-sm sm:text-lg lg:text-xl xl:text-2xl font-bold text-white">{{ substr(auth()->user()->name, 0, 1) }}</span>
                    </div>
                    <button class="absolute bottom-0 right-0 sm:bottom-1 sm:right-1 w-5 h-5 sm:w-6 sm:h-6 lg:w-8 lg:h-8 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-md sm:rounded-lg lg:rounded-xl flex items-center justify-center shadow-lg hover:scale-110 transition-all duration-300">
                        <svg class="w-2.5 h-2.5 sm:w-3 sm:h-3 lg:w-4 lg:h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </button>
                </div>
                <div class="flex-1 w-full sm:w-auto min-w-0">
                    <div class="bg-gradient-to-r from-gray-50 to-blue-50 rounded-lg sm:rounded-xl p-3 sm:p-4 border border-gray-200">
                        <h3 class="text-base sm:text-lg lg:text-xl font-bold text-gray-900 mb-1 truncate">{{ auth()->user()->name }}</h3>
                        @if(auth()->user()->verification_status === 'approved')
                            <div class="flex items-center space-x-2">
                                <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                <p class="text-gray-600 text-xs sm:text-sm font-medium">Member since {{ auth()->user()->created_at->format('M d, Y') }}</p>
                            </div>
                        @else
                            <div class="flex items-center space-x-2">
                                <div class="w-2 h-2 bg-red-500 rounded-full"></div>
                                <p class="text-red-600 text-xs sm:text-sm font-medium">Member Not Verified</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Contact Information Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-4 lg:gap-6 mb-4 sm:mb-6 lg:mb-8">
                <!-- Email -->
                <div class="group bg-gradient-to-br from-white to-blue-50/30 rounded-md sm:rounded-lg lg:rounded-xl p-2.5 sm:p-3 lg:p-4 border border-blue-100 hover:border-blue-300 hover:shadow-xl transition-all duration-500 transform hover:-translate-y-1 animate-card-float">
                    <div class="flex items-center space-x-2 mb-2">
                        <div class="w-6 h-6 sm:w-8 sm:h-8 lg:w-10 lg:h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-md flex items-center justify-center shadow-lg">
                            <svg class="w-3 h-3 sm:w-4 sm:h-4 lg:w-5 lg:h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-xs font-semibold text-blue-600 uppercase tracking-wide">Email Address</h4>
                        </div>
                    </div>
                    <p class="text-xs sm:text-sm font-medium text-gray-900 break-all leading-tight">{{ auth()->user()->email }}</p>
                </div>

                <!-- Phone -->
                <div class="group bg-gradient-to-br from-white to-green-50/30 rounded-md sm:rounded-lg lg:rounded-xl p-2.5 sm:p-3 lg:p-4 border border-green-100 hover:border-green-300 hover:shadow-xl transition-all duration-500 transform hover:-translate-y-1 animate-card-float-delayed">
                    <div class="flex items-center space-x-2 mb-2">
                        <div class="w-6 h-6 sm:w-8 sm:h-8 lg:w-10 lg:h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-md flex items-center justify-center shadow-lg">
                            <svg class="w-3 h-3 sm:w-4 sm:h-4 lg:w-5 lg:h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-xs font-semibold text-green-600 uppercase tracking-wide">Phone Number</h4>
                        </div>
                    </div>
                    <p class="text-xs sm:text-sm font-medium text-gray-900 leading-tight">{{ auth()->user()->phone_number ?? 'Not provided' }}</p>
                </div>

                <!-- Date of Birth -->
                <div class="group bg-gradient-to-br from-white to-pink-50/30 rounded-md sm:rounded-lg lg:rounded-xl p-2.5 sm:p-3 lg:p-4 border border-pink-100 hover:border-pink-300 hover:shadow-xl transition-all duration-500 transform hover:-translate-y-1 animate-card-float">
                    <div class="flex items-center space-x-2 mb-2">
                        <div class="w-6 h-6 sm:w-8 sm:h-8 lg:w-10 lg:h-10 bg-gradient-to-br from-pink-500 to-pink-600 rounded-md flex items-center justify-center shadow-lg">
                            <svg class="w-3 h-3 sm:w-4 sm:h-4 lg:w-5 lg:h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-xs font-semibold text-pink-600 uppercase tracking-wide">Date of Birth</h4>
                        </div>
                    </div>
                    <p class="text-xs sm:text-sm font-medium text-gray-900 leading-tight">{{ auth()->user()->birth_date ? \Carbon\Carbon::parse(auth()->user()->birth_date)->format('M d, Y') : 'Not provided' }}</p>
                </div>

                <!-- Address -->
                <div class="group bg-gradient-to-br from-white to-purple-50/30 rounded-md sm:rounded-lg lg:rounded-xl p-2.5 sm:p-3 lg:p-4 border border-purple-100 hover:border-purple-300 hover:shadow-xl transition-all duration-500 transform hover:-translate-y-1 animate-card-float">
                    <div class="flex items-center space-x-2 mb-2">
                        <div class="w-6 h-6 sm:w-8 sm:h-8 lg:w-10 lg:h-10 bg-gradient-to-br from-purple-500 to-purple-600 rounded-md flex items-center justify-center shadow-lg">
                            <svg class="w-3 h-3 sm:w-4 sm:h-4 lg:w-5 lg:h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-xs font-semibold text-purple-600 uppercase tracking-wide">Address</h4>
                        </div>
                    </div>
                    <p class="text-xs sm:text-sm font-medium text-gray-900 leading-tight">{{ auth()->user()->address ?? 'Not provided' }}</p>
                </div>

                <!-- Date of Membership -->
                <div class="group bg-gradient-to-br from-white to-indigo-50/30 rounded-md sm:rounded-lg lg:rounded-xl p-2.5 sm:p-3 lg:p-4 border border-indigo-100 hover:border-indigo-300 hover:shadow-xl transition-all duration-500 transform hover:-translate-y-1 animate-card-float">
                    <div class="flex items-center space-x-2 mb-2">
                        <div class="w-6 h-6 sm:w-8 sm:h-8 lg:w-10 lg:h-10 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-md flex items-center justify-center shadow-lg">
                            <svg class="w-3 h-3 sm:w-4 sm:h-4 lg:w-5 lg:h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-xs font-semibold text-indigo-600 uppercase tracking-wide">Date of Membership</h4>
                        </div>
                    </div>
                    @if(auth()->user()->verification_status === 'approved')
                        <p class="text-xs sm:text-sm font-medium text-gray-900 leading-tight">{{ auth()->user()->created_at->format('M d, Y') }}</p>
                    @else
                        <p class="text-xs sm:text-sm font-medium text-red-600 leading-tight">Not Verified</p>
                    @endif
                </div>

                <!-- Email Verification Status -->
                <div class="group bg-gradient-to-br from-white to-green-50/30 rounded-md sm:rounded-lg lg:rounded-xl p-2.5 sm:p-3 lg:p-4 border border-green-100 hover:border-green-300 hover:shadow-xl transition-all duration-500 transform hover:-translate-y-1 animate-card-float-delayed">
                    <div class="flex items-center space-x-2 mb-2">
                        <div class="w-6 h-6 sm:w-8 sm:h-8 lg:w-10 lg:h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-md flex items-center justify-center shadow-lg">
                            @if(auth()->user()->email_verified_at)
                                <svg class="w-3 h-3 sm:w-4 sm:h-4 lg:w-5 lg:h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            @else
                                <svg class="w-3 h-3 sm:w-4 sm:h-4 lg:w-5 lg:h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            @endif
                        </div>
                        <div>
                            <h4 class="text-xs font-semibold text-green-600 uppercase tracking-wide">Email Status</h4>
                        </div>
                    </div>
                    <p class="text-xs sm:text-sm font-medium leading-tight">
                        @if(auth()->user()->email_verified_at)
                            <span class="text-green-600">✓ Email Verified</span>
                        @else
                            <span class="text-red-600"> Email Not Verified</span>
                        @endif
                    </p>
                </div>

            </div>

            <!-- Document Upload Status Section -->
            @if(auth()->user()->verification_status === 'pending')
            <div class="bg-gradient-to-br from-white to-yellow-50/30 rounded-md sm:rounded-lg lg:rounded-xl p-3 sm:p-4 lg:p-6 border border-yellow-100 hover:border-yellow-300 hover:shadow-xl transition-all duration-500 transform hover:-translate-y-1 animate-card-float mb-4">
                <div class="flex items-center space-x-2 mb-3">
                    <div class="w-6 h-6 sm:w-8 sm:h-8 lg:w-10 lg:h-10 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-md flex items-center justify-center shadow-lg">
                        <svg class="w-3 h-3 sm:w-4 sm:h-4 lg:w-5 lg:h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-xs sm:text-sm lg:text-base font-bold text-gray-900">Document Upload Status</h4>
                        <p class="text-xs text-gray-600 leading-tight">Your documents are under review</p>
                    </div>
                </div>
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3">
                    <div class="flex items-center space-x-2">
                        <div class="w-2 h-2 bg-yellow-500 rounded-full animate-pulse"></div>
                        <p class="text-yellow-700 text-sm font-medium">Documents Submitted - Awaiting Admin Review</p>
                    </div>
                    <p class="text-xs text-yellow-600 mt-1">We'll notify you once your documents have been reviewed.</p>
                </div>
            </div>
            @endif

            <!-- Document Upload Section -->
            @if(auth()->user()->verification_status !== 'approved')
            <div class="bg-gradient-to-br from-white to-gray-50/30 rounded-md sm:rounded-lg lg:rounded-xl p-3 sm:p-4 lg:p-6 border border-gray-100 hover:border-gray-300 hover:shadow-xl transition-all duration-500 transform hover:-translate-y-1 animate-card-float">
                <div class="flex items-center space-x-2 mb-3">
                    <div class="w-6 h-6 sm:w-8 sm:h-8 lg:w-10 lg:h-10 bg-gradient-to-br from-gray-500 to-gray-600 rounded-md flex items-center justify-center shadow-lg">
                        <svg class="w-3 h-3 sm:w-4 sm:h-4 lg:w-5 lg:h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-xs sm:text-sm lg:text-base font-bold text-gray-900">ID/Verification Documents</h4>
                        <p class="text-xs text-gray-600 leading-tight">Upload your identification documents for member verification</p>
                    </div>
                </div>
                
                <form action="{{ route('member.profile.upload-documents') }}" method="POST" enctype="multipart/form-data" id="documentUploadForm">
                    @csrf
                    
                    @if ($errors->any())
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
                            <div class="flex items-center mb-2">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="font-semibold">Please correct the following errors:</span>
                            </div>
                            <ul class="list-disc list-inside space-y-1 text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="border-2 border-dashed border-gray-300 rounded-md sm:rounded-lg lg:rounded-xl p-3 sm:p-4 lg:p-6 text-center hover:border-blue-400 hover:bg-blue-50/30 transition-all duration-300">
                        <svg class="w-8 h-8 sm:w-10 sm:h-10 lg:w-12 lg:h-12 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                    </svg>
                        <p class="text-gray-600 text-xs sm:text-sm mb-1 leading-tight">Click to upload or drag and drop</p>
                        <p class="text-xs text-gray-400">PNG, JPG, PDF up to 10MB each</p>
                        <input type="file" id="documents" name="documents[]" multiple 
                               accept=".jpg,.jpeg,.png,.pdf"
                               class="hidden" required>
                        <button type="button" id="uploadBtn" 
                                class="mt-3 px-4 py-2 bg-blue-500/20 text-blue-600 rounded-lg hover:bg-blue-500/30 transition-colors">
                            Choose Files
                        </button>
                        <div id="fileList" class="mt-3 text-xs text-gray-600"></div>
                    </div>
                    
                    <div class="mt-4 flex justify-end">
                        <button type="submit" id="submitBtn" disabled
                                class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-2 px-4 rounded-lg transition-all duration-300 transform hover:scale-105 shadow-lg disabled:opacity-50 disabled:cursor-not-allowed">
                            Upload Documents
                        </button>
                    </div>
                </form>
            </div>
            @else
            <div class="bg-gradient-to-br from-white to-green-50/30 rounded-md sm:rounded-lg lg:rounded-xl p-3 sm:p-4 lg:p-6 border border-green-100 hover:border-green-300 hover:shadow-xl transition-all duration-500 transform hover:-translate-y-1 animate-card-float">
                <div class="flex items-center space-x-2 mb-3">
                    <div class="w-6 h-6 sm:w-8 sm:h-8 lg:w-10 lg:h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-md flex items-center justify-center shadow-lg">
                        <svg class="w-3 h-3 sm:w-4 sm:h-4 lg:w-5 lg:h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-xs sm:text-sm lg:text-base font-bold text-gray-900">Member Verification Complete</h4>
                        <p class="text-xs text-gray-600 leading-tight">Your documents have been verified and approved</p>
                    </div>
                </div>
                <div class="text-center p-4 bg-green-50 rounded-lg">
                    <p class="text-green-600 text-sm font-medium">✓ You are now a verified member!</p>
                </div>
            </div>
            @endif

            <!-- Online Passbook Section -->
            @if(auth()->user()->verification_status === 'approved')
            <div class="bg-gradient-to-br from-white to-blue-50/30 rounded-md sm:rounded-lg lg:rounded-xl p-3 sm:p-4 lg:p-6 border border-blue-100 hover:border-blue-300 hover:shadow-xl transition-all duration-500 transform hover:-translate-y-1 animate-card-float">
                <div class="flex items-center space-x-2 mb-4">
                    <div class="w-6 h-6 sm:w-8 sm:h-8 lg:w-10 lg:h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-md flex items-center justify-center shadow-lg">
                        <svg class="w-3 h-3 sm:w-4 sm:h-4 lg:w-5 lg:h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-xs sm:text-sm lg:text-base font-bold text-gray-900">Online Passbook</h4>
                        <p class="text-xs text-gray-600 leading-tight">View your digital savings passbook</p>
                    </div>
                </div>
                
                <div class="bg-white border-2 border-gray-200 rounded-lg shadow-lg p-4 text-center">
                    <div class="w-16 h-16 sm:w-20 sm:h-20 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center mx-auto mb-3">
                        <svg class="w-8 h-8 sm:w-10 sm:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h5 class="text-sm font-bold text-gray-900 mb-2">SAMARITAN BAYANIHAN</h5>
                    <p class="text-xs text-gray-600 mb-4">Savings Program with FREE BENEFITS</p>
                    <p class="text-xs text-gray-500 mb-4">Passbook No. #{{ str_pad(auth()->user()->id, 5, '0', STR_PAD_LEFT) }}</p>
                    <a href="{{ route('member.passbook') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white text-xs font-semibold rounded-lg transition-all duration-300 transform hover:scale-105 shadow-lg">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        View Online Passbook
                    </a>
                </div>
            </div>
            @endif

            <!-- Action Buttons -->
            <div class="mt-3 sm:mt-4 lg:mt-6 flex flex-col sm:flex-row justify-end space-y-2 sm:space-y-0 sm:space-x-2 lg:space-x-3">
                <a href="{{ route('member.dashboard') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-3 sm:px-4 lg:px-6 rounded-md sm:rounded-lg transition-all duration-300 transform hover:scale-105 shadow-lg text-center text-xs sm:text-sm lg:text-base">
                    Back to Dashboard
                </a>
                <a href="{{ route('member.profile.edit') }}" class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-2 px-3 sm:px-4 lg:px-6 rounded-md sm:rounded-lg transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl text-center text-xs sm:text-sm lg:text-base">
                    Edit Profile
                </a>
            </div>
        </div>
    </div>

    <!-- Document Upload JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-dismiss success message after 3 seconds
            const successMessage = document.getElementById('successMessage');
            if (successMessage) {
                setTimeout(function() {
                    successMessage.style.transition = 'opacity 0.5s ease-out';
                    successMessage.style.opacity = '0';
                    setTimeout(function() {
                        successMessage.remove();
                    }, 500);
                }, 3000);
            }
            const uploadBtn = document.getElementById('uploadBtn');
            const fileInput = document.getElementById('documents');
            const fileList = document.getElementById('fileList');
            const submitBtn = document.getElementById('submitBtn');
            
            if (uploadBtn && fileInput && fileList && submitBtn) {
                uploadBtn.addEventListener('click', function() {
                    fileInput.click();
                });
                
                fileInput.addEventListener('change', function() {
                    const files = Array.from(this.files);
                    fileList.innerHTML = '';
                    
                    if (files.length === 0) {
                        fileList.innerHTML = '<p class="text-gray-400">No files selected</p>';
                        submitBtn.disabled = true;
                        return;
                    }
                    
                    files.forEach((file, index) => {
                        const fileItem = document.createElement('div');
                        fileItem.className = 'flex items-center justify-between bg-white/50 rounded-lg p-2 mb-2';
                        fileItem.innerHTML = `
                            <div class="flex items-center space-x-2">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <span class="text-gray-700 text-xs">${file.name}</span>
                                <span class="text-gray-500 text-xs">(${(file.size / 1024 / 1024).toFixed(2)} MB)</span>
                            </div>
                            <button type="button" class="text-red-500 hover:text-red-700" onclick="removeFile(${index})">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        `;
                        fileList.appendChild(fileItem);
                    });
                    
                    submitBtn.disabled = false;
                });
                
                // Remove file function
                window.removeFile = function(index) {
                    const dt = new DataTransfer();
                    const files = Array.from(fileInput.files);
                    files.splice(index, 1);
                    files.forEach(file => dt.items.add(file));
                    fileInput.files = dt.files;
                    fileInput.dispatchEvent(new Event('change'));
                };
            }
        });
    </script>
@endsection

