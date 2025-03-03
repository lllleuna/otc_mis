<div class="p-8 border rounded-lg shadow-lg" x-data="approvalManagement()">
    <div class="mb-5">
        <h2 class="text-xl font-semibold mb-4">Approval Management</h2>
        <p class="text-gray-700 mb-4">Review and approve transaction records</p>
    </div>

    <div class="mb-5">
        <div class="relative mb-5">
            <input type="text" placeholder="Search by Transaction Reference No."
                class="w-full pl-10 pr-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                x-model="searchQuery">
            <div class="absolute left-3 top-3">
                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="divide-y divide-gray-200">
            <template x-for="request in filteredRequests()" :key="request.trxRef">
                <div class="p-6 hover:bg-gray-50">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900" x-text="request.trxRef"></h3>
                            <p class="text-sm text-gray-500" x-text="request.details"></p>
                        </div>
                        <button class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700" @click="reviewTransaction(request.trxRef)">Review</button>
                    </div>
                </div>
            </template>
        </div>
    </div>

    <!-- Modal for Approval Form -->
    <div x-show="showApprovalForm" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50" @click.away="showApprovalForm = false">
        <div class="bg-white rounded-lg shadow-lg p-6 w-11/12 md:w-1/3">
            <h3 class="text-lg font-medium mb-4">Approval Form</h3>

            <form @submit.prevent="submitApproval">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Transaction Reference No.</label>
                    <input type="text" x-model="trxRef" class="mb-3 p-3 border rounded w-full bg-gray-100" readonly>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Reviewer Name</label>
                    <input type="text" x-model="reviewerName" class="mb-3 p-3 border rounded w-full" readonly>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Transportation Name</label>
                    <input type="text" x-model="transportationName" class="mb-3 p-3 border rounded w-full" readonly>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Submission Time</label>
                    <input type="text" x-model="submissionTime" class="mb-3 p-3 border rounded w-full" readonly>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Transaction Type</label>
                    <input type="text" x-model="transactionType" class="mb-3 p-3 border rounded w-full" readonly>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Approval Status</label>
                    <select x-model="approvalStatus" class="mb-3 p-3 border rounded w-full">
                        <option value="approved">Approved</option>
                        <option value="rejected">Rejected</option>
                        <option value="pending">Pending Further Review</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Approval Remarks</label>
                    <textarea x-model="approvalRemarks" placeholder="Provide detailed remarks about your decision" class="mb-3 p-3 border rounded w-full h-32"></textarea>
                </div>

                <div class="flex justify-end space-x-2">
                    <button type="button" @click="showApprovalForm = false" class="px-4 py-2 text-gray-700 rounded border border-gray-300 hover:bg-gray-200 transition duration-200">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition duration-200">Submit Approval</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function approvalManagement() {
            return {
                showApprovalForm: false,
                trxRef: '',
                reviewerName: '',
                transportationName: '',
                submissionTime: '',
                transactionType: '',
                approvalStatus: 'approved',
                approvalRemarks: '',
                searchQuery: '',
                requests: [
                    { trxRef: 'TRX123456', details: 'New Application - John Doe (Sample Cooperative)', status: 'pending' },
                    { trxRef: 'TRX123457', details: 'Renewal - Jane Smith (Another Cooperative)', status: 'approved' },
                    // Add more sample requests as needed
                ],
                filteredRequests() {
                    return this.requests.filter(request => request.trxRef.includes(this.searchQuery));
                },
                reviewTransaction(trxRef) {
                    const request = this.requests.find(req => req.trxRef === trxRef);
                    if (request) {
                        this.trxRef = request.trxRef;
                        this.reviewerName = 'Your Name'; // Replace with actual reviewer name
                        this.transportationName = 'Transportation XYZ'; // Replace with actual transportation name
                        this.submissionTime = new Date().toLocaleString(); // Current time
                        this.transactionType = request.details.split(' - ')[0]; // Extract type from details
                        this.approvalStatus = request.status; // Set current status
                        this.approvalRemarks = ''; // Reset remarks
                        this.showApprovalForm = true;
                    }
                },
                submitApproval() {
                    console.log('Approval submitted for:', this.trxRef);
                    alert('Approval submitted successfully!');

                    // Reset the form
                    this.showApprovalForm = false;
                    this.trxRef = '';
                    this.reviewerName = '';
                    this.transportationName = '';
                    this.submissionTime = '';
                    this.transactionType = '';
                    this.approvalStatus = 'approved';
                    this.approvalRemarks = '';
                }
            };
        }
    </script>
</div>
