<!-- Sidebar -->
<div class="hidden lg:flex lg:flex-shrink-0">
    <div class="flex flex-col w-64">
        <div class="flex flex-col h-0 flex-1 bg-gradient-to-b from-gray-900 to-gray-800 shadow-xl">
            <!-- Logo -->
            <div class="flex items-center h-16 flex-shrink-0 px-6 bg-gray-900">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-briefcase text-white text-sm"></i>
                    </div>
                    <span class="ml-3 text-white font-bold text-lg">Portfolio Builder</span>
                </div>
            </div>

            <!-- Navigation -->
            <div class="flex-1 flex flex-col overflow-y-auto">
                <nav class="flex-1 px-4 py-6 space-y-2">
                    <!-- Dashboard -->
                    <a href="{{ route('dashboard') }}" 
                       class="group flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white shadow-lg' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                        <i class="fas fa-chart-line mr-3 text-lg {{ request()->routeIs('dashboard') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}"></i>
                        Dashboard
                    </a>

                    <!-- Portfolio Management -->
                    <div class="mt-6">
                        <h3 class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Portfolio</h3>
                        <div class="mt-2 space-y-1">
                            <a href="{{ route('portfolio-profile.index') }}" 
                               class="group flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('portfolio-profile.*') ? 'bg-blue-600 text-white shadow-lg' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                                <i class="fas fa-id-card mr-3 {{ request()->routeIs('portfolio-profile.*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}" style="width: 16px; text-align: center;"></i>
                                Profile
                            </a>
                            <a href="{{ route('skills.index') }}" 
                               class="group flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('skills.*') ? 'bg-blue-600 text-white shadow-lg' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                                <i class="fas fa-cogs mr-3 {{ request()->routeIs('skills.*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}" style="width: 16px; text-align: center;"></i>
                                Skills
                            </a>
                            <a href="{{ route('experiences.index') }}" 
                               class="group flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('experiences.*') ? 'bg-blue-600 text-white shadow-lg' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                                <i class="fas fa-briefcase mr-3 {{ request()->routeIs('experiences.*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}" style="width: 16px; text-align: center;"></i>
                                Experience
                            </a>
                            <a href="{{ route('education.index') }}" 
                               class="group flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('education.*') ? 'bg-blue-600 text-white shadow-lg' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                                <i class="fas fa-graduation-cap mr-3 {{ request()->routeIs('education.*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}" style="width: 16px; text-align: center;"></i>
                                Education
                            </a>
                            <a href="{{ route('projects.index') }}" 
                               class="group flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('projects.*') ? 'bg-blue-600 text-white shadow-lg' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                                <i class="fas fa-project-diagram mr-3 {{ request()->routeIs('projects.*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}" style="width: 16px; text-align: center;"></i>
                                Projects
                            </a>
                            <a href="{{ route('services.index') }}" 
                               class="group flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('services.*') ? 'bg-blue-600 text-white shadow-lg' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                                <i class="fas fa-concierge-bell mr-3 {{ request()->routeIs('services.*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}" style="width: 16px; text-align: center;"></i>
                                Services
                            </a>
                            <a href="{{ route('testimonials.index') }}" 
                               class="group flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('testimonials.*') ? 'bg-blue-600 text-white shadow-lg' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                                <i class="fas fa-quote-left mr-3 {{ request()->routeIs('testimonials.*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}" style="width: 16px; text-align: center;"></i>
                                Testimonials
                            </a>
                            <a href="{{ route('socials.index') }}" 
                               class="group flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('socials.*') ? 'bg-blue-600 text-white shadow-lg' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                                <i class="fas fa-share-alt mr-3 {{ request()->routeIs('socials.*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}" style="width: 16px; text-align: center;"></i>
                                Social Links
                            </a>
                        </div>
                    </div>

                    <!-- Communication -->
                    <div class="mt-6">
                        <h3 class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Communication</h3>
                        <div class="mt-2 space-y-1">
                            <a href="{{ route('messages.index') }}" 
                               class="group flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('messages.*') ? 'bg-blue-600 text-white shadow-lg' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                                <i class="fas fa-envelope mr-3 {{ request()->routeIs('messages.*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}" style="width: 16px; text-align: center;"></i>
                                Messages
                                @if(auth()->user()->unread_messages_count > 0)
                                    <span class="ml-auto bg-red-500 text-white text-xs rounded-full px-2 py-1">
                                        {{ auth()->user()->unread_messages_count }}
                                    </span>
                                @endif
                            </a>
                        </div>
                    </div>

                    @if(auth()->user()->isAdmin())
                    <!-- Admin Section -->
                    <div class="mt-6">
                        <h3 class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Administration</h3>
                        <div class="mt-2 space-y-1">
                            <a href="{{ route('admin.dashboard') }}"
                               class="group flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white shadow-lg' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                                <i class="fas fa-chart-pie mr-3 {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}"></i>
                                Admin Dashboard
                            </a>
                            <a href="{{ route('admin.users.index') }}"
                               class="group flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('admin.users.*') ? 'bg-blue-600 text-white shadow-lg' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                                <i class="fas fa-users mr-3 {{ request()->routeIs('admin.users.*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}"></i>
                                User Management
                            </a>
                        </div>
                    </div>
                    @endif
                </nav>

                <!-- Portfolio Link -->
                <div class="flex-shrink-0 p-4">
                    <a href="{{ route('portfolio.show', auth()->user()) }}" target="_blank"
                       class="group flex items-center px-3 py-2 text-sm font-medium rounded-lg bg-gradient-to-r from-blue-600 to-purple-600 text-white hover:from-blue-700 hover:to-purple-700 transition-all duration-200 shadow-lg">
                        <i class="fas fa-external-link-alt mr-3"></i>
                        View Portfolio
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Mobile sidebar overlay -->
<div id="sidebar-overlay" class="fixed inset-0 z-40 bg-gray-600 bg-opacity-75 lg:hidden hidden"></div>

<!-- Mobile sidebar -->
<div id="sidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-gradient-to-b from-gray-900 to-gray-800 transform -translate-x-full transition-transform duration-300 ease-in-out lg:hidden">
    <div class="flex items-center justify-between h-16 px-6 bg-gray-900">
        <div class="flex items-center">
            <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                <i class="fas fa-briefcase text-white text-sm"></i>
            </div>
            <span class="ml-3 text-white font-bold text-lg">Portfolio Builder</span>
        </div>
        <button onclick="toggleSidebar()" class="text-gray-400 hover:text-white">
            <i class="fas fa-times text-xl"></i>
        </button>
    </div>
    
    <!-- Mobile Navigation (same as desktop but without the outer container) -->
    <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
        <!-- Same navigation content as desktop -->
        <a href="{{ route('dashboard') }}" 
           class="group flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white shadow-lg' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
            <i class="fas fa-chart-line mr-3 text-lg {{ request()->routeIs('dashboard') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}"></i>
            Dashboard
        </a>

        <div class="mt-6">
            <h3 class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Portfolio</h3>
            <div class="mt-2 space-y-1">
                <a href="{{ route('portfolio-profile.index') }}" 
                   class="group flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('portfolio-profile.*') ? 'bg-blue-600 text-white shadow-lg' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-id-card mr-3 {{ request()->routeIs('portfolio-profile.*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}" style="width: 16px; text-align: center;"></i>
                    Profile
                </a>
                <a href="{{ route('skills.index') }}" 
                   class="group flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('skills.*') ? 'bg-blue-600 text-white shadow-lg' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-cogs mr-3 {{ request()->routeIs('skills.*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}" style="width: 16px; text-align: center;"></i>
                    Skills
                </a>
                <a href="{{ route('experiences.index') }}" 
                   class="group flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('experiences.*') ? 'bg-blue-600 text-white shadow-lg' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-briefcase mr-3 {{ request()->routeIs('experiences.*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}" style="width: 16px; text-align: center;"></i>
                    Experience
                </a>
                <a href="{{ route('education.index') }}" 
                   class="group flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('education.*') ? 'bg-blue-600 text-white shadow-lg' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-graduation-cap mr-3 {{ request()->routeIs('education.*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}" style="width: 16px; text-align: center;"></i>
                    Education
                </a>
                <a href="{{ route('projects.index') }}" 
                   class="group flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('projects.*') ? 'bg-blue-600 text-white shadow-lg' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-project-diagram mr-3 {{ request()->routeIs('projects.*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}" style="width: 16px; text-align: center;"></i>
                    Projects
                </a>
                <a href="{{ route('services.index') }}" 
                   class="group flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('services.*') ? 'bg-blue-600 text-white shadow-lg' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-concierge-bell mr-3 {{ request()->routeIs('services.*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}" style="width: 16px; text-align: center;"></i>
                    Services
                </a>
                <a href="{{ route('testimonials.index') }}" 
                   class="group flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('testimonials.*') ? 'bg-blue-600 text-white shadow-lg' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-quote-left mr-3 {{ request()->routeIs('testimonials.*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}" style="width: 16px; text-align: center;"></i>
                    Testimonials
                </a>
                <a href="{{ route('socials.index') }}" 
                   class="group flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('socials.*') ? 'bg-blue-600 text-white shadow-lg' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-share-alt mr-3 {{ request()->routeIs('socials.*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}" style="width: 16px; text-align: center;"></i>
                    Social Links
                </a>
            </div>
        </div>

        <div class="mt-6">
            <h3 class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Communication</h3>
            <div class="mt-2 space-y-1">
                <a href="{{ route('messages.index') }}" 
                   class="group flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('messages.*') ? 'bg-blue-600 text-white shadow-lg' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-envelope mr-3 {{ request()->routeIs('messages.*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}" style="width: 16px; text-align: center;"></i>
                    Messages
                    @if(auth()->user()->unread_messages_count > 0)
                        <span class="ml-auto bg-red-500 text-white text-xs rounded-full px-2 py-1">
                            {{ auth()->user()->unread_messages_count }}
                        </span>
                    @endif
                </a>
            </div>
        </div>

        @if(auth()->user()->isAdmin())
        <div class="mt-6">
            <h3 class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Administration</h3>
            <div class="mt-2 space-y-1">
                <a href="{{ route('admin.dashboard') }}"
                   class="group flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white shadow-lg' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-chart-pie mr-3 {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}"></i>
                    Admin Dashboard
                </a>
                <a href="{{ route('admin.users.index') }}"
                   class="group flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('admin.users.*') ? 'bg-blue-600 text-white shadow-lg' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-users mr-3 {{ request()->routeIs('admin.users.*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}"></i>
                    User Management
                </a>
            </div>
        </div>
        @endif
    </nav>
</div>
