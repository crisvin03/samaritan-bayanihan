@extends('member.layouts.app')

@section('title', 'My Contributions')
@section('page-title', 'My Contributions')
@section('page-description', 'View your contribution history and payment records')

@section('content')
    <!-- Search and Filter Section -->
    <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6 mb-6">
        <h2 class="text-xl font-bold text-gray-900 mb-4">Search & Filter</h2>
        <form method="GET" action="{{ route('member.contributions.index') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Search by reference</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Enter reference number..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">From Date</label>
                <input type="date" name="from_date" value="{{ request('from_date') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">To Date</label>
                <input type="date" name="to_date" value="{{ request('to_date') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
        </form>
    </div>

    <!-- Contributions Table -->
    <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-bold text-gray-900">Contribution History</h2>
        </div>
        
        @if($contributions->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="text-left py-4 px-6 font-semibold text-gray-900">Date</th>
                            <th class="text-left py-4 px-6 font-semibold text-gray-900">Amount</th>
                            <th class="text-left py-4 px-6 font-semibold text-gray-900">Payment Method</th>
                            <th class="text-left py-4 px-6 font-semibold text-gray-900">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($contributions as $contribution)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="py-4 px-6 text-gray-900">{{ $contribution->contribution_date->format('m/d/Y') }}</td>
                                <td class="py-4 px-6 text-gray-900 font-semibold">₱{{ number_format($contribution->amount, 0) }}</td>
                                <td class="py-4 px-6 text-gray-700">{{ ucfirst($contribution->payment_method) }}</td>
                                <td class="py-4 px-6">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                        @if($contribution->status === 'validated') bg-green-100 text-green-800 border border-green-200
                                        @elseif($contribution->status === 'pending') bg-orange-100 text-orange-800 border border-orange-200
                                        @elseif($contribution->status === 'rejected') bg-red-100 text-red-800 border border-red-200
                                        @else bg-gray-100 text-gray-800 border border-gray-200 @endif">
                                        @if($contribution->status === 'validated')
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                        @elseif($contribution->status === 'pending')
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                            </svg>
                                        @elseif($contribution->status === 'rejected')
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                            </svg>
                                        @endif
                                        {{ ucfirst($contribution->status) }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Summary and Pagination -->
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-700">
                        <span class="font-semibold">Total Contributions This Year: ₱{{ number_format($totalContributions, 0) }}</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        @if($contributions->hasPages())
                            @if($contributions->previousPageUrl())
                                <a href="{{ $contributions->previousPageUrl() }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition-all duration-300">
                                    Previous
                                </a>
                            @endif
                            @if($contributions->nextPageUrl())
                                <a href="{{ $contributions->nextPageUrl() }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition-all duration-300">
                                    Next
                                </a>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-12">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                </div>
                <div class="text-gray-500 font-medium">No contributions found</div>
                <div class="text-gray-400 text-sm mt-2">Your contribution history will appear here once you make payments</div>
            </div>
        @endif
    </div>
@endsection
