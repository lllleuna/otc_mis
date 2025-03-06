<div x-data="transactionData()" class="p-8 border rounded-lg shadow-lg">
    <div class="relative mb-5">
        <input type="text" placeholder="Search cooperatives..."
            class="w-full pl-10 pr-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            x-model="searchQuery">
        <div class="absolute left-3 top-3">
            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </div>
    </div>

    <table class="w-full divide-y divide-gray-200">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cooperative Name</th>
                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mode of Service</th>
                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date of Accreditation</th>
                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Service Area</th>
                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            <template x-for="cooperative in filteredCooperatives()" :key="cooperative.id">
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm text-gray-900" x-text="cooperative.name"></td>
                    <td class="px-6 py-4 text-sm text-gray-900" x-text="cooperative.modeOfService"></td>
                    <td class="px-6 py-4">
                        <span class="px-2 inline-flex text-xs font-semibold rounded-full"
                            :class="cooperative.status === 'Active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'">
                            <span x-text="cooperative.status"></span>
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm" x-text="cooperative.dateOfAccreditation"></td>
                    <td class="px-6 py-4 text-sm text-gray-900" x-text="cooperative.serviceArea"></td>
                    <td class="px-6 py-4 text-sm">
                        <a href="/tc/show" class="text-blue-500 hover:underline">View More</a>
                    </td>
                </tr>
            </template>
        </tbody>
    </table>

    <div class="flex justify-between mt-4">
        <button @click="currentPage = currentPage > 1 ? currentPage - 1 : 1"
                :disabled="currentPage === 1"
                class="px-3 py-1 bg-blue-900 text-white rounded-md disabled:opacity-90 hover:bg-gray-600 ">
            Previous
        </button>
        <span class="text-gray-700 self-center">Page <span x-text="currentPage"></span> of <span x-text="totalPages()"></span></span>
        <button @click="currentPage = currentPage < totalPages() ? currentPage + 1 : totalPages()"
                :disabled="currentPage === totalPages()"
                class="px-3 py-1 bg-blue-900 text-white rounded-md disabled:opacity-90 hover:bg-gray-600 ">
            Next
        </button>
    </div>
</div>

<script>
    function transactionData() {
        return {
            searchQuery: '',
            currentPage: 1,
            itemsPerPage: 10,
            cooperatives: [
                {
                    id: 1,
                    name: 'Metro Manila Transport Cooperative',
                    modeOfService: 'PUJ',
                    status: 'Active',
                    dateOfAccreditation: '2023-03-15',
                    serviceArea: 'Quezon City - Makati'
                },
                {
                    id: 2,
                    name: 'Mindanao Star Transport Cooperative',
                    modeOfService: 'UV Express',
                    status: 'Active',
                    dateOfAccreditation: '2023-01-10',
                    serviceArea: 'Davao City'
                },
                {
                    id: 3,
                    name: 'Cebu United Transport Cooperative',
                    modeOfService: 'Taxi',
                    status: 'Active',
                    dateOfAccreditation: '2022-11-05',
                    serviceArea: 'Cebu City'
                },
                {
                    id: 4,
                    name: 'Luzon Express Cooperative',
                    modeOfService: 'PUJ',
                    status: 'Inactive',
                    dateOfAccreditation: '2022-08-22',
                    serviceArea: 'Baguio - La Trinidad'
                },
                {
                    id: 5,
                    name: 'Visayas Modern Transport Cooperative',
                    modeOfService: 'Modern Jeepney',
                    status: 'Active',
                    dateOfAccreditation: '2023-02-18',
                    serviceArea: 'Iloilo City'
                },
                {
                    id: 6,
                    name: 'National Capital Region Transport Cooperative',
                    modeOfService: 'PUB',
                    status: 'Active',
                    dateOfAccreditation: '2023-04-30',
                    serviceArea: 'Manila - Pasay'
                },
                {
                    id: 7,
                    name: 'Southern Tagalog Transport Cooperative',
                    modeOfService: 'UV Express',
                    status: 'Inactive',
                    dateOfAccreditation: '2022-09-15',
                    serviceArea: 'Batangas - Laguna'
                },
                {
                    id: 8,
                    name: 'Bicol Express Transport Cooperative',
                    modeOfService: 'PUJ',
                    status: 'Active',
                    dateOfAccreditation: '2023-05-12',
                    serviceArea: 'Legazpi City'
                },
                {
                    id: 9,
                    name: 'Ilocos Transport Service Cooperative',
                    modeOfService: 'Modern Jeepney',
                    status: 'Active',
                    dateOfAccreditation: '2023-06-01',
                    serviceArea: 'Laoag - Vigan'
                },
                {
                    id: 10,
                    name: 'Palawan Island Transport Cooperative',
                    modeOfService: 'PUV',
                    status: 'Active',
                    dateOfAccreditation: '2023-01-25',
                    serviceArea: 'Puerto Princesa City'
                },
                {
                    id: 11,
                    name: 'Zamboanga Peninsula Transport Cooperative',
                    modeOfService: 'PUJ',
                    status: 'Active',
                    dateOfAccreditation: '2022-12-03',
                    serviceArea: 'Zamboanga City'
                },
                {
                    id: 12,
                    name: 'CARAGA Region Transport Cooperative',
                    modeOfService: 'UV Express',
                    status: 'Inactive',
                    dateOfAccreditation: '2022-10-17',
                    serviceArea: 'Butuan City'
                }
            ],
            filteredCooperatives() {
                let filtered = this.cooperatives.filter(cooperative => {
                    return cooperative.name.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                        cooperative.modeOfService.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                        cooperative.status.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                        cooperative.serviceArea.toLowerCase().includes(this.searchQuery.toLowerCase());
                });

                return filtered.slice((this.currentPage - 1) * this.itemsPerPage, this.currentPage * this.itemsPerPage);
            },
            totalPages() {
                return Math.ceil(this.cooperatives.length / this.itemsPerPage);
            }
        }
    }
</script>
