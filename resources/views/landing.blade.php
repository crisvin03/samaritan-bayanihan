<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bayanihan System - Join Our Community</title>
    
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
        .floating {
            animation: floating 3s ease-in-out infinite;
        }
        @keyframes floating {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        .pulse-slow {
            animation: pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
    </style>
</head>
<body class="min-h-screen gradient-bg">
    <!-- Navigation -->
    <nav class="relative z-10 px-6 py-6">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <div class="w-20 h-20 rounded-xl overflow-hidden shadow-2xl border-3 border-white/30 bg-white p-2">
                    <img src="{{ asset('images/logo.png') }}" alt="Bayanihan Logo" class="w-full h-full object-contain">
                </div>
                <span class="text-white font-bold text-2xl">Samaritan</span>
            </div>
            <div class="hidden md:flex items-center space-x-8">
                <a href="#features" class="text-white hover:text-yellow-300 transition-colors font-medium">About</a>
                <a href="#benefits" class="text-white hover:text-yellow-300 transition-colors font-medium">Benefits</a>
                <a href="{{ route('login') }}" class="text-white hover:text-yellow-300 transition-colors font-medium">Sign In</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 py-20">
            <div class="text-center">
                <!-- Main Hero Content -->
                <div class="max-w-4xl mx-auto">
                    <h1 class="text-6xl lg:text-7xl font-bold leading-tight mb-8 text-white">
                        Welcome to
                        <span class="text-yellow-300">Samaritan Bayanihan Inc.</span>
                    </h1>
                    <p class="text-2xl text-purple-100 mb-12 leading-relaxed max-w-3xl mx-auto">
                    We help each other through savings and support. Together, we build a caring community where no one is left behind.
                    </p>
                    
                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row gap-6 justify-center items-center mb-16">
                        <a href="{{ route('register') }}" class="bg-yellow-400 hover:bg-yellow-500 text-purple-900 font-semibold px-10 py-4 rounded-lg transition-all duration-300 transform hover:scale-105 shadow-lg text-lg">
                            Join Our Community
                        </a>
                        <a href="{{ route('login') }}" class="border-2 border-white text-white hover:bg-white hover:text-purple-600 font-semibold px-10 py-4 rounded-lg transition-all duration-300 text-lg">
                            Sign In
                        </a>
                    </div>

                    <!-- Trust Indicators -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-8 max-w-2xl mx-auto">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-yellow-400 mb-2">5K+</div>
                            <div class="text-purple-200 text-sm">Active Members</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-yellow-400 mb-2">500+</div>
                            <div class="text-purple-200 text-sm">Families Supported</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-yellow-400 mb-2">63</div>
                            <div class="text-purple-200 text-sm">Barangays Reached</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-yellow-400 mb-2">Everyday</div>
                            <div class="text-purple-200 text-sm">Support for Needs</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <section id="features" class="py-20 bg-white/5 backdrop-blur-sm">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-white mb-4">Why Choose Bayanihan?</h2>
                <p class="text-xl text-purple-100 max-w-2xl mx-auto">
                Discover the benefits that make Samaritan Bayanihan Inc. special
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="glass-effect rounded-xl p-8 text-center hover:transform hover:scale-105 transition-all duration-300">
                    <div class="w-16 h-16 bg-yellow-400 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-purple-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-4">Community Support</h3>
                    <p class="text-purple-100">Be part of a caring group that provides financial and emotional assistance during life's important moments.</p>
                </div>

                <div class="glass-effect rounded-xl p-8 text-center hover:transform hover:scale-105 transition-all duration-300">
                    <div class="w-16 h-16 bg-yellow-400 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-purple-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-4">Affordable Savings</h3>
                    <p class="text-purple-100">Grow your funds through simple and accessible contributions designed for every family.</p>
                </div>

                <div class="glass-effect rounded-xl p-8 text-center hover:transform hover:scale-105 transition-all duration-300">
                    <div class="w-16 h-16 bg-yellow-400 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-purple-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-4">Transparent Management</h3>
                    <p class="text-purple-100">Track collections and expenses through regular reports, ensuring trust and accountability.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section id="benefits" class="py-20">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-white mb-4">Member Benefits</h2>
                <p class="text-xl text-purple-100 max-w-2xl mx-auto">
                    Comprehensive support for all your family's needs
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Burial Assistance -->
                <div class="glass-effect rounded-2xl p-6 text-center hover:transform hover:scale-105 transition-all duration-300 hover:shadow-2xl hover:shadow-yellow-400/20 h-full flex flex-col">
                    <div class="w-24 h-24 mx-auto mb-4 rounded-2xl overflow-hidden shadow-lg border-4 border-yellow-400/30 flex-shrink-0">
                        <img src="{{ asset('images/burial-assistance.jpg') }}" alt="Burial Assistance" class="w-full h-full object-cover hover:scale-110 transition-transform duration-300">
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3 flex-shrink-0">Burial Assistance</h3>
                    <p class="text-purple-100 text-sm leading-relaxed flex-grow flex items-center justify-center">from ₱1,500 up to ₱50,000</p>
                </div>

                <!-- Accidental Assistance -->
                <div class="glass-effect rounded-2xl p-6 text-center hover:transform hover:scale-105 transition-all duration-300 hover:shadow-2xl hover:shadow-yellow-400/20 h-full flex flex-col">
                    <div class="w-24 h-24 mx-auto mb-4 rounded-2xl overflow-hidden shadow-lg border-4 border-yellow-400/30 flex-shrink-0">
                        <img src="{{ asset('images/accidental-assistance.jpg') }}" alt="Accidental Assistance" class="w-full h-full object-cover hover:scale-110 transition-transform duration-300">
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3 flex-shrink-0">Accidental Assistance</h3>
                    <p class="text-purple-100 text-sm leading-relaxed flex-grow flex items-center justify-center">from ₱500 up to ₱10,000</p>
                </div>

                <!-- Hospitalization Benefit -->
                <div class="glass-effect rounded-2xl p-6 text-center hover:transform hover:scale-105 transition-all duration-300 hover:shadow-2xl hover:shadow-yellow-400/20 h-full flex flex-col">
                    <div class="w-24 h-24 mx-auto mb-4 rounded-2xl overflow-hidden shadow-lg border-4 border-yellow-400/30 flex-shrink-0">
                        <img src="{{ asset('images/hospitalization-benefit.jpg') }}" alt="Hospitalization Benefit" class="w-full h-full object-cover hover:scale-110 transition-transform duration-300">
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3 flex-shrink-0">Hospitalization Benefit</h3>
                    <p class="text-purple-100 text-sm leading-relaxed flex-grow flex items-center justify-center">from ₱500 up to ₱10,000</p>
                </div>

                <!-- Maternity Benefit -->
                <div class="glass-effect rounded-2xl p-6 text-center hover:transform hover:scale-105 transition-all duration-300 hover:shadow-2xl hover:shadow-yellow-400/20 h-full flex flex-col">
                    <div class="w-24 h-24 mx-auto mb-4 rounded-2xl overflow-hidden shadow-lg border-4 border-yellow-400/30 flex-shrink-0">
                        <img src="{{ asset('images/maternity-benefit.jpg') }}" alt="Maternity Benefit" class="w-full h-full object-cover hover:scale-110 transition-transform duration-300">
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3 flex-shrink-0">Maternity Benefit</h3>
                    <p class="text-purple-100 text-sm leading-relaxed flex-grow flex items-center justify-center">from ₱500 up to ₱1,500</p>
                </div>

                <!-- Animal Bite Assistance -->
                <div class="glass-effect rounded-2xl p-6 text-center hover:transform hover:scale-105 transition-all duration-300 hover:shadow-2xl hover:shadow-yellow-400/20 h-full flex flex-col">
                    <div class="w-24 h-24 mx-auto mb-4 rounded-2xl overflow-hidden shadow-lg border-4 border-yellow-400/30 flex-shrink-0">
                        <img src="{{ asset('images/animal-bite-assistance.jpg') }}" alt="Animal Bite Assistance" class="w-full h-full object-cover hover:scale-110 transition-transform duration-300">
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3 flex-shrink-0">Animal Bite Assistance</h3>
                    <p class="text-purple-100 text-sm leading-relaxed flex-grow flex items-center justify-center">₱300 financial aid for animal bite cases</p>
                </div>

                <!-- Birthday Cake or Cash Gift -->
                <div class="glass-effect rounded-2xl p-6 text-center hover:transform hover:scale-105 transition-all duration-300 hover:shadow-2xl hover:shadow-yellow-400/20 h-full flex flex-col">
                    <div class="w-24 h-24 mx-auto mb-4 rounded-2xl overflow-hidden shadow-lg border-4 border-yellow-400/30 flex-shrink-0">
                        <img src="{{ asset('images/birthday-gift.jpg') }}" alt="Birthday Cake or Cash Gift" class="w-full h-full object-cover hover:scale-110 transition-transform duration-300">
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3 flex-shrink-0">Birthday Cake or Cash Gift</h3>
                    <p class="text-purple-100 text-sm leading-relaxed flex-grow flex items-center justify-center">Annual Birthday Cake or Cash Gift worth ₱300</p>
                </div>

                <!-- Outpatient Benefit -->
                <div class="glass-effect rounded-2xl p-6 text-center hover:transform hover:scale-105 transition-all duration-300 hover:shadow-2xl hover:shadow-yellow-400/20 h-full flex flex-col">
                    <div class="w-24 h-24 mx-auto mb-4 rounded-2xl overflow-hidden shadow-lg border-4 border-yellow-400/30 flex-shrink-0">
                        <img src="{{ asset('images/outpatient-benefit.jpg') }}" alt="Outpatient Benefit" class="w-full h-full object-cover hover:scale-110 transition-transform duration-300">
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3 flex-shrink-0">Outpatient Benefit</h3>
                    <p class="text-purple-100 text-sm leading-relaxed flex-grow flex items-center justify-center">worth ₱200 for those not admitted to the hospital</p>
                </div>

                <!-- No Age Limit -->
                <div class="glass-effect rounded-2xl p-6 text-center hover:transform hover:scale-105 transition-all duration-300 hover:shadow-2xl hover:shadow-yellow-400/20 h-full flex flex-col">
                    <div class="w-24 h-24 mx-auto mb-4 rounded-2xl overflow-hidden shadow-lg border-4 border-yellow-400/30 bg-gradient-to-br from-yellow-400 to-yellow-600 flex items-center justify-center flex-shrink-0">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3 flex-shrink-0">No Age Limit</h3>
                    <p class="text-purple-100 text-sm leading-relaxed flex-grow flex items-center justify-center">Open to all ages - from children to seniors, everyone is welcome to join our community.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-black/30 backdrop-blur-sm py-16">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid md:grid-cols-3 gap-12 items-center">
                <!-- Logo Section -->
                <div class="text-center md:text-left">
                    <div class="flex items-center justify-center md:justify-start space-x-3 mb-4">
                        <div class="w-12 h-12 rounded-lg overflow-hidden shadow-lg border-2 border-white/20 bg-white p-1">
                            <img src="{{ asset('images/logo.png') }}" alt="Bayanihan Logo" class="w-full h-full object-contain">
                        </div>
                        <span class="text-white font-bold text-xl">Samaritan Bayanihan Inc.</span>
                    </div>
                    <p class="text-purple-200 text-sm">Building stronger communities through mutual support</p>
                </div>

                <!-- Contact Information -->
                <div class="text-center">
                    <h4 class="text-white font-semibold text-lg mb-6">Contact Us</h4>
                    <div class="space-y-3">
                        <div class="flex items-center justify-center space-x-3">
                            <div class="w-6 h-6 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <a href="mailto:info@samaritanbayanihan.com" class="text-purple-200 hover:text-yellow-300 transition-colors text-left">info@samaritanbayanihan.com</a>
                        </div>
                        <div class="flex items-center justify-center space-x-3">
                            <div class="w-6 h-6 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                            </div>
                            <span class="text-purple-200 text-left">+63 (XXX) XXX-XXXX</span>
                        </div>
                        <div class="flex items-center justify-center space-x-3">
                            <div class="w-6 h-6 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <span class="text-purple-200 text-left">Bulan, Sorsogon, Philippines</span>
                        </div>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="text-center md:text-right">
                    <h4 class="text-white font-semibold text-lg mb-6">Quick Links</h4>
                    <div class="space-y-3 text-purple-200">
                        <div><a href="#features" class="hover:text-yellow-300 transition-colors">About Us</a></div>
                        <div><a href="#benefits" class="hover:text-yellow-300 transition-colors">Benefits</a></div>
                        <div><a href="{{ route('register') }}" class="hover:text-yellow-300 transition-colors">Join Now</a></div>
                        <div><a href="{{ route('login') }}" class="hover:text-yellow-300 transition-colors">Member Login</a></div>
                    </div>
                </div>
            </div>
            
            <!-- Copyright -->
            <div class="border-t border-white/10 mt-12 pt-8 text-center">
                <p class="text-purple-200 text-sm">&copy; 2025 Samaritan Bayanihan Inc. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Smooth scrolling script -->
    <script>
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</body>
</html>
