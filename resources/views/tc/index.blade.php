<x-layout>
    <x-slot:vite>
        <link rel="stylesheet" href="/dist/styles.css">
    </x-slot:vite>
    <x-slot:title>Received Transactions</x-slot:title>

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Received Transactions</title>
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    </head>

    <body class="bg-gray-100 min-h-screen p-8" x-data="{
        searchQuery: '',
        currentPage: 1,
        itemsPerPage: 10,
        submissions: [
            { trxRef: 'TRX-2024-001', transactionType: 'Franchise Application', applicant: 'Juan Dela Cruz', cooperative: 'Makati-Transcoop', dateReceived: '2025-02-22', remarks: 'Initial processing', status: 'Unread' },
            { trxRef: 'TRX-2024-002', transactionType: 'Route Modification', applicant: 'Maria Santos', cooperative: 'Taguig-Coop', dateReceived: '2025-02-21', remarks: 'Reviewed by Officer 1', status: 'Reviewed' },
            { trxRef: 'TRX-2024-003', transactionType: 'Vehicle Replacement', applicant: 'Pedro Garcia', cooperative: 'Jaja Cooperative', dateReceived: '2025-02-20', remarks: 'Forwarded to Officer II', status: 'Forwarded' }
        ],
        filteredSubmissions() {
            let filtered = this.submissions.filter(submission =>
                submission.trxRef.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                submission.applicant.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                submission.cooperative.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                submission.transactionType.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                submission.status.toLowerCase().includes(this.searchQuery.toLowerCase())
            );
            return filtered.slice((this.currentPage - 1) * this.itemsPerPage, this.currentPage * this.itemsPerPage);
        },
        totalPages() {
            return Math.ceil(this.submissions.length / this.itemsPerPage);
        }
    }">
        <div class="max-w-full mx-auto p-5 shadow-lg rounded-lg bg-white">
            <header class="flex items-center justify-between mb-7 bg-gray-10 p-2 rounded-lg">
                <h1 class="text-2xl font-bold text-gray-800">Received Transactions</h1>
            </header>

            <div class="mb-7">
                <div class="relative">
                    <input type="text" placeholder="Search transactions..."
                           class="w-70 pl-20 pr-9 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           x-model="searchQuery">
                    <div class="absolute left-3 top-2">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div>
                <table class="w-full divide-y divide-gray-200">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Transaction Reference No.</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Transaction Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Applicant Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cooperative Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date Received</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Remarks</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <template x-for="submission in filteredSubmissions()" :key="submission.trxRef">
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm text-gray-900" x-text="submission.trxRef"></td>
                                <td class="px-6 py-4 text-sm text-gray-900" x-text="submission.transactionType"></td>
                                <td class="px-6 py-4 text-sm text-gray-900" x-text="submission.applicant"></td>
                                <td class="px-6 py-4 text-sm text-gray-900" x-text="submission.cooperative"></td>
                                <td class="px-6 py-4 text-sm text-gray-900" x-text="submission.dateReceived"></td>
                                <td class="px-6 py-4 text-sm text-gray-900" x-text="submission.remarks"></td>
                                <td class="px-6 py-4">
                                    <span class="px-2 inline-flex text-xs font-semibold rounded-full"
                                          :class="submission.status === 'Unread' ? 'bg-blue-100 text-blue-800' : submission.status === 'Reviewed' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800'">
                                        <span x-text="submission.status"></span>
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <a href="#" class="text-blue-500 hover:underline">View More</a>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
            <div class="flex justify-between mt-4">
                <button @click="prevPage" :disabled="currentPage === 1" class="px-4 py-2 bg-gray-200 rounded-md">Previous</button>
                <span class="text-gray-700">Page <span x-text="currentPage"></span> of <span x-text="totalPages()"></span></span>
                <button @click="nextPage" :disabled="currentPage === totalPages()" class="px-4 py-2 bg-gray-200 rounded-md">Next</button>
            </div>
        </div>
        @include('components.footer')
    </body>
</x-layout>
