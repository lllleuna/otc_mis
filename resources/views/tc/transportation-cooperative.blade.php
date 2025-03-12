<div x-data="transactionData()" x-init="fetchCooperatives()" class="p-8 border rounded-lg shadow-lg">
    <div class="relative mb-5">
        <input type="text" placeholder="Search cooperatives by accreditation no."
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
                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Accreditation No</th>
                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cooperative Name</th>
                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Common Bond Membership</th>
                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date of Accreditation</th>
                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Service Area</th>
                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            <template x-for="cooperative in filteredCooperatives()" :key="cooperative.accreditation_no">
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm text-gray-900" x-text="cooperative.accreditation_no"></td>
                    <td class="px-6 py-4 text-sm text-gray-900" x-text="cooperative.name"></td>
                    <td class="px-6 py-4 text-sm text-gray-900" x-text="cooperative.common_bond_membership"></td>
                    <td class="px-6 py-4 text-sm" x-text="cooperative.accreditation_date"></td>
                    <td class="px-6 py-4 text-sm text-gray-900" x-text="cooperative.region"></td>
                    <td class="px-6 py-4 text-sm">
                        <a :href="'/cooperatives/' + cooperative.accreditation_no"
                            class="px-4 py-2  text-green-900 font-semibold rounded-lg hover:underline">
                            View
                        </a>
                    </td>
                </tr>
            </template>
        </tbody>
    </table>

    <div class="flex justify-between mt-4">
        <button @click="currentPage = currentPage > 1 ? currentPage - 1 : 1"
                :disabled="currentPage === 1"
                class="px-3 py-1 bg-blue-900 text-white rounded-md disabled:opacity-90 hover:bg-gray-600">
            Previous
        </button>
        <span class="text-gray-700 self-center">Page <span x-text="currentPage"></span> of <span x-text="totalPages()"></span></span>
        <button @click="currentPage = currentPage < totalPages() ? currentPage + 1 : totalPages()"
                :disabled="currentPage === totalPages()"
                class="px-3 py-1 bg-blue-900 text-white rounded-md disabled:opacity-90 hover:bg-gray-600">
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
            cooperatives: [], 
            regionMapping: {},

            async fetchRegions() {
                try {
                    let response = await fetch('https://psgc.gitlab.io/api/regions/');
                    let regions = await response.json();
                    this.regionMapping = regions.reduce((map, region) => {
                        map[region.code] = region.name;
                        return map;
                    }, {});
                } catch (error) {
                    console.error('Error fetching region data:', error);
                }
            },

            async fetchCooperatives() {
                try {
                    await this.fetchRegions();
                    let response = await fetch('/api/cooperatives');
                    let data = await response.json();
                    this.cooperatives = data.map(coop => ({
                        ...coop,
                        accreditation_date: new Date(coop.accreditation_date).toLocaleDateString('en-GB', {
                            year: 'numeric',
                            month: 'short',
                            day: 'numeric'
                        }).replace(/(\d+) (\w+) (\d+)/, '$3 $2 $1'),
                        region: this.regionMapping[coop.region] || "Unknown Region"
                    }));
                } catch (error) {
                    console.error('Error fetching cooperatives:', error);
                }
            },

            filteredCooperatives() {
                let filtered = this.cooperatives.filter(cooperative => {
                    return cooperative.name.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                        cooperative.accreditation_no.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                        cooperative.region.toLowerCase().includes(this.searchQuery.toLowerCase());
                });

                return filtered.slice((this.currentPage - 1) * this.itemsPerPage, this.currentPage * this.itemsPerPage);
            },

            totalPages() {
                return Math.ceil(this.cooperatives.length / this.itemsPerPage);
            }
        };
    }
</script>
