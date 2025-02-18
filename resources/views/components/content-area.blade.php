<div class="flex-1 bg-white rounded-lg shadow-lg p-6">
    <template x-if="searchQuery">
        <div>
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Search Results</h2>
            <template x-if="filteredData.length > 0">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
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
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-gray-800" x-text="tab.charAt(0).toUpperCase() + tab.slice(1)"></h2>
                <template x-if="tab === 'general'">
                    <a href="#" @click.prevent="openEditGeneralModal()" class="text-blue-600 hover:underline">
                        Edit
                    </a>
                </template>
                <template x-if="tab === 'membership'">
                    <a href="#" @click.prevent="openEditMembershipModal()" class="text-blue-600 hover:underline">
                        Edit
                    </a>
                </template>
            </div>

            <template x-if="cooperativeData[tab]">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <template x-for="(item, index) in cooperativeData[tab]" :key="index">
                        <div class="p-4 border rounded-lg flex justify-between items-center">
                            <div>
                                <div class="font-medium" x-text="item.label"></div>
                                <div class="text-gray-600" x-text="item.value"></div>
                            </div>
                        </div>
                    </template>
                </div>
            </template>
        </div>
    </template>
</div>
