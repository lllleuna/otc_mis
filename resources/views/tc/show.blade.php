<x-layout>
    <x-slot:vite>
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
        processingData: {
            'Current Status': 'Pending (Last Updated: 2025-01-10 02:00 PM)',
            'Remarks': '',
            'Attachments': 'Document1.pdf, Document2.pdf'
        },
        logData: [
            '2025-01-10 02:00 PM – Submitted by Juan Dela Cruz',
            '2025-01-12 03:30 PM – Reviewed by Officer 1',
            '2025-01-15 10:00 AM – Modified by Officer 2'
        ],
        accreditationData: {
            'Cooperative Information': {
                'Name': 'Sample Transport Cooperative',
                'Address': '123 Sample St, Sample City',
                'Contact Details': '0917-123-4567'
            },
            'Registration Details': {
                'CDA Registration No.': 'CDA-2025-001',
                'Date of Registration': '2025-01-01'
            },
            'Officers & Board Members': [
                { 'Name': 'Maria Santos', 'Position': 'President', 'Contact Info': '0917-765-4321' },
                { 'Name': 'Jose Reyes', 'Position': 'Vice President', 'Contact Info': '0917-234-5678' }
            ],
            'Financial Information': 'Latest Audited Financial Statements available upon request.',
            'Operational Details': {
                'Type of Services': 'Transport Services',
                'Area of Operation': 'Metro Sample'
            },
            'Required Documents': [
                'Bylaws',
                'Articles of Cooperation',
                'Business Permits'
            ]
        },
        cgRequestData: {
            'Cooperative Name': 'Sample Transport Cooperative',
            'Registration No.': 'CDA-2025-001',
            'Proof of Compliance': 'Latest Reports, Financial Statements',
            'Authorized Representative': {
                'Name': 'Juan Dela Cruz',
                'Position': 'Authorized Signatory',
                'Contact Info': '0917-123-4567'
            },
            'Purpose of Request': 'Loan application'
        },
        trainingData: {
            'Cooperative Name': 'Sample Transport Cooperative',
            'Registration No.': 'CDA-2025-001',
            'Trainee Information': {
                'Name': 'Maria Santos',
                'Position': 'Driver',
                'Contact Details': '0917-765-4321'
            },
            'Training Type & Schedule': 'Safety Training - March 1, 2025',
            'Payment Details': 'Paid via bank transfer'
        },
        filteredContent() {
            if (!this.searchQuery) return [];
            let results = [];
            for (let key in this.transactionData) {
                if (this.transactionData[key].toLowerCase().includes(this.searchQuery.toLowerCase())) {
                    results.push({ group: 'transaction', field: key, value: this.transactionData[key] });
                }
            }
            for (let key in this.applicantData) {
                if (this.applicantData[key].toLowerCase().includes(this.searchQuery.toLowerCase())) {
                    results.push({ group: 'transaction', field: key, value: this.applicantData[key] });
                }
            }
            for (let key in this.processingData) {
                if (this.processingData[key].toLowerCase().includes(this.searchQuery.toLowerCase())) {
                    results.push({ group: 'processing', field: key, value: this.processingData[key] });
                }
            }
            this.logData.forEach(log => {
                if (log.toLowerCase().includes(this.searchQuery.toLowerCase())) {
                    results.push({ group: 'processing', field: 'Log', value: log });
                }
            });
            return results;
        },
        selectResult(result) {
            this.tab = result.group;
            this.searchQuery = '';
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
        },
        showAccreditationDetails() {
            this.transactionData['Transaction Type'] = 'Accreditation';
            this.tab = 'accreditation'; // Set the tab to accreditation
        },
        showCGSRequestDetails() {
            this.transactionData['Transaction Type'] = 'Certificate of Good Standing (CGS) Request';
            this.tab = 'cgsRequest'; // Set the tab to CGS Request
        },
        showTrainingDetails() {
            this.transactionData['Transaction Type'] = 'Training';
            this.tab = 'training'; // Set the tab to Training
        }
    }">
        <div class="max-w-7xl mx-auto p-5">
            <header class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Transport Cooperative</h1>
                <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Back</button>
            </header>

            <!-- Search Bar -->
            @include('components.search-bar')

            <div class="mb-6 flex">
                <!-- Navigation Menu -->
                @include('components.navigation-menu')

                <!-- Content Area -->
                @include('components.content-area')
            </div>
        </div>

        <!-- Edit Modal -->
        @include('components.edit-modal')

        @include('components.footer')
    </body>
</x-layout>
