<x-layout>
    <x-slot:vite></x-slot:vite>
    <x-slot:title>Training Requests</x-slot:title>

    <div class="max-w-4xl mx-auto py-8 px-4">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Training Request Details</h1>

        <div class="bg-white rounded-2xl shadow p-6 mb-6">
            <div class="space-y-3 text-gray-700">
                <p><span class="font-semibold">Email:</span> {{ $request->email }}</p>
                <p><span class="font-semibold">CDA Registration No:</span> {{ $request->cda_reg_no }}</p>
                <p><span class="font-semibold">Submitted At:</span> {{ $request->created_at->format('Y-m-d') }}</p>
                <p>
                    <span class="font-semibold">Letter of Intent:</span>
                    <a href="{{ asset('shared/' . $request->letter_of_intent) }}" target="_blank" class="text-blue-600 hover:underline">
                        Download
                    </a>
                </p>
                <p><span class="font-semibold">Reference No:</span> {{ $request->reference_no }}</p>
                <p><span class="font-semibold">Status:</span> {{ ucfirst($request->status) }}</p>
            </div>
        </div>

        @php
            $isFinalized = in_array($request->status, ['approved', 'rejected']);
        @endphp

        <form method="POST" action="{{ route('training.update', $request->id) }}" class="bg-white rounded-2xl shadow p-6 space-y-6">
            @csrf

            <div>
                <label for="training_type" class="block font-medium mb-1">Training Type</label>
                <select name="training_type" id="training_type" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-indigo-200" {{ $isFinalized ? 'disabled' : '' }} required>
                    <option value="">Select Type</option>
                    <option value="face-to-face" {{ $request->training_type == 'face-to-face' ? 'selected' : '' }}>Face-to-Face</option>
                    <option value="online" {{ $request->training_type == 'online' ? 'selected' : '' }}>Online</option>
                </select>
            </div>

            <div>
                <label for="training_date_time" class="block font-medium mb-1">Training Date & Time</label>
                <input type="datetime-local" name="training_date_time" id="training_date_time"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-indigo-200"
                    value="{{ $request->training_date_time ? \Carbon\Carbon::parse($request->training_date_time)->format('Y-m-d\TH:i') : '' }}"
                    {{ $isFinalized ? 'disabled' : '' }} required>
            </div>

            <div id="meeting_link_group" style="display: {{ $request->training_type == 'online' ? 'block' : 'none' }};">
                <label for="meeting_link" class="block font-medium mb-1">Google Meeting Link</label>
                <input type="url" name="meeting_link" id="meeting_link"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-indigo-200"
                    value="{{ $request->meeting_link }}" {{ $isFinalized ? 'disabled' : '' }}>
            </div>

            <div>
                <label for="status" class="block font-medium mb-1">Status</label>
                <select name="status" id="status" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-indigo-200" {{ $isFinalized ? 'disabled' : '' }} required>
                    <option value="pending" {{ $request->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ $request->status == 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="rejected" {{ $request->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                @unless ($isFinalized)
                    <button type="submit" class="px-5 py-2 bg-green-600 text-white rounded-xl hover:bg-green-700 transition">
                        Update & Notify
                    </button>
                @endunless

                <a href="{{ route('training.index') }}" class="px-5 py-2 bg-gray-300 text-gray-800 rounded-xl hover:bg-gray-400 transition">
                    Back
                </a>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const trainingTypeSelect = document.getElementById('training_type');
            const meetingLinkGroup = document.getElementById('meeting_link_group');

            function toggleMeetingLink() {
                meetingLinkGroup.style.display = trainingTypeSelect.value === 'online' ? 'block' : 'none';
            }

            trainingTypeSelect.addEventListener('change', toggleMeetingLink);
            toggleMeetingLink();
        });
    </script>
</x-layout>
