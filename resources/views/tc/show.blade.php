<x-layout>
    <x-slot:vite></x-slot:vite>
    <x-slot:title>Transport Cooperative</x-slot:title>
 
    <x-container>
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Transport Cooperative Details</h2>
                
        <div class="flex gap-4" x-data="{ tab: 'general' }">
            <!-- Sidebar Navigation -->
            <div class="w-64 bg-white rounded-lg shadow-lg p-4">
                <nav class="space-y-2">
                    <button @click="tab = 'general'" class="block w-full text-left px-4 py-2 text-sm rounded-md hover:bg-gray-200" :class="{ 'bg-blue-500 text-white': tab === 'general' }">
                        General Info
                    </button>
                    <button @click="tab = 'membership'" class="block w-full text-left px-4 py-2 text-sm rounded-md hover:bg-gray-200" :class="{ 'bg-blue-500 text-white': tab === 'membership' }">
                        Membership
                    </button>
                    <button @click="tab = 'employment'" class="block w-full text-left px-4 py-2 text-sm rounded-md hover:bg-gray-200" :class="{ 'bg-blue-500 text-white': tab === 'employment' }">
                        Employment
                    </button>
                    <button @click="tab = 'units'" class="block w-full text-left px-4 py-2 text-sm rounded-md hover:bg-gray-200" :class="{ 'bg-blue-500 text-white': tab === 'units' }">
                        Units
                    </button>
                    <button @click="tab = 'franchise'" class="block w-full text-left px-4 py-2 text-sm rounded-md hover:bg-gray-200" :class="{ 'bg-blue-500 text-white': tab === 'franchise' }">
                        Franchise
                    </button>
                </nav>
            </div>

            <!-- Main Content -->
            <div class="flex-1 bg-white rounded-lg shadow-lg p-6">
               
                <div>
                    <div x-show="tab === 'general'" class="p-4 bg-gray-50 rounded-lg"></div>
                    <div x-show="tab === 'membership'" class="p-4 bg-gray-50 rounded-lg">Membership details go here.</div>
                    <div x-show="tab === 'employment'" class="p-4 bg-gray-50 rounded-lg">Employment-related details are displayed here.</div>
                    <div x-show="tab === 'units'" class="p-4 bg-gray-50 rounded-lg">Details about the units owned by the cooperative.</div>
                    <div x-show="tab === 'franchise'" class="p-4 bg-gray-50 rounded-lg">Franchise-related information appears here.</div>
                </div>
            </div>
        </div>
    </x-container>
    <button onclick="window.history.back()" class="mb-4 px-4 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400">
        &larr; Back
    </button>
    
</x-layout>
