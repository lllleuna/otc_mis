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
                        <button href="/users/{{ $user->id }}/edit" onclick="openModal('modalEdit')"
                            class="text-black-600 hover:text-blue-600">Edit General Info</button>
                    </li>
                    <li class="flex border-b py-2">
                        <button href="/users/{{ $user->id }}/edit" onclick="openModal('modalResetPass')"
                            class="text-black-600 hover:text-blue-600">Reset Password</button>
                    </li>
                    <li class="flex border-b py-2">
                        <button onclick="openModal('modalDelete')" class="text-black-600 hover:text-red-600">Delete
                            Account</button>
                    </li>

                </ul>
            </div>

            <div class="bg-white rounded-lg shadow-xl p-8 ml-4 w-2/3">
                <h4 class="text-xl text-gray-900 font-bold">General Info</h4>
                <ul class="mt-2 text-gray-700">
                    <li class="flex border-y py-2">
                        <span class="font-bold w-24">Full name:</span>
                        <span
                            class="text-gray-700">{{ $user->firstname . ' ' . $user->middlename . ' ' . $user->lastname . ' ' . $user->suffix }}</span>
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
                        <span class="font-bold w-24">Mobile No:</span>
                        <span class="text-gray-700">{{ $user->mobile_number }}</span>
                        <span class="text-gray-700 text-sm mx-2">verified</span>
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

    <div id="modalDelete"
        class="fixed inset-0 flex items-center justify-center min-h-screen bg-gray-800 bg-opacity-50
    {{ $errors->deletePassword->any() ? '' : 'hidden' }}">
        <div class="bg-white p-6 rounded shadow-lg w-full max-w-sm mx-auto">
            <h2 class="text-lg font-semibold mb-4 text-center">Confirm Delete</h2>
            <p class="text-center">Enter your password to delete this account:</p>
            <form method="POST" action="{{ route('users.destroy', $user->id) }}" class="mt-4">
                @csrf
                @method('DELETE')
                <input type="password" name="password" class="border p-2 w-full mb-2" required
                    placeholder="Password">
                @if ($errors->deletePassword->has('password'))
                    <p class="text-red-500 text-sm">{{ $errors->deletePassword->first('password') }}</p>
                @endif
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeModal('modalDelete')"
                        class="px-4 py-2 bg-gray-300 rounded">Cancel</button>
                    <button type="submit" class="text-red-800 font-semibold">Delete</button>
                </div>
            </form>
        </div>
    </div>



    <script>
        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
        }

        window.addEventListener('DOMContentLoaded', () => {
            if (document.querySelector('#modalDelete') && !document.querySelector('#modalDelete').classList
                .contains('hidden')) {
                openModal('modalDelete');
            }
        });
    </script>


</x-layout>
@include('components.footer')
