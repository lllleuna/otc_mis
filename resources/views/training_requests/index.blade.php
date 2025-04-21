<x-layout>
    <x-slot:vite></x-slot:vite>
    <x-slot:title>Training Requests</x-slot:title>

    <div class="container">
        <h1 class="mb-4">Training Requests</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Email</th>
                    <th>CDA Reg. No</th>
                    <th>Training Type</th>
                    <th>Status</th>
                    <th>Submitted At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($requests as $req)
                    <tr>
                        <td>{{ $req->email }}</td>
                        <td>{{ $req->cda_reg_no }}</td>
                        <td>{{ $req->training_type ?? "na"}}</td>
                        <td>{{ ucfirst($req->status) }}</td>
                        <td>{{ $req->created_at->format('Y-m-d') }}</td>
                        <td><a href="{{ route('training.show', $req->id) }}" class="btn btn-primary btn-sm">View</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $requests->links() }}    
    </div>

</x-layout>
