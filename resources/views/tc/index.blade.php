<x-layout>
    <x-slot:vite></x-slot:vite>

    <x-slot:title>Record Management System</x-slot:title>

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Record Management</title>
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    </head>

    <body class="bg-gray-100 min-h-screen p-7" x-data="{ activeTab: 'transportation', searchQuery: '', currentPage: 1, itemsPerPage: 10 }">
        <div class="max-w-8xl mx-auto p-9 bg-white shadow-lg rounded-lg">
            <header class="mb-5">
                <h1 class="text-2xl font-bold text-gray-800">Record Management</h1>
                <nav class="flex justify-center space-x-4 mt-4">
                    <button @click="activeTab = 'transportation'" class="px-6 py-3 text-lg rounded-lg text-gray-700 hover:text-gray-900 transition duration-200" :class="{ 'font-bold': activeTab === 'transportation' }">Transportation Cooperative</button>
                    <button @click="activeTab = 'office'" class="px-6 py-3 text-lg rounded-lg text-gray-700 hover:text-gray-900 transition duration-200" :class="{ 'font-bold ': activeTab === 'office' }">Office Record Management</button>
                    <button @click="activeTab = 'head'" class="px-6 py-3 text-lg rounded-lg text-gray-700 hover:text-gray-900 transition duration-200" :class="{ 'font-bold ': activeTab === 'head' }">Head Record Management</button>
                </nav>
            </header>

            <div class="mt-5">
                <!-- Include the blade for Transportation Cooperative -->
                <div x-show="activeTab === 'transportation'">
                    @include('components.transportation-cooperative')
                </div>


                <!-- Include the blade for Office Record Management -->
                <div x-show="activeTab === 'office'">
                    @include('tc.office-record-management')
                </div>


                <!-- Include the blade for Head Record Management -->
                <div x-show="activeTab === 'head'">
                    @include('components.head-record-management')
                </div>
            </div>
        </div>

        @include('components.footer')
    </body>
</x-layout>
