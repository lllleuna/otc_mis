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
            <option class="hidden" value="{{ $user->division }}" disabled selected>Division</option>
            <option value="PED" {{ old('division') == 'PED' ? 'selected' : '' }}>Planning and Evaluation Division</option>
            <option value="OD" {{ old('division') == 'OD' ? 'selected' : '' }}>Operations Division</option>
            <option value="AFD" {{ old('division') == 'AFD' ? 'selected' : '' }}v>Administrative and Finance Division</option>
            <option value="OED" {{ old('division') == 'OED' ? 'selected' : '' }}>Office of the Executive Director</option>
        </x-form-select>
        <x-form-select name="role" required>
            <option class="hidden" value="{{ $user->role }}" disabled selected>Role</option>
            <option value="Admin" {{ old('role') == 'Admin' ? 'selected' : '' }}>Admin</option>
            <option value="Approver" {{ old('role') == 'Approver' ? 'selected' : '' }}>Approver</option>
            <option value="Encoder" {{ old('role') == 'Encoder' ? 'selected' : '' }}>Encoder</option>
            <option value="Viewer" {{ old('role') == 'Viewer' ? 'selected' : '' }}>Viewer</option>
        </x-form-select>
    </div>

    <x-form-input name="employee_id_no" id="employee_id_no" placeholder="Employee ID" value="{{ $user->employee_id_no }}" required/>
    <x-form-error name="employee_id_no" />

    <x-form-input name="email" id="email" placeholder="Email" value="{{ $user->email }}" required/>
    <x-form-error name="email" />


    <div class="flex justify-between mt-2">
        <div>
            <x-cancel-button onclick="closeModal('modelConfirm')"> Discard </x-cancel-button>
        </div>
        <div>
            <x-form-submit-button> Save </x-form-submit-button>
        </div>
    </div>

</form>