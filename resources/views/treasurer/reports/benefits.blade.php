@extends('treasurer.layouts.app')

@section('title', 'Benefit Report')
@section('page-title', 'Benefit Report')
@section('page-description', 'Benefit request statistics and analysis')

@section('content')
    <!-- Professional Page Header Card -->
    <div class="mb-10">
        <div class="relative bg-gradient-to-r from-green-600 via-emerald-600 to-teal-700 rounded-3xl p-10 shadow-2xl overflow-hidden">
            <!-- Animated Background Elements -->
            <div class="absolute inset-0 bg-gradient-to-r from-green-600/20 to-emerald-600/20 animate-pulse"></div>
            <div class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-br from-green-500/10 to-transparent rounded-full -translate-y-48 translate-x-48 animate-float"></div>
            <div class="absolute bottom-0 left-0 w-80 h-80 bg-gradient-to-tr from-emerald-500/10 to-transparent rounded-full translate-y-40 -translate-x-40 animate-float-delayed"></div>
            
            <div class="relative z-10">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-6">
                        <div class="w-20 h-20 bg-gradient-to-br from-white/20 to-white/10 backdrop-blur-sm rounded-3xl flex items-center justify-center shadow-2xl animate-bounce-gentle">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-4xl font-bold text-white mb-2 animate-slide-in-left">Benefit Report</h1>
                            <p class="text-green-100 text-xl animate-slide-in-left-delayed">Benefit insights for {{ $barangay }}</p>
                            <div class="mt-4 flex items-center space-x-2">
                                <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                                <span class="text-sm text-green-100">Benefit Analytics</span>
                            </div>
                        </div>
                    </div>
                    <div class="hidden lg:flex items-center space-x-8 animate-slide-in-right">
                        <div class="text-right">
                            <div class="text-sm font-medium text-white">{{ now()->format('l, M d, Y') }}</div>
                            <div class="text-xs text-green-200">{{ now()->format('H:i A') }}</div>
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

    <!-- Benefit Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Benefits -->
        <div class="group bg-white rounded-2xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300 hover:-translate-y-1 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-purple-50 to-purple-100 rounded-full -translate-y-10 translate-x-10"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-4 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <div class="text-right">
                        <span class="text-sm font-medium text-gray-500">Total Benefits</span>
                    </div>
                </div>
                <h3 class="text-3xl font-bold text-gray-900 mb-2">{{ $benefitStats['total_benefits'] }}</h3>
                <p class="text-sm text-gray-600">All requests</p>
                <div class="mt-3 flex items-center text-xs text-purple-600">
                    <div class="w-2 h-2 bg-purple-400 rounded-full mr-2 animate-pulse"></div>
                    <span>All time</span>
                </div>
            </div>
        </div>

        <!-- Pending Benefits -->
        <div class="group bg-white rounded-2xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300 hover:-translate-y-1 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-yellow-50 to-orange-100 rounded-full -translate-y-10 translate-x-10"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-4 bg-gradient-to-br from-yellow-500 to-orange-500 rounded-2xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="text-right">
                        <span class="text-sm font-medium text-gray-500">Pending</span>
                    </div>
                </div>
                <h3 class="text-3xl font-bold text-gray-900 mb-2">{{ $benefitStats['pending_benefits'] }}</h3>
                <p class="text-sm text-gray-600">Awaiting review</p>
                <div class="mt-3 flex items-center text-xs text-yellow-600">
                    <div class="w-2 h-2 bg-yellow-400 rounded-full mr-2 animate-pulse"></div>
                    <span>Needs attention</span>
                </div>
            </div>
        </div>

        <!-- Approved Benefits -->
        <div class="group bg-white rounded-2xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300 hover:-translate-y-1 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-green-50 to-green-100 rounded-full -translate-y-10 translate-x-10"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-4 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div class="text-right">
                        <span class="text-sm font-medium text-gray-500">Approved</span>
                    </div>
                </div>
                <h3 class="text-3xl font-bold text-gray-900 mb-2">{{ $benefitStats['approved_benefits'] }}</h3>
                <p class="text-sm text-gray-600">Forwarded to admin</p>
                <div class="mt-3 flex items-center text-xs text-green-600">
                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span>Processed</span>
                </div>
            </div>
        </div>

        <!-- Rejected Benefits -->
        <div class="group bg-white rounded-2xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300 hover:-translate-y-1 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-red-50 to-red-100 rounded-full -translate-y-10 translate-x-10"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-4 bg-gradient-to-br from-red-500 to-red-600 rounded-2xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </div>
                    <div class="text-right">
                        <span class="text-sm font-medium text-gray-500">Rejected</span>
                    </div>
                </div>
                <h3 class="text-3xl font-bold text-gray-900 mb-2">{{ $benefitStats['rejected_benefits'] }}</h3>
                <p class="text-sm text-gray-600">Not approved</p>
                <div class="mt-3 flex items-center text-xs text-red-600">
                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                    <span>Declined</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Benefit Type Breakdown -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 mb-8">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-semibold text-gray-900">Benefit Type Breakdown</h3>
            <a href="{{ route('treasurer.benefits.index') }}" class="text-sm text-purple-600 hover:text-purple-800">View all benefits</a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($benefitTypes as $type)
                <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl p-6 border border-purple-200">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <span class="text-2xl font-bold text-purple-600">{{ $type->count }}</span>
                    </div>
                    <h4 class="text-lg font-semibold text-gray-900 mb-2">{{ $type->benefit_type }}</h4>
                    <p class="text-sm text-gray-600">Benefit requests</p>
                    <div class="mt-3 flex items-center text-xs text-purple-600">
                        <div class="w-2 h-2 bg-purple-400 rounded-full mr-2"></div>
                        <span>{{ $benefitStats['total_benefits'] > 0 ? round(($type->count / $benefitStats['total_benefits']) * 100, 1) : 0 }}% of total</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Benefit Processing Overview -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Processing Status -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-6">Processing Status</h3>
            <div class="space-y-4">
                <div class="flex items-center justify-between p-4 bg-yellow-50 rounded-lg">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Pending Review</p>
                            <p class="text-xs text-gray-500">Awaiting treasurer review</p>
                        </div>
                    </div>
                    <span class="text-lg font-bold text-yellow-600">{{ $benefitStats['pending_benefits'] }}</span>
                </div>

                <div class="flex items-center justify-between p-4 bg-green-50 rounded-lg">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Approved & Forwarded</p>
                            <p class="text-xs text-gray-500">Sent to admin for approval</p>
                        </div>
                    </div>
                    <span class="text-lg font-bold text-green-600">{{ $benefitStats['approved_benefits'] }}</span>
                </div>

                <div class="flex items-center justify-between p-4 bg-red-50 rounded-lg">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Rejected</p>
                            <p class="text-xs text-gray-500">Not approved by treasurer</p>
                        </div>
                    </div>
                    <span class="text-lg font-bold text-red-600">{{ $benefitStats['rejected_benefits'] }}</span>
                </div>
            </div>
        </div>

        <!-- Processing Metrics -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-6">Processing Metrics</h3>
            <div class="space-y-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-900">Approval Rate</p>
                        <p class="text-xs text-gray-500">Approved vs total requests</p>
                    </div>
                    <div class="text-right">
                        <p class="text-lg font-bold text-gray-900">
                            {{ $benefitStats['total_benefits'] > 0 ? round(($benefitStats['approved_benefits'] / $benefitStats['total_benefits']) * 100, 1) : 0 }}%
                        </p>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-900">Rejection Rate</p>
                        <p class="text-xs text-gray-500">Rejected vs total requests</p>
                    </div>
                    <div class="text-right">
                        <p class="text-lg font-bold text-gray-900">
                            {{ $benefitStats['total_benefits'] > 0 ? round(($benefitStats['rejected_benefits'] / $benefitStats['total_benefits']) * 100, 1) : 0 }}%
                        </p>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-900">Processing Rate</p>
                        <p class="text-xs text-gray-500">Processed vs total requests</p>
                    </div>
                    <div class="text-right">
                        <p class="text-lg font-bold text-gray-900">
                            {{ $benefitStats['total_benefits'] > 0 ? round((($benefitStats['approved_benefits'] + $benefitStats['rejected_benefits']) / $benefitStats['total_benefits']) * 100, 1) : 0 }}%
                        </p>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-900">Pending Rate</p>
                        <p class="text-xs text-gray-500">Pending vs total requests</p>
                    </div>
                    <div class="text-right">
                        <p class="text-lg font-bold text-gray-900">
                            {{ $benefitStats['total_benefits'] > 0 ? round(($benefitStats['pending_benefits'] / $benefitStats['total_benefits']) * 100, 1) : 0 }}%
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

