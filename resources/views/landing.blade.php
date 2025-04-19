<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'OTC Management Information System')</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            overflow-x: hidden;
        }

        .bg-otc-blue {
            background-color: #041e42;
        }

        .text-otc-blue {
            color: #041e42;
        }

        .border-otc-blue {
            border-color: #041e42;
        }

        .bg-deep-blue {
            background-color: #041e42;
        }

        /* Logo Styles */
        .logo-container {
            position: relative;
            z-index: 20;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            width: 280px;
            height: 280px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        @media (min-width: 768px) {
            .logo-container {
                width: 360px;
                height: 360px;
            }
        }

        @media (min-width: 1024px) {
            .logo-container {
                width: 420px;
                height: 420px;
            }
        }

        .logo-shadow {
            filter: drop-shadow(0px 10px 25px rgba(0, 0, 0, 0.25));
        }

        /* Vehicle icons */
        .vehicle-icon {
            position: absolute;
            color: rgba(255, 255, 255, 0.15);
            z-index: 1;
        }

        /* Page switcher container positioning */
        .page-switcher-container {
            position: absolute;
            right: 40px;
            top: 0;
            bottom: 0;
            z-index: 30;
            display: flex;
            align-items: center;
            pointer-events: none;
        }
        .page-switcher-container > * {
            pointer-events: auto;
        }

        /* Subtle animations for content */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .animate-fade-up {
            animation: fadeUp 0.8s ease forwards;
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        .animate-float-slow {
            animation: float 8s ease-in-out infinite;
        }

        .animate-float-fast {
            animation: float 4s ease-in-out infinite;
        }

        .delay-1 {
            animation-delay: 0.1s;
        }

        .delay-2 {
            animation-delay: 0.3s;
        }

        .delay-3 {
            animation-delay: 0.5s;
        }

        .delay-4 {
            animation-delay: 0.7s;
        }

        .delay-5 {
            animation-delay: 0.9s;
        }

        /* Mobile layout adjustments */
        @media (max-width: 767px) {
            .mobile-layout {
                flex-direction: column;
            }

            .mobile-blue-section {
                width: 100%;
                height: 30vh;
                min-height: 240px;
                position: relative;
            }

            .mobile-white-section {
                width: 100%;
                padding-top: 160px;
                position: relative;
            }

            .mobile-logo-position {
                position: absolute;
                left: 50%;
                top: 100%;
                transform: translate(-50%, -50%);
            }

            .mobile-content-margin {
                margin-left: 0;
                text-align: center;
            }

            .mobile-footer {
                flex-direction: column;
                gap: 16px;
                align-items: center;
            }

            .mobile-divider {
                margin: 0 auto;
            }
        }
    </style>
    @yield('additional_styles')
</head>

<body class="min-h-screen bg-gray-50">

    <!-- Main Layout -->
    <div class="min-h-screen relative">
        <!-- Background Split - Responsive -->
        <div class="absolute inset-0 z-0 hidden md:block">
            <div class="h-full w-1/4 bg-deep-blue absolute left-0"></div>
            <div class="h-full w-3/4 bg-white absolute right-0"></div>
        </div>

        <!-- Mobile Background Split -->
        <div class="absolute inset-0 z-0 block md:hidden">
            <div class="h-1/3 w-full bg-deep-blue absolute top-0"></div>
            <div class="h-2/3 w-full bg-white absolute bottom-0"></div>
        </div>

        <!-- Vehicle Icons for the Blue Side -->
        <div class="absolute left-0 top-0 h-1/3 md:h-full w-full md:w-1/4 overflow-hidden">
            <!-- Bus -->
            <i class="fas fa-bus vehicle-icon text-4xl md:text-6xl absolute top-[15%] left-[20%] animate-float-slow"></i>

            <!-- Jeepney/Minibus -->
            <i class="fas fa-shuttle-van vehicle-icon text-3xl md:text-5xl absolute top-[35%] left-[60%] animate-float"></i>

            <!-- Car -->
            <i class="fas fa-car vehicle-icon text-3xl md:text-5xl absolute top-[55%] left-[30%] animate-float-fast"></i>

            <!-- Taxi - Hidden on smallest screens -->
            <i class="fas fa-taxi vehicle-icon text-2xl md:text-4xl absolute top-[75%] left-[50%] animate-float-slow delay-3 hidden sm:block"></i>

            <!-- Truck - Hidden on smallest screens -->
            <i class="fas fa-truck vehicle-icon text-4xl md:text-6xl absolute top-[85%] left-[15%] animate-float delay-2 hidden sm:block"></i>
        </div>

        <!-- Content Container -->
        <div class="relative z-10 min-h-screen flex flex-col md:flex-row mobile-layout">
            <!-- Left Panel - Empty Space for Logo (smaller) -->
            <div class="md:w-1/4 p-4 md:p-12 min-h-[30vh] md:min-h-screen mobile-blue-section">
                <!-- Logo Container - Positioned to Overlap -->
                <div class="hidden md:block absolute left-1/4 top-1/2 transform -translate-x-1/2 -translate-y-1/2">
                    <div class="logo-container">
                        <img src="{{ asset('images/OTC-UpdatedBannerLogo2.png') }}" alt="OTC Logo"
                            class="w-full max-w-[280px] md:max-w-[380px] h-auto animate-fade-up">
                    </div>
                </div>

                <!-- Mobile Logo Position -->
                <div class="md:hidden absolute left-1/2 top-full transform -translate-x-1/2 -translate-y-1/2 mobile-logo-position">
                    <div class="logo-container" style="width: 200px; height: 200px;">
                        <img src="{{ asset('images/OTC-UpdatedBannerLogo2.png') }}" alt="OTC Logo"
                            class="w-full max-w-[180px] h-auto animate-fade-up">
                    </div>
                </div>
            </div>

            <!-- Right Panel - Content (larger) -->
            <div class="md:w-3/4 p-6 md:p-16 flex flex-col justify-center min-h-[70vh] md:min-h-screen mobile-white-section">
                <!-- Top Section with Header -->
                <div class="md:ml-48 mb-8 mt-10 animate-fade-up delay-1 mobile-content-margin">
                    <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-otc-blue mb-2">Management Information System</h1>
                    <p class="text-gray-600 text-base md:text-lg">Office of Transportation Cooperatives</p>
                    <div class="h-1 w-20 bg-otc-blue mt-4 mobile-divider"></div>
                </div>

                <!-- System Description -->
                <div class="md:ml-48 mb-6 md:mb-10 animate-fade-up delay-2 mobile-content-margin">
                    <p class="text-gray-700 mb-4 md:mb-6 text-base md:text-lg">
                        Internal system for managing transportation cooperative processes, accreditation, and regulatory
                        compliance.
                    </p>

                    <div class="bg-blue-50 border-l-4 border-otc-blue p-4 rounded-r-md mb-6 md:mb-8 text-left">
                        <p class="text-gray-700">
                            <i class="fas fa-question-circle text-otc-blue mr-1"></i>
                            <span class="font-semibold">Are you an OTC employee?</span>
                        <div class="mt-1">
                            This system is for authorized OTC personnel only. You cannot access the system without valid
                            credentials.
                        </div>
                        </p>
                    </div>
                </div>

                <!-- Access Button -->
                <div class="md:ml-48 mb-10 animate-fade-up delay-3 flex justify-start md:justify-center">
                    <a href="{{ route('login') }}"
                        class="inline-block bg-otc-blue hover:bg-blue-800 text-white py-3 px-8 rounded-md font-medium text-base transition duration-300 shadow-md">
                        Employee Login
                    </a>
                </div>

                <!-- Footer -->
                <div class="md:ml-48 mt-10 md:mt-16 animate-fade-up delay-3 mobile-content-margin">
                    <div class="flex justify-between items-center text-sm text-gray-500 mobile-footer">
                        <span>© {{ date('Y') }} Office of Transportation Cooperatives</span>
                        <a href="mailto:support@otc.gov.ph" class="text-otc-blue">support@otc.gov.ph</a>
                    </div>
                </div>

                <!-- Page Switcher - Below footer, aligned right -->
                <div class="ml-30 md:ml-48 mt-20 flex justify-end animate-fade-up delay-4">
                    @include('components.page-switcher')
                </div>
            </div>
        </div>
    </div>

</body>

</html>