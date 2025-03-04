<div class="container mx-auto px-4 py-7 max-w-full w-full" x-data="approvalManagement()">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Approval Management</h2>
            <p class="text-gray-600 mt-1">Review and manage pending transaction approvals for transportation cooperatives</p>
        </div>

        <div class="relative mb-6">
            <input type="text" placeholder="Search by Transaction Reference No."
                class="w-full pl-10 pr-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition duration-150"
                x-model="searchQuery">
            <div class="absolute left-3 top-3">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
        </div>

        <div class="overflow-hidden rounded-lg border border-gray-200">
            <div class="divide-y divide-gray-200">
                <template x-for="request in filteredRequests()" :key="request.trxRef">
                    <div class="p-4 hover:bg-gray-50 transition duration-150">
                        <div class="flex justify-between items-start">
                            <div class="flex-grow pr-4">
                                <div class="flex justify-between items-center">
                                    <h3 class="text-lg font-semibold text-gray-800" x-text="request.trxRef"></h3>
                                    <div class="text-sm text-gray-500" x-text="request.submissionTime"></div>
                                </div>
                                <p class="text-sm text-gray-600 mt-1" x-text="request.details"></p>
                                <div class="mt-2 flex justify-between items-center">
                                    <div>
                                        <span x-show="request.isEdited" class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Edited</span>
                                    </div>
                                    <div class="text-sm text-gray-500" x-show="request.reviewTime">
                                        Reviewed: <span x-text="request.reviewTime"></span>
                                    </div>
                                </div>
                            </div>
                            <button class="px-4 py-2 bg-blue-900 text-white rounded-md disabled:opacity-90 hover:bg-gray-600 transition duration-150 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50"
                                @click="reviewTransaction(request.trxRef)">
                                Review
                            </button>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>

    <!-- Include the Modal Component -->
    @include('components.approval')


    <script>
        function approvalManagement() {
            return {
                showApprovalForm: false,
                trxRef: '',
                reviewerName: '',
                submissionTime: '',
                reviewTime: '',
                transactionType: '',
                approvalRemarks: '',
                searchQuery: '',
                originalData: {},
                newData: {},
                requests: [
                    {
                        trxRef: 'TRX202301',
                        details: 'New Application - Sunshine Transport Cooperative',
                        isEdited: false,
                        submissionTime: '2025-01-15 10:30 AM',
                        reviewTime: '',

                        newData: {
                            transportationName: 'Sunshine Transport Cooperative',
                            registrationNumber: 'REG-2025-001',

                        }
                    },
                    {
                        trxRef: 'TRX202302',
                        details: 'Renewal - Moonlight Transport Cooperative',
                        isEdited: true,
                        submissionTime: '2025-01-10 09:15 AM',
                        reviewTime: '2025-01-12 02:45 PM',

                        newData: {
                            transportationName: 'Moonlight Transport Cooperative',
                            registrationNumber: 'REG-2025-002',

                    },

                    }
                ],
                filteredRequests() {
                    if (!this.searchQuery) return this.requests;
                    return this.requests.filter(request =>
                        request.trxRef.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                        request.details.toLowerCase().includes(this.searchQuery.toLowerCase())
                    );
                },
                reviewTransaction(trxRef) {
                    const request = this.requests.find(req => req.trxRef === trxRef);
                    if (request) {
                        this.trxRef = request.trxRef;
                        this.reviewerName = 'John Admin';
                        this.submissionTime = request.submissionTime;
                        this.reviewTime = new Date().toLocaleString();
                        this.transactionType = request.details.split(' - ')[0];
                        this.approvalRemarks = '';
                        this.originalData = request.originalData;
                        this.newData = request.newData;
                        this.showApprovalForm = true;

                        // Update the request's review time when reviewed
                        request.reviewTime = this.reviewTime;
                    }
                },
            };
        }
    </script>
</div>

</div>
