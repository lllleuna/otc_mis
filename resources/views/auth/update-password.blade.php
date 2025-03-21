@extends('layouts.app')

@section('content')
<div class="bg-gray-100 min-h-screen flex items-center justify-center py-16 relative">
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-blue-100"></div>
        <div class="absolute inset-0 opacity-20" style="background-image: url('data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'152\' height=\'152\' viewBox=\'0 0 152 152\'%3E%3Cg fill-rule=\'evenodd\'%3E%3Cg id=\'temple\' fill=\'%23003366\' fill-opacity=\'0.4\'%3E%3Cpath d=\'M152 150v2H0v-2h28v-8H8v-20H0v-2h8V80h42v20h20v42H30v8h90v-8H80v-42h20V80h42v40h8V30h-8v40h-42V50H80V8h40V0h2v8h20v20h8V0h2v150zm-2 0v-28h-8v20h-20v8h28zM82 30v18h18V30H82zm20 18h20v20h18V30h-20V10H82v18h20v20zm0 2v18h18V50h-18zm20-22h18V10h-18v18zm-54 92v-18H50v18h18zm-20-18H28V82H10v38h20v20h38v-18H48v-20zm0-2V82H30v18h18zm-20 22H10v18h18v-18zm54 0v18h38v-20h20V82h-18v20h-20v20H82zm18-20H82v18h18v-18zm2-2h18V82h-18v18zm20 40v-18h18v18h-18zM30 0h-2v8H8v20H0v2h8v40h42V50h20V8H30V0zm20 48h18V30H50v18zm18-20H48v20H28v20H10V30h20V10h38v18zM30 50h18v18H30V50zm-2-40H10v18h18V10z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E'); background-size: 152px 152px;"></div>
    </div>

    <div class="absolute top-9 text-center w-full">
        <h1 class="text-2xl font-bold text-blue-900">Management Information System</h1>
        <h2 class="text-lg text-blue-900">Office of Transportation Cooperative</h2>
    </div>

    <div class="relative w-[28rem] mt-20">
        <div class="absolute -top-12 left-1/2 transform -translate-x-1/2 w-28 h-28 bg-white rounded-full shadow-lg flex items-center justify-center border-2 border-blue-900">
            <img class="w-full h-auto" src="{{ asset('images/OTC-UpdatedBannerLogo2.png') }}" alt="Logo">
        </div>

        <div class="bg-white rounded-lg shadow-xl overflow-hidden">
            <div class="bg-blue-900 px-8 pt-16 pb-8 text-center rounded-t-lg">
                <h1 class="text-3xl font-bold text-white mt-4">Welcome!</h1>
                <p class="text-sm text-blue-100 max-w-sm mx-auto mt-2">
                    Your password is temporary and must be updated to gain access to the system.
                </p>
            </div>

            <div class="px-8 pb-8 pt-6">
                @if (session('success'))
                    <div class="mb-4 p-3 bg-green-100 border border-green-300 text-green-700 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="/auth/update-password" id="password-form">
                    @csrf

                    <div class="mb-2">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                        <div class="relative">
                            <input type="password" name="password" id="password" placeholder="Enter your new password" required
                                class="w-full p-3 border rounded-lg focus:ring focus:ring-blue-300 @error('password') border-red-500 @enderror">
                            <button type="button" id="toggle-password" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 eye-icon show">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 eye-icon hide hidden">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                                </svg>
                            </button>
                        </div>
                        <div id="password-error" class="hidden text-red-500 text-sm mt-1"></div>
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4 text-xs text-gray-600">
                        <p class="font-medium mb-1">Password must meet the following requirements:</p>
                        <ul class="list-disc pl-5 space-y-1">
                            <li id="length-check" class="text-gray-500">At least 12 characters long</li>
                            <li id="uppercase-check" class="text-gray-500">At least 1 uppercase letter</li>
                            <li id="number-check" class="text-gray-500">At least 1 number</li>
                            <li id="special-check" class="text-gray-500">At least 1 special character (!@#$%^&*(),.?":{}|<>)</li>
                        </ul>
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                            Confirm Password
                        </label>
                        <div class="relative">
                            <input type="password" name="password_confirmation" id="password_confirmation" 
                                placeholder="Confirm your new password" required
                                class="w-full p-3 border rounded-lg focus:ring focus:ring-blue-300 @error('password_confirmation') border-red-500 @enderror">
                            <button type="button" id="toggle-confirm" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 eye-icon show">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 eye-icon hide hidden">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                                </svg>
                            </button>
                        </div>
                        <div id="confirm-error" class="hidden text-red-500 text-sm mt-1"></div>
                        @error('password_confirmation')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-4">
                        <button type="submit" id="submit-btn" disabled
                            class="w-full bg-blue-900 text-white py-3 rounded-lg transition cursor-not-allowed opacity-70">
                            Save New Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.getElementById('password');
    const confirmInput = document.getElementById('password_confirmation');
    const submitBtn = document.getElementById('submit-btn');
    const passwordError = document.getElementById('password-error');
    const confirmError = document.getElementById('confirm-error');
    
    const lengthCheck = document.getElementById('length-check');
    const uppercaseCheck = document.getElementById('uppercase-check');
    const numberCheck = document.getElementById('number-check');
    const specialCheck = document.getElementById('special-check');
    
    // Password visibility toggle
    const togglePassword = document.getElementById('toggle-password');
    const toggleConfirm = document.getElementById('toggle-confirm');
    
    togglePassword.addEventListener('click', function() {
        togglePasswordVisibility(passwordInput, this);
    });
    
    toggleConfirm.addEventListener('click', function() {
        togglePasswordVisibility(confirmInput, this);
    });
    
    function togglePasswordVisibility(input, button) {
        const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
        input.setAttribute('type', type);
        
        // Toggle the eye icons
        const showIcon = button.querySelector('.eye-icon.show');
        const hideIcon = button.querySelector('.eye-icon.hide');
        
        showIcon.classList.toggle('hidden');
        hideIcon.classList.toggle('hidden');
    }
    
    // Validate password as user types
    passwordInput.addEventListener('input', validatePassword);
    confirmInput.addEventListener('input', validateConfirmation);
    
    function validatePassword() {
        const password = passwordInput.value;
        let isValid = true;
        
        // Check length
        if (password.length >= 12) {
            lengthCheck.classList.replace('text-gray-500', 'text-green-500');
        } else {
            lengthCheck.classList.replace('text-green-500', 'text-gray-500');
            isValid = false;
        }
        
        // Check uppercase
        if (/[A-Z]/.test(password)) {
            uppercaseCheck.classList.replace('text-gray-500', 'text-green-500');
        } else {
            uppercaseCheck.classList.replace('text-green-500', 'text-gray-500');
            isValid = false;
        }
        
        // Check numbers
        if (/[0-9]/.test(password)) {
            numberCheck.classList.replace('text-gray-500', 'text-green-500');
        } else {
            numberCheck.classList.replace('text-green-500', 'text-gray-500');
            isValid = false;
        }
        
        // Check special characters
        if (/[!@#$%^&*(),.?":{}|<>]/.test(password)) {
            specialCheck.classList.replace('text-gray-500', 'text-green-500');
        } else {
            specialCheck.classList.replace('text-green-500', 'text-gray-500');
            isValid = false;
        }
        
        // If password is invalid, show general error message
        if (!isValid) {
            passwordError.textContent = "Password doesn't meet requirements";
            passwordError.classList.remove('hidden');
        } else {
            passwordError.classList.add('hidden');
        }
        
        // Validate confirmation if it has input
        if (confirmInput.value) {
            validateConfirmation();
        }
        
        updateSubmitButton();
    }
    
    function validateConfirmation() {
        if (confirmInput.value && passwordInput.value !== confirmInput.value) {
            confirmError.textContent = "Passwords do not match";
            confirmError.classList.remove('hidden');
        } else {
            confirmError.classList.add('hidden');
        }
        
        updateSubmitButton();
    }
    
    function updateSubmitButton() {
        const password = passwordInput.value;
        const isPasswordValid = password.length >= 12 && 
                              /[A-Z]/.test(password) && 
                              /[0-9]/.test(password) && 
                              /[!@#$%^&*(),.?":{}|<>]/.test(password);
        
        const isConfirmValid = passwordInput.value === confirmInput.value && confirmInput.value !== '';
        
        if (isPasswordValid && isConfirmValid) {
            submitBtn.disabled = false;
            submitBtn.classList.remove('opacity-70', 'cursor-not-allowed');
            submitBtn.classList.add('hover:bg-blue-800');
        } else {
            submitBtn.disabled = true;
            submitBtn.classList.add('opacity-70', 'cursor-not-allowed');
            submitBtn.classList.remove('hover:bg-blue-800');
        }
    }
    
    // Form submission validation
    document.getElementById('password-form').addEventListener('submit', function(event) {
        const password = passwordInput.value;
        const confirm = confirmInput.value;
        
        const isPasswordValid = password.length >= 12 && 
                              /[A-Z]/.test(password) && 
                              /[0-9]/.test(password) && 
                              /[!@#$%^&*(),.?":{}|<>]/.test(password);
        
        if (!isPasswordValid || password !== confirm) {
            event.preventDefault();
            
            if (!isPasswordValid) {
                passwordError.textContent = "Password doesn't meet all requirements";
                passwordError.classList.remove('hidden');
            }
            
            if (password !== confirm) {
                confirmError.textContent = "Passwords do not match";
                confirmError.classList.remove('hidden');
            }
        }
    });
});
</script>
@endsection