@extends('admin.layouts.app')

@section('title', 'Member Analytics')
@section('page-title', 'Member Analytics')
@section('page-description', 'Member demographics and activity analysis')

@section('content')
    <!-- Header Section -->
    <div class="mb-8">
        <div class="bg-gradient-to-r from-slate-800 via-blue-900 to-indigo-900 rounded-2xl p-8 text-white relative overflow-hidden">
            <div class="absolute inset-0 bg-black opacity-10"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold mb-2">Member Analytics</h1>
                        <p class="text-blue-100 text-lg">Member demographics and activity analysis</p>
                        <div class="mt-4 flex items-center space-x-4">
                            <div class="flex items-center space-x-2">
                                <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                                <span class="text-sm text-blue-100">System Online</span>
                            </div>
                            <div class="text-sm text-blue-100">
                                Total Members: {{ number_format($totalMembers) }}
                            </div>
                        </div>
                    </div>
                    <div class="hidden md:block">
                        <div class="w-24 h-24 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
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

    <!-- Member Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <!-- Total Members -->
        <div class="group bg-white rounded-2xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-xl shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                </div>
                <div class="text-right">
                    <div class="text-xs text-gray-500 uppercase tracking-wide font-medium">Total</div>
                    <div class="text-xs text-blue-600 font-semibold">Members</div>
                </div>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-600 mb-1">Total Members</p>
                <p class="text-3xl font-bold text-gray-900 mb-2">{{ number_format($totalMembers) }}</p>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-gradient-to-r from-blue-500 to-cyan-500 h-2 rounded-full" style="width: 100%"></div>
                </div>
            </div>
        </div>

        <!-- Active Members -->
        <div class="group bg-white rounded-2xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-gradient-to-br from-green-500 to-emerald-500 rounded-xl shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="text-right">
                    <div class="text-xs text-gray-500 uppercase tracking-wide font-medium">Active</div>
                    <div class="text-xs text-green-600 font-semibold">Contributors</div>
                </div>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-600 mb-1">Active Members</p>
                <p class="text-3xl font-bold text-gray-900 mb-2">{{ number_format($activeMembers) }}</p>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-gradient-to-r from-green-500 to-emerald-500 h-2 rounded-full" style="width: {{ $totalMembers > 0 ? ($activeMembers / $totalMembers) * 100 : 0 }}%"></div>
                </div>
            </div>
        </div>

        <!-- Inactive Members -->
        <div class="group bg-white rounded-2xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-gradient-to-br from-amber-500 to-orange-500 rounded-xl shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="text-right">
                    <div class="text-xs text-gray-500 uppercase tracking-wide font-medium">Inactive</div>
                    <div class="text-xs text-amber-600 font-semibold">No Contributions</div>
                </div>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-600 mb-1">Inactive Members</p>
                <p class="text-3xl font-bold text-gray-900 mb-2">{{ number_format($inactiveMembers) }}</p>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-gradient-to-r from-amber-500 to-orange-500 h-2 rounded-full" style="width: {{ $totalMembers > 0 ? ($inactiveMembers / $totalMembers) * 100 : 0 }}%"></div>
                </div>
            </div>
        </div>

        <!-- New This Month -->
        <div class="group bg-white rounded-2xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                </div>
                <div class="text-right">
                    <div class="text-xs text-gray-500 uppercase tracking-wide font-medium">New</div>
                    <div class="text-xs text-purple-600 font-semibold">This Month</div>
                </div>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-600 mb-1">New Members</p>
                <p class="text-3xl font-bold text-gray-900 mb-2">{{ number_format($newMembersThisMonth) }}</p>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-gradient-to-r from-purple-500 to-pink-500 h-2 rounded-full" style="width: {{ $newMembersThisMonth > 0 ? '80%' : '0%' }}"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Members by Barangay -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 mb-8">
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-4 border-b border-gray-100">
            <h2 class="text-xl font-bold text-gray-800 flex items-center">
                <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                Members by Barangay
            </h2>
        </div>
        <div class="p-6">
            @if($membersByBarangay->count() > 0)
                <div class="space-y-4">
                    @foreach($membersByBarangay as $barangay)
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div class="flex items-center space-x-4">
                                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-full flex items-center justify-center">
                                    <span class="text-white text-sm font-bold">{{ $loop->iteration }}</span>
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-900">{{ $barangay->barangay }}</div>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-2xl font-bold text-blue-600">{{ $barangay->count }}</div>
                                <div class="text-sm text-gray-500">members</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <div class="text-gray-500">No member data available</div>
                </div>
            @endif
        </div>
    </div>

    <!-- Registration Trends -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 mb-8">
        <div class="bg-gradient-to-r from-green-50 to-emerald-50 px-6 py-4 border-b border-gray-100">
            <h2 class="text-xl font-bold text-gray-800 flex items-center">
                <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                Member Registration Trends (12 Months)
            </h2>
        </div>
        <div class="p-6">
            @if($registrationTrends->count() > 0)
                <div class="space-y-4">
                    @foreach($registrationTrends as $trend)
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div>
                                <div class="font-semibold text-gray-900">{{ $trend->month }}</div>
                            </div>
                            <div class="text-right">
                                <div class="font-bold text-green-600">{{ $trend->count }} new members</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <div class="text-gray-500">No registration data available</div>
                </div>
            @endif
        </div>
    </div>

    <!-- Top Contributors -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 mb-8">
        <div class="bg-gradient-to-r from-purple-50 to-pink-50 px-6 py-4 border-b border-gray-100">
            <h2 class="text-xl font-bold text-gray-800 flex items-center">
                <svg class="w-5 h-5 text-purple-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Top Contributors
            </h2>
        </div>
        <div class="p-6">
            @if($contributionActivity->count() > 0)
                <div class="space-y-4">
                    @foreach($contributionActivity as $member)
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div class="flex items-center space-x-4">
                                <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full flex items-center justify-center">
                                    <span class="text-white text-sm font-bold">{{ substr($member->name, 0, 1) }}</span>
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-900">{{ $member->name }}</div>
                                    <div class="text-sm text-gray-600">{{ $member->contributions_count }} contributions</div>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="font-bold text-purple-600">₱{{ number_format($member->contributions_sum_amount, 2) }}</div>
                                <div class="text-sm text-gray-500">total contributed</div>
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

    <!-- Additional Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Members with Pending Benefits -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-amber-50 to-yellow-50 px-6 py-4 border-b border-gray-100">
                <h2 class="text-xl font-bold text-gray-800 flex items-center">
                    <svg class="w-5 h-5 text-amber-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Members with Pending Benefits
                </h2>
            </div>
            <div class="p-6">
                <div class="text-center">
                    <div class="text-4xl font-bold text-amber-600 mb-2">{{ $membersWithPendingBenefits }}</div>
                    <div class="text-gray-600">members have pending benefit applications</div>
                </div>
            </div>
        </div>

        <!-- Activity Summary -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-indigo-50 to-blue-50 px-6 py-4 border-b border-gray-100">
                <h2 class="text-xl font-bold text-gray-800 flex items-center">
                    <svg class="w-5 h-5 text-indigo-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    Activity Summary
                </h2>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Active Members</span>
                        <span class="font-bold text-green-600">{{ $activeMembers }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Inactive Members</span>
                        <span class="font-bold text-amber-600">{{ $inactiveMembers }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Activity Rate</span>
                        <span class="font-bold text-blue-600">{{ $totalMembers > 0 ? number_format(($activeMembers / $totalMembers) * 100, 1) : 0 }}%</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
