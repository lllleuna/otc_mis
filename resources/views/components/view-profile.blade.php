<x-layout>
    <x-slot:vite></x-slot:vite>
    <x-slot:title>View Profile</x-slot:title>

    <div class="container-fluid px-4 py-6">
        <div class="max-w-8xl mx-auto">

            <div class="flex flex-col lg:flex-row gap-6">
                <!-- Left Sidebar -->
                <div class="w-full lg:w-1/4">
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                        <!-- Profile Image and Basic Info -->
                        <div class="p-6 text-center border-b border-gray-100">
                            <div class="relative inline-block">
                                <img src="{{ asset('images\icons8-male-user-50.png') }}" alt="OTC Logo" class="w-32 h-32 rounded-full object-cover border-4 border-blue-900 shadow mx-auto">
                                <div class="absolute bottom-2 right-2 bg-green-500 w-4 h-4 rounded-full border-2 border-white"></div>
                            </div>
                            <h2 class="mt-4 text-xl font-bold text-gray-800">{{ Auth::user()->firstname}} {{ Auth::user()->lastname}}</h2>
                            <p class="mt-2 text-gray-600">{{ Auth::user()->email}}</p>

                            {{-- <div class="mt-4 flex justify-center">
                                <button class="px-4 py-2 bg-blue-50 text-blue-600 rounded-lg text-sm font-medium hover:bg-blue-100">
                                    Edit Profile
                                </button>
                            </div> --}}
                        </div>

                    </div>
                </div>

                <!-- Main Content Area -->
                <div class="w-full lg:w-3/4">
                    <!-- Personal Information -->
                    <div class="bg-white rounded-lg shadow-sm mb-6">
                        <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                            <h3 class="text-lg font-medium text-gray-800">Personal Information</h3>
                        </div>

                        <div class="p-7">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div>
                                    <p class="text-sm font-medium text-gray-500 mb-1">Employee ID</p>
                                    <p class="text-gray-800">{{ Auth::user()->employee_id_no }}</p>
                                </div>

                                <div>
                                    <p class="text-sm font-medium text-gray-500 mb-1">Full Name</p>
                                    <p class="text-gray-800">{{ Auth::user()->firstname}} {{ Auth::user()->lastname}}</p>
                                </div>

                                <div>
                                    <p class="text-sm font-medium text-gray-500 mb-1">Email Address</p>
                                    <p class="text-gray-800">{{ Auth::user()->email}}</p>
                                </div>

                                <div>
                                    <p class="text-sm font-medium text-gray-500 mb-1">Contact Number</p>
                                    <p class="text-gray-800">{{ Auth::user()->mobile_number}}</p>
                                </div>

                                <div>
                                    <p class="text-sm font-medium text-gray-500 mb-1">Division</p>
                                    <p class="text-gray-800">{{ Auth::user()->division}}</p>
                                </div>

                                <div>
                                    <p class="text-sm font-medium text-gray-500 mb-1">Position</p>
                                    <p class="text-gray-800">{{ Auth::user()->role}}</p>
                                </div>

                                <div>
                                    <p class="text-sm font-medium text-gray-500 mb-1">Date Joined</p>
                                    <p class="text-gray-800">{{ \Carbon\Carbon::parse(Auth::user()->created_at)->format('F j, Y') }}</p>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('components.footer')

</x-layout>
