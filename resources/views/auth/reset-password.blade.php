<x-guest-layout>
    <!-- Header -->
    <div class="text-center mb-8">
        <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-shield-alt text-white text-2xl"></i>
        </div>
        <h2 class="text-3xl font-bold text-gray-900 mb-2">Set New Password</h2>
        <p class="text-gray-600">Create a strong password for your account</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-6">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-envelope mr-2 text-gray-400"></i>Email Address
            </label>
            <input id="email"
                   type="email"
                   name="email"
                   value="{{ old('email', $request->email) }}"
                   required
                   autofocus
                   autocomplete="username"
                   readonly
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-100 text-gray-600 cursor-not-allowed">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-lock mr-2 text-gray-400"></i>New Password
            </label>
            <div class="relative">
                <input id="password"
                       type="password"
                       name="password"
                       required
                       autocomplete="new-password"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 bg-gray-50 focus:bg-white pr-12"
                       placeholder="Enter your new password">
                <button type="button"
                        onclick="togglePassword('password', 'password-icon')"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                    <i id="password-icon" class="fas fa-eye"></i>
                </button>
            </div>
            <div class="mt-2 text-xs text-gray-500">
                <i class="fas fa-info-circle mr-1"></i>
                Password must be at least 8 characters long
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-lock mr-2 text-gray-400"></i>Confirm New Password
            </label>
            <div class="relative">
                <input id="password_confirmation"
                       type="password"
                       name="password_confirmation"
                       required
                       autocomplete="new-password"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 bg-gray-50 focus:bg-white pr-12"
                       placeholder="Confirm your new password">
                <button type="button"
                        onclick="togglePassword('password_confirmation', 'password-confirmation-icon')"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                    <i id="password-confirmation-icon" class="fas fa-eye"></i>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Submit Button -->
        <button type="submit"
                class="w-full bg-gradient-to-r from-green-600 to-blue-600 text-white font-semibold py-3 px-4 rounded-lg hover:from-green-700 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition duration-200 shadow-lg transform hover:-translate-y-0.5">
            <i class="fas fa-check mr-2"></i>Update Password
        </button>

        <!-- Security Notice -->
        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
            <div class="flex items-start">
                <i class="fas fa-shield-alt text-green-500 mt-0.5 mr-3"></i>
                <div class="text-sm text-green-700">
                    <p class="font-medium mb-1">Security Notice</p>
                    <p>After updating your password, you'll be automatically signed in to your account. Make sure to use a strong, unique password.</p>
                </div>
            </div>
        </div>
    </form>

    <script>
        function togglePassword(inputId, iconId) {
            const passwordInput = document.getElementById(inputId);
            const passwordIcon = document.getElementById(iconId);

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.classList.remove('fa-eye');
                passwordIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                passwordIcon.classList.remove('fa-eye-slash');
                passwordIcon.classList.add('fa-eye');
            }
        }
    </script>
</x-guest-layout>
