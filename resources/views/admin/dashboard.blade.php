<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    <i class="fas fa-users-cog mr-3 text-red-600"></i>Admin Dashboard
                </h2>
                <p class="text-sm text-gray-600 mt-1">System overview and user management</p>
            </div>
            <div class="flex items-center space-x-4">
                <div class="text-right">
                    <div class="text-sm text-gray-500">System Status</div>
                    <div class="flex items-center space-x-2">
                        <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                        <span class="text-sm font-semibold text-green-600">All Systems Operational</span>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- System Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Users -->
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 overflow-hidden shadow-xl rounded-2xl border border-blue-200 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-sm font-semibold text-blue-700 uppercase tracking-wider mb-1">
                                Total Users
                            </div>
                            <div class="text-3xl font-bold text-blue-900 mb-1">
                                {{ $stats['total_users'] }}
                            </div>
                            <div class="text-xs text-blue-600">
                                {{ $stats['active_users'] }} active
                            </div>
                        </div>
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center shadow-lg">
                            <i class="fas fa-users text-white text-2xl"></i>
                        </div>
                    </div>
                </div>
                <div class="bg-blue-600 px-6 py-3">
                    <a href="{{ route('admin.users.index') }}" class="text-sm text-white hover:text-blue-100 font-medium flex items-center">
                        Manage Users <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>

            <!-- Portfolios -->
            <div class="bg-gradient-to-br from-green-50 to-green-100 overflow-hidden shadow-xl rounded-2xl border border-green-200 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-sm font-semibold text-green-700 uppercase tracking-wider mb-1">
                                Portfolios
                            </div>
                            <div class="text-3xl font-bold text-green-900 mb-1">
                                {{ $stats['total_portfolios'] }}
                            </div>
                            <div class="text-xs text-green-600">
                                {{ $stats['total_projects'] }} projects
                            </div>
                        </div>
                        <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center shadow-lg">
                            <i class="fas fa-briefcase text-white text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Messages -->
            <div class="bg-gradient-to-br from-purple-50 to-purple-100 overflow-hidden shadow-xl rounded-2xl border border-purple-200 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-sm font-semibold text-purple-700 uppercase tracking-wider mb-1">
                                Messages
                            </div>
                            <div class="text-3xl font-bold text-purple-900 mb-1">
                                {{ $stats['total_messages'] }}
                            </div>
                            <div class="text-xs text-purple-600">
                                {{ $stats['unread_messages'] }} unread
                            </div>
                        </div>
                        <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center shadow-lg">
                            <i class="fas fa-envelope text-white text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Stats -->
            <div class="bg-gradient-to-br from-orange-50 to-orange-100 overflow-hidden shadow-xl rounded-2xl border border-orange-200 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-sm font-semibold text-orange-700 uppercase tracking-wider mb-1">
                                Content Items
                            </div>
                            <div class="text-3xl font-bold text-orange-900 mb-1">
                                {{ $stats['total_skills'] + $stats['total_experiences'] + $stats['total_services'] }}
                            </div>
                            <div class="text-xs text-orange-600">
                                Skills, Experience, Services
                            </div>
                        </div>
                        <div class="w-16 h-16 bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl flex items-center justify-center shadow-lg">
                            <i class="fas fa-chart-bar text-white text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <!-- User Registration Trends -->
            <div class="bg-white overflow-hidden shadow-xl rounded-2xl border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-900">
                        <i class="fas fa-chart-line mr-2 text-blue-600"></i>User Registration Trends
                    </h3>
                    <p class="text-sm text-gray-600">New user registrations over the last 6 months</p>
                </div>
                <div class="p-6">
                    <canvas id="userRegistrationsChart" width="400" height="200"></canvas>
                </div>
            </div>

            <!-- Portfolio Completion -->
            <div class="bg-white overflow-hidden shadow-xl rounded-2xl border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-900">
                        <i class="fas fa-chart-pie mr-2 text-green-600"></i>Portfolio Completion
                    </h3>
                    <p class="text-sm text-gray-600">User portfolio completion status</p>
                </div>
                <div class="p-6">
                    <canvas id="portfolioCompletionChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Recent Users -->
            <div class="bg-white overflow-hidden shadow-xl rounded-2xl border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-900">
                        <i class="fas fa-user-plus mr-2 text-blue-600"></i>Recent Users
                    </h3>
                    <p class="text-sm text-gray-600">Latest user registrations</p>
                </div>
                <div class="p-6">
                    @if($recentUsers->count() > 0)
                        <div class="space-y-4">
                            @foreach($recentUsers as $user)
                                <div class="flex items-center space-x-3 p-3 rounded-lg bg-gray-50">
                                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                                        <span class="text-white font-semibold text-sm">
                                            {{ substr($user->name, 0, 1) }}
                                        </span>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between">
                                            <p class="text-sm font-medium text-gray-900">{{ $user->name }}</p>
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium 
                                                {{ $user->role === 'admin' ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800' }}">
                                                {{ ucfirst($user->role) }}
                                            </span>
                                        </div>
                                        <p class="text-sm text-gray-600">{{ $user->email }}</p>
                                        <p class="text-xs text-gray-500">Joined {{ $user->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('admin.users.index') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                                View all users →
                            </a>
                        </div>
                    @else
                        <div class="text-center py-8">
                            <i class="fas fa-users text-gray-400 text-4xl mb-4"></i>
                            <p class="text-gray-500">No users yet</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Recent Messages -->
            <div class="bg-white overflow-hidden shadow-xl rounded-2xl border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-900">
                        <i class="fas fa-envelope mr-2 text-purple-600"></i>Recent Messages
                    </h3>
                    <p class="text-sm text-gray-600">Latest contact inquiries</p>
                </div>
                <div class="p-6">
                    @if($recentMessages->count() > 0)
                        <div class="space-y-4">
                            @foreach($recentMessages->take(5) as $message)
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
                                        <p class="text-sm text-gray-600">To: {{ $message->user->name }}</p>
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
                    @else
                        <div class="text-center py-8">
                            <i class="fas fa-inbox text-gray-400 text-4xl mb-4"></i>
                            <p class="text-gray-500">No messages yet</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // User Registrations Chart
        const userRegistrationsCtx = document.getElementById('userRegistrationsChart').getContext('2d');
        const userRegistrationsChart = new Chart(userRegistrationsCtx, {
            type: 'bar',
            data: {
                labels: [
                    @foreach($userRegistrations as $month)
                        '{{ $month['month'] }}',
                    @endforeach
                ],
                datasets: [{
                    label: 'New Users',
                    data: [
                        @foreach($userRegistrations as $month)
                            {{ $month['count'] }},
                        @endforeach
                    ],
                    backgroundColor: 'rgba(59, 130, 246, 0.8)',
                    borderColor: 'rgb(59, 130, 246)',
                    borderWidth: 1
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

        // Portfolio Completion Chart
        const portfolioCompletionCtx = document.getElementById('portfolioCompletionChart').getContext('2d');
        const portfolioCompletionChart = new Chart(portfolioCompletionCtx, {
            type: 'doughnut',
            data: {
                labels: ['Complete', 'Partial', 'Empty'],
                datasets: [{
                    data: [
                        {{ $portfolioStats['complete'] }},
                        {{ $portfolioStats['partial'] }},
                        {{ $portfolioStats['empty'] }}
                    ],
                    backgroundColor: [
                        '#10B981', // Green for complete
                        '#F59E0B', // Yellow for partial
                        '#EF4444'  // Red for empty
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
