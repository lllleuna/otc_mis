@extends('layouts.app')

@section('title', 'OTC Management Information System')

@section('content')
    <!-- Main Layout -->
    <div class="min-h-screen relative">
        <!-- Background Split -->
        <div class="absolute inset-0 z-0">
            <div class="h-full w-1/4 bg-deep-blue absolute left-0"></div>
            <div class="h-full w-3/4 bg-white absolute right-0"></div>
        </div>

        <!-- Vehicle Icons for the Blue Side -->
        <div class="absolute left-0 top-0 h-full w-1/4 overflow-hidden">
            <!-- Bus -->
            <i class="fas fa-bus vehicle-icon text-6xl absolute top-[15%] left-[20%] animate-float-slow"></i>

            <!-- Jeepney/Minibus -->
            <i class="fas fa-shuttle-van vehicle-icon text-5xl absolute top-[35%] left-[60%] animate-float"></i>

            <!-- Car -->
            <i class="fas fa-car vehicle-icon text-5xl absolute top-[55%] left-[30%] animate-float-fast"></i>

            <!-- Taxi -->
            <i class="fas fa-taxi vehicle-icon text-4xl absolute top-[75%] left-[50%] animate-float-slow delay-3"></i>

            <!-- Truck -->
            <i class="fas fa-truck vehicle-icon text-6xl absolute top-[85%] left-[15%] animate-float delay-2"></i>
        </div>

        <!-- Content Container -->
        <div class="relative z-10 min-h-screen flex flex-col md:flex-row">
            <!-- Logo Container - Positioned to Overlap -->
            <div class="absolute left-1/4 top-1/2 transform -translate-x-1/2 -translate-y-1/2">
                <div class="logo-container">
                    <img src="{{ asset('images/OTC-UpdatedBannerLogo2.png') }}" alt="OTC Logo" class="w-[380px] h-auto animate-fade-up">
                </div>
            </div>

            <!-- Left Panel - Empty Space for Logo (smaller) -->
            <div class="md:w-1/4 p-8 md:p-12 min-h-[50vh] md:min-h-screen">
                <!-- Intentionally left empty except for the vehicle icons -->
            </div>

            <!-- Right Panel - Content (larger) -->
            <div class="md:w-3/4 p-8 md:p-16 flex flex-col justify-center min-h-[50vh] md:min-h-screen">
                <!-- Top Section with Header -->
                <div class="ml-24 md:ml-48 mb-8 animate-fade-up delay-1">
                    <h1 class="text-3xl md:text-4xl font-bold text-otc-blue mb-2">Management Information System</h1>
                    <p class="text-gray-600 text-lg">Office of Transportation Cooperatives</p>
                    <div class="h-1 w-20 bg-otc-blue mt-4"></div>
                </div>

                <!-- System Description -->
                <div class="ml-24 md:ml-48 mb-10 animate-fade-up delay-2">
                    <p class="text-gray-700 mb-6 text-lg">
                        Internal system for managing transportation cooperative processes, accreditation, and regulatory compliance.
                    </p>

                    <div class="bg-blue-50 border-l-4 border-otc-blue p-4 rounded-r-md mb-8">
                        <p class="text-gray-700">
                            <i class="fas fa-question-circle text-otc-blue mr-1"></i>
                            <span class="font-semibold">Are you an OTC employee?</span>
                            <div class="text-center mt-1">
                                This system is for authorized OTC personnel only. You cannot access the system without valid credentials.
                            </div>
                        </p>
                    </div>
                </div>

                <!-- Access Button -->
                <div class="ml-24 md:ml-48 animate-fade-up delay-3">
                    <a href="{{ route('login') }}" class="inline-block bg-otc-blue hover:bg-blue-800 text-white py-3 px-8 rounded-md font-medium text-base transition duration-300 shadow-md">
                        ACCESS SYSTEM
                    </a>
                </div>

                <!-- Footer -->
                <div class="ml-24 md:ml-48 mt-16 animate-fade-up delay-3">
                    <div class="flex justify-between items-center text-sm text-gray-500">
                        <span>© {{ date('Y') }} Office of Transportation Cooperatives</span>
                        <a href="mailto:support@otc.gov.ph" class="text-otc-blue">support@otc.gov.ph</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
