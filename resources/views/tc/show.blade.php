<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transport Cooperative Details</title>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-8"
    x-data="{
        tab: 'general',
        searchQuery: '',
        showEditGeneralModal: false,
        showEditMembershipModal: false,
        menus: {
            operations: false,
            financial: false,
            development: false
        },
        cooperativeData: {
            general: [
                { label: 'OTC Accreditation Number', value: 'OTC-2024-001' },
                { label: 'Transport Cooperative Name', value: 'Sample Transport Cooperative' },
                { label: 'Short Name', value: 'STC' },
                { label: 'OTC Accreditation Date', value: '2024-01-15' },
                { label: 'Type of Accreditation', value: 'Full' },
                { label: 'Cooperative Registration Number', value: 'REG-2024-001' },
                { label: 'CDA Registration Date', value: '2023-12-01' },
                { label: 'Common Bond of Membership', value: 'Transport Service Providers' },
                { label: 'Membership Fee (per by-laws)', value: 'PHP 1,000.00' },
                { label: 'Area', value: 'NCR' },
                { label: 'Region', value: 'Metro Manila' },
                { label: 'City', value: 'Manila' },
                { label: 'Province / Sector', value: 'Metro Manila' },
                { label: 'Barangay', value: 'Sampaloc' },
                { label: 'Business Address', value: '123 Sample St, Sampaloc, Manila' },
                { label: 'E-mail', value: 'sample@email.com' },
                { label: 'Contact Numbers', value: '(02) 8123-4567 / 0917-123-4567' },
                { label: 'CONTACT\'S FIRST NAME', value: 'Juan' },
                { label: 'CONTACT\'S LAST NAME', value: 'Dela Cruz' },
                { label: 'CONTACT\'S M.I. (if applicable)', value: 'P.' },
                { label: 'CONTACT\'S SUFFIX (if applicable)', value: 'Jr.' },
                { label: 'SSS Employer Registration Number', value: '123456789' },
                { label: 'No. Of SSS Enrolled Employees', value: '10' },
                { label: 'Pag-IBIG Employer Registration Number', value: '987654321' },
                { label: 'No. Of Pag-IBIG Enrolled Employees', value: '8' },
                { label: 'PhilHealth Employer Registration Number', value: '456789123' },
                { label: 'No. Of PhilHealth Enrolled Employees', value: '9' },
                { label: 'BIR TIN Number', value: '123-456-789' },
                { label: 'BIR Tax Exemption Number', value: 'TAX-EXEMPT-001' },
                { label: 'BIR Tax Exemption Validity Date', value: '2025-12-31' },
                { label: 'Latest Date of Assess and Assist Activity', value: '2023-11-01' },
                { label: 'Latest Date of Financial Management Assistance (FMA)', value: '2023-10-15' }
            ],
           membership: [
                { label: 'OTC Accreditation Number', value: 'OTC-2024-001', id: 1 },
                { label: 'Transport Cooperative Name', value: 'Sample Transport Cooperative', id: 2 },
                { label: 'Entry Year', value: '2023', id: 3 },
                { label: 'Total Male Drivers', value: '50', id: 4 },
                { label: 'Total Female Drivers', value: '35', id: 5 },
                { label: 'Total Male Operators/Investors', value: '20', id: 6 },
                { label: 'Total Female Operators/Investors', value: '15', id: 7 },
                { label: 'Total Male Allied Workers', value: '10', id: 8 },
                { label: 'Total Female Allied Workers', value: '5', id: 9 },
                { label: 'Total Members', value: '140', id: 10 },
                { label: 'Special Type Status of Member', value: 'Regular', id: 11 },
                { label: 'Total', value: '140', id: 12 }
            ]
        },
        openEditGeneralModal() {
            this.showEditGeneralModal = true;
        },
        openEditMembershipModal() {
            this.showEditMembershipModal = true;
        },
        saveEditGeneral() {
            // Logic to save general information
            this.closeEditGeneralModal();
        },
        saveEditMembership() {
            // Logic to save membership information
            this.closeEditMembershipModal();
        },
        closeEditGeneralModal() {
            this.showEditGeneralModal = false;
        },
        closeEditMembershipModal() {
            this.showEditMembershipModal = false;
        },
        get filteredData() {
            if (!this.searchQuery) return [];

            let results = [];
            for (let category in this.cooperativeData) {
                const items = this.cooperativeData[category].filter(item =>
                    item.value.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                    item.label.toLowerCase().includes(this.searchQuery.toLowerCase())
                ).map(item => ({
                    ...item,
                    category: category
                }));
                results.push(...items);
            }
            return results;
        }
    }">

    <div class="max-w-7xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Transport Cooperative</h1>
            <button onclick="window.history.back()" class="px-4 py-2 text-sm bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                ← Back
            </button>
        </div>

        <!-- Search Bar -->
        @include('components.search-bar')

        <div class="flex gap-6">
            <!-- Navigation Menu -->
            @include('components.navigation-menu')

            <!-- Content Area -->
            @include('components.content-area')
        </div>
    </div>

    <!-- Edit Modals -->
    @include('components.edit-modal')
    @include('components.footer')
</body>
</html>
