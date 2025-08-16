@extends('layouts.pages.base')
@section('content')
    <!-- Navigation -->
    <nav class="bg-white shadow-lg fixed w-full z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <h1 class="text-xl font-bold text-gray-900">{{ $user->name }}</h1>
                </div>
                <div class="flex items-center space-x-6">
                    <a href="#about" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium">About</a>
                    @if($user->skills->count() > 0)
                        <a href="#skills" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium">Skills</a>
                    @endif
                    @if($user->experiences->count() > 0)
                        <a href="#experience" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium">Experience</a>
                    @endif
                    @if($user->projects->count() > 0)
                        <a href="#projects" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium">Projects</a>
                    @endif
                    @if($user->services->count() > 0)
                        <a href="#services" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium">Services</a>
                    @endif
                    <a href="#contact" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">Contact</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="about" class="pt-16 bg-gradient-to-br from-blue-50 via-white to-purple-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="text-center">
                @if($user->profile && $user->profile->avatar)
                    <img src="{{ Storage::url($user->profile->avatar) }}" alt="{{ $user->name }}" class="w-32 h-32 rounded-full mx-auto mb-6 object-cover shadow-lg">
                @else
                    <div class="w-32 h-32 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg">
                        <span class="text-white text-4xl font-semibold">{{ substr($user->name, 0, 1) }}</span>
                    </div>
                @endif
                
                <h1 class="text-4xl md:text-6xl font-bold text-gray-900 mb-4">{{ $user->name }}</h1>
                
                @if($user->profile && $user->profile->title)
                    <p class="text-xl md:text-2xl text-gray-600 mb-6">{{ $user->profile->title }}</p>
                @endif
                
                @if($user->profile && $user->profile->bio)
                    <p class="text-lg text-gray-600 mb-8 max-w-3xl mx-auto">{{ $user->profile->bio }}</p>
                @endif
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center mb-8">
                    <a href="#contact" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                        <i class="fas fa-envelope mr-2"></i>Get In Touch
                    </a>
                    @if($user->profile && $user->profile->resume)
                        <a href="{{ Storage::url($user->profile->resume) }}" target="_blank" class="inline-flex items-center px-6 py-3 border border-gray-300 text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                            <i class="fas fa-download mr-2"></i>Download Resume
                        </a>
                    @endif
                </div>
                
                @if($user->socials->count() > 0)
                    <div class="flex justify-center space-x-4">
                        @foreach($user->socials as $social)
                            <a href="{{ $social->url }}" target="_blank" class="text-gray-600 hover:text-blue-600 text-2xl">
                                @if($social->icon)
                                    <i class="{{ $social->icon }}"></i>
                                @else
                                    <i class="fas fa-link"></i>
                                @endif
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </section>

    @if($user->profile && $user->profile->about_me)
        <!-- About Me Section -->
        <section class="py-20 bg-white">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-gray-900 text-center mb-12">About Me</h2>
                <div class="text-lg text-gray-600 leading-relaxed whitespace-pre-line">{{ $user->profile->about_me }}</div>
            </div>
        </section>
    @endif

    @if($user->skills->count() > 0)
        <!-- Skills Section -->
        <section id="skills" class="py-20 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-gray-900 text-center mb-12">Skills & Expertise</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($user->skills as $skill)
                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="text-lg font-semibold text-gray-900">{{ $skill->name }}</h3>
                                @if($skill->is_featured)
                                    <i class="fas fa-star text-yellow-500"></i>
                                @endif
                            </div>
                            @if($skill->category)
                                <p class="text-sm text-gray-600 mb-3">{{ $skill->category }}</p>
                            @endif
                            <div class="w-full bg-gray-200 rounded-full h-2 mb-2">
                                <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $skill->proficiency }}%"></div>
                            </div>
                            <div class="flex justify-between text-sm text-gray-600">
                                <span>Proficiency</span>
                                <span>{{ $skill->proficiency }}%</span>
                            </div>
                            @if($skill->description)
                                <p class="text-sm text-gray-600 mt-2">{{ $skill->description }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if($user->experiences->count() > 0)
        <!-- Experience Section -->
        <section id="experience" class="py-20 bg-white">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-gray-900 text-center mb-12">Work Experience</h2>
                <div class="space-y-8">
                    @foreach($user->experiences as $experience)
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4">
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-900">{{ $experience->position }}</h3>
                                    <p class="text-lg text-blue-600">{{ $experience->company }}</p>
                                    @if($experience->location)
                                        <p class="text-sm text-gray-600">{{ $experience->location }}</p>
                                    @endif
                                </div>
                                <div class="text-sm text-gray-600 mt-2 md:mt-0">
                                    {{ $experience->start_date->format('M Y') }} - 
                                    {{ $experience->is_current ? 'Present' : $experience->end_date->format('M Y') }}
                                </div>
                            </div>
                            @if($experience->description)
                                <p class="text-gray-600 mb-4">{{ $experience->description }}</p>
                            @endif
                            @if($experience->technologies)
                                <div class="flex flex-wrap gap-2">
                                    @foreach($experience->technologies as $tech)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                            {{ $tech }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if($user->projects->count() > 0)
        <!-- Projects Section -->
        <section id="projects" class="py-20 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-gray-900 text-center mb-12">Featured Projects</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($user->projects as $project)
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                            @if($project->image)
                                <div class="h-48">
                                    <img src="{{ Storage::url($project->image) }}" alt="{{ $project->title }}" class="w-full h-full object-cover">
                                </div>
                            @else
                                <div class="h-48 bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                                    <i class="fas fa-project-diagram text-white text-4xl"></i>
                                </div>
                            @endif
                            
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-2">
                                    <h3 class="text-xl font-semibold text-gray-900">{{ $project->title }}</h3>
                                    @if($project->is_featured)
                                        <i class="fas fa-star text-yellow-500"></i>
                                    @endif
                                </div>
                                
                                <p class="text-gray-600 mb-4">{{ $project->description }}</p>
                                
                                @if($project->technologies)
                                    <div class="mb-4">
                                        <div class="flex flex-wrap gap-2">
                                            @foreach($project->technologies as $tech)
                                                <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                                    {{ $tech }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                
                                <div class="flex space-x-4">
                                    @if($project->demo_url)
                                        <a href="{{ $project->demo_url }}" target="_blank" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                                            <i class="fas fa-external-link-alt mr-1"></i>Live Demo
                                        </a>
                                    @endif
                                    @if($project->github_url)
                                        <a href="{{ $project->github_url }}" target="_blank" class="inline-flex items-center text-gray-600 hover:text-gray-800 font-medium">
                                            <i class="fab fa-github mr-1"></i>View Code
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if($user->services->count() > 0)
        <!-- Services Section -->
        <section id="services" class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-gray-900 text-center mb-12">Services</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($user->services as $service)
                        <div class="bg-gray-50 p-6 rounded-lg text-center">
                            @if($service->icon)
                                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="{{ $service->icon }} text-blue-600 text-2xl"></i>
                                </div>
                            @endif
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $service->title }}</h3>
                            <p class="text-gray-600 mb-4">{{ $service->description }}</p>
                            @if($service->price)
                                <div class="text-2xl font-bold text-blue-600 mb-2">
                                    ${{ number_format($service->price, 0) }}
                                    @if($service->price_type)
                                        <span class="text-sm text-gray-600">/ {{ $service->price_type }}</span>
                                    @endif
                                </div>
                            @endif
                            @if($service->features)
                                <ul class="text-sm text-gray-600 space-y-1">
                                    @foreach($service->features as $feature)
                                        <li><i class="fas fa-check text-green-500 mr-2"></i>{{ $feature }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if($user->testimonials->count() > 0)
        <!-- Testimonials Section -->
        <section class="py-20 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-gray-900 text-center mb-12">What Clients Say</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($user->testimonials as $testimonial)
                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <div class="flex items-center mb-4">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $testimonial->rating ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                                @endfor
                            </div>
                            <p class="text-gray-600 mb-4">"{{ $testimonial->content }}"</p>
                            <div class="flex items-center">
                                @if($testimonial->client_avatar)
                                    <img src="{{ Storage::url($testimonial->client_avatar) }}" alt="{{ $testimonial->client_name }}" class="w-10 h-10 rounded-full object-cover mr-3">
                                @else
                                    <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center mr-3">
                                        <span class="text-gray-600 font-semibold text-sm">{{ substr($testimonial->client_name, 0, 1) }}</span>
                                    </div>
                                @endif
                                <div>
                                    <p class="font-semibold text-gray-900">{{ $testimonial->client_name }}</p>
                                    @if($testimonial->client_position && $testimonial->client_company)
                                        <p class="text-sm text-gray-600">{{ $testimonial->client_position }} at {{ $testimonial->client_company }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Contact Section -->
    <section id="contact" class="py-20 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-gray-900 text-center mb-12">Get In Touch</h2>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-6">Contact Information</h3>
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <i class="fas fa-envelope text-blue-600 w-6"></i>
                            <span class="ml-3 text-gray-600">{{ $user->email }}</span>
                        </div>
                        @if($user->profile && $user->profile->phone)
                            <div class="flex items-center">
                                <i class="fas fa-phone text-blue-600 w-6"></i>
                                <span class="ml-3 text-gray-600">{{ $user->profile->phone }}</span>
                            </div>
                        @endif
                        @if($user->profile && $user->profile->location)
                            <div class="flex items-center">
                                <i class="fas fa-map-marker-alt text-blue-600 w-6"></i>
                                <span class="ml-3 text-gray-600">{{ $user->profile->location }}</span>
                            </div>
                        @endif
                        @if($user->profile && $user->profile->website)
                            <div class="flex items-center">
                                <i class="fas fa-globe text-blue-600 w-6"></i>
                                <a href="{{ $user->profile->website }}" target="_blank" class="ml-3 text-blue-600 hover:text-blue-800">{{ $user->profile->website }}</a>
                            </div>
                        @endif
                    </div>
                </div>
                
                <div>
                    <form method="POST" action="{{ route('contact.store', $user) }}" class="space-y-6">
                        @csrf
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input type="text" name="name" id="name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        
                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-700">Subject</label>
                            <input type="text" name="subject" id="subject" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                            <textarea name="message" id="message" rows="4" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                        </div>
                        
                        <div>
                            <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <i class="fas fa-paper-plane mr-2"></i>Send Message
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p>&copy; {{ date('Y') }} {{ $user->name }}. All rights reserved.</p>
            <p class="text-sm text-gray-400 mt-2">
                Portfolio powered by <a href="{{ route('landing') }}" class="text-blue-400 hover:text-blue-300">Portfolio Builder</a>
            </p>
        </div>
    </footer>

    <!-- Smooth scrolling script -->
    <script>
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>