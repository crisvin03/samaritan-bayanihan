<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Profile - Samaritan Bayanihan Inc.</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .glass-effect {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .input-focus {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .input-focus:focus {
            transform: translateY(-2px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
    </style>
</head>
<body class="min-h-screen gradient-bg">
    <!-- Navigation -->
    <nav class="bg-white/10 backdrop-blur-md border-b border-white/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center">
                            <span class="text-purple-600 font-bold text-xl">B</span>
                        </div>
                        <span class="text-white font-bold text-xl">Bayanihan</span>
                    </div>
                </div>
                
                <div class="flex items-center space-x-4">
                    <a href="{{ route('member.dashboard') }}" class="text-white hover:text-yellow-300 transition-colors">Dashboard</a>
                    <a href="{{ route('member.profile.show') }}" class="text-white hover:text-yellow-300 transition-colors">Profile</a>
                    <span class="text-white">Welcome, {{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-white hover:text-yellow-300 transition-colors">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-white mb-2">Edit Profile</h1>
                    <p class="text-purple-100">Update your personal information and contact details</p>
                </div>
                <a href="{{ route('member.profile.show') }}" class="bg-gray-400 hover:bg-gray-500 text-white font-semibold py-2 px-6 rounded-lg transition-all duration-300">
                    Cancel
                </a>
            </div>
        </div>

        <!-- Edit Form -->
        <div class="glass-effect rounded-xl p-8">
            <form method="POST" action="{{ route('member.profile.update') }}" class="space-y-6">
                @csrf
                @method('PUT')
                
                @if ($errors->any())
                    <div class="bg-red-500/20 border border-red-500/50 text-red-100 px-6 py-4 rounded-xl backdrop-blur-sm">
                        <div class="flex items-center space-x-2 mb-2">
                            <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="font-semibold">Please correct the following errors:</span>
                        </div>
                        <ul class="list-disc list-inside space-y-1 text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="bg-green-500/20 border border-green-500/50 text-green-100 px-6 py-4 rounded-xl backdrop-blur-sm">
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="font-semibold">{{ session('success') }}</span>
                        </div>
                    </div>
                @endif

                <!-- Personal Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-white font-semibold mb-3 text-sm uppercase tracking-wide">Full Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name', auth()->user()->name) }}" required 
                               class="w-full px-5 py-4 rounded-xl bg-white/10 border border-white/30 text-white placeholder-purple-200 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent input-focus backdrop-blur-sm"
                               placeholder="Enter your full name"
                               minlength="2" maxlength="100" autocomplete="name">
                    </div>

                    <div>
                        <label for="email" class="block text-white font-semibold mb-3 text-sm uppercase tracking-wide">Email Address</label>
                        <input type="email" id="email" name="email" value="{{ old('email', auth()->user()->email) }}" required 
                               class="w-full px-5 py-4 rounded-xl bg-white/10 border border-white/30 text-white placeholder-purple-200 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent input-focus backdrop-blur-sm"
                               placeholder="Enter your email address"
                               maxlength="255" autocomplete="email">
                    </div>

                    <div>
                        <label for="phone_number" class="block text-white font-semibold mb-3 text-sm uppercase tracking-wide">Phone Number</label>
                        <input type="tel" id="phone_number" name="phone_number" value="{{ old('phone_number', auth()->user()->phone_number) }}" 
                               class="w-full px-5 py-4 rounded-xl bg-white/10 border border-white/30 text-white placeholder-purple-200 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent input-focus backdrop-blur-sm"
                               placeholder="+63 912 345 6789"
                               pattern="\+63\s[0-9]{3}\s[0-9]{3}\s[0-9]{4}" maxlength="17" autocomplete="tel">
                        <p class="text-xs text-purple-200 mt-1">Format: +63 912 345 6789</p>
                    </div>

                    <div>
                        <label for="gender" class="block text-white font-semibold mb-3 text-sm uppercase tracking-wide">Gender</label>
                        <select id="gender" name="gender" 
                                class="w-full px-5 py-4 rounded-xl bg-white border border-gray-300 text-gray-900 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent input-focus appearance-none cursor-pointer">
                            <option value="">Select gender</option>
                            <option value="male" {{ old('gender', auth()->user()->gender) == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender', auth()->user()->gender) == 'female' ? 'selected' : '' }}>Female</option>
                            <option value="other" {{ old('gender', auth()->user()->gender) == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>

                    <div>
                        <label for="birth_date" class="block text-white font-semibold mb-3 text-sm uppercase tracking-wide">Birth Date</label>
                        <input type="date" id="birth_date" name="birth_date" value="{{ old('birth_date', auth()->user()->birth_date ? auth()->user()->birth_date->format('Y-m-d') : '') }}" 
                               class="w-full px-5 py-4 rounded-xl bg-white border border-gray-300 text-gray-900 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent input-focus">
                    </div>

                    <div>
                        <label for="occupation" class="block text-white font-semibold mb-3 text-sm uppercase tracking-wide">Occupation</label>
                        <input type="text" id="occupation" name="occupation" value="{{ old('occupation', auth()->user()->occupation) }}" 
                               class="w-full px-5 py-4 rounded-xl bg-white/10 border border-white/30 text-white placeholder-purple-200 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent input-focus backdrop-blur-sm"
                               placeholder="Enter your occupation"
                               maxlength="255" autocomplete="organization-title">
                    </div>
                </div>

                <!-- Address Information -->
                <div>
                    <label for="address" class="block text-white font-semibold mb-3 text-sm uppercase tracking-wide">Address</label>
                    <textarea id="address" name="address" rows="3"
                              class="w-full px-5 py-4 rounded-xl bg-white/10 border border-white/30 text-white placeholder-purple-200 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent input-focus backdrop-blur-sm"
                              placeholder="Enter your complete address">{{ old('address', auth()->user()->address) }}</textarea>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('member.profile.show') }}" class="bg-gray-400 hover:bg-gray-500 text-white font-semibold py-3 px-8 rounded-lg transition-all duration-300">
                        Cancel
                    </a>
                    <button type="submit" class="bg-yellow-400 hover:bg-yellow-500 text-purple-900 font-semibold py-3 px-8 rounded-lg transition-all duration-300 transform hover:scale-105">
                        Update Profile
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Phone number formatting
        document.getElementById('phone_number').addEventListener('input', function() {
            let value = this.value.replace(/\D/g, '');
            
            if (value.startsWith('63')) {
                value = value.substring(2);
            }
            
            if (value.length > 10) {
                value = value.substring(0, 10);
            }
            
            if (value.length > 0) {
                if (value.length <= 3) {
                    this.value = '+63 ' + value;
                } else if (value.length <= 6) {
                    this.value = '+63 ' + value.substring(0, 3) + ' ' + value.substring(3);
                } else {
                    this.value = '+63 ' + value.substring(0, 3) + ' ' + value.substring(3, 6) + ' ' + value.substring(6);
                }
            } else {
                this.value = '';
            }
        });
    </script>
</body>
</html>
