<div
    x-show="showApprovalForm"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-50 overflow-y-auto"
    style="display: none;"
>
    <div class="flex items-center justify-center min-h-screen px-4 py-8">
        <!-- Background overlay -->
        <div
            class="fixed inset-0 bg-gray-900 opacity-50"
            @click="showApprovalForm = false"
        ></div>

        <!-- Modal panel -->
        <div
            class="relative w-full max-w-6xl mx-auto bg-white rounded-xl shadow-2xl overflow-hidden"
            @click.away="showApprovalForm = false"
        >
            <div class="p-6 bg-white">
                <div class="flex items-center justify-between border-b pb-4 mb-6">
                    <h3 class="text-xl font-bold text-gray-800">
                        Cooperative Information Edit - <span x-text="trxRef" class="text-blue-600"></span>
                    </h3>
                    <button
                        @click="showApprovalForm = false"
                        class="text-gray-400 hover:text-gray-600 transition-colors"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Information Sections -->
                <div class="space-y-6">
                    <!-- Cooperative Identity Changes -->
                    <div class="bg-gray-50 rounded-lg p-5 border border-gray-200 shadow-sm">
                        <h4 class="text-lg font-semibold text-gray-800 border-b border-gray-200 pb-3 mb-4">Cooperative Identity</h4>
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <h5 class="text-sm font-semibold text-gray-700 mb-3 border-b pb-2">Before Changes</h5>
                                <div class="space-y-3">
                                    <div>
                                        <p class="text-xs text-gray-500">Transport Cooperative Name</p>
                                        <p class="text-sm text-gray-700">Sample Transport Cooperative</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Short Name</p>
                                        <p class="text-sm text-gray-700">STC</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Common Bond of Membership</p>
                                        <p class="text-sm text-gray-700">Drivers and Operators</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Membership Fee</p>
                                        <p class="text-sm text-gray-700">500</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <h5 class="text-sm font-semibold text-gray-700 mb-3 border-b pb-2">After Changes</h5>
                                <div class="space-y-3">
                                    <div>
                                        <p class="text-xs text-gray-500">Transport Cooperative Name</p>
                                        <p class="text-sm text-green-600 font-semibold">Sample Transport Cooperative Updated</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Short Name</p>
                                        <p class="text-sm text-gray-700">STC</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Common Bond of Membership</p>
                                        <p class="text-sm text-green-600 font-semibold">Drivers, Operators, and Allied Workers</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Membership Fee</p>
                                        <p class="text-sm text-green-600 font-semibold">600</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Registration & Accreditation Changes -->
                    <div class="bg-gray-50 rounded-lg p-5 border border-gray-200 shadow-sm">
                        <h4 class="text-lg font-semibold text-gray-800 border-b border-gray-200 pb-3 mb-4">Registration & Accreditation</h4>
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <h5 class="text-sm font-semibold text-gray-700 mb-3 border-b pb-2">Before Changes</h5>
                                <div class="space-y-3">
                                    <div>
                                        <p class="text-xs text-gray-500">OTC Accreditation Number</p>
                                        <p class="text-sm text-gray-700">OTC123456</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Type of Accreditation</p>
                                        <p class="text-sm text-gray-700">Provisional</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">OTC Accreditation Date</p>
                                        <p class="text-sm text-gray-700">01/15/2023</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Cooperative Registration Number</p>
                                        <p class="text-sm text-gray-700">REG123456</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">CDA Registration Date</p>
                                        <p class="text-sm text-gray-700">05/20/2022</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <h5 class="text-sm font-semibold text-gray-700 mb-3 border-b pb-2">After Changes</h5>
                                <div class="space-y-3">
                                    <div>
                                        <p class="text-xs text-gray-500">OTC Accreditation Number</p>
                                        <p class="text-sm text-green-600 font-semibold">OTC123456</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Type of Accreditation</p>
                                        <p class="text-sm text-green-600 font-semibold">Regular</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">OTC Accreditation Date</p>
                                        <p class="text-sm text-green-600 font-semibold">02/15/2024</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Cooperative Registration Number</p>
                                        <p class="text-sm text-gray-700">REG123456</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">CDA Registration Date</p>
                                        <p class="text-sm text-gray-700">05/20/2022</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Information Changes -->
                    <div class="bg-gray-50 rounded-lg p-5 border border-gray-200 shadow-sm">
                        <h4 class="text-lg font-semibold text-gray-800 border-b border-gray-200 pb-3 mb-4">Contact Information</h4>
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <h5 class="text-sm font-semibold text-gray-700 mb-3 border-b pb-2">Before Changes</h5>
                                <div class="space-y-3">
                                    <div>
                                        <p class="text-xs text-gray-500">Contact Person</p>
                                        <p class="text-sm text-gray-700">Juan Dela Cruz</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Business Address</p>
                                        <p class="text-sm text-gray-700">123 Transport St., City</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Email</p>
                                        <p class="text-sm text-gray-700">contact@samplecoop.com</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Contact Numbers</p>
                                        <p class="text-sm text-gray-700">0917-123-4567</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <h5 class="text-sm font-semibold text-gray-700 mb-3 border-b pb-2">After Changes</h5>
                                <div class="space-y-3">
                                    <div>
                                        <p class="text-xs text-gray-500">Contact Person</p>
                                        <p class="text-sm text-green-600 font-semibold">Maria Santos</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Business Address</p>
                                        <p class="text-sm text-green-600 font-semibold">456 Cooperative Ave., New City</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Email</p>
                                        <p class="text-sm text-green-600 font-semibold">newcontact@samplecoop.com</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Contact Numbers</p>
                                        <p class="text-sm text-green-600 font-semibold">0918-987-6543</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Editing Details Section -->
                    <div class="bg-blue-50 rounded-lg p-5 border border-blue-200 shadow-sm">
                        <h4 class="text-lg font-semibold text-gray-800 border-b border-gray-200 pb-3 mb-4">Edit Information</h4>
                        <div class="grid md:grid-cols-3 gap-4">
                            <div>
                                <p class="text-sm text-gray-600">Editor Name</p>
                                <p class="text-sm font-medium text-gray-800">JM Cruz</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Edit Time/Date</p>
                                <p class="text-sm font-medium text-gray-800">8:47 PM - 3/4/2025</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Edit Reason</p>
                                <p class="text-sm font-medium text-gray-800">They want to update their information</p>
                            </div>
                        </div>
                    </div>

                    <!-- Approval Form -->
                    <form @submit.prevent="submitApproval" class="bg-gray-50 rounded-lg p-5 border border-gray-200 shadow-sm">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Approval Status</label>
                                <select
                                    x-model="approvalStatus"
                                    class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                >
                                    <option value="approved">Approved</option>
                                    <option value="rejected">Rejected</option>
                                    <option value="pending">Pending Further Review</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Approval Remarks</label>
                                <textarea
                                    x-model="approvalRemarks"
                                    placeholder="Provide detailed remarks about your decision"
                                    class="w-full p-3 border border-gray-300 rounded-md h-32 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                ></textarea>
                            </div>
                        </div>

                        <div class="flex justify-end space-x-3 mt-6">
                            <button
                                type="button"
                                @click="showApprovalForm = false"
                                class="px-6 py-2 text-gray-600 bg-white border border-gray-300 rounded-md hover:bg-gray-100 transition"
                            >
                                Cancel
                            </button>
                            <button
                                type="submit"
                                class="px-6 py-2 text-white bg-blue-900 rounded-md disabled:opacity-90 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition"
                            >
                                Submit Approval
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
