<form action="/users/{{ $user->id }}" method="POST" id="edit_form" class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
    @csrf
    @method('PATCH')    
   
    <x-form-title class="text-2xl font-bold text-center mb-6">Edit Information</x-form-title>
    
    <!-- Personal Information Section -->
    <div class="mb-6">
        <h2 class="text-lg font-semibold mb-3 pb-2 border-b border-gray-200">Personal Information</h2>
        
        <!-- Name Fields (2x2 Grid) -->
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label for="firstname" class="block text-sm font-medium mb-1">First Name <span class="text-red-500">*</span></label>
                <x-form-input 
                    name="firstname" 
                    id="firstname" 
                    placeholder="First name" 
                    value="{{ $user->firstname }}" 
                    class="w-full py-2 px-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required
                />
                <x-form-error name="firstname" class="text-red-500 text-xs mt-1" />
            </div>
            <div>
                <label for="middlename" class="block text-sm font-medium mb-1">Middle Name</label>
                <x-form-input 
                    name="middlename" 
                    id="middlename" 
                    placeholder="Middle Name" 
                    value="{{ $user->middlename }}"
                    class="w-full py-2 px-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                />
            </div>
            <div>
                <label for="lastname" class="block text-sm font-medium mb-1">Last Name <span class="text-red-500">*</span></label>
                <x-form-input 
                    name="lastname" 
                    id="lastname" 
                    placeholder="Last name" 
                    value="{{ $user->lastname }}" 
                    class="w-full py-2 px-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required
                />
                <x-form-error name="lastname" class="text-red-500 text-xs mt-1" />
            </div>
            <div>
                <label for="suffix" class="block text-sm font-medium mb-1">Suffix</label>
                <x-form-input 
                    name="suffix" 
                    id="suffix" 
                    placeholder="Suffix" 
                    value="{{ $user->suffix }}"
                    class="w-full py-2 px-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                />
            </div>
        </div>
    </div>
    
    <!-- Work Information Section -->
    <div class="mb-6">
        <h2 class="text-lg font-semibold mb-3 pb-2 border-b border-gray-200">Work Information</h2>
        
        <!-- Division and Role (2-column) -->
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label for="division" class="block text-sm font-medium mb-1">Division <span class="text-red-500">*</span></label>
                <x-form-select 
                    name="division" 
                    id="division" 
                    class="w-full py-2 px-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required
                >
                    <option class="hidden" value="" disabled>Select Division</option>
                    <option value="PED" {{ old('division', $user->division) == 'PED' ? 'selected' : '' }}>Planning and Evaluation Division</option>
                    <option value="OD" {{ old('division', $user->division) == 'OD' ? 'selected' : '' }}>Operations Division</option>
                    <option value="AFD" {{ old('division', $user->division) == 'AFD' ? 'selected' : '' }}>Administrative and Finance Division</option>
                    <option value="OED" {{ old('division', $user->division) == 'OED' ? 'selected' : '' }}>Office of the Executive Director</option>
                </x-form-select>
                <x-form-error name="division" class="text-red-500 text-xs mt-1" />
            </div>
            <div>
                <label for="role" class="block text-sm font-medium mb-1">Role <span class="text-red-500">*</span></label>
                <x-form-select 
                    name="role" 
                    id="role" 
                    class="w-full py-2 px-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required
                >
                    <option class="hidden" value="" disabled>Select Role</option>
                    <option value="Admin" {{ old('role', $user->role) == 'Admin' ? 'selected' : '' }}>Admin</option>
                    <option value="Officer 2" {{ old('role', $user->role) == 'Officer 2' ? 'selected' : '' }}>Officer 2</option>
                    <option value="Officer 1" {{ old('role', $user->role) == 'Officer 1' ? 'selected' : '' }}>Officer 1</option>
                </x-form-select>
                <x-form-error name="role" class="text-red-500 text-xs mt-1" />
            </div>
        </div>
        
        <!-- Employee ID -->
        <div class="mb-4">
            <label for="employee_id_no" class="block text-sm font-medium mb-1">Employee ID <span class="text-red-500">*</span></label>
            <x-form-input 
                name="employee_id_no" 
                id="employee_id_no" 
                placeholder="Employee ID (Format: A12345678)" 
                value="{{ $user->employee_id_no }}" 
                class="w-full py-2 px-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                required 
            />
            <small class="text-gray-500 text-xs">Must start with a letter followed by 8 numbers (e.g., A12345678)</small>
            <x-form-error name="employee_id_no" class="text-red-500 text-xs mt-1" />
        </div>
    </div>
    
    <!-- Contact Information Section -->
    <div class="mb-6">
        <h2 class="text-lg font-semibold mb-3 pb-2 border-b border-gray-200">Contact Information</h2>
        
        <!-- Mobile Number -->
        <div class="mb-4">
            <label for="mobile_number" class="block text-sm font-medium mb-1">Mobile Number <span class="text-red-500">*</span></label>
            <div class="relative">
                <x-form-input 
                    name="mobile_number" 
                    id="mobile_number" 
                    placeholder="Mobile Number (e.g., 63xxxxxxxxxx)" 
                    value="{{ $user->mobile_number }}" 
                    class="w-full py-2 px-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required 
                    maxlength="12" 
                />
                <small class="text-gray-500 text-xs">Must start with 63 and be exactly 12 digits</small>
                <x-form-error name="mobile_number" class="text-red-500 text-xs mt-1" />
            </div>
        </div>
        
        <!-- Email Address -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium mb-1">Email Address <span class="text-red-500">*</span></label>
            <x-form-input 
                type="email" 
                name="email" 
                id="email" 
                placeholder="Email" 
                value="{{ $user->email }}" 
                class="w-full py-2 px-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                required
            />
            <x-form-error name="email" class="text-red-500 text-xs mt-1" />
        </div>
    </div>
    
    <!-- Action Buttons -->
    <div class="flex justify-between mt-6 pt-4 border-t border-gray-200">
        <a href="{{ url()->previous() }}" 
           class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition-colors">
            Cancel
        </a>
        <x-form-submit-button 
            id="submit-button"
            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors"
        > 
            Save Changes
        </x-form-submit-button>
    </div>
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('edit_form');
    const employeeIdInput = document.getElementById('employee_id_no');
    const mobileNumberInput = document.getElementById('mobile_number');
    const emailInput = document.getElementById('email');
    
    // Employee ID validation
    employeeIdInput.addEventListener('input', function() {
        const value = this.value;
        const regex = /^[A-Za-z][0-9]{8}$/;
        
        if (regex.test(value)) {
            this.classList.remove('border-red-500');
            this.classList.add('border-green-500');
            this.setCustomValidity('');
        } else {
            this.classList.remove('border-green-500');
            this.classList.add('border-red-500');
            this.setCustomValidity('Employee ID must start with a letter followed by 8 numbers');
        }
    });
    
    // Mobile number validation
    mobileNumberInput.addEventListener('input', function() {
        const value = this.value;
        const regex = /^63[0-9]{10}$/;
        
        // Only allow numbers
        this.value = this.value.replace(/[^\d]/g, '');
        
        if (regex.test(value)) {
            this.classList.remove('border-red-500');
            this.classList.add('border-green-500');
            this.setCustomValidity('');
        } else {
            this.classList.remove('border-green-500');
            if (value.length > 0) {
                this.classList.add('border-red-500');
            }
            this.setCustomValidity('Mobile number must start with 63 and be exactly 12 digits');
        }
    });
    
    // Email validation
    emailInput.addEventListener('input', function() {
        const value = this.value;
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        
        if (regex.test(value)) {
            this.classList.remove('border-red-500');
            this.classList.add('border-green-500');
            this.setCustomValidity('');
        } else {
            this.classList.remove('border-green-500');
            if (value.length > 0) {
                this.classList.add('border-red-500');
            }
            this.setCustomValidity('Please enter a valid email address');
        }
    });
    
    // Form submission
    form.addEventListener('submit', function(event) {
        // Employee ID validation
        const employeeIdValue = employeeIdInput.value;
        const employeeIdRegex = /^[A-Za-z][0-9]{8}$/;
        
        if (!employeeIdRegex.test(employeeIdValue)) {
            event.preventDefault();
            employeeIdInput.setCustomValidity('Employee ID must start with a letter followed by 8 numbers');
            employeeIdInput.reportValidity();
            return false;
        }
        
        // Mobile number validation
        const mobileValue = mobileNumberInput.value;
        const mobileRegex = /^63[0-9]{10}$/;
        
        if (!mobileRegex.test(mobileValue)) {
            event.preventDefault();
            mobileNumberInput.setCustomValidity('Mobile number must start with 63 and be exactly 12 digits');
            mobileNumberInput.reportValidity();
            return false;
        }
        
        // Email validation
        const emailValue = emailInput.value;
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        
        if (!emailRegex.test(emailValue)) {
            event.preventDefault();
            emailInput.setCustomValidity('Please enter a valid email address');
            emailInput.reportValidity();
            return false;
        }
    });
    
    // Initialize validation by checking current values
    function validateInitialValues() {
        // Employee ID
        const employeeIdValue = employeeIdInput.value;
        const employeeIdRegex = /^[A-Za-z][0-9]{8}$/;
        if (employeeIdRegex.test(employeeIdValue)) {
            employeeIdInput.classList.add('border-green-500');
        }
        
        // Mobile number
        const mobileValue = mobileNumberInput.value;
        const mobileRegex = /^63[0-9]{10}$/;
        if (mobileRegex.test(mobileValue)) {
            mobileNumberInput.classList.add('border-green-500');
        }
        
        // Email
        const emailValue = emailInput.value;
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (emailRegex.test(emailValue)) {
            emailInput.classList.add('border-green-500');
        }
    }
    
    // Run initial validation
    validateInitialValues();
});
</script>