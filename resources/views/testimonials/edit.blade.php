<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    <i class="fas fa-edit mr-3 text-yellow-600"></i>Edit Testimonial
                </h2>
                <p class="text-sm text-gray-600 mt-1">Update testimonial information</p>
            </div>
            <a href="{{ route('testimonials.index') }}" 
               class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 transition-all duration-200">
                <i class="fas fa-arrow-left mr-2"></i>Back to Testimonials
            </a>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <form action="{{ route('testimonials.update', $testimonial) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')

            <!-- Client Information -->
            <div class="bg-white overflow-hidden shadow-xl rounded-2xl border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-yellow-50 to-orange-50">
                    <h3 class="text-lg font-bold text-gray-900">
                        <i class="fas fa-user mr-2 text-yellow-600"></i>Client Information
                    </h3>
                    <p class="text-sm text-gray-600">Details about the client who provided this testimonial</p>
                </div>
                <div class="p-6 space-y-6">
                    <!-- Client Name and Avatar -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Client Name -->
                        <div class="md:col-span-2">
                            <label for="client_name" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-user mr-2 text-gray-400"></i>Client Name *
                            </label>
                            <input type="text" 
                                   name="client_name" 
                                   id="client_name" 
                                   value="{{ old('client_name', $testimonial->client_name) }}"
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition duration-200"
                                   placeholder="e.g., John Smith, Sarah Johnson">
                            @error('client_name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Client Avatar -->
                        <div>
                            <label for="client_avatar" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-image mr-2 text-gray-400"></i>Client Photo
                            </label>
                            @if($testimonial->client_avatar)
                                <div class="mb-3">
                                    <img src="{{ Storage::url($testimonial->client_avatar) }}" alt="Current client photo" class="w-16 h-16 rounded-full object-cover border-2 border-gray-300">
                                    <p class="text-xs text-gray-500 mt-1">Current photo</p>
                                </div>
                            @endif
                            <input type="file" 
                                   name="client_avatar" 
                                   id="client_avatar" 
                                   accept="image/*"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition duration-200">
                            <p class="mt-1 text-xs text-gray-500">Max size: 2MB</p>
                            @error('client_avatar')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Position and Company -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Client Position -->
                        <div>
                            <label for="client_position" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-briefcase mr-2 text-gray-400"></i>Position/Title
                            </label>
                            <input type="text" 
                                   name="client_position" 
                                   id="client_position" 
                                   value="{{ old('client_position', $testimonial->client_position) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition duration-200"
                                   placeholder="e.g., CEO, Marketing Manager, Founder">
                            @error('client_position')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Client Company -->
                        <div>
                            <label for="client_company" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-building mr-2 text-gray-400"></i>Company
                            </label>
                            <input type="text" 
                                   name="client_company" 
                                   id="client_company" 
                                   value="{{ old('client_company', $testimonial->client_company) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition duration-200"
                                   placeholder="e.g., Tech Corp, Design Studio, Startup Inc.">
                            @error('client_company')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Testimonial Content -->
            <div class="bg-white overflow-hidden shadow-xl rounded-2xl border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-blue-50 to-purple-50">
                    <h3 class="text-lg font-bold text-gray-900">
                        <i class="fas fa-quote-left mr-2 text-blue-600"></i>Testimonial Content
                    </h3>
                    <p class="text-sm text-gray-600">The testimonial text and rating</p>
                </div>
                <div class="p-6 space-y-6">
                    <!-- Testimonial Content -->
                    <div>
                        <label for="content" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-align-left mr-2 text-gray-400"></i>Testimonial Text *
                        </label>
                        <textarea name="content" 
                                  id="content" 
                                  rows="6"
                                  required
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition duration-200"
                                  placeholder="Enter the client's testimonial. What did they say about your work, service, or collaboration?">{{ old('content', $testimonial->content) }}</textarea>
                        @error('content')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Rating and Project -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Rating -->
                        <div>
                            <label for="rating" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-star mr-2 text-gray-400"></i>Rating *
                            </label>
                            <select name="rating" 
                                    id="rating"
                                    required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition duration-200">
                                <option value="">Select rating</option>
                                <option value="5" {{ old('rating', $testimonial->rating) == '5' ? 'selected' : '' }}>⭐⭐⭐⭐⭐ (5 stars)</option>
                                <option value="4" {{ old('rating', $testimonial->rating) == '4' ? 'selected' : '' }}>⭐⭐⭐⭐ (4 stars)</option>
                                <option value="3" {{ old('rating', $testimonial->rating) == '3' ? 'selected' : '' }}>⭐⭐⭐ (3 stars)</option>
                                <option value="2" {{ old('rating', $testimonial->rating) == '2' ? 'selected' : '' }}>⭐⭐ (2 stars)</option>
                                <option value="1" {{ old('rating', $testimonial->rating) == '1' ? 'selected' : '' }}>⭐ (1 star)</option>
                            </select>
                            @error('rating')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Project Title -->
                        <div>
                            <label for="project_title" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-project-diagram mr-2 text-gray-400"></i>Related Project
                            </label>
                            <input type="text" 
                                   name="project_title" 
                                   id="project_title" 
                                   value="{{ old('project_title', $testimonial->project_title) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition duration-200"
                                   placeholder="e.g., Website Redesign, Mobile App Development">
                            @error('project_title')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Settings -->
            <div class="bg-white overflow-hidden shadow-xl rounded-2xl border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-green-50 to-blue-50">
                    <h3 class="text-lg font-bold text-gray-900">
                        <i class="fas fa-cog mr-2 text-green-600"></i>Testimonial Settings
                    </h3>
                    <p class="text-sm text-gray-600">Display and approval settings</p>
                </div>
                <div class="p-6 space-y-6">
                    <!-- Featured Testimonial -->
                    <div class="flex items-center">
                        <input type="checkbox" 
                               name="is_featured" 
                               id="is_featured" 
                               value="1"
                               {{ old('is_featured', $testimonial->is_featured) ? 'checked' : '' }}
                               class="h-4 w-4 text-yellow-600 focus:ring-yellow-500 border-gray-300 rounded">
                        <label for="is_featured" class="ml-2 block text-sm text-gray-700">
                            <i class="fas fa-star mr-1 text-yellow-500"></i>
                            Mark as featured testimonial (will be highlighted in your portfolio)
                        </label>
                    </div>

                    <!-- Approved Status -->
                    <div class="flex items-center">
                        <input type="checkbox" 
                               name="is_approved" 
                               id="is_approved" 
                               value="1"
                               {{ old('is_approved', $testimonial->is_approved) ? 'checked' : '' }}
                               class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                        <label for="is_approved" class="ml-2 block text-sm text-gray-700">
                            <i class="fas fa-check mr-1 text-green-500"></i>
                            Approve testimonial for public display
                        </label>
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex justify-end">
                <div class="flex space-x-4">
                    <a href="{{ route('testimonials.index') }}"
                       class="inline-flex items-center px-6 py-3 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition duration-200">
                        Cancel
                    </a>
                    <button type="submit"
                            class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-yellow-600 to-orange-600 border border-transparent rounded-lg font-semibold text-sm text-white hover:from-yellow-700 hover:to-orange-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition duration-200 shadow-lg transform hover:-translate-y-0.5">
                        <i class="fas fa-save mr-2"></i>Update Testimonial
                    </button>
                </div>
            </div>
        </form>

        <!-- Delete Form (Separate from Update Form) -->
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
            <div class="bg-red-50 border border-red-200 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-red-800 mb-2">
                    <i class="fas fa-exclamation-triangle mr-2"></i>Danger Zone
                </h3>
                <p class="text-sm text-red-600 mb-4">
                    Once you delete this testimonial, it will be permanently removed from your portfolio.
                </p>
                <form action="{{ route('testimonials.destroy', $testimonial) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            onclick="return confirm('Are you sure you want to delete this testimonial? This action cannot be undone.')"
                            class="inline-flex items-center px-6 py-3 bg-red-600 border border-transparent rounded-lg font-semibold text-sm text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition duration-200">
                        <i class="fas fa-trash mr-2"></i>Delete Testimonial
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
