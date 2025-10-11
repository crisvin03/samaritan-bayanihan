@extends('treasurer.layouts.app')

@section('title', 'Monitor Benefit Requests')
@section('page-title', 'Monitor Benefit Requests')
@section('page-description', 'Monitor and forward benefit requests from your barangay members')

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
                            <h1 class="text-4xl font-bold text-white mb-2 animate-slide-in-left">Monitor Benefit Requests</h1>
                            <p class="text-green-100 text-xl animate-slide-in-left-delayed">Review and forward benefit requests from {{ $barangay }} members</p>
                            <div class="mt-4 flex items-center space-x-2">
                                <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                                <span class="text-sm text-green-100">Benefit Request Monitoring</span>
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

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Members Card -->
        <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-20 h-20 bg-blue-100 rounded-full -translate-y-10 translate-x-10"></div>
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-blue-500 rounded-xl shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <div class="text-right">
                    <div class="text-xs text-gray-500 uppercase tracking-wide font-medium">Total</div>
                    <div class="text-xs text-blue-600 font-semibold">Active</div>
                </div>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-600 mb-1">Total Members</p>
                <p class="text-3xl font-bold text-gray-900 mb-2">{{ $stats['total_members'] ?? 0 }}</p>
                <p class="text-sm text-gray-600">Registered members</p>
            </div>
        </div>

        <!-- Total Contributions Card -->
        <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-20 h-20 bg-green-100 rounded-full -translate-y-10 translate-x-10"></div>
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-green-500 rounded-xl shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                </div>
                <div class="text-right">
                    <div class="text-xs text-gray-500 uppercase tracking-wide font-medium">Total</div>
                    <div class="text-xs text-green-600 font-semibold">Collected</div>
                </div>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-600 mb-1">Total Contributions</p>
                <p class="text-3xl font-bold text-gray-900 mb-2">₱{{ number_format($stats['total_contributions'] ?? 0, 2) }}</p>
                <p class="text-sm text-gray-600">All time</p>
            </div>
        </div>

        <!-- Total Benefits Card -->
        <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-20 h-20 bg-purple-100 rounded-full -translate-y-10 translate-x-10"></div>
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-purple-500 rounded-xl shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <div class="text-right">
                    <div class="text-xs text-gray-500 uppercase tracking-wide font-medium">Total</div>
                    <div class="text-xs text-purple-600 font-semibold">Processed</div>
                </div>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-600 mb-1">Total Benefits</p>
                <p class="text-3xl font-bold text-gray-900 mb-2">{{ $stats['total_requests'] ?? 0 }}</p>
                <p class="text-sm text-gray-600">All requests</p>
            </div>
        </div>

        <!-- Pending Benefits Card -->
        <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-20 h-20 bg-orange-100 rounded-full -translate-y-10 translate-x-10"></div>
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-orange-500 rounded-xl shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="text-right">
                    <div class="text-xs text-gray-500 uppercase tracking-wide font-medium">Pending</div>
                    <div class="text-xs text-orange-600 font-semibold">Needs attention</div>
                </div>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-600 mb-1">Pending Benefits</p>
                <p class="text-3xl font-bold text-gray-900 mb-2">{{ $stats['pending_requests'] ?? 0 }}</p>
                <p class="text-sm text-gray-600">Awaiting review</p>
            </div>
        </div>
    </div>

    <!-- Benefit Requests Table -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-r from-purple-50 to-indigo-50 px-6 py-4 border-b border-gray-100">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold text-gray-800 flex items-center">
                    <svg class="w-5 h-5 text-purple-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Benefit Requests from {{ $barangay }}
                </h2>
                <div class="text-sm text-gray-600">
                    Total: {{ $stats['total_requests'] }} requests
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            @if($benefits->count() > 0)
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Member</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Benefit Type</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($benefits as $benefit)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-gradient-to-br from-blue-400 to-blue-500 rounded-full flex items-center justify-center">
                                            <span class="text-white text-sm font-bold">{{ substr($benefit->user->name, 0, 1) }}</span>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $benefit->user->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $benefit->user->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $benefit->benefit_type }}</div>
                                    <div class="text-sm text-gray-500">{{ $benefit->description }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">₱{{ number_format($benefit->amount, 2) }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($benefit->status === 'pending') bg-yellow-100 text-yellow-800 border border-yellow-200
                                        @elseif($benefit->status === 'forwarded') bg-blue-100 text-blue-800 border border-blue-200
                                        @elseif($benefit->status === 'approved') bg-green-100 text-green-800 border border-green-200
                                        @elseif($benefit->status === 'rejected') bg-red-100 text-red-800 border border-red-200
                                        @else bg-gray-100 text-gray-800 border border-gray-200 @endif">
                                        {{ ucfirst($benefit->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $benefit->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('treasurer.benefits.show', $benefit) }}" 
                                           class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded-full hover:bg-blue-200 transition-colors duration-200">
                                            View
                                        </a>
                                        @if($benefit->status === 'pending')
                                            <button onclick="openForwardModal({{ $benefit->id }})" 
                                                    class="inline-flex items-center px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full hover:bg-green-200 transition-colors duration-200">
                                                Forward
                                            </button>
                                            <button onclick="openRejectModal({{ $benefit->id }})" 
                                                    class="inline-flex items-center px-3 py-1 bg-red-100 text-red-800 text-xs font-medium rounded-full hover:bg-red-200 transition-colors duration-200">
                                                Reject
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $benefits->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <div class="text-gray-500 font-medium">No benefit requests yet</div>
                    <div class="text-gray-400 text-sm mt-2">Benefit requests from your barangay members will appear here</div>
                </div>
            @endif
        </div>
    </div>

    <!-- Forward Modal -->
    <div id="forwardModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Forward Benefit Request</h3>
                <form id="forwardForm" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="treasurer_notes" class="block text-sm font-medium text-gray-700 mb-2">Treasurer Notes (Optional)</label>
                        <textarea id="treasurer_notes" name="treasurer_notes" rows="3" 
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                  placeholder="Add any notes for the admin..."></textarea>
                    </div>
                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="closeForwardModal()" 
                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-md transition-colors duration-200">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="px-4 py-2 text-sm font-medium text-white bg-green-600 hover:bg-green-700 rounded-md transition-colors duration-200">
                            Forward to Admin
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Reject Modal -->
    <div id="rejectModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Reject Benefit Request</h3>
                <form id="rejectForm" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="rejection_reason" class="block text-sm font-medium text-gray-700 mb-2">Rejection Reason *</label>
                        <textarea id="rejection_reason" name="rejection_reason" rows="3" required
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500"
                                  placeholder="Please provide a reason for rejection..."></textarea>
                    </div>
                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="closeRejectModal()" 
                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-md transition-colors duration-200">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="px-4 py-2 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-md transition-colors duration-200">
                            Reject Request
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openForwardModal(benefitId) {
            document.getElementById('forwardForm').action = `/treasurer/benefits/${benefitId}/forward`;
            document.getElementById('forwardModal').classList.remove('hidden');
        }

        function closeForwardModal() {
            document.getElementById('forwardModal').classList.add('hidden');
        }

        function openRejectModal(benefitId) {
            document.getElementById('rejectForm').action = `/treasurer/benefits/${benefitId}/reject`;
            document.getElementById('rejectModal').classList.remove('hidden');
        }

        function closeRejectModal() {
            document.getElementById('rejectModal').classList.add('hidden');
        }

        // Close modals when clicking outside
        window.onclick = function(event) {
            const forwardModal = document.getElementById('forwardModal');
            const rejectModal = document.getElementById('rejectModal');
            
            if (event.target === forwardModal) {
                closeForwardModal();
            }
            if (event.target === rejectModal) {
                closeRejectModal();
            }
        }
    </script>
@endsection
