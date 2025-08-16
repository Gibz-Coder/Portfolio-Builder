<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    <i class="fas fa-edit mr-3 text-indigo-600"></i>Edit Service
                </h2>
                <p class="text-sm text-gray-600 mt-1">Update your service information</p>
            </div>
            <a href="{{ route('services.index') }}" 
               class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 transition-all duration-200">
                <i class="fas fa-arrow-left mr-2"></i>Back to Services
            </a>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <form action="{{ route('services.update', $service) }}" method="POST" class="space-y-8">
            @csrf
            @method('PUT')

            <!-- Basic Information -->
            <div class="bg-white overflow-hidden shadow-xl rounded-2xl border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-indigo-50 to-purple-50">
                    <h3 class="text-lg font-bold text-gray-900">
                        <i class="fas fa-info-circle mr-2 text-indigo-600"></i>Service Information
                    </h3>
                    <p class="text-sm text-gray-600">Basic details about your service</p>
                </div>
                <div class="p-6 space-y-6">
                    <!-- Title and Icon -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Title -->
                        <div class="md:col-span-2">
                            <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-heading mr-2 text-gray-400"></i>Service Title *
                            </label>
                            <input type="text" 
                                   name="title" 
                                   id="title" 
                                   value="{{ old('title', $service->title) }}"
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200"
                                   placeholder="e.g., Web Development, Logo Design, SEO Optimization">
                            @error('title')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Icon -->
                        <div>
                            <label for="icon" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-icons mr-2 text-gray-400"></i>Icon Class
                            </label>
                            <input type="text" 
                                   name="icon" 
                                   id="icon" 
                                   value="{{ old('icon', $service->icon) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200"
                                   placeholder="e.g., fas fa-code, fas fa-paint-brush">
                            <p class="mt-1 text-xs text-gray-500">FontAwesome icon class</p>
                            @error('icon')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-align-left mr-2 text-gray-400"></i>Service Description *
                        </label>
                        <textarea name="description" 
                                  id="description" 
                                  rows="6"
                                  required
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200"
                                  placeholder="Describe your service in detail. What do you offer? What problems do you solve? What makes your service unique?">{{ old('description', $service->description) }}</textarea>
                        @error('description')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Pricing -->
            <div class="bg-white overflow-hidden shadow-xl rounded-2xl border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-green-50 to-blue-50">
                    <h3 class="text-lg font-bold text-gray-900">
                        <i class="fas fa-dollar-sign mr-2 text-green-600"></i>Pricing Information
                    </h3>
                    <p class="text-sm text-gray-600">Set your service pricing (optional)</p>
                </div>
                <div class="p-6 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Price -->
                        <div>
                            <label for="price" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-money-bill mr-2 text-gray-400"></i>Price
                            </label>
                            <input type="number" 
                                   name="price" 
                                   id="price" 
                                   value="{{ old('price', $service->price) }}"
                                   step="0.01"
                                   min="0"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200"
                                   placeholder="0.00">
                            @error('price')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Price Type -->
                        <div>
                            <label for="price_type" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-clock mr-2 text-gray-400"></i>Price Type
                            </label>
                            <select name="price_type" 
                                    id="price_type"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200">
                                <option value="">Select pricing type</option>
                                <option value="hourly" {{ old('price_type', $service->price_type) == 'hourly' ? 'selected' : '' }}>Per Hour</option>
                                <option value="fixed" {{ old('price_type', $service->price_type) == 'fixed' ? 'selected' : '' }}>Fixed Price</option>
                                <option value="monthly" {{ old('price_type', $service->price_type) == 'monthly' ? 'selected' : '' }}>Monthly</option>
                                <option value="project" {{ old('price_type', $service->price_type) == 'project' ? 'selected' : '' }}>Per Project</option>
                            </select>
                            @error('price_type')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Features -->
            <div class="bg-white overflow-hidden shadow-xl rounded-2xl border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-purple-50 to-pink-50">
                    <h3 class="text-lg font-bold text-gray-900">
                        <i class="fas fa-list-check mr-2 text-purple-600"></i>Service Features
                    </h3>
                    <p class="text-sm text-gray-600">What's included in this service?</p>
                </div>
                <div class="p-6">
                    <div id="features-container">
                        <!-- Features will be populated by JavaScript -->
                    </div>
                    @error('features')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Settings -->
            <div class="bg-white overflow-hidden shadow-xl rounded-2xl border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-orange-50 to-red-50">
                    <h3 class="text-lg font-bold text-gray-900">
                        <i class="fas fa-cog mr-2 text-orange-600"></i>Service Settings
                    </h3>
                    <p class="text-sm text-gray-600">Additional service configuration</p>
                </div>
                <div class="p-6 space-y-6">
                    <!-- Active Status -->
                    <div class="flex items-center">
                        <input type="checkbox" 
                               name="is_active" 
                               id="is_active" 
                               value="1"
                               {{ old('is_active', $service->is_active) ? 'checked' : '' }}
                               class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="is_active" class="ml-2 block text-sm text-gray-700">
                            <i class="fas fa-eye mr-1 text-green-500"></i>
                            Service is active and visible to clients
                        </label>
                    </div>

                    <!-- Sort Order -->
                    <div>
                        <label for="sort_order" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-sort-numeric-down mr-2 text-gray-400"></i>Display Order
                        </label>
                        <input type="number" 
                               name="sort_order" 
                               id="sort_order" 
                               value="{{ old('sort_order', $service->sort_order) }}"
                               min="0"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200"
                               placeholder="0">
                        <p class="mt-1 text-xs text-gray-500">Lower numbers appear first. Leave as 0 for automatic ordering.</p>
                        @error('sort_order')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex justify-end">
                <div class="flex space-x-4">
                    <a href="{{ route('services.index') }}"
                       class="inline-flex items-center px-6 py-3 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition duration-200">
                        Cancel
                    </a>
                    <button type="submit"
                            class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 border border-transparent rounded-lg font-semibold text-sm text-white hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition duration-200 shadow-lg transform hover:-translate-y-0.5">
                        <i class="fas fa-save mr-2"></i>Update Service
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
                    Once you delete this service, it will be permanently removed from your portfolio.
                </p>
                <form action="{{ route('services.destroy', $service) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            onclick="return confirm('Are you sure you want to delete this service? This action cannot be undone.')"
                            class="inline-flex items-center px-6 py-3 bg-red-600 border border-transparent rounded-lg font-semibold text-sm text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition duration-200">
                        <i class="fas fa-trash mr-2"></i>Delete Service
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function addFeature() {
            const container = document.getElementById('features-container');
            const newInput = document.createElement('div');
            newInput.className = 'feature-input flex items-center space-x-2 mb-3';
            newInput.innerHTML = `
                <input type="text" 
                       name="features[]" 
                       class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-200"
                       placeholder="e.g., Responsive design, SEO optimization, 24/7 support">
                <button type="button" 
                        onclick="removeFeature(this)" 
                        class="px-4 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-200">
                    <i class="fas fa-minus"></i>
                </button>
            `;
            container.appendChild(newInput);
        }

        function removeFeature(button) {
            button.parentElement.remove();
        }

        // Initialize features
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('features-container');
            const features = @json(old('features', $service->features ?? []));
            
            if (features.length === 0) {
                // Add empty input if no features
                const newInput = document.createElement('div');
                newInput.className = 'feature-input flex items-center space-x-2 mb-3';
                newInput.innerHTML = `
                    <input type="text" 
                           name="features[]" 
                           class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-200"
                           placeholder="e.g., Responsive design, SEO optimization, 24/7 support">
                    <button type="button" 
                            onclick="addFeature()" 
                            class="px-4 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition duration-200">
                        <i class="fas fa-plus"></i>
                    </button>
                `;
                container.appendChild(newInput);
            } else {
                // Add existing features
                features.forEach(function(feature, index) {
                    const newInput = document.createElement('div');
                    newInput.className = 'feature-input flex items-center space-x-2 mb-3';
                    newInput.innerHTML = `
                        <input type="text" 
                               name="features[]" 
                               value="${feature}"
                               class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-200"
                               placeholder="e.g., Responsive design, SEO optimization, 24/7 support">
                        <button type="button" 
                                onclick="${index === 0 ? 'addFeature()' : 'removeFeature(this)'}" 
                                class="px-4 py-3 ${index === 0 ? 'bg-purple-600 hover:bg-purple-700' : 'bg-red-600 hover:bg-red-700'} text-white rounded-lg transition duration-200">
                            <i class="fas fa-${index === 0 ? 'plus' : 'minus'}"></i>
                        </button>
                    `;
                    container.appendChild(newInput);
                });
            }
        });
    </script>
</x-app-layout>
