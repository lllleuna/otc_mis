{{-- used in login page --}}

<div class="min-h-screen justify-items-center content-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
    {{ $bannerSlot }}
    <div class="bg-white dark:bg-gray-700 shadow rounded-lg p-6 w-4/5 sm:w-1/3">
        {{ $slot }}
    </div>
</div>