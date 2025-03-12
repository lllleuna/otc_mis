@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto p-4">
    <button onclick="window.history.back()" class="px-4 py-2 text-sm bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
        ← Back
    </button>
</div>

<div class="container mx-auto p-4 bg-gray-50 rounded-lg shadow">

    <div class="mb-6 border-b pb-4">
        <h1 class="text-2xl font-bold text-gray-800">Edit Cooperative Information</h1>
        <p class="text-gray-600">Update information for this transport cooperative</p>
    </div>

    <form id="editCooperativeForm" class="space-y-6">
        <!-- Cooperative Identity Section -->
        <div class="bg-white p-4 rounded-lg shadow-sm">
            <h2 class="text-lg font-semibold text-gray-800">Cooperative Identity</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
                <div class="form-group">
                    <label for="tc_name" class="block text-sm font-medium text-gray-700 mb-1">Transport Cooperative Name</label>
                    <input type="text" id="tc_name" name="tc_name" class="w-full px-3 py-2 border border-gray-300 rounded-md" value="{{ old('tc_name', $generalinfo->name) }}" required>
                </div>
                <div class="form-group">
                    <label for="shortName" class="block text-sm font-medium text-gray-700 mb-1">Short Name</label>
                    <input type="text" id="shortName" name="shortName" class="w-full px-3 py-2 border border-gray-300 rounded-md" value="{{ old('shortName', $generalinfo->short_name) }}" required>
                </div>
                <div class="form-group md:col-span-3">
                    <label for="bondMembership" class="block text-sm font-medium text-gray-700 mb-1">Common Bond of Membership</label>
                    <input type="text" id="bondMembership" name="bondMembership" class="w-full px-3 py-2 border border-gray-300 rounded-md" value="{{ old('shortName', $generalinfo->common_bond_membership) }}" required>
                </div>
                <div class="form-group">
                    <label for="membershipFee" class="block text-sm font-medium text-gray-700 mb-1">Membership Fee</label>
                    <input type="text" id="membershipFee" name="membershipFee" value="{{ old('shortName', $generalinfo->membership_fee) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md" value="500" required>
                </div>
            </div>
        </div>

        <!-- Registration & Accreditation Section -->
        <div class="bg-white p-4 rounded-lg shadow-sm">
            <h2 class="text-lg font-semibold text-gray-800">Registration & Accreditation</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
                <div class="form-group">
                    <label for="otcAccNumber" class="block text-sm font-medium text-gray-700 mb-1">OTC Accreditation Number</label>
                    <input type="text" id="otcAccNumber" name="otcAccNumber" class="w-full px-3 py-2 border border-gray-300 rounded-md" value="OTC123456" readonly>
                </div>
                <div class="form-group">
                    <label for="accType" class="block text-sm font-medium text-gray-700 mb-1">Type of Accreditation</label>
                    <select id="accType" name="accType" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                        <option value="Provisional" selected>Provisional</option>
                        <option value="Regular">Regular</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="otcAccDate" class="block text-sm font-medium text-gray-700 mb-1">OTC Accreditation Date</label>
                    <input type="date" id="otcAccDate" name="otcAccDate" class="w-full px-3 py-2 border border-gray-300 rounded-md" value="2023-01-15" readonly>
                </div>
                <div class="form-group">
                    <label for="coopRegNumber" class="block text-sm font-medium text-gray-700 mb-1">Cooperative Registration Number</label>
                    <input type="text" id="coopRegNumber" name="coopRegNumber" class="w-full px-3 py-2 border border-gray-300 rounded-md" value="REG123456" readonly>
                </div>
                <div class="form-group">
                    <label for="cdaRegDate" class="block text-sm font-medium text-gray-700 mb-1">CDA Registration Date</label>
                    <input type="date" id="cdaRegDate" name="cdaRegDate" class="w-full px-3 py-2 border border-gray-300 rounded-md" value="2022-05-20" readonly>
                </div>
            </div>
        </div>

        <!-- Contact Information Section -->
        <div class="bg-white p-4 rounded-lg shadow-sm">
            <h2 class="text-lg font-semibold text-gray-800">Contact Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
                <div class="form-group">
                    <label for="areaRegion" class="block text-sm font-medium text-gray-700 mb-1">Area / Region / City / Province / Barangay</label>
                    <input type="text" id="areaRegion" name="areaRegion" class="w-full px-3 py-2 border border-gray-300 rounded-md" value="Quezon City" required>
                </div>
                <div class="form-group">
                    <label for="businessAddress" class="block text-sm font-medium text-gray-700 mb-1">Business Address</label>
                    <textarea id="businessAddress" name="businessAddress" rows="2" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>123 Sample St., Quezon City</textarea>
                </div>
                <div class="form-group">
                    <label for="contactPerson" class="block text-sm font-medium text-gray-700 mb-1">Contact Person</label>
                    <input type="text" id="contactPerson" name="contactPerson" class="w-full px-3 py-2 border border-gray-300 rounded-md" value="Juan Dela Cruz" required>
                </div>
                <div class="form-group">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">E-mail</label>
                    <input type="email" id="email" name="email" class="w-full px-3 py-2 border border-gray-300 rounded-md" value="contact@samplecoop.com" required>
                </div>
                <div class="form-group">
                    <label for="contactNumbers" class="block text-sm font-medium text-gray-700 mb-1">Contact Numbers</label>
                    <input type="text" id="contactNumbers" name="contactNumbers" class="w-full px-3 py-2 border border-gray-300 rounded-md" value="0917-123-4567" required>
                </div>
            </div>
        </div>

        <!-- Governance Section -->
        <div class="bg-white p-4 rounded-lg shadow-sm">
            <h2 class="text-lg font-semibold text-gray-800">Governance</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
                <div class="form-group">
                    <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                    <input type="text" id="role" name="role" class="w-full px-3 py-2 border border-gray-300 rounded-md" value="Chairperson" required>
                </div>
                <div class="form-group">
                    <label for="firstName" class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                    <input type="text" id="firstName" name="firstName" class="w-full px-3 py-2 border border-gray-300 rounded-md" value="Carlos" required>
                </div>
                <div class="form-group">
                    <label for="lastName" class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                    <input type="text" id="lastName" name="lastName" class="w-full px-3 py-2 border border-gray-300 rounded-md" value="Mendoza" required>
                </div>
                <div class="form-group">
                    <label for="mi" class="block text-sm font-medium text-gray-700 mb-1">M.I.</label>
                    <input type="text" id="mi" name="mi" class="w-full px-3 py-2 border border-gray-300 rounded-md" value="A" required>
                </div>
                <div class="form-group">
                    <label for="suffix" class="block text-sm font-medium text-gray-700 mb-1">Suffix</label>
                    <input type="text" id="suffix" name="suffix" class="w-full px-3 py-2 border border-gray-300 rounded-md" value="">
                </div>
                <div class="form-group">
                    <label for="termInOffice" class="block text-sm font-medium text-gray-700 mb-1">Term In Office</label>
                    <input type="text" id="termInOffice" name="termInOffice" class="w-full px-3 py-2 border border-gray-300 rounded-md" value="2023-2025" required>
                </div>
                <div class="form-group">
                    <label for="mobileNo" class="block text-sm font-medium text-gray-700 mb-1">Mobile No.</label>
                    <input type="text" id="mobileNo" name="mobileNo" class="w-full px-3 py-2 border border-gray-300 rounded-md" value="0917-123-4567" required>
                </div>
                <div class="form-group">
                    <label for="governanceEmail" class="block text-sm font-medium text-gray-700 mb-1">E-mail</label>
                    <input type="email" id="governanceEmail" name="governanceEmail" class="w-full px-3 py-2 border border-gray-300 rounded-md" value="carlos@email.com" required>
                </div>
            </div>
        </div>

        <!-- Membership Section -->
        <div class="bg-white p-4 rounded-lg shadow-sm">
            <h2 class="text-lg font-semibold text-gray-800">Membership</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
                <div class="form-group">
                    <label for="entryYear" class="block text-sm font-medium text-gray-700 mb-1">Entry Year</label>
                    <input type="text" id="entryYear" name="entryYear" class="w-full px-3 py-2 border border-gray-300 rounded-md" value="2025" required>
                </div>
                <div class="form-group">
                    <label for="driverCount" class="block text-sm font-medium text-gray-700 mb-1">Drivers</label>
                    <input type="number" id="driverCount" name="driverCount" class="w-full px-3 py-2 border border-gray-300 rounded-md" value="50" required>
                </div>
                <div class="form-group">
                    <label for="operatorCount" class="block text-sm font-medium text-gray-700 mb-1">Operators/Investors</label>
                    <input type="number" id="operatorCount" name="operatorCount" class="w-full px-3 py-2 border border-gray-300 rounded-md" value="35" required>
                </div>
                <div class="form-group">
                    <label for="alliedWorkersCount" class="block text-sm font-medium text-gray-700 mb-1">Allied Workers</label>
                    <input type="number" id="alliedWorkersCount" name="alliedWorkersCount" class="w-full px-3 py-2 border border-gray-300 rounded-md" value="15" required>
                </div>
                <div class="form-group">
                    <label for="otherMembersCount" class="block text-sm font-medium text-gray-700 mb-1">Other Type of Members</label>
                    <input type="number" id="otherMembersCount" name="otherMembersCount" class="w-full px-3 py-2 border border-gray-300 rounded-md" value="10" required>
                </div>
                <div class="form-group">
                    <label for="totalMembers" class="block text-sm font-medium text-gray-700 mb-1">Total Members</label>
                    <input type="number" id="totalMembers" name="totalMembers" class="w-full px-3 py-2 border border-gray-300 rounded-md" value="110" required>
                </div>
                <div class="form-group">
                    <label for="specialType" class="block text-sm font-medium text-gray-700 mb-1">Special Type</label>
                    <input type="text" id="specialType" name="specialType" class="w-full px-3 py-2 border border-gray-300 rounded-md" value="N/A" required>
                </div>
                <div class="form-group">
                    <label for="statusOfMember" class="block text-sm font-medium text-gray-700 mb-1">Status of Member</label>
                    <input type="text" id="statusOfMember" name="statusOfMember" class="w-full px-3 py-2 border border-gray-300 rounded-md" value="Active" required>
                </div>
            </div>
        </div>

        <!-- Units Section -->
        <div class="bg-white p-4 rounded-lg shadow-sm">
            <h2 class="text-lg font-semibold text-gray-800">Units</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
                <div class="form-group">
                    <label for="modeOfService" class="block text-sm font-medium text-gray-700 mb-1">Mode of Service</label>
                    <input type="text" id="modeOfService" name="modeOfService" class="w-full px-3 py-2 border border-gray-300 rounded-md" value="PUJModern" required>
                </div>
                <div class="form-group">
                    <label for="typeOfUnit" class="block text-sm font-medium text-gray-700 mb-1">Type of Unit</label>
                    <input type="text" id="typeOfUnit" name="typeOfUnit" class="w-full px-3 py-2 border border-gray-300 rounded-md" value="12" required>
                </div>
                <div class="form-group">
                    <label for="cooperativelyOwnedUnits" class="block text-sm font-medium text-gray-700 mb-1">No. of Cooperatively Owned Units (2020)</label>
                    <input type="number" id="cooperativelyOwnedUnits" name="cooperativelyOwnedUnits" class="w -full px-3 py-2 border border-gray-300 rounded-md" value="20" required>
                </div>
                <div class="form-group">
                    <label for="leasedUnits" class="block text-sm font-medium text-gray-700 mb-1">No. of Leased Units</label>
                    <input type="number" id="leasedUnits" name="leasedUnits" class="w-full px-3 py-2 border border-gray-300 rounded-md" value="5" required>
                </div>
                <div class="form-group">
                    <label for="totalUnits" class="block text-sm font-medium text-gray-700 mb-1">Total Units</label>
                    <input type="number" id="totalUnits" name="totalUnits" class="w-full px-3 py-2 border border-gray-300 rounded-md" value="25" required>
                </div>
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Save Changes</button>
        </div>
    </form>
</div>

@endsection
