{{-- Accreditation Module --}}

<div x-data="{ open: false }" class="h-screen flex flex-col w-64 bg-gray-200 rounded-lg text-black-900 fixed shadow-lg">
    <!-- Header/Logo Area -->
    <div class="p-4 border-b border-gray-700">
        <h2 class="text-xl font-semibold">Application Status</h2>
    </div>

    <!-- Navigation Links -->
    <nav class="mt-4 flex-1 overflow-y-auto">
        @php
            $head_statuses = [
                'evaluated' => 'For Approval',
                'approved' => 'Approved',
                'needs_info' => 'Needs More Info',
                'rejected' => 'Rejected',
            ];

            // Get current status from query parameters or search
            $currentStatus =
                request()->query('status') ?? (request()->has('search') ? session('last_status', 'new') : 'new');
        @endphp

        
        @can('admin-access')
            @foreach ($head_statuses as $status => $label)
                <x-apply-side-nav-links
                    href="{{ route('accreditation.approval.index', ['status' => $status, 'search' => request('search')]) }}"
                    :active="$currentStatus === $status">

                    <div class="flex items-center">
                        @switch($status)
                            @case('evaluated')
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            @break

                            @case('approved')
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            @break

                            @case('needs_info')
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            @break

                            @case('rejected')
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            @break
                        @endswitch
                        {{ $label }}
                    </div>

                </x-apply-side-nav-links>
            @endforeach
        @endcan
    </nav>
</div>
