<div class="container mx-auto px-4 py-7 max-w-full w-full" x-data="approvalManagement()">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Transportation Cooperative Approval Management</h2>
            <p class="text-gray-600 mt-1">Verify and approve accreditation, renewal, and Certificate of Good Standing applications</p>
        </div>

        <div class="relative mb-6">
            <input type="text" placeholder="Search by Transaction Reference No. or Cooperative Name"
                class="w-full pl-10 pr-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition duration-150"
                x-model="searchQuery">
            <div class="absolute left-3 top-3">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
        </div>

        <!-- Status filter tabs -->
        <div class="flex flex-wrap border-b border-gray-200 mb-6">
            <button
                @click="statusFilter = 'all'"
                :class="{'border-b-2 border-blue-600 text-blue-600': statusFilter === 'all', 'text-gray-500': statusFilter !== 'all'}"
                class="px-4 py-2 font-medium">
                All Applications
            </button>
            <button
                @click="statusFilter = 'accreditation'"
                :class="{'border-b-2 border-blue-600 text-blue-600': statusFilter === 'accreditation', 'text-gray-500': statusFilter !== 'accreditation'}"
                class="px-4 py-2 font-medium">
                Accreditation
            </button>
            <button
                @click="statusFilter = 'renewal'"
                :class="{'border-b-2 border-blue-600 text-blue-600': statusFilter === 'renewal', 'text-gray-500': statusFilter !== 'renewal'}"
                class="px-4 py-2 font-medium">
                Renewal
            </button>
            <button
                @click="statusFilter = 'cgs'"
                :class="{'border-b-2 border-blue-600 text-blue-600': statusFilter === 'cgs', 'text-gray-500': statusFilter !== 'cgs'}"
                class="px-4 py-2 font-medium">
                Certificate of Good Standing
            </button>
            <button
                @click="statusFilter = 'verified'"
                :class="{'border-b-2 border-blue-600 text-blue-600': statusFilter === 'verified', 'text-gray-500': statusFilter !== 'verified'}"
                class="px-4 py-2 font-medium">
                Verified
            </button>
            <button
                @click="statusFilter = 'pending'"
                :class="{'border-b-2 border-blue-600 text-blue-600': statusFilter === 'pending', 'text-gray-500': statusFilter !== 'pending'}"
                class="px-4 py-2 font-medium">
                Pending
            </button>
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
                                <div class="text-md font-medium text-gray-800 mt-1" x-text="request.cooperativeName"></div>
                                <p class="text-sm text-gray-600 mt-1" x-text="request.applicationType + ' Application'"></p>
                                <div class="mt-2 flex justify-between items-center">
                                    <div class="flex flex-wrap gap-2">
                                        <span x-show="request.isModified" class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Modified</span>
                                        <span x-show="request.reviewTime" class="px-2 py-1 text-xs rounded-full bg-purple-100 text-purple-800">Verified</span>
                                        <span x-show="!request.reviewTime" class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                        <span x-show="request.hasDocuments" class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">Has Documents</span>
                                    </div>
                                    <div class="text-sm text-gray-500" x-show="request.reviewTime">
                                        Verified: <span x-text="request.reviewTime"></span>
                                    </div>
                                </div>
                            </div>
                            <button class="px-4 py-2 bg-blue-900 text-white rounded-md disabled:opacity-90 hover:bg-blue-700 transition duration-150 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50"
                                @click="reviewTransaction(request.trxRef)">
                                View
                            </button>
                        </div>
                    </div>
                </template>

                <!-- Empty state -->
                <div x-show="filteredRequests().length === 0" class="p-8 text-center text-gray-500">
                    <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <p class="text-lg">No applications found</p>
                    <p class="mt-1">Try adjusting your search or filter criteria</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Component for Verification -->
    <div x-show="showApprovalForm" class="fixed inset-0 z-50 overflow-y-auto" x-cloak>
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 bg-black opacity-50" @click="showApprovalForm = false"></div>

            <div class="relative bg-white rounded-lg shadow-xl max-w-4xl w-full mx-auto p-6 z-10">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-gray-800" x-text="applicationType + ' Application Verification'"></h3>
                    <button @click="showApprovalForm = false" class="text-gray-400 hover:text-gray-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="border-t border-gray-200 pt-4">
                    <!-- Transaction Info -->
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div>
                            <p class="text-sm text-gray-500">Transaction Reference</p>
                            <p class="font-medium" x-text="trxRef"></p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Submission Date</p>
                            <p class="font-medium" x-text="submissionTime"></p>
                        </div>
                    </div>

                    <!-- Cooperative Information -->
                    <div class="mb-6">
                        <h4 class="font-bold text-lg text-gray-800 mb-3">Cooperative Information</h4>

                        <div class="mb-4">
                            <div class="flex flex-col md:flex-row md:gap-4">
                                <div class="flex-1 mb-2">
                                    <p class="text-sm text-gray-500">Cooperative Name</p>
                                    <p class="font-medium" x-text="newData.transportationName"></p>
                                </div>
                                <div class="flex-1 mb-2">
                                    <p class="text-sm text-gray-500">Registration Number</p>
                                    <p class="font-medium" x-text="newData.registrationNumber"></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Changes Verification Section -->
                    <div class="mb-6" x-show="Object.keys(originalData).length > 0">
                        <h4 class="font-bold text-lg text-gray-800 mb-3">Verification of Changes</h4>
                        <p class="text-sm text-gray-600 mb-3">Review the changes made to this application before approval</p>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h5 class="font-medium text-gray-700 mb-2">Original Data</h5>
                                <div class="text-sm" x-show="originalData.transportationName">
                                    <p class="text-gray-500">Cooperative Name</p>
                                    <p class="font-medium" x-text="originalData.transportationName"></p>
                                </div>
                                <div class="text-sm mt-2" x-show="originalData.registrationNumber">
                                    <p class="text-gray-500">Registration Number</p>
                                    <p class="font-medium" x-text="originalData.registrationNumber"></p>
                                </div>
                                <div class="text-sm mt-2" x-show="originalData.address">
                                    <p class="text-gray-500">Address</p>
                                    <p class="font-medium" x-text="originalData.address"></p>
                                </div>
                                <div class="text-sm mt-2" x-show="originalData.contactPerson">
                                    <p class="text-gray-500">Contact Person</p>
                                    <p class="font-medium" x-text="originalData.contactPerson"></p>
                                </div>
                                <div class="text-sm mt-2" x-show="originalData.contactNumber">
                                    <p class="text-gray-500">Contact Number</p>
                                    <p class="font-medium" x-text="originalData.contactNumber"></p>
                                </div>
                                <div class="text-sm mt-2" x-show="originalData.email">
                                    <p class="text-gray-500">Email</p>
                                    <p class="font-medium" x-text="originalData.email"></p>
                                </div>
                                <div class="text-sm mt-2" x-show="originalData.routesServiced">
                                    <p class="text-gray-500">Routes Serviced</p>
                                    <p class="font-medium" x-text="originalData.routesServiced"></p>
                                </div>
                                <div class="text-sm mt-2" x-show="originalData.fleetSize">
                                    <p class="text-gray-500">Fleet Size</p>
                                    <p class="font-medium" x-text="originalData.fleetSize"></p>
                                </div>
                            </div>

                            <div class="bg-green-50 p-4 rounded-lg">
                                <h5 class="font-medium text-gray-700 mb-2">Updated Data</h5>
                                <div class="text-sm" x-show="newData.transportationName">
                                    <p class="text-gray-500">Cooperative Name</p>
                                    <p class="font-medium" x-text="newData.transportationName"></p>
                                </div>
                                <div class="text-sm mt-2" x-show="newData.registrationNumber">
                                    <p class="text-gray-500">Registration Number</p>
                                    <p class="font-medium" x-text="newData.registrationNumber"></p>
                                </div>
                                <div class="text-sm mt-2" x-show="newData.address">
                                    <p class="text-gray-500">Address</p>
                                    <p class="font-medium" x-text="newData.address"></p>
                                </div>
                                <div class="text-sm mt-2" x-show="newData.contactPerson">
                                    <p class="text-gray-500">Contact Person</p>
                                    <p class="font-medium" x-text="newData.contactPerson"></p>
                                </div>
                                <div class="text-sm mt-2" x-show="newData.contactNumber">
                                    <p class="text-gray-500">Contact Number</p>
                                    <p class="font-medium" x-text="newData.contactNumber"></p>
                                </div>
                                <div class="text-sm mt-2" x-show="newData.email">
                                    <p class="text-gray-500">Email</p>
                                    <p class="font-medium" x-text="newData.email"></p>
                                </div>
                                <div class="text-sm mt-2" x-show="newData.routesServiced">
                                    <p class="text-gray-500">Routes Serviced</p>
                                    <p class="font-medium" x-text="newData.routesServiced"></p>
                                </div>
                                <div class="text-sm mt-2" x-show="newData.fleetSize">
                                    <p class="text-gray-500">Fleet Size</p>
                                    <p class="font-medium" x-text="newData.fleetSize"></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Documents Section -->
                    <div class="mb-6">
                        <h4 class="font-bold text-lg text-gray-800 mb-3">Required Documents</h4>

                        <template x-if="applicationType === 'Accreditation'">
                            <div class="space-y-2">
                                <div class="flex items-center p-2 border rounded" x-data="{ docViewOpen: false }">
                                    <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span class="flex-grow">Certificate of Registration</span>
                                    <button @click="docViewOpen = !docViewOpen" class="text-blue-600 hover:underline">
                                        View
                                    </button>
                                </div>
                                <div class="flex items-center p-2 border rounded" x-data="{ docViewOpen: false }">
                                    <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span class="flex-grow">Articles of Cooperation</span>
                                    <button @click="docViewOpen = !docViewOpen" class="text-blue-600 hover:underline">
                                        View
                                    </button>
                                </div>
                                <div class="flex items-center p-2 border rounded" x-data="{ docViewOpen: false }">
                                    <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span class="flex-grow">List of Members</span>
                                    <button @click="docViewOpen = !docViewOpen" class="text-blue-600 hover:underline">
                                        View
                                    </button>
                                </div>
                                <div class="flex items-center p-2 border rounded" x-data="{ docViewOpen: false }">
                                    <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span class="flex-grow">Business Plan</span>
                                    <button @click="docViewOpen = !docViewOpen" class="text-blue-600 hover:underline">
                                        View
                                    </button>
                                </div>
                            </div>
                        </template>

                        <template x-if="applicationType === 'Renewal'">
                            <div class="space-y-2">
                                <div class="flex items-center p-2 border rounded" x-data="{ docViewOpen: false }">
                                    <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span class="flex-grow">Previous Accreditation Certificate</span>
                                    <button @click="docViewOpen = !docViewOpen" class="text-blue-600 hover:underline">
                                        View
                                    </button>
                                </div>
                                <div class="flex items-center p-2 border rounded" x-data="{ docViewOpen: false }">
                                    <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span class="flex-grow">Annual Report</span>
                                    <button @click="docViewOpen = !docViewOpen" class="text-blue-600 hover:underline">
                                        View
                                    </button>
                                </div>
                                <div class="flex items-center p-2 border rounded" x-data="{ docViewOpen: false }">
                                    <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span class="flex-grow">Updated List of Members</span>
                                    <button @click="docViewOpen = !docViewOpen" class="text-blue-600 hover:underline">
                                        View
                                    </button>
                                </div>
                                <div class="flex items-center p-2 border rounded" x-data="{ docViewOpen: false }">
                                    <svg class="w-5 h-5 mr-2 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                    <span class="flex-grow">Financial Statements (Pending Verification)</span>
                                    <button @click="docViewOpen = !docViewOpen" class="text-blue-600 hover:underline">
                                        View
                                    </button>
                                </div>
                            </div>
                        </template>

                        <template x-if="applicationType === 'Certificate of Good Standing'">
                            <div class="space-y-2">
                                <div class="flex items-center p-2 border rounded" x-data="{ docViewOpen: false }">
                                    <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span class="flex-grow">Proof of Compliance with Laws and Regulations</span>
                                    <button @click="docViewOpen = !docViewOpen" class="text-blue-600 hover:underline">
                                        View
                                    </button>
                                </div>
                                <div class="flex items-center p-2 border rounded" x-data="{ docViewOpen: false }">
                                    <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span class="flex-grow">Tax Clearance</span>
                                    <button @click="docViewOpen = !docViewOpen" class="text-blue-600 hover:underline">
                                        View
                                    </button>
                                </div>
                                <div class="flex items-center p-2 border rounded" x-data="{ docViewOpen: false }">
                                    <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span class="flex-grow">Audited Financial Statements</span>
                                    <button @click="docViewOpen = !docViewOpen" class="text-blue-600 hover:underline">
                                        View
                                    </button>
                                </div>
                            </div>
                        </template>
                    </div>

                    <!-- Remarks Section -->
                    <div class="mb-6">
                        <h4 class="font-bold text-lg text-gray-800 mb-3">Verification Remarks</h4>
                        <textarea
                            class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition"
                            rows="3"
                            placeholder="Enter your verification comments here..."
                            x-model="approvalRemarks"></textarea>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-wrap justify-end gap-3">
                        <button class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition"
                            @click="showApprovalForm = false">
                            Close
                        </button>
                        <button class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition"
                            @click="rejectApplication(trxRef)">
                            Reject
                        </button>
                        <button class="px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600 transition"
                            @click="requestAdditionalDocuments(trxRef)">
                            Request More Info
                        </button>
                        <button class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition"
                            @click="approveApplication(trxRef)">
                            Approve
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function approvalManagement() {
            return {
                showApprovalForm: false,
                trxRef: '',
                reviewerName: '',
                submissionTime: '',
                reviewTime: '',
                applicationType: '',
                approvalRemarks: '',
                searchQuery: '',
                statusFilter: 'all',
                originalData: {},
                newData: {},

                requests: [
                    {
                        trxRef: 'TRX-2025-001',
                        cooperativeName: 'Sunshine Transport Cooperative',
                        applicationType: 'Accreditation',
                        isModified: false,
                        hasDocuments: true,
                        submissionTime: '2025-03-01 09:30 AM',
                        reviewTime: '',
                        newData: {
                            transportationName: 'Sunshine Transport Cooperative',
                            registrationNumber: 'REG-2025-001',
                            address: '123 Main St, Quezon City',
                            contactPerson: 'Juan Dela Cruz',
                            contactNumber: '09123456789',
                            email: 'sunshine@example.com',
                            routesServiced: 'Cubao - Montalban',
                            fleetSize: '25 units'
                        }
                    },
                    {
                        trxRef: 'TRX-2025-002',
                        cooperativeName: 'Moonlight Transport Cooperative',
                        applicationType: 'Renewal',
                        isModified: true,
                        hasDocuments: true,
                        submissionTime: '2025-02-25 11:15 AM',
                        reviewTime: '2025-02-28 03:45 PM',
                        originalData: {
                            transportationName: 'Moonlight Transport Cooperative',
                            registrationNumber: 'REG-2024-042',
                            address: '456 Oak St, Makati City',
                            contactPerson: 'Roberto Reyes',
                            contactNumber: '09187654321',
                            email: 'moonlight@example.com',
                            routesServiced: 'SM North - Fairview',
                            fleetSize: '15 units'
                        },
                        newData: {
                            transportationName: 'Moonlight Transport Cooperative',
                            registrationNumber: 'REG-2024-042',
                            address: '456 Oak St, Makati City',
                            contactPerson: 'Roberto Reyes',
                            contactNumber: '09187654321',
                            email: 'moonlight@example.com',
                            routesServiced: 'SM North - Fairview, Cubao - Fairview',
                            fleetSize: '18 units'
                        }
                    },
                    {
                        trxRef: 'TRX-2025-003',
                        cooperativeName: 'Starlight Transport Cooperative',
                        applicationType: 'Certificate of Good Standing',
                        isModified: false,
                        hasDocuments: true,
                        submissionTime: '2025-02-20 10:00 AM',
                        reviewTime: '',
                        newData: {
                            transportationName: 'Starlight Transport Cooperative',
                            registrationNumber: 'REG-2024-078',
                            address: '789 Pine St, Marikina City',
                            contactPerson: 'Ana Gonzales',
                            contactNumber: '09765432101',
                            email: 'starlight@example.com',
                            routesServiced: 'Marikina - Quiapo',
                            fleetSize: '30 units'
                        }
                    },
                    {
                        trxRef: 'TRX-2025-004',
                        cooperativeName: 'Pacific Transport Cooperative',
                        applicationType: 'Accreditation',
                        isModified: false,
                        hasDocuments: true,
                        submissionTime: '2025-03-02 08:45 AM',
                        reviewTime: '',
                        newData: {
                            transportationName: 'Pacific Transport Cooperative',
                            registrationNumber: 'REG-2025-005',
                            address: '101 Beach St, Pasig City',
                            contactPerson: 'Eduardo Santos',
                            contactNumber: '09234567890',
                            email: 'pacific@example.com',
routesServiced: 'Pasig - Quiapo, Pasig - Cubao',
fleetSize: '22 units'
}
},
{
    trxRef: 'TRX-2025-005',
    cooperativeName: 'Golden Transport Cooperative',
    applicationType: 'Renewal',
    isModified: true,
    hasDocuments: true,
    submissionTime: '2025-02-22 14:30 PM',
    reviewTime: '2025-02-24 10:15 AM',
    originalData: {
        transportationName: 'Golden Transport Cooperative',
        registrationNumber: 'REG-2023-112',
        address: '555 Gold St, Mandaluyong City',
        contactPerson: 'Maria Lim',
        contactNumber: '09345678912',
        email: 'golden@example.com',
        routesServiced: 'Mandaluyong - Divisoria',
        fleetSize: '20 units'
    },
    newData: {
        transportationName: 'Golden Transport Cooperative',
        registrationNumber: 'REG-2023-112',
        address: '555 Gold St, Mandaluyong City',
        contactPerson: 'Maria Lim',
        contactNumber: '09345678912',
        email: 'golden@example.com',
        routesServiced: 'Mandaluyong - Divisoria, Mandaluyong - Makati',
        fleetSize: '25 units'
    }
}
],

filteredRequests() {
    return this.requests.filter(request => {
        // Text search
        const matchesSearch = this.searchQuery === '' ||
            request.trxRef.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
            request.cooperativeName.toLowerCase().includes(this.searchQuery.toLowerCase());

        // Status filter
        let matchesStatus = this.statusFilter === 'all';

        if (this.statusFilter === 'accreditation') {
            matchesStatus = request.applicationType === 'Accreditation';
        } else if (this.statusFilter === 'renewal') {
            matchesStatus = request.applicationType === 'Renewal';
        } else if (this.statusFilter === 'cgs') {
            matchesStatus = request.applicationType === 'Certificate of Good Standing';
        } else if (this.statusFilter === 'verified') {
            matchesStatus = request.reviewTime !== '';
        } else if (this.statusFilter === 'pending') {
            matchesStatus = request.reviewTime === '';
        }

        return matchesSearch && matchesStatus;
    });
},

reviewTransaction(trxRef) {
    const request = this.requests.find(r => r.trxRef === trxRef);
    if (request) {
        this.trxRef = request.trxRef;
        this.submissionTime = request.submissionTime;
        this.reviewTime = request.reviewTime || '';
        this.applicationType = request.applicationType;
        this.originalData = request.originalData || {};
        this.newData = request.newData || {};
        this.approvalRemarks = '';
        this.showApprovalForm = true;
    }
},

approveApplication(trxRef) {
    const index = this.requests.findIndex(r => r.trxRef === trxRef);
    if (index !== -1) {
        this.requests[index].reviewTime = new Date().toLocaleString();
        alert(`Application ${trxRef} has been approved!`);
        this.showApprovalForm = false;
    }
},

rejectApplication(trxRef) {
    if (confirm('Are you sure you want to reject this application?')) {
        const index = this.requests.findIndex(r => r.trxRef === trxRef);
        if (index !== -1) {
            // In a real app, you'd likely mark it as rejected instead of removing
            this.requests.splice(index, 1);
            alert(`Application ${trxRef} has been rejected.`);
            this.showApprovalForm = false;
        }
    }
},

requestAdditionalDocuments(trxRef) {
    const remarks = this.approvalRemarks.trim();
    if (remarks === '') {
        alert('Please provide remarks specifying what additional information is needed.');
        return;
    }

    alert(`Request for additional information sent for ${trxRef}. The applicant will be notified.`);
    this.showApprovalForm = false;
}
};
}
</script>
</div>
