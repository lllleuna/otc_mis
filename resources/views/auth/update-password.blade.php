@extends('layouts.app')

@section('content')
    <div class="bg-gray-100 min-h-screen flex items-center justify-center py-16">
        <div class="relative w-[28rem]">

            <div
                class="absolute -top-12 left-1/2 transform -translate-x-1/2 w-28 h-28 bg-white rounded-full shadow-lg flex items-center justify-center border-2 border-blue-900">
                <img class="w-full h-auto" src="{{ asset('images/OTC-UpdatedBannerLogo2.png') }}" alt="Logo">
            </div>

            <div class="bg-white rounded-lg shadow-xl overflow-hidden">
                <div class="bg-blue-900 px-8 pt-16 pb-8 text-center rounded-t-lg">
                    <h1 class="text-3xl font-bold text-white mt-4">Welcome!</h1>
                    <p class="text-sm text-blue-100 max-w-sm mx-auto mt-2">
                        Your password is temporary and must be updated to gain access to the system.
                    </p>
                </div>

                <div class="px-8 pb-8 pt-6">
                    <form method="POST" action="/auth/update-password">
                        @csrf

                        <div class="mb-4">
                            <label for="new_password" class="block text-sm font-medium text-gray-700 mb-2">New
                                Password</label>
                            <input type="password" name="password" id="password" placeholder="************" required
                                class="w-full p-3 border rounded-lg focus:ring focus:ring-blue-300">
                            @error('password')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="confirm_password" class="block text-sm font-medium text-gray-700 mb-2">Confirm
                                Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="************"
                                required class="w-full p-3 border rounded-lg focus:ring focus:ring-blue-300">
                            @error('password_confirmation')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="pt-4">
                            <button type="submit"
                                class="w-full bg-blue-900 text-white py-3 rounded-lg hover:bg-blue-800 transition">
                                Save New Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection