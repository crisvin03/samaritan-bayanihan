@extends('treasurer.layouts.app')

@section('title', 'Announcement Details')
@section('page-title', 'Announcement Details')
@section('page-description', 'View announcement details')

@section('content')
    <!-- Header Section -->
    <div class="mb-8">
        <div class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 rounded-2xl p-8 text-white relative overflow-hidden">
            <div class="absolute inset-0 bg-black opacity-10"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="flex items-center space-x-4 mb-4">
                            <a href="{{ route('treasurer.announcements.index') }}" 
                               class="inline-flex items-center text-sm font-medium text-indigo-100 hover:text-white transition-colors duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                                Back to Announcements
                            </a>
                        </div>
                        <h1 class="text-3xl font-bold mb-2">Announcement Details</h1>
                        <p class="text-indigo-100 text-lg">{{ $announcement->title }}</p>
                        <div class="mt-4 flex items-center space-x-4">
                            <div class="flex items-center space-x-2">
                                <div class="w-2 h-2 bg-indigo-400 rounded-full animate-pulse"></div>
                                <span class="text-sm text-indigo-100">Announcement View</span>
                            </div>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                @if($announcement->priority === 'urgent') bg-red-100 text-red-800
                                @elseif($announcement->priority === 'high') bg-orange-100 text-orange-800
                                @elseif($announcement->priority === 'medium') bg-yellow-100 text-yellow-800
                                @else bg-green-100 text-green-800 @endif">
                                {{ ucfirst($announcement->priority) }} Priority
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

    <!-- Announcement Content -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 mb-8">
        <!-- Announcement Header -->
        <div class="flex items-start justify-between mb-6">
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">{{ $announcement->title }}</h2>
                    <div class="flex items-center space-x-4 text-sm text-gray-500">
                        <span>By {{ $announcement->user->name }}</span>
                        <span>•</span>
                        <span>{{ $announcement->created_at->format('M d, Y g:i A') }}</span>
                        <span>•</span>
                        <span>{{ $announcement->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>
            <div class="flex items-center space-x-3">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                    @if($announcement->priority === 'urgent') bg-red-100 text-red-800 border border-red-200
                    @elseif($announcement->priority === 'high') bg-orange-100 text-orange-800 border border-orange-200
                    @elseif($announcement->priority === 'medium') bg-yellow-100 text-yellow-800 border border-yellow-200
                    @else bg-green-100 text-green-800 border border-green-200 @endif">
                    {{ ucfirst($announcement->priority) }} Priority
                </span>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 border border-blue-200">
                    {{ ucfirst($announcement->target_audience) }}
                </span>
            </div>
        </div>

        <!-- Announcement Content -->
        <div class="prose prose-lg max-w-none">
            <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                <p class="text-gray-800 leading-relaxed whitespace-pre-line">{{ $announcement->content }}</p>
            </div>
        </div>

        <!-- Announcement Metadata -->
        <div class="mt-8 pt-6 border-t border-gray-200">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-blue-50 rounded-xl p-4 border border-blue-200">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-blue-900">Created</h4>
                            <p class="text-sm text-blue-700">{{ $announcement->created_at->format('M d, Y g:i A') }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-green-50 rounded-xl p-4 border border-green-200">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-green-900">Status</h4>
                            <p class="text-sm text-green-700">{{ $announcement->is_published ? 'Published' : 'Draft' }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-purple-50 rounded-xl p-4 border border-purple-200">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-purple-900">Target Audience</h4>
                            <p class="text-sm text-purple-700">{{ ucfirst($announcement->target_audience) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    @if($announcement->created_by === auth()->id() && $announcement->target_audience === 'members')
        <div class="flex flex-col sm:flex-row gap-4 justify-end">
            <a href="{{ route('treasurer.announcements.edit', $announcement) }}" 
               class="inline-flex items-center justify-center px-6 py-3 bg-yellow-100 text-yellow-800 font-semibold rounded-xl hover:bg-yellow-200 transition-all duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Edit Announcement
            </a>
            <form method="POST" action="{{ route('treasurer.announcements.destroy', $announcement) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this announcement? This action cannot be undone.')">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="inline-flex items-center justify-center px-6 py-3 bg-red-100 text-red-800 font-semibold rounded-xl hover:bg-red-200 transition-all duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    Delete Announcement
                </button>
            </form>
        </div>
    @endif
@endsection
