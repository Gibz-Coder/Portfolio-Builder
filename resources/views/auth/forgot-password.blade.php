<x-guest-layout>
    <!-- Header -->
    <div class="text-center mb-8">
        <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-key text-white text-2xl"></i>
        </div>
        <h2 class="text-3xl font-bold text-gray-900 mb-2">Reset Password</h2>
        <p class="text-gray-600">Enter your email to receive a password reset link</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf

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
                   autofocus
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 bg-gray-50 focus:bg-white"
                   placeholder="Enter your email address">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Submit Button -->
        <button type="submit"
                class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold py-3 px-4 rounded-lg hover:from-blue-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-200 shadow-lg transform hover:-translate-y-0.5">
            <i class="fas fa-paper-plane mr-2"></i>Send Reset Link
        </button>

        <!-- Info Box -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
            <div class="flex items-start">
                <i class="fas fa-info-circle text-blue-500 mt-0.5 mr-3"></i>
                <div class="text-sm text-blue-700">
                    <p class="font-medium mb-1">What happens next?</p>
                    <p>We'll send a secure password reset link to your email address. Click the link to create a new password for your account.</p>
                </div>
            </div>
        </div>

        <!-- Back to Login -->
        <div class="text-center">
            <a href="{{ route('login') }}"
               class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900 font-medium transition duration-200">
                <i class="fas fa-arrow-left mr-2"></i>Back to Sign In
            </a>
        </div>
    </form>
</x-guest-layout>
