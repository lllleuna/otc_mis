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
                        <img class="h-14" src="{{ asset('images/OTC-UpdatedBannerLogo3.png') }}" alt="OTC Logo">
                    </div>
                    <div class="block">
                        <div class="mr-6 flex items-center">
                            <img class="h-6 mx-3" src="{{ asset('images/icons8-notification-96.png') }}" alt="notif">

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
                                        View profile
                                    </li>
                                    <li
                                        class='py-2.5 px-5 flex items-center hover:bg-gray-100 text-[#333] text-sm cursor-pointer'>
                                        Settings
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

                <x-nav-link href="/dashboard" :active="request()->is('dashboard')">Dashboard</x-nav-link>
                @can('admin-access')
                    <x-nav-link href="/users" :active="request()->is('users*')">User Management</x-nav-link>
                @endcan
                <x-nav-link href="/tc" :active="request()->is('tc*')">Transport Cooperatives</x-nav-link>
                <x-nav-link href="{{ route('accreditation.evaluate.index') }}" :active="request()->is('application/evaluate*')" > Evaluation </x-nav-link>
                <x-nav-link href="{{ route('accreditation.approval.index') }}" :active="request()->is('application/approval*')" > Approval </x-nav-link>
                
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