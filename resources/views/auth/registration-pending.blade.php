<x-guest-layout>
    <!-- Header -->
    <div class="text-center mb-8">
        <div class="mx-auto w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mb-4">
            <i class="fas fa-clock text-yellow-600 text-2xl"></i>
        </div>
        <h2 class="text-3xl font-bold text-gray-900 mb-2">Registration Pending</h2>
        <p class="text-gray-600">Your account has been created successfully!</p>
    </div>

    <!-- Status Message -->
    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 mb-8">
        <div class="flex items-start">
            <div class="flex-shrink-0">
                <i class="fas fa-exclamation-triangle text-yellow-400 text-xl"></i>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-yellow-800">
                    Account Pending Admin Approval
                </h3>
                <div class="mt-2 text-sm text-yellow-700">
                    <p>Your account is currently waiting for approval from a Portfolio Builder administrator. You will be able to log in and access your dashboard once your account has been approved.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Next Steps -->
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-8">
        <h3 class="text-lg font-semibold text-blue-900 mb-3">
            <i class="fas fa-info-circle mr-2"></i>What happens next?
        </h3>
        <ul class="space-y-2 text-sm text-blue-800">
            <li class="flex items-center">
                <i class="fas fa-check-circle text-blue-500 mr-2"></i>
                An administrator will review your registration
            </li>
            <li class="flex items-center">
                <i class="fas fa-check-circle text-blue-500 mr-2"></i>
                You'll be notified once your account is approved
            </li>
            <li class="flex items-center">
                <i class="fas fa-check-circle text-blue-500 mr-2"></i>
                You can then log in and start building your portfolio
            </li>
        </ul>
    </div>

    <!-- Success Message -->
    @if(session('message'))
    <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
        <div class="flex items-center">
            <i class="fas fa-check-circle text-green-500 mr-2"></i>
            <span class="text-green-800">{{ session('message') }}</span>
        </div>
    </div>
    @endif

    <!-- Actions -->
    <div class="space-y-4">
        <!-- Back to Login -->
        <div class="text-center">
            <a href="{{ route('login') }}"
               class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-lg hover:from-blue-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-200 shadow-lg transform hover:-translate-y-0.5">
                <i class="fas fa-sign-in-alt mr-2"></i>Back to Login
            </a>
        </div>

        <!-- Divider -->
        <div class="relative my-6">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-300"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-2 bg-white text-gray-500">or</span>
            </div>
        </div>

        <!-- Back to Home -->
        <div class="text-center">
            <a href="{{ route('landing') }}"
               class="inline-flex items-center px-6 py-3 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-200">
                <i class="fas fa-home mr-2"></i>Back to Home
            </a>
        </div>
    </div>
</x-guest-layout>
