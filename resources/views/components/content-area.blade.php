<div class="flex-1 bg-white rounded-lg shadow-lg p-5 relative flex flex-col">
    <div class="absolute top-4 right-4">
        <a href="#" class="text-blue-600 hover:underline" @click.prevent="openEdit()">Edit</a>
    </div>

    <template x-if="searchQuery.length > 0">
        <div class="space-y-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Search Results</h2>
            <template x-if="filteredContent().length > 0">
                <ul class="space-y-2">
                    <template x-for="(item, index) in filteredContent()" :key="index">
                        <li class="p-3 border rounded-lg cursor-pointer hover:bg-blue-50"
                            @click="selectResult(item)">
                            <span class="font-medium" x-text="item.value"></span>
                        </li>
                    </template>
                </ul>
            </template>
            <template x-if="filteredContent().length == 0">
                <p class="text-gray-500 p-5 border rounded-lg">Not Found</p>
            </template>
        </div>
    </template>

    <template x-if="!searchQuery">
        <div class="flex-1">
            <template x-if="tab === 'transaction'">
                <div class="space-y-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Transaction & Applicant Details</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-3">
                            <div class="p-5 border rounded-lg">
                                <span class="font-medium">Transaction Reference</span>
                                <div class="text-gray-600 mt-2" x-text="transactionData['Transaction Reference']"></div>
                            </div>
                            <div class="p-5 border rounded-lg">
                                <span class="font-medium">Accreditation Number</span>
                                <div class="text-gray-600 mt-2" x-text="transactionData['Accreditation Number']"></div>
                            </div>
                            <div class="p-5 border rounded-lg">
                                <span class="font-medium">Date Created</span>
                                <div class="text-gray-600 mt-2" x-text="transactionData['Date Created']"></div>
                            </div>
                            <div class="p-5 border rounded-lg">
                                <span class="font-medium">Cooperative</span>
                                <div class="text-gray-600 mt-2" x-text="transactionData['Cooperative']"></div>
                            </div>
                            <div class="p-5 border rounded-lg">
                                <span class="font-medium">Submitted Documents</span>
                                <div class="text-gray-600 mt-2">
                                    <a :href="`/downloads/${transactionData['Submitted Documents']}`"
                                       class="text-blue-600 hover:underline"
                                       target="_blank" download
                                       x-text="transactionData['Submitted Documents']"></a>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <div class="p-5 border rounded-lg">
                                <span class="font-medium">Applicant Name</span>
                                <div class="text-gray-600 mt-2" x-text="applicantData['Applicant Name']"></div>
                            </div>
                            <div class="p-5 border rounded-lg">
                                <span class="font-medium">Email</span>
                                <div class="text-gray-600 mt-2" x-text="applicantData['Email']"></div>
                            </div>
                            <div class="p-5 border rounded-lg">
                                <span class="font-medium">Contact</span>
                                <div class="text-gray-600 mt-2" x-text="applicantData['Contact']"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </template>

            <template x-if="tab === 'processing'">
                <div class="space-y-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Processing & Status Updates</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-3">
                            <div class="p-5 border rounded-lg">
                                <span class="font-medium">Current Status</span>
                                <div class="text-gray-600 mt-2" x-text="processingData['Current Status']"></div>
                            </div>
                            <div class="p-5 border rounded-lg">
                                <span class="font-medium">Remarks</span>
                                <div class="text-gray-600 mt-2" x-text="processingData['Remarks']"></div>
                            </div>
                            <div class="p-5 border rounded-lg">
                                <span class="font-medium">Attachments</span>
                                <div class="text-gray-600 mt-2" x-text="processingData['Attachments']"></div>
                            </div>
                        </div>
                        <div class="p-5 border rounded-lg">
                            <h3 class="font-medium mb-3">Log & History</h3>
                            <table class="w-full text-xs">
                                <tr class="border-b" x-for="(log, index) in logData" :key="index">
                                    <td class="p-5" x-text="log"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </template>

            <template x-if="tab === 'accreditation'">
                <div class="space-y-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Accreditation Details</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="p-5 border rounded-lg">
                            <h3 class="font-medium">Cooperative Information</h3>
                            <p><strong>Name:</strong> <span x-text="accreditationData['Cooperative Information'].Name"></span></p>
                            <p><strong>Address:</strong> <span x-text="accreditationData['Cooperative Information'].Address"></span></p>
                            <p><strong>Contact Details:</strong> <span x-text="accreditationData['Cooperative Information']['Contact Details']"></span></p>
                        </div>
                        <div class="p-5 border rounded-lg">
                            <h3 class="font-medium">Registration Details</h3>
                            <p><strong>CDA Registration No.:</strong> <span x-text="accreditationData['Registration Details']['CDA Registration No.']"></span></p>
                            <p><strong>Date of Registration:</strong> <span x-text="accreditationData['Registration Details']['Date of Registration']"></span></p>
                        </div>
                        <div class="p-5 border rounded-lg">
                            <h3 class="font-medium">Officers & Board Members</h3>
                            <ul>
                                <template x-for="(officer, index) in accreditationData['Officers & Board Members']" :key="index">
                                    <li>
                                        <strong x-text="officer.Name"></strong> - <span x-text="officer.Position"></span> (Contact: <span x-text="officer['Contact Info']"></span>)
                                    </li>
                                </template>
                            </ul>
                        </div>
                        <div class="p-5 border rounded-lg">
                            <h3 class="font-medium">Financial Information</h3>
                            <p x-text="accreditationData['Financial Information']"></p>
                        </div>
                        <div class="p-5 border rounded-lg">
                            <h3 class="font-medium">Operational Details</h3>
                            <p><strong>Type of Services:</strong> <span x-text="accreditationData['Operational Details']['Type of Services']"></span></p>
                            <p><strong>Area of Operation:</strong> <span x-text="accreditationData['Operational Details']['Area of Operation']"></span></p>
                        </div>
                        <div class="p-5 border rounded-lg">
                            <h3 class="font-medium">Required Documents</h3>
                            <ul>
                                <template x-for="(doc, index) in accreditationData['Required Documents']" :key="index">
                                    <li x-text="doc"></li>
                                </template>
                            </ul>
                        </div>
                    </div>
                </div>
            </template>

            <template x-if="tab === 'cgsRequest'">
                <div class="space-y-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Certificate of Good Standing (CGS) Request</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="p-5 border rounded-lg">
                            <h3 class="font-medium">Cooperative Name & Registration No.</h3>
                            <p><strong>Name:</strong> <span x-text="cgRequestData['Cooperative Name']"></span></p>
                            <p><strong>Registration No.:</strong> <span x-text="cgRequestData['Registration No.']"></span></p>
                        </div>
                        <div class="p-5 border rounded-lg">
                            <h3 class="font-medium">Proof of Compliance</h3>
                            <p x-text="cgRequestData['Proof of Compliance']"></p>
                        </div>
                        <div class="p-5 border rounded-lg">
                            <h3 class="font-medium">Authorized Representative Details</h3>
                            <p><strong>Name:</strong> <span x-text="cgRequestData['Authorized Representative'].Name"></span></p>
                            <p><strong>Position:</strong> <span x-text="cgRequestData['Authorized Representative'].Position"></span></p>
                            <p><strong>Contact Info:</strong> <span x-text="cgRequestData['Authorized Representative']['Contact Info']"></span></p>
                        </div>
                        <div class="p-5 border rounded-lg">
                            <h3 class="font-medium">Purpose of Request</h3>
                            <p x-text="cgRequestData['Purpose of Request']"></p>
                        </div>
                    </div>
                </div>
            </template>

            <template x-if="tab === 'training'">
                <div class="space-y-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Training Details</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="p-5 border rounded-lg">
                            <h3 class="font-medium">Cooperative Name & Registration No.</h3>
                            <p><strong>Name:</strong> <span x-text="trainingData['Cooperative Name']"></span></p>
                            <p><strong>Registration No.:</strong> <span x-text="trainingData['Registration No.']"></span></p>
                        </div>
                        <div class="p-5 border rounded-lg">
                            <h3 class="font-medium">Trainee Information</h3>
                            <p><strong>Name:</strong> <span x-text="trainingData['Trainee Information'].Name"></span></p>
                            <p><strong>Position:</strong> <span x-text="trainingData['Trainee Information'].Position"></span></p>
                            <p><strong>Contact Details:</strong> <span x-text="trainingData['Trainee Information']['Contact Details']"></span></p>
                        </div>
                        <div class="p-5 border rounded-lg">
                            <h3 class="font-medium">Training Type & Schedule</h3>
                            <p x-text="trainingData['Training Type & Schedule']"></p>
                        </div>
                        <div class="p-5 border rounded-lg">
                            <h3 class="font-medium">Payment Details</h3>
                            <p x-text="trainingData['Payment Details']"></p>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </template>
</div>
