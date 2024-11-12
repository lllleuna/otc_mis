<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title}}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-full">
  <div class="min-h-full">
    <nav class="bg-blue-900">
      <div class="">
        <div class="flex h-16 items-center justify-between">
          <div class="flex items-center">
            <img class="h-14" src="{{ asset('images/OTC-UpdatedBannerLogo2.png') }}" alt="OTC Logo">
          </div>
          <div class="block">
            <div class="mr-6 flex items-center">
                <img class="h-6 mx-5" src="{{ asset('images/icons8-notification-96.png') }}" alt="notif">
                <img class="h-12" src="{{ asset('images/icons8-male-user-50.png') }}" alt="profile">
            </div>
          </div>
        </div>
        
      </div>
    </nav>
  
    <header class="bg-white shadow">
      <div class="m-auto w-fit items-center px-3 py-2">
        <x-nav-link href="/dashboard" :active="request()->is('dashboard')">Dashboard</x-nav-link>
        <x-nav-link href="/" :active="request()->is('users')">Manage Users</x-nav-link>
        <x-nav-link href="/" :active="request()->is('transportcoop')">Transport Cooperative</x-nav-link>
        <x-nav-link href="/" :active="request()->is('others')">Others </x-nav-link>
      </div>
    </header>
    <main>
      <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        {{-- Page Content --}}
        {{$slot}}
      </div>
    </main>
  </div>
</body>
</html>