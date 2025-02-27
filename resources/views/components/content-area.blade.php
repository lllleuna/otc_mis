<div class="flex-1 bg-white rounded-lg shadow-lg overflow-hidden">
    <template x-if="searchQuery">
        <div class="p-6">
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
        <div class="p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4" x-text="tab === 'grantsdonations' ? 'Grants & Donations' : tab === 'trainingsseminars' ? 'Trainings & Seminars' : tab === 'cetos' ? 'CETOS' : tab.charAt(0).toUpperCase() + tab.slice(1)"></h2>

            <!-- Grid layout for general and membership -->
            <template x-if="Array.isArray(cooperativeData[tab])">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <template x-for="(item, index) in cooperativeData[tab]" :key="index">
                        <div class="p-4 border rounded-lg">
                            <div class="font-medium" x-text="item.label"></div>
                            <div class="text-gray-600" x-text="item.value"></div>
                        </div>
                    </template>
                </div>
            </template>

            <!-- Table layout for other tabs -->
            <template x-if="cooperativeData[tab] && !Array.isArray(cooperativeData[tab])">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <template x-if="tab === 'employment' || tab === 'units' || tab === 'cetos'">
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
                                </template>
                                <template x-for="(header, index) in cooperativeData[tab].headers" :key="index">
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" x-text="header"></th>
                                </template>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <template x-for="(row, rowIndex) in cooperativeData[tab].rows" :key="rowIndex">
                                <tr>
                                    <template x-if="tab === 'units'">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            <div x-text="row.mode"></div>
                                            <div class="text-xs text-gray-500" x-text="row.type"></div>
                                        </td>
                                    </template>
                                    <template x-if="tab === 'franchise'">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900" x-text="row.year"></td>
                                    </template>
                                    <template x-if="tab === 'employment' || tab === 'cetos'">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900" x-text="row.category || ''"></td>
                                    </template>
                                    <template x-for="(value, valueIndex) in row.values" :key="valueIndex">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="value"></td>
                                    </template>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </template>

            <template x-if="!cooperativeData[tab]">
                <p class="text-gray-500">No data available for this section</p>
            </template>
        </div>
    </template>
</div>
