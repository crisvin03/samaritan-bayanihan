@extends('member.layouts.app')

@section('title', 'Apply for Benefits')
@section('page-title', 'Apply for Benefits')
@section('page-description', 'Submit your benefit application with supporting documents')

@section('content')
    <!-- Application Form -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-4 border-b border-gray-100">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                    <svg class="w-6 h-6 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Benefit Application Form
                </h2>
                <a href="{{ route('member.benefits.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Benefits
                </a>
            </div>
            <p class="text-gray-600 mt-1">Submit your benefit application with supporting documents</p>
        </div>
        
        <div class="p-6">
            <form method="POST" action="{{ route('member.benefits.store') }}" enctype="multipart/form-data" class="space-y-6" id="benefitForm">
                @csrf
                
                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-800 px-6 py-4 rounded-xl">
                        <div class="flex items-center space-x-2 mb-2">
                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                    <label for="benefit_type" class="block text-gray-700 font-semibold mb-3 text-sm uppercase tracking-wide">Benefit Type</label>
                    <select id="benefit_type" name="benefit_type" required 
                            class="w-full px-4 py-3 rounded-lg bg-white border border-gray-300 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300">
                        <option value="">Select benefit type</option>
                        <option value="hospitalization" {{ old('benefit_type', request('type')) == 'hospitalization' ? 'selected' : '' }}>Hospitalization Benefit (₱500 to ₱10,000)</option>
                        <option value="burial" {{ old('benefit_type', request('type')) == 'burial' ? 'selected' : '' }}>Burial Assistance (₱1,500 to ₱50,000)</option>
                        <option value="animal_bite" {{ old('benefit_type', request('type')) == 'animal_bite' ? 'selected' : '' }}>Animal Bite Assistance (₱300)</option>
                        <option value="accidental" {{ old('benefit_type', request('type')) == 'accidental' ? 'selected' : '' }}>Accidental Assistance (₱500 to ₱10,000)</option>
                        <option value="outpatient" {{ old('benefit_type', request('type')) == 'outpatient' ? 'selected' : '' }}>Outpatient Benefit (₱200)</option>
                        <option value="birthday" {{ old('benefit_type', request('type')) == 'birthday' ? 'selected' : '' }}>Birthday Gift (₱300)</option>
                    </select>
                </div>

                <!-- Amount Requested -->
                <div>
                    <label for="requested_amount" class="block text-gray-700 font-semibold mb-3 text-sm uppercase tracking-wide">Amount Requested</label>
                    <input type="number" id="requested_amount" name="requested_amount" value="{{ old('requested_amount') }}" required 
                           class="w-full px-4 py-3 rounded-lg bg-white border border-gray-300 text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300"
                           placeholder="Enter amount requested"
                           min="1" step="0.01">
                    <p class="text-xs text-gray-500 mt-1">Enter the amount you are requesting for this benefit</p>
                </div>

                <!-- Reason -->
                <div>
                    <label for="reason" class="block text-gray-700 font-semibold mb-3 text-sm uppercase tracking-wide">Reason for Application</label>
                    <textarea id="reason" name="reason" rows="4" required
                              class="w-full px-4 py-3 rounded-lg bg-white border border-gray-300 text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300"
                              placeholder="Please provide a detailed description of your benefit request and the reason for applying">{{ old('reason') }}</textarea>
                    <p class="text-xs text-gray-500 mt-1">Provide detailed information about your request and circumstances</p>
                </div>

                <!-- Supporting Documents -->
                <div>
                    <label for="supporting_documents" class="block text-gray-700 font-semibold mb-3 text-sm uppercase tracking-wide">Supporting Documents</label>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-400 transition-colors">
                        <input type="file" id="supporting_documents" name="supporting_documents[]" multiple 
                               accept=".pdf,.jpg,.jpeg,.png,.doc,.docx" 
                               class="hidden" onchange="handleFileSelect(this)">
                        <label for="supporting_documents" class="cursor-pointer">
                            <div class="text-4xl mb-2">📄</div>
                            <div class="text-gray-700 font-semibold mb-2">Upload Supporting Documents</div>
                            <div class="text-gray-500 text-sm">Click to select files or drag and drop</div>
                            <div class="text-gray-400 text-xs mt-2">Accepted formats: PDF, JPG, PNG, DOC, DOCX (Max 5MB each)</div>
                        </label>
                    </div>
                    <div id="fileList" class="mt-4 space-y-2"></div>
                </div>

                <!-- Terms and Conditions -->
                <div class="flex items-start space-x-3">
                    <input type="checkbox" id="terms" name="terms" required 
                           class="w-5 h-5 text-blue-600 bg-white border-gray-300 rounded focus:ring-blue-500 focus:ring-2 mt-1">
                    <label for="terms" class="text-sm text-gray-700 leading-relaxed">
                        I certify that the information provided is true and accurate. I understand that false information may result in the rejection of my application. I agree to provide additional documentation if requested by the review committee.
                    </label>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('member.benefits.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-3 px-8 rounded-lg transition-all duration-300">
                        Cancel
                    </a>
                    <button type="submit" id="submitBtn" disabled
                            class="bg-gradient-to-r from-gray-400 to-gray-500 text-gray-600 font-bold py-3 px-8 rounded-lg transition-all duration-300 shadow-lg disabled:opacity-60 disabled:cursor-not-allowed disabled:transform-none enabled:from-blue-500 enabled:to-blue-600 enabled:hover:from-blue-600 enabled:hover:to-blue-700 enabled:text-white enabled:hover:scale-105 enabled:hover:shadow-xl">
                        <span id="submitText">Submit Application</span>
                        <svg id="submitSpinner" class="hidden animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

    <script>
        // File handling
        function handleFileSelect(input) {
            const fileList = document.getElementById('fileList');
            fileList.innerHTML = '';
            
            if (input.files.length > 0) {
                for (let i = 0; i < input.files.length; i++) {
                    const file = input.files[i];
                    const fileItem = document.createElement('div');
                    fileItem.className = 'flex items-center justify-between bg-gray-50 rounded-lg p-3 border border-gray-200';
                    fileItem.innerHTML = `
                        <div class="flex items-center space-x-3">
                            <div class="text-2xl">📄</div>
                            <div>
                                <div class="text-gray-800 font-medium">${file.name}</div>
                                <div class="text-gray-500 text-sm">${(file.size / 1024 / 1024).toFixed(2)} MB</div>
                            </div>
                        </div>
                        <button type="button" onclick="removeFile(${i})" class="text-red-500 hover:text-red-700">
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
                submitBtn.classList.add('from-blue-500', 'to-blue-600', 'text-white');
            } else {
                submitBtn.disabled = true;
                submitBtn.classList.remove('from-blue-500', 'to-blue-600', 'text-white');
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
@endsection
