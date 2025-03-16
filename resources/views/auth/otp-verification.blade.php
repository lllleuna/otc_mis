@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0 bg-gray-100">
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <div class="mb-4 text-center">
            <h2 class="text-2xl font-bold text-gray-700">Verify OTP</h2>
            <p class="mt-1 text-sm text-gray-500">Please enter the OTP sent to your mobile phone</p>
        </div>

        @if (session('status'))
            <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span>{{ session('status') }}</span>
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded relative">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('otp.verification') }}">
            @csrf
            <div class="mb-4">
                <label for="otp" class="block text-sm font-medium text-gray-700 mb-3">OTP Code</label>
                <div class="mt-1 flex items-center justify-between gap-2">
                    <input id="otp" type="text" name="otp" required autofocus maxlength="6"
                        class="shadow-sm block w-full p-3 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md"
                        placeholder="Enter 6-digit code">
                </div>
            </div>

            <div class="flex items-center justify-between mt-6">
                <button type="submit" class="w-full bg-blue-900 text-white py-3 rounded-lg hover:bg-blue-800 transition">
                    Verify & Proceed
                </button>
            </div>
        </form>

        <div class="mt-6 pt-6 border-t border-gray-200">
            <div class="flex flex-col items-center">
                <span class="text-sm text-gray-600">Didn't receive the code?</span>
                <form method="POST" action="{{ route('otp.resend') }}" class="mt-2 w-full">
                    @csrf
                    <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium rounded-md transition duration-150 ease-in-out">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        Resend OTP
                    </button>
                </form>
            </div>
            <div class="mt-4 text-center">
                <p class="text-xs text-gray-500">
                    Valid for 5 minutes. Please check your mobile phone.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection