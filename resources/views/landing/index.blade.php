<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Portfolio Builder') }} - Create Your Professional Portfolio</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Inter', sans-serif; }
        .hero-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
        }
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .feature-card {
            transition: all 0.3s ease;
        }
        .feature-card:hover {
            transform: translateY(-8px);
        }
        .floating-animation {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        /* Mobile navigation improvements */
        @media (max-width: 768px) {
            .mobile-nav-menu {
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            }

            /* Ensure proper spacing for mobile logo */
            .mobile-logo h1 {
                font-size: 1.125rem;
                line-height: 1.75rem;
            }

            /* Mobile menu button improvements */
            .mobile-menu-btn {
                padding: 0.5rem;
                border-radius: 0.375rem;
            }

            /* Prevent text overflow on small screens */
            .mobile-nav-item {
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }
        }

        /* Ensure navigation doesn't interfere with content */
        .nav-spacer {
            height: 4rem; /* 64px - same as nav height */
        }
    </style>
</head>
<body class="font-sans antialiased">
    <!-- Navigation -->
    <nav x-data="{ open: false }" class="bg-white/95 backdrop-blur-sm shadow-lg fixed w-full z-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="flex items-center mobile-logo">
                            <div class="w-8 h-8 sm:w-10 sm:h-10 bg-gradient-to-br from-blue-600 to-purple-600 rounded-xl flex items-center justify-center mr-2 sm:mr-3">
                                <i class="fas fa-briefcase text-white text-sm sm:text-lg"></i>
                            </div>
                            <h1 class="text-lg sm:text-2xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                                Portfolio Builder
                            </h1>
                        </div>
                    </div>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-gray-700 hover:text-blue-600 px-4 py-2 rounded-lg text-sm font-semibold transition-all duration-200 hover:bg-blue-50">
                                <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 px-4 py-2 rounded-lg text-sm font-semibold transition-all duration-200 hover:bg-gray-50">
                                <i class="fas fa-sign-in-alt mr-2"></i>Sign In
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white px-6 py-2 rounded-lg text-sm font-semibold transition-all duration-200 shadow-lg transform hover:-translate-y-0.5">
                                    <i class="fas fa-rocket mr-2"></i>Get Started
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button @click="open = ! open" class="mobile-menu-btn inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <div :class="{'block': open, 'hidden': ! open}" class="hidden md:hidden mobile-nav-menu">
            <div class="px-2 pt-2 pb-3 space-y-1 bg-white border-t border-gray-200">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" @click="open = false" class="mobile-nav-item block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50 transition-colors duration-200">
                            <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" @click="open = false" class="mobile-nav-item block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50 transition-colors duration-200">
                            <i class="fas fa-sign-in-alt mr-2"></i>Sign In
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" @click="open = false" class="mobile-nav-item block px-3 py-2 rounded-md text-base font-medium bg-gradient-to-r from-blue-600 to-purple-600 text-white hover:from-blue-700 hover:to-purple-700 transition-all duration-200 shadow-md">
                                <i class="fas fa-rocket mr-2"></i>Get Started
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-16 hero-bg relative overflow-hidden">
        <div class="absolute inset-0 bg-black/10"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Left Content -->
                <div class="text-center lg:text-left">
                    <div class="mb-6">
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-white/20 text-white backdrop-blur-sm border border-white/30">
                            <i class="fas fa-star mr-2 text-yellow-300"></i>
                            Trusted by 10,000+ Professionals
                        </span>
                    </div>
                    <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 leading-tight">
                        Build Your
                        <span class="text-yellow-300">
                            Dream Portfolio
                        </span>
                        <br>in Minutes
                    </h1>
                    <p class="text-xl text-blue-100 mb-8 max-w-2xl">
                        Create a stunning, professional portfolio that showcases your skills and attracts opportunities.
                        No coding required – just your creativity.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        @guest
                            <a href="{{ route('register') }}" class="inline-flex items-center px-8 py-4 border border-transparent text-lg font-semibold rounded-xl text-blue-600 bg-white hover:bg-gray-50 transition-all duration-200 shadow-xl transform hover:-translate-y-1">
                                <i class="fas fa-rocket mr-3"></i>Start Building Free
                            </a>
                            <a href="#portfolios" class="inline-flex items-center px-8 py-4 border-2 border-white/30 text-lg font-semibold rounded-xl text-white bg-white/10 hover:bg-white/20 backdrop-blur-sm transition-all duration-200">
                                <i class="fas fa-play mr-3"></i>Watch Demo
                            </a>
                        @else
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-8 py-4 border border-transparent text-lg font-semibold rounded-xl text-blue-600 bg-white hover:bg-gray-50 transition-all duration-200 shadow-xl transform hover:-translate-y-1">
                                <i class="fas fa-tachometer-alt mr-3"></i>Go to Dashboard
                            </a>
                        @endguest
                    </div>

                    <!-- Stats -->
                    <div class="mt-12 grid grid-cols-3 gap-8 text-center lg:text-left">
                        <div>
                            <div class="text-3xl font-bold text-white">10K+</div>
                            <div class="text-blue-200 text-sm">Active Users</div>
                        </div>
                        <div>
                            <div class="text-3xl font-bold text-white">50K+</div>
                            <div class="text-blue-200 text-sm">Portfolios Created</div>
                        </div>
                        <div>
                            <div class="text-3xl font-bold text-white">99%</div>
                            <div class="text-blue-200 text-sm">Satisfaction Rate</div>
                        </div>
                    </div>
                </div>

                <!-- Right Content - Dashboard Preview -->
                <div class="relative lg:block hidden">
                    <div class="floating-animation">
                        <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20 shadow-2xl">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-3 h-3 bg-red-400 rounded-full"></div>
                                    <div class="w-3 h-3 bg-yellow-400 rounded-full"></div>
                                    <div class="w-3 h-3 bg-green-400 rounded-full"></div>
                                </div>
                                <div class="text-white/60 text-sm">Portfolio Dashboard</div>
                            </div>
                            <div class="space-y-4">
                                <div class="bg-white/20 rounded-lg p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <div class="text-white font-semibold">Portfolio Views</div>
                                        <div class="text-green-300">+24%</div>
                                    </div>
                                    <div class="text-2xl font-bold text-white">2,847</div>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="bg-white/20 rounded-lg p-3">
                                        <div class="text-white/80 text-sm">Projects</div>
                                        <div class="text-xl font-bold text-white">12</div>
                                    </div>
                                    <div class="bg-white/20 rounded-lg p-3">
                                        <div class="text-white/80 text-sm">Messages</div>
                                        <div class="text-xl font-bold text-white">8</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Decorative Elements -->
        <div class="absolute top-20 left-10 w-20 h-20 bg-white/10 rounded-full blur-xl"></div>
        <div class="absolute bottom-20 right-10 w-32 h-32 bg-purple-300/20 rounded-full blur-2xl"></div>
        <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-yellow-300/20 rounded-full blur-xl"></div>
    </section>

    <!-- Features Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Everything You Need to Showcase Your Work
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Our comprehensive portfolio builder includes all the features you need to create a professional online presence.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="feature-card text-center p-8 rounded-2xl bg-gradient-to-br from-blue-50 to-blue-100 border border-blue-200 shadow-xl">
                    <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                        <i class="fas fa-id-card text-white text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Professional Profile</h3>
                    <p class="text-gray-600 leading-relaxed">Create a compelling professional profile with your bio, contact information, and personal branding that makes a lasting impression.</p>
                </div>

                <div class="feature-card text-center p-8 rounded-2xl bg-gradient-to-br from-green-50 to-green-100 border border-green-200 shadow-xl">
                    <div class="w-20 h-20 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                        <i class="fas fa-project-diagram text-white text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Project Showcase</h3>
                    <p class="text-gray-600 leading-relaxed">Display your best work with detailed project descriptions, stunning images, and live demo links that captivate visitors.</p>
                </div>

                <div class="feature-card text-center p-8 rounded-2xl bg-gradient-to-br from-purple-50 to-purple-100 border border-purple-200 shadow-xl">
                    <div class="w-20 h-20 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                        <i class="fas fa-cogs text-white text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Skills & Expertise</h3>
                    <p class="text-gray-600 leading-relaxed">Highlight your technical skills and expertise with beautiful visual proficiency indicators and skill categories.</p>
                </div>

                <div class="feature-card text-center p-8 rounded-2xl bg-gradient-to-br from-orange-50 to-orange-100 border border-orange-200 shadow-xl">
                    <div class="w-20 h-20 bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                        <i class="fas fa-briefcase text-white text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Work Experience</h3>
                    <p class="text-gray-600 leading-relaxed">Document your professional journey with detailed work experience, achievements, and career milestones.</p>
                </div>

                <div class="feature-card text-center p-8 rounded-2xl bg-gradient-to-br from-indigo-50 to-indigo-100 border border-indigo-200 shadow-xl">
                    <div class="w-20 h-20 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                        <i class="fas fa-star text-white text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Client Testimonials</h3>
                    <p class="text-gray-600 leading-relaxed">Build trust with potential clients by showcasing authentic testimonials and reviews from satisfied customers.</p>
                </div>

                <div class="feature-card text-center p-8 rounded-2xl bg-gradient-to-br from-pink-50 to-pink-100 border border-pink-200 shadow-xl">
                    <div class="w-20 h-20 bg-gradient-to-br from-pink-500 to-pink-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                        <i class="fas fa-envelope text-white text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Contact Management</h3>
                    <p class="text-gray-600 leading-relaxed">Receive and manage inquiries from potential clients directly through your portfolio with built-in messaging system.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Portfolios Section -->
    @if($featuredUsers->count() > 0)
    <section id="portfolios" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Featured Portfolios
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Discover amazing portfolios created by our community of professionals.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($featuredUsers as $user)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            @if($user->profile && $user->profile->avatar)
                                <img src="{{ Storage::url($user->profile->avatar) }}" alt="{{ $user->name }}" class="w-12 h-12 rounded-full object-cover">
                            @else
                                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                                    <span class="text-white font-semibold">{{ substr($user->name, 0, 1) }}</span>
                                </div>
                            @endif
                            <div class="ml-3">
                                <h3 class="text-lg font-semibold text-gray-900">{{ $user->name }}</h3>
                                @if($user->profile && $user->profile->profession)
                                    <p class="text-sm text-gray-600">{{ $user->profile->profession }}</p>
                                @endif
                            </div>
                        </div>
                        
                        @if($user->profile && $user->profile->bio)
                            <p class="text-gray-600 mb-4">{{ Str::limit($user->profile->bio, 100) }}</p>
                        @endif
                        
                        @if($user->projects->count() > 0)
                            <div class="mb-4">
                                <h4 class="text-sm font-medium text-gray-900 mb-2">Recent Projects:</h4>
                                <div class="space-y-2">
                                    @foreach($user->projects->take(2) as $project)
                                        <div class="text-sm text-gray-600">
                                            <i class="fas fa-project-diagram mr-1 text-blue-500"></i>
                                            {{ $project->title }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        
                        <a href="{{ route('portfolio.show', $user) }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                            View Portfolio <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-blue-600 to-purple-600">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                Ready to Build Your Portfolio?
            </h2>
            <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
                Join thousands of professionals who have already created their stunning portfolios with Portfolio Builder.
            </p>
            @guest
                <a href="{{ route('register') }}" class="inline-flex items-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-blue-600 bg-white hover:bg-gray-50">
                    <i class="fas fa-rocket mr-2"></i>Get Started Today - It's Free!
                </a>
            @else
                <a href="{{ route('dashboard') }}" class="inline-flex items-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-blue-600 bg-white hover:bg-gray-50">
                    <i class="fas fa-tachometer-alt mr-2"></i>Go to Your Dashboard
                </a>
            @endguest
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="col-span-1 md:col-span-2">
                    <h3 class="text-2xl font-bold mb-4">
                        <i class="fas fa-briefcase mr-2"></i>Portfolio Builder
                    </h3>
                    <p class="text-gray-400 mb-4">
                        The easiest way to create a professional portfolio website that showcases your skills and attracts opportunities.
                    </p>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold mb-4">Features</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><i class="fas fa-check mr-2 text-green-500"></i>Professional Templates</li>
                        <li><i class="fas fa-check mr-2 text-green-500"></i>Project Showcase</li>
                        <li><i class="fas fa-check mr-2 text-green-500"></i>Contact Management</li>
                        <li><i class="fas fa-check mr-2 text-green-500"></i>Skills Display</li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold mb-4">Get Started</h4>
                    <ul class="space-y-2 text-gray-400">
                        @guest
                            <li><a href="{{ route('register') }}" class="hover:text-white"><i class="fas fa-user-plus mr-2"></i>Sign Up</a></li>
                            <li><a href="{{ route('login') }}" class="hover:text-white"><i class="fas fa-sign-in-alt mr-2"></i>Log In</a></li>
                        @else
                            <li><a href="{{ route('dashboard') }}" class="hover:text-white"><i class="fas fa-tachometer-alt mr-2"></i>Dashboard</a></li>
                        @endguest
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} Portfolio Builder. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>