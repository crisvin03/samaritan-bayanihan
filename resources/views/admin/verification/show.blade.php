@extends('admin.layouts.app')

@section('title', 'User Verification Details')
@section('page-title', 'User Verification Details')
@section('page-description', 'Review and approve user verification documents')

@push('styles')
<style>
    .verification-card {
        transition: all 0.3s ease;
    }
    .verification-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
    .status-badge {
        font-size: 0.75rem;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-weight: 600;
    }
    .status-pending { @apply bg-yellow-100 text-yellow-800; }
    .status-email-verified { @apply bg-blue-100 text-blue-800; }
    .status-phone-verified { @apply bg-purple-100 text-purple-800; }
    .status-documents-uploaded { @apply bg-indigo-100 text-indigo-800; }
    .status-approved { @apply bg-green-100 text-green-800; }
    .status-rejected { @apply bg-red-100 text-red-800; }
    .document-preview {
        max-height: 400px;
        object-fit: contain;
    }
</style>
@endpush

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">User Verification Details</h1>
                <p class="text-gray-600 mt-1">Review and approve user verification documents</p>
            </div>
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.verification.index') }}" 
                   class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Verification List
                </a>
            </div>
        </div>
    </div>

    <!-- User Information Card -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <div class="flex items-start space-x-6">
            <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-2xl">
                {{ substr($user->name, 0, 1) }}
            </div>
            <div class="flex-1">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">{{ $user->name }}</h2>
                        <p class="text-gray-600">{{ $user->email }}</p>
                        <p class="text-sm text-gray-500">{{ $user->phone_number ?? 'No phone number' }}</p>
                    </div>
                    <div class="text-right">
                        <span class="status-badge status-{{ str_replace('_', '-', $user->verification_status) }}">
                            {{ ucwords(str_replace('_', ' ', $user->verification_status)) }}
                        </span>
                        <p class="text-sm text-gray-500 mt-1">
                            Registered: {{ $user->created_at->format('M d, Y H:i') }}
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-6 text-sm">
                    <div>
                        <span class="font-medium text-gray-700">Barangay:</span>
                        <span class="text-gray-600 ml-2">{{ $user->barangay ?? 'Not specified' }}</span>
                    </div>
                    <div>
                        <span class="font-medium text-gray-700">Address:</span>
                        <span class="text-gray-600 ml-2">{{ $user->address ?? 'Not specified' }}</span>
                    </div>
                    <div>
                        <span class="font-medium text-gray-700">Birth Date:</span>
                        <span class="text-gray-600 ml-2">{{ $user->birth_date ? $user->birth_date->format('M d, Y') : 'Not provided' }}</span>
                    </div>
                    <div>
                        <span class="font-medium text-gray-700">Gender:</span>
                        <span class="text-gray-600 ml-2">{{ ucfirst($user->gender ?? 'Not specified') }}</span>
                    </div>
                    <div>
                        <span class="font-medium text-gray-700">Occupation:</span>
                        <span class="text-gray-600 ml-2">{{ $user->occupation ?? 'Not specified' }}</span>
                    </div>
                    <div>
                        <span class="font-medium text-gray-700">IP Address:</span>
                        <span class="text-gray-600 ml-2">{{ $user->ip_address ?? 'Unknown' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Document Verification Section -->
    @if($user->documentVerifications->count() > 0)
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Uploaded Documents</h3>
        <div class="grid gap-6">
            @foreach($user->documentVerifications as $document)
            <div class="border border-gray-200 rounded-lg p-4">
                <div class="flex items-center justify-between mb-3">
                    <div>
                        <h4 class="font-medium text-gray-900">{{ ucwords(str_replace('_', ' ', $document->document_type)) }}</h4>
                        <p class="text-sm text-gray-600">{{ $document->document_name }}</p>
                        <p class="text-xs text-gray-500">Uploaded: {{ $document->created_at->format('M d, Y H:i') }}</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                            @if($document->status === 'pending') bg-yellow-100 text-yellow-800
                            @elseif($document->status === 'approved') bg-green-100 text-green-800
                            @else bg-red-100 text-red-800 @endif">
                            {{ ucfirst($document->status) }}
                        </span>
                    </div>
                </div>
                
                <!-- Document Image Preview -->
                <div class="mb-4">
                    <h5 class="text-sm font-medium text-gray-700 mb-2">Document Preview:</h5>
                    <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
                        @if(in_array($document->mime_type, ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp']))
                            <img src="{{ Storage::url($document->file_path) }}" 
                                 alt="{{ $document->document_name }}" 
                                 class="max-w-full h-auto mx-auto rounded-lg shadow-sm"
                                 style="max-height: 300px; object-fit: contain;">
                        @else
                            <div class="text-center py-8">
                                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <p class="text-gray-500">Document preview not available</p>
                                <p class="text-sm text-gray-400">{{ $document->mime_type }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="flex items-center space-x-4">
                    <div class="flex-1">
                        <p class="text-sm text-gray-600">File: {{ $document->file_name }}</p>
                        <p class="text-sm text-gray-600">Size: {{ number_format($document->file_size / 1024, 2) }} KB</p>
                        <p class="text-sm text-gray-600">Type: {{ $document->mime_type }}</p>
                    </div>
                    <div class="flex space-x-2">
                        <a href="{{ Storage::url($document->file_path) }}" target="_blank" 
                           class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            View Document
                        </a>
                        @if($document->status === 'pending')
                        <form method="POST" action="{{ route('admin.document-verification.approve', $document->id) }}" class="inline">
                            @csrf
                            <button type="submit" 
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Approve Document
                            </button>
                        </form>
                        <button onclick="showRejectModal({{ $document->id }})" 
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-red-600 hover:bg-red-700">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Reject Document
                        </button>
                        @endif
                    </div>
                </div>
                
                @if($document->rejection_reason)
                <div class="mt-3 p-3 bg-red-50 border border-red-200 rounded-md">
                    <p class="text-sm text-red-800"><strong>Rejection Reason:</strong> {{ $document->rejection_reason }}</p>
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Action Buttons -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-900">Verification Actions</h3>
                <p class="text-sm text-gray-600">Approve or reject this user's verification</p>
            </div>
            <div class="flex space-x-4">
                @if($user->verification_status !== 'approved')
                <form method="POST" action="{{ route('admin.verification.approve', $user) }}" class="inline">
                    @csrf
                    <button type="submit" 
                            class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                            onclick="return confirm('Are you sure you want to approve this user?')">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Approve User
                    </button>
                </form>
                @endif
                
                @if($user->verification_status !== 'rejected')
                <button onclick="showRejectUserModal()" 
                        class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    Reject User
                </button>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Reject Document Modal -->
<div id="rejectDocumentModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Reject Document</h3>
            <form id="rejectDocumentForm" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="rejection_reason" class="block text-sm font-medium text-gray-700">Rejection Reason</label>
                    <textarea id="rejection_reason" name="rejection_reason" rows="3" required
                              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                              placeholder="Please provide a reason for rejection..."></textarea>
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="hideRejectModal()" 
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                        Reject Document
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Reject User Modal -->
<div id="rejectUserModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Reject User Verification</h3>
            <form method="POST" action="{{ route('admin.verification.reject', $user) }}">
                @csrf
                <div class="mb-4">
                    <label for="rejection_reason" class="block text-sm font-medium text-gray-700">Rejection Reason</label>
                    <textarea id="rejection_reason" name="rejection_reason" rows="3" required
                              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                              placeholder="Please provide a reason for rejection..."></textarea>
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="hideRejectUserModal()" 
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                        Reject User
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
function showRejectModal(documentId) {
    document.getElementById('rejectDocumentForm').action = `/admin/document-verification/${documentId}/reject`;
    document.getElementById('rejectDocumentModal').classList.remove('hidden');
}

function hideRejectModal() {
    document.getElementById('rejectDocumentModal').classList.add('hidden');
}

function showRejectUserModal() {
    document.getElementById('rejectUserModal').classList.remove('hidden');
}

function hideRejectUserModal() {
    document.getElementById('rejectUserModal').classList.add('hidden');
}

// Close modals when clicking outside
window.onclick = function(event) {
    const documentModal = document.getElementById('rejectDocumentModal');
    const userModal = document.getElementById('rejectUserModal');
    
    if (event.target === documentModal) {
        hideRejectModal();
    }
    if (event.target === userModal) {
        hideRejectUserModal();
    }
}
</script>
@endpush
@endsection
