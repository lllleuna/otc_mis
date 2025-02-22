<div class="w-64 p-5 bg-white border rounded-lg shadow flex-shrink-0">
    <ul class="space-y-4">
        <li>
            <span class="block p-5 rounded-lg bg-blue-900 text-white">
                Transaction Details
            </span>
        </li>
        <li>
            <span class="block p-5 rounded-lg bg-gray-100 text-gray-700 cursor-pointer hover:bg-blue-100 transition-colors"
                  :class="{'font-bold': tab === 'transaction'}"
                  @click="setTab('transaction')">
                Transaction & Applicant Details
            </span>
        </li>
        <li>
            <span class="block p-5 rounded-lg bg-gray-100 text-gray-700 cursor-pointer hover:bg-blue-100 transition-colors"
                  :class="{'font-bold': tab === 'processing'}"
                  @click="setTab('processing')">
                Processing & Status Updates
            </span>
        </li>
        <li>
            <div class="relative">
                <button class="block w-full p-5 rounded-lg bg-gray-100 text-gray-700 cursor-pointer hover:bg-blue-100 transition-colors flex justify-between items-center"
                        @click="tab === 'transactionType' ? tab = '' : tab = 'transactionType'">
                    Transaction Type
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="tab === 'transactionType'" class="mt-1 w-full bg-white border rounded-lg shadow-lg z-10">
                    <ul class="py-2">
                        <li @click="showAccreditationDetails()" class="px-4 py-2 hover:bg-blue-100 cursor-pointer">Accreditation</li>
                        <li @click="showCGSRequestDetails()" class="px-4 py-2 hover:bg-blue-100 cursor-pointer">Certificate of Good Standing (CGS) Request</li>
                        <li @click="showTrainingDetails()" class="px-4 py-2 hover:bg-blue-100 cursor-pointer">Training</li>
                    </ul>
                </div>
            </div>
        </li>
    </ul>
</div>
