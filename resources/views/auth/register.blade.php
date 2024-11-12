<x-header-tag>
<x-form-field>

    <form action="/register" method="POST">
        @csrf
        
        <x-form-title>Create Account</x-form-title>

        {{-- name --}}
        <x-form-input name="name" id="name" placeholder="Name" :value="old('name')" required/>
        <x-form-error name="name" />

        {{-- email --}}
        <x-form-input name="email" id="email" placeholder="Email" :value="old('email')" required/>
        <x-form-error name="email" />

        {{-- password --}}
        <x-form-input name="password" id="password" type="password" placeholder="Password" required/>
        <x-form-error name="password" />

        {{-- password confirmation --}}
        <x-form-input name="password_confirmation" id="password_confirmation" type="password" placeholder="Confirm Password" required/>
        <x-form-error name="password_confirmation" />
    
        <x-form-submit-button> Create </x-form-submit-button>

    </form>

</x-form-field>
</x-header-tag>