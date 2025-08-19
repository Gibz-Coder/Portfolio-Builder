<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    <i class="fas fa-envelope mr-3 text-blue-600"></i>Messages
                </h2>
                <p class="text-sm text-gray-600 mt-1">Manage client inquiries and communications</p>
            </div>
            <div class="text-sm text-gray-600">
                {{ $messages->total() }} total messages
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($messages->count() > 0)
            <div class="bg-white overflow-hidden shadow-lg rounded-lg">
                <div class="divide-y divide-gray-200">
                    @foreach($messages as $message)
                        <div class="p-6 hover:bg-gray-50 {{ $message->status === 'unread' ? 'bg-blue-50 border-l-4 border-blue-500' : '' }}">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center space-x-3 mb-2">
                                        <div class="flex-shrink-0">
                                            <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center">
                                                <i class="fas fa-user text-gray-600"></i>
                                            </div>
                                        </div>
                                        <div class="flex-1">
                                            <div class="flex items-center justify-between">
                                                <div>
                                                    <h3 class="text-lg font-medium text-gray-900">{{ $message->name }}</h3>
                                                    <p class="text-sm text-gray-600">{{ $message->email }}</p>
                                                </div>
                                                <div class="text-right">
                                                    <p class="text-sm text-gray-500">{{ $message->created_at->diffForHumans() }}</p>
                                                    @if($message->status === 'unread')
                                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                            New
                                                        </span>
                                                    @else
                                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium 
                                                            {{ $message->status === 'read' ? 'bg-gray-100 text-gray-800' : 
                                                               ($message->status === 'replied' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800') }}">
                                                            {{ ucfirst($message->status) }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="ml-13">
                                        <h4 class="text-md font-medium text-gray-900 mb-1">{{ $message->subject }}</h4>
                                        <p class="text-gray-600 text-sm">{{ Str::limit($message->message, 150) }}</p>
                                        
                                        @if($message->phone || $message->company)
                                            <div class="mt-2 flex items-center space-x-4 text-sm text-gray-500">
                                                @if($message->phone)
                                                    <span><i class="fas fa-phone mr-1"></i>{{ $message->phone }}</span>
                                                @endif
                                                @if($message->company)
                                                    <span><i class="fas fa-building mr-1"></i>{{ $message->company }}</span>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="flex items-center space-x-2 ml-4">
                                    <a href="{{ route('messages.show', $message) }}" class="inline-flex items-center px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                        <i class="fas fa-eye mr-1"></i>View
                                    </a>
                                    
                                    @if($message->status === 'unread')
                                        <form method="POST" action="{{ route('messages.mark-read', $message) }}" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="inline-flex items-center px-3 py-1 border border-blue-300 rounded-md text-sm font-medium text-blue-700 bg-blue-50 hover:bg-blue-100">
                                                <i class="fas fa-check mr-1"></i>Mark Read
                                            </button>
                                        </form>
                                    @endif
                                    
                                    <form method="POST" action="{{ route('messages.destroy', $message) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this message?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center px-3 py-1 border border-red-300 rounded-md text-sm font-medium text-red-700 bg-red-50 hover:bg-red-100">
                                            <i class="fas fa-trash mr-1"></i>Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            
            <div class="mt-8">
                {{ $messages->links() }}
            </div>
        @else
            <div class="bg-white overflow-hidden shadow-lg rounded-lg">
                <div class="p-6 text-center">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-inbox text-gray-400 text-3xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">No Messages Yet</h3>
                    <p class="text-gray-600 mb-6">When people contact you through your portfolio, their messages will appear here.</p>
                    <a href="{{ route('portfolio.show', auth()->user()) }}" target="_blank" class="inline-flex items-center px-6 py-3 bg-blue-600 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-blue-700">
                        <i class="fas fa-external-link-alt mr-2"></i>View Your Portfolio
                    </a>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>