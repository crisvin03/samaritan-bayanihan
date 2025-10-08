@extends('treasurer.layouts.app')

@section('title', 'Edit Announcement')
@section('page-title', 'Edit Announcement')
@section('page-description', 'Edit your announcement for barangay members')

@section('content')
    <!-- Header Section -->
    <div class="mb-8">
        <div class="bg-gradient-to-r from-yellow-600 via-orange-600 to-red-600 rounded-2xl p-8 text-white relative overflow-hidden">
            <div class="absolute inset-0 bg-black opacity-10"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="flex items-center space-x-4 mb-4">
                            <a href="{{ route('treasurer.announcements.index') }}" 
                               class="inline-flex items-center text-sm font-medium text-yellow-100 hover:text-white transition-colors duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                                Back to Announcements
                            </a>
                        </div>
                        <h1 class="text-3xl font-bold mb-2">Edit Announcement</h1>
                        <p class="text-yellow-100 text-lg">Update your announcement for barangay members</p>
                        <div class="mt-4 flex items-center space-x-4">
                            <div class="flex items-center space-x-2">
                                <div class="w-2 h-2 bg-yellow-400 rounded-full animate-pulse"></div>
                                <span class="text-sm text-yellow-100">Editing Mode</span>
                            </div>
                        </div>
                    </div>
                    <div class="hidden md:block">
                        <div class="w-24 h-24 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
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

    <!-- Edit Announcement Form -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
        <form method="POST" action="{{ route('treasurer.announcements.update', $announcement) }}">
            @csrf
            @method('PUT')
            
            <!-- Title Field -->
            <div class="mb-6">
                <label for="title" class="block text-sm font-semibold text-gray-700 mb-3">Announcement Title *</label>
                <input type="text" 
                       id="title" 
                       name="title" 
                       value="{{ old('title', $announcement->title) }}"
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-all duration-200 @error('title') border-red-500 @enderror"
                       placeholder="Enter a clear and descriptive title..."
                       required>
                @error('title')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Content Field -->
            <div class="mb-6">
                <label for="content" class="block text-sm font-semibold text-gray-700 mb-3">Announcement Content *</label>
                <textarea id="content" 
                          name="content" 
                          rows="8"
                          class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-all duration-200 @error('content') border-red-500 @enderror"
                          placeholder="Write your announcement content here. Be clear and informative..."
                          required>{{ old('content', $announcement->content) }}</textarea>
                @error('content')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Priority Level -->
            <div class="mb-6">
                <label for="priority_level" class="block text-sm font-semibold text-gray-700 mb-3">Priority Level *</label>
                <select id="priority_level" 
                        name="priority_level"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-all duration-200 @error('priority_level') border-red-500 @enderror"
                        required>
                    <option value="">Select priority level</option>
                    <option value="low" {{ old('priority_level', $announcement->priority) === 'low' ? 'selected' : '' }}>Low - General information</option>
                    <option value="medium" {{ old('priority_level', $announcement->priority) === 'medium' ? 'selected' : '' }}>Medium - Important updates</option>
                    <option value="high" {{ old('priority_level', $announcement->priority) === 'high' ? 'selected' : '' }}>High - Urgent matters</option>
                    <option value="urgent" {{ old('priority_level', $announcement->priority) === 'urgent' ? 'selected' : '' }}>Urgent - Critical information</option>
                </select>
                @error('priority_level')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
                
                <!-- Priority Level Descriptions -->
                <div class="mt-3 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3">
                    <div class="p-3 bg-green-50 rounded-lg border border-green-200">
                        <div class="flex items-center space-x-2 mb-2">
                            <div class="w-3 h-3 bg-green-400 rounded-full"></div>
                            <span class="text-sm font-medium text-green-800">Low</span>
                        </div>
                        <p class="text-xs text-green-600">General information, updates, reminders</p>
                    </div>
                    <div class="p-3 bg-yellow-50 rounded-lg border border-yellow-200">
                        <div class="flex items-center space-x-2 mb-2">
                            <div class="w-3 h-3 bg-yellow-400 rounded-full"></div>
                            <span class="text-sm font-medium text-yellow-800">Medium</span>
                        </div>
                        <p class="text-xs text-yellow-600">Important updates, policy changes</p>
                    </div>
                    <div class="p-3 bg-orange-50 rounded-lg border border-orange-200">
                        <div class="flex items-center space-x-2 mb-2">
                            <div class="w-3 h-3 bg-orange-400 rounded-full"></div>
                            <span class="text-sm font-medium text-orange-800">High</span>
                        </div>
                        <p class="text-xs text-orange-600">Urgent matters, deadlines</p>
                    </div>
                    <div class="p-3 bg-red-50 rounded-lg border border-red-200">
                        <div class="flex items-center space-x-2 mb-2">
                            <div class="w-3 h-3 bg-red-400 rounded-full"></div>
                            <span class="text-sm font-medium text-red-800">Urgent</span>
                        </div>
                        <p class="text-xs text-red-600">Critical information, emergencies</p>
                    </div>
                </div>
            </div>

            <!-- Current Announcement Info -->
            <div class="mb-8 p-4 bg-blue-50 rounded-xl border border-blue-200">
                <div class="flex items-start space-x-3">
                    <div class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-blue-900 mb-1">Current Announcement</h4>
                        <p class="text-sm text-blue-700">This announcement is currently visible to all members in your barangay ({{ auth()->user()->barangay }}). Any changes you make will be updated immediately.</p>
                        <div class="mt-2 text-xs text-blue-600">
                            <span>Created: {{ $announcement->created_at->format('M d, Y g:i A') }}</span>
                            <span class="mx-2">•</span>
                            <span>Last updated: {{ $announcement->updated_at->format('M d, Y g:i A') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex flex-col sm:flex-row gap-4 justify-end">
                <a href="{{ route('treasurer.announcements.show', $announcement) }}" 
                   class="inline-flex items-center justify-center px-6 py-3 bg-gray-100 text-gray-700 font-semibold rounded-xl hover:bg-gray-200 transition-all duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    Cancel
                </a>
                <button type="submit" 
                        class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-yellow-500 to-yellow-600 text-white font-semibold rounded-xl hover:from-yellow-600 hover:to-yellow-700 transition-all duration-200 shadow-lg hover:shadow-xl">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Update Announcement
                </button>
            </div>
        </form>
    </div>

    <!-- Tips Section -->
    <div class="mt-8 bg-gradient-to-r from-yellow-50 to-orange-50 rounded-2xl p-6 border border-yellow-200">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">✏️ Editing Tips</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-3">
                <div class="flex items-start space-x-3">
                    <div class="w-6 h-6 bg-yellow-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                        <span class="text-xs font-bold text-yellow-600">1</span>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-gray-900">Review Changes</h4>
                        <p class="text-sm text-gray-600">Make sure your changes are clear and improve the message.</p>
                    </div>
                </div>
                <div class="flex items-start space-x-3">
                    <div class="w-6 h-6 bg-yellow-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                        <span class="text-xs font-bold text-yellow-600">2</span>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-gray-900">Update Priority</h4>
                        <p class="text-sm text-gray-600">Adjust the priority level if the situation has changed.</p>
                    </div>
                </div>
            </div>
            <div class="space-y-3">
                <div class="flex items-start space-x-3">
                    <div class="w-6 h-6 bg-yellow-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                        <span class="text-xs font-bold text-yellow-600">3</span>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-gray-900">Keep It Current</h4>
                        <p class="text-sm text-gray-600">Ensure the information is still relevant and accurate.</p>
                    </div>
                </div>
                <div class="flex items-start space-x-3">
                    <div class="w-6 h-6 bg-yellow-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                        <span class="text-xs font-bold text-yellow-600">4</span>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-gray-900">Save Changes</h4>
                        <p class="text-sm text-gray-600">Your changes will be visible to members immediately.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
