<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    <i class="fas fa-edit mr-3 text-blue-600"></i>Edit Portfolio Profile
                </h2>
                <p class="text-sm text-gray-600 mt-1">Update your professional profile information</p>
            </div>
            <a href="{{ route('portfolio-profile.index') }}" 
               class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 transition-all duration-200">
                <i class="fas fa-arrow-left mr-2"></i>Back
            </a>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <form action="{{ route('portfolio-profile.update', $portfolioProfile) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')

            <!-- Basic Information -->
            <div class="bg-white overflow-hidden shadow-xl rounded-2xl border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-blue-50 to-purple-50">
                    <h3 class="text-lg font-bold text-gray-900">
                        <i class="fas fa-user mr-2 text-blue-600"></i>Basic Information
                    </h3>
                    <p class="text-sm text-gray-600">Your core professional details</p>
                </div>
                <div class="p-6 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Title -->
                        <div>
                            <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-tag mr-2 text-gray-400"></i>Professional Title
                            </label>
                            <input type="text" 
                                   name="title" 
                                   id="title" 
                                   value="{{ old('title', $portfolioProfile->title) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                   placeholder="e.g., Senior Full Stack Developer">
                            @error('title')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Profession -->
                        <div>
                            <label for="profession" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-briefcase mr-2 text-gray-400"></i>Profession
                            </label>
                            <input type="text" 
                                   name="profession" 
                                   id="profession" 
                                   value="{{ old('profession', $portfolioProfile->profession) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                   placeholder="e.g., Software Engineer">
                            @error('profession')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Years of Experience -->
                        <div>
                            <label for="years_experience" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-clock mr-2 text-gray-400"></i>Years of Experience
                            </label>
                            <input type="number" 
                                   name="years_experience" 
                                   id="years_experience" 
                                   value="{{ old('years_experience', $portfolioProfile->years_experience) }}"
                                   min="0"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                   placeholder="5">
                            @error('years_experience')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Birth Date -->
                        <div>
                            <label for="birth_date" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-birthday-cake mr-2 text-gray-400"></i>Birth Date
                            </label>
                            <input type="date" 
                                   name="birth_date" 
                                   id="birth_date" 
                                   value="{{ old('birth_date', $portfolioProfile->birth_date?->format('Y-m-d')) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                            @error('birth_date')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Bio -->
                    <div>
                        <label for="bio" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-quote-left mr-2 text-gray-400"></i>Professional Bio
                        </label>
                        <textarea name="bio" 
                                  id="bio" 
                                  rows="4"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                  placeholder="Write a brief professional bio that highlights your expertise and experience...">{{ old('bio', $portfolioProfile->bio) }}</textarea>
                        @error('bio')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- About Me -->
                    <div>
                        <label for="about_me" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-user-circle mr-2 text-gray-400"></i>About Me
                        </label>
                        <textarea name="about_me" 
                                  id="about_me" 
                                  rows="6"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                  placeholder="Tell visitors more about yourself, your passions, and what drives you professionally...">{{ old('about_me', $portfolioProfile->about_me) }}</textarea>
                        @error('about_me')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="bg-white overflow-hidden shadow-xl rounded-2xl border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-green-50 to-blue-50">
                    <h3 class="text-lg font-bold text-gray-900">
                        <i class="fas fa-address-card mr-2 text-green-600"></i>Contact Information
                    </h3>
                    <p class="text-sm text-gray-600">How people can reach you</p>
                </div>
                <div class="p-6 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-phone mr-2 text-gray-400"></i>Phone Number
                            </label>
                            <input type="tel" 
                                   name="phone" 
                                   id="phone" 
                                   value="{{ old('phone', $portfolioProfile->phone) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                   placeholder="+1 (555) 123-4567">
                            @error('phone')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Location -->
                        <div>
                            <label for="location" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-map-marker-alt mr-2 text-gray-400"></i>Location
                            </label>
                            <input type="text" 
                                   name="location" 
                                   id="location" 
                                   value="{{ old('location', $portfolioProfile->location) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                   placeholder="San Francisco, CA">
                            @error('location')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Website -->
                    <div>
                        <label for="website" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-globe mr-2 text-gray-400"></i>Website URL
                        </label>
                        <input type="url" 
                               name="website" 
                               id="website" 
                               value="{{ old('website', $portfolioProfile->website) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                               placeholder="https://yourwebsite.com">
                        @error('website')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Files -->
            <div class="bg-white overflow-hidden shadow-xl rounded-2xl border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-purple-50 to-pink-50">
                    <h3 class="text-lg font-bold text-gray-900">
                        <i class="fas fa-file-upload mr-2 text-purple-600"></i>Files & Media
                    </h3>
                    <p class="text-sm text-gray-600">Upload your avatar and resume</p>
                </div>
                <div class="p-6 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Avatar -->
                        <div>
                            <label for="avatar" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-user-circle mr-2 text-gray-400"></i>Profile Avatar
                            </label>
                            @if($portfolioProfile->avatar)
                                <div class="mb-3">
                                    <img src="{{ Storage::url($portfolioProfile->avatar) }}" alt="Current Avatar" class="w-20 h-20 rounded-full object-cover border-2 border-gray-300">
                                    <p class="text-xs text-gray-500 mt-1">Current avatar</p>
                                </div>
                            @endif
                            <input type="file" 
                                   name="avatar" 
                                   id="avatar" 
                                   accept="image/*"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                            <p class="mt-1 text-xs text-gray-500">Max size: 2MB. Supported formats: JPG, PNG, GIF</p>
                            @error('avatar')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Resume -->
                        <div>
                            <label for="resume" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-file-pdf mr-2 text-gray-400"></i>Resume (PDF)
                            </label>
                            @if($portfolioProfile->resume)
                                <div class="mb-3">
                                    <a href="{{ Storage::url($portfolioProfile->resume) }}" target="_blank" class="text-blue-600 hover:text-blue-800 text-sm">
                                        <i class="fas fa-file-pdf mr-1"></i>View current resume
                                    </a>
                                </div>
                            @endif
                            <input type="file" 
                                   name="resume" 
                                   id="resume" 
                                   accept=".pdf"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                            <p class="mt-1 text-xs text-gray-500">Max size: 5MB. PDF format only</p>
                            @error('resume')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex justify-between">
                <form action="{{ route('portfolio-profile.destroy', $portfolioProfile) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            onclick="return confirm('Are you sure you want to delete this profile? This action cannot be undone.')"
                            class="inline-flex items-center px-6 py-3 bg-red-600 border border-transparent rounded-lg font-semibold text-sm text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition duration-200">
                        <i class="fas fa-trash mr-2"></i>Delete Profile
                    </button>
                </form>

                <div class="flex space-x-4">
                    <a href="{{ route('portfolio-profile.index') }}" 
                       class="inline-flex items-center px-6 py-3 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-200">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 border border-transparent rounded-lg font-semibold text-sm text-white hover:from-blue-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-200 shadow-lg transform hover:-translate-y-0.5">
                        <i class="fas fa-save mr-2"></i>Update Profile
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
