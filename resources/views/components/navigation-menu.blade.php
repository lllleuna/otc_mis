
<div class="w-64 bg-white rounded-lg shadow-lg overflow-hidden">
    <div class="p-4 bg-blue-900 text-white text-center">
        <h2 class="font-semibold">Data Overview</h2>
    </div>
    <nav class="p-2">
        <!-- Operations Menu -->
        <div class="mb-2">
            <button @click="menus.operations = !menus.operations"
                class="w-full px-4 py-3 text-left rounded-lg flex items-center justify-between hover:bg-gray-50">
                <span class="font-medium text-gray-700">Operations</span>
                <svg xmlns="http://www.w3.org/2000/svg"
                    :class="menus.operations ? 'transform rotate-90' : ''"
                    class="w-5 h-5 transition-transform"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
            <div x-show="menus.operations" class="ml-4">
                @foreach(['general', 'membership', 'employment', 'units', 'franchise'] as $item)
                    <button
                        @click="tab = '{{ $item }}'"
                        class="w-full px-4 py-2 text-left rounded-lg mb-1 text-sm transition-colors"
                        :class="tab === '{{ $item }}' ? 'bg-blue-50 text-blue-900 font-medium' : 'text-gray-600 hover:bg-gray-50'">
                        {{ ucfirst($item) }}
                    </button>
                @endforeach
            </div>
        </div>

        <!-- Governance Menu -->
        <div class="mb-2">
            <button @click="menus.governance = !menus.governance"
                class="w-full px-4 py-3 text-left rounded-lg flex items-center justify-between hover:bg-gray-50">
                <span class="font-medium text-gray-700">Governance</span>
                <svg xmlns="http://www.w3.org/2000/svg"
                    :class="menus.governance ? 'transform rotate-90' : ''"
                    class="w-5 h-5 transition-transform"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
            <div x-show="menus.governance" class="ml-4">
                <button
                    @click="tab = 'governance'"
                    class="w-full px-4 py-2 text-left rounded-lg mb-1 text-sm transition-colors"
                    :class="tab === 'governance' ? 'bg-blue-50 text-blue-900 font-medium' : 'text-gray-600 hover:bg-gray-50'">
                    Officers & BOD
                </button>
            </div>
        </div>

        <!-- Financial Menu -->
        <div class="mb-2">
            <button @click="menus.financial = !menus.financial"
                class="w-full px-4 py-3 text-left rounded-lg flex items-center justify-between hover:bg-gray-50">
                <span class="font-medium text-gray-700">Financial</span>
                <svg xmlns="http://www.w3.org/2000/svg"
                    :class="menus.financial ? 'transform rotate-90' : ''"
                    class="w-5 h-5 transition-transform"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
            <div x-show="menus.financial" class="ml-4">
                @foreach(['finances', 'grantsdonations', 'loans', 'businesses'] as $item)
                    <button
                        @click="tab = '{{ $item }}'"
                        class="w-full px-4 py-2 text-left rounded-lg mb-1 text-sm transition-colors"
                        :class="tab === '{{ $item }}' ? 'bg-blue-50 text-blue-900 font-medium' : 'text-gray-600 hover:bg-gray-50'">
                        {{ $item === 'grantsdonations' ? 'Grants & Donations' : ucfirst($item) }}
                    </button>
                @endforeach
            </div>
        </div>

        <!-- Development Menu -->
        <div class="mb-2">
            <button @click="menus.development = !menus.development"
                class="w-full px-4 py-3 text-left rounded-lg flex items-center justify-between hover:bg-gray-50">
                <span class="font-medium text-gray-700">Development</span>
                <svg xmlns="http://www.w3.org/2000/svg"
                    :class="menus.development ? 'transform rotate-90' : ''"
                    class="w-5 h-5 transition-transform"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
            <div x-show="menus.development" class="ml-4">
                @foreach(['trainingsseminars', 'scholarships', 'cetos', 'awards'] as $item)
                    <button
                        @click="tab = '{{ $item }}'"
                        class="w-full px-4 py-2 text-left rounded-lg mb-1 text-sm transition-colors"
                        :class="tab === '{{ $item }}' ? 'bg-blue-50 text-blue-900 font-medium' : 'text-gray-600 hover:bg-gray-50'">
                        {{ $item === 'trainingsseminars' ? 'Trainings & Seminars' : ($item === 'cetos' ? 'CETOS' : ucfirst($item)) }}
                    </button>
                @endforeach
            </div>
        </div>
    </nav>
</div>

