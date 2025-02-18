<!-- General Information Edit Modal -->
<div
    x-show="showEditGeneralModal"
    @click.away="closeEditGeneralModal"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform scale-90"
    x-transition:enter-end="opacity-100 transform scale-100"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 transform scale-100"
    x-transition:leave-end="opacity-0 transform scale-90"
    class="fixed inset-0 z-10 overflow-y-auto"
    style="display: none;"
>
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div
            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
            role="dialog"
            aria-modal="true"
            aria-labelledby="modal-headline"
        >
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
                            Edit
                        </h3>
                        <div class="mt-4">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">OTC Accreditation Number</label>
                                    <input type="text" x-model="cooperativeData['general'][0].value" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">Transport Cooperative Name</label>
                                    <input type="text" x-model="cooperativeData['general'][1].value" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">Short Name</label>
                                    <input type="text" x-model="cooperativeData['general'][2].value" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">OTC Accreditation Date</label>
                                    <input type="date" x-model="cooperativeData['general'][3].value" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">Type of Accreditation</label>
                                    <select x-model="cooperativeData['general'][4].value" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                        <option value="Full">Full</option>
                                        <option value="Provisional">Provisional</option>
                                        <option value="Temporary">Temporary</option>
                                        <option value="Suspended">Suspended</option>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">Cooperative Registration Number</label>
                                    <input type="text" x-model="cooperativeData['general'][5].value" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">CDA Registration Date</label>
                                    <input type="date" x-model="cooperativeData['general'][6].value" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">Common Bond of Membership</label>
                                    <input type="text" x-model="cooperativeData['general'][7].value" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">Membership Fee (per by-laws)</label>
                                    <input type="text" x-model="cooperativeData['general'][8].value" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">Area</label>
                                    <input type="text" x-model="cooperativeData['general'][9].value" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">Region</label>
                                    <input type="text" x-model="cooperativeData['general'][10].value" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">City</label>
                                    <input type="text" x-model="cooperativeData['general'][11].value" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">Province / Sector</label>
                                    <input type="text" x-model="cooperativeData['general'][12].value" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">Barangay</label>
                                    <input type="text" x-model="cooperativeData['general'][13].value" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">Business Address</label>
                                    <input type="text" x-model="cooperativeData['general'][14].value" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">E-mail</label>
                                    <input type="email" x-model="cooperativeData['general'][15].value" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">Contact Numbers</label>
                                    <input type="text" x-model="cooperativeData['general'][16].value" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">CONTACT'S FIRST NAME</label>
                                    <input type="text" x-model="cooperativeData['general'][17].value" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">CONTACT'S LAST NAME</label>
                                    <input type="text" x-model="cooperativeData['general'][18].value" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">CONTACT'S M.I. (if applicable)</label>
                                    <input type="text" x-model="cooperativeData['general'][19].value" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">CONTACT'S SUFFIX (if applicable)</label>
                                    <input type="text" x-model="cooperativeData['general'][20].value" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">SSS Employer Registration Number</label>
                                    <input type="text" x-model="cooperativeData['general'][21].value" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">No. Of SSS Enrolled Employees</label>
                                    <input type="number" x-model="cooperativeData['general'][22].value" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">Pag-IBIG Employer Registration Number</label>
                                    <input type="text" x-model="cooperativeData['general'][23].value" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">No. Of Pag-IBIG Enrolled Employees</label>
                                    <input type="number" x-model="cooperativeData['general'][24].value" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">PhilHealth Employer Registration Number</label>
                                    <input type="text" x-model="cooperativeData['general'][25].value" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">No. Of PhilHealth Enrolled Employees</label>
                                    <input type="number" x-model="cooperativeData['general'][26].value" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">BIR TIN Number</label>
                                    <input type="text" x-model="cooperativeData['general'][27].value" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">BIR Tax Exemption Number</label>
                                    <input type="text" x-model="cooperativeData['general'][28].value" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">BIR Tax Exemption Validity Date</label>
                                    <input type="date" x-model="cooperativeData['general'][29].value" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">Latest Date of Assess and Assist Activity</label>
                                    <input type="date" x-model="cooperativeData['general'][30].value" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">Latest Date of Financial Management Assistance (FMA)</label>
                                    <input type="date" x-model="cooperativeData['general'][31].value" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button
                    type="button"
                    @click="saveEditGeneral()"
                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm"
                >
                    Save
                </button>
                <button
                    type="button"
                    @click="closeEditGeneralModal()"
                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                >
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Membership Information Edit Modal -->
<div
    x-show="showEditMembershipModal"
    @click.away="closeEditMembershipModal"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform scale-90"
    x-transition:enter-end="opacity-100 transform scale-100"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 transform scale-100"
    x-transition:leave-end="opacity-0 transform scale-90"
    class="fixed inset-0 z-10 overflow-y-auto"
    style="display: none;"
>
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div
            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
            role="dialog"
            aria-modal="true"
            aria-labelledby="modal-headline"
        >
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
                            Edit Membership Information
                        </h3>
                        <div class="mt-4">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <template x-for="(item, index) in cooperativeData['membership']" :key="index">
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700" x-text="item.label"></label>
                                        <template x-if="item.label === 'Total Male Drivers' || item.label === 'Total Female Drivers'">
                                            <div class="grid grid-cols-2 gap-4">
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700">F</label>
                                                    <input
                                                        type="number"
                                                        x-model="cooperativeData['membership'][3].value"  <!-- Total Female Drivers -->
                                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                                    />
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700">M</label>
                                                    <input
                                                        type="number"
                                                        x-model="cooperativeData['membership'][4].value"  <!-- Total Male Drivers -->
                                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                                    />
                                                </div>
                                            </div>
                                        </template>
                                        <template x-if="item.label !== 'Total Male Drivers' && item.label !== 'Total Female Drivers'">
                                            <input
                                                type="text"
                                                x-model="item.value"
                                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                            />
                                        </template>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button
                    type="button"
                    @click="saveEditMembership()"
                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm"
                >
                    Save
                </button>
                <button
                    type="button"
                    @click="closeEditMembershipModal()"
                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                >
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>
