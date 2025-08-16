<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    <i class="fas fa-share-alt mr-3 text-pink-600"></i>Social Links
                </h2>
                <p class="text-sm text-gray-600 mt-1">Manage your social media profiles and links</p>
            </div>
            <a href="{{ route('socials.create') }}"
               class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-pink-600 to-purple-600 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-widest hover:from-pink-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2 transition-all duration-200 shadow-lg transform hover:-translate-y-0.5">
                <i class="fas fa-plus mr-2"></i>Add Social Link
            </a>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($socials->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($socials as $social)
                    <div class="bg-white overflow-hidden shadow-xl rounded-2xl border border-gray-200 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                        <!-- Social Header -->
                        <div class="p-6 border-b border-gray-100">
                            <div class="flex items-center justify-between mb-4">
                                <!-- Platform Icon -->
                                <div class="w-12 h-12 bg-gradient-to-br from-pink-500 to-purple-600 rounded-xl flex items-center justify-center">
                                    @if($social->icon)
                                        <i class="{{ $social->icon }} text-white text-xl"></i>
                                    @else
                                        <i class="fas fa-link text-white text-xl"></i>
                                    @endif
                                </div>
                                
                                <!-- Visibility Badge -->
                                @if($social->is_visible)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                        <i class="fas fa-eye mr-1 text-xs"></i>Visible
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-800">
                                        <i class="fas fa-eye-slash mr-1 text-xs"></i>Hidden
                                    </span>
                                @endif
                            </div>
                            
                            <h3 class="text-xl font-bold text-gray-900 mb-2 capitalize">{{ $social->platform }}</h3>
                            @if($social->username)
                                <p class="text-gray-600 text-sm mb-2">@{{ $social->username }}</p>
                            @endif
                        </div>

                        <!-- Social Content -->
                        <div class="p-6">
                            <!-- URL -->
                            <div class="mb-4">
                                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">URL</label>
                                <a href="{{ $social->url }}" 
                                   target="_blank" 
                                   class="text-pink-600 hover:text-pink-800 text-sm break-all transition-colors duration-200">
                                    {{ Str::limit($social->url, 40) }}
                                    <i class="fas fa-external-link-alt ml-1 text-xs"></i>
                                </a>
                            </div>

                            <!-- Sort Order -->
                            @if($social->sort_order > 0)
                                <div class="mb-4">
                                    <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-blue-100 text-blue-800">
                                        <i class="fas fa-sort-numeric-down mr-1"></i>Order: {{ $social->sort_order }}
                                    </span>
                                </div>
                            @endif

                            <!-- Quick Actions -->
                            <div class="flex space-x-2">
                                <a href="{{ $social->url }}" 
                                   target="_blank"
                                   class="flex-1 inline-flex items-center justify-center px-3 py-2 bg-pink-100 text-pink-700 rounded-lg hover:bg-pink-200 transition-colors duration-200 text-sm">
                                    <i class="fas fa-external-link-alt mr-1"></i>Visit
                                </a>
                                <a href="{{ route('socials.edit', $social) }}" 
                                   class="flex-1 inline-flex items-center justify-center px-3 py-2 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-colors duration-200 text-sm">
                                    <i class="fas fa-edit mr-1"></i>Edit
                                </a>
                            </div>
                        </div>

                        <!-- Social Footer -->
                        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                            <div class="flex justify-between items-center">
                                <div class="text-xs text-gray-500">
                                    Updated {{ $social->updated_at->diffForHumans() }}
                                </div>
                                <form action="{{ route('socials.destroy', $social) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            onclick="return confirm('Are you sure you want to delete this social link?')"
                                            class="inline-flex items-center px-2 py-1 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-colors duration-200 text-xs">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-white overflow-hidden shadow-xl rounded-2xl border border-gray-200">
                <div class="text-center py-16">
                    <div class="w-24 h-24 bg-gradient-to-br from-pink-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-share-alt text-white text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">No Social Links Yet</h3>
                    <p class="text-gray-600 mb-8 max-w-md mx-auto">
                        Connect with your audience by adding your social media profiles. Make it easy for visitors to find and follow you on different platforms.
                    </p>
                    <a href="{{ route('socials.create') }}"
                       class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-pink-600 to-purple-600 border border-transparent rounded-xl font-bold text-lg text-white hover:from-pink-700 hover:to-purple-700 focus:outline-none focus:ring-4 focus:ring-pink-300 transition-all duration-200 shadow-xl transform hover:-translate-y-1 hover:scale-105">
                        <i class="fas fa-plus mr-3 text-xl"></i>Add Your First Social Link
                    </a>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
