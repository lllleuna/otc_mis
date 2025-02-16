<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transport Cooperative Details</title>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-8"
    x-data="{
        tab: 'general',
        searchQuery: '',
        menus: {
            operations: false,
            financial: false,
            development: false
        },
        cooperativeData: {
            general: [
                { label: 'Cooperative Name', value: '{{ $cooperative->name ?? 'Sample Coop' }}' },
                { label: 'Registration Number', value: '{{ $cooperative->registration_number ?? 'REG-001' }}' },
                { label: 'Address', value: '{{ $cooperative->address ?? '123 Sample St' }}' }
            ],
            membership: [
                { label: 'Total Members', value: '{{ $cooperative->total_members ?? '150' }}' },
                { label: 'Active Members', value: '{{ $cooperative->active_members ?? '130' }}' }
            ]
        },
        get filteredData() {
            if (!this.searchQuery) return [];

            let results = [];
            for (let category in this.cooperativeData) {
                const items = this.cooperativeData[category].filter(item =>
                    item.value.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                    item.label.toLowerCase().includes(this.searchQuery.toLowerCase())
                ).map(item => ({
                    ...item,
                    category: category
                }));
                results.push(...items);
            }
            return results;
        }
    }">

    <div class="max-w-7xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Transport Cooperative</h1>
            <button onclick="window.history.back()" class="px-4 py-2 text-sm bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                ← Back
            </button>
        </div>

        <!-- Search Bar -->
        <div class="mb-6">
            <div class="relative">
                <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input
                    type="text"
                    placeholder="Search cooperative information..."
                    class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    x-model="searchQuery"
                >
            </div>
        </div>

        <div class="flex gap-6">
            <!-- Navigation Menu -->
            <div class="w-64 bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="p-4 bg-blue-900 text-white">
                    <h2 class="font-semibold">Navigation Menu</h2>
                </div>
                <nav class="p-2">
                    <!-- Operations Menu -->
                    <div class="mb-2">
                        <button @click="menus.operations = !menus.operations"
                            class="w-full px-4 py-3 text-left rounded-lg flex items-center justify-between hover:bg-gray-50">
                            <span class="font-medium text-gray-700">Operations</span>
                            <svg xmlns="http://www.w3.org/2000/svg"
                                :class="menus.operations ? 'transform rotate-90' : ''"
                                class="w-5 h-5 transition-transform"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                        <div x-show="menus.operations" class="ml-4">
                            <template x-for="item in ['general', 'membership', 'employment', 'units', 'franchise']">
                                <button
                                    @click="tab = item"
                                    class="w-full px-4 py-2 text-left rounded-lg mb-1 text-sm transition-colors"
                                    :class="tab === item ? 'bg-blue-50 text-blue-900 font-medium' : 'text-gray-600 hover:bg-gray-50'"
                                    x-text="item.charAt(0).toUpperCase() + item.slice(1)">
                                </button>
                            </template>
                        </div>
                    </div>

                    <!-- Financial Menu -->
                    <div class="mb-2">
                        <button @click="menus.financial = !menus.financial"
                            class="w-full px-4 py-3 text-left rounded-lg flex items-center justify-between hover:bg-gray-50">
                            <span class="font-medium text-gray-700">Financial</span>
                            <svg xmlns="http://www.w3.org/2000/svg"
                                :class="menus.financial ? 'transform rotate-90' : ''"
                                class="w-5 h-5 transition-transform"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                        <div x-show="menus.financial" class="ml-4">
                            <template x-for="item in ['finances', 'grantsdonations', 'loans', 'businesses']">
                                <button
                                    @click="tab = item"
                                    class="w-full px-4 py-2 text-left rounded-lg mb-1 text-sm transition-colors"
                                    :class="tab === item ? 'bg-blue-50 text-blue-900 font-medium' : 'text-gray-600 hover:bg-gray-50'"
                                    x-text="item.charAt(0).toUpperCase() + item.slice(1)">
                                </button>
                            </template>
                        </div>
                    </div>

                    <!-- Development Menu -->
                    <div class="mb-2">
                        <button @click="menus.development = !menus.development"
                            class="w-full px-4 py-3 text-left rounded-lg flex items-center justify-between hover:bg-gray-50">
                            <span class="font-medium text-gray-700">Development</span>
                            <svg xmlns="http://www.w3.org/2000/svg"
                                :class="menus.development ? 'transform rotate-90' : ''"
                                class="w-5 h-5 transition-transform"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                        <div x-show="menus.development" class="ml-4">
                            <template x-for="item in ['trainingsseminars', 'scholarships', 'cetos', 'awards']">
                                <button
                                    @click="tab = item"
                                    class="w-full px-4 py-2 text-left rounded-lg mb-1 text-sm transition-colors"
                                    :class="tab === item ? 'bg-blue-50 text-blue-900 font-medium' : 'text-gray-600 hover:bg-gray-50'"
                                    x-text="item.charAt(0).toUpperCase() + item.slice(1)">
                                </button>
                            </template>
                        </div>
                    </div>
                </nav>
            </div>

            <!-- Content Area -->
            <div class="flex-1 bg-white rounded-lg shadow-lg p-6">
                <template x-if="searchQuery">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Search Results</h2>
                        <template x-if="filteredData.length > 0">
                            <div class="space-y-4">
                                <template x-for="(item, index) in filteredData" :key="index">
                                    <div class="p-4 border rounded-lg">
                                        <div class="text-sm text-blue-600 mb-1" x-text="item.category.charAt(0).toUpperCase() + item.category.slice(1)"></div>
                                        <div class="font-medium" x-text="item.label"></div>
                                        <div class="text-gray-600" x-text="item.value"></div>
                                    </div>
                                </template>
                            </div>
                        </template>
                        <template x-if="filteredData.length === 0">
                            <p class="text-gray-500">No results found for "<span x-text="searchQuery"></span>"</p>
                        </template>
                    </div>
                </template>

                <template x-if="!searchQuery">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800 mb-4" x-text="tab.charAt(0).toUpperCase() + tab.slice(1)"></h2>
                        <template x-if="cooperativeData[tab]">
                            <div class="grid gap-4">
                                <template x-for="(item, index) in cooperativeData[tab]" :key="index">
                                    <div class="p-4 border rounded-lg">
                                        <div class="font-medium" x-text="item.label"></div>
                                        <div class="text-gray-600" x-text="item.value"></div>
                                    </div>
                                </template>
                            </div>
                        </template>
                        <template x-if="!cooperativeData[tab]">
                            <p class="text-gray-500">No data available for this section</p>
                        </template>
                    </div>
                </template>
            </div>
        </div>
    </div>
</body>
</html>
