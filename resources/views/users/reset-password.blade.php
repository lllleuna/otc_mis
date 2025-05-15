{{-- For admin to reset user's password --}}
{{-- ---------------------------------- --}}
<form action="/users/{{ $user->id }}/reset" method="POST">
    @csrf
    @method('PATCH') 

    <x-form-title>Reset Password</x-form-title>

    <x-form-input name="password" id="password" type="password" placeholder="New Password" required/>
    <x-form-error name="password" />

    <x-form-input name="password_confirmation" id="password_confirmation" type="password" placeholder="Confirm Password" required/>
    <x-form-error name="password_confirmation" />

    <div class="flex justify-end mt-2">
        <div>
            <x-form-submit-button > Save New Password </x-form-submit-button>
        </div>
    </div>

</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.getElementById('password');
    const confirmInput = document.getElementById('password_confirmation');
    const submitButton = document.getElementById('form-submit-button') || document.querySelector('button[type="submit"]');
    
    // Add password requirements display
    const requirementsDiv = document.createElement('div');
    requirementsDiv.id = 'password-requirements';
    requirementsDiv.className = 'text-sm mt-1 space-y-1';
    requirementsDiv.innerHTML = `
        <div id="length-check" class="text-gray-500"><span class="mr-1">•</span>At least 12 characters</div>
        <div id="uppercase-check" class="text-gray-500"><span class="mr-1">•</span>At least 1 uppercase letter</div>
        <div id="number-check" class="text-gray-500"><span class="mr-1">•</span>At least 1 number</div>
        <div id="special-check" class="text-gray-500"><span class="mr-1">•</span>At least 1 special character</div>
    `;
    passwordInput.parentNode.insertBefore(requirementsDiv, passwordInput.nextSibling);
    
    // Add match message
    const matchMessage = document.createElement('div');
    matchMessage.id = 'match-message';
    matchMessage.className = 'text-sm mt-1 hidden text-red-500';
    matchMessage.textContent = 'Passwords do not match';
    confirmInput.parentNode.insertBefore(matchMessage, confirmInput.nextSibling);
    
    // Add toggle password visibility buttons
    addPasswordToggle(passwordInput, 'toggle-password');
    addPasswordToggle(confirmInput, 'toggle-confirmation');
    
    // Function to add password toggle
    function addPasswordToggle(input, toggleId) {
        const wrapper = document.createElement('div');
        wrapper.className = 'relative';
        input.parentNode.insertBefore(wrapper, input);
        wrapper.appendChild(input);
        
        const toggle = document.createElement('button');
        toggle.type = 'button';
        toggle.id = toggleId;
        toggle.className = 'absolute inset-y-0 right-0 pr-3 flex items-center text-gray-600 focus:outline-none';
        toggle.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" id="${toggleId}-eye">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" id="${toggleId}-eye-off">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
            </svg>
        `;
        wrapper.appendChild(toggle);
        
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            const eyeIcon = document.getElementById(`${toggleId}-eye`);
            const eyeOffIcon = document.getElementById(`${toggleId}-eye-off`);
            
            if (input.type === 'password') {
                input.type = 'text';
                eyeIcon.classList.add('hidden');
                eyeOffIcon.classList.remove('hidden');
            } else {
                input.type = 'password';
                eyeIcon.classList.remove('hidden');
                eyeOffIcon.classList.add('hidden');
            }
        });
    }
    
    // Get reference to requirement check elements
    const lengthCheck = document.getElementById('length-check');
    const uppercaseCheck = document.getElementById('uppercase-check');
    const numberCheck = document.getElementById('number-check');
    const specialCheck = document.getElementById('special-check');
    
    // Function to validate password
    function validatePassword() {
        const password = passwordInput.value;
        const confirmation = confirmInput.value;
        
        // Check requirements
        const meetsLength = password.length >= 12;
        const meetsUppercase = /[A-Z]/.test(password);
        const meetsNumber = /[0-9]/.test(password);
        const meetsSpecial = /[^A-Za-z0-9]/.test(password);
        
        // Update visual indicators
        lengthCheck.className = meetsLength ? 'text-green-500' : 'text-gray-500';
        uppercaseCheck.className = meetsUppercase ? 'text-green-500' : 'text-gray-500';
        numberCheck.className = meetsNumber ? 'text-green-500' : 'text-gray-500';
        specialCheck.className = meetsSpecial ? 'text-green-500' : 'text-gray-500';
        
        // Check if passwords match
        if (confirmation.length > 0) {
            if (password === confirmation) {
                matchMessage.classList.remove('hidden');
                matchMessage.classList.remove('text-red-500');
                matchMessage.classList.add('text-green-500');
                matchMessage.textContent = 'Passwords match';
                confirmInput.classList.remove('border-red-500');
                confirmInput.classList.add('border-green-500');
            } else {
                matchMessage.classList.remove('hidden');
                matchMessage.classList.remove('text-green-500');
                matchMessage.classList.add('text-red-500');
                matchMessage.textContent = 'Passwords do not match';
                confirmInput.classList.remove('border-green-500');
                confirmInput.classList.add('border-red-500');
            }
        } else {
            matchMessage.classList.add('hidden');
            confirmInput.classList.remove('border-red-500', 'border-green-500');
        }
        
        // Enable/disable submit button
        const allRequirementsMet = meetsLength && meetsUppercase && meetsNumber && meetsSpecial;
        const passwordsMatch = password === confirmation && confirmation.length > 0;
        
        if (submitButton) {
            submitButton.disabled = !(allRequirementsMet && passwordsMatch);
        }
    }
    
    // Add event listeners
    passwordInput.addEventListener('input', validatePassword);
    confirmInput.addEventListener('input', validatePassword);
    
    // Server-side validation hint
    const form = document.querySelector('form');
    form.addEventListener('submit', function(event) {
        const password = passwordInput.value;
        const confirmation = confirmInput.value;
        
        // Check password complexity requirements
        const meetsLength = password.length >= 12;
        const meetsUppercase = /[A-Z]/.test(password);
        const meetsNumber = /[0-9]/.test(password);
        const meetsSpecial = /[^A-Za-z0-9]/.test(password);
        const allRequirementsMet = meetsLength && meetsUppercase && meetsNumber && meetsSpecial;
        
        // Check if passwords match
        const passwordsMatch = password === confirmation;
        
        // Create error message if validation fails
        let errorMessage = '';
        
        if (!allRequirementsMet) {
            errorMessage += 'Password must have:\n';
            if (!meetsLength) errorMessage += '- At least 12 characters\n';
            if (!meetsUppercase) errorMessage += '- At least 1 uppercase letter\n';
            if (!meetsNumber) errorMessage += '- At least 1 number\n';
            if (!meetsSpecial) errorMessage += '- At least 1 special character\n';
        }
        
        if (!passwordsMatch) {
            errorMessage += 'Passwords do not match.\n';
            
            // Highlight confirmation field
            confirmInput.classList.add('border-red-500');
            matchMessage.classList.remove('hidden');
            matchMessage.classList.remove('text-green-500');
            matchMessage.classList.add('text-red-500');
            matchMessage.textContent = 'Passwords do not match';
        }
        
        // Stop form submission if validation fails
        if (!allRequirementsMet || !passwordsMatch) {
            event.preventDefault();
            alert(errorMessage || 'Please ensure all password requirements are met.');
            return false;
        }
        
        return true;
    });
    
    // Initial validation
    validatePassword();
});
</script>
