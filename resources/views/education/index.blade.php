<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    <i class="fas fa-graduation-cap mr-3 text-teal-600"></i>Education
                </h2>
                <p class="text-sm text-gray-600 mt-1">Manage your educational background and qualifications</p>
            </div>
            <a href="{{ route('education.create') }}"
               class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-teal-600 to-blue-600 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-widest hover:from-teal-700 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 transition-all duration-200 shadow-lg transform hover:-translate-y-0.5">
                <i class="fas fa-plus mr-2"></i>Add Education
            </a>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($education->count() > 0)
            <div class="space-y-6">
                @foreach($education as $edu)
                    <div class="bg-white overflow-hidden shadow-xl rounded-2xl border border-gray-200 hover:shadow-2xl transition-all duration-300">
                        <div class="p-6">
                            <div class="flex items-start justify-between">
                                <!-- Main Content -->
                                <div class="flex-1">
                                    <div class="flex items-start space-x-4">
                                        <!-- Institution Icon -->
                                        <div class="w-16 h-16 bg-gradient-to-br from-teal-500 to-blue-600 rounded-xl flex items-center justify-center flex-shrink-0">
                                            <i class="fas fa-university text-white text-2xl"></i>
                                        </div>
                                        
                                        <!-- Education Details -->
                                        <div class="flex-1">
                                            <div class="flex items-start justify-between">
                                                <div>
                                                    <h3 class="text-xl font-bold text-gray-900 mb-1">{{ $edu->degree }}</h3>
                                                    @if($edu->field_of_study)
                                                        <p class="text-lg text-teal-600 font-semibold mb-2">{{ $edu->field_of_study }}</p>
                                                    @endif
                                                    <p class="text-lg text-gray-700 font-medium mb-2">{{ $edu->institution }}</p>
                                                    
                                                    <!-- Education Details -->
                                                    <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600 mb-3">
                                                        @if($edu->grade)
                                                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-green-100 text-green-800 font-medium">
                                                                <i class="fas fa-medal mr-1"></i>{{ $edu->grade }}
                                                            </span>
                                                        @endif
                                                        <span class="inline-flex items-center">
                                                            <i class="fas fa-calendar mr-1 text-gray-400"></i>
                                                            {{ $edu->start_date->format('M Y') }} - 
                                                            @if($edu->is_current)
                                                                <span class="text-green-600 font-semibold ml-1">Present</span>
                                                            @else
                                                                {{ $edu->end_date?->format('M Y') ?? 'Present' }}
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                                
                                                <!-- Current Education Badge -->
                                                @if($edu->is_current)
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gradient-to-r from-green-400 to-green-600 text-white shadow-lg">
                                                        <i class="fas fa-circle mr-1 text-xs"></i>Current
                                                    </span>
                                                @endif
                                            </div>
                                            
                                            <!-- Description -->
                                            @if($edu->description)
                                                <div class="mt-4">
                                                    <p class="text-gray-600 leading-relaxed">{{ $edu->description }}</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Action Buttons -->
                                <div class="flex flex-col space-y-2 ml-4">
                                    <a href="{{ route('education.edit', $edu) }}" 
                                       class="inline-flex items-center px-3 py-2 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-colors duration-200">
                                        <i class="fas fa-edit text-sm"></i>
                                    </a>
                                    <form action="{{ route('education.destroy', $edu) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                onclick="return confirm('Are you sure you want to delete this education record?')"
                                                class="inline-flex items-center px-3 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-colors duration-200">
                                            <i class="fas fa-trash text-sm"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            
                            <!-- Footer -->
                            <div class="mt-6 pt-4 border-t border-gray-100 flex justify-between items-center text-xs text-gray-500">
                                <span>Updated {{ $edu->updated_at->diffForHumans() }}</span>
                                @if($edu->start_date && $edu->end_date)
                                    <span>
                                        Duration: {{ $edu->start_date->diffInYears($edu->end_date) }} years
                                    </span>
                                @elseif($edu->start_date && $edu->is_current)
                                    <span>
                                        Duration: {{ $edu->start_date->diffInYears(now()) }} years (ongoing)
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-white overflow-hidden shadow-xl rounded-2xl border border-gray-200">
                <div class="text-center py-16">
                    <div class="w-24 h-24 bg-gradient-to-br from-teal-500 to-blue-600 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-graduation-cap text-white text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">No Education Records Yet</h3>
                    <p class="text-gray-600 mb-8 max-w-md mx-auto">
                        Add your educational background to showcase your qualifications and academic achievements to potential employers.
                    </p>
                    <a href="{{ route('education.create') }}"
                       class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-teal-600 to-blue-600 border border-transparent rounded-xl font-bold text-lg text-white hover:from-teal-700 hover:to-blue-700 focus:outline-none focus:ring-4 focus:ring-teal-300 transition-all duration-200 shadow-xl transform hover:-translate-y-1 hover:scale-105">
                        <i class="fas fa-plus mr-3 text-xl"></i>Add Your First Education
                    </a>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
