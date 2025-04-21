<x-layout>
    <x-slot:vite></x-slot:vite>
    <x-slot:title>Training Requests</x-slot:title>
    <div class="container mx-auto py-6 px-4" x-data="{
        searchTerm: '',
        selectedType: '',
        
        filterTable() {
            const rows = document.querySelectorAll('tbody tr');
            rows.forEach(row => {
                const cdaRegNo = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                const trainingType = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
                
                const matchesSearch = cdaRegNo.includes(this.searchTerm.toLowerCase());
                const matchesType = this.selectedType === '' || trainingType === this.selectedType.toLowerCase();
                
                row.classList.toggle('hidden', !(matchesSearch && matchesType));
            });
        }
    }">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Training Requests</h1>
        
        <!-- Search and Filter Controls -->
        <div class="flex flex-col md:flex-row gap-4 mb-6">
            <div class="w-full md:w-1/3">
                <label for="cda_search" class="block text-sm font-medium text-gray-700 mb-1">Search by CDA Reg. No</label>
                <input 
                    type="text" 
                    id="cda_search" 
                    x-model="searchTerm" 
                    @input="filterTable()" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                    placeholder="Enter CDA Number">
            </div>
            
            <div class="w-full md:w-1/3">
                <label for="training_type" class="block text-sm font-medium text-gray-700 mb-1">Filter by Training Type</label>
                <select 
                    id="training_type" 
                    x-model="selectedType" 
                    @change="filterTable()" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                    <option value="">All Types</option>
                    <option value="online">Online</option>
                    <option value="in-person">In-person</option>
                    <option value="workshop">Workshop</option>
                    <option value="seminar">Seminar</option>
                    <option value="na">Not Assigned</option>
                </select>
            </div>
        </div>
        
        <!-- Table -->
        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">CDA Reg. No</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Training Type</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Submitted At</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($requests as $req)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $req->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $req->cda_reg_no }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $req->training_type ?? "na"}}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                @if($req->status == 'new')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Submitted
                                    </span>
                                @elseif($req->status == 'approved')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Approved
                                    </span>
                                @elseif($req->status == 'rejected')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        Rejected
                                    </span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                        {{ ucfirst($req->status) }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $req->created_at->format('Y-m-d') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('training.show', $req->id) }}" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-md text-sm px-4 py-2 focus:outline-none">
                                    View
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="mt-4">
            {{ $requests->links() }}
        </div>
    </div>
</x-layout>