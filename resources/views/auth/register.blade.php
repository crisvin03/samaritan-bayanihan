<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register - Samaritan Bayanihan Inc.</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet" />
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Security Headers -->
    <meta http-equiv="X-Content-Type-Options" content="nosniff">
    <meta http-equiv="X-Frame-Options" content="DENY">
    <meta http-equiv="X-XSS-Protection" content="1; mode=block">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        .glass-effect {
            backdrop-filter: blur(20px);
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        .input-focus {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .input-focus:focus {
            transform: translateY(-2px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .password-strength {
            height: 4px;
            border-radius: 2px;
            transition: all 0.3s ease;
        }
        .strength-weak { background: #ef4444; }
        .strength-fair { background: #f59e0b; }
        .strength-good { background: #10b981; }
        .strength-strong { background: #059669; }
        .floating-label {
            transition: all 0.3s ease;
        }
        .floating-label.active {
            transform: translateY(-8px) scale(0.85);
            color: #fbbf24;
        }
    </style>
</head>
<body class="min-h-screen gradient-bg flex items-center justify-center p-6">
    <div class="w-full max-w-lg">
        <!-- Logo -->
        <div class="text-center mb-10">
            <div class="flex items-center justify-center space-x-3 mb-6">
                <div class="w-16 h-16 rounded-xl overflow-hidden shadow-xl border-2 border-white/20 bg-white p-1">
                    <img src="{{ asset('images/logo.png') }}" alt="Bayanihan Logo" class="w-full h-full object-contain">
                </div>
                <div class="text-left">
                    <span class="text-white font-bold text-2xl block">Samaritan</span>
                    <span class="text-yellow-300 font-semibold text-sm">Bayanihan Inc.</span>
                </div>
            </div>
            <h1 class="text-4xl font-bold text-white mb-3">Join Our Community</h1>
            <p class="text-purple-100 text-lg">Create your secure account today</p>
        </div>

        <!-- Register Form -->
        <div class="glass-effect rounded-3xl p-10 shadow-2xl">
            <form method="POST" action="{{ route('register') }}" class="space-y-7" id="registerForm" novalidate>
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

                <!-- Full Name -->
                <div class="relative">
                    <label for="name" class="block text-white font-semibold mb-3 text-sm uppercase tracking-wide">Full Name</label>
                    <div class="relative">
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required 
                               class="w-full px-5 py-4 rounded-xl bg-white/10 border border-white/30 text-white placeholder-purple-200 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent input-focus backdrop-blur-sm"
                               placeholder="Enter your full name"
                               minlength="2" maxlength="100" autocomplete="name">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <svg class="w-5 h-5 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Email Address -->
                <div class="relative">
                    <label for="email" class="block text-white font-semibold mb-3 text-sm uppercase tracking-wide">Email Address</label>
                    <div class="relative">
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required 
                               class="w-full px-5 py-4 rounded-xl bg-white/10 border border-white/30 text-white placeholder-purple-200 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent input-focus backdrop-blur-sm"
                               placeholder="Enter your email address"
                               maxlength="255" autocomplete="email">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <svg class="w-5 h-5 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Phone Number -->
                <div class="relative">
                    <label for="phone_number" class="block text-white font-semibold mb-3 text-sm uppercase tracking-wide">Phone Number</label>
                    <div class="relative">
                        <input type="tel" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" 
                               class="w-full px-5 py-4 rounded-xl bg-white/10 border border-white/30 text-white placeholder-purple-200 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent input-focus backdrop-blur-sm"
                               placeholder="+63 912 345 6789"
                               pattern="\+63\s[0-9]{3}\s[0-9]{3}\s[0-9]{4}" maxlength="17" autocomplete="tel"
                               title="Please enter phone number in format: +63 912 345 6789">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <svg class="w-5 h-5 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-xs text-purple-200 mt-1">Format: +63 912 345 6789 (11 digits total)</p>
                </div>

                <!-- Barangay Selection -->
                <div class="relative">
                    <label for="barangay" class="block text-white font-semibold mb-3 text-sm uppercase tracking-wide">Barangay</label>
                    <div class="relative">
                        <select id="barangay" name="barangay" required 
                                class="w-full px-5 py-4 rounded-xl bg-white border border-gray-300 text-gray-900 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent input-focus appearance-none cursor-pointer">
                            <option value="">Select your barangay</option>
                            <option value="A. Bonifacio (Tinurilan)" {{ old('barangay') == 'A. Bonifacio (Tinurilan)' ? 'selected' : '' }}>A. Bonifacio (Tinurilan)</option>
                            <option value="Abad Santos (Kambal)" {{ old('barangay') == 'Abad Santos (Kambal)' ? 'selected' : '' }}>Abad Santos (Kambal)</option>
                            <option value="Aguinaldo (Lipata Dako)" {{ old('barangay') == 'Aguinaldo (Lipata Dako)' ? 'selected' : '' }}>Aguinaldo (Lipata Dako)</option>
                            <option value="Antipolo" {{ old('barangay') == 'Antipolo' ? 'selected' : '' }}>Antipolo</option>
                            <option value="Aquino (Imelda)" {{ old('barangay') == 'Aquino (Imelda)' ? 'selected' : '' }}>Aquino (Imelda)</option>
                            <option value="Bical" {{ old('barangay') == 'Bical' ? 'selected' : '' }}>Bical</option>
                            <option value="Beguin" {{ old('barangay') == 'Beguin' ? 'selected' : '' }}>Beguin</option>
                            <option value="Bonga" {{ old('barangay') == 'Bonga' ? 'selected' : '' }}>Bonga</option>
                            <option value="Butag" {{ old('barangay') == 'Butag' ? 'selected' : '' }}>Butag</option>
                            <option value="Cadandanan" {{ old('barangay') == 'Cadandanan' ? 'selected' : '' }}>Cadandanan</option>
                            <option value="Calomagon" {{ old('barangay') == 'Calomagon' ? 'selected' : '' }}>Calomagon</option>
                            <option value="Calpi" {{ old('barangay') == 'Calpi' ? 'selected' : '' }}>Calpi</option>
                            <option value="Cocok-Cabitan" {{ old('barangay') == 'Cocok-Cabitan' ? 'selected' : '' }}>Cocok-Cabitan</option>
                            <option value="Daganas" {{ old('barangay') == 'Daganas' ? 'selected' : '' }}>Daganas</option>
                            <option value="Danao" {{ old('barangay') == 'Danao' ? 'selected' : '' }}>Danao</option>
                            <option value="Dolos" {{ old('barangay') == 'Dolos' ? 'selected' : '' }}>Dolos</option>
                            <option value="E. Quirino (Pinangomhan)" {{ old('barangay') == 'E. Quirino (Pinangomhan)' ? 'selected' : '' }}>E. Quirino (Pinangomhan)</option>
                            <option value="Fabrica" {{ old('barangay') == 'Fabrica' ? 'selected' : '' }}>Fabrica</option>
                            <option value="G. Del Pilar (Tanga)" {{ old('barangay') == 'G. Del Pilar (Tanga)' ? 'selected' : '' }}>G. Del Pilar (Tanga)</option>
                            <option value="Gate" {{ old('barangay') == 'Gate' ? 'selected' : '' }}>Gate</option>
                            <option value="Inararan" {{ old('barangay') == 'Inararan' ? 'selected' : '' }}>Inararan</option>
                            <option value="J. Gerona (Biton)" {{ old('barangay') == 'J. Gerona (Biton)' ? 'selected' : '' }}>J. Gerona (Biton)</option>
                            <option value="J.P. Laurel (Pon-od)" {{ old('barangay') == 'J.P. Laurel (Pon-od)' ? 'selected' : '' }}>J.P. Laurel (Pon-od)</option>
                            <option value="Jamorawon" {{ old('barangay') == 'Jamorawon' ? 'selected' : '' }}>Jamorawon</option>
                            <option value="Libertad (Calle Putol)" {{ old('barangay') == 'Libertad (Calle Putol)' ? 'selected' : '' }}>Libertad (Calle Putol)</option>
                            <option value="Lajong" {{ old('barangay') == 'Lajong' ? 'selected' : '' }}>Lajong</option>
                            <option value="Magsaysay (Bongog)" {{ old('barangay') == 'Magsaysay (Bongog)' ? 'selected' : '' }}>Magsaysay (Bongog)</option>
                            <option value="Managa-naga" {{ old('barangay') == 'Managa-naga' ? 'selected' : '' }}>Managa-naga</option>
                            <option value="Marinab" {{ old('barangay') == 'Marinab' ? 'selected' : '' }}>Marinab</option>
                            <option value="Nasuje" {{ old('barangay') == 'Nasuje' ? 'selected' : '' }}>Nasuje</option>
                            <option value="Montecalvario" {{ old('barangay') == 'Montecalvario' ? 'selected' : '' }}>Montecalvario</option>
                            <option value="N. Roque (Calayugan)" {{ old('barangay') == 'N. Roque (Calayugan)' ? 'selected' : '' }}>N. Roque (Calayugan)</option>
                            <option value="Namo" {{ old('barangay') == 'Namo' ? 'selected' : '' }}>Namo</option>
                            <option value="Obrero" {{ old('barangay') == 'Obrero' ? 'selected' : '' }}>Obrero</option>
                            <option value="Osmeña (Lipata Saday)" {{ old('barangay') == 'Osmeña (Lipata Saday)' ? 'selected' : '' }}>Osmeña (Lipata Saday)</option>
                            <option value="Otavi" {{ old('barangay') == 'Otavi' ? 'selected' : '' }}>Otavi</option>
                            <option value="Padre Diaz" {{ old('barangay') == 'Padre Diaz' ? 'selected' : '' }}>Padre Diaz</option>
                            <option value="Palale" {{ old('barangay') == 'Palale' ? 'selected' : '' }}>Palale</option>
                            <option value="Quezon (Cabarawan)" {{ old('barangay') == 'Quezon (Cabarawan)' ? 'selected' : '' }}>Quezon (Cabarawan)</option>
                            <option value="R. Gerona (Butag)" {{ old('barangay') == 'R. Gerona (Butag)' ? 'selected' : '' }}>R. Gerona (Butag)</option>
                            <option value="Recto" {{ old('barangay') == 'Recto' ? 'selected' : '' }}>Recto</option>
                            <option value="Roxas (Busay)" {{ old('barangay') == 'Roxas (Busay)' ? 'selected' : '' }}>Roxas (Busay)</option>
                            <option value="Sagrada" {{ old('barangay') == 'Sagrada' ? 'selected' : '' }}>Sagrada</option>
                            <option value="San Francisco (Polot)" {{ old('barangay') == 'San Francisco (Polot)' ? 'selected' : '' }}>San Francisco (Polot)</option>
                            <option value="San Isidro (Cabugaan)" {{ old('barangay') == 'San Isidro (Cabugaan)' ? 'selected' : '' }}>San Isidro (Cabugaan)</option>
                            <option value="San Juan Bag-o" {{ old('barangay') == 'San Juan Bag-o' ? 'selected' : '' }}>San Juan Bag-o</option>
                            <option value="San Juan Daan" {{ old('barangay') == 'San Juan Daan' ? 'selected' : '' }}>San Juan Daan</option>
                            <option value="San Rafael (Togbongon)" {{ old('barangay') == 'San Rafael (Togbongon)' ? 'selected' : '' }}>San Rafael (Togbongon)</option>
                            <option value="San Ramon" {{ old('barangay') == 'San Ramon' ? 'selected' : '' }}>San Ramon</option>
                            <option value="San Vicente" {{ old('barangay') == 'San Vicente' ? 'selected' : '' }}>San Vicente</option>
                            <option value="Santa Remedios" {{ old('barangay') == 'Santa Remedios' ? 'selected' : '' }}>Santa Remedios</option>
                            <option value="Santa Teresita (Trece)" {{ old('barangay') == 'Santa Teresita (Trece)' ? 'selected' : '' }}>Santa Teresita (Trece)</option>
                            <option value="Sigad" {{ old('barangay') == 'Sigad' ? 'selected' : '' }}>Sigad</option>
                            <option value="Somagongsong" {{ old('barangay') == 'Somagongsong' ? 'selected' : '' }}>Somagongsong</option>
                            <option value="Tarhan" {{ old('barangay') == 'Tarhan' ? 'selected' : '' }}>Tarhan</option>
                            <option value="Taromata" {{ old('barangay') == 'Taromata' ? 'selected' : '' }}>Taromata</option>
                            <option value="Zone 1 (Ilawod)" {{ old('barangay') == 'Zone 1 (Ilawod)' ? 'selected' : '' }}>Zone 1 (Ilawod)</option>
                            <option value="Zone 2 (Sabang)" {{ old('barangay') == 'Zone 2 (Sabang)' ? 'selected' : '' }}>Zone 2 (Sabang)</option>
                            <option value="Zone 3 (Central)" {{ old('barangay') == 'Zone 3 (Central)' ? 'selected' : '' }}>Zone 3 (Central)</option>
                            <option value="Zone 4 (Central Business District)" {{ old('barangay') == 'Zone 4 (Central Business District)' ? 'selected' : '' }}>Zone 4 (Central Business District)</option>
                            <option value="Zone 5 (Canipaan)" {{ old('barangay') == 'Zone 5 (Canipaan)' ? 'selected' : '' }}>Zone 5 (Canipaan)</option>
                            <option value="Zone 6 (Baybay)" {{ old('barangay') == 'Zone 6 (Baybay)' ? 'selected' : '' }}>Zone 6 (Baybay)</option>
                            <option value="Zone 7 (Iraya)" {{ old('barangay') == 'Zone 7 (Iraya)' ? 'selected' : '' }}>Zone 7 (Iraya)</option>
                            <option value="Zone 8 (Loyo)" {{ old('barangay') == 'Zone 8 (Loyo)' ? 'selected' : '' }}>Zone 8 (Loyo)</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Password -->
                <div class="relative">
                    <label for="password" class="block text-white font-semibold mb-3 text-sm uppercase tracking-wide">Password</label>
                    <div class="relative">
                        <input type="password" id="password" name="password" required 
                               class="w-full px-5 py-4 rounded-xl bg-white/10 border border-white/30 text-white placeholder-purple-200 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent input-focus backdrop-blur-sm"
                               placeholder="Create a strong password"
                               minlength="8" maxlength="128" autocomplete="new-password">
                        <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <svg class="w-5 h-5 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </button>
                    </div>
                    <!-- Password Strength Indicator -->
                    <div class="mt-2">
                        <div class="flex space-x-1">
                            <div class="password-strength flex-1 bg-gray-600"></div>
                            <div class="password-strength flex-1 bg-gray-600"></div>
                            <div class="password-strength flex-1 bg-gray-600"></div>
                            <div class="password-strength flex-1 bg-gray-600"></div>
                        </div>
                        <p id="passwordStrengthText" class="text-xs text-purple-200 mt-1"></p>
                    </div>
                </div>

                <!-- Confirm Password -->
                <div class="relative">
                    <label for="password_confirmation" class="block text-white font-semibold mb-3 text-sm uppercase tracking-wide">Confirm Password</label>
                    <div class="relative">
                        <input type="password" id="password_confirmation" name="password_confirmation" required 
                               class="w-full px-5 py-4 rounded-xl bg-white/10 border border-white/30 text-white placeholder-purple-200 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent input-focus backdrop-blur-sm"
                               placeholder="Confirm your password"
                               minlength="8" maxlength="128" autocomplete="new-password">
                        <button type="button" id="togglePasswordConfirm" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <svg class="w-5 h-5 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </button>
                    </div>
                    <p id="passwordMatchText" class="text-xs text-purple-200 mt-1"></p>
                </div>

                <!-- Terms and Conditions -->
                <div class="flex items-start space-x-3">
                    <input type="checkbox" id="terms" name="terms" required 
                           class="w-5 h-5 text-yellow-400 bg-white/10 border-white/30 rounded focus:ring-yellow-400 focus:ring-2 mt-1">
                    <label for="terms" class="text-sm text-purple-100 leading-relaxed">
                        I agree to the <a href="#" class="text-yellow-300 hover:underline font-medium">Terms of Service</a> and <a href="#" class="text-yellow-300 hover:underline font-medium">Privacy Policy</a>. I understand that my data will be securely stored and used only for community services.
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" id="submitBtn" disabled
                        class="w-full bg-gradient-to-r from-gray-400 to-gray-500 text-gray-600 font-bold py-4 rounded-xl transition-all duration-300 shadow-lg disabled:opacity-60 disabled:cursor-not-allowed disabled:transform-none enabled:from-yellow-400 enabled:to-yellow-500 enabled:hover:from-yellow-500 enabled:hover:to-yellow-600 enabled:text-purple-900 enabled:hover:scale-105 enabled:hover:shadow-xl">
                    <span id="submitText">Create Secure Account</span>
                    <svg id="submitSpinner" class="hidden animate-spin -ml-1 mr-3 h-5 w-5 text-purple-900 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </button>
            </form>

            <div class="mt-8 text-center">
                <p class="text-purple-100 text-lg">
                    Already have an account? 
                    <a href="{{ route('login') }}" class="text-yellow-300 hover:underline font-semibold">Sign in</a>
                </p>
            </div>
        </div>

        <!-- Back to Home -->
        <div class="text-center mt-8">
            <a href="/" class="text-white hover:text-yellow-300 transition-colors font-medium">
                ← Back to Home
            </a>
        </div>
    </div>

    <!-- Enhanced Security JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // CSRF Token Setup
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            // Password Toggle Functionality
            const togglePassword = document.getElementById('togglePassword');
            const togglePasswordConfirm = document.getElementById('togglePasswordConfirm');
            const passwordField = document.getElementById('password');
            const passwordConfirmField = document.getElementById('password_confirmation');
            
            togglePassword.addEventListener('click', function() {
                const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordField.setAttribute('type', type);
                this.querySelector('svg').innerHTML = type === 'password' ? 
                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>' :
                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>';
            });
            
            togglePasswordConfirm.addEventListener('click', function() {
                const type = passwordConfirmField.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordConfirmField.setAttribute('type', type);
                this.querySelector('svg').innerHTML = type === 'password' ? 
                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>' :
                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>';
            });
            
            // Password Strength Checker
            function checkPasswordStrength(password) {
                let strength = 0;
                const strengthBars = document.querySelectorAll('.password-strength');
                const strengthText = document.getElementById('passwordStrengthText');
                
                // Reset bars
                strengthBars.forEach(bar => {
                    bar.className = 'password-strength flex-1 bg-gray-600';
                });
                
                if (password.length >= 8) strength++;
                if (/[a-z]/.test(password)) strength++;
                if (/[A-Z]/.test(password)) strength++;
                if (/[0-9]/.test(password)) strength++;
                if (/[^A-Za-z0-9]/.test(password)) strength++;
                
                // Update visual indicator
                for (let i = 0; i < strength && i < 4; i++) {
                    if (strength <= 2) {
                        strengthBars[i].className = 'password-strength flex-1 strength-weak';
                    } else if (strength === 3) {
                        strengthBars[i].className = 'password-strength flex-1 strength-fair';
                    } else {
                        strengthBars[i].className = 'password-strength flex-1 strength-good';
                    }
                }
                
                // Update text
                const strengthLabels = ['Very Weak', 'Weak', 'Fair', 'Good', 'Strong'];
                strengthText.textContent = strength > 0 ? `Password Strength: ${strengthLabels[Math.min(strength - 1, 4)]}` : '';
            }
            
            // Password Match Checker
            function checkPasswordMatch() {
                const password = passwordField.value;
                const confirmPassword = passwordConfirmField.value;
                const matchText = document.getElementById('passwordMatchText');
                
                if (confirmPassword.length > 0) {
                    if (password === confirmPassword) {
                        matchText.textContent = '✓ Passwords match';
                        matchText.className = 'text-xs text-green-400 mt-1';
                    } else {
                        matchText.textContent = '✗ Passwords do not match';
                        matchText.className = 'text-xs text-red-400 mt-1';
                    }
                } else {
                    matchText.textContent = '';
                }
            }
            
            // Phone Number Formatting
            const phoneField = document.getElementById('phone_number');
            phoneField.addEventListener('input', function() {
                let value = this.value.replace(/\D/g, ''); // Remove all non-digits
                
                // Ensure it starts with 63 (Philippines country code)
                if (value.startsWith('63')) {
                    value = value.substring(2); // Remove the 63 prefix
                }
                
                // Limit to 10 digits (after removing country code)
                if (value.length > 10) {
                    value = value.substring(0, 10);
                }
                
                // Format as +63 XXX XXX XXXX
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
                
                // Validate format
                const phonePattern = /^\+63\s[0-9]{3}\s[0-9]{3}\s[0-9]{4}$/;
                if (this.value && !phonePattern.test(this.value)) {
                    this.classList.add('border-yellow-400');
                } else {
                    this.classList.remove('border-yellow-400');
                }
            });
            
            // Helper functions for inline error messages
            function showInlineError(field, message) {
                // Remove existing error message
                const existingError = field.parentNode.querySelector('.inline-error');
                if (existingError) {
                    existingError.remove();
                }
                
                // Create error message element
                const errorElement = document.createElement('p');
                errorElement.className = 'inline-error text-red-400 text-xs mt-1 flex items-center';
                errorElement.innerHTML = `
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    ${message}
                `;
                
                // Add error styling to field
                field.classList.add('border-red-400');
                
                // Insert error message after the field's container
                const fieldContainer = field.closest('.relative');
                if (fieldContainer) {
                    fieldContainer.appendChild(errorElement);
                } else {
                    field.parentNode.appendChild(errorElement);
                }
            }
            
            function clearInlineErrors() {
                // Remove all inline error messages
                document.querySelectorAll('.inline-error').forEach(error => error.remove());
                
                // Remove error styling from all fields
                document.querySelectorAll('input, select').forEach(field => {
                    field.classList.remove('border-red-400');
                });
            }
            
            // Checkbox validation and button state management
            function updateSubmitButtonState() {
                const termsCheckbox = document.getElementById('terms');
                const submitBtn = document.getElementById('submitBtn');
                
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
            
            // Event Listeners
            passwordField.addEventListener('input', function() {
                checkPasswordStrength(this.value);
                checkPasswordMatch();
            });
            
            passwordConfirmField.addEventListener('input', checkPasswordMatch);
            
            // Terms checkbox event listener
            const termsCheckbox = document.getElementById('terms');
            termsCheckbox.addEventListener('change', updateSubmitButtonState);
            
            // Initialize button state
            updateSubmitButtonState();
            
            // Form Submission Security
            const form = document.getElementById('registerForm');
            const submitBtn = document.getElementById('submitBtn');
            const submitText = document.getElementById('submitText');
            const submitSpinner = document.getElementById('submitSpinner');
            
            form.addEventListener('submit', function(e) {
                // Prevent double submission
                if (submitBtn.disabled) {
                    e.preventDefault();
                    return false;
                }
                
                // Clear previous error messages
                clearInlineErrors();
                
                let hasErrors = false;
                
                // Validate password match
                if (passwordField.value !== passwordConfirmField.value) {
                    showInlineError(passwordConfirmField, 'Passwords do not match. Please check and try again.');
                    hasErrors = true;
                }
                
                // Validate phone number format
                const phonePattern = /^\+63\s[0-9]{3}\s[0-9]{3}\s[0-9]{4}$/;
                if (phoneField.value && !phonePattern.test(phoneField.value)) {
                    showInlineError(phoneField, 'Please enter a valid phone number in the format: +63 912 345 6789');
                    hasErrors = true;
                }
                
                // Validate required fields
                const requiredFields = [
                    { field: document.getElementById('name'), message: 'Full name is required.' },
                    { field: document.getElementById('email'), message: 'Email address is required.' },
                    { field: document.getElementById('barangay'), message: 'Please select your barangay.' },
                    { field: passwordField, message: 'Password is required.' },
                    { field: passwordConfirmField, message: 'Please confirm your password.' }
                ];
                
                requiredFields.forEach(({ field, message }) => {
                    if (!field.value.trim()) {
                        showInlineError(field, message);
                        hasErrors = true;
                    }
                });
                
                // Validate terms checkbox
                const termsCheckbox = document.getElementById('terms');
                if (!termsCheckbox.checked) {
                    showInlineError(termsCheckbox, 'You must agree to the Terms of Service and Privacy Policy.');
                    hasErrors = true;
                }
                
                if (hasErrors) {
                    e.preventDefault();
                    return false;
                }
                
                // Show loading state
                submitBtn.disabled = true;
                submitText.textContent = 'Creating Account...';
                submitSpinner.classList.remove('hidden');
                
                // Re-enable after 10 seconds as fallback
                setTimeout(() => {
                    submitBtn.disabled = false;
                    submitText.textContent = 'Create Secure Account';
                    submitSpinner.classList.add('hidden');
                }, 10000);
            });
            
            // Input Validation - Clear errors on input
            const inputs = document.querySelectorAll('input, select');
            inputs.forEach(input => {
                input.addEventListener('input', function() {
                    // Clear inline error for this field
                    const existingError = this.closest('.relative')?.querySelector('.inline-error');
                    if (existingError) {
                        existingError.remove();
                    }
                    
                    // Remove error styling
                    this.classList.remove('border-red-400');
                });
                
                input.addEventListener('blur', function() {
                    if (!this.value.trim() && this.hasAttribute('required')) {
                        this.classList.add('border-red-400');
                    } else {
                        this.classList.remove('border-red-400');
                    }
                });
            });
        });
    </script>
</body>
</html>
