@extends('admin.layouts.app')

@section('title', 'Benefit Reports')
@section('page-title', 'Benefit Reports')
@section('page-description', 'Benefit applications and processing analytics')

@section('content')
    <!-- Header Section -->
    <div class="mb-8">
        <div class="bg-gradient-to-r from-slate-800 via-blue-900 to-indigo-900 rounded-2xl p-8 text-white relative overflow-hidden">
            <div class="absolute inset-0 bg-black opacity-10"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold mb-2">Benefit Reports</h1>
                        <p class="text-blue-100 text-lg">Benefit applications and processing analytics</p>
                        <div class="mt-4 flex items-center space-x-4">
                            <div class="flex items-center space-x-2">
                                <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                                <span class="text-sm text-blue-100">System Online</span>
                            </div>
                            <div class="text-sm text-blue-100">
                                Total Applications: {{ number_format($totalBenefits) }}
                            </div>
                        </div>
                    </div>
                    <div class="hidden md:block">
                        <div class="w-24 h-24 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path>
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

    <!-- Benefit Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-5 gap-6 mb-8">
        <!-- Total Benefits -->
        <div class="group bg-white rounded-2xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-xl shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <div class="text-right">
                    <div class="text-xs text-gray-500 uppercase tracking-wide font-medium">Total</div>
                    <div class="text-xs text-blue-600 font-semibold">Applications</div>
                </div>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-600 mb-1">Total Benefits</p>
                <p class="text-3xl font-bold text-gray-900 mb-2">{{ number_format($totalBenefits) }}</p>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-gradient-to-r from-blue-500 to-cyan-500 h-2 rounded-full" style="width: 100%"></div>
                </div>
            </div>
        </div>

        <!-- Pending Benefits -->
        <div class="group bg-white rounded-2xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-gradient-to-br from-amber-500 to-orange-500 rounded-xl shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="text-right">
                    <div class="text-xs text-gray-500 uppercase tracking-wide font-medium">Pending</div>
                    <div class="text-xs text-amber-600 font-semibold">Action Required</div>
                </div>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-600 mb-1">Pending</p>
                <p class="text-3xl font-bold text-gray-900 mb-2">{{ number_format($pendingBenefits) }}</p>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-gradient-to-r from-amber-500 to-orange-500 h-2 rounded-full" style="width: {{ $totalBenefits > 0 ? ($pendingBenefits / $totalBenefits) * 100 : 0 }}%"></div>
                </div>
            </div>
        </div>

        <!-- Approved Benefits -->
        <div class="group bg-white rounded-2xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-gradient-to-br from-green-500 to-emerald-500 rounded-xl shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="text-right">
                    <div class="text-xs text-gray-500 uppercase tracking-wide font-medium">Approved</div>
                    <div class="text-xs text-green-600 font-semibold">Ready</div>
                </div>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-600 mb-1">Approved</p>
                <p class="text-3xl font-bold text-gray-900 mb-2">{{ number_format($approvedBenefits) }}</p>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-gradient-to-r from-green-500 to-emerald-500 h-2 rounded-full" style="width: {{ $totalBenefits > 0 ? ($approvedBenefits / $totalBenefits) * 100 : 0 }}%"></div>
                </div>
            </div>
        </div>

        <!-- Disbursed Benefits -->
        <div class="group bg-white rounded-2xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"></path>
                    </svg>
                </div>
                <div class="text-right">
                    <div class="text-xs text-gray-500 uppercase tracking-wide font-medium">Disbursed</div>
                    <div class="text-xs text-purple-600 font-semibold">Completed</div>
                </div>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-600 mb-1">Disbursed</p>
                <p class="text-3xl font-bold text-gray-900 mb-2">{{ number_format($disbursedBenefits) }}</p>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-gradient-to-r from-purple-500 to-pink-500 h-2 rounded-full" style="width: {{ $totalBenefits > 0 ? ($disbursedBenefits / $totalBenefits) * 100 : 0 }}%"></div>
                </div>
            </div>
        </div>

        <!-- Rejected Benefits -->
        <div class="group bg-white rounded-2xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-gradient-to-br from-red-500 to-pink-500 rounded-xl shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </div>
                <div class="text-right">
                    <div class="text-xs text-gray-500 uppercase tracking-wide font-medium">Rejected</div>
                    <div class="text-xs text-red-600 font-semibold">Declined</div>
                </div>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-600 mb-1">Rejected</p>
                <p class="text-3xl font-bold text-gray-900 mb-2">{{ number_format($rejectedBenefits) }}</p>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-gradient-to-r from-red-500 to-pink-500 h-2 rounded-full" style="width: {{ $totalBenefits > 0 ? ($rejectedBenefits / $totalBenefits) * 100 : 0 }}%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Benefits by Type -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 mb-8">
        <div class="bg-gradient-to-r from-purple-50 to-pink-50 px-6 py-4 border-b border-gray-100">
            <h2 class="text-xl font-bold text-gray-800 flex items-center">
                <svg class="w-5 h-5 text-purple-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                Benefits by Type
            </h2>
        </div>
        <div class="p-6">
            @if($benefitsByType->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Benefit Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Applications</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Requested</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Approved</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($benefitsByType as $benefit)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ ucfirst($benefit->benefit_type) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $benefit->count }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-600 font-semibold">₱{{ number_format($benefit->total_requested, 2) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600 font-semibold">₱{{ number_format($benefit->total_approved, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-8">
                    <div class="text-gray-500">No benefit data available</div>
                </div>
            @endif
        </div>
    </div>

    <!-- Benefits by Barangay -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 mb-8">
        <div class="bg-gradient-to-r from-indigo-50 to-blue-50 px-6 py-4 border-b border-gray-100">
            <h2 class="text-xl font-bold text-gray-800 flex items-center">
                <svg class="w-5 h-5 text-indigo-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                Benefits by Barangay
            </h2>
        </div>
        <div class="p-6">
            @if($benefitsByBarangay->count() > 0)
                <div class="space-y-4">
                    @foreach($benefitsByBarangay as $barangay)
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div class="flex items-center space-x-4">
                                <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-full flex items-center justify-center">
                                    <span class="text-white text-sm font-bold">{{ $loop->iteration }}</span>
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-900">{{ $barangay->barangay }}</div>
                                    <div class="text-sm text-gray-600">{{ $barangay->count }} applications</div>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="font-bold text-indigo-600">₱{{ number_format($barangay->total_approved, 2) }}</div>
                                <div class="text-sm text-gray-500">total approved</div>
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

    <!-- Top Benefit Recipients -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 mb-8">
        <div class="bg-gradient-to-r from-emerald-50 to-green-50 px-6 py-4 border-b border-gray-100">
            <h2 class="text-xl font-bold text-gray-800 flex items-center">
                <svg class="w-5 h-5 text-emerald-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Top Benefit Recipients
            </h2>
        </div>
        <div class="p-6">
            @if($topBenefitRecipients->count() > 0)
                <div class="space-y-4">
                    @foreach($topBenefitRecipients as $member)
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div class="flex items-center space-x-4">
                                <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-green-500 rounded-full flex items-center justify-center">
                                    <span class="text-white text-sm font-bold">{{ substr($member->name, 0, 1) }}</span>
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-900">{{ $member->name }}</div>
                                    <div class="text-sm text-gray-600">{{ $member->benefits_count }} benefits received</div>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="font-bold text-emerald-600">₱{{ number_format($member->benefits_sum_approved_amount, 2) }}</div>
                                <div class="text-sm text-gray-500">total received</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <div class="text-gray-500">No benefit recipient data available</div>
                </div>
            @endif
        </div>
    </div>

    <!-- Processing Analytics -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Average Processing Time -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-blue-50 to-cyan-50 px-6 py-4 border-b border-gray-100">
                <h2 class="text-xl font-bold text-gray-800 flex items-center">
                    <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Processing Time
                </h2>
            </div>
            <div class="p-6">
                <div class="text-center">
                    <div class="text-4xl font-bold text-blue-600 mb-2">{{ $avgProcessingTime->avg_days ? number_format($avgProcessingTime->avg_days, 1) : 'N/A' }}</div>
                    <div class="text-gray-600">average days to process</div>
                </div>
            </div>
        </div>

        <!-- Status Distribution -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-purple-50 to-pink-50 px-6 py-4 border-b border-gray-100">
                <h2 class="text-xl font-bold text-gray-800 flex items-center">
                    <svg class="w-5 h-5 text-purple-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    Status Distribution
                </h2>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Pending</span>
                        <span class="font-bold text-amber-600">{{ $pendingBenefits }} ({{ $totalBenefits > 0 ? number_format(($pendingBenefits / $totalBenefits) * 100, 1) : 0 }}%)</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Approved</span>
                        <span class="font-bold text-green-600">{{ $approvedBenefits }} ({{ $totalBenefits > 0 ? number_format(($approvedBenefits / $totalBenefits) * 100, 1) : 0 }}%)</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Disbursed</span>
                        <span class="font-bold text-purple-600">{{ $disbursedBenefits }} ({{ $totalBenefits > 0 ? number_format(($disbursedBenefits / $totalBenefits) * 100, 1) : 0 }}%)</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Rejected</span>
                        <span class="font-bold text-red-600">{{ $rejectedBenefits }} ({{ $totalBenefits > 0 ? number_format(($rejectedBenefits / $totalBenefits) * 100, 1) : 0 }}%)</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
