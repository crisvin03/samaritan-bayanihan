@extends('treasurer.layouts.app')

@section('title', 'Benefit Request Details')
@section('page-title', 'Benefit Request Details')
@section('page-description', 'Review and manage benefit request from member')

@section('content')
    <!-- Header Section -->
    <div class="mb-8">
        <div class="bg-gradient-to-r from-purple-600 via-indigo-600 to-blue-700 rounded-2xl p-8 text-white relative overflow-hidden">
            <div class="absolute inset-0 bg-black opacity-10"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="flex items-center space-x-4 mb-4">
                            <a href="{{ route('treasurer.benefits.index') }}" 
                               class="inline-flex items-center text-sm font-medium text-purple-100 hover:text-white transition-colors duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                                Back to Benefit Requests
                            </a>
                        </div>
                        <h1 class="text-3xl font-bold mb-2">Benefit Request Details</h1>
                        <p class="text-purple-100 text-lg">Review and manage benefit request from {{ $benefit->user->name }}</p>
                        <div class="mt-4 flex items-center space-x-4">
                            <div class="flex items-center space-x-2">
                                <div class="w-2 h-2 bg-purple-400 rounded-full animate-pulse"></div>
                                <span class="text-sm text-purple-100">Request Review</span>
                            </div>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                @if($benefit->status === 'pending') bg-yellow-100 text-yellow-800
                                @elseif($benefit->status === 'forwarded') bg-blue-100 text-blue-800
                                @elseif($benefit->status === 'approved') bg-green-100 text-green-800
                                @elseif($benefit->status === 'rejected') bg-red-100 text-red-800
                                @else bg-gray-100 text-gray-800 @endif">
                                {{ ucfirst($benefit->status) }}
                            </span>
                        </div>
                    </div>
                    <div class="hidden md:block">
                        <div class="w-24 h-24 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
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

    <div class="max-w-4xl mx-auto">

        <!-- Benefit Request Details -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">

            <div class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Member Information -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Member Information
                        </h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="flex items-center space-x-4 mb-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-blue-400 to-blue-500 rounded-full flex items-center justify-center">
                                    <span class="text-white text-lg font-bold">{{ substr($benefit->user->name, 0, 1) }}</span>
                                </div>
                                <div>
                                    <div class="text-lg font-semibold text-gray-900">{{ $benefit->user->name }}</div>
                                    <div class="text-sm text-gray-600">{{ $benefit->user->email }}</div>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4 text-sm">
                                <div>
                                    <span class="font-medium text-gray-700">Barangay:</span>
                                    <span class="text-gray-900">{{ $benefit->user->barangay }}</span>
                                </div>
                                <div>
                                    <span class="font-medium text-gray-700">Phone:</span>
                                    <span class="text-gray-900">{{ $benefit->user->phone ?? 'N/A' }}</span>
                                </div>
                                <div>
                                    <span class="font-medium text-gray-700">Member Since:</span>
                                    <span class="text-gray-900">{{ $benefit->user->created_at->format('M d, Y') }}</span>
                                </div>
                                <div>
                                    <span class="font-medium text-gray-700">Status:</span>
                                    <span class="text-gray-900 capitalize">{{ $benefit->user->status }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Benefit Information -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Benefit Information
                        </h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="space-y-4">
                                <div>
                                    <span class="font-medium text-gray-700">Benefit Type:</span>
                                    <span class="text-gray-900 block mt-1">{{ $benefit->benefit_type }}</span>
                                </div>
                                <div>
                                    <span class="font-medium text-gray-700">Amount Requested:</span>
                                    <span class="text-gray-900 block mt-1 text-lg font-semibold">₱{{ number_format($benefit->amount, 2) }}</span>
                                </div>
                                <div>
                                    <span class="font-medium text-gray-700">Description:</span>
                                    <span class="text-gray-900 block mt-1">{{ $benefit->description }}</span>
                                </div>
                                <div>
                                    <span class="font-medium text-gray-700">Request Date:</span>
                                    <span class="text-gray-900 block mt-1">{{ $benefit->created_at->format('M d, Y \a\t g:i A') }}</span>
                                </div>
                                @if($benefit->priority_level)
                                <div>
                                    <span class="font-medium text-gray-700">Priority Level:</span>
                                    <span class="text-gray-900 block mt-1 capitalize">{{ $benefit->priority_level }}</span>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Supporting Documents -->
                @if($benefit->supporting_documents)
                <div class="mt-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 text-purple-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Supporting Documents
                    </h3>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-gray-700">{{ $benefit->supporting_documents }}</p>
                    </div>
                </div>
                @endif

                <!-- Treasurer Notes -->
                @if($benefit->treasurer_notes)
                <div class="mt-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 text-orange-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Treasurer Notes
                    </h3>
                    <div class="bg-orange-50 rounded-lg p-4 border border-orange-200">
                        <p class="text-gray-700">{{ $benefit->treasurer_notes }}</p>
                        @if($benefit->forwarded_at)
                        <p class="text-sm text-gray-500 mt-2">Forwarded on {{ $benefit->forwarded_at->format('M d, Y \a\t g:i A') }}</p>
                        @endif
                    </div>
                </div>
                @endif

                <!-- Rejection Reason -->
                @if($benefit->rejection_reason)
                <div class="mt-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 text-red-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                        Rejection Reason
                    </h3>
                    <div class="bg-red-50 rounded-lg p-4 border border-red-200">
                        <p class="text-gray-700">{{ $benefit->rejection_reason }}</p>
                        @if($benefit->rejected_at)
                        <p class="text-sm text-gray-500 mt-2">Rejected on {{ $benefit->rejected_at->format('M d, Y \a\t g:i A') }}</p>
                        @endif
                    </div>
                </div>
                @endif

                <!-- Actions -->
                @if($benefit->status === 'pending')
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Actions</h3>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <button onclick="openForwardModal()" 
                                class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                            Forward to Admin
                        </button>
                        <button onclick="openRejectModal()" 
                                class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Reject Request
                        </button>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Forward Modal -->
    <div id="forwardModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Forward Benefit Request</h3>
                <form method="POST" action="{{ route('treasurer.benefits.forward', $benefit) }}">
                    @csrf
                    <div class="mb-4">
                        <label for="treasurer_notes" class="block text-sm font-medium text-gray-700 mb-2">Treasurer Notes (Optional)</label>
                        <textarea id="treasurer_notes" name="treasurer_notes" rows="3" 
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
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
                <form method="POST" action="{{ route('treasurer.benefits.reject', $benefit) }}">
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
        function openForwardModal() {
            document.getElementById('forwardModal').classList.remove('hidden');
        }

        function closeForwardModal() {
            document.getElementById('forwardModal').classList.add('hidden');
        }

        function openRejectModal() {
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
