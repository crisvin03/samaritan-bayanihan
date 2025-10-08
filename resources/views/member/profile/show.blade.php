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
                        <p class="text-gray-600 text-xs sm:text-sm">Member since {{ auth()->user()->created_at->format('M Y') }}</p>
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
                    <p class="text-xs sm:text-sm font-medium text-gray-900 leading-tight">{{ auth()->user()->created_at->format('M d, Y') }}</p>
                </div>

                <!-- Member Status -->
                <div class="group bg-gradient-to-br from-white to-orange-50/30 rounded-md sm:rounded-lg lg:rounded-xl p-2.5 sm:p-3 lg:p-4 border border-orange-100 hover:border-orange-300 hover:shadow-xl transition-all duration-500 transform hover:-translate-y-1 animate-card-float-delayed">
                    <div class="flex items-center space-x-2 mb-2">
                        <div class="w-6 h-6 sm:w-8 sm:h-8 lg:w-10 lg:h-10 bg-gradient-to-br from-orange-500 to-orange-600 rounded-md flex items-center justify-center shadow-lg">
                            <svg class="w-3 h-3 sm:w-4 sm:h-4 lg:w-5 lg:h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-xs font-semibold text-orange-600 uppercase tracking-wide">Member Status</h4>
                        </div>
                    </div>
                    <p class="text-xs sm:text-sm font-medium text-gray-900 leading-tight">Active Member</p>
                </div>
            </div>

            <!-- Online Passbook Section -->
            <div class="bg-gradient-to-br from-white to-blue-50/30 rounded-md sm:rounded-lg lg:rounded-xl p-3 sm:p-4 lg:p-6 border border-blue-100 hover:border-blue-300 hover:shadow-xl transition-all duration-500 transform hover:-translate-y-1 animate-card-float">
                <div class="flex items-center space-x-2 mb-4">
                    <div class="w-6 h-6 sm:w-8 sm:h-8 lg:w-10 lg:h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-md flex items-center justify-center shadow-lg">
                        <svg class="w-3 h-3 sm:w-4 sm:h-4 lg:w-5 lg:h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-xs sm:text-sm lg:text-base font-bold text-gray-900">Online Passbook</h4>
                        <p class="text-xs text-gray-600 leading-tight">Your digital savings passbook with benefits</p>
                    </div>
                </div>

                <!-- Passbook Design - Two Page Layout -->
                <div class="bg-white border-2 border-gray-200 rounded-lg shadow-lg overflow-hidden">
                    <!-- Passbook Header -->
                    <div class="bg-gradient-to-r from-blue-600 to-blue-700 text-white p-3 sm:p-4">
                        <div class="text-center">
                            <h3 class="text-sm sm:text-base lg:text-lg font-bold">SAMARITAN BAYANIHAN</h3>
                            <p class="text-xs sm:text-sm">Savings Program with FREE BENEFITS</p>
                        </div>
                    </div>

                    <!-- Two Page Layout -->
                    <div class="grid grid-cols-1 lg:grid-cols-2">
                        <!-- Left Page - Vision, Mission, Core Values -->
                        <div class="p-3 sm:p-4 border-r border-gray-200">
                            <!-- Account Number -->
                            <div class="mb-4">
                                <label class="text-xs font-semibold text-gray-600">Account No.</label>
                                <div class="border-b border-gray-300 h-6 flex items-center">
                                    <span class="text-xs font-medium text-gray-900">#{{ str_pad(auth()->user()->id, 6, '0', STR_PAD_LEFT) }}</span>
                                </div>
                            </div>

                            <!-- Photo Placeholder -->
                            <div class="mb-4">
                                <div class="w-16 h-16 sm:w-20 sm:h-20 bg-gray-200 border-2 border-gray-300 rounded flex items-center justify-center mx-auto">
                                    <span class="text-xs font-semibold text-gray-500">2x2</span>
                                </div>
                                <div class="text-center mt-2">
                                    <div class="border-b border-gray-300 h-4 w-24 mx-auto mb-1"></div>
                                    <div class="border-b border-gray-300 h-4 w-24 mx-auto mb-1"></div>
                                    <div class="border-b border-gray-300 h-4 w-24 mx-auto"></div>
                                    <p class="text-xs text-gray-600 mt-1">Signature</p>
                                </div>
                            </div>

                            <!-- Vision -->
                            <div class="mb-3">
                                <h4 class="text-xs font-bold text-gray-900 mb-1">VISION:</h4>
                                <p class="text-xs text-gray-700 leading-relaxed">
                                    We envision a future where savings literacy becomes shared responsibility among Filipino, fostering a financially empowered community that thrives through compassion, service and inclusivity.
                                </p>
                            </div>

                            <!-- Mission -->
                            <div class="mb-3">
                                <h4 class="text-xs font-bold text-gray-900 mb-1">MISSION:</h4>
                                <p class="text-xs text-gray-700 leading-relaxed">
                                    We are dedicated to empowering individuals and communities through BAYANIHAN, enabling every member to achieve economic resilience and independence, imbued with good moral and spiritual values.
                                </p>
                            </div>

                            <!-- Core Values -->
                            <div>
                                <h4 class="text-xs font-bold text-gray-900 mb-1">CORE VALUES:</h4>
                                <div class="space-y-1">
                                    <p class="text-xs text-gray-700"><span class="font-bold">S</span>ervice</p>
                                    <p class="text-xs text-gray-700"><span class="font-bold">B</span>eneficence</p>
                                    <p class="text-xs text-gray-700"><span class="font-bold">I</span>nclusivity</p>
                                </div>
                            </div>
                        </div>

                        <!-- Right Page - Member Info and Benefits -->
                        <div class="p-3 sm:p-4">
                            <!-- Member Information -->
                            <div class="space-y-2 mb-4">
                                <div class="flex justify-between items-center border-b border-gray-200 pb-1">
                                    <span class="text-xs font-semibold text-gray-600">Name of Member:</span>
                                    <span class="text-xs font-medium text-gray-900">{{ auth()->user()->name }}</span>
                                </div>
                                <div class="flex justify-between items-center border-b border-gray-200 pb-1">
                                    <span class="text-xs font-semibold text-gray-600">Date of Membership:</span>
                                    <span class="text-xs font-medium text-gray-900">{{ auth()->user()->created_at->format('M d, Y') }}</span>
                                </div>
                                <div class="flex justify-between items-center border-b border-gray-200 pb-1">
                                    <span class="text-xs font-semibold text-gray-600">Date of Birth:</span>
                                    <span class="text-xs font-medium text-gray-900">{{ auth()->user()->birth_date ? \Carbon\Carbon::parse(auth()->user()->birth_date)->format('M d, Y') : 'Not provided' }}</span>
                                </div>
                                <div class="flex justify-between items-center border-b border-gray-200 pb-1">
                                    <span class="text-xs font-semibold text-gray-600">Contact Number:</span>
                                    <span class="text-xs font-medium text-gray-900">{{ auth()->user()->phone_number ?? 'Not provided' }}</span>
                                </div>
                                <div class="flex justify-between items-center border-b border-gray-200 pb-1">
                                    <span class="text-xs font-semibold text-gray-600">St./Sitio/Purok:</span>
                                    <span class="text-xs font-medium text-gray-900">{{ auth()->user()->address ?? 'Not provided' }}</span>
                                </div>
                                <div class="flex justify-between items-center border-b border-gray-200 pb-1">
                                    <span class="text-xs font-semibold text-gray-600">Barangay:</span>
                                    <span class="text-xs font-medium text-gray-900">{{ auth()->user()->barangay ?? 'Not provided' }}</span>
                                </div>
                                <div class="flex justify-between items-center border-b border-gray-200 pb-1">
                                    <span class="text-xs font-semibold text-gray-600">City/Municipality:</span>
                                    <span class="text-xs font-medium text-gray-900">Sorsogon City</span>
                                </div>
                                <div class="flex justify-between items-center border-b border-gray-200 pb-1">
                                    <span class="text-xs font-semibold text-gray-600">Province:</span>
                                    <span class="text-xs font-medium text-gray-900">Sorsogon</span>
                                </div>
                                <div class="flex justify-between items-center border-b border-gray-200 pb-1">
                                    <span class="text-xs font-semibold text-gray-600">Date Passbook Issued:</span>
                                    <span class="text-xs font-medium text-gray-900">{{ now()->format('M d, Y') }}</span>
                                </div>
                                <div class="flex justify-between items-center border-b border-gray-200 pb-1">
                                    <span class="text-xs font-semibold text-gray-600">Name of Branch Leader:</span>
                                    <span class="text-xs font-medium text-gray-900">Branch Leader</span>
                                </div>
                                <div class="flex justify-between items-center border-b border-gray-200 pb-1">
                                    <span class="text-xs font-semibold text-gray-600">Signature:</span>
                                    <span class="text-xs font-medium text-gray-900">________________</span>
                                </div>
                            </div>

                            <!-- Passbook Number -->
                            <div class="flex justify-between items-center mb-4">
                                <span class="text-xs font-semibold text-gray-600">PASSBOOK NO.</span>
                                <span class="text-sm font-bold text-gray-900">#{{ str_pad(auth()->user()->id, 5, '0', STR_PAD_LEFT) }}</span>
                            </div>

                            <!-- Benefits Section -->
                            <div>
                                <h4 class="text-sm font-bold text-gray-900 mb-2 text-center">MGA BENEPISYO</h4>
                                <p class="text-xs text-gray-600 mb-3 text-center">Sa halagang P10 na savings kada linggo, maaari mong ma-enjoy ang mga sumusunod na BENEPISYO:</p>
                                
                                <div class="grid grid-cols-1 gap-2">
                                    <div class="flex items-start space-x-2">
                                        <div class="w-4 h-4 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                            <svg class="w-2 h-2 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-xs font-semibold text-gray-900">Burial Assistance:</p>
                                            <p class="text-xs text-gray-600">Mula P1,500 hanggang P50,000 na tulong-pinansiyal para sa maayos na paglilibing.</p>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-start space-x-2">
                                        <div class="w-4 h-4 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                            <svg class="w-2 h-2 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-xs font-semibold text-gray-900">Accidental Assistance:</p>
                                            <p class="text-xs text-gray-600">Mula P500 hanggang P10,000 na tulong-pinansiyal sa oras ng aksidente.</p>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-start space-x-2">
                                        <div class="w-4 h-4 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                            <svg class="w-2 h-2 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-xs font-semibold text-gray-900">Hospitalization Benefit:</p>
                                            <p class="text-xs text-gray-600">Mula P500 hanggang P10,000 na panggastos sa ospital.</p>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-start space-x-2">
                                        <div class="w-4 h-4 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                            <svg class="w-2 h-2 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-xs font-semibold text-gray-900">Maternity Benefit:</p>
                                            <p class="text-xs text-gray-600">Mula P500 hanggang P1,500 na tulong-pinansiyal para sa mga ina.</p>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-start space-x-2">
                                        <div class="w-4 h-4 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                            <svg class="w-2 h-2 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-xs font-semibold text-gray-900">Animal Bite Benefits:</p>
                                            <p class="text-xs text-gray-600">Nagkakahalaga ng P300 pesos na tulong-pinansiyal para sa mga kaso ng kagat ng hayop.</p>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-start space-x-2">
                                        <div class="w-4 h-4 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                            <svg class="w-2 h-2 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-xs font-semibold text-gray-900">Birthday Cake o Cash Gift:</p>
                                            <p class="text-xs text-gray-600">Nagkakahalaga ng P300 pesos na regalo tuwing kaarawan.</p>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-start space-x-2">
                                        <div class="w-4 h-4 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                            <svg class="w-2 h-2 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-xs font-semibold text-gray-900">Outpatient Benefit:</p>
                                            <p class="text-xs text-gray-600">Nagkakahalaga ng P200 pesos na benepisyo para sa mga outpatient o hindi na-ospital.</p>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-start space-x-2">
                                        <div class="w-4 h-4 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                            <svg class="w-2 h-2 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>
                                        </div>
                                        <div>
                                            <p class="text-xs font-semibold text-gray-900">Walang Age Limit:</p>
                                            <p class="text-xs text-gray-600">Lahat ay pwede maging miyembro mapa bata man o matanda.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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
@endsection

