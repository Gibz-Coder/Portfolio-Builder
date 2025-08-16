<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    <i class="fas fa-cogs mr-3 text-purple-600"></i>Skills & Expertise
                </h2>
                <p class="text-sm text-gray-600 mt-1">Manage your technical and professional skills</p>
            </div>
            <a href="{{ route('skills.create') }}"
               class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-purple-600 to-blue-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:from-purple-700 hover:to-blue-700 transition-all duration-200 shadow-lg">
                <i class="fas fa-plus mr-2"></i>Add Skill
            </a>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($skills->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($skills as $skill)
                    <div class="bg-white overflow-hidden shadow-lg rounded-lg hover:shadow-xl transition-shadow">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-3">
                                <h3 class="text-lg font-semibold text-gray-900">{{ $skill->name }}</h3>
                                @if($skill->is_featured)
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        <i class="fas fa-star mr-1"></i>Featured
                                    </span>
                                @endif
                            </div>
                            
                            @if($skill->category)
                                <p class="text-sm text-gray-600 mb-3">{{ $skill->category }}</p>
                            @endif
                            
                            <div class="mb-4">
                                <div class="flex justify-between text-sm text-gray-600 mb-1">
                                    <span>Proficiency</span>
                                    <span>{{ $skill->proficiency }}%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-blue-600 h-2 rounded-full transition-all duration-300" style="width: {{ $skill->proficiency }}%"></div>
                                </div>
                            </div>
                            
                            @if($skill->description)
                                <p class="text-gray-600 text-sm mb-4">{{ Str::limit($skill->description, 100) }}</p>
                            @endif
                            
                            <div class="flex items-center justify-between">
                                <div class="flex space-x-2">
                                    <a href="{{ route('skills.edit', $skill) }}" class="text-blue-600 hover:text-blue-800">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" action="{{ route('skills.destroy', $skill) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this skill?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                                
                                <div class="text-xs text-gray-500">
                                    Added {{ $skill->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white overflow-hidden shadow-lg rounded-lg">
                <div class="p-6 text-center">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-cogs text-gray-400 text-3xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">No Skills Added Yet</h3>
                    <p class="text-gray-600 mb-6">Start building your skill profile by adding your technical and professional skills.</p>
                    <a href="{{ route('skills.create') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-blue-700">
                        <i class="fas fa-plus mr-2"></i>Add Your First Skill
                    </a>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>