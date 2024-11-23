<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>OTC MIS</title>
</head>
<body>

    <x-form-field>

        <x-slot:bannerSlot>
            <div class="w-4/5 bg-blue-900 sm:w-1/3 rounded-lg my-2 p-2">
                <img class="m-1" src="{{ asset('images/OTC-UpdatedBannerLogo2.png') }}" alt="" >
            </div>
        </x-slot:bannerSlot>

        <form action="/" method="POST">
            @csrf
            
            <x-form-title>Login</x-form-title>
    
            {{-- email --}}
            <x-form-label for="email">Email</x-form-label>
            <x-form-input name="email" id="email" :value="old('email')" required/>
            <x-form-error name="email" />
    
            {{-- password --}}
            <x-form-label for="password">Password</x-form-label>
            <x-form-input name="password" id="password" type="password" required/>
            <x-form-error name="password" />
        
            <div class="flex justify-end">
                <x-form-submit-button> Login </x-form-submit-button>
            </div>
    
        </form>
    
    </x-form-field>
    
</body>
</html>