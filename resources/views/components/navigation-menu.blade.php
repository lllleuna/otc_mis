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
                <template x-for="item in ['general', 'membership', 'employment', 'units', 'franchise']">
                    <button
                        @click="tab = item"
                        class="w-full px-4 py-2 text-left rounded-lg mb-1 text-sm transition-colors"
                        :class="tab === item ? 'bg-blue-50 text-blue-900 font-medium' : 'text-gray-600 hover:bg-gray-50'"
                        x-text="item.charAt(0).toUpperCase() + item.slice(1)">
                    </button>
                </template>
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
                <template x-for="item in ['finances', 'grantsdonations', 'loans', 'businesses']">
                    <button
                        @click="tab = item"
                        class="w-full px-4 py-2 text-left rounded-lg mb-1 text-sm transition-colors"
                        :class="tab === item ? 'bg-blue-50 text-blue-900 font-medium' : 'text-gray-600 hover:bg-gray-50'"
                        x-text="item.charAt(0).toUpperCase() + item.slice(1)">
                    </button>
                </template>
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
                <template x-for="item in ['trainingsseminars', 'scholarships', 'cetos', 'awards']">
                    <button
                        @click="tab = item"
                        class="w-full px-4 py-2 text-left rounded-lg mb-1 text-sm transition-colors"
                        :class="tab === item ? 'bg-blue-50 text-blue-900 font-medium' : 'text-gray-600 hover:bg-gray-50'"
                        x-text="item.charAt(0).toUpperCase() + item.slice(1)">
                    </button>
                </template>
            </div>
        </div>
    </nav>
</div>
