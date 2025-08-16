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
            .auth-bg {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                background-size: 400% 400%;
                animation: gradientShift 15s ease infinite;
            }
            @keyframes gradientShift {
                0% { background-position: 0% 50%; }
                50% { background-position: 100% 50%; }
                100% { background-position: 0% 50%; }
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex auth-bg">
            <!-- Left Side - Branding -->
            <div class="hidden lg:flex lg:w-1/2 items-center justify-center p-12">
                <div class="max-w-md text-center text-white">
                    <div class="mb-8">
                        <div class="w-20 h-20 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center mx-auto mb-6 backdrop-blur-sm">
                            <i class="fas fa-briefcase text-white text-3xl"></i>
                        </div>
                        <h1 class="text-4xl font-bold mb-4">Portfolio Builder</h1>
                        <p class="text-xl text-blue-100">Create stunning professional portfolios that showcase your work and attract opportunities.</p>
                    </div>

                    <div class="space-y-4 text-left">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-white bg-opacity-20 rounded-lg flex items-center justify-center backdrop-blur-sm">
                                <i class="fas fa-check text-white text-sm"></i>
                            </div>
                            <span class="text-blue-100">Professional portfolio templates</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-white bg-opacity-20 rounded-lg flex items-center justify-center backdrop-blur-sm">
                                <i class="fas fa-check text-white text-sm"></i>
                            </div>
                            <span class="text-blue-100">Easy content management</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-white bg-opacity-20 rounded-lg flex items-center justify-center backdrop-blur-sm">
                                <i class="fas fa-check text-white text-sm"></i>
                            </div>
                            <span class="text-blue-100">Mobile-responsive design</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-white bg-opacity-20 rounded-lg flex items-center justify-center backdrop-blur-sm">
                                <i class="fas fa-check text-white text-sm"></i>
                            </div>
                            <span class="text-blue-100">Analytics and insights</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side - Form -->
            <div class="w-full lg:w-1/2 flex items-center justify-center p-8">
                <div class="w-full max-w-md">
                    <!-- Mobile Logo -->
                    <div class="lg:hidden text-center mb-8">
                        <div class="w-16 h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center mx-auto mb-4 backdrop-blur-sm">
                            <i class="fas fa-briefcase text-white text-2xl"></i>
                        </div>
                        <h1 class="text-2xl font-bold text-white">Portfolio Builder</h1>
                    </div>

                    <!-- Form Container -->
                    <div class="bg-white bg-opacity-95 backdrop-blur-sm rounded-2xl shadow-2xl p-8 border border-white border-opacity-20">
                        {{ $slot }}
                    </div>

                    <!-- Footer Links -->
                    <div class="mt-6 text-center">
                        <a href="{{ route('landing') }}" class="text-white text-sm hover:text-blue-100 transition duration-200">
                            <i class="fas fa-arrow-left mr-2"></i>Back to Homepage
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
