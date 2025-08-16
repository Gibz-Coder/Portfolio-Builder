<x-guest-layout>
    <!-- Header -->
    <div class="text-center mb-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-2">Create Account</h2>
        <p class="text-gray-600">Join Portfolio Builder and showcase your work</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-user mr-2 text-gray-400"></i>Full Name
            </label>
            <input id="name"
                   type="text"
                   name="name"
                   value="{{ old('name') }}"
                   required
                   autofocus
                   autocomplete="name"
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 bg-gray-50 focus:bg-white"
                   placeholder="Enter your full name">
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-envelope mr-2 text-gray-400"></i>Email Address
            </label>
            <input id="email"
                   type="email"
                   name="email"
                   value="{{ old('email') }}"
                   required
                   autocomplete="username"
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 bg-gray-50 focus:bg-white"
                   placeholder="Enter your email address">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-lock mr-2 text-gray-400"></i>Password
            </label>
            <div class="relative">
                <input id="password"
                       type="password"
                       name="password"
                       required
                       autocomplete="new-password"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 bg-gray-50 focus:bg-white pr-12"
                       placeholder="Create a strong password">
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
                <i class="fas fa-lock mr-2 text-gray-400"></i>Confirm Password
            </label>
            <div class="relative">
                <input id="password_confirmation"
                       type="password"
                       name="password_confirmation"
                       required
                       autocomplete="new-password"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 bg-gray-50 focus:bg-white pr-12"
                       placeholder="Confirm your password">
                <button type="button"
                        onclick="togglePassword('password_confirmation', 'password-confirmation-icon')"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                    <i id="password-confirmation-icon" class="fas fa-eye"></i>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Terms and Privacy -->
        <div class="flex items-start">
            <input id="terms"
                   type="checkbox"
                   required
                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded mt-1">
            <label for="terms" class="ml-2 text-sm text-gray-600">
                I agree to the
                <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">Terms of Service</a>
                and
                <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">Privacy Policy</a>
            </label>
        </div>

        <!-- Submit Button -->
        <button type="submit"
                class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold py-3 px-4 rounded-lg hover:from-blue-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-200 shadow-lg transform hover:-translate-y-0.5">
            <i class="fas fa-user-plus mr-2"></i>Create Account
        </button>

        <!-- Divider -->
        <div class="relative my-6">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-300"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-2 bg-white text-gray-500">Already have an account?</span>
            </div>
        </div>

        <!-- Login Link -->
        <div class="text-center">
            <a href="{{ route('login') }}"
               class="inline-flex items-center px-6 py-3 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-200">
                <i class="fas fa-sign-in-alt mr-2"></i>Sign In Instead
            </a>
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
