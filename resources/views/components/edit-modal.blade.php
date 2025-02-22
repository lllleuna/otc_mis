<div x-show="showEditModal" class="fixed inset-0 flex items-center justify-center z-50 overflow-auto">
    <div class="absolute inset-0 bg-black opacity-50"></div>
    <div class="bg-white rounded-lg shadow-lg z-50 w-11/12 md:w-3/4 lg:w-1/2 m-4 relative max-h-screen overflow-y-auto p-5">
        <button @click="closeEdit()" class="absolute top-2 right-2 text-gray-600 hover:text-gray-800">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <h2 class="text-xl font-bold mb-4">Edit Details</h2>
        <div class="space-y-6">
            <div>
                <h3 class="font-semibold text-lg mb-2 border-b pb-1">Transaction & Applicant Details</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block font-medium mb-1 text-sm">Transaction Reference</label>
                        <input type="text" class="w-full border rounded-md p-2"
                               x-model="transactionData['Transaction Reference']">
                    </div>
                    <div>
                        <label class="block font-medium mb-1 text-sm">Accreditation Number</label>
                        <input type="text" class="w-full border rounded-md p-2"
                               x-model="transactionData['Accreditation Number']">
                    </div>
                    <div>
                        <label class="block font-medium mb-1 text-sm">Date Created</label>
                        <input type="text" class="w-full border rounded-md p-2 bg-gray-100"
                               x-model="transactionData['Date Created']" disabled>
                    </div>
                    <div>
                        <label class="block font-medium mb-1 text-sm">Cooperative</label>
                        <input type="text" class="w-full border rounded-md p-2"
                               x-model="transactionData['Cooperative']">
                    </div>
                    <div>
                        <label class="block font-medium mb-1 text-sm">Submitted Documents</label>
                        <a :href="`/downloads/${transactionData['Submitted Documents']}`"
                           class="block w-full border rounded-md p-2 bg-gray-100 text-blue-600 hover:underline"
                           target="_blank" download
                           x-text="transactionData['Submitted Documents']"></a>
                    </div>
                    <div>
                        <label class="block font-medium mb-1 text-sm">Applicant Name</label>
                        <input type="text" class="w-full border rounded-md p-2"
                               x-model="applicantData['Applicant Name']">
                    </div>
                    <div>
                        <label class="block font-medium mb-1 text-sm">Email</label>
                        <input type="text" class="w-full border rounded-md p-2"
                               x-model="applicantData['Email']">
                    </div>
                    <div>
                        <label class="block font-medium mb-1 text-sm">Contact</label>
                        <input type="text" class="w-full border rounded-md p-2"
                               x-model="applicantData['Contact']">
                    </div>
                </div>
            </div>
            <div>
                <h3 class="font-semibold text-lg mb-2 border-b pb-1">Processing & Status Updates</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block font-medium mb-1 text-sm">Current Status</label>
                        <input type="text" class="w-full border rounded-md p-2 bg-gray-100"
                               x-model="processingData['Current Status']" disabled>
                    </div>
                    <div>
                        <label class="block font-medium mb-1 text-sm">Remarks</label>
                        <input type="text" class="w-full border rounded-md p-2"
                               x-model="processingData['Remarks']" placeholder="Enter officer remarks">
                    </div>
                    <div>
                        <label class="block font-medium mb-1 text-sm">Attachments</label>
                        <input type="text" class="w-full border rounded-md p-2"
                               x-model="processingData['Attachments']">
                    </div>
                    <div>
                        <label class="block font-medium mb-1 text-sm">Log & History</label>
                        <table class="w-full text-xs border">
                            <tr class="border-b" x-for="(log, index) in logData" :key="index">
                                <td class="p-2" x-text="log"></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-6 flex justify-end space-x-4">
            <button @click="updateData(); closeEdit();" class="px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                Update
            </button>
            <button @click="saveEdit()" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Send
            </button>
        </div>
    </div>
</div>
