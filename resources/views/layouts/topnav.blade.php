<!-- Top Navigation -->
<nav class="bg-white shadow-sm border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Left side - Mobile menu button -->
            <div class="flex items-center lg:hidden">
                <button onclick="toggleSidebar()" class="text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>

            <!-- Center - Search (hidden on mobile) -->
            <div class="hidden md:flex items-center flex-1 max-w-lg mx-8">
                <div class="relative w-full">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" 
                           class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg leading-5 bg-gray-50 placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm" 
                           placeholder="Search portfolio content...">
                </div>
            </div>

            <!-- Right side - User menu -->
            <div class="flex items-center space-x-4">
                <!-- Notifications -->
                <div class="relative">
                    <button class="p-2 text-gray-400 hover:text-gray-500 focus:outline-none focus:text-gray-500 transition duration-150 ease-in-out">
                        <i class="fas fa-bell text-lg"></i>
                        @if(auth()->user()->unread_messages_count > 0)
                            <span class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-red-400 ring-2 ring-white"></span>
                        @endif
                    </button>
                </div>

                <!-- Profile dropdown -->
                <div class="relative" id="profile-dropdown">
                    <button id="profile-dropdown-button"
                            type="button"
                            class="flex items-center space-x-3 text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out"
                            aria-expanded="false"
                            aria-haspopup="true">
                        @if(auth()->user()->avatar_url)
                            <img src="{{ auth()->user()->avatar_url }}"
                                 alt="{{ auth()->user()->name }}"
                                 class="w-8 h-8 rounded-full object-cover">
                        @else
                            <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                                <span class="text-white font-semibold text-sm">
                                    {{ substr(auth()->user()->name, 0, 1) }}
                                </span>
                            </div>
                        @endif
                        <div class="hidden md:block text-left">
                            <div class="text-sm font-medium text-gray-700">{{ auth()->user()->name }}</div>
                            <div class="text-xs text-gray-500">{{ auth()->user()->email }}</div>
                        </div>
                        <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
                    </button>

                    <!-- Dropdown menu -->
                    <div id="profile-dropdown-menu"
                         class="absolute right-0 mt-2 w-56 rounded-lg shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50 transition-all duration-100 transform opacity-0 scale-95 pointer-events-none"
                         style="display: none;">
                        <div class="py-1">
                            <!-- Profile Section -->
                            <div class="px-4 py-3 border-b border-gray-100">
                                <div class="flex items-center space-x-3">
                                    @if(auth()->user()->avatar_url)
                                        <img src="{{ auth()->user()->avatar_url }}"
                                             alt="{{ auth()->user()->name }}"
                                             class="w-10 h-10 rounded-full object-cover">
                                    @else
                                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                                            <span class="text-white font-semibold">
                                                {{ substr(auth()->user()->name, 0, 1) }}
                                            </span>
                                        </div>
                                    @endif
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</div>
                                        <div class="text-xs text-gray-500">{{ auth()->user()->email }}</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Menu Items -->
                            <a href="{{ route('profile.edit') }}"
                               class="dropdown-item flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition duration-150 ease-in-out">
                                <i class="fas fa-user-cog mr-3 text-gray-400"></i>
                                Account Settings
                            </a>

                            <a href="{{ route('portfolio.show', auth()->user()) }}" target="_blank"
                               class="dropdown-item flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition duration-150 ease-in-out">
                                <i class="fas fa-external-link-alt mr-3 text-gray-400"></i>
                                View Portfolio
                            </a>

                            @if(auth()->user()->isAdmin())
                                <a href="{{ route('admin.users.index') }}"
                                   class="dropdown-item flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition duration-150 ease-in-out">
                                    <i class="fas fa-users-cog mr-3 text-gray-400"></i>
                                    Admin Panel
                                </a>
                            @endif

                            <div class="border-t border-gray-100"></div>
                            
                            <!-- Logout -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                        class="dropdown-item flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition duration-150 ease-in-out">
                                    <i class="fas fa-sign-out-alt mr-3 text-red-400"></i>
                                    Sign Out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Mobile Search (shown on mobile) -->
<div class="md:hidden bg-white border-b border-gray-200 px-4 py-3">
    <div class="relative">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <i class="fas fa-search text-gray-400"></i>
        </div>
        <input type="text"
               class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg leading-5 bg-gray-50 placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
               placeholder="Search portfolio content...">
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const dropdownButton = document.getElementById('profile-dropdown-button');
    const dropdownMenu = document.getElementById('profile-dropdown-menu');
    const dropdown = document.getElementById('profile-dropdown');
    let isOpen = false;

    if (dropdownButton && dropdownMenu) {
        // Toggle dropdown on button click
        dropdownButton.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();

            isOpen = !isOpen;

            if (isOpen) {
                dropdownMenu.style.display = 'block';
                setTimeout(() => {
                    dropdownMenu.classList.remove('opacity-0', 'scale-95', 'pointer-events-none');
                    dropdownMenu.classList.add('opacity-100', 'scale-100', 'pointer-events-auto');
                }, 10);
                dropdownButton.setAttribute('aria-expanded', 'true');
                dropdownButton.classList.add('ring-2', 'ring-blue-500');
            } else {
                dropdownMenu.classList.remove('opacity-100', 'scale-100', 'pointer-events-auto');
                dropdownMenu.classList.add('opacity-0', 'scale-95', 'pointer-events-none');
                setTimeout(() => {
                    dropdownMenu.style.display = 'none';
                }, 100);
                dropdownButton.setAttribute('aria-expanded', 'false');
                dropdownButton.classList.remove('ring-2', 'ring-blue-500');
            }
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!dropdown.contains(e.target)) {
                if (isOpen) {
                    isOpen = false;
                    dropdownMenu.classList.remove('opacity-100', 'scale-100', 'pointer-events-auto');
                    dropdownMenu.classList.add('opacity-0', 'scale-95', 'pointer-events-none');
                    setTimeout(() => {
                        dropdownMenu.style.display = 'none';
                    }, 100);
                    dropdownButton.setAttribute('aria-expanded', 'false');
                    dropdownButton.classList.remove('ring-2', 'ring-blue-500');
                }
            }
        });

        // Close dropdown when clicking menu items
        const menuItems = dropdownMenu.querySelectorAll('.dropdown-item');
        menuItems.forEach(item => {
            item.addEventListener('click', function() {
                isOpen = false;
                dropdownMenu.classList.remove('opacity-100', 'scale-100', 'pointer-events-auto');
                dropdownMenu.classList.add('opacity-0', 'scale-95', 'pointer-events-none');
                setTimeout(() => {
                    dropdownMenu.style.display = 'none';
                }, 100);
                dropdownButton.setAttribute('aria-expanded', 'false');
                dropdownButton.classList.remove('ring-2', 'ring-blue-500');
            });
        });
    }
});
</script>
