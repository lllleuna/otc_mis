<x-layout>
    <x-slot:vite>@vite('resources/js/modal.js')</x-slot:vite>
    <x-slot:title>User Details</x-slot:title>

    <x-container>
        {{-- Action and General info Container --}}
        <div class="flex ">
            <div class="bg-white rounded-lg shadow-xl p-8 w-1/3">
                <h4 class="text-xl text-gray-900 font-bold">Action</h4>
                <ul class="mt-2 text-gray-700">
                    <li class="flex border-y py-2">
                        <button href="/users/{{ $user->id }}/edit" onclick="openModal('modalEdit')" class="text-black-600 hover:text-blue-600">Edit General Info</button>
                    </li>
                    <li class="flex border-b py-2">
                        <button href="/users/{{ $user->id }}/edit" onclick="openModal('modalResetPass')" class="text-black-600 hover:text-blue-600">Reset Password</button>
                    </li>
                    <li class="flex border-b py-2">
                        <a href="" class="text-black-600 hover:text-red-600">Delete Account</a>
                    </li>
                </ul>
            </div>

            <div class="bg-white rounded-lg shadow-xl p-8 ml-4 w-2/3">
                <h4 class="text-xl text-gray-900 font-bold">General Info</h4>
                <ul class="mt-2 text-gray-700">
                    <li class="flex border-y py-2">
                        <span class="font-bold w-24">Full name:</span>
                        <span class="text-gray-700">{{ $user->firstname . " " . $user->middlename . " " . $user->lastname . " " . $user->suffix}}</span>
                    </li>
                    <li class="flex border-y py-2">
                        <span class="font-bold w-24">ID No:</span>
                        <span class="text-gray-700">{{ $user->employee_id_no }}</span>
                    </li>
                    <li class="flex border-b py-2">
                        <span class="font-bold w-24">Created at:</span>
                        <span class="text-gray-700">{{ $user->created_at }}</span>
                    </li>
                    <li class="flex border-b py-2">
                        <span class="font-bold w-24">Role:</span>
                        <span class="text-gray-700">{{ $user->role }}</span>
                    </li>
                    <li class="flex border-b py-2">
                        <span class="font-bold w-24">Division:</span>
                        <span class="text-gray-700">{{ $user->division }}</span>
                    </li>
                    <li class="flex border-b py-2">
                        <span class="font-bold w-24">Email:</span>
                        <span class="text-gray-700">{{ $user->email }}</span>
                        <span class="text-gray-700 text-sm mx-2">verified</span>
                    </li>
                    <li class="flex border-b py-2">
                        <span class="font-bold w-24">Status:</span>
                        <span class="text-gray-700">Enabled/Disabled</span>
                    </li>
                </ul>
            </div>
        </div>

        {{-- Activity Log Container --}}
        <div class="flex-1 bg-white rounded-lg shadow-xl mt-4 p-8">
            <h4 class="text-xl text-gray-900 font-bold">Activity log</h4>
            <div class="relative px-4">
                <div class="absolute h-full border border-dashed border-opacity-20 border-secondary">
                    
                </div>

                <!-- start::Timeline item -->
                <div class="flex items-center w-full my-6 -ml-1.5">
                    <div class="w-1/12 z-10">
                        <div class="w-3.5 h-3.5 bg-blue-600 rounded-full"></div>
                    </div>
                    <div class="w-11/12">
                        <p class="text-sm">Profile informations changed.</p>
                        <p class="text-xs text-gray-500">3 min ago</p>
                    </div>
                </div>
                <!-- end::Timeline item -->

                <!-- start::Timeline item -->
                <div class="flex items-center w-full my-6 -ml-1.5">
                    <div class="w-1/12 z-10">
                        <div class="w-3.5 h-3.5 bg-blue-600 rounded-full"></div>
                    </div>
                    <div class="w-11/12">
                        <p class="text-sm">
                            Connected with <a href="#" class="text-blue-600 font-bold">Colby Covington</a>.</p>
                        <p class="text-xs text-gray-500">15 min ago</p>
                    </div>
                </div>
                <!-- end::Timeline item -->

                <!-- start::Timeline item -->
                <div class="flex items-center w-full my-6 -ml-1.5">
                    <div class="w-1/12 z-10">
                        <div class="w-3.5 h-3.5 bg-blue-600 rounded-full"></div>
                    </div>
                    <div class="w-11/12">
                        <p class="text-sm">Invoice <a href="#" class="text-blue-600 font-bold">#4563</a> was created.</p>
                        <p class="text-xs text-gray-500">57 min ago</p>
                    </div>
                </div>
                <!-- end::Timeline item -->

                <!-- start::Timeline item -->
                <div class="flex items-center w-full my-6 -ml-1.5">
                    <div class="w-1/12 z-10">
                        <div class="w-3.5 h-3.5 bg-blue-600 rounded-full"></div>
                    </div>
                    <div class="w-11/12">
                        <p class="text-sm">
                            Message received from <a href="#" class="text-blue-600 font-bold">Cecilia Hendric</a>.</p>
                        <p class="text-xs text-gray-500">1 hour ago</p>
                    </div>
                </div>
                <!-- end::Timeline item -->

                <!-- start::Timeline item -->
                <div class="flex items-center w-full my-6 -ml-1.5">
                    <div class="w-1/12 z-10">
                        <div class="w-3.5 h-3.5 bg-blue-600 rounded-full"></div>
                    </div>
                    <div class="w-11/12">
                        <p class="text-sm">New order received <a href="#" class="text-blue-600 font-bold">#OR9653</a>.</p>
                        <p class="text-xs text-gray-500">2 hours ago</p>
                    </div>
                </div>
                <!-- end::Timeline item -->

                <!-- start::Timeline item -->
                <div class="flex items-center w-full my-6 -ml-1.5">
                    <div class="w-1/12 z-10">
                        <div class="w-3.5 h-3.5 bg-blue-600 rounded-full"></div>
                    </div>
                    <div class="w-11/12">
                        <p class="text-sm">
                            Message received from <a href="#" class="text-blue-600 font-bold">Jane Stillman</a>.</p>
                        <p class="text-xs text-gray-500">2 hours ago</p>
                    </div>
                </div>
                <!-- end::Timeline item -->
            </div>
        </div>
    </x-container>


<x-modal id="modalEdit"
class="{{ $errors->hasAny(['firstname', 'lastname', 'employee_id_no', 'email']) ? 'modal-error' : 'hidden' }}">
    <x-slot:closebtnSlot>
        <x-modal-close-button onclick="closeModal('modalEdit')" />
    </x-slot:closebtnSlot>
    @include('users.edit')
</x-modal>

<x-modal id="modalResetPass"
class="{{ $errors->hasAny(['password', 'password_confirmation']) ? 'modal-error' : 'hidden' }}">
    <x-slot:closebtnSlot>
        <x-modal-close-button onclick="closeModal('modalResetPass')" />
    </x-slot:closebtnSlot>
    @include('users.reset-password')
</x-modal>

</x-layout>