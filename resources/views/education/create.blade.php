<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    <i class="fas fa-plus mr-3 text-teal-600"></i>Add Education
                </h2>
                <p class="text-sm text-gray-600 mt-1">Add your educational background and qualifications</p>
            </div>
            <a href="{{ route('education.index') }}" 
               class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 transition-all duration-200">
                <i class="fas fa-arrow-left mr-2"></i>Back to Education
            </a>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <form action="{{ route('education.store') }}" method="POST" class="space-y-8">
            @csrf

            <!-- Basic Information -->
            <div class="bg-white overflow-hidden shadow-xl rounded-2xl border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-teal-50 to-blue-50">
                    <h3 class="text-lg font-bold text-gray-900">
                        <i class="fas fa-university mr-2 text-teal-600"></i>Education Details
                    </h3>
                    <p class="text-sm text-gray-600">Information about your educational background</p>
                </div>
                <div class="p-6 space-y-6">
                    <!-- Institution and Degree -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Institution -->
                        <div>
                            <label for="institution" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-university mr-2 text-gray-400"></i>Institution Name *
                            </label>
                            <input type="text" 
                                   name="institution" 
                                   id="institution" 
                                   value="{{ old('institution') }}"
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition duration-200"
                                   placeholder="e.g., Harvard University, MIT, Stanford">
                            @error('institution')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Degree -->
                        <div>
                            <label for="degree" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-graduation-cap mr-2 text-gray-400"></i>Degree *
                            </label>
                            <input type="text" 
                                   name="degree" 
                                   id="degree" 
                                   value="{{ old('degree') }}"
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition duration-200"
                                   placeholder="e.g., Bachelor of Science, Master of Arts, PhD">
                            @error('degree')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Field of Study and Grade -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Field of Study -->
                        <div>
                            <label for="field_of_study" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-book mr-2 text-gray-400"></i>Field of Study
                            </label>
                            <input type="text" 
                                   name="field_of_study" 
                                   id="field_of_study" 
                                   value="{{ old('field_of_study') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition duration-200"
                                   placeholder="e.g., Computer Science, Business Administration">
                            @error('field_of_study')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Grade -->
                        <div>
                            <label for="grade" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-medal mr-2 text-gray-400"></i>Grade/GPA
                            </label>
                            <input type="text" 
                                   name="grade" 
                                   id="grade" 
                                   value="{{ old('grade') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition duration-200"
                                   placeholder="e.g., 3.8 GPA, First Class Honours, Magna Cum Laude">
                            @error('grade')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-align-left mr-2 text-gray-400"></i>Description
                        </label>
                        <textarea name="description" 
                                  id="description" 
                                  rows="4"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition duration-200"
                                  placeholder="Describe your coursework, achievements, thesis, or any notable accomplishments during your studies...">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Study Period -->
            <div class="bg-white overflow-hidden shadow-xl rounded-2xl border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-blue-50 to-purple-50">
                    <h3 class="text-lg font-bold text-gray-900">
                        <i class="fas fa-calendar mr-2 text-blue-600"></i>Study Period
                    </h3>
                    <p class="text-sm text-gray-600">When did you study at this institution?</p>
                </div>
                <div class="p-6 space-y-6">
                    <!-- Current Studies Checkbox -->
                    <div class="flex items-center">
                        <input type="checkbox" 
                               name="is_current" 
                               id="is_current" 
                               value="1"
                               {{ old('is_current') ? 'checked' : '' }}
                               onchange="toggleEndDate()"
                               class="h-4 w-4 text-teal-600 focus:ring-teal-500 border-gray-300 rounded">
                        <label for="is_current" class="ml-2 block text-sm text-gray-700">
                            <i class="fas fa-circle mr-1 text-green-500"></i>
                            I am currently studying here
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
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition duration-200">
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
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition duration-200">
                            @error('end_date')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex justify-end space-x-4">
                <a href="{{ route('education.index') }}" 
                   class="inline-flex items-center px-6 py-3 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 transition duration-200">
                    Cancel
                </a>
                <button type="submit" 
                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-teal-600 to-blue-600 border border-transparent rounded-lg font-semibold text-sm text-white hover:from-teal-700 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 transition duration-200 shadow-lg transform hover:-translate-y-0.5">
                    <i class="fas fa-save mr-2"></i>Add Education
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

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            toggleEndDate();
        });
    </script>
</x-app-layout>
