@extends('admin.layouts.app')

@section('title', 'Member Management')
@section('page-title', 'Member Management')
@section('page-description', 'Manage and oversee all system members')

@section('content')
    <div class="w-full max-w-full overflow-x-hidden">
    <!-- Professional Header Section - Responsive -->
    <div class="mb-6 sm:mb-8 max-w-full overflow-hidden">
        <div class="bg-gradient-to-r from-slate-900 via-blue-900 to-indigo-800 rounded-xl p-4 sm:p-6 text-white relative overflow-hidden shadow-2xl">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-900/20 to-indigo-800/20"></div>
            <div class="relative z-10">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                    <div class="flex-1 mb-3 lg:mb-0">
                        <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold mb-2 text-white">Member Management</h1>
                        <p class="text-blue-100 text-sm sm:text-base mb-2 font-medium">Manage and oversee all system members</p>
                        <div class="flex flex-col sm:flex-row sm:items-center space-y-1 sm:space-y-0 sm:space-x-4">
                            <div class="flex items-center space-x-2">
                                <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse shadow-lg shadow-green-400/50"></div>
                                <span class="text-white text-sm font-medium">System Active</span>
                            </div>
                            <div class="text-white/90 text-sm font-medium">
                                Total Members: {{ $members->count() }}
                            </div>
                        </div>
                    </div>
                    <div class="hidden md:block lg:ml-6">
                        <div class="w-16 h-16 sm:w-20 sm:h-20 bg-white/10 backdrop-blur-sm rounded-full flex items-center justify-center border border-white/20 shadow-2xl">
                            <div class="w-12 h-12 sm:w-16 sm:h-16 bg-gradient-to-br from-white/20 to-white/10 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white drop-shadow-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Subtle decorative elements -->
            <div class="absolute top-0 right-0 w-16 h-16 sm:w-24 sm:h-24 bg-white/5 rounded-full -translate-y-8 sm:-translate-y-12 translate-x-8 sm:translate-x-12"></div>
            <div class="absolute bottom-0 left-0 w-12 h-12 sm:w-16 sm:h-16 bg-white/5 rounded-full translate-y-6 sm:translate-y-8 -translate-x-6 sm:-translate-x-8"></div>
            <div class="absolute top-1/2 left-1/4 w-1 h-1 bg-white/20 rounded-full"></div>
            <div class="absolute top-1/3 right-1/3 w-1 h-1 bg-white/30 rounded-full"></div>
        </div>
        
        <!-- Action Button - Responsive -->
        <div class="mt-4 sm:mt-6 flex justify-center sm:justify-end">
            <a href="{{ route('admin.members.create') }}" 
               class="group bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-3 px-6 sm:py-4 sm:px-8 rounded-lg sm:rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-xl flex items-center space-x-2 sm:space-x-3 shadow-lg w-full sm:w-auto justify-center">
                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                <span class="text-sm sm:text-base">Add New Member</span>
            </a>
        </div>
    </div>

    <!-- Enhanced Search and Filter Section - Responsive -->
    <div class="bg-white rounded-xl sm:rounded-2xl shadow-lg border border-gray-100 p-4 sm:p-6 mb-4 sm:mb-6 max-w-full overflow-hidden">
        <div class="bg-gradient-to-r from-gray-50 to-blue-50 px-4 sm:px-6 py-3 sm:py-4 -m-4 sm:-m-6 mb-4 sm:mb-6 rounded-t-xl sm:rounded-t-2xl border-b border-gray-100">
            <h2 class="text-base sm:text-lg font-bold text-gray-800 flex items-center">
                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                Search & Filter
            </h2>
        </div>
        <div class="flex flex-col space-y-4 lg:flex-row lg:items-center lg:justify-between lg:space-y-0 lg:gap-4">
            <div class="flex-1">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 sm:pl-4 flex items-center pointer-events-none">
                        <svg class="h-4 w-4 sm:h-5 sm:w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text" 
                           class="block w-full pl-10 sm:pl-12 pr-3 sm:pr-4 py-3 sm:py-4 border border-gray-300 rounded-lg sm:rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-900 placeholder-gray-500 transition-all duration-300 shadow-sm hover:shadow-md text-sm sm:text-base" 
                           placeholder="Search members by name, email, or ID..."
                           id="search-input"
                           value="{{ request('search') }}">
                </div>
            </div>
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center space-y-3 sm:space-y-0 sm:space-x-3">
                <select id="barangay-filter" class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-700 bg-white transition-all duration-300 shadow-sm hover:shadow-md text-sm">
                    <option value="">All Barangays</option>
                    @foreach($barangays as $barangay)
                        <option value="{{ $barangay }}" {{ request('barangay') == $barangay ? 'selected' : '' }}>
                            {{ $barangay }}
                        </option>
                    @endforeach
                </select>
                <select id="status-filter" class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-700 bg-white transition-all duration-300 shadow-sm hover:shadow-md text-sm">
                    <option value="">All Status</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    <option value="suspended" {{ request('status') == 'suspended' ? 'selected' : '' }}>Suspended</option>
                </select>
                <button id="apply-filters" class="px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white rounded-lg transition-all duration-300 flex items-center justify-center shadow-sm hover:shadow-md text-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                    </svg>
                    <span class="hidden sm:inline">Apply Filters</span>
                </button>
                <button id="clear-filters" class="px-4 py-2 bg-gradient-to-r from-gray-100 to-gray-200 hover:from-gray-200 hover:to-gray-300 text-gray-700 rounded-lg transition-all duration-300 flex items-center justify-center shadow-sm hover:shadow-md text-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    <span class="hidden sm:inline">Clear</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Active Filters Display -->
    @if(request('barangay') || request('status') || request('search'))
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div class="flex items-center mb-2 sm:mb-0">
                <svg class="w-4 h-4 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                </svg>
                <span class="text-sm font-medium text-blue-800">Active Filters:</span>
            </div>
            <div class="flex flex-wrap items-center gap-2">
                @if(request('barangay'))
                    <span class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded-full">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Barangay: {{ request('barangay') }}
                    </span>
                @endif
                @if(request('status'))
                    <span class="inline-flex items-center px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Status: {{ ucfirst(request('status')) }}
                    </span>
                @endif
                @if(request('search'))
                    <span class="inline-flex items-center px-3 py-1 bg-purple-100 text-purple-800 text-xs font-medium rounded-full">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Search: "{{ request('search') }}"
                    </span>
                @endif
                <button onclick="document.getElementById('clear-filters').click()" class="inline-flex items-center px-3 py-1 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-medium rounded-full transition-colors duration-200">
                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    Clear All
                </button>
            </div>
        </div>
    </div>
    @endif

    <!-- Enhanced Members Table - Responsive -->
    <div class="bg-white rounded-xl sm:rounded-2xl shadow-lg border border-gray-100 overflow-hidden max-w-full">
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-4 sm:px-6 py-3 sm:py-4 border-b border-gray-100">
            <h2 class="text-base sm:text-lg font-bold text-gray-800 flex items-center">
                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                </svg>
                Members Directory
            </h2>
        </div>
        <div class="overflow-x-auto max-w-full">
            <table class="min-w-full divide-y divide-gray-200" style="min-width: 500px;">
                <thead class="bg-gradient-to-r from-slate-50 to-gray-100">
                    <tr>
                        <th class="px-2 sm:px-3 py-2 sm:py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider" style="width: 40%;">
                            <div class="flex items-center">
                                <div class="p-1 bg-blue-100 rounded-lg mr-1 sm:mr-2">
                                    <svg class="w-3 h-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <span class="hidden sm:inline">Member Details</span>
                                <span class="sm:hidden">Member</span>
                            </div>
                        </th>
                        <th class="hidden md:table-cell px-2 sm:px-3 py-2 sm:py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider" style="width: 10%;">
                            <div class="flex items-center">
                                <div class="p-1 bg-green-100 rounded-lg mr-1 sm:mr-2">
                                    <svg class="w-3 h-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                                    </svg>
                                </div>
                                Member ID
                            </div>
                        </th>
                        <th class="hidden lg:table-cell px-2 sm:px-3 py-2 sm:py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider" style="width: 18%;">
                            <div class="flex items-center">
                                <div class="p-1 bg-purple-100 rounded-lg mr-1 sm:mr-2">
                                    <svg class="w-3 h-3 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                Contact Info
                            </div>
                        </th>
                        <th class="px-2 sm:px-3 py-2 sm:py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider" style="width: 12%;">
                            <div class="flex items-center">
                                <div class="p-1 bg-amber-100 rounded-lg mr-1 sm:mr-2">
                                    <svg class="w-3 h-3 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                Status
                            </div>
                        </th>
                        <th class="px-2 sm:px-3 py-2 sm:py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider" style="width: 12%;">
                            <div class="flex items-center">
                                <div class="p-1 bg-purple-100 rounded-lg mr-1 sm:mr-2">
                                    <svg class="w-3 h-3 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                    </svg>
                                </div>
                                <span class="hidden lg:inline">Verification</span>
                                <span class="lg:hidden">Verify</span>
                            </div>
                        </th>
                        <th class="px-2 sm:px-3 py-2 sm:py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider" style="width: 10%;">
                            <div class="flex items-center">
                                <div class="p-1 bg-green-100 rounded-lg mr-1 sm:mr-2">
                                    <svg class="w-3 h-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <span class="hidden lg:inline">ID Preview</span>
                                <span class="lg:hidden">ID</span>
                            </div>
                        </th>
                        <th class="hidden sm:table-cell px-2 sm:px-3 py-2 sm:py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider" style="width: 10%;">
                            <div class="flex items-center">
                                <div class="p-1 bg-indigo-100 rounded-lg mr-1 sm:mr-2">
                                    <svg class="w-3 h-3 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <span class="hidden lg:inline">Joined Date</span>
                                <span class="lg:hidden">Joined</span>
                            </div>
                        </th>
                        <th class="px-2 sm:px-3 py-2 sm:py-3 text-right text-xs font-bold text-gray-700 uppercase tracking-wider" style="width: 10%;">
                            <div class="flex items-center justify-end">
                                <div class="p-1 bg-gray-100 rounded-lg mr-1 sm:mr-2">
                                    <svg class="w-3 h-3 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                                    </svg>
                                </div>
                                <span class="hidden sm:inline">Actions</span>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse($members as $member)
                        <tr class="group hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-300 border-l-4 border-transparent hover:border-blue-400">
                            <td class="px-2 sm:px-3 py-2 sm:py-3 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-8 w-8 sm:h-9 sm:w-9">
                                        <div class="h-8 w-8 sm:h-9 sm:w-9 rounded-full bg-gradient-to-br from-blue-500 to-cyan-500 flex items-center justify-center shadow-lg group-hover:shadow-xl transition-shadow duration-300">
                                            <span class="text-xs sm:text-sm font-bold text-white">{{ substr($member->name, 0, 1) }}</span>
                                        </div>
                                    </div>
                                    <div class="ml-2 sm:ml-3 min-w-0 flex-1">
                                        <div class="text-xs sm:text-sm font-bold text-gray-900 group-hover:text-blue-900 transition-colors duration-300 truncate">{{ $member->name }}</div>
                                        <div class="text-xs text-gray-600 font-medium truncate">{{ $member->barangay ?? 'No barangay assigned' }}</div>
                                        <!-- Mobile: Show email and ID below name -->
                                        <div class="md:hidden mt-1">
                                            <div class="text-xs text-gray-500 truncate">{{ $member->email }}</div>
                                            <div class="inline-flex items-center px-1 py-0.5 bg-green-100 text-green-800 rounded text-xs font-mono font-bold mt-1">
                                                #{{ str_pad($member->id, 6, '0', STR_PAD_LEFT) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="hidden md:table-cell px-2 sm:px-3 py-2 sm:py-3 whitespace-nowrap">
                                <div class="inline-flex items-center px-2 py-1 bg-green-100 text-green-800 rounded font-mono text-xs font-bold">
                                    #{{ str_pad($member->id, 6, '0', STR_PAD_LEFT) }}
                                </div>
                            </td>
                            <td class="hidden lg:table-cell px-2 sm:px-3 py-2 sm:py-3 whitespace-nowrap">
                                <div class="text-xs font-semibold text-gray-900 truncate">{{ $member->email }}</div>
                                @if($member->phone_number)
                                    <div class="text-xs text-gray-600 font-medium truncate">{{ $member->phone_number }}</div>
                                @endif
                            </td>
                            <td class="px-2 sm:px-3 py-2 sm:py-3 whitespace-nowrap">
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-bold shadow-sm
                                    @if($member->status === 'active') bg-gradient-to-r from-green-100 to-emerald-100 text-green-800 border border-green-200
                                    @elseif($member->status === 'inactive') bg-gradient-to-r from-gray-100 to-slate-100 text-gray-800 border border-gray-200
                                    @elseif($member->status === 'suspended') bg-gradient-to-r from-red-100 to-rose-100 text-red-800 border border-red-200
                                    @else bg-gradient-to-r from-gray-100 to-slate-100 text-gray-800 border border-gray-200 @endif">
                                    @if($member->status === 'active')
                                        <div class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1 animate-pulse"></div>
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    @elseif($member->status === 'suspended')
                                        <div class="w-1.5 h-1.5 bg-red-500 rounded-full mr-1"></div>
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M13.477 14.89A6 6 0 015.11 6.524l8.367 8.368zm1.414-1.414L6.524 5.11a6 6 0 018.367 8.367zM18 10a8 8 0 11-16 0 8 8 0 0116 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    @endif
                                    <span class="hidden sm:inline">{{ ucfirst($member->status) }}</span>
                                    <span class="sm:hidden">{{ ucfirst(substr($member->status, 0, 3)) }}</span>
                                </span>
                            </td>
                            <td class="px-2 sm:px-3 py-2 sm:py-3 whitespace-nowrap">
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-bold shadow-sm
                                    @if($member->verification_status === 'approved') bg-gradient-to-r from-green-100 to-emerald-100 text-green-800 border border-green-200
                                    @elseif($member->verification_status === 'pending') bg-gradient-to-r from-yellow-100 to-amber-100 text-yellow-800 border border-yellow-200
                                    @elseif($member->verification_status === 'email_verified') bg-gradient-to-r from-blue-100 to-cyan-100 text-blue-800 border border-blue-200
                                    @elseif($member->verification_status === 'documents_uploaded') bg-gradient-to-r from-purple-100 to-violet-100 text-purple-800 border border-purple-200
                                    @elseif($member->verification_status === 'rejected') bg-gradient-to-r from-red-100 to-rose-100 text-red-800 border border-red-200
                                    @else bg-gradient-to-r from-gray-100 to-slate-100 text-gray-800 border border-gray-200 @endif">
                                    @if($member->verification_status === 'approved')
                                        <div class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1 animate-pulse"></div>
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    @elseif($member->verification_status === 'pending')
                                        <div class="w-1.5 h-1.5 bg-yellow-500 rounded-full mr-1 animate-pulse"></div>
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                        </svg>
                                    @elseif($member->verification_status === 'documents_uploaded')
                                        <div class="w-1.5 h-1.5 bg-purple-500 rounded-full mr-1 animate-pulse"></div>
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path>
                                        </svg>
                                    @elseif($member->verification_status === 'rejected')
                                        <div class="w-1.5 h-1.5 bg-red-500 rounded-full mr-1"></div>
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M13.477 14.89A6 6 0 015.11 6.524l8.367 8.368zm1.414-1.414L6.524 5.11a6 6 0 018.367 8.367zM18 10a8 8 0 11-16 0 8 8 0 0116 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    @endif
                                    <span class="hidden sm:inline">{{ ucwords(str_replace('_', ' ', $member->verification_status)) }}</span>
                                    <span class="sm:hidden">{{ ucwords(str_replace('_', ' ', substr($member->verification_status, 0, 4))) }}</span>
                                </span>
                            </td>
                            <td class="px-2 sm:px-3 py-2 sm:py-3 whitespace-nowrap">
                                @if($member->documentVerifications->where('status', 'pending')->count() > 0)
                                    @php
                                        $latestDocument = $member->documentVerifications->where('status', 'pending')->first();
                                    @endphp
                                    <div class="flex items-center">
                                        <div class="flex items-center justify-center w-8 h-8 bg-blue-100 rounded-lg border border-blue-200 mr-2">
                                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="text-xs font-medium text-gray-900 truncate max-w-20" title="{{ $latestDocument->file_name }}">
                                                {{ $latestDocument->file_name }}
                                            </span>
                                            <span class="text-xs text-gray-500">
                                                {{ ucwords(str_replace('_', ' ', $latestDocument->document_type)) }}
                                            </span>
                                        </div>
                                    </div>
                                @else
                                    <div class="flex items-center">
                                        <div class="flex items-center justify-center w-8 h-8 bg-gray-100 rounded-lg border border-gray-200 mr-2">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="text-xs text-gray-500">No documents</span>
                                        </div>
                                    </div>
                                @endif
                            </td>
                            <td class="hidden sm:table-cell px-2 sm:px-3 py-2 sm:py-3 whitespace-nowrap">
                                <div class="text-xs font-semibold text-gray-900">{{ $member->created_at->format('M d, Y') }}</div>
                                <div class="text-xs text-gray-500">{{ $member->created_at->diffForHumans() }}</div>
                            </td>
                            <td class="px-2 sm:px-3 py-2 sm:py-3 whitespace-nowrap text-right text-xs font-medium">
                                <div class="flex flex-col sm:flex-row items-end sm:items-center space-y-1 sm:space-y-0 sm:space-x-1">
                                    <!-- Verify Button - Show for users with pending verification -->
                                    @if(in_array($member->verification_status, ['pending', 'email_verified', 'documents_uploaded']))
                                    <a href="{{ route('admin.verification.show', $member) }}" 
                                       class="group inline-flex items-center px-2 py-1 bg-gradient-to-r from-purple-100 to-violet-200 hover:from-purple-200 hover:to-violet-300 text-purple-800 text-xs font-semibold rounded transition-all duration-300 shadow-sm hover:shadow-md">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                        </svg>
                                        <span class="hidden sm:inline">Verify</span>
                                    </a>
                                    @endif
                                    
                                    <a href="{{ route('admin.members.show', $member) }}" 
                                       class="group inline-flex items-center px-2 py-1 bg-gradient-to-r from-blue-100 to-blue-200 hover:from-blue-200 hover:to-blue-300 text-blue-800 text-xs font-semibold rounded transition-all duration-300 shadow-sm hover:shadow-md">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        <span class="hidden sm:inline">View</span>
                                    </a>
                                    @if($member->status === 'active')
                                        <form method="POST" action="{{ route('admin.members.suspend', $member) }}" class="inline">
                                            @csrf
                                            <button type="submit" 
                                                    class="group inline-flex items-center px-2 py-1 bg-gradient-to-r from-red-100 to-rose-200 hover:from-red-200 hover:to-rose-300 text-red-800 text-xs font-semibold rounded transition-all duration-300 shadow-sm hover:shadow-md"
                                                    onclick="return confirm('Are you sure you want to suspend this member?')">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728"></path>
                                                </svg>
                                                <span class="hidden sm:inline">Suspend</span>
                                            </button>
                                        </form>
                                    @else
                                        <form method="POST" action="{{ route('admin.members.activate', $member) }}" class="inline">
                                            @csrf
                                            <button type="submit" 
                                                    class="group inline-flex items-center px-2 py-1 bg-gradient-to-r from-green-100 to-emerald-200 hover:from-green-200 hover:to-emerald-300 text-green-800 text-xs font-semibold rounded transition-all duration-300 shadow-sm hover:shadow-md">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <span class="hidden sm:inline">Activate</span>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 sm:px-6 py-12 sm:py-16 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-16 h-16 sm:w-20 sm:h-20 lg:w-24 lg:h-24 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center mb-4 sm:mb-6 shadow-lg">
                                        <svg class="w-8 h-8 sm:w-10 sm:h-10 lg:w-12 lg:h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                        </svg>
                                    </div>
                                    <h3 class="text-lg sm:text-xl lg:text-2xl font-bold text-gray-900 mb-2 sm:mb-3">No members found</h3>
                                    <p class="text-gray-600 mb-4 sm:mb-6 text-sm sm:text-base lg:text-lg px-4">Get started by adding your first member to the system.</p>
                                    <a href="{{ route('admin.members.create') }}" 
                                       class="group inline-flex items-center px-4 sm:px-6 py-2 sm:py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold rounded-lg sm:rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 text-sm sm:text-base">
                                        <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                        Add First Member
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Enhanced Pagination - Responsive -->
        @if($members->hasPages())
            <div class="bg-gradient-to-r from-gray-50 to-blue-50 px-4 sm:px-6 py-4 sm:py-6 border-t border-gray-200">
                <div class="flex flex-col sm:flex-row items-center justify-between space-y-4 sm:space-y-0">
                    <div class="flex items-center text-xs sm:text-sm text-gray-700">
                        <div class="flex items-center space-x-2">
                            <svg class="w-3 h-3 sm:w-4 sm:h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            <span class="font-semibold">Showing {{ $members->firstItem() }} to {{ $members->lastItem() }} of {{ $members->total() }} results</span>
                        </div>
                    </div>
                    <div class="flex items-center space-x-1 sm:space-x-2">
                        @if($members->onFirstPage())
                            <span class="px-2 sm:px-4 py-1 sm:py-2 bg-gray-100 text-gray-400 rounded-md sm:rounded-lg cursor-not-allowed font-medium text-xs sm:text-sm">Previous</span>
                        @else
                            <a href="{{ $members->previousPageUrl() }}" class="px-2 sm:px-4 py-1 sm:py-2 bg-white hover:bg-blue-50 text-gray-700 border border-gray-300 rounded-md sm:rounded-lg transition-all duration-200 font-medium shadow-sm hover:shadow-md text-xs sm:text-sm">Previous</a>
                        @endif

                        @foreach($members->getUrlRange(1, $members->lastPage()) as $page => $url)
                            @if($page == $members->currentPage())
                                <span class="px-2 sm:px-4 py-1 sm:py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-md sm:rounded-lg font-bold shadow-lg text-xs sm:text-sm">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="px-2 sm:px-4 py-1 sm:py-2 bg-white hover:bg-blue-50 text-gray-700 border border-gray-300 rounded-md sm:rounded-lg transition-all duration-200 font-medium shadow-sm hover:shadow-md text-xs sm:text-sm">{{ $page }}</a>
                            @endif
                        @endforeach

                        @if($members->hasMorePages())
                            <a href="{{ $members->nextPageUrl() }}" class="px-2 sm:px-4 py-1 sm:py-2 bg-white hover:bg-blue-50 text-gray-700 border border-gray-300 rounded-md sm:rounded-lg transition-all duration-200 font-medium shadow-sm hover:shadow-md text-xs sm:text-sm">Next</a>
                        @else
                            <span class="px-2 sm:px-4 py-1 sm:py-2 bg-gray-100 text-gray-400 rounded-md sm:rounded-lg cursor-not-allowed font-medium text-xs sm:text-sm">Next</span>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Enhanced Quick Stats - Responsive -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mt-6 sm:mt-8 max-w-full overflow-hidden">
        <div class="group bg-white rounded-xl sm:rounded-2xl shadow-lg border border-gray-100 p-4 sm:p-6 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
            <div class="flex items-center justify-between mb-3 sm:mb-4">
                <div class="p-2 sm:p-3 bg-gradient-to-br from-green-500 to-emerald-500 rounded-lg sm:rounded-xl shadow-lg">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="text-right">
                    <div class="text-xs text-gray-500 uppercase tracking-wide font-medium">Active</div>
                    <div class="text-xs text-green-600 font-semibold">+12.5%</div>
                </div>
            </div>
            <div>
                <p class="text-xs sm:text-sm font-medium text-gray-600 mb-1">Active Members</p>
                <p class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">{{ $members->where('status', 'active')->count() }}</p>
                <div class="w-full bg-gray-200 rounded-full h-1.5 sm:h-2">
                    <div class="bg-gradient-to-r from-green-500 to-emerald-500 h-1.5 sm:h-2 rounded-full" style="width: {{ $members->count() > 0 ? ($members->where('status', 'active')->count() / $members->count()) * 100 : 0 }}%"></div>
                </div>
            </div>
        </div>
        
        <div class="group bg-white rounded-xl sm:rounded-2xl shadow-lg border border-gray-100 p-4 sm:p-6 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
            <div class="flex items-center justify-between mb-3 sm:mb-4">
                <div class="p-2 sm:p-3 bg-gradient-to-br from-gray-500 to-slate-500 rounded-lg sm:rounded-xl shadow-lg">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728"></path>
                    </svg>
                </div>
                <div class="text-right">
                    <div class="text-xs text-gray-500 uppercase tracking-wide font-medium">Inactive</div>
                    <div class="text-xs text-gray-600 font-semibold">-2.1%</div>
                </div>
            </div>
            <div>
                <p class="text-xs sm:text-sm font-medium text-gray-600 mb-1">Inactive Members</p>
                <p class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">{{ $members->where('status', 'inactive')->count() }}</p>
                <div class="w-full bg-gray-200 rounded-full h-1.5 sm:h-2">
                    <div class="bg-gradient-to-r from-gray-500 to-slate-500 h-1.5 sm:h-2 rounded-full" style="width: {{ $members->count() > 0 ? ($members->where('status', 'inactive')->count() / $members->count()) * 100 : 0 }}%"></div>
                </div>
            </div>
        </div>
        
        <div class="group bg-white rounded-xl sm:rounded-2xl shadow-lg border border-gray-100 p-4 sm:p-6 hover:shadow-xl transition-all duration-300 hover:-translate-y-1 sm:col-span-2 lg:col-span-1">
            <div class="flex items-center justify-between mb-3 sm:mb-4">
                <div class="p-2 sm:p-3 bg-gradient-to-br from-red-500 to-rose-500 rounded-lg sm:rounded-xl shadow-lg">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                </div>
                <div class="text-right">
                    <div class="text-xs text-gray-500 uppercase tracking-wide font-medium">Suspended</div>
                    <div class="text-xs text-red-600 font-semibold">Action Required</div>
                </div>
            </div>
            <div>
                <p class="text-xs sm:text-sm font-medium text-gray-600 mb-1">Suspended Members</p>
                <p class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">{{ $members->where('status', 'suspended')->count() }}</p>
                <div class="w-full bg-gray-200 rounded-full h-1.5 sm:h-2">
                    <div class="bg-gradient-to-r from-red-500 to-rose-500 h-1.5 sm:h-2 rounded-full" style="width: {{ $members->count() > 0 ? ($members->where('status', 'suspended')->count() / $members->count()) * 100 : 0 }}%"></div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Filter functionality
        const applyFiltersBtn = document.getElementById('apply-filters');
        if (applyFiltersBtn) {
            applyFiltersBtn.addEventListener('click', function(e) {
                e.preventDefault();
                
                const barangay = document.getElementById('barangay-filter').value;
                const status = document.getElementById('status-filter').value;
                const search = document.getElementById('search-input').value;
                
                const url = new URL(window.location);
                
                if (barangay) {
                    url.searchParams.set('barangay', barangay);
                } else {
                    url.searchParams.delete('barangay');
                }
                
                if (status) {
                    url.searchParams.set('status', status);
                } else {
                    url.searchParams.delete('status');
                }
                
                if (search) {
                    url.searchParams.set('search', search);
                } else {
                    url.searchParams.delete('search');
                }
                
                window.location.href = url.toString();
            });
        }

        const clearFiltersBtn = document.getElementById('clear-filters');
        if (clearFiltersBtn) {
            clearFiltersBtn.addEventListener('click', function(e) {
                e.preventDefault();
                
                document.getElementById('barangay-filter').value = '';
                document.getElementById('status-filter').value = '';
                document.getElementById('search-input').value = '';
                
                const url = new URL(window.location);
                url.searchParams.delete('barangay');
                url.searchParams.delete('status');
                url.searchParams.delete('search');
                
                window.location.href = url.toString();
            });
        }

        // Auto-apply filters when dropdowns change
        const barangayFilter = document.getElementById('barangay-filter');
        if (barangayFilter) {
            barangayFilter.addEventListener('change', function() {
                document.getElementById('apply-filters').click();
            });
        }

        const statusFilter = document.getElementById('status-filter');
        if (statusFilter) {
            statusFilter.addEventListener('change', function() {
                document.getElementById('apply-filters').click();
            });
        }

        // Search functionality (client-side for immediate feedback)
        const searchInput = document.getElementById('search-input');
        if (searchInput) {
            searchInput.addEventListener('input', function(e) {
                const searchTerm = e.target.value.toLowerCase();
                const rows = document.querySelectorAll('tbody tr');
                
                rows.forEach(row => {
                    const name = row.querySelector('td:first-child').textContent.toLowerCase();
                    const email = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
                    const memberId = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                    
                    if (name.includes(searchTerm) || email.includes(searchTerm) || memberId.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        }

    });
</script>
@endpush
 