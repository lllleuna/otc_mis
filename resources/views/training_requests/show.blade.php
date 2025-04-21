<x-layout>
    <x-slot:vite></x-slot:vite>
    <x-slot:title>Training Requests</x-slot:title>

    <div class="container">
        <h1 class="mb-4">Training Request Details</h1>

        <div class="card mb-4">
            <div class="card-body">
                <p><strong>Email:</strong> {{ $request->email }}</p>
                <p><strong>CDA Registration No:</strong> {{ $request->cda_reg_no }}</p>
                <p><strong>Submitted At:</strong> {{ $request->created_at->format('Y-m-d') }}</p>
                <p><strong>Letter of Intent:</strong>
                    <a href="{{ asset('shared/' . $request->letter_of_intent) }}" target="_blank">Download</a>
                </p>
                <p><strong>Reference No:</strong> {{ $request->reference_no }}</p>
                <p><strong>Status:</strong> {{ ucfirst($request->status) }}</p>
            </div>
        </div>

        <form method="POST" action="{{ route('training.update', $request->id) }}">
            @csrf
            <!-- Training Type Selection -->
            <div class="mb-3">
                <label for="training_type" class="form-label">Training Type</label>
                <select name="training_type" id="training_type" class="form-select" required>
                    <option value="">Select Type</option>
                    <option value="face-to-face" {{ $request->training_type == 'face-to-face' ? 'selected' : '' }}>
                        Face-to-Face</option>
                    <option value="online" {{ $request->training_type == 'online' ? 'selected' : '' }}>Online</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="training_date_time" class="form-label">Training Date & Time</label>
                <input type="datetime-local" name="training_date_time" class="form-control"
                    value="{{ $request->training_date_time ? \Carbon\Carbon::parse($request->training_date_time)->format('Y-m-d\TH:i') : '' }}"
                    required>
            </div>

            <!-- Meeting Link (conditionally shown) -->
            <div class="mb-3" id="meeting_link_group"
                style="display: {{ $request->training_type == 'online' ? 'block' : 'none' }};">
                <label for="meeting_link" class="form-label">Google Meeting Link (optional)</label>
                <input type="url" name="meeting_link" class="form-control" value="{{ $request->meeting_link }}">
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" class="form-select" required>
                    <option value="pending" {{ $request->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ $request->status == 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="rejected" {{ $request->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Update & Notify</button>
            <a href="{{ route('training.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const trainingTypeSelect = document.getElementById('training_type');
            const meetingLinkGroup = document.getElementById('meeting_link_group');

            function toggleMeetingLink() {
                if (trainingTypeSelect.value === 'online') {
                    meetingLinkGroup.style.display = 'block';
                } else {
                    meetingLinkGroup.style.display = 'none';
                }
            }

            trainingTypeSelect.addEventListener('change', toggleMeetingLink);
            toggleMeetingLink(); // initial check
        });
    </script>

</x-layout>
