<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <i class="fas fa-user-edit mr-2"></i>{{ __('Edit User') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('admin.users.show', $user) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                    <i class="fas fa-eye mr-2"></i>View User
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
                <form method="POST" action="{{ route('admin.users.update', $user) }}">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <input type="password" name="password" id="password"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <p class="mt-1 text-xs text-gray-500">Leave blank to keep current password</p>
                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password Confirmation -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <p class="mt-1 text-xs text-gray-500">Required only if changing password</p>
                        </div>

                        <!-- Role -->
                        <div>
                            <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                            <select name="role" id="role" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Select Role</option>
                                <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                            @error('role')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="is_active" class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="is_active" id="is_active" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="1" {{ old('is_active', $user->is_active) == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('is_active', $user->is_active) == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('is_active')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Account Information -->
                    <div class="mt-8 p-4 bg-gray-50 rounded-lg">
                        <h3 class="text-sm font-medium text-gray-900 mb-3">Account Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                            <div>
                                <span class="text-gray-600">Created:</span>
                                <span class="text-gray-900">{{ $user->created_at->format('M j, Y') }}</span>
                            </div>
                            <div>
                                <span class="text-gray-600">Last Updated:</span>
                                <span class="text-gray-900">{{ $user->updated_at->format('M j, Y') }}</span>
                            </div>
                            <div>
                                <span class="text-gray-600">Email Verified:</span>
                                <span class="text-gray-900">{{ $user->email_verified_at ? 'Yes' : 'No' }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end space-x-3">
                        <a href="{{ route('admin.users.show', $user) }}" 
                            class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400">
                            Cancel
                        </a>
                        <button type="submit" 
                            class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                            <i class="fas fa-save mr-2"></i>Update User
                        </button>
                    </div>
                </form>

                <!-- Danger Zone -->
                @if($user->id !== auth()->id())
                <div class="mt-8 p-4 border border-red-200 rounded-lg bg-red-50">
                    <h3 class="text-sm font-medium text-red-900 mb-3">Danger Zone</h3>
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-red-700">Delete this user account permanently.</p>
                            <p class="text-xs text-red-600">This action cannot be undone.</p>
                        </div>
                        <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="inline" 
                            onsubmit="return confirm('Are you sure you want to delete this user? This action cannot be undone.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700">
                                <i class="fas fa-trash mr-2"></i>Delete User
                            </button>
                        </form>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
