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

    <style>
        body { font-family: 'Inter', sans-serif; }
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
            console.log('Alpine.js initialized');
        });

        // Fix potential CSS transition interference with clicks and optimize navigation
        document.addEventListener('DOMContentLoaded', function() {
            // Remove any CSS transitions that might interfere with navigation
            const style = document.createElement('style');
            style.textContent = `
                .transition-all, .transition-colors, .transition-transform {
                    pointer-events: auto !important;
                }
                a, button {
                    pointer-events: auto !important;
                }
            `;
            document.head.appendChild(style);

            // Optimize navigation links for immediate response
            const navLinks = document.querySelectorAll('a[href^="/"]');
            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    // Add visual feedback immediately
                    this.style.opacity = '0.7';

                    // Restore opacity after a short delay
                    setTimeout(() => {
                        this.style.opacity = '';
                    }, 150);
                });
            });
        });
    </script>
</body>
</html>