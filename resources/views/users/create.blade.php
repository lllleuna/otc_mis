<form action="/users" method="POST" id="create_form" >
    @csrf
   
    <x-form-title class="text-2xl font-bold text-center mb-6 text-black">Create Account</x-form-title>

    
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
                    :value="old('firstname')" 
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
                    :value="old('middlename')"
                    class="w-full py-2 px-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                />
            </div>
            <div>
                <label for="lastname" class="block text-sm font-medium mb-1">Last Name <span class="text-red-500">*</span></label>
                <x-form-input 
                    name="lastname" 
                    id="lastname" 
                    placeholder="Last name" 
                    :value="old('lastname')" 
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
                    :value="old('suffix')"
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
                    <option class="hidden" value="" disabled selected>Select Division</option>
                    <option value="PED" {{ old('division') == 'PED' ? 'selected' : '' }}>Planning and Evaluation Division</option>
                    <option value="OD" {{ old('division') == 'OD' ? 'selected' : '' }}>Operations Division</option>
                    <option value="AFD" {{ old('division') == 'AFD' ? 'selected' : '' }}>Administrative and Finance Division</option>
                    <option value="OED" {{ old('division') == 'OED' ? 'selected' : '' }}>Office of the Executive Director</option>
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
                    <option class="hidden" value="" disabled selected>Select Role</option>
                    <option value="Admin" {{ old('role') == 'Admin' ? 'selected' : '' }}>Admin</option>
                    <option value="Officer 2" {{ old('role') == 'Officer 2' ? 'selected' : '' }}>Officer 2</option>
                    <option value="Officer 1" {{ old('role') == 'Officer 1' ? 'selected' : '' }}>Officer 1</option>
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
                :value="old('employee_id_no')" 
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
                    placeholder="Mobile Number (e.g., 09123456789)" 
                    :value="old('mobile_number')" 
                    class="w-full py-2 px-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required 
                    maxlength="11" 
                />
                <small class="text-gray-500 text-xs">Must start with 09 and be exactly 11 digits</small>
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
                :value="old('email')" 
                class="w-full py-2 px-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                required
            />
            <x-form-error name="email" class="text-red-500 text-xs mt-1" />
        </div>
    </div>
    
    <!-- Password Section -->
    <div class="mb-6">
        <h2 class="text-lg font-semibold mb-3 pb-2 border-b border-gray-200">Password</h2>
        
        <!-- Password field with strength indicator -->
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium mb-1">Password <span class="text-red-500">*</span></label>
            <div class="relative">
                <x-form-input 
                    name="password" 
                    id="password" 
                    type="password" 
                    placeholder="Password" 
                    class="w-full py-2 px-3 pr-10 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required
                />
                <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 px-3 flex items-center">
                    <svg class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
            </div>
            <div id="password-strength" class="mt-2 mb-1 h-2 w-full bg-gray-200 rounded-full overflow-hidden hidden">
                <div id="password-strength-bar" class="h-full bg-red-500 transition-all duration-300"></div>
            </div>
            <div id="password-requirements" class="text-xs text-gray-500 mt-1">
                <p>Password must contain:</p>
                <ul class="ml-4 list-disc">
                    <li id="req-length" class="text-red-500">At least 12 characters</li>
                    <li id="req-uppercase" class="text-red-500">At least 1 uppercase letter</li>
                    <li id="req-number" class="text-red-500">At least 1 number</li>
                    <li id="req-special" class="text-red-500">At least 1 special character</li>
                </ul>
            </div>
            <x-form-error name="password" class="text-red-500 text-xs mt-1" />
        </div>
        
        <!-- Confirm Password -->
        <div class="mb-4">
            <label for="password_confirmation" class="block text-sm font-medium mb-1">Confirm Password <span class="text-red-500">*</span></label>
            <div class="relative">
                <x-form-input 
                    name="password_confirmation" 
                    id="password_confirmation" 
                    type="password" 
                    placeholder="Confirm Password" 
                    class="w-full py-2 px-3 pr-10 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required
                />
                <button type="button" id="toggleConfirmPassword" class="absolute inset-y-0 right-0 px-3 flex items-center">
                    <svg class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
            </div>
            <div id="password-match" class="text-xs mt-1 hidden">
                <span id="match-message" class="text-red-500">Passwords do not match</span>
            </div>
            <x-form-error name="password_confirmation" class="text-red-500 text-xs mt-1" />
        </div>
    </div>
    
    <!-- Action Buttons -->
    <div class="flex justify-between mt-6 pt-4 border-t border-gray-200">
        <x-cancel-button 
            onclick="closeModal('modalCreate'), resetForm('create_form')"
            class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition-colors"
        > 
            Discard 
        </x-cancel-button>
        <x-form-submit-button 
            id="submit-button"
            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
            disabled
        > 
            Create Account
        </x-form-submit-button>
    </div>
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('create_form');
    const passwordInput = document.getElementById('password');
    const passwordConfirmInput = document.getElementById('password_confirmation');
    const employeeIdInput = document.getElementById('employee_id_no');
    const mobileNumberInput = document.getElementById('mobile_number');
    const emailInput = document.getElementById('email');
    const submitButton = document.getElementById('submit-button');
    const passwordStrengthBar = document.getElementById('password-strength-bar');
    const passwordStrengthContainer = document.getElementById('password-strength');
    const passwordMatchDiv = document.getElementById('password-match');
    const matchMessage = document.getElementById('match-message');
    
    // Password requirement elements
    const reqLength = document.getElementById('req-length');
    const reqUppercase = document.getElementById('req-uppercase');
    const reqNumber = document.getElementById('req-number');
    const reqSpecial = document.getElementById('req-special');
    
    // Toggle password visibility
    document.getElementById('togglePassword').addEventListener('click', function() {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            this.innerHTML = `<svg class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
            </svg>`;
        } else {
            passwordInput.type = 'password';
            this.innerHTML = `<svg class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>`;
        }
    });
    
    // Toggle confirm password visibility
    document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
        if (passwordConfirmInput.type === 'password') {
            passwordConfirmInput.type = 'text';
            this.innerHTML = `<svg class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
            </svg>`;
        } else {
            passwordConfirmInput.type = 'password';
            this.innerHTML = `<svg class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>`;
        }
    });
    
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
        
        checkFormValidity();
    });
    
    // Mobile number validation
    mobileNumberInput.addEventListener('input', function() {
        const value = this.value;
        const regex = /^09[0-9]{9}$/;
        
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
            this.setCustomValidity('Mobile number must start with 09 and be exactly 11 digits');
        }
        
        checkFormValidity();
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
        
        checkFormValidity();
    });
    
    // Password strength validation
    passwordInput.addEventListener('input', function() {
        const value = this.value;
        passwordStrengthContainer.classList.remove('hidden');
        
        // Check requirements
        const hasLength = value.length >= 12;
        const hasUppercase = /[A-Z]/.test(value);
        const hasNumber = /[0-9]/.test(value);
        const hasSpecial = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(value);
        
        // Update requirement indicators
        reqLength.className = hasLength ? 'text-green-500' : 'text-red-500';
        reqUppercase.className = hasUppercase ? 'text-green-500' : 'text-red-500';
        reqNumber.className = hasNumber ? 'text-green-500' : 'text-red-500';
        reqSpecial.className = hasSpecial ? 'text-green-500' : 'text-red-500';
        
        // Calculate strength percentage
        let strength = 0;
        if (hasLength) strength += 25;
        if (hasUppercase) strength += 25;
        if (hasNumber) strength += 25;
        if (hasSpecial) strength += 25;
        
        // Update strength bar
        passwordStrengthBar.style.width = `${strength}%`;
        
        // Update color based on strength
        if (strength < 50) {
            passwordStrengthBar.className = 'h-full bg-red-500 transition-all duration-300';
        } else if (strength < 100) {
            passwordStrengthBar.className = 'h-full bg-yellow-500 transition-all duration-300';
        } else {
            passwordStrengthBar.className = 'h-full bg-green-500 transition-all duration-300';
        }
        
        // Check password validity
        if (hasLength && hasUppercase && hasNumber && hasSpecial) {
            this.classList.remove('border-red-500');
            this.classList.add('border-green-500');
            this.setCustomValidity('');
        } else {
            this.classList.remove('border-green-500');
            if (value.length > 0) {
                this.classList.add('border-red-500');
            }
            this.setCustomValidity('Password must meet all requirements');
        }
        
        // Check if passwords match
        checkPasswordsMatch();
        checkFormValidity();
    });
    
    // Password confirmation validation
    passwordConfirmInput.addEventListener('input', function() {
        checkPasswordsMatch();
        checkFormValidity();
    });
    
    // Check if passwords match
    function checkPasswordsMatch() {
        const passwordValue = passwordInput.value;
        const confirmValue = passwordConfirmInput.value;
        
        if (confirmValue.length > 0) {
            passwordMatchDiv.classList.remove('hidden');
            
            if (passwordValue === confirmValue) {
                passwordConfirmInput.classList.remove('border-red-500');
                passwordConfirmInput.classList.add('border-green-500');
                matchMessage.className = 'text-green-500';
                matchMessage.textContent = 'Passwords match';
                passwordConfirmInput.setCustomValidity('');
            } else {
                passwordConfirmInput.classList.remove('border-green-500');
                passwordConfirmInput.classList.add('border-red-500');
                matchMessage.className = 'text-red-500';
                matchMessage.textContent = 'Passwords do not match';
                passwordConfirmInput.setCustomValidity('Passwords do not match');
            }
        } else {
            passwordMatchDiv.classList.add('hidden');
            passwordConfirmInput.classList.remove('border-red-500', 'border-green-500');
        }
    }
    
    // Check overall form validity
    function checkFormValidity() {
        const requiredFields = form.querySelectorAll('[required]');
        let isValid = true;
        
        requiredFields.forEach(field => {
            if (!field.validity.valid || field.value.trim() === '') {
                isValid = false;
            }
        });
        
        // Additional custom validations
        const passwordValue = passwordInput.value;
        const confirmValue = passwordConfirmInput.value;
        const hasValidPassword = passwordValue.length >= 12 && 
                               /[A-Z]/.test(passwordValue) && 
                               /[0-9]/.test(passwordValue) && 
                               /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(passwordValue);
        
        const passwordsMatch = passwordValue === confirmValue;
        
        if (!hasValidPassword || !passwordsMatch || confirmValue === '') {
            isValid = false;
        }
        
        // Enable/disable submit button
        submitButton.disabled = !isValid;
    }
    
    // Form submission
    form.addEventListener('submit', function(event) {
        const passwordValue = passwordInput.value;
        const confirmValue = passwordConfirmInput.value;
        
        // Final validation check
        const hasValidPassword = passwordValue.length >= 12 && 
                               /[A-Z]/.test(passwordValue) && 
                               /[0-9]/.test(passwordValue) && 
                               /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(passwordValue);
        
        if (!hasValidPassword) {
            event.preventDefault();
            passwordInput.setCustomValidity('Password must be at least 12 characters and include at least 1 capital letter, 1 number, and 1 special character');
            passwordInput.reportValidity();
            return false;
        }
        
        if (passwordValue !== confirmValue) {
            event.preventDefault();
            passwordConfirmInput.setCustomValidity('Passwords do not match');
            passwordConfirmInput.reportValidity();
            return false;
        }
    });
    
    // Initialize form validation on load
    checkFormValidity();
});
</script>