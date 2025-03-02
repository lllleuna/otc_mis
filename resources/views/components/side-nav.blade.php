{{-- Accreditation Module --}}

<div x-data="{ open: false }" class="h-screen flex flex-col w-64 bg-gray-200 rounded-lg text-black-900 fixed shadow-lg">
    <!-- Header/Logo Area -->
    <div class="p-4 border-b border-gray-700">
        <h2 class="text-xl font-semibold">Application Status</h2>
    </div>

    <!-- Navigation Links -->
    <nav class="mt-4 flex-1 overflow-y-auto">
        @php
            $statuses = [
                'new' => 'New Applications',
                'evaluated' => 'In Evaluation',
                'waiting' => 'Waiting Approval',
                'approved' => 'Approved',
                'nmi' => 'Needs More Info',
                'rejected' => 'Rejected'
            ];
            
            // Get current status from query parameters or search
            $currentStatus = request()->query('status') ?? (request()->has('search') ? session('last_status', 'new') : 'new');
        @endphp
        
        @foreach ($statuses as $status => $label)
            <x-apply-side-nav-links 
                href="{{ route('accreditation.index', ['status' => $status, 'search' => request('search')]) }}" 
                :active="$currentStatus === $status">
                <div class="flex items-center">
                    @switch($status)
                        @case('new')
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            @break
                        @case('evaluated')
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            @break
                        @case('waiting')
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            @break
                        @case('approved')
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            @break
                        @case('nmi')
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            @break
                        @case('rejected')
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            @break
                    @endswitch
                    {{ $label }}
                </div>
            </x-apply-side-nav-links>
        @endforeach
    </nav>
    
    <!-- Footer of sidebar (optional) -->
    <div class="p-4 border-t border-gray-700 text-sm">
        <p>© {{ date('Y') }} Accreditation System</p>
    </div>
</div>
