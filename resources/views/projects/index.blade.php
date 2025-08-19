<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    <i class="fas fa-project-diagram mr-3 text-green-600"></i>Projects
                </h2>
                <p class="text-sm text-gray-600 mt-1">Showcase your portfolio projects and work</p>
            </div>
            <a href="{{ route('projects.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                <i class="fas fa-plus mr-2"></i>Add Project
            </a>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($projects->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($projects as $project)
                    <div class="bg-white overflow-hidden shadow-lg rounded-lg hover:shadow-xl transition-shadow">
                        @if($project->image)
                            <div class="h-48 bg-gray-200">
                                <img src="{{ Storage::url($project->image) }}" alt="{{ $project->title }}" class="w-full h-full object-cover">
                            </div>
                        @else
                            <div class="h-48 bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                                <i class="fas fa-project-diagram text-white text-4xl"></i>
                            </div>
                        @endif
                        
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="text-lg font-semibold text-gray-900">{{ $project->title }}</h3>
                                @if($project->is_featured)
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        <i class="fas fa-star mr-1"></i>Featured
                                    </span>
                                @endif
                            </div>
                            
                            <p class="text-gray-600 text-sm mb-4">{{ Str::limit($project->description, 100) }}</p>
                            
                            <div class="flex items-center justify-between mb-4">
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium 
                                    {{ $project->status === 'completed' ? 'bg-green-100 text-green-800' : 
                                       ($project->status === 'in_progress' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                                    {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                                </span>
                            </div>
                            
                            @if($project->technologies)
                                <div class="mb-4">
                                    <div class="flex flex-wrap gap-1">
                                        @foreach(array_slice($project->technologies, 0, 3) as $tech)
                                            <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                                {{ $tech }}
                                            </span>
                                        @endforeach
                                        @if(count($project->technologies) > 3)
                                            <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-gray-100 text-gray-800">
                                                +{{ count($project->technologies) - 3 }} more
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @endif
                            
                            <div class="flex items-center justify-between">
                                <div class="flex space-x-2">
                                    @if($project->demo_url)
                                        <a href="{{ $project->demo_url }}" target="_blank" class="text-blue-600 hover:text-blue-800 text-sm">
                                            <i class="fas fa-external-link-alt mr-1"></i>Demo
                                        </a>
                                    @endif
                                    @if($project->github_url)
                                        <a href="{{ $project->github_url }}" target="_blank" class="text-gray-600 hover:text-gray-800 text-sm">
                                            <i class="fab fa-github mr-1"></i>Code
                                        </a>
                                    @endif
                                </div>
                                
                                <div class="flex space-x-1">
                                    <a href="{{ route('projects.show', $project) }}" class="text-gray-600 hover:text-gray-800">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('projects.edit', $project) }}" class="text-blue-600 hover:text-blue-800">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" action="{{ route('projects.destroy', $project) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this project?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="mt-8">
                {{ $projects->links() }}
            </div>
        @else
            <div class="bg-white overflow-hidden shadow-lg rounded-lg">
                <div class="p-6 text-center">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-project-diagram text-gray-400 text-3xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">No Projects Yet</h3>
                    <p class="text-gray-600 mb-6">Start showcasing your work by adding your first project.</p>
                    <a href="{{ route('projects.create') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-blue-700">
                        <i class="fas fa-plus mr-2"></i>Add Your First Project
                    </a>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>