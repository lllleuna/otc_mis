<x-header-tag>
    <x-form-field>
    
        <form action="/" method="POST">
            @csrf
            
            <x-form-title>Login</x-form-title>
    
            {{-- email --}}
            <x-form-label for="email">Email</x-form-label>
            <x-form-input name="email" id="email" required/>
            <x-form-error name="email" />
    
            {{-- password --}}
            <x-form-label for="password">Password</x-form-label>
            <x-form-input name="password" id="password" type="password" required/>
            <x-form-error name="password" />
        
            <x-form-submit-button> Login </x-form-submit-button>
    
        </form>
    
    </x-form-field>
</x-header-tag>