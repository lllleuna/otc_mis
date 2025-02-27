<div x-data="transactionData()" class="p-8 border rounded-lg shadow-lg">
    <div class="relative mb-5">
        <input type="text" placeholder="Search transactions..."
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
                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Transaction Ref No.</th>
                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Transaction Type</th>
                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Applicant Name</th>
                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cooperative Name</th>
                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mode of Service</th>
                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date of Accreditation</th>
                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">CGS Registered Number</th>
                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            <template x-for="submission in filteredSubmissions()" :key="submission.trxRef">
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm text-gray-900" x-text="submission.trxRef"></td>
                    <td class="px-6 py-4 text-sm text-gray-900" x-text="submission.transactionType"></td>
                    <td class="px-6 py-4 text-sm text-gray-900" x-text="submission.applicant"></td>
                    <td class="px-6 py-4 text-sm text-gray-900" x-text="submission.cooperative"></td>
                    <td class="px-6 py-4">
                        <span class="px-2 inline-flex text-xs font-semibold rounded-full"
                            :class="submission.status === 'Active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'">
                            <span x-text="submission.status"></span>
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm" x-text="submission.modeOfService"></td>
                    <td class="px-6 py-4 text-sm" x-text="submission.dateOfAccreditation"></td>
                    <td class="px-6 py-4 text-sm text-gray-900" x-text="submission.cgsRegisteredNumber"></td>
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
                class="px-4 py-2 bg-blue-600 text-white rounded-md disabled:bg-blue-900">
            Previous
        </button>
        <span class="text-gray-700 self-center">Page <span x-text="currentPage"></span> of <span x-text="totalPages()"></span></span>
        <button @click="currentPage = currentPage < totalPages() ? currentPage + 1 : totalPages()"
                :disabled="currentPage === totalPages()"
                class="px-4 py-2 bg-blue-600 text-white rounded-md disabled:bg-blue-900">
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
            submissions: [
                {
                    trxRef: 'TRX123456',
                    transactionType: 'New Application',
                    applicant: 'John Doe',
                    cooperative: 'Sample Cooperative',
                    status: 'Active',
                    modeOfService: 'PUJ',
                    dateOfAccreditation: '2023-01-15',
                    cgsRegisteredNumber: 'CGS-001'
                },
                {
                    trxRef: 'TRX123457',
                    transactionType: 'Renewal',
                    applicant: 'Jane Smith',
                    cooperative: 'Another Cooperative',
                    status: 'Inactive',
                    modeOfService: 'UV Express',
                    dateOfAccreditation: '2022-12-10',
                    cgsRegisteredNumber: 'CGS-002'
                },
                {
                    trxRef: 'TRX123458',
                    transactionType: 'Modification',
                    applicant: 'Alice Johnson',
                    cooperative: 'Third Cooperative',
                    status: 'Active',
                    modeOfService: 'Taxi',
                    dateOfAccreditation: '2023-03-05',
                    cgsRegisteredNumber: 'CGS-003'
                }
            ],
            filteredSubmissions() {
                let filtered = this.submissions.filter(submission => {
                    return submission.trxRef.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                        submission.applicant.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                        submission.cooperative.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                        submission.transactionType.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                        submission.status.toLowerCase().includes(this.searchQuery.toLowerCase());
                });

                return filtered.slice((this.currentPage - 1) * this.itemsPerPage, this.currentPage * this.itemsPerPage);
            },
            totalPages() {
                return Math.ceil(this.submissions.length / this.itemsPerPage);
            }
        }
    }
</script>
