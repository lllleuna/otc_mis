<x-layout>
    <x-slot:vite>
      <!-- Link sa built CSS file -->
      <link rel="stylesheet" href="/dist/styles.css">
    </x-slot:vite>
    <x-slot:title>Transport Cooperative Details</x-slot:title>

    <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>Transport Cooperative Details</title>
      <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    </head>

    <body class="bg-gray-100 min-h-screen p-8" x-data="{
        tab: 'transaction',
        searchQuery: '',
        showEditModal: false,
        // Data para sa Transaction & Applicant Details
        transactionData: {
            'Transaction Reference': 'TRX-2025-001',
            'Accreditation Number': 'ACC-2025-001',
            'Transaction Type': 'Online Payment',
            'Date Created': '2025-01-15 08:30 AM',
            'Cooperative': 'Sample Transport Cooperative',
            'Submitted Documents': 'CDA-file.pdf'
        },
        applicantData: {
            'Applicant Name': 'Juan Dela Cruz',
            'Email': 'juan@example.com',
            'Contact': '09171234567'
        },
        // Data para sa Processing & Status Updates
        processingData: {
            'Current Status': 'Pending (Last Updated: 2025-01-10 02:00 PM)',
            'Remarks': '',
            'Attachments': 'Document1.pdf, Document2.pdf'
        },
        // Log & History Data (sample entries)
        logData: [
            '2025-01-10 02:00 PM – Submitted by Juan Dela Cruz',
            '2025-01-12 03:30 PM – Reviewed by Officer 1',
            '2025-01-15 10:00 AM – Modified by Officer 2'
        ],
        // Filtering function para sa search results
        filteredContent() {
            let results = [];
            // Search sa transactionData
            for (let key in this.transactionData) {
                if (this.transactionData[key].toLowerCase().includes(this.searchQuery.toLowerCase())) {
                    results.push({ field: key, value: this.transactionData[key] });
                }
            }
            // Search sa applicantData
            for (let key in this.applicantData) {
                if (this.applicantData[key].toLowerCase().includes(this.searchQuery.toLowerCase())) {
                    results.push({ field: key, value: this.applicantData[key] });
                }
            }
            // Search sa processingData
            for (let key in this.processingData) {
                if (this.processingData[key].toLowerCase().includes(this.searchQuery.toLowerCase())) {
                    results.push({ field: key, value: this.processingData[key] });
                }
            }
            // Search sa logData
            this.logData.forEach(log => {
                if (log.toLowerCase().includes(this.searchQuery.toLowerCase())) {
                    results.push({ field: 'Log', value: log });
                }
            });
            return results;
        },
        openEdit() {
            this.showEditModal = true;
        },
        closeEdit() {
            this.showEditModal = false;
        },
        updateData() {
            alert('Data updated!');
        },
        sendData() {
            alert('Data sent!');
        },
        saveEdit() {
            this.updateData();
            this.sendData();
            this.closeEdit();
        },
        setTab(newTab) {
            this.tab = newTab;
        }
    }">
      <div class="max-w-7xl mx-auto p-5">
        <!-- Header -->
        <header class="flex items-center justify-between mb-6">
          <h1 class="text-2xl font-bold text-gray-800">Transport Cooperative</h1>
        </header>

        <!-- Search Bar & Results -->
        <div class="mb-6">
          <div class="relative">
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 h-5 w-5"
                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <input type="text" placeholder="Search cooperative information..."
                   class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                   x-model="searchQuery" />
          </div>
          <div class="mt-4" x-show="searchQuery.length > 0">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Search Results</h2>
            <template x-if="filteredContent().length > 0">
              <ul class="space-y-2">
                <template x-for="(item, index) in filteredContent()" :key="index">
                  <li class="p-5 border rounded-lg">
                    <span class="font-medium" x-text="item.field + ' '"></span>
                    <span class="text-gray-600" x-text="item.value"></span>
                  </li>
                </template>
              </ul>
            </template>
            <template x-if="filteredContent().length == 0">
              <p class="text-gray-500 p-5 border rounded-lg">Not Found</p>
            </template>
          </div>
        </div>

        <div class="flex gap-6">
          <!-- Navigation Menu -->
          <div class="w-64 p-5 bg-white border rounded-lg shadow">
            <ul class="space-y-4">
              <!-- Navigation Header -->
              <li>
                <span class="block p-5 rounded-lg bg-blue-900 text-white">
                  Transaction Details
                </span>
              </li>
              <!-- Menu Items -->
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
            </ul>
          </div>

          <!-- Content Area -->
          <div class="flex-1 bg-white rounded-lg shadow-lg p-5 relative">
            <!-- Edit Link -->
            <div class="absolute top-4 right-4">
              <a href="#" class="text-blue-600 hover:underline" @click.prevent="openEdit()">Edit</a>
            </div>

            <!-- Transaction & Applicant Details Content -->
            <template x-if="!searchQuery && tab === 'transaction'">
              <div class="space-y-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Transaction & Applicant Details</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                  <!-- Transaction Details Column -->
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
                      <span class="font-medium">Transaction Type</span>
                      <div class="text-gray-600 mt-2" x-text="transactionData['Transaction Type']"></div>
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
                  <!-- Applicant Details Column -->
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

            <!-- Processing & Status Updates Content -->
            <template x-if="!searchQuery && tab === 'processing'">
              <div class="space-y-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Processing & Status Updates</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                  <!-- Processing Details Column -->
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
                  <!-- Log & History Column -->
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
          </div>
        </div>
      </div>

      <!-- Edit Modal (20px padding) -->
      <div x-show="showEditModal" class="fixed inset-0 flex items-center justify-center z-50 overflow-auto">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="bg-white rounded-lg shadow-lg z-50 w-11/12 md:w-3/4 lg:w-1/2 m-4 relative max-h-screen overflow-y-auto" style="padding: 20px;">
          <!-- X icon -->
          <button @click="closeEdit()" class="absolute top-2 right-2 text-gray-600 hover:text-gray-800">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
          <h2 class="text-xl font-bold mb-4">Edit Details</h2>
          <!-- Simple layout for Edit Modal -->
          <div class="space-y-6">
            <!-- Transaction & Applicant Details -->
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
                  <label class="block font-medium mb-1 text-sm">Transaction Type</label>
                  <input type="text" class="w-full border rounded-md p-2"
                         x-model="transactionData['Transaction Type']">
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
            <!-- Processing & Status Updates -->
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
          <!-- Separate Update and Send Buttons -->
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

      @include('components.edit-modal')
      @include('components.footer')
    </body>
  </x-layout>
