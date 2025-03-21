@php
    $activeTab = request('tab', 'office');
@endphp

<x-layout>
    <x-slot:vite></x-slot:vite>
    <x-slot:title>Record Management</x-slot:title>

    <body class="bg-gray-100 min-h-screen p-7" x-data="{ activeTab: 'transportation', searchQuery: '', currentPage: 1, itemsPerPage: 10 }">
        <div class="max-w-8xl mx-auto p-9 bg-white shadow-lg rounded-lg">
            <header class="mb-5">
                <h1 class="text-2xl font-bold text-gray-800">Record Management</h1>
                <nav class="flex justify-center space-x-4 mt-4">
                    <button @click="activeTab = 'transportation'" class="px-6 py-3 text-lg rounded-lg text-gray-700 hover:text-gray-900 transition duration-200" :class="{ 'font-bold': activeTab === 'transportation' }">Transportation Cooperatives</button>
                    @canany(['admin-access', 'officer1-access', 'officer2-access'])
                    <button @click="activeTab = 'office'" class="px-6 py-3 text-lg rounded-lg text-gray-700 hover:text-gray-900 transition duration-200" :class="{ 'font-bold ': activeTab === 'office' }">Edit Record Management</button>
                    @endcan

                    @can('admin-access')
                    <button @click="activeTab = 'head'" class="px-6 py-3 text-lg rounded-lg text-gray-700 hover:text-gray-900 transition duration-200" :class="{ 'font-bold ': activeTab === 'head' }">Approval Record Management</button>
                    @endcan
                </nav>
            </header>

            <div class="mt-5">
                <!-- Include the blade for Transportation Cooperative -->
                <div x-show="activeTab === 'transportation'">
                    @include('tc.transportation-cooperative')
                </div>

                @canany(['admin-access', 'officer1-access', 'officer2-access'])
                <!-- Include the blade for Office Record Management -->
                <div x-show="activeTab === 'office'">
                    @include('tc.office-record-management')
                </div>
                @endcan

                @can('admin-access')
                <!-- Include the blade for Head Record Management -->
                <div x-show="activeTab === 'head'">
                    @include('tc.head-record-management')
                </div>
                @endcan

            </div>
        </div>

        @include('components.footer')

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    </body>


</x-layout>
