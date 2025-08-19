<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    <i class="fas fa-edit mr-3 text-purple-600"></i>Edit Skill
                </h2>
                <p class="text-sm text-gray-600 mt-1">Update your skill information</p>
            </div>
            <a href="{{ route('skills.index') }}" 
               class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 transition-all duration-200">
                <i class="fas fa-arrow-left mr-2"></i>Back to Skills
            </a>
        </div>
    </x-slot>

    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <form action="{{ route('skills.update', $skill) }}" method="POST" class="space-y-8">
            @csrf
            @method('PUT')

            <!-- Skill Information -->
            <div class="bg-white overflow-hidden shadow-xl rounded-2xl border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-purple-50 to-blue-50">
                    <h3 class="text-lg font-bold text-gray-900">
                        <i class="fas fa-cogs mr-2 text-purple-600"></i>Skill Details
                    </h3>
                    <p class="text-sm text-gray-600">Update your skill information</p>
                </div>
                <div class="p-6 space-y-6">
                    <!-- Skill Name -->
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-tag mr-2 text-gray-400"></i>Skill Name *
                        </label>
                        <input type="text" 
                               name="name" 
                               id="name" 
                               value="{{ old('name', $skill->name) }}"
                               required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-200"
                               placeholder="e.g., JavaScript, Laravel, React">
                        @error('name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div>
                        <label for="category" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-folder mr-2 text-gray-400"></i>Category
                        </label>
                        <select name="category" 
                                id="category"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-200">
                            <option value="">Select a category</option>
                            <option value="Programming Languages" {{ old('category', $skill->category) == 'Programming Languages' ? 'selected' : '' }}>Programming Languages</option>
                            <option value="Frameworks" {{ old('category', $skill->category) == 'Frameworks' ? 'selected' : '' }}>Frameworks</option>
                            <option value="Databases" {{ old('category', $skill->category) == 'Databases' ? 'selected' : '' }}>Databases</option>
                            <option value="Tools & Software" {{ old('category', $skill->category) == 'Tools & Software' ? 'selected' : '' }}>Tools & Software</option>
                            <option value="Design" {{ old('category', $skill->category) == 'Design' ? 'selected' : '' }}>Design</option>
                            <option value="Soft Skills" {{ old('category', $skill->category) == 'Soft Skills' ? 'selected' : '' }}>Soft Skills</option>
                            <option value="Other" {{ old('category', $skill->category) == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('category')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Proficiency -->
                    <div>
                        <label for="proficiency" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-chart-bar mr-2 text-gray-400"></i>Proficiency Level *
                        </label>
                        <div class="space-y-3">
                            <input type="range" 
                                   name="proficiency" 
                                   id="proficiency" 
                                   min="0" 
                                   max="100" 
                                   value="{{ old('proficiency', $skill->proficiency) }}"
                                   class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer"
                                   oninput="updateProficiencyValue(this.value)">
                            <div class="flex justify-between text-xs text-gray-500">
                                <span>Beginner</span>
                                <span>Intermediate</span>
                                <span>Advanced</span>
                                <span>Expert</span>
                            </div>
                            <div class="text-center">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                                    <span id="proficiency-value">{{ old('proficiency', $skill->proficiency) }}</span>% Proficiency
                                </span>
                            </div>
                        </div>
                        @error('proficiency')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-align-left mr-2 text-gray-400"></i>Description
                        </label>
                        <textarea name="description" 
                                  id="description" 
                                  rows="4"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-200"
                                  placeholder="Describe your experience with this skill, projects you've used it in, or any certifications...">{{ old('description', $skill->description) }}</textarea>
                        @error('description')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Featured Skill -->
                    <div class="flex items-center">
                        <input type="checkbox" 
                               name="is_featured" 
                               id="is_featured" 
                               value="1"
                               {{ old('is_featured', $skill->is_featured) ? 'checked' : '' }}
                               class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                        <label for="is_featured" class="ml-2 block text-sm text-gray-700">
                            <i class="fas fa-star mr-1 text-yellow-500"></i>
                            Mark as featured skill (will be highlighted in your portfolio)
                        </label>
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex justify-end">
                <div class="flex space-x-4">
                    <a href="{{ route('skills.index') }}"
                       class="inline-flex items-center px-6 py-3 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition duration-200">
                        Cancel
                    </a>
                    <button type="submit"
                            class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-600 to-blue-600 border border-transparent rounded-lg font-semibold text-sm text-white hover:from-purple-700 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition duration-200 shadow-lg transform hover:-translate-y-0.5">
                        <i class="fas fa-save mr-2"></i>Update Skill
                    </button>
                </div>
            </div>
        </form>


    </div>

    <script>
        function updateProficiencyValue(value) {
            document.getElementById('proficiency-value').textContent = value;
            
            // Update the color based on proficiency level
            const span = document.getElementById('proficiency-value').parentElement;
            span.className = 'inline-flex items-center px-3 py-1 rounded-full text-sm font-medium ';
            
            if (value < 25) {
                span.className += 'bg-red-100 text-red-800';
            } else if (value < 50) {
                span.className += 'bg-yellow-100 text-yellow-800';
            } else if (value < 75) {
                span.className += 'bg-blue-100 text-blue-800';
            } else {
                span.className += 'bg-green-100 text-green-800';
            }
        }

        // Initialize the color on page load
        document.addEventListener('DOMContentLoaded', function() {
            const proficiency = document.getElementById('proficiency').value;
            updateProficiencyValue(proficiency);
        });
    </script>
</x-app-layout>
