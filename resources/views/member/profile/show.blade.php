@extends('member.layouts.app')

@section('title', 'My Profile')
@section('page-title', 'My Profile')
@section('page-description', 'Manage your personal information and account settings')

@section('content')
    <!-- Profile Card -->
    <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-8">
        <!-- Profile Picture and Name Section -->
        <div class="flex items-center space-x-6 mb-8">
            <div class="relative">
                <div class="w-32 h-32 bg-gray-200 rounded-full flex items-center justify-center">
                    <span class="text-4xl font-bold text-gray-500">{{ substr(auth()->user()->name, 0, 1) }}</span>
                </div>
                <button class="absolute bottom-0 right-0 w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                </button>
            </div>
            <div class="flex-1">
                <input type="text" value="{{ auth()->user()->name }}" readonly 
                       class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-lg font-semibold text-gray-800">
            </div>
        </div>

        <!-- Contact Information -->
        <div class="space-y-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input type="email" value="{{ auth()->user()->email }}" readonly 
                       class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-800">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                <input type="text" value="{{ auth()->user()->address ?? 'Not provided' }}" readonly 
                       class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-800">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                <input type="tel" value="{{ auth()->user()->phone_number ?? 'Not provided' }}" readonly 
                       class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-800">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Upload ID/Verification</label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                    </svg>
                    <p class="text-gray-500">Click to upload or drag and drop</p>
                    <p class="text-sm text-gray-400">PNG, JPG, PDF up to 10MB</p>
                </div>
            </div>
        </div>

        <!-- Save Changes Button -->
        <div class="mt-8 flex justify-end">
            <a href="{{ route('member.profile.edit') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-lg transition-all duration-300">
                Save Changes
            </a>
        </div>
    </div>
@endsection
