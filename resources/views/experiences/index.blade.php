<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    <i class="fas fa-briefcase mr-3 text-orange-600"></i>Work Experience
                </h2>
                <p class="text-sm text-gray-600 mt-1">Manage your professional work history</p>
            </div>
            <a href="{{ route('experiences.create') }}"
               class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-orange-600 to-red-600 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-widest hover:from-orange-700 hover:to-red-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition-all duration-200 shadow-lg transform hover:-translate-y-0.5">
                <i class="fas fa-plus mr-2"></i>Add Experience
            </a>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($experiences->count() > 0)
            <div class="space-y-6">
                @foreach($experiences as $experience)
                    <div class="bg-white overflow-hidden shadow-xl rounded-2xl border border-gray-200 hover:shadow-2xl transition-all duration-300">
                        <div class="p-6">
                            <div class="flex items-start justify-between">
                                <!-- Main Content -->
                                <div class="flex-1">
                                    <div class="flex items-start space-x-4">
                                        <!-- Company Icon -->
                                        <div class="w-16 h-16 bg-gradient-to-br from-orange-500 to-red-600 rounded-xl flex items-center justify-center flex-shrink-0">
                                            <i class="fas fa-building text-white text-2xl"></i>
                                        </div>
                                        
                                        <!-- Experience Details -->
                                        <div class="flex-1">
                                            <div class="flex items-start justify-between">
                                                <div>
                                                    <h3 class="text-xl font-bold text-gray-900 mb-1">{{ $experience->position }}</h3>
                                                    <p class="text-lg text-orange-600 font-semibold mb-2">{{ $experience->company }}</p>
                                                    
                                                    <!-- Employment Details -->
                                                    <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600 mb-3">
                                                        @if($experience->employment_type)
                                                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-blue-100 text-blue-800 font-medium">
                                                                <i class="fas fa-clock mr-1"></i>{{ $experience->employment_type }}
                                                            </span>
                                                        @endif
                                                        @if($experience->location)
                                                            <span class="inline-flex items-center">
                                                                <i class="fas fa-map-marker-alt mr-1 text-gray-400"></i>{{ $experience->location }}
                                                            </span>
                                                        @endif
                                                        <span class="inline-flex items-center">
                                                            <i class="fas fa-calendar mr-1 text-gray-400"></i>
                                                            {{ $experience->start_date->format('M Y') }} - 
                                                            @if($experience->is_current)
                                                                <span class="text-green-600 font-semibold ml-1">Present</span>
                                                            @else
                                                                {{ $experience->end_date?->format('M Y') ?? 'Present' }}
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                                
                                                <!-- Current Job Badge -->
                                                @if($experience->is_current)
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gradient-to-r from-green-400 to-green-600 text-white shadow-lg">
                                                        <i class="fas fa-circle mr-1 text-xs"></i>Current
                                                    </span>
                                                @endif
                                            </div>
                                            
                                            <!-- Description -->
                                            @if($experience->description)
                                                <div class="mt-4">
                                                    <p class="text-gray-600 leading-relaxed">{{ $experience->description }}</p>
                                                </div>
                                            @endif
                                            
                                            <!-- Technologies -->
                                            @if($experience->technologies && count($experience->technologies) > 0)
                                                <div class="mt-4">
                                                    <h4 class="text-sm font-semibold text-gray-700 mb-2">Technologies Used:</h4>
                                                    <div class="flex flex-wrap gap-2">
                                                        @foreach($experience->technologies as $tech)
                                                            <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-medium bg-gray-100 text-gray-800 border">
                                                                <i class="fas fa-code mr-1"></i>{{ $tech }}
                                                            </span>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Action Buttons -->
                                <div class="flex flex-col space-y-2 ml-4">
                                    <a href="{{ route('experiences.edit', $experience) }}" 
                                       class="inline-flex items-center px-3 py-2 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-colors duration-200">
                                        <i class="fas fa-edit text-sm"></i>
                                    </a>
                                    <form action="{{ route('experiences.destroy', $experience) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                onclick="return confirm('Are you sure you want to delete this experience?')"
                                                class="inline-flex items-center px-3 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-colors duration-200">
                                            <i class="fas fa-trash text-sm"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            
                            <!-- Footer -->
                            <div class="mt-6 pt-4 border-t border-gray-100 flex justify-between items-center text-xs text-gray-500">
                                <span>Updated {{ $experience->updated_at->diffForHumans() }}</span>
                                @if($experience->start_date && $experience->end_date)
                                    <span>
                                        Duration: {{ $experience->start_date->diffInMonths($experience->end_date) }} months
                                    </span>
                                @elseif($experience->start_date && $experience->is_current)
                                    <span>
                                        Duration: {{ $experience->start_date->diffInMonths(now()) }} months (ongoing)
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
                    <div class="w-24 h-24 bg-gradient-to-br from-orange-500 to-red-600 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-briefcase text-white text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">No Work Experience Yet</h3>
                    <p class="text-gray-600 mb-8 max-w-md mx-auto">
                        Start building your professional profile by adding your work experience. Show potential employers your career journey and achievements.
                    </p>
                    <a href="{{ route('experiences.create') }}"
                       class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-orange-600 to-red-600 border border-transparent rounded-xl font-bold text-lg text-white hover:from-orange-700 hover:to-red-700 focus:outline-none focus:ring-4 focus:ring-orange-300 transition-all duration-200 shadow-xl transform hover:-translate-y-1 hover:scale-105">
                        <i class="fas fa-plus mr-3 text-xl"></i>Add Your First Experience
                    </a>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
