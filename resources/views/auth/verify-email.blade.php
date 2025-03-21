@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center py-16 relative">
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-blue-100"></div>
        <div class="absolute inset-0 opacity-20" style="background-image: url('data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'152\' height=\'152\' viewBox=\'0 0 152 152\'%3E%3Cg fill-rule=\'evenodd\'%3E%3Cg id=\'temple\' fill=\'%23003366\' fill-opacity=\'0.4\'%3E%3Cpath d=\'M152 150v2H0v-2h28v-8H8v-20H0v-2h8V80h42v20h20v42H30v8h90v-8H80v-42h20V80h42v40h8V30h-8v40h-42V50H80V8h40V0h2v8h20v20h8V0h2v150zm-2 0v-28h-8v20h-20v8h28zM82 30v18h18V30H82zm20 18h20v20h18V30h-20V10H82v18h20v20zm0 2v18h18V50h-18zm20-22h18V10h-18v18zm-54 92v-18H50v18h18zm-20-18H28V82H10v38h20v20h38v-18H48v-20zm0-2V82H30v18h18zm-20 22H10v18h18v-18zm54 0v18h38v-20h20V82h-18v20h-20v20H82zm18-20H82v18h18v-18zm2-2h18V82h-18v18zm20 40v-18h18v18h-18zM30 0h-2v8H8v20H0v2h8v40h42V50h20V8H30V0zm20 48h18V30H50v18zm18-20H48v20H28v20H10V30h20V10h38v18zM30 50h18v18H30V50zm-2-40H10v18h18V10z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E'); background-size: 152px 152px;"></div>
    </div>

    <div class="container mx-auto px-4 py-12 relative z-10">
        <div class="max-w-4xl mx-auto">
            <div class="flex flex-col md:flex-row items-center justify-between gap-8">
                <div class="w-full md:w-1/2 text-center md:text-left">
                    <!-- Status Badge -->
                    <div class="inline-flex items-center bg-white text-blue-800 px-4 py-2 rounded-full mb-6">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <span class="font-semibold">Email Verification Required</span>
                    </div>

                    <h2 class="text-4xl font-bold uppercase text-blue-900 mb-4">Verify Your Email</h2>

                    @if (session('message'))
                        <div class="mb-6 p-4 rounded-md bg-green-50 border border-green-200 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="text-green-600">{{ session('message') }}</p>
                        </div>
                    @endif

                    <!-- Steps Container -->
                    <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-100 mb-8">
                        <div class="text-gray-600">
                            <div class="flex items-center mb-4">
                                <div class="bg-blue-900 text-white rounded-full w-8 h-8 flex items-center justify-center mr-3">1</div>
                                <p>Check your email inbox for the verification link</p>
                            </div>
                            <div class="flex items-center">
                                <div class="bg-blue-900 text-white rounded-full w-8 h-8 flex items-center justify-center mr-3">2</div>
                                <p>Click the verification link to activate your account</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-6 mb-8 border border-gray-200">
                        <h3 class="font-semibold text-gray-800 mb-2">Haven't received the verification email?</h3>
                        <p class="text-gray-600 mb-4">No problem! Click below to send it again.</p>
                        <form action="{{ route('verification.send') }}" method="POST">
                            @csrf
                            <button type="submit" class="text-white bg-blue-900 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-200 font-medium rounded-lg text-md px-6 py-3 uppercase w-full md:w-auto flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                                Resend Verification Email
                            </button>
                        </form>

                        <x-button class="mt-20 ml-1 mb-1 bg-red-600 hover:bg-red-500" onclick="window.location.href='{{ route('dashboard') }}'">
                            <- Go back
                        </x-button>
                    </div>

                    <div class="flex items-center text-sm text-gray-500 bg-blue-50 p-4 rounded-lg">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p>Can't find the email? Remember to check your spam or junk folder.</p>
                    </div>
                </div>

                <div class="w-full md:w-1/2 flex items-center justify-center">
                    <img src="{{ asset('images/OTC-UpdatedBannerLogo2.png') }}" alt="OTC Logo" class="w-full max-w-lg h-auto">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
