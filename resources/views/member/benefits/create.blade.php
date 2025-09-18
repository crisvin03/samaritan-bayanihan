<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Apply for Benefits - Samaritan Bayanihan Inc.</title>
    
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
                    <a href="{{ route('member.benefits.index') }}" class="text-white hover:text-yellow-300 transition-colors">Benefits</a>
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
                    <h1 class="text-3xl font-bold text-white mb-2">Apply for Benefits</h1>
                    <p class="text-purple-100">Submit your benefit application with supporting documents</p>
                </div>
                <a href="{{ route('member.benefits.index') }}" class="bg-gray-400 hover:bg-gray-500 text-white font-semibold py-2 px-6 rounded-lg transition-all duration-300">
                    Back to Benefits
                </a>
            </div>
        </div>

        <!-- Application Form -->
        <div class="glass-effect rounded-xl p-8">
            <form method="POST" action="{{ route('member.benefits.store') }}" enctype="multipart/form-data" class="space-y-6" id="benefitForm">
                @csrf
                
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

                <!-- Benefit Type Selection -->
                <div>
                    <label for="benefit_type" class="block text-white font-semibold mb-3 text-sm uppercase tracking-wide">Benefit Type</label>
                    <select id="benefit_type" name="benefit_type" required 
                            class="w-full px-5 py-4 rounded-xl bg-white border border-gray-300 text-gray-900 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent input-focus appearance-none cursor-pointer">
                        <option value="">Select benefit type</option>
                        <option value="Medical Assistance" {{ old('benefit_type') == 'Medical Assistance' ? 'selected' : '' }}>Medical Assistance (Up to ₱10,000)</option>
                        <option value="Birthday Gift" {{ old('benefit_type') == 'Birthday Gift' ? 'selected' : '' }}>Birthday Gift (₱500)</option>
                        <option value="Burial Assistance" {{ old('benefit_type') == 'Burial Assistance' ? 'selected' : '' }}>Burial Assistance (Up to ₱15,000)</option>
                        <option value="Maternity Benefit" {{ old('benefit_type') == 'Maternity Benefit' ? 'selected' : '' }}>Maternity Benefit (Up to ₱8,000)</option>
                        <option value="Emergency Assistance" {{ old('benefit_type') == 'Emergency Assistance' ? 'selected' : '' }}>Emergency Assistance (Up to ₱5,000)</option>
                        <option value="Educational Support" {{ old('benefit_type') == 'Educational Support' ? 'selected' : '' }}>Educational Support (Up to ₱20,000)</option>
                    </select>
                </div>

                <!-- Amount Requested -->
                <div>
                    <label for="amount" class="block text-white font-semibold mb-3 text-sm uppercase tracking-wide">Amount Requested</label>
                    <input type="number" id="amount" name="amount" value="{{ old('amount') }}" required 
                           class="w-full px-5 py-4 rounded-xl bg-white/10 border border-white/30 text-white placeholder-purple-200 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent input-focus backdrop-blur-sm"
                           placeholder="Enter amount requested"
                           min="1" step="0.01">
                    <p class="text-xs text-purple-200 mt-1">Enter the amount you are requesting for this benefit</p>
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-white font-semibold mb-3 text-sm uppercase tracking-wide">Description</label>
                    <textarea id="description" name="description" rows="4" required
                              class="w-full px-5 py-4 rounded-xl bg-white/10 border border-white/30 text-white placeholder-purple-200 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent input-focus backdrop-blur-sm"
                              placeholder="Please provide a detailed description of your benefit request and the reason for applying">{{ old('description') }}</textarea>
                    <p class="text-xs text-purple-200 mt-1">Provide detailed information about your request and circumstances</p>
                </div>

                <!-- Supporting Documents -->
                <div>
                    <label for="supporting_documents" class="block text-white font-semibold mb-3 text-sm uppercase tracking-wide">Supporting Documents</label>
                    <div class="border-2 border-dashed border-white/30 rounded-xl p-6 text-center hover:border-yellow-400 transition-colors">
                        <input type="file" id="supporting_documents" name="supporting_documents[]" multiple 
                               accept=".pdf,.jpg,.jpeg,.png,.doc,.docx" 
                               class="hidden" onchange="handleFileSelect(this)">
                        <label for="supporting_documents" class="cursor-pointer">
                            <div class="text-4xl mb-2">📄</div>
                            <div class="text-white font-semibold mb-2">Upload Supporting Documents</div>
                            <div class="text-purple-200 text-sm">Click to select files or drag and drop</div>
                            <div class="text-purple-300 text-xs mt-2">Accepted formats: PDF, JPG, PNG, DOC, DOCX (Max 5MB each)</div>
                        </label>
                    </div>
                    <div id="fileList" class="mt-4 space-y-2"></div>
                </div>

                <!-- Emergency Contact -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="emergency_contact_name" class="block text-white font-semibold mb-3 text-sm uppercase tracking-wide">Emergency Contact Name</label>
                        <input type="text" id="emergency_contact_name" name="emergency_contact_name" value="{{ old('emergency_contact_name') }}" 
                               class="w-full px-5 py-4 rounded-xl bg-white/10 border border-white/30 text-white placeholder-purple-200 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent input-focus backdrop-blur-sm"
                               placeholder="Enter emergency contact name">
                    </div>

                    <div>
                        <label for="emergency_contact_phone" class="block text-white font-semibold mb-3 text-sm uppercase tracking-wide">Emergency Contact Phone</label>
                        <input type="tel" id="emergency_contact_phone" name="emergency_contact_phone" value="{{ old('emergency_contact_phone') }}" 
                               class="w-full px-5 py-4 rounded-xl bg-white/10 border border-white/30 text-white placeholder-purple-200 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent input-focus backdrop-blur-sm"
                               placeholder="+63 912 345 6789">
                    </div>
                </div>

                <!-- Terms and Conditions -->
                <div class="flex items-start space-x-3">
                    <input type="checkbox" id="terms" name="terms" required 
                           class="w-5 h-5 text-yellow-400 bg-white/10 border-white/30 rounded focus:ring-yellow-400 focus:ring-2 mt-1">
                    <label for="terms" class="text-sm text-purple-100 leading-relaxed">
                        I certify that the information provided is true and accurate. I understand that false information may result in the rejection of my application. I agree to provide additional documentation if requested by the review committee.
                    </label>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('member.benefits.index') }}" class="bg-gray-400 hover:bg-gray-500 text-white font-semibold py-3 px-8 rounded-lg transition-all duration-300">
                        Cancel
                    </a>
                    <button type="submit" id="submitBtn" disabled
                            class="bg-gradient-to-r from-gray-400 to-gray-500 text-gray-600 font-bold py-3 px-8 rounded-lg transition-all duration-300 shadow-lg disabled:opacity-60 disabled:cursor-not-allowed disabled:transform-none enabled:from-yellow-400 enabled:to-yellow-500 enabled:hover:from-yellow-500 enabled:hover:to-yellow-600 enabled:text-purple-900 enabled:hover:scale-105 enabled:hover:shadow-xl">
                        <span id="submitText">Submit Application</span>
                        <svg id="submitSpinner" class="hidden animate-spin -ml-1 mr-3 h-5 w-5 text-purple-900 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // File handling
        function handleFileSelect(input) {
            const fileList = document.getElementById('fileList');
            fileList.innerHTML = '';
            
            if (input.files.length > 0) {
                for (let i = 0; i < input.files.length; i++) {
                    const file = input.files[i];
                    const fileItem = document.createElement('div');
                    fileItem.className = 'flex items-center justify-between bg-white/10 rounded-lg p-3';
                    fileItem.innerHTML = `
                        <div class="flex items-center space-x-3">
                            <div class="text-2xl">📄</div>
                            <div>
                                <div class="text-white font-medium">${file.name}</div>
                                <div class="text-purple-200 text-sm">${(file.size / 1024 / 1024).toFixed(2)} MB</div>
                            </div>
                        </div>
                        <button type="button" onclick="removeFile(${i})" class="text-red-400 hover:text-red-300">
                            ✕
                        </button>
                    `;
                    fileList.appendChild(fileItem);
                }
            }
        }

        function removeFile(index) {
            const input = document.getElementById('supporting_documents');
            const dt = new DataTransfer();
            
            for (let i = 0; i < input.files.length; i++) {
                if (i !== index) {
                    dt.items.add(input.files[i]);
                }
            }
            
            input.files = dt.files;
            handleFileSelect(input);
        }

        // Form validation and submit button state
        function updateSubmitButtonState() {
            const termsCheckbox = document.getElementById('terms');
            const submitBtn = document.getElementById('submitBtn');
            const submitText = document.getElementById('submitText');
            const submitSpinner = document.getElementById('submitSpinner');
            
            if (termsCheckbox.checked) {
                submitBtn.disabled = false;
                submitBtn.classList.remove('from-gray-400', 'to-gray-500', 'text-gray-600');
                submitBtn.classList.add('from-yellow-400', 'to-yellow-500', 'text-purple-900');
            } else {
                submitBtn.disabled = true;
                submitBtn.classList.remove('from-yellow-400', 'to-yellow-500', 'text-purple-900');
                submitBtn.classList.add('from-gray-400', 'to-gray-500', 'text-gray-600');
            }
        }

        // Terms checkbox event listener
        document.getElementById('terms').addEventListener('change', updateSubmitButtonState);

        // Form submission
        document.getElementById('benefitForm').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('submitBtn');
            const submitText = document.getElementById('submitText');
            const submitSpinner = document.getElementById('submitSpinner');
            
            if (!submitBtn.disabled) {
                submitBtn.disabled = true;
                submitText.textContent = 'Submitting Application...';
                submitSpinner.classList.remove('hidden');
                
                // Re-enable after 10 seconds as fallback
                setTimeout(() => {
                    submitBtn.disabled = false;
                    submitText.textContent = 'Submit Application';
                    submitSpinner.classList.add('hidden');
                }, 10000);
            }
        });

        // Initialize button state
        updateSubmitButtonState();
    </script>
</body>
</html>
