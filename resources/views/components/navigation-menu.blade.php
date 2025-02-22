<div class="w-64 bg-white rounded-lg shadow-lg overflow-hidden">
    <div class="p-4 bg-blue-900 text-white text-center">
        <h2 class="font-semibold">Transaction Details</h2>
    </div>
    <nav class="p-2">
        <!-- General Information -->
        <div class="mb-2">
            <button @click="menus.generalInfo = !menus.generalInfo"
                class="w-full px-4 py-3 text-left rounded-lg flex items-center justify-between hover:bg-gray-50">
                <span class="font-medium text-gray-700">General Information</span>
                <svg xmlns="http://www.w3.org/2000/svg"
                    :class="menus.generalInfo ? 'transform rotate-90' : ''"
                    class="w-5 h-5 transition-transform"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
            <div x-show="menus.generalInfo" class="ml-4">
                <!-- Content for General Information -->
            </div>
        </div>

        <!-- Applicant Information -->
        <div class="mb-2">
            <button @click="menus.applicantInfo = !menus.applicantInfo"
                class="w-full px-4 py-3 text-left rounded-lg flex items-center justify-between hover:bg-gray-50">
                <span class="font-medium text-gray-700">Applicant Information</span>
                <svg xmlns="http://www.w3.org/2000/svg"
                    :class="menus.applicantInfo ? 'transform rotate-90' : ''"
                    class="w-5 h-5 transition-transform"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
            <div x-show="menus.applicantInfo" class="ml-4">
                <!-- Content for Applicant Information -->
            </div>
        </div>

        <!-- Processing Status -->
        <div class="mb-2">
            <button @click="menus.processingStatus = !menus.processingStatus"
                class="w-full px-4 py-3 text-left rounded-lg flex items-center justify-between hover:bg-gray-50">
                <span class="font-medium text-gray-700">Processing Status</span>
                <svg xmlns="http://www.w3.org/2000/svg"
                    :class="menus.processingStatus ? 'transform rotate-90' : ''"
                    class="w-5 h-5 transition-transform"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
            <div x-show="menus.processingStatus" class="ml-4">
                <!-- Content for Processing Status -->
            </div>
        </div>

        <!-- Remarks & Attachments -->
        <div class="mb-2">
            <button @click="menus.remarksAttachments = !menus.remarksAttachments"
                class="w-full px-4 py-3 text-left rounded-lg flex items-center justify-between hover:bg-gray-50">
                <span class="font-medium text-gray-700">Remarks & Attachments</span>
                <svg xmlns="http://www.w3.org/2000/svg"
                    :class="menus.remarksAttachments ? 'transform rotate-90' : ''"
                    class="w-5 h-5 transition-transform"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
            <div x-show="menus.remarksAttachments" class="ml-4">
                <!-- Content for Remarks & Attachments -->
            </div>
        </div>

        <!-- Log & History -->
        <div class="mb-2">
            <button @click="menus.logHistory = !menus.logHistory"
                class="w-full px-4 py-3 text-left rounded-lg flex items-center justify-between hover:bg-gray-50">
                <span class="font-medium text-gray-700">Log & History</span>
                <svg xmlns="http://www.w3.org/2000/svg"
                    :class="menus.logHistory ? 'transform rotate-90' : ''"
                    class="w-5 h-5 transition-transform"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
            <div x-show="menus.logHistory" class="ml-4">
                <!-- Content for Log & History -->
            </div>
        </div>
    </nav>
</div>
