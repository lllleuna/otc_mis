@extends('layouts.app')

@section('content')
    <div class="bg-gray-100 min-h-screen flex flex-col items-center justify-center py-2 relative">
        <!-- Background -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-blue-100"></div>
            <div class="absolute inset-0 opacity-20"
                style="background-image: url('data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'152\' height=\'152\' viewBox=\'0 0 152 152\'%3E%3Cg fill-rule=\'evenodd\'%3E%3Cg id=\'temple\' fill=\'%23003366\' fill-opacity=\'0.4\'%3E%3Cpath d=\'M152 150v2H0v-2h28v-8H8v-20H0v-2h8V80h42v20h20v42H30v8h90v-8H80v-42h20V80h42v40h8V30h-8v40h-42V50H80V8h40V0h2v8h20v20h8V0h2v150zm-2 0v-28h-8v20h-20v8h28zM82 30v18h18V30H82zm20 18h20v20h18V30h-20V10H82v18h20v20zm0 2v18h18V50h-18zm20-22h18V10h-18v18zm-54 92v-18H50v18h18zm-20-18H28V82H10v38h20v20h38v-18H48v-20zm0-2V82H30v18h18zm-20 22H10v18h18v-18zm54 0v18h38v-20h20V82h-18v20h-20v20H82zm18-20H82v18h18v-18zm2-2h18V82h-18v18zm20 40v-18h18v18h-18zM30 0h-2v8H8v20H0v2h8v40h42V50h20V8H30V0zm20 48h18V30H50v18zm18-20H48v20H28v20H10V30h20V10h38v18zM30 50h18v18H30V50zm-2-40H10v18h18V10z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E'); background-size: 152px 152px;">
            </div>
        </div>

        <!-- Title and Login Container -->
        <div class="relative flex flex-col items-center z-10">
            <!-- Title -->
            <div class="text-center mb-5">
                <h1 class="text-2xl font-bold text-blue-900">Management Information System</h1>
                <h2 class="text-lg text-blue-900">Office of Transportation Cooperatives</h2>
            </div>

            <!-- Login Box -->
            <div class="relative w-[28rem] mt-10"> <!-- Added margin-top here -->
                <div
                    class="absolute -top-12 left-1/2 transform -translate-x-1/2 w-28 h-28 bg-white rounded-full shadow-lg flex items-center justify-center border-2 border-blue-900">
                    <img class="w-full h-auto" src="{{ asset('images/OTC-UpdatedBannerLogo2.png') }}" alt="Logo">
                </div>
                <div class="bg-white rounded-lg shadow-xl overflow-hidden">
                    <div class="bg-blue-900 px-8 pt-16 pb-8 text-center rounded-t-lg">
                        <h1 class="text-3xl font-bold text-white mt-4">Login</h1>
                        <p class="text-sm text-blue-100 max-w-sm mx-auto mt-2">
                            Enter your credentials to access the system.
                        </p>
                    </div>

            <div class="px-8 pb-8 pt-6">
                <form action="{{ route('login') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email" placeholder="Enter your email" value="{{ old('email') }}" required class="w-full p-3 border rounded-lg focus:ring focus:ring-blue-300">
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <div class="relative">
                            <input type="password" name="password" id="password" autocomplete="password" placeholder="************" required class="w-full p-3 border rounded-lg focus:ring focus:ring-blue-300">
                            <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" id="eyeOpen" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" id="eyeClosed" class="h-5 w-5 text-gray-500 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="text-center mt-4">
                        <a href="{{ route('reset-password') }}" class="text-blue-900 hover:underline">Forgot Password?</a>
                    </div>
                    <div class="pt-4">
                        <button type="submit" class="w-full bg-blue-900 text-white py-3 rounded-lg hover:bg-blue-800 transition">Login</button>
                    </div>


                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggleButton = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const eyeOpen = document.getElementById('eyeOpen');
    const eyeClosed = document.getElementById('eyeClosed');

    toggleButton.addEventListener('click', function() {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeOpen.classList.add('hidden');
            eyeClosed.classList.remove('hidden');
        } else {
            passwordInput.type = 'password';
            eyeOpen.classList.remove('hidden');
            eyeClosed.classList.add('hidden');
        }
    });
});
</script>

@include('components.page-switcher')
@endsection
