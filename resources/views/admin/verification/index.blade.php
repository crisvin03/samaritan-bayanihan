@extends('admin.layouts.app')

@section('title', 'User Verification Dashboard')
@section('page-title', 'User Verification')
@section('page-description', 'Review and approve user registrations')

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
</style>
@endpush

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">User Verification Dashboard</h1>
                <p class="text-gray-600 mt-1">Review and approve user registrations with enhanced security</p>
            </div>
            <div class="flex items-center space-x-4">
                <div class="text-right">
                    <div class="text-sm text-gray-500">Total Pending</div>
                    <div class="text-2xl font-bold text-yellow-600">{{ $pendingUsers->total() }}</div>
                </div>
                <div class="text-right">
                    <div class="text-sm text-gray-500">Approved Today</div>
                    <div class="text-2xl font-bold text-green-600">{{ $approvedUsers->where('updated_at', '>=', today())->count() }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabs -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="border-b border-gray-200">
            <nav class="-mb-px flex space-x-8 px-6" aria-label="Tabs">
                <button class="tab-button active py-4 px-1 border-b-2 border-blue-500 font-medium text-sm text-blue-600" data-tab="pending">
                    Pending Review ({{ $pendingUsers->total() }})
                </button>
                <button class="tab-button py-4 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700" data-tab="approved">
                    Approved ({{ $approvedUsers->total() }})
                </button>
                <button class="tab-button py-4 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700" data-tab="rejected">
                    Rejected ({{ $rejectedUsers->total() }})
                </button>
            </nav>
        </div>

        <!-- Pending Users Tab -->
        <div id="pending-tab" class="tab-content">
            <div class="p-6">
                @if($pendingUsers->count() > 0)
                    <div class="grid gap-4">
                        @foreach($pendingUsers as $user)
                        <div class="verification-card bg-white border border-gray-200 rounded-lg p-6">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center space-x-3 mb-3">
                                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <h3 class="text-lg font-semibold text-gray-900">{{ $user->name }}</h3>
                                            <p class="text-sm text-gray-600">{{ $user->email }}</p>
                                            <p class="text-xs text-gray-500">{{ $user->phone_number ?? 'No phone' }}</p>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-center space-x-4 mb-4">
                                        <span class="status-badge status-{{ str_replace('_', '-', $user->verification_status) }}">
                                            {{ ucwords(str_replace('_', ' ', $user->verification_status)) }}
                                        </span>
                                        <span class="text-xs text-gray-500">
                                            Registered: {{ $user->created_at->format('M d, Y H:i') }}
                                        </span>
                                        <span class="text-xs text-gray-500">
                                            IP: {{ $user->ip_address ?? 'Unknown' }}
                                        </span>
                                    </div>

                                    <div class="grid grid-cols-2 gap-4 text-sm">
                                        <div>
                                            <span class="font-medium text-gray-700">Barangay:</span>
                                            <span class="text-gray-600">{{ $user->barangay }}</span>
                                        </div>
                                        <div>
                                            <span class="font-medium text-gray-700">Age:</span>
                                            <span class="text-gray-600">{{ $user->birth_date ? $user->birth_date->age . ' years' : 'Not provided' }}</span>
                                        </div>
                                        <div>
                                            <span class="font-medium text-gray-700">Gender:</span>
                                            <span class="text-gray-600">{{ ucfirst($user->gender ?? 'Not specified') }}</span>
                                        </div>
                                        <div>
                                            <span class="font-medium text-gray-700">Occupation:</span>
                                            <span class="text-gray-600">{{ $user->occupation ?? 'Not specified' }}</span>
                                        </div>
                                    </div>

                                    @if($user->documentVerifications->count() > 0)
                                    <div class="mt-4">
                                        <h4 class="text-sm font-medium text-gray-700 mb-2">Uploaded Documents:</h4>
                                        <div class="flex flex-wrap gap-2">
                                            @foreach($user->documentVerifications as $doc)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                {{ ucwords(str_replace('_', ' ', $doc->document_type)) }}
                                            </span>
                                            @endforeach
                                        </div>
                                    </div>
                                    @endif
                                </div>

                                <div class="flex flex-col space-y-2 ml-4">
                                    <a href="{{ route('admin.verification.show', $user) }}" 
                                       class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        Review
                                    </a>
                                    
                                    @if($user->verification_status === 'documents_uploaded')
                                    <form method="POST" action="{{ route('admin.verification.approve', $user) }}" class="inline">
                                        @csrf
                                        <button type="submit" 
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            Approve
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="mt-6">
                        {{ $pendingUsers->links() }}
                    </div>
                @else
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No pending verifications</h3>
                        <p class="mt-1 text-sm text-gray-500">All users have been reviewed.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Approved Users Tab -->
        <div id="approved-tab" class="tab-content hidden">
            <div class="p-6">
                @if($approvedUsers->count() > 0)
                    <div class="grid gap-4">
                        @foreach($approvedUsers as $user)
                        <div class="verification-card bg-white border border-green-200 rounded-lg p-6">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900">{{ $user->name }}</h3>
                                        <p class="text-sm text-gray-600">{{ $user->email }}</p>
                                        <p class="text-xs text-gray-500">Approved: {{ $user->updated_at->format('M d, Y H:i') }}</p>
                                    </div>
                                </div>
                                <span class="status-badge status-approved">Approved</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No approved users</h3>
                        <p class="mt-1 text-sm text-gray-500">No users have been approved yet.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Rejected Users Tab -->
        <div id="rejected-tab" class="tab-content hidden">
            <div class="p-6">
                @if($rejectedUsers->count() > 0)
                    <div class="grid gap-4">
                        @foreach($rejectedUsers as $user)
                        <div class="verification-card bg-white border border-red-200 rounded-lg p-6">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="w-12 h-12 bg-gradient-to-br from-red-500 to-red-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900">{{ $user->name }}</h3>
                                        <p class="text-sm text-gray-600">{{ $user->email }}</p>
                                        <p class="text-xs text-gray-500">Rejected: {{ $user->updated_at->format('M d, Y H:i') }}</p>
                                        @if($user->rejection_reason)
                                        <p class="text-xs text-red-600 mt-1">{{ $user->rejection_reason }}</p>
                                        @endif
                                    </div>
                                </div>
                                <span class="status-badge status-rejected">Rejected</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No rejected users</h3>
                        <p class="mt-1 text-sm text-gray-500">No users have been rejected yet.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const tabButtons = document.querySelectorAll('.tab-button');
    const tabContents = document.querySelectorAll('.tab-content');

    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            const targetTab = this.getAttribute('data-tab');
            
            // Remove active class from all buttons
            tabButtons.forEach(btn => {
                btn.classList.remove('active', 'border-blue-500', 'text-blue-600');
                btn.classList.add('border-transparent', 'text-gray-500');
            });
            
            // Add active class to clicked button
            this.classList.add('active', 'border-blue-500', 'text-blue-600');
            this.classList.remove('border-transparent', 'text-gray-500');
            
            // Hide all tab contents
            tabContents.forEach(content => {
                content.classList.add('hidden');
            });
            
            // Show target tab content
            document.getElementById(targetTab + '-tab').classList.remove('hidden');
        });
    });
});
</script>
@endpush
@endsection
