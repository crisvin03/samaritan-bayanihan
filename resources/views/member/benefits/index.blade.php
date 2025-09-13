@extends('member.layouts.app')

@section('title', 'Available Benefits')
@section('page-title', 'Available Benefits')
@section('page-description', 'Choose from our comprehensive range of benefits')

@section('content')
    <!-- Benefits Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Total Applications</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $benefits->count() }}</p>
                </div>
                <div class="p-3 bg-blue-100 rounded-xl">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Pending Review</p>
                    <p class="text-3xl font-bold text-yellow-600">{{ $benefits->where('status', 'pending')->count() }}</p>
                </div>
                <div class="p-3 bg-yellow-100 rounded-xl">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Approved</p>
                    <p class="text-3xl font-bold text-green-600">{{ $benefits->where('status', 'approved')->count() }}</p>
                </div>
                <div class="p-3 bg-green-100 rounded-xl">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            </div>
            
        <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Total Approved</p>
                    <p class="text-3xl font-bold text-purple-600">₱{{ number_format($benefits->where('status', 'approved')->sum('requested_amount'), 2) }}</p>
                </div>
                <div class="p-3 bg-purple-100 rounded-xl">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
            </div>
            </div>
            </div>
        </div>

    <!-- Available Benefits Section -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden mb-8">
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-4 border-b border-gray-100">
            <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                <svg class="w-6 h-6 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path>
                </svg>
                Available Benefits
            </h2>
            <p class="text-gray-600 mt-1">Choose from our comprehensive range of benefits designed to support you and your family</p>
        </div>
        
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Hospitalization Benefit -->
                <div class="group bg-white rounded-xl p-6 shadow-md border border-gray-200 hover:shadow-xl hover:border-blue-300 transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-center justify-center w-16 h-16 bg-blue-100 rounded-xl mb-4 group-hover:bg-blue-200 transition-colors">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Hospitalization Benefit</h3>
                    <p class="text-gray-600 text-sm mb-4">₱500 to ₱10,000 for hospital expenses</p>
                    <a href="{{ route('member.benefits.create', ['type' => 'hospitalization']) }}" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-lg transition-all duration-300 flex items-center justify-center group-hover:shadow-lg">
                        Apply
                    </a>
                </div>
                
                <!-- Burial Assistance -->
                <div class="group bg-white rounded-xl p-6 shadow-md border border-gray-200 hover:shadow-xl hover:border-gray-400 transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-center justify-center w-16 h-16 bg-gray-100 rounded-xl mb-4 group-hover:bg-gray-200 transition-colors">
                        <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Burial Assistance</h3>
                    <p class="text-gray-600 text-sm mb-4">From ₱1,500 to ₱50,000</p>
                    <a href="{{ route('member.benefits.create', ['type' => 'burial']) }}" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-lg transition-all duration-300 flex items-center justify-center group-hover:shadow-lg">
                        Apply
                    </a>
                </div>
                
                <!-- Animal Bite Assistance -->
                <div class="group bg-white rounded-xl p-6 shadow-md border border-gray-200 hover:shadow-xl hover:border-orange-300 transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-center justify-center w-16 h-16 bg-orange-100 rounded-xl mb-4 group-hover:bg-orange-200 transition-colors">
                        <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V8a2 2 0 012-2V6"></path>
                        </svg>
                </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Animal Bite Assistance</h3>
                    <p class="text-gray-600 text-sm mb-4">₱300 financial aid for cases involving animal bites</p>
                    <a href="{{ route('member.benefits.create', ['type' => 'animal_bite']) }}" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-lg transition-all duration-300 flex items-center justify-center group-hover:shadow-lg">
                        Apply
                    </a>
                </div>
                
                <!-- Accidental Assistance -->
                <div class="group bg-white rounded-xl p-6 shadow-md border border-gray-200 hover:shadow-xl hover:border-red-300 transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-center justify-center w-16 h-16 bg-red-100 rounded-xl mb-4 group-hover:bg-red-200 transition-colors">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4a2 2 0 012 2v2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V9a2 2 0 00-2-2h-2"></path>
                        </svg>
                </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Accidental Assistance</h3>
                    <p class="text-gray-600 text-sm mb-4">₱500 to ₱10,000 in case of accidents</p>
                    <a href="{{ route('member.benefits.create', ['type' => 'accidental']) }}" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-lg transition-all duration-300 flex items-center justify-center group-hover:shadow-lg">
                        Apply
                    </a>
        </div>

                <!-- Outpatient Benefit -->
                <div class="group bg-white rounded-xl p-6 shadow-md border border-gray-200 hover:shadow-xl hover:border-green-300 transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-center justify-center w-16 h-16 bg-green-100 rounded-xl mb-4 group-hover:bg-green-200 transition-colors">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Outpatient Benefit</h3>
                    <p class="text-gray-600 text-sm mb-4">₱200 benefit for non-hospitalized medical cases</p>
                    <a href="{{ route('member.benefits.create', ['type' => 'outpatient']) }}" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-lg transition-all duration-300 flex items-center justify-center group-hover:shadow-lg">
                        Apply
                    </a>
                </div>

                <!-- Birthday Gift -->
                <div class="group bg-white rounded-xl p-6 shadow-md border border-gray-200 hover:shadow-xl hover:border-pink-300 transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-center justify-center w-16 h-16 bg-pink-100 rounded-xl mb-4 group-hover:bg-pink-200 transition-colors">
                        <svg class="w-8 h-8 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Birthday Gift</h3>
                    <p class="text-gray-600 text-sm mb-4">₱300 given as a birthday gift</p>
                    <a href="{{ route('member.benefits.create', ['type' => 'birthday']) }}" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-lg transition-all duration-300 flex items-center justify-center group-hover:shadow-lg">
                        Apply
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection
