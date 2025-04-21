{{--
---------- Page header ----------
contains logo, profile name & icon, and navigation links
---------------------------------
--}}

<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/dropdown.js'])
    {{ $vite }}
    <title>{{ $title }}</title>
</head>

<body class="h-full">

    <div class="min-h-full">
        <nav class="bg-blue-900">
            <div class="">
                <div class="flex h-16 items-center justify-between">
                    <div class="flex items-center">
                        <img class="h-14" src="{{ asset('images/OTC-UpdatedBannerLogo2.png') }}" alt="OTC Logo">
                        <div class="ml-3 flex flex-col mr-3">
                            <span class="text-white font-semibold text-lg">Office of Transportation Cooperatives</span>
                            <p class="text-white italic text-sm">Management Information System</p>
                        </div>

                        @if (auth()->user()->role === 'Admin')
                            <div class="flex items-center space-x-2">
                                <span
                                    class="text-sm font-medium bg-blue-600 text-white px-2 py-1 rounded-md uppercase">Head
                                    Portal</span>
                            </div>
                        @elseif(auth()->user()->role === 'Officer 1' || auth()->user()->role === 'Officer 2')
                            <div class="flex items-center space-x-2">
                                <span
                                    class="text-sm font-medium bg-green-600 text-white px-2 py-1 rounded-md uppercase">Officer
                                    Portal</span>
                            </div>
                        @endif
                    </div>
                    <div class="block">
                        <div class="mr-6 flex items-center">
                            <div class="relative font-[sans-serif] w-max mx-auto">
                                <button type="button" id="dropdownToggle">
                                    <div class="flex items-center">
                                        <h5 class="mx-2 text-gray-200">{{ Auth::user()->firstname }}</h5>
                                        <img class="h-10" src="{{ asset('images/icons8-male-user-50.png') }}"
                                            alt="profile">
                                    </div>
                                </button>

                                <ul id="dropdownMenu"
                                    class='absolute hidden shadow-lg bg-white py-2 z-[1000] min-w-full w-max rounded-lg max-h-96'>
                                    <li
                                        class='py-2.5 px-5 flex items-center hover:bg-gray-100 text-[#333] text-sm cursor-pointer'>
                                        <a href="/user/profile" class="w-full h-full">View profile</a>
                                    </li>
                                    <li
                                        class='py-2.5 px-5 flex items-center hover:bg-gray-100 text-[#333] text-sm cursor-pointer'>
                                        <form method="POST" action="/logout" class="w-full">
                                            @csrf
                                            <button type="submit" class="w-full text-start">Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </nav>

        <header class="bg-white shadow">
            <div class="m-auto w-fit items-center px-3 py-2">

                @can('admin-access')
                    <x-nav-link href="/dashboard" :active="request()->is('dashboard')">Dashboard</x-nav-link>
                    <x-nav-link href="/users" :active="request()->is('users*')">Employee User Management</x-nav-link>
                @endcan
                {{-- <x-nav-link href="/tc" :active="request()->is('tc*')">Record Management</x-nav-link> --}}
                <x-nav-link href="{{ route('general-info.index') }}" :active="request()->is('general-info*')">Client Details</x-nav-link>
                @can('officer1-access')
                    <x-nav-link href="{{ route('accreditation.evaluate.index') }}" :active="request()->is('application/evaluate*')"> Accreditation & CGS
                        Evaluation </x-nav-link>
                    <x-nav-link href="{{ route('training.index') }}" :active="request()->is('officer/training-requests*')"> Training Management </x-nav-link>
                @endcan
                @can('admin-access')
                    <x-nav-link href="{{ route('accreditation.approval.index') }}" :active="request()->is('application/approval*')"> Accreditation & CGS
                        Approval </x-nav-link>
                @endcan
                <x-nav-link href="{{ route('report.index') }}" :active="request()->is('reports*')">Report Generation</x-nav-link>

            </div>
        </header>
        <main>
            <div class="mx-3 py-2 ">
                {{-- Page Content --}}
                {{ $slot }}
            </div>
        </main>
    </div>

</body>

</html>
