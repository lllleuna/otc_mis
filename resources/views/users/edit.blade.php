<form action="/users/{{ $user->id }}" method="POST">
    @csrf
    @method('PATCH')    
    
    <x-form-title>Edit Information</x-form-title>

    {{-- Name --}}
    <div class="flex">
        <x-form-input name="firstname" id="firstname" placeholder="First name" value="{{ $user->firstname }}" required/>
        <x-form-error name="firstname" />
        <x-form-input name="middlename" id="middlename" placeholder="Middle Name" value="{{ $user->middlename }}" />
    </div>
    <div class="flex">
        <x-form-input name="lastname" id="lastname" placeholder="Last name" value="{{ $user->lastname }}" required/>
        <x-form-error name="lastname" />
        <x-form-input name="suffix" id="suffix" placeholder="Suffix" value="{{ $user->suffix }}" />
    </div>

    {{-- Division and Role --}}
    <div class="flex">
        <x-form-select name="division" required>
            <option class="hidden" disabled selected>Division</option>
            <option value="PED" {{ old('division', $user->division) == 'PED' ? 'selected' : '' }}>Planning and Evaluation Division</option>
            <option value="OD" {{ old('division', $user->division) == 'OD' ? 'selected' : '' }}>Operations Division</option>
            <option value="AFD" {{ old('division', $user->division) == 'AFD' ? 'selected' : '' }}>Administrative and Finance Division</option>
            <option value="OED" {{ old('division', $user->division) == 'OED' ? 'selected' : '' }}>Office of the Executive Director</option>
        </x-form-select>
        <x-form-select name="role" required>
            <option class="hidden" disabled selected>Role</option>
            <option value="Admin" {{ old('role', $user->role) == 'Admin' ? 'selected' : '' }}>Admin</option>
            <option value="Officer 2" {{ old('role', $user->role) == 'Officer 2' ? 'selected' : '' }}>Officer 2</option>
            <option value="Officer 1" {{ old('role', $user->role) == 'Officer 1' ? 'selected' : '' }}>Officer 1</option>
        </x-form-select>
    </div>

    <x-form-input name="employee_id_no" id="employee_id_no" placeholder="Employee ID" value="{{ $user->employee_id_no }}" required/>
    <x-form-error name="employee_id_no" />

    <x-form-input name="mobile_number" id="mobile_number" placeholder="Mobile Number" value="{{ $user->mobile_number }}" required pattern="^63[0-9]{10}$" maxlength="12" title="Mobile number must start with 63 and be exactly 12 digits."/>
    <x-form-error name="mobile_number" />

    <x-form-input name="email" id="email" placeholder="Email" value="{{ $user->email }}" required/>
    <x-form-error name="email" />


    <div class="flex justify-end mt-2">
        <div>
            <x-form-submit-button> Save Changes </x-form-submit-button>
        </div>
    </div>

</form>