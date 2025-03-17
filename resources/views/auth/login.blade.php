@extends('layouts.app')

@section('content')
<div class="bg-gray-100 min-h-screen flex items-center justify-center py-16 relative">
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-blue-100"></div>
        <div class="absolute inset-0 opacity-20" style="background-image: url('data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'152\' height=\'152\' viewBox=\'0 0 152 152\'%3E%3Cg fill-rule=\'evenodd\'%3E%3Cg id=\'temple\' fill=\'%23003366\' fill-opacity=\'0.4\'%3E%3Cpath d=\'M152 150v2H0v-2h28v-8H8v-20H0v-2h8V80h42v20h20v42H30v8h90v-8H80v-42h20V80h42v40h8V30h-8v40h-42V50H80V8h40V0h2v8h20v20h8V0h2v150zm-2 0v-28h-8v20h-20v8h28zM82 30v18h18V30H82zm20 18h20v20h18V30h-20V10H82v18h20v20zm0 2v18h18V50h-18zm20-22h18V10h-18v18zm-54 92v-18H50v18h18zm-20-18H28V82H10v38h20v20h38v-18H48v-20zm0-2V82H30v18h18zm-20 22H10v18h18v-18zm54 0v18h38v-20h20V82h-18v20h-20v20H82zm18-20H82v18h18v-18zm2-2h18V82h-18v18zm20 40v-18h18v18h-18zM30 0h-2v8H8v20H0v2h8v40h42V50h20V8H30V0zm20 48h18V30H50v18zm18-20H48v20H28v20H10V30h20V10h38v18zM30 50h18v18H30V50zm-2-40H10v18h18V10z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E'); background-size: 152px 152px;"></div>
    </div>

    <div class="absolute top-9 text-center w-full">
        <h1 class="text-2xl font-bold text-blue-900">Management Information System</h1>
        <h2 class="text-lg text-blue-900">Office of Transportation Cooperative</h2>
    </div>

    <div class="relative w-[28rem] mt-20"> <!-- Added margin-top here -->
        <div class="absolute -top-12 left-1/2 transform -translate-x-1/2 w-28 h-28 bg-white rounded-full shadow-lg flex items-center justify-center border-2 border-blue-900">
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
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required class="w-full p-3 border rounded-lg focus:ring focus:ring-blue-300">
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input type="password" name="password" id="password" autocomplete="password" placeholder="************" required class="w-full p-3 border rounded-lg focus:ring focus:ring-blue-300">
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full bg-blue-900 text-white py-3 rounded-lg hover:bg-blue-800 transition">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
