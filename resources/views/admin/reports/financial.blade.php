@extends('admin.layouts.app')

@section('title', 'Financial Reports')
@section('page-title', 'Financial Reports')
@section('page-description', 'Revenue, expenses, and financial analytics')

@section('content')
    <!-- Header Section -->
    <div class="mb-8">
        <div class="bg-gradient-to-r from-slate-800 via-blue-900 to-indigo-900 rounded-2xl p-8 text-white relative overflow-hidden">
            <div class="absolute inset-0 bg-black opacity-10"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold mb-2">Financial Reports</h1>
                        <p class="text-blue-100 text-lg">Revenue, expenses, and financial analytics</p>
                        <div class="mt-4 flex items-center space-x-4">
                            <div class="flex items-center space-x-2">
                                <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                                <span class="text-sm text-blue-100">System Online</span>
                            </div>
                            <div class="text-sm text-blue-100">
                                Year: {{ $currentYear }}
                            </div>
                        </div>
                    </div>
                    <div class="hidden md:block">
                        <div class="w-24 h-24 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
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

    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('admin.reports.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Reports
        </a>
    </div>

    <!-- Financial Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Total Revenue -->
        <div class="group bg-white rounded-2xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-gradient-to-br from-emerald-500 to-green-500 rounded-xl shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                </div>
                <div class="text-right">
                    <div class="text-xs text-gray-500 uppercase tracking-wide font-medium">Revenue</div>
                    <div class="text-xs text-green-600 font-semibold">This Year</div>
                </div>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-600 mb-1">Total Contributions</p>
                <p class="text-3xl font-bold text-gray-900 mb-2">₱{{ number_format($currentYearData['contributions'], 2) }}</p>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-gradient-to-r from-emerald-500 to-green-500 h-2 rounded-full" style="width: 85%"></div>
                </div>
            </div>
        </div>

        <!-- Total Expenses -->
        <div class="group bg-white rounded-2xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-gradient-to-br from-red-500 to-pink-500 rounded-xl shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path>
                    </svg>
                </div>
                <div class="text-right">
                    <div class="text-xs text-gray-500 uppercase tracking-wide font-medium">Expenses</div>
                    <div class="text-xs text-red-600 font-semibold">This Year</div>
                </div>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-600 mb-1">Total Benefits</p>
                <p class="text-3xl font-bold text-gray-900 mb-2">₱{{ number_format($currentYearData['benefits'], 2) }}</p>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-gradient-to-r from-red-500 to-pink-500 h-2 rounded-full" style="width: 65%"></div>
                </div>
            </div>
        </div>

        <!-- Net Position -->
        <div class="group bg-white rounded-2xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-xl shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <div class="text-right">
                    <div class="text-xs text-gray-500 uppercase tracking-wide font-medium">Net</div>
                    <div class="text-xs text-blue-600 font-semibold">Position</div>
                </div>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-600 mb-1">Net Position</p>
                <p class="text-3xl font-bold text-gray-900 mb-2">₱{{ number_format($currentYearData['contributions'] - $currentYearData['benefits'], 2) }}</p>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-gradient-to-r from-blue-500 to-cyan-500 h-2 rounded-full" style="width: 75%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Year-over-Year Comparison -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 mb-8">
        <div class="bg-gradient-to-r from-indigo-50 to-blue-50 px-6 py-4 border-b border-gray-100">
            <h2 class="text-xl font-bold text-gray-800 flex items-center">
                <svg class="w-5 h-5 text-indigo-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                Year-over-Year Comparison
            </h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold text-gray-900">{{ $currentYear }} Performance</h3>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                            <span class="text-sm font-medium text-gray-700">Contributions</span>
                            <span class="font-bold text-green-600">₱{{ number_format($currentYearData['contributions'], 2) }}</span>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-red-50 rounded-lg">
                            <span class="text-sm font-medium text-gray-700">Benefits</span>
                            <span class="font-bold text-red-600">₱{{ number_format($currentYearData['benefits'], 2) }}</span>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg">
                            <span class="text-sm font-medium text-gray-700">Net Position</span>
                            <span class="font-bold text-blue-600">₱{{ number_format($currentYearData['contributions'] - $currentYearData['benefits'], 2) }}</span>
                        </div>
                    </div>
                </div>
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold text-gray-900">{{ $previousYear }} Performance</h3>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                            <span class="text-sm font-medium text-gray-700">Contributions</span>
                            <span class="font-bold text-green-600">₱{{ number_format($previousYearData['contributions'], 2) }}</span>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-red-50 rounded-lg">
                            <span class="text-sm font-medium text-gray-700">Benefits</span>
                            <span class="font-bold text-red-600">₱{{ number_format($previousYearData['benefits'], 2) }}</span>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg">
                            <span class="text-sm font-medium text-gray-700">Net Position</span>
                            <span class="font-bold text-blue-600">₱{{ number_format($previousYearData['contributions'] - $previousYearData['benefits'], 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Monthly Financial Summary -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 mb-8">
        <div class="bg-gradient-to-r from-emerald-50 to-green-50 px-6 py-4 border-b border-gray-100">
            <h2 class="text-xl font-bold text-gray-800 flex items-center">
                <svg class="w-5 h-5 text-emerald-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                Monthly Financial Summary ({{ $currentYear }})
            </h2>
        </div>
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Month</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contributions</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Benefits</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Net Position</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($monthlySummary as $month)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $month['month'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600 font-semibold">₱{{ number_format($month['contributions'], 2) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-red-600 font-semibold">₱{{ number_format($month['benefits'], 2) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold {{ $month['net'] >= 0 ? 'text-blue-600' : 'text-red-600' }}">
                                    ₱{{ number_format($month['net'], 2) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Breakdown Charts -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Contribution Breakdown -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-emerald-50 to-green-50 px-6 py-4 border-b border-gray-100">
                <h2 class="text-xl font-bold text-gray-800 flex items-center">
                    <svg class="w-5 h-5 text-emerald-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    Contribution Breakdown by Type
                </h2>
            </div>
            <div class="p-6">
                @if($contributionBreakdown->count() > 0)
                    <div class="space-y-4">
                        @foreach($contributionBreakdown as $breakdown)
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <div>
                                    <div class="font-semibold text-gray-900">{{ ucwords(str_replace('_', ' ', $breakdown->type)) }}</div>
                                </div>
                                <div class="text-right">
                                    <div class="font-bold text-emerald-600">₱{{ number_format($breakdown->total, 2) }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <div class="text-gray-500">No contribution data available</div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Benefit Breakdown -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-purple-50 to-pink-50 px-6 py-4 border-b border-gray-100">
                <h2 class="text-xl font-bold text-gray-800 flex items-center">
                    <svg class="w-5 h-5 text-purple-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path>
                    </svg>
                    Benefit Breakdown by Type
                </h2>
            </div>
            <div class="p-6">
                @if($benefitBreakdown->count() > 0)
                    <div class="space-y-4">
                        @foreach($benefitBreakdown as $breakdown)
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <div>
                                    <div class="font-semibold text-gray-900">{{ ucfirst($breakdown->benefit_type) }}</div>
                                </div>
                                <div class="text-right">
                                    <div class="font-bold text-purple-600">₱{{ number_format($breakdown->total, 2) }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <div class="text-gray-500">No benefit data available</div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
