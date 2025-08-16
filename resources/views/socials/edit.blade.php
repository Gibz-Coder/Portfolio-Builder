<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    <i class="fas fa-edit mr-3 text-pink-600"></i>Edit Social Link
                </h2>
                <p class="text-sm text-gray-600 mt-1">Update your social media profile information</p>
            </div>
            <a href="{{ route('socials.index') }}" 
               class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 transition-all duration-200">
                <i class="fas fa-arrow-left mr-2"></i>Back to Social Links
            </a>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <form action="{{ route('socials.update', $social) }}" method="POST" class="space-y-8">
            @csrf
            @method('PUT')

            <!-- Platform Information -->
            <div class="bg-white overflow-hidden shadow-xl rounded-2xl border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-pink-50 to-purple-50">
                    <h3 class="text-lg font-bold text-gray-900">
                        <i class="fas fa-share-alt mr-2 text-pink-600"></i>Platform Information
                    </h3>
                    <p class="text-sm text-gray-600">Details about the social platform</p>
                </div>
                <div class="p-6 space-y-6">
                    <!-- Platform and Icon -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Platform -->
                        <div>
                            <label for="platform" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-tag mr-2 text-gray-400"></i>Platform Name *
                            </label>
                            <select name="platform" 
                                    id="platform"
                                    required
                                    onchange="updatePlatformDefaults()"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition duration-200">
                                <option value="">Select a platform</option>
                                <option value="facebook" {{ old('platform', $social->platform) == 'facebook' ? 'selected' : '' }}>Facebook</option>
                                <option value="twitter" {{ old('platform', $social->platform) == 'twitter' ? 'selected' : '' }}>Twitter</option>
                                <option value="instagram" {{ old('platform', $social->platform) == 'instagram' ? 'selected' : '' }}>Instagram</option>
                                <option value="linkedin" {{ old('platform', $social->platform) == 'linkedin' ? 'selected' : '' }}>LinkedIn</option>
                                <option value="github" {{ old('platform', $social->platform) == 'github' ? 'selected' : '' }}>GitHub</option>
                                <option value="youtube" {{ old('platform', $social->platform) == 'youtube' ? 'selected' : '' }}>YouTube</option>
                                <option value="tiktok" {{ old('platform', $social->platform) == 'tiktok' ? 'selected' : '' }}>TikTok</option>
                                <option value="discord" {{ old('platform', $social->platform) == 'discord' ? 'selected' : '' }}>Discord</option>
                                <option value="telegram" {{ old('platform', $social->platform) == 'telegram' ? 'selected' : '' }}>Telegram</option>
                                <option value="whatsapp" {{ old('platform', $social->platform) == 'whatsapp' ? 'selected' : '' }}>WhatsApp</option>
                                <option value="dribbble" {{ old('platform', $social->platform) == 'dribbble' ? 'selected' : '' }}>Dribbble</option>
                                <option value="behance" {{ old('platform', $social->platform) == 'behance' ? 'selected' : '' }}>Behance</option>
                                <option value="medium" {{ old('platform', $social->platform) == 'medium' ? 'selected' : '' }}>Medium</option>
                                <option value="dev" {{ old('platform', $social->platform) == 'dev' ? 'selected' : '' }}>Dev.to</option>
                                <option value="stackoverflow" {{ old('platform', $social->platform) == 'stackoverflow' ? 'selected' : '' }}>Stack Overflow</option>
                                <option value="codepen" {{ old('platform', $social->platform) == 'codepen' ? 'selected' : '' }}>CodePen</option>
                                <option value="website" {{ old('platform', $social->platform) == 'website' ? 'selected' : '' }}>Personal Website</option>
                                <option value="other" {{ old('platform', $social->platform) == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('platform')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Icon -->
                        <div>
                            <label for="icon" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-icons mr-2 text-gray-400"></i>Icon Class
                            </label>
                            <input type="text" 
                                   name="icon" 
                                   id="icon" 
                                   value="{{ old('icon', $social->icon) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition duration-200"
                                   placeholder="e.g., fab fa-facebook, fas fa-globe">
                            <p class="mt-1 text-xs text-gray-500">FontAwesome icon class (auto-filled for common platforms)</p>
                            @error('icon')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Username and URL -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Username -->
                        <div>
                            <label for="username" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-at mr-2 text-gray-400"></i>Username/Handle
                            </label>
                            <input type="text" 
                                   name="username" 
                                   id="username" 
                                   value="{{ old('username', $social->username) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition duration-200"
                                   placeholder="e.g., johndoe, @johndoe">
                            <p class="mt-1 text-xs text-gray-500">Your username on this platform (optional)</p>
                            @error('username')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- URL -->
                        <div>
                            <label for="url" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-link mr-2 text-gray-400"></i>Profile URL *
                            </label>
                            <input type="url" 
                                   name="url" 
                                   id="url" 
                                   value="{{ old('url', $social->url) }}"
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition duration-200"
                                   placeholder="https://facebook.com/johndoe">
                            @error('url')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Settings -->
            <div class="bg-white overflow-hidden shadow-xl rounded-2xl border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-blue-50 to-purple-50">
                    <h3 class="text-lg font-bold text-gray-900">
                        <i class="fas fa-cog mr-2 text-blue-600"></i>Display Settings
                    </h3>
                    <p class="text-sm text-gray-600">Control how this social link appears</p>
                </div>
                <div class="p-6 space-y-6">
                    <!-- Visibility -->
                    <div class="flex items-center">
                        <input type="checkbox" 
                               name="is_visible" 
                               id="is_visible" 
                               value="1"
                               {{ old('is_visible', $social->is_visible) ? 'checked' : '' }}
                               class="h-4 w-4 text-pink-600 focus:ring-pink-500 border-gray-300 rounded">
                        <label for="is_visible" class="ml-2 block text-sm text-gray-700">
                            <i class="fas fa-eye mr-1 text-green-500"></i>
                            Show this social link in your portfolio
                        </label>
                    </div>

                    <!-- Sort Order -->
                    <div>
                        <label for="sort_order" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-sort-numeric-down mr-2 text-gray-400"></i>Display Order
                        </label>
                        <input type="number" 
                               name="sort_order" 
                               id="sort_order" 
                               value="{{ old('sort_order', $social->sort_order) }}"
                               min="0"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition duration-200"
                               placeholder="0">
                        <p class="mt-1 text-xs text-gray-500">Lower numbers appear first. Leave as 0 for automatic ordering.</p>
                        @error('sort_order')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex justify-between">
                <div class="flex space-x-4">
                    <a href="{{ route('socials.index') }}"
                       class="inline-flex items-center px-6 py-3 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2 transition duration-200">
                        Cancel
                    </a>
                    <button type="submit"
                            class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-pink-600 to-purple-600 border border-transparent rounded-lg font-semibold text-sm text-white hover:from-pink-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2 transition duration-200 shadow-lg transform hover:-translate-y-0.5">
                        <i class="fas fa-save mr-2"></i>Update Social Link
                    </button>
                </div>
            </div>
        </form>

        <!-- Delete Form (Separate from Update Form) -->
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
            <div class="bg-red-50 border border-red-200 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-red-800 mb-2">
                    <i class="fas fa-exclamation-triangle mr-2"></i>Danger Zone
                </h3>
                <p class="text-sm text-red-600 mb-4">
                    Once you delete this social link, it will be permanently removed from your portfolio.
                </p>
                <form action="{{ route('socials.destroy', $social) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            onclick="return confirm('Are you sure you want to delete this social link? This action cannot be undone.')"
                            class="inline-flex items-center px-6 py-3 bg-red-600 border border-transparent rounded-lg font-semibold text-sm text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition duration-200">
                        <i class="fas fa-trash mr-2"></i>Delete Social Link
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function updatePlatformDefaults() {
            const platform = document.getElementById('platform').value;
            const iconInput = document.getElementById('icon');
            
            const platformDefaults = {
                'facebook': 'fab fa-facebook',
                'twitter': 'fab fa-twitter',
                'instagram': 'fab fa-instagram',
                'linkedin': 'fab fa-linkedin',
                'github': 'fab fa-github',
                'youtube': 'fab fa-youtube',
                'tiktok': 'fab fa-tiktok',
                'discord': 'fab fa-discord',
                'telegram': 'fab fa-telegram',
                'whatsapp': 'fab fa-whatsapp',
                'dribbble': 'fab fa-dribbble',
                'behance': 'fab fa-behance',
                'medium': 'fab fa-medium',
                'dev': 'fab fa-dev',
                'stackoverflow': 'fab fa-stack-overflow',
                'codepen': 'fab fa-codepen',
                'website': 'fas fa-globe',
                'other': 'fas fa-link'
            };
            
            // Only update if the current value matches a default (to avoid overwriting custom icons)
            const currentValue = iconInput.value;
            const isDefaultIcon = Object.values(platformDefaults).includes(currentValue) || currentValue === '';
            
            if (platformDefaults[platform] && isDefaultIcon) {
                iconInput.value = platformDefaults[platform];
            }
        }
    </script>
</x-app-layout>
