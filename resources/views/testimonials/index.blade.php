<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    <i class="fas fa-quote-left mr-3 text-yellow-600"></i>Testimonials
                </h2>
                <p class="text-sm text-gray-600 mt-1">Manage client testimonials and reviews</p>
            </div>
            <a href="{{ route('testimonials.create') }}"
               class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-yellow-600 to-orange-600 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-widest hover:from-yellow-700 hover:to-orange-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition-all duration-200 shadow-lg transform hover:-translate-y-0.5">
                <i class="fas fa-plus mr-2"></i>Add Testimonial
            </a>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($testimonials->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($testimonials as $testimonial)
                    <div class="bg-white overflow-hidden shadow-xl rounded-2xl border border-gray-200 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                        <!-- Testimonial Header -->
                        <div class="p-6 border-b border-gray-100">
                            <div class="flex items-center justify-between mb-4">
                                <!-- Client Info -->
                                <div class="flex items-center space-x-3">
                                    <!-- Client Avatar -->
                                    <div class="w-12 h-12 rounded-full overflow-hidden bg-gradient-to-br from-yellow-500 to-orange-600 flex items-center justify-center">
                                        @if($testimonial->client_avatar)
                                            <img src="{{ Storage::url($testimonial->client_avatar) }}" 
                                                 alt="{{ $testimonial->client_name }}" 
                                                 class="w-full h-full object-cover">
                                        @else
                                            <i class="fas fa-user text-white text-lg"></i>
                                        @endif
                                    </div>
                                    
                                    <!-- Client Details -->
                                    <div>
                                        <h3 class="font-bold text-gray-900">{{ $testimonial->client_name }}</h3>
                                        @if($testimonial->client_position || $testimonial->client_company)
                                            <p class="text-sm text-gray-600">
                                                @if($testimonial->client_position)
                                                    {{ $testimonial->client_position }}
                                                @endif
                                                @if($testimonial->client_position && $testimonial->client_company)
                                                    at
                                                @endif
                                                @if($testimonial->client_company)
                                                    {{ $testimonial->client_company }}
                                                @endif
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                
                                <!-- Status Badges -->
                                <div class="flex flex-col space-y-1">
                                    @if($testimonial->is_featured)
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-gradient-to-r from-yellow-400 to-orange-500 text-white">
                                            <i class="fas fa-star mr-1 text-xs"></i>Featured
                                        </span>
                                    @endif
                                    @if($testimonial->is_approved)
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                            <i class="fas fa-check mr-1 text-xs"></i>Approved
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-800">
                                            <i class="fas fa-clock mr-1 text-xs"></i>Pending
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Rating -->
                            <div class="flex items-center mb-3">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $testimonial->rating)
                                        <i class="fas fa-star text-yellow-400"></i>
                                    @else
                                        <i class="far fa-star text-gray-300"></i>
                                    @endif
                                @endfor
                                <span class="ml-2 text-sm text-gray-600">({{ $testimonial->rating }}/5)</span>
                            </div>
                            
                            <!-- Project Title -->
                            @if($testimonial->project_title)
                                <div class="mb-3">
                                    <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-medium bg-blue-100 text-blue-800">
                                        <i class="fas fa-project-diagram mr-1"></i>{{ $testimonial->project_title }}
                                    </span>
                                </div>
                            @endif
                        </div>

                        <!-- Testimonial Content -->
                        <div class="p-6">
                            <div class="relative">
                                <i class="fas fa-quote-left text-yellow-400 text-2xl absolute -top-2 -left-2"></i>
                                <p class="text-gray-600 leading-relaxed pl-6 pr-4">
                                    {{ Str::limit($testimonial->content, 150) }}
                                </p>
                                <i class="fas fa-quote-right text-yellow-400 text-2xl absolute -bottom-2 -right-2"></i>
                            </div>
                        </div>

                        <!-- Testimonial Footer -->
                        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                            <div class="flex justify-between items-center">
                                <div class="text-xs text-gray-500">
                                    Added {{ $testimonial->created_at->diffForHumans() }}
                                </div>
                                <div class="flex space-x-2">
                                    <a href="{{ route('testimonials.edit', $testimonial) }}" 
                                       class="inline-flex items-center px-3 py-2 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-colors duration-200">
                                        <i class="fas fa-edit text-sm"></i>
                                    </a>
                                    <form action="{{ route('testimonials.destroy', $testimonial) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                onclick="return confirm('Are you sure you want to delete this testimonial?')"
                                                class="inline-flex items-center px-3 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-colors duration-200">
                                            <i class="fas fa-trash text-sm"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-white overflow-hidden shadow-xl rounded-2xl border border-gray-200">
                <div class="text-center py-16">
                    <div class="w-24 h-24 bg-gradient-to-br from-yellow-500 to-orange-600 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-quote-left text-white text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">No Testimonials Yet</h3>
                    <p class="text-gray-600 mb-8 max-w-md mx-auto">
                        Start building social proof by adding client testimonials. Show potential clients what others say about your work and build trust.
                    </p>
                    <a href="{{ route('testimonials.create') }}"
                       class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-yellow-600 to-orange-600 border border-transparent rounded-xl font-bold text-lg text-white hover:from-yellow-700 hover:to-orange-700 focus:outline-none focus:ring-4 focus:ring-yellow-300 transition-all duration-200 shadow-xl transform hover:-translate-y-1 hover:scale-105">
                        <i class="fas fa-plus mr-3 text-xl"></i>Add Your First Testimonial
                    </a>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
