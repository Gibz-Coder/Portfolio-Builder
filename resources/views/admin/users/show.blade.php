<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <i class="fas fa-user mr-2"></i>{{ __('User Details') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('admin.users.edit', $user) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                    <i class="fas fa-edit mr-2"></i>Edit User
                </a>
                <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Users
                </a>
            </div>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-lg rounded-lg">
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Basic Information -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-medium text-gray-900 border-b pb-2">Basic Information</h3>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Name</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $user->name }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Email</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $user->email }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Role</label>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Status</label>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $user->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $user->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Email Verified</label>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $user->email_verified_at ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ $user->email_verified_at ? 'Verified' : 'Not Verified' }}
                            </span>
                        </div>
                    </div>

                    <!-- Account Information -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-medium text-gray-900 border-b pb-2">Account Information</h3>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Created At</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $user->created_at->format('F j, Y \a\t g:i A') }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Last Updated</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $user->updated_at->format('F j, Y \a\t g:i A') }}</p>
                        </div>

                        @if($user->email_verified_at)
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Email Verified At</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $user->email_verified_at->format('F j, Y \a\t g:i A') }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Profile Information -->
                @if($user->profile)
                <div class="mt-8">
                    <h3 class="text-lg font-medium text-gray-900 border-b pb-2 mb-4">Profile Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @if($user->profile->title)
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Title</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $user->profile->title }}</p>
                        </div>
                        @endif

                        @if($user->profile->profession)
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Profession</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $user->profile->profession }}</p>
                        </div>
                        @endif

                        @if($user->profile->phone)
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Phone</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $user->profile->phone }}</p>
                        </div>
                        @endif

                        @if($user->profile->location)
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Location</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $user->profile->location }}</p>
                        </div>
                        @endif

                        @if($user->profile->website)
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Website</label>
                            <p class="mt-1 text-sm text-gray-900">
                                <a href="{{ $user->profile->website }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                    {{ $user->profile->website }}
                                </a>
                            </p>
                        </div>
                        @endif

                        @if($user->profile->years_experience)
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Years of Experience</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $user->profile->years_experience }} years</p>
                        </div>
                        @endif
                    </div>

                    @if($user->profile->bio)
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700">Bio</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $user->profile->bio }}</p>
                    </div>
                    @endif

                    @if($user->profile->about_me)
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700">About Me</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $user->profile->about_me }}</p>
                    </div>
                    @endif
                </div>
                @endif

                <!-- Statistics -->
                <div class="mt-8">
                    <h3 class="text-lg font-medium text-gray-900 border-b pb-2 mb-4">Statistics</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <div class="text-2xl font-bold text-blue-600">{{ $user->skills->count() }}</div>
                            <div class="text-sm text-blue-800">Skills</div>
                        </div>
                        <div class="bg-green-50 p-4 rounded-lg">
                            <div class="text-2xl font-bold text-green-600">{{ $user->projects->count() }}</div>
                            <div class="text-sm text-green-800">Projects</div>
                        </div>
                        <div class="bg-purple-50 p-4 rounded-lg">
                            <div class="text-2xl font-bold text-purple-600">{{ $user->experiences->count() }}</div>
                            <div class="text-sm text-purple-800">Experiences</div>
                        </div>
                        <div class="bg-yellow-50 p-4 rounded-lg">
                            <div class="text-2xl font-bold text-yellow-600">{{ $user->socials->count() }}</div>
                            <div class="text-sm text-yellow-800">Social Links</div>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="mt-8 flex justify-end space-x-3">
                    @if($user->role === 'user')
                    <a href="{{ route('portfolio.show', $user) }}" target="_blank"
                        class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700">
                        <i class="fas fa-external-link-alt mr-2"></i>View Portfolio
                    </a>
                    @endif
                    
                    @if($user->id !== auth()->id())
                    <form method="POST" action="{{ route('admin.users.toggle-status', $user) }}" class="inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" 
                            class="inline-flex items-center px-4 py-2 {{ $user->is_active ? 'bg-yellow-600 hover:bg-yellow-700' : 'bg-green-600 hover:bg-green-700' }} border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest">
                            <i class="fas {{ $user->is_active ? 'fa-user-slash' : 'fa-user-check' }} mr-2"></i>
                            {{ $user->is_active ? 'Deactivate' : 'Activate' }}
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
