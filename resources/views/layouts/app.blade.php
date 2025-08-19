<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Portfolio Builder') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js CDN fallback -->
    <script>
        // Check if Alpine.js loaded from Vite, if not load from CDN
        setTimeout(() => {
            if (typeof window.Alpine === 'undefined') {
                const script = document.createElement('script');
                script.src = 'https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js';
                script.defer = true;
                document.head.appendChild(script);
            }
        }, 1000);
    </script>

    <style>
        body { font-family: 'Inter', sans-serif; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        @include('layouts.sidebar')

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Navigation -->
            @include('layouts.topnav')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow-sm border-b border-gray-200">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 py-6">
                @if (session('success'))
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6">
                        <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg shadow-sm" role="alert">
                            <div class="flex items-center">
                                <i class="fas fa-check-circle mr-2"></i>
                                <span class="block sm:inline">{{ session('success') }}</span>
                            </div>
                        </div>
                    </div>
                @endif

                @if (session('error'))
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6">
                        <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg shadow-sm" role="alert">
                            <div class="flex items-center">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                <span class="block sm:inline">{{ session('error') }}</span>
                            </div>
                        </div>
                    </div>
                @endif

                {{ $slot }}
            </main>
        </div>
    </div>

    <!-- Sidebar Toggle Script -->
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');

            if (sidebar && overlay) {
                sidebar.classList.toggle('-translate-x-full');
                overlay.classList.toggle('hidden');
            }
        }

        // Wait for DOM to be fully loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Close sidebar when clicking overlay
            const overlay = document.getElementById('sidebar-overlay');
            if (overlay) {
                overlay.addEventListener('click', toggleSidebar);
            }
        });

        // Ensure Alpine.js is ready and fix navigation responsiveness
        document.addEventListener('alpine:init', () => {
            // Alpine.js initialized
        });

        // Remove conflicting dropdown functionality - let Alpine.js handle it

        // Ensure proper pointer events for interactive elements
        document.addEventListener('DOMContentLoaded', function() {
            const style = document.createElement('style');
            style.textContent = `
                button, a, [role="button"] {
                    pointer-events: auto !important;
                }
            `;
            document.head.appendChild(style);

            // Fallback dropdown functionality if Alpine.js fails
            setTimeout(() => {
                if (typeof window.Alpine === 'undefined') {
                    initFallbackDropdown();
                }
            }, 1000);
        });

        function initFallbackDropdown() {
            const dropdownContainer = document.querySelector('[x-data*="open"]');
            const dropdownButton = dropdownContainer?.querySelector('button');
            const dropdownMenu = dropdownContainer?.querySelector('[x-show="open"]');

            if (dropdownButton && dropdownMenu) {
                let isOpen = false;

                dropdownButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    isOpen = !isOpen;

                    if (isOpen) {
                        dropdownMenu.style.display = 'block';
                        dropdownButton.setAttribute('aria-expanded', 'true');
                    } else {
                        dropdownMenu.style.display = 'none';
                        dropdownButton.setAttribute('aria-expanded', 'false');
                    }
                });

                // Close dropdown when clicking outside
                document.addEventListener('click', function(e) {
                    if (!dropdownContainer.contains(e.target)) {
                        isOpen = false;
                        dropdownMenu.style.display = 'none';
                        dropdownButton.setAttribute('aria-expanded', 'false');
                    }
                });

                // Close dropdown when clicking menu items
                const menuItems = dropdownMenu.querySelectorAll('a, button');
                menuItems.forEach(item => {
                    item.addEventListener('click', function() {
                        isOpen = false;
                        dropdownMenu.style.display = 'none';
                        dropdownButton.setAttribute('aria-expanded', 'false');
                    });
                });
            }
        }
    </script>
</body>
</html>