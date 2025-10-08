@extends('member.layouts.app')

@section('title', 'Benefits Management')
@section('page-title', 'Benefits Management')
@section('page-description', 'Manage your benefit applications and track their status')

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
    <div class="mb-12 animate-fade-in">
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-4xl font-bold text-white mb-2 animate-slide-in-left">Benefits Management</h1>
                            <p class="text-blue-100 text-xl animate-slide-in-left-delayed">Access comprehensive benefits with professional support</p>
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


    <!-- Premium Benefits Grid with Animations -->
    <div class="bg-white rounded-3xl shadow-2xl border border-gray-100 overflow-hidden animate-slide-in-up">
        <div class="bg-gradient-to-r from-slate-50 via-blue-50 to-indigo-50 px-10 py-8 border-b border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-2 animate-fade-in">Available Benefits</h2>
                    <p class="text-gray-600 text-lg animate-fade-in-delayed">Choose from our comprehensive range of professional benefits</p>
                </div>
                <div class="hidden md:flex items-center space-x-3 animate-pulse">
                    <div class="w-3 h-3 bg-green-500 rounded-full animate-ping"></div>
                    <span class="text-sm font-medium text-gray-700">All systems operational</span>
                </div>
            </div>
        </div>
        
        <div class="p-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Hospitalization Benefit -->
                <div class="group bg-gradient-to-br from-white to-blue-50/30 rounded-2xl p-8 border border-blue-100 hover:border-blue-300 hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 animate-card-float">
                    <div class="flex items-center justify-between mb-6">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <div class="text-right">
                            <div class="text-xs text-blue-600 uppercase tracking-wide font-semibold bg-blue-100 px-3 py-1 rounded-full">Medical</div>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors">Hospitalization</h3>
                    <p class="text-gray-600 text-sm mb-6 leading-relaxed">Comprehensive financial assistance for hospital expenses and medical treatments</p>
                    <div class="flex items-center justify-between">
                        <span class="text-lg font-bold text-blue-600">₱500 - ₱10,000</span>
                        <a href="{{ route('member.benefits.create', ['type' => 'hospitalization']) }}" class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold px-6 py-3 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                            Apply Now
                        </a>
                    </div>
                </div>
                
                <!-- Burial Assistance -->
                <div class="group bg-gradient-to-br from-white to-gray-50/30 rounded-2xl p-8 border border-gray-100 hover:border-gray-300 hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 animate-card-float-delayed">
                    <div class="flex items-center justify-between mb-6">
                        <div class="w-16 h-16 bg-gradient-to-br from-gray-500 to-gray-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </div>
                        <div class="text-right">
                            <div class="text-xs text-gray-600 uppercase tracking-wide font-semibold bg-gray-100 px-3 py-1 rounded-full">Support</div>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-gray-600 transition-colors">Burial Assistance</h3>
                    <p class="text-gray-600 text-sm mb-6 leading-relaxed">Compassionate financial support for funeral and burial expenses</p>
                    <div class="flex items-center justify-between">
                        <span class="text-lg font-bold text-gray-600">₱1,500 - ₱50,000</span>
                        <a href="{{ route('member.benefits.create', ['type' => 'burial']) }}" class="bg-gradient-to-r from-gray-600 to-gray-700 hover:from-gray-700 hover:to-gray-800 text-white font-semibold px-6 py-3 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                            Apply Now
                        </a>
                    </div>
                </div>
                
                <!-- Animal Bite Assistance -->
                <div class="group bg-gradient-to-br from-white to-orange-50/30 rounded-2xl p-8 border border-orange-100 hover:border-orange-300 hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 animate-card-float">
                    <div class="flex items-center justify-between mb-6">
                        <div class="w-16 h-16 bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V8a2 2 0 012-2V6"></path>
                            </svg>
                        </div>
                        <div class="text-right">
                            <div class="text-xs text-orange-600 uppercase tracking-wide font-semibold bg-orange-100 px-3 py-1 rounded-full">Emergency</div>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-orange-600 transition-colors">Animal Bite</h3>
                    <p class="text-gray-600 text-sm mb-6 leading-relaxed">Immediate financial aid for animal bite incidents and treatment</p>
                    <div class="flex items-center justify-between">
                        <span class="text-lg font-bold text-orange-600">₱300</span>
                        <a href="{{ route('member.benefits.create', ['type' => 'animal_bite']) }}" class="bg-gradient-to-r from-orange-600 to-orange-700 hover:from-orange-700 hover:to-orange-800 text-white font-semibold px-6 py-3 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                            Apply Now
                        </a>
                    </div>
                </div>
                
                <!-- Accidental Assistance -->
                <div class="group bg-gradient-to-br from-white to-red-50/30 rounded-2xl p-8 border border-red-100 hover:border-red-300 hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 animate-card-float-delayed">
                    <div class="flex items-center justify-between mb-6">
                        <div class="w-16 h-16 bg-gradient-to-br from-red-500 to-red-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4a2 2 0 012 2v2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V9a2 2 0 00-2-2h-2"></path>
                            </svg>
                        </div>
                        <div class="text-right">
                            <div class="text-xs text-red-600 uppercase tracking-wide font-semibold bg-red-100 px-3 py-1 rounded-full">Emergency</div>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-red-600 transition-colors">Accidental</h3>
                    <p class="text-gray-600 text-sm mb-6 leading-relaxed">Comprehensive financial support for accident-related expenses</p>
                    <div class="flex items-center justify-between">
                        <span class="text-lg font-bold text-red-600">₱500 - ₱10,000</span>
                        <a href="{{ route('member.benefits.create', ['type' => 'accidental']) }}" class="bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-semibold px-6 py-3 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                            Apply Now
                        </a>
                    </div>
                </div>

                <!-- Outpatient Benefit -->
                <div class="group bg-gradient-to-br from-white to-green-50/30 rounded-2xl p-8 border border-green-100 hover:border-green-300 hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 animate-card-float">
                    <div class="flex items-center justify-between mb-6">
                        <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <div class="text-right">
                            <div class="text-xs text-green-600 uppercase tracking-wide font-semibold bg-green-100 px-3 py-1 rounded-full">Medical</div>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-green-600 transition-colors">Outpatient</h3>
                    <p class="text-gray-600 text-sm mb-6 leading-relaxed">Support for non-hospitalized medical consultations and treatments</p>
                    <div class="flex items-center justify-between">
                        <span class="text-lg font-bold text-green-600">₱200</span>
                        <a href="{{ route('member.benefits.create', ['type' => 'outpatient']) }}" class="bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-semibold px-6 py-3 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                            Apply Now
                        </a>
                    </div>
                </div>

                <!-- Birthday Gift -->
                <div class="group bg-gradient-to-br from-white to-pink-50/30 rounded-2xl p-8 border border-pink-100 hover:border-pink-300 hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 animate-card-float-delayed">
                    <div class="flex items-center justify-between mb-6">
                        <div class="w-16 h-16 bg-gradient-to-br from-pink-500 to-pink-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </div>
                        <div class="text-right">
                            <div class="text-xs text-pink-600 uppercase tracking-wide font-semibold bg-pink-100 px-3 py-1 rounded-full">Special</div>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-pink-600 transition-colors">Birthday Gift</h3>
                    <p class="text-gray-600 text-sm mb-6 leading-relaxed">Annual birthday gift for active and valued members</p>
                    <div class="flex items-center justify-between">
                        <span class="text-lg font-bold text-pink-600">₱300</span>
                        <a href="{{ route('member.benefits.create', ['type' => 'birthday']) }}" class="bg-gradient-to-r from-pink-600 to-pink-700 hover:from-pink-700 hover:to-pink-800 text-white font-semibold px-6 py-3 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                            Apply Now
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
