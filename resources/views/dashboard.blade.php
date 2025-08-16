<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    <i class="fas fa-chart-line mr-3 text-blue-600"></i>Portfolio Dashboard
                </h2>
                <p class="text-sm text-gray-600 mt-1">Welcome back, {{ auth()->user()->name }}! Here's your portfolio overview.</p>
            </div>
            <div class="flex items-center space-x-4">
                <div class="text-right">
                    <div class="text-sm text-gray-500">Portfolio Completion</div>
                    <div class="flex items-center space-x-2">
                        <div class="w-24 bg-gray-200 rounded-full h-2">
                            <div class="bg-gradient-to-r from-blue-500 to-purple-600 h-2 rounded-full transition-all duration-300"
                                 style="width: {{ $completionData['percentage'] }}%"></div>
                        </div>
                        <span class="text-sm font-semibold text-gray-700">{{ $completionData['percentage'] }}%</span>
                    </div>
                </div>
                <a href="{{ route('portfolio.show', auth()->user()) }}" target="_blank"
                   class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:from-blue-700 hover:to-purple-700 transition-all duration-200 shadow-lg">
                    <i class="fas fa-external-link-alt mr-2"></i>View Portfolio
                </a>
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Enhanced Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Messages Card -->
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 overflow-hidden shadow-xl rounded-2xl border border-blue-200 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-sm font-semibold text-blue-700 uppercase tracking-wider mb-1">
                                New Messages
                            </div>
                            <div class="text-3xl font-bold text-blue-900 mb-1">
                                {{ $stats['messages'] }}
                            </div>
                            <div class="text-xs text-blue-600">
                                {{ $stats['total_messages'] }} total
                            </div>
                        </div>
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center shadow-lg">
                            <i class="fas fa-envelope text-white text-2xl"></i>
                        </div>
                    </div>
                </div>
                <div class="bg-blue-600 px-6 py-3">
                    <a href="{{ route('messages.index') }}" class="text-sm text-white hover:text-blue-100 font-medium flex items-center">
                        View Messages <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>

            <!-- Projects Card -->
            <div class="bg-gradient-to-br from-green-50 to-green-100 overflow-hidden shadow-xl rounded-2xl border border-green-200 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-sm font-semibold text-green-700 uppercase tracking-wider mb-1">
                                Projects
                            </div>
                            <div class="text-3xl font-bold text-green-900 mb-1">
                                {{ $stats['projects'] }}
                            </div>
                            <div class="text-xs text-green-600">
                                {{ $stats['completed_projects'] }} completed
                            </div>
                        </div>
                        <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center shadow-lg">
                            <i class="fas fa-project-diagram text-white text-2xl"></i>
                        </div>
                    </div>
                </div>
                <div class="bg-green-600 px-6 py-3">
                    <a href="{{ route('projects.index') }}" class="text-sm text-white hover:text-green-100 font-medium flex items-center">
                        Manage Projects <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>

            <!-- Skills Card -->
            <div class="bg-gradient-to-br from-purple-50 to-purple-100 overflow-hidden shadow-xl rounded-2xl border border-purple-200 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-sm font-semibold text-purple-700 uppercase tracking-wider mb-1">
                                Skills
                            </div>
                            <div class="text-3xl font-bold text-purple-900 mb-1">
                                {{ $stats['skills'] }}
                            </div>
                            <div class="text-xs text-purple-600">
                                Technical & Soft
                            </div>
                        </div>
                        <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center shadow-lg">
                            <i class="fas fa-cogs text-white text-2xl"></i>
                        </div>
                    </div>
                </div>
                <div class="bg-purple-600 px-6 py-3">
                    <a href="{{ route('skills.index') }}" class="text-sm text-white hover:text-purple-100 font-medium flex items-center">
                        Update Skills <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>

            <!-- Experience Card -->
            <div class="bg-gradient-to-br from-orange-50 to-orange-100 overflow-hidden shadow-xl rounded-2xl border border-orange-200 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-sm font-semibold text-orange-700 uppercase tracking-wider mb-1">
                                Experience
                            </div>
                            <div class="text-3xl font-bold text-orange-900 mb-1">
                                {{ $stats['experiences'] }}
                            </div>
                            <div class="text-xs text-orange-600">
                                Work History
                            </div>
                        </div>
                        <div class="w-16 h-16 bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl flex items-center justify-center shadow-lg">
                            <i class="fas fa-briefcase text-white text-2xl"></i>
                        </div>
                    </div>
                </div>
                <div class="bg-orange-600 px-6 py-3">
                    <a href="{{ route('experiences.index') }}" class="text-sm text-white hover:text-orange-100 font-medium flex items-center">
                        Add Experience <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Additional Stats Row -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Services Card -->
            <div class="bg-gradient-to-br from-indigo-50 to-indigo-100 overflow-hidden shadow-xl rounded-2xl border border-indigo-200 hover:shadow-2xl transition-all duration-300">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-sm font-semibold text-indigo-700 uppercase tracking-wider mb-1">Services</div>
                            <div class="text-2xl font-bold text-indigo-900">{{ $stats['services'] }}</div>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-concierge-bell text-white"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Testimonials Card -->
            <div class="bg-gradient-to-br from-pink-50 to-pink-100 overflow-hidden shadow-xl rounded-2xl border border-pink-200 hover:shadow-2xl transition-all duration-300">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-sm font-semibold text-pink-700 uppercase tracking-wider mb-1">Testimonials</div>
                            <div class="text-2xl font-bold text-pink-900">{{ $stats['testimonials'] }}</div>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-br from-pink-500 to-pink-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-star text-white"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Education Card -->
            <div class="bg-gradient-to-br from-teal-50 to-teal-100 overflow-hidden shadow-xl rounded-2xl border border-teal-200 hover:shadow-2xl transition-all duration-300">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-sm font-semibold text-teal-700 uppercase tracking-wider mb-1">Education</div>
                            <div class="text-2xl font-bold text-teal-900">{{ $stats['education'] }}</div>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-br from-teal-500 to-teal-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-graduation-cap text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Analytics Charts -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <!-- Messages Chart -->
            <div class="bg-white overflow-hidden shadow-xl rounded-2xl border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-900">
                        <i class="fas fa-chart-line mr-2 text-blue-600"></i>Message Trends
                    </h3>
                    <p class="text-sm text-gray-600">Monthly message activity</p>
                </div>
                <div class="p-6">
                    <canvas id="messagesChart" width="400" height="200"></canvas>
                </div>
            </div>

            <!-- Projects Status Chart -->
            <div class="bg-white overflow-hidden shadow-xl rounded-2xl border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-900">
                        <i class="fas fa-chart-pie mr-2 text-green-600"></i>Project Status
                    </h3>
                    <p class="text-sm text-gray-600">Distribution by status</p>
                </div>
                <div class="p-6">
                    <canvas id="projectsChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Recent Messages -->
            <div class="bg-white overflow-hidden shadow-xl rounded-2xl border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-900">
                        <i class="fas fa-envelope mr-2 text-blue-600"></i>Recent Messages
                    </h3>
                    <p class="text-sm text-gray-600">Latest contact inquiries</p>
                </div>
                <div class="p-6">
                    @if($recentMessages->count() > 0)
                        <div class="space-y-4">
                            @foreach($recentMessages as $message)
                                <div class="flex items-start space-x-3 p-3 rounded-lg {{ $message->status === 'unread' ? 'bg-blue-50 border border-blue-200' : 'bg-gray-50' }}">
                                    <div class="flex-shrink-0">
                                        <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center">
                                            <i class="fas fa-user text-gray-600 text-sm"></i>
                                        </div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between">
                                            <p class="text-sm font-medium text-gray-900">{{ $message->name }}</p>
                                            <span class="text-xs text-gray-500">{{ $message->created_at->diffForHumans() }}</span>
                                        </div>
                                        <p class="text-sm text-gray-600 truncate">{{ $message->subject }}</p>
                                        @if($message->status === 'unread')
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                New
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('messages.index') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                                View all messages →
                            </a>
                        </div>
                    @else
                        <div class="text-center py-8">
                            <i class="fas fa-inbox text-gray-400 text-4xl mb-4"></i>
                            <p class="text-gray-500">No messages yet</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Featured Projects -->
            <div class="bg-white overflow-hidden shadow-xl rounded-2xl border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-900">
                        <i class="fas fa-star mr-2 text-yellow-600"></i>Featured Projects
                    </h3>
                    <p class="text-sm text-gray-600">Your highlighted work</p>
                </div>
                <div class="p-6">
                    @if($featuredProjects->count() > 0)
                        <div class="space-y-4">
                            @foreach($featuredProjects as $project)
                                <div class="flex items-start space-x-3 p-3 rounded-lg bg-gray-50">
                                    <div class="flex-shrink-0">
                                        @if($project->image)
                                            <img src="{{ Storage::url($project->image) }}" alt="{{ $project->title }}" class="w-12 h-12 rounded-lg object-cover">
                                        @else
                                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                                                <i class="fas fa-project-diagram text-white"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between">
                                            <p class="text-sm font-medium text-gray-900">{{ $project->title }}</p>
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium 
                                                {{ $project->status === 'completed' ? 'bg-green-100 text-green-800' : 
                                                   ($project->status === 'in_progress' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                                                {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                                            </span>
                                        </div>
                                        <p class="text-sm text-gray-600 truncate">{{ Str::limit($project->description, 60) }}</p>
                                        @if($project->technologies)
                                            <div class="mt-1 flex flex-wrap gap-1">
                                                @foreach(array_slice($project->technologies, 0, 3) as $tech)
                                                    <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                                        {{ $tech }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('projects.index') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                                View all projects →
                            </a>
                        </div>
                    @else
                        <div class="text-center py-8">
                            <i class="fas fa-plus-circle text-gray-400 text-4xl mb-4"></i>
                            <p class="text-gray-500 mb-4">No featured projects yet</p>
                            <a href="{{ route('projects.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                                <i class="fas fa-plus mr-2"></i>Add Project
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="mt-8 bg-white overflow-hidden shadow-xl rounded-2xl border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="text-lg font-bold text-gray-900">
                    <i class="fas fa-bolt mr-2 text-yellow-600"></i>Quick Actions
                </h3>
                <p class="text-sm text-gray-600">Manage your portfolio content</p>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                    <a href="{{ route('portfolio-profile.index') }}" class="group flex flex-col items-center p-6 rounded-xl border-2 border-gray-200 hover:border-blue-400 hover:bg-gradient-to-br hover:from-blue-50 hover:to-blue-100 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-id-card text-white text-lg"></i>
                        </div>
                        <span class="text-sm font-semibold text-gray-900">Profile</span>
                    </a>
                    <a href="{{ route('projects.create') }}" class="group flex flex-col items-center p-6 rounded-xl border-2 border-gray-200 hover:border-green-400 hover:bg-gradient-to-br hover:from-green-50 hover:to-green-100 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg">
                        <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-plus text-white text-lg"></i>
                        </div>
                        <span class="text-sm font-semibold text-gray-900">Add Project</span>
                    </a>
                    <a href="{{ route('skills.create') }}" class="group flex flex-col items-center p-6 rounded-xl border-2 border-gray-200 hover:border-purple-400 hover:bg-gradient-to-br hover:from-purple-50 hover:to-purple-100 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg">
                        <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-cogs text-white text-lg"></i>
                        </div>
                        <span class="text-sm font-semibold text-gray-900">Add Skill</span>
                    </a>
                    <a href="{{ route('experiences.create') }}" class="group flex flex-col items-center p-6 rounded-xl border-2 border-gray-200 hover:border-orange-400 hover:bg-gradient-to-br hover:from-orange-50 hover:to-orange-100 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg">
                        <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-briefcase text-white text-lg"></i>
                        </div>
                        <span class="text-sm font-semibold text-gray-900">Add Experience</span>
                    </a>
                    <a href="{{ route('services.create') }}" class="group flex flex-col items-center p-6 rounded-xl border-2 border-gray-200 hover:border-indigo-400 hover:bg-gradient-to-br hover:from-indigo-50 hover:to-indigo-100 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg">
                        <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-concierge-bell text-white text-lg"></i>
                        </div>
                        <span class="text-sm font-semibold text-gray-900">Add Service</span>
                    </a>
                    <a href="{{ route('education.create') }}" class="group flex flex-col items-center p-6 rounded-xl border-2 border-gray-200 hover:border-teal-400 hover:bg-gradient-to-br hover:from-teal-50 hover:to-teal-100 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg">
                        <div class="w-12 h-12 bg-gradient-to-br from-teal-500 to-teal-600 rounded-xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-graduation-cap text-white text-lg"></i>
                        </div>
                        <span class="text-sm font-semibold text-gray-900">Add Education</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Messages Chart
        const messagesCtx = document.getElementById('messagesChart').getContext('2d');
        const messagesChart = new Chart(messagesCtx, {
            type: 'line',
            data: {
                labels: [
                    @foreach($messagesByMonth as $month)
                        '{{ $month['month'] }}',
                    @endforeach
                ],
                datasets: [{
                    label: 'Messages',
                    data: [
                        @foreach($messagesByMonth as $month)
                            {{ $month['count'] }},
                        @endforeach
                    ],
                    borderColor: 'rgb(59, 130, 246)',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Projects Chart
        const projectsCtx = document.getElementById('projectsChart').getContext('2d');
        const projectsChart = new Chart(projectsCtx, {
            type: 'doughnut',
            data: {
                labels: [
                    @foreach($projectsByStatus as $status)
                        '{{ ucfirst(str_replace("_", " ", $status->status)) }}',
                    @endforeach
                ],
                datasets: [{
                    data: [
                        @foreach($projectsByStatus as $status)
                            {{ $status->count }},
                        @endforeach
                    ],
                    backgroundColor: [
                        '#10B981', // Green for completed
                        '#F59E0B', // Yellow for in progress
                        '#EF4444', // Red for on hold
                        '#6B7280'  // Gray for planning
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            usePointStyle: true
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>