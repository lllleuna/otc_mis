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