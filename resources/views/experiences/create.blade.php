<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    <i class="fas fa-plus mr-3 text-orange-600"></i>Add Work Experience
                </h2>
                <p class="text-sm text-gray-600 mt-1">Add a new position to your professional history</p>
            </div>
            <a href="{{ route('experiences.index') }}" 
               class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 transition-all duration-200">
                <i class="fas fa-arrow-left mr-2"></i>Back to Experience
            </a>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <form action="{{ route('experiences.store') }}" method="POST" class="space-y-8">
            @csrf

            <!-- Basic Information -->
            <div class="bg-white overflow-hidden shadow-xl rounded-2xl border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-orange-50 to-red-50">
                    <h3 class="text-lg font-bold text-gray-900">
                        <i class="fas fa-building mr-2 text-orange-600"></i>Position Details
                    </h3>
                    <p class="text-sm text-gray-600">Basic information about your role</p>
                </div>
                <div class="p-6 space-y-6">
                    <!-- Position and Company -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Position -->
                        <div>
                            <label for="position" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-user-tie mr-2 text-gray-400"></i>Job Title *
                            </label>
                            <input type="text" 
                                   name="position" 
                                   id="position" 
                                   value="{{ old('position') }}"
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition duration-200"
                                   placeholder="e.g., Senior Software Engineer, Marketing Manager">
                            @error('position')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Company -->
                        <div>
                            <label for="company" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-building mr-2 text-gray-400"></i>Company Name *
                            </label>
                            <input type="text" 
                                   name="company" 
                                   id="company" 
                                   value="{{ old('company') }}"
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition duration-200"
                                   placeholder="e.g., Google, Microsoft, Startup Inc.">
                            @error('company')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Employment Type and Location -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Employment Type -->
                        <div>
                            <label for="employment_type" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-clock mr-2 text-gray-400"></i>Employment Type
                            </label>
                            <select name="employment_type" 
                                    id="employment_type"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition duration-200">
                                <option value="">Select employment type</option>
                                <option value="Full-time" {{ old('employment_type') == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                                <option value="Part-time" {{ old('employment_type') == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                                <option value="Contract" {{ old('employment_type') == 'Contract' ? 'selected' : '' }}>Contract</option>
                                <option value="Freelance" {{ old('employment_type') == 'Freelance' ? 'selected' : '' }}>Freelance</option>
                                <option value="Internship" {{ old('employment_type') == 'Internship' ? 'selected' : '' }}>Internship</option>
                                <option value="Temporary" {{ old('employment_type') == 'Temporary' ? 'selected' : '' }}>Temporary</option>
                            </select>
                            @error('employment_type')
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
                                   value="{{ old('location') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition duration-200"
                                   placeholder="e.g., San Francisco, CA or Remote">
                            @error('location')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-align-left mr-2 text-gray-400"></i>Job Description
                        </label>
                        <textarea name="description" 
                                  id="description" 
                                  rows="6"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition duration-200"
                                  placeholder="Describe your responsibilities, achievements, and key contributions in this role...">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Employment Period -->
            <div class="bg-white overflow-hidden shadow-xl rounded-2xl border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-blue-50 to-purple-50">
                    <h3 class="text-lg font-bold text-gray-900">
                        <i class="fas fa-calendar mr-2 text-blue-600"></i>Employment Period
                    </h3>
                    <p class="text-sm text-gray-600">When did you work in this position?</p>
                </div>
                <div class="p-6 space-y-6">
                    <!-- Current Job Checkbox -->
                    <div class="flex items-center">
                        <input type="checkbox" 
                               name="is_current" 
                               id="is_current" 
                               value="1"
                               {{ old('is_current') ? 'checked' : '' }}
                               onchange="toggleEndDate()"
                               class="h-4 w-4 text-orange-600 focus:ring-orange-500 border-gray-300 rounded">
                        <label for="is_current" class="ml-2 block text-sm text-gray-700">
                            <i class="fas fa-circle mr-1 text-green-500"></i>
                            This is my current job
                        </label>
                    </div>

                    <!-- Date Fields -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Start Date -->
                        <div>
                            <label for="start_date" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-calendar-alt mr-2 text-gray-400"></i>Start Date *
                            </label>
                            <input type="date" 
                                   name="start_date" 
                                   id="start_date" 
                                   value="{{ old('start_date') }}"
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition duration-200">
                            @error('start_date')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- End Date -->
                        <div id="end-date-container">
                            <label for="end_date" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-calendar-check mr-2 text-gray-400"></i>End Date
                            </label>
                            <input type="date" 
                                   name="end_date" 
                                   id="end_date" 
                                   value="{{ old('end_date') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition duration-200">
                            @error('end_date')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Technologies -->
            <div class="bg-white overflow-hidden shadow-xl rounded-2xl border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-purple-50 to-pink-50">
                    <h3 class="text-lg font-bold text-gray-900">
                        <i class="fas fa-code mr-2 text-purple-600"></i>Technologies & Tools
                    </h3>
                    <p class="text-sm text-gray-600">Technologies and tools you used in this role</p>
                </div>
                <div class="p-6">
                    <div id="technologies-container">
                        <div class="technology-input flex items-center space-x-2 mb-3">
                            <input type="text" 
                                   name="technologies[]" 
                                   class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-200"
                                   placeholder="e.g., JavaScript, Python, AWS">
                            <button type="button" 
                                    onclick="addTechnology()" 
                                    class="px-4 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition duration-200">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    @error('technologies')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex justify-end space-x-4">
                <a href="{{ route('experiences.index') }}" 
                   class="inline-flex items-center px-6 py-3 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition duration-200">
                    Cancel
                </a>
                <button type="submit" 
                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-orange-600 to-red-600 border border-transparent rounded-lg font-semibold text-sm text-white hover:from-orange-700 hover:to-red-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition duration-200 shadow-lg transform hover:-translate-y-0.5">
                    <i class="fas fa-save mr-2"></i>Add Experience
                </button>
            </div>
        </form>
    </div>

    <script>
        function toggleEndDate() {
            const isCurrentCheckbox = document.getElementById('is_current');
            const endDateContainer = document.getElementById('end-date-container');
            const endDateInput = document.getElementById('end_date');
            
            if (isCurrentCheckbox.checked) {
                endDateContainer.style.opacity = '0.5';
                endDateInput.disabled = true;
                endDateInput.value = '';
            } else {
                endDateContainer.style.opacity = '1';
                endDateInput.disabled = false;
            }
        }

        function addTechnology() {
            const container = document.getElementById('technologies-container');
            const newInput = document.createElement('div');
            newInput.className = 'technology-input flex items-center space-x-2 mb-3';
            newInput.innerHTML = `
                <input type="text" 
                       name="technologies[]" 
                       class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-200"
                       placeholder="e.g., JavaScript, Python, AWS">
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

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            toggleEndDate();
            
            // Add old technologies if validation fails
            @if(old('technologies'))
                const technologies = @json(old('technologies'));
                const container = document.getElementById('technologies-container');
                
                // Clear the default input
                container.innerHTML = '';
                
                technologies.forEach(function(tech, index) {
                    const newInput = document.createElement('div');
                    newInput.className = 'technology-input flex items-center space-x-2 mb-3';
                    newInput.innerHTML = `
                        <input type="text" 
                               name="technologies[]" 
                               value="${tech}"
                               class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-200"
                               placeholder="e.g., JavaScript, Python, AWS">
                        <button type="button" 
                                onclick="${index === 0 ? 'addTechnology()' : 'removeTechnology(this)'}" 
                                class="px-4 py-3 ${index === 0 ? 'bg-purple-600 hover:bg-purple-700' : 'bg-red-600 hover:bg-red-700'} text-white rounded-lg transition duration-200">
                            <i class="fas fa-${index === 0 ? 'plus' : 'minus'}"></i>
                        </button>
                    `;
                    container.appendChild(newInput);
                });
            @endif
        });
    </script>
</x-app-layout>
