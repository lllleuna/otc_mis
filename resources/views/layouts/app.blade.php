{{-- resources/views/layouts/auth.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'OTC Management Information System')</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
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
            width: 420px;
            height: 420px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            overflow: hidden;
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

        .delay-1 { animation-delay: 0.1s; }
        .delay-2 { animation-delay: 0.3s; }
        .delay-3 { animation-delay: 0.5s; }
        .delay-4 { animation-delay: 0.7s; }
        .delay-5 { animation-delay: 0.9s; }
    </style>
    @yield('additional_styles')
</head>

<body class="min-h-screen bg-gray-50">
    @yield('content')
</body>
</html>
