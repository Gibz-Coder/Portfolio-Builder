<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    <i class="fas fa-id-card mr-3 text-blue-600"></i>Portfolio Profile
                </h2>
                <p class="text-sm text-gray-600 mt-1">Manage your personal information and profile details</p>
            </div>
            @if(!$profile)
                <a href="{{ route('portfolio-profile.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                    <i class="fas fa-plus mr-2"></i>Create Profile
                </a>
            @endif
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($profile)
            <div class="bg-white overflow-hidden shadow-lg rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-6">
                        <div class="flex items-center space-x-4">
                            @if($profile->avatar)
                                <img src="{{ Storage::url($profile->avatar) }}" alt="Avatar" class="w-20 h-20 rounded-full object-cover">
                            @else
                                <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                                    <span class="text-white text-2xl font-semibold">{{ substr(auth()->user()->name, 0, 1) }}</span>
                                </div>
                            @endif
                            <div>
                                <h3 class="text-2xl font-bold text-gray-900">{{ auth()->user()->name }}</h3>
                                @if($profile->title)
                                    <p class="text-lg text-gray-600">{{ $profile->title }}</p>
                                @endif
                                @if($profile->profession)
                                    <p class="text-sm text-gray-500">{{ $profile->profession }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <a href="{{ route('portfolio-profile.edit', $profile) }}" class="inline-flex items-center px-3 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                                <i class="fas fa-edit mr-1"></i>Edit
                            </a>
                            <a href="{{ route('portfolio.show', auth()->user()) }}" target="_blank" class="inline-flex items-center px-3 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700">
                                <i class="fas fa-external-link-alt mr-1"></i>View
                            </a>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900 mb-3">Contact Information</h4>
                            <div class="space-y-2">
                                <div class="flex items-center">
                                    <i class="fas fa-envelope text-gray-400 w-5"></i>
                                    <span class="ml-2 text-gray-600">{{ auth()->user()->email }}</span>
                                </div>
                                @if($profile->phone)
                                    <div class="flex items-center">
                                        <i class="fas fa-phone text-gray-400 w-5"></i>
                                        <span class="ml-2 text-gray-600">{{ $profile->phone }}</span>
                                    </div>
                                @endif
                                @if($profile->location)
                                    <div class="flex items-center">
                                        <i class="fas fa-map-marker-alt text-gray-400 w-5"></i>
                                        <span class="ml-2 text-gray-600">{{ $profile->location }}</span>
                                    </div>
                                @endif
                                @if($profile->website)
                                    <div class="flex items-center">
                                        <i class="fas fa-globe text-gray-400 w-5"></i>
                                        <a href="{{ $profile->website }}" target="_blank" class="ml-2 text-blue-600 hover:text-blue-800">{{ $profile->website }}</a>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div>
                            <h4 class="text-lg font-semibold text-gray-900 mb-3">Professional Details</h4>
                            <div class="space-y-2">
                                @if($profile->years_experience)
                                    <div class="flex items-center">
                                        <i class="fas fa-calendar text-gray-400 w-5"></i>
                                        <span class="ml-2 text-gray-600">{{ $profile->years_experience }} years of experience</span>
                                    </div>
                                @endif
                                @if($profile->birth_date)
                                    <div class="flex items-center">
                                        <i class="fas fa-birthday-cake text-gray-400 w-5"></i>
                                        <span class="ml-2 text-gray-600">{{ $profile->birth_date->format('F j, Y') }}</span>
                                    </div>
                                @endif
                                @if($profile->resume)
                                    <div class="flex items-center">
                                        <i class="fas fa-file-pdf text-gray-400 w-5"></i>
                                        <a href="{{ Storage::url($profile->resume) }}" target="_blank" class="ml-2 text-blue-600 hover:text-blue-800">Download Resume</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    @if($profile->bio)
                        <div class="mt-6">
                            <h4 class="text-lg font-semibold text-gray-900 mb-3">Bio</h4>
                            <p class="text-gray-600">{{ $profile->bio }}</p>
                        </div>
                    @endif

                    @if($profile->about_me)
                        <div class="mt-6">
                            <h4 class="text-lg font-semibold text-gray-900 mb-3">About Me</h4>
                            <div class="text-gray-600 whitespace-pre-line">{{ $profile->about_me }}</div>
                        </div>
                    @endif
                </div>
            </div>
        @else
            <div class="bg-white overflow-hidden shadow-lg rounded-lg">
                <div class="p-6 text-center">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-id-card text-gray-400 text-3xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">No Profile Created Yet</h3>
                    <p class="text-gray-600 mb-6">Create your portfolio profile to start showcasing your professional information.</p>
                    <a href="{{ route('portfolio-profile.create') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-blue-700">
                        <i class="fas fa-plus mr-2"></i>Create Profile
                    </a>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>