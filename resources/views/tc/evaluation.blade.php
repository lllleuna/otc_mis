@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-md-12 bg-primary text-white p-3">
            <h3 class="mb-0">Transportation Cooperative Evaluation</h3>
            <div class="float-right">
                <span class="badge badge-light">Status: Pending</span>
                <button class="btn btn-sm btn-light ml-2">Edit Status</button>
            </div>
        </div>
    </div>

    <!-- Basic Information Card -->
    <div class="card shadow mb-4">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">
                <i class="fas fa-info-circle"></i> Basic Information
                <span class="float-right">Last Updated: 2023-11-15 14:30</span>
            </h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <p><strong>Cooperative Name:</strong><br>Sample Transport Coop</p>
                    <p><strong>Chairman:</strong><br>Juan Dela Cruz</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Address:</strong><br>123 Main Street, Manila</p>
                    <p><strong>Contact Number:</strong><br>0912-345-6789</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Total Members:</strong> 45</p>
                    <p><strong>Date Registered:</strong> 2023-01-15</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Documents Section -->
    <div class="row">
        <!-- Accreditation Requirements -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow">
                <div class="card-header bg-success text-white">
                    <i class="fas fa-file-certificate"></i> Accreditation Requirements
                </div>
                <div class="card-body">
                    <div class="document-item mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fas fa-file-pdf text-danger"></i>
                                <span class="ml-2">certificate.pdf</span>
                            </div>
                            <span class="badge badge-warning">Pending</span>
                        </div>
                        <small class="text-muted">Uploaded: 2023-11-10</small>
                    </div>
                    <!-- Add more documents as needed -->
                </div>
            </div>
        </div>

        <!-- Good Standing Certificate -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow">
                <div class="card-header bg-warning text-dark">
                    <i class="fas fa-star"></i> Certificate of Good Standing
                </div>
                <div class="card-body">
                    <div class="document-item mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fas fa-file-image text-primary"></i>
                                <span class="ml-2">goodstanding.jpg</span>
                            </div>
                            <span class="badge badge-success">Approved</span>
                        </div>
                        <small class="text-muted">Updated: 2023-11-12</small>
                        <img src="placeholder.jpg" class="img-thumbnail mt-2" style="max-height: 100px;">
                    </div>
                </div>
            </div>
        </div>

        <!-- Training Requirements -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow">
                <div class="card-header bg-danger text-white">
                    <i class="fas fa-users"></i> Training Requirements
                </div>
                <div class="card-body">
                    <div class="document-item mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fas fa-file-excel text-success"></i>
                                <span class="ml-2">training.xlsx</span>
                            </div>
                            <span class="badge badge-danger">Rejected</span>
                        </div>
                        <small class=" text-muted">Uploaded: 2023-11-05</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit History Section -->
    <div class="card shadow mb-4">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">
                <i class="fas fa-history"></i> Edit History
            </h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Action</th>
                        <th>User</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>2023-11-01</td>
                        <td>Updated contact number</td>
                        <td>Admin</td>
                    </tr>
                    <tr>
                        <td>2023-11-05</td>
                        <td>Uploaded training requirements</td>
                        <td>Juan Dela Cruz</td>
                    </tr>
                    <tr>
                        <td>2023-11-10</td>
                        <td>Uploaded accreditation certificate</td>
                        <td>Admin</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="row">
        <div class="col-md-12 text-right">
            <button class="btn btn-primary">Save Changes</button>
            <button class="btn btn-danger">Delete Record</button>
        </div>
    </div>
</div>
@endsection
