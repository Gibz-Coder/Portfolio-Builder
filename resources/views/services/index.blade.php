<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    <i class="fas fa-concierge-bell mr-3 text-indigo-600"></i>Services
                </h2>
                <p class="text-sm text-gray-600 mt-1">Manage the services you offer to clients</p>
            </div>
            <a href="{{ route('services.create') }}"
               class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-widest hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-200 shadow-lg transform hover:-translate-y-0.5">
                <i class="fas fa-plus mr-2"></i>Add Service
            </a>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($services->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($services as $service)
                    <div class="bg-white overflow-hidden shadow-xl rounded-2xl border border-gray-200 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                        <!-- Service Header -->
                        <div class="p-6 border-b border-gray-100">
                            <div class="flex items-center justify-between mb-4">
                                <!-- Service Icon -->
                                <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center">
                                    @if($service->icon)
                                        <i class="{{ $service->icon }} text-white text-xl"></i>
                                    @else
                                        <i class="fas fa-cog text-white text-xl"></i>
                                    @endif
                                </div>
                                
                                <!-- Status Badge -->
                                @if($service->is_active)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                        <i class="fas fa-circle mr-1 text-xs"></i>Active
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-800">
                                        <i class="fas fa-pause mr-1 text-xs"></i>Inactive
                                    </span>
                                @endif
                            </div>
                            
                            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $service->title }}</h3>
                            <p class="text-gray-600 text-sm leading-relaxed">{{ Str::limit($service->description, 100) }}</p>
                        </div>

                        <!-- Service Content -->
                        <div class="p-6">
                            <!-- Pricing -->
                            @if($service->price)
                                <div class="mb-4">
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-600">Price:</span>
                                        <div class="text-right">
                                            <span class="text-2xl font-bold text-indigo-600">${{ number_format($service->price, 2) }}</span>
                                            @if($service->price_type)
                                                <span class="text-sm text-gray-500 ml-1">/ {{ $service->price_type }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Features -->
                            @if($service->features && count($service->features) > 0)
                                <div class="mb-4">
                                    <h4 class="text-sm font-semibold text-gray-700 mb-2">Features:</h4>
                                    <ul class="space-y-1">
                                        @foreach(array_slice($service->features, 0, 3) as $feature)
                                            <li class="flex items-center text-sm text-gray-600">
                                                <i class="fas fa-check text-green-500 mr-2 text-xs"></i>
                                                {{ $feature }}
                                            </li>
                                        @endforeach
                                        @if(count($service->features) > 3)
                                            <li class="text-sm text-gray-500 italic">
                                                +{{ count($service->features) - 3 }} more features
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            @endif

                            <!-- Sort Order -->
                            @if($service->sort_order > 0)
                                <div class="mb-4">
                                    <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-blue-100 text-blue-800">
                                        <i class="fas fa-sort-numeric-down mr-1"></i>Order: {{ $service->sort_order }}
                                    </span>
                                </div>
                            @endif
                        </div>

                        <!-- Service Footer -->
                        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                            <div class="flex justify-between items-center">
                                <div class="text-xs text-gray-500">
                                    Updated {{ $service->updated_at->diffForHumans() }}
                                </div>
                                <div class="flex space-x-2">
                                    <a href="{{ route('services.edit', $service) }}" 
                                       class="inline-flex items-center px-3 py-2 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-colors duration-200">
                                        <i class="fas fa-edit text-sm"></i>
                                    </a>
                                    <form action="{{ route('services.destroy', $service) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                onclick="return confirm('Are you sure you want to delete this service?')"
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
                    <div class="w-24 h-24 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-cogs text-white text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">No Services Yet</h3>
                    <p class="text-gray-600 mb-8 max-w-md mx-auto">
                        Start showcasing your professional services. Let potential clients know what you can do for them and how much it costs.
                    </p>
                    <a href="{{ route('services.create') }}"
                       class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 border border-transparent rounded-xl font-bold text-lg text-white hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-4 focus:ring-indigo-300 transition-all duration-200 shadow-xl transform hover:-translate-y-1 hover:scale-105">
                        <i class="fas fa-plus mr-3 text-xl"></i>Add Your First Service
                    </a>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
