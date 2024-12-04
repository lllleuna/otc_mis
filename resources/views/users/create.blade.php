<form action="/users" method="POST" id="create_form">
    @csrf
    
    <x-form-title>Create Account</x-form-title>

    {{-- Name --}}
    <div class="flex">
        <x-form-input name="firstname" id="firstname" placeholder="First name" :value="old('firstname')" required/>
        <x-form-error name="firstname" />
        <x-form-input name="middlename" id="middlename" placeholder="Middle Name" :value="old('middlename')" />
    </div>
    <div class="flex">
        <x-form-input name="lastname" id="lastname" placeholder="Last name" :value="old('lastname')" required/>
        <x-form-error name="lastname" />
        <x-form-input name="suffix" id="suffix" placeholder="Suffix" :value="old('suffix')" />
    </div>

    {{-- Division and Role --}}
    <div class="flex">
        <x-form-select name="division" required>
            <option class="hidden" value="" disabled selected>Division</option>
            <option value="PED" {{ old('division') == 'PED' ? 'selected' : '' }}>Planning and Evaluation Division</option>
            <option value="OD" {{ old('division') == 'OD' ? 'selected' : '' }}>Operations Division</option>
            <option value="AFD" {{ old('division') == 'AFD' ? 'selected' : '' }}v>Administrative and Finance Division</option>
            <option value="OED" {{ old('division') == 'OED' ? 'selected' : '' }}>Office of the Executive Director</option>
        </x-form-select>
        <x-form-error name="division" />

        <x-form-select name="role" required>
            <option class="hidden" value="" disabled selected>Role</option>
            <option value="Admin" {{ old('role') == 'Admin' ? 'selected' : '' }}>Admin</option>
            <option value="Head" {{ old('role') == 'Head' ? 'selected' : '' }}>Head</option>
            <option value="Officer II" {{ old('role') == 'Officer II' ? 'selected' : '' }}>Officer II</option>
            <option value="Officer" {{ old('role') == 'Officer' ? 'selected' : '' }}>Officer</option>
            <option value="Viewer" {{ old('role') == 'Viewer' ? 'selected' : '' }}>Viewer</option>
        </x-form-select>
        <x-form-error name="role" />
    </div>

    <x-form-input name="employee_id_no" id="employee_id_no" placeholder="Employee ID" :value="old('employee_id_no')" required/>
    <x-form-error name="employee_id_no" />

    <x-form-input name="email" id="email" placeholder="Email" :value="old('email')" required/>
    <x-form-error name="email" />

    <x-form-input name="password" id="password" type="password" placeholder="Password" required/>
    <x-form-error name="password" />

    <x-form-input name="password_confirmation" id="password_confirmation" type="password" placeholder="Confirm Password" required/>
    <x-form-error name="password_confirmation" />

    <div class="flex justify-between mt-2 mb-2">
        <div>
            <x-cancel-button onclick="closeModal('modalCreate'), resetForm('create_form')"> Discard </x-cancel-button>
        </div>
        <div>
            <x-form-submit-button> Create </x-form-submit-button>
        </div>
    </div>

</form>