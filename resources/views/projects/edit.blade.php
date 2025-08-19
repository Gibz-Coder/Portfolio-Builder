<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    <i class="fas fa-edit mr-3 text-green-600"></i>Edit Project
                </h2>
                <p class="text-sm text-gray-600 mt-1">Update your project information</p>
            </div>
            <a href="{{ route('projects.index') }}" 
               class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 transition-all duration-200">
                <i class="fas fa-arrow-left mr-2"></i>Back to Projects
            </a>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <form action="{{ route('projects.update', $project) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')

            <!-- Basic Information -->
            <div class="bg-white overflow-hidden shadow-xl rounded-2xl border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-green-50 to-blue-50">
                    <h3 class="text-lg font-bold text-gray-900">
                        <i class="fas fa-info-circle mr-2 text-green-600"></i>Project Information
                    </h3>
                    <p class="text-sm text-gray-600">Basic details about your project</p>
                </div>
                <div class="p-6 space-y-6">
                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-heading mr-2 text-gray-400"></i>Project Title *
                        </label>
                        <input type="text" 
                               name="title" 
                               id="title" 
                               value="{{ old('title', $project->title) }}"
                               required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200"
                               placeholder="e.g., E-commerce Website, Mobile App, API Development">
                        @error('title')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-align-left mr-2 text-gray-400"></i>Project Description *
                        </label>
                        <textarea name="description" 
                                  id="description" 
                                  rows="6"
                                  required
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200"
                                  placeholder="Describe your project, its purpose, challenges you solved, and key features...">{{ old('description', $project->description) }}</textarea>
                        @error('description')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status and Dates -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-tasks mr-2 text-gray-400"></i>Project Status *
                            </label>
                            <select name="status" 
                                    id="status"
                                    required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200">
                                <option value="completed" {{ old('status', $project->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="in_progress" {{ old('status', $project->status) == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="planned" {{ old('status', $project->status) == 'planned' ? 'selected' : '' }}>Planned</option>
                            </select>
                            @error('status')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Start Date -->
                        <div>
                            <label for="start_date" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-calendar-alt mr-2 text-gray-400"></i>Start Date
                            </label>
                            <input type="date" 
                                   name="start_date" 
                                   id="start_date" 
                                   value="{{ old('start_date', $project->start_date?->format('Y-m-d')) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200">
                            @error('start_date')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- End Date -->
                        <div>
                            <label for="end_date" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-calendar-check mr-2 text-gray-400"></i>End Date
                            </label>
                            <input type="date" 
                                   name="end_date" 
                                   id="end_date" 
                                   value="{{ old('end_date', $project->end_date?->format('Y-m-d')) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200">
                            @error('end_date')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Links and Media -->
            <div class="bg-white overflow-hidden shadow-xl rounded-2xl border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-blue-50 to-purple-50">
                    <h3 class="text-lg font-bold text-gray-900">
                        <i class="fas fa-link mr-2 text-blue-600"></i>Links & Media
                    </h3>
                    <p class="text-sm text-gray-600">Project links and visual content</p>
                </div>
                <div class="p-6 space-y-6">
                    <!-- URLs -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Demo URL -->
                        <div>
                            <label for="demo_url" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-external-link-alt mr-2 text-gray-400"></i>Live Demo URL
                            </label>
                            <input type="url" 
                                   name="demo_url" 
                                   id="demo_url" 
                                   value="{{ old('demo_url', $project->demo_url) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200"
                                   placeholder="https://your-project-demo.com">
                            @error('demo_url')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- GitHub URL -->
                        <div>
                            <label for="github_url" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fab fa-github mr-2 text-gray-400"></i>GitHub Repository
                            </label>
                            <input type="url" 
                                   name="github_url" 
                                   id="github_url" 
                                   value="{{ old('github_url', $project->github_url) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200"
                                   placeholder="https://github.com/username/repository">
                            @error('github_url')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Project Image -->
                    <div>
                        <label for="image" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-image mr-2 text-gray-400"></i>Project Image
                        </label>
                        @if($project->image)
                            <div class="mb-3">
                                <img src="{{ Storage::url($project->image) }}" alt="Current project image" class="w-32 h-24 rounded-lg object-cover border-2 border-gray-300">
                                <p class="text-xs text-gray-500 mt-1">Current image</p>
                            </div>
                        @endif
                        <input type="file" 
                               name="image" 
                               id="image" 
                               accept="image/*"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200">
                        <p class="mt-1 text-xs text-gray-500">Max size: 2MB. Supported formats: JPG, PNG, GIF</p>
                        @error('image')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Technologies -->
            <div class="bg-white overflow-hidden shadow-xl rounded-2xl border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-purple-50 to-pink-50">
                    <h3 class="text-lg font-bold text-gray-900">
                        <i class="fas fa-code mr-2 text-purple-600"></i>Technologies Used
                    </h3>
                    <p class="text-sm text-gray-600">Technologies and tools used in this project</p>
                </div>
                <div class="p-6">
                    <div id="technologies-container">
                        <!-- Technologies will be populated by JavaScript -->
                    </div>
                    @error('technologies')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Settings -->
            <div class="bg-white overflow-hidden shadow-xl rounded-2xl border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-orange-50 to-red-50">
                    <h3 class="text-lg font-bold text-gray-900">
                        <i class="fas fa-cog mr-2 text-orange-600"></i>Project Settings
                    </h3>
                    <p class="text-sm text-gray-600">Additional project configuration</p>
                </div>
                <div class="p-6 space-y-6">
                    <!-- Featured Project -->
                    <div class="flex items-center">
                        <input type="checkbox" 
                               name="is_featured" 
                               id="is_featured" 
                               value="1"
                               {{ old('is_featured', $project->is_featured) ? 'checked' : '' }}
                               class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                        <label for="is_featured" class="ml-2 block text-sm text-gray-700">
                            <i class="fas fa-star mr-1 text-yellow-500"></i>
                            Mark as featured project (will be highlighted in your portfolio)
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
                               value="{{ old('sort_order', $project->sort_order) }}"
                               min="0"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200"
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
                    <a href="{{ route('projects.index') }}"
                       class="inline-flex items-center px-6 py-3 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition duration-200">
                        Cancel
                    </a>
                    <button type="submit"
                            class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-600 to-blue-600 border border-transparent rounded-lg font-semibold text-sm text-white hover:from-green-700 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition duration-200 shadow-lg transform hover:-translate-y-0.5">
                        <i class="fas fa-save mr-2"></i>Update Project
                    </button>
                </div>
            </div>
        </form>


    </div>

    <script>
        function addTechnology() {
            const container = document.getElementById('technologies-container');
            const newInput = document.createElement('div');
            newInput.className = 'technology-input flex items-center space-x-2 mb-3';
            newInput.innerHTML = `
                <input type="text" 
                       name="technologies[]" 
                       class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-200"
                       placeholder="e.g., Laravel, React, MySQL">
                <button type="button" 
                        onclick="removeTechnology(this)" 
                        class="px-4 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-200">
                    <i class="fas fa-minus"></i>
                </button>
            `;
            container.appendChild(newInput);
        }

        function removeTechnology(button) {
            button.parentElement.remove();
        }

        // Initialize technologies
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('technologies-container');
            const technologies = @json(old('technologies', $project->technologies ?? []));
            
            if (technologies.length === 0) {
                // Add empty input if no technologies
                const newInput = document.createElement('div');
                newInput.className = 'technology-input flex items-center space-x-2 mb-3';
                newInput.innerHTML = `
                    <input type="text" 
                           name="technologies[]" 
                           class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-200"
                           placeholder="e.g., Laravel, React, MySQL">
                    <button type="button" 
                            onclick="addTechnology()" 
                            class="px-4 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition duration-200">
                        <i class="fas fa-plus"></i>
                    </button>
                `;
                container.appendChild(newInput);
            } else {
                // Add existing technologies
                technologies.forEach(function(tech, index) {
                    const newInput = document.createElement('div');
                    newInput.className = 'technology-input flex items-center space-x-2 mb-3';
                    newInput.innerHTML = `
                        <input type="text" 
                               name="technologies[]" 
                               value="${tech}"
                               class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-200"
                               placeholder="e.g., Laravel, React, MySQL">
                        <button type="button" 
                                onclick="${index === 0 ? 'addTechnology()' : 'removeTechnology(this)'}" 
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
