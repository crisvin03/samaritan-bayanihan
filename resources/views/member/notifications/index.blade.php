@extends('member.layouts.app')

@section('title', 'Notifications')
@section('page-title', 'Notifications')
@section('page-description', 'Stay updated with your latest notifications')

@section('content')
    <!-- Page Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Notifications</h1>
        </div>
        <div>
            <form method="POST" action="{{ route('member.notifications.clear-all') }}" class="inline">
                @csrf
                <button type="submit" class="text-blue-600 hover:text-blue-800 font-medium transition-colors">
                    Clear All
                </button>
            </form>
        </div>
    </div>

    <!-- Divider -->
    <div class="border-t border-gray-200 mb-6"></div>

    <!-- Notifications List -->
    <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
        @if($notifications->count() > 0)
            <div class="divide-y divide-gray-200">
                @foreach($notifications as $notification)
                    <div class="p-6 hover:bg-gray-50 transition-colors {{ $notification['read'] ? 'opacity-75' : '' }} {{ $notification['priority'] === 'high' ? 'border-l-4 border-blue-500' : '' }}">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <!-- Notification Type with Priority -->
                                <div class="flex items-center mb-2">
                                    <h3 class="text-lg font-bold text-gray-900">
                                        {{ $notification['type'] }}
                                    </h3>
                                    @if(!$notification['read'])
                                        <span class="inline-block w-2 h-2 bg-blue-600 rounded-full ml-2"></span>
                                    @endif
                                    @if(isset($notification['priority']) && $notification['priority'] === 'high')
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 ml-2">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                            </svg>
                                            Important
                                        </span>
                                    @endif
                                </div>
                                
                                <!-- Notification Message -->
                                <p class="text-gray-700 mb-3 leading-relaxed">
                                    {{ $notification['message'] }}
                                </p>
                                
                                <!-- Timestamp -->
                                <p class="text-sm text-gray-500">
                                    {{ $notification['timestamp']->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-12">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM4.828 7l2.586 2.586a2 2 0 002.828 0L12.828 7H4.828zM4.828 17h8l-2.586-2.586a2 2 0 00-2.828 0L4.828 17z"></path>
                    </svg>
                </div>
                <div class="text-gray-500 font-medium">No notifications</div>
                <div class="text-gray-400 text-sm mt-2">You're all caught up! New notifications will appear here.</div>
            </div>
        @endif
    </div>

    <!-- Mark as Read Button -->
    @if($notifications->count() > 0)
        <div class="mt-8 text-center">
            <form method="POST" action="{{ route('member.notifications.mark-as-read') }}" class="inline">
                @csrf
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-lg transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                    Mark as Read
                </button>
            </form>
        </div>
    @endif

    <!-- Success Message -->
    @if(session('success'))
        <div class="fixed top-4 right-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg shadow-lg z-50" id="success-message">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                </svg>
                {{ session('success') }}
            </div>
        </div>
    @endif

    <script>
        // Auto-hide success message after 3 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const successMessage = document.getElementById('success-message');
            if (successMessage) {
                setTimeout(function() {
                    successMessage.style.opacity = '0';
                    successMessage.style.transform = 'translateY(-20px)';
                    setTimeout(function() {
                        successMessage.remove();
                    }, 300);
                }, 3000);
            }
        });
    </script>
@endsection
