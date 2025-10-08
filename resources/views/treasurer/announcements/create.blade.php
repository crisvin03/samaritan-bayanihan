@extends('treasurer.layouts.app')

@section('title', 'Create Announcement')
@section('page-title', 'Create Announcement')
@section('page-description', 'Create an announcement for your barangay members')

@section('content')
    <!-- Header Section -->
    <div class="mb-8">
        <div class="bg-gradient-to-r from-green-600 via-emerald-600 to-teal-700 rounded-2xl p-8 text-white relative overflow-hidden">
            <div class="absolute inset-0 bg-black opacity-10"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="flex items-center space-x-4 mb-4">
                            <a href="{{ route('treasurer.announcements.index') }}" 
                               class="inline-flex items-center text-sm font-medium text-green-100 hover:text-white transition-colors duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                                Back to Announcements
                            </a>
                        </div>
                        <h1 class="text-3xl font-bold mb-2">Create Announcement</h1>
                        <p class="text-green-100 text-lg">Share important information with your barangay members</p>
                        <div class="mt-4 flex items-center space-x-4">
                            <div class="flex items-center space-x-2">
                                <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                                <span class="text-sm text-green-100">New Announcement</span>
                            </div>
                        </div>
                    </div>
                    <div class="hidden md:block">
                        <div class="w-24 h-24 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
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

    <!-- Create Announcement Form -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
        <form method="POST" action="{{ route('treasurer.announcements.store') }}">
            @csrf
            
            <!-- Title Field -->
            <div class="mb-6">
                <label for="title" class="block text-sm font-semibold text-gray-700 mb-3">Announcement Title *</label>
                <input type="text" 
                       id="title" 
                       name="title" 
                       value="{{ old('title') }}"
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 @error('title') border-red-500 @enderror"
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
                          class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 @error('content') border-red-500 @enderror"
                          placeholder="Write your announcement content here. Be clear and informative..."
                          required>{{ old('content') }}</textarea>
                @error('content')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Priority Level -->
            <div class="mb-6">
                <label for="priority_level" class="block text-sm font-semibold text-gray-700 mb-3">Priority Level *</label>
                <select id="priority_level" 
                        name="priority_level"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 @error('priority_level') border-red-500 @enderror"
                        required>
                    <option value="">Select priority level</option>
                    <option value="low" {{ old('priority_level') === 'low' ? 'selected' : '' }}>Low - General information</option>
                    <option value="medium" {{ old('priority_level') === 'medium' ? 'selected' : '' }}>Medium - Important updates</option>
                    <option value="high" {{ old('priority_level') === 'high' ? 'selected' : '' }}>High - Urgent matters</option>
                    <option value="urgent" {{ old('priority_level') === 'urgent' ? 'selected' : '' }}>Urgent - Critical information</option>
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

            <!-- Target Audience Info -->
            <div class="mb-8 p-4 bg-blue-50 rounded-xl border border-blue-200">
                <div class="flex items-start space-x-3">
                    <div class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-blue-900 mb-1">Target Audience</h4>
                        <p class="text-sm text-blue-700">This announcement will be visible to all members in your barangay ({{ auth()->user()->barangay }}). Members will be able to view this announcement in their dashboard.</p>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex flex-col sm:flex-row gap-4 justify-end">
                <a href="{{ route('treasurer.announcements.index') }}" 
                   class="inline-flex items-center justify-center px-6 py-3 bg-gray-100 text-gray-700 font-semibold rounded-xl hover:bg-gray-200 transition-all duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    Cancel
                </a>
                <button type="submit" 
                        class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-green-500 to-green-600 text-white font-semibold rounded-xl hover:from-green-600 hover:to-green-700 transition-all duration-200 shadow-lg hover:shadow-xl">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Create Announcement
                </button>
            </div>
        </form>
    </div>

    <!-- Tips Section -->
    <div class="mt-8 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl p-6 border border-blue-200">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">💡 Tips for Effective Announcements</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-3">
                <div class="flex items-start space-x-3">
                    <div class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                        <span class="text-xs font-bold text-blue-600">1</span>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-gray-900">Clear Title</h4>
                        <p class="text-sm text-gray-600">Use descriptive titles that immediately tell members what the announcement is about.</p>
                    </div>
                </div>
                <div class="flex items-start space-x-3">
                    <div class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                        <span class="text-xs font-bold text-blue-600">2</span>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-gray-900">Concise Content</h4>
                        <p class="text-sm text-gray-600">Keep your message clear and to the point. Avoid unnecessary details.</p>
                    </div>
                </div>
            </div>
            <div class="space-y-3">
                <div class="flex items-start space-x-3">
                    <div class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                        <span class="text-xs font-bold text-blue-600">3</span>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-gray-900">Appropriate Priority</h4>
                        <p class="text-sm text-gray-600">Choose the right priority level to help members understand the importance.</p>
                    </div>
                </div>
                <div class="flex items-start space-x-3">
                    <div class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                        <span class="text-xs font-bold text-blue-600">4</span>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-gray-900">Timely Information</h4>
                        <p class="text-sm text-gray-600">Share information when it's most relevant and useful to your members.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
