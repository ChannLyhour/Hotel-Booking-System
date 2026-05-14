@extends('admin.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="mb-4">
        <a href="{{ route('admin.employees.index') }}" class="btn btn-sm btn-light border-0 rounded-pill px-3 mb-3">
            <i class="fa-solid fa-arrow-left me-2"></i> Back to Employee List
        </a>
        <h1 class="h3 mb-0 fw-bold text-dark">Add New Employee</h1>
        <p class="text-muted small mb-0">Register a new employee into the system directory.</p>
    </div>

    <div class="card border-0 shadow-sm rounded-4 p-4">
        <form action="{{ route('admin.employees.store') }}" method="POST">
            @csrf
            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-muted">Full Name</label>
                    <input type="text" name="name" class="form-control bg-light border-0 py-2 px-3 shadow-none" placeholder="John Doe" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-muted">Email Address</label>
                    <input type="email" name="email" class="form-control bg-light border-0 py-2 px-3 shadow-none" placeholder="john.doe@company.com" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-muted">Phone Number</label>
                    <input type="text" name="phone" class="form-control bg-light border-0 py-2 px-3 shadow-none" placeholder="+1 234 567 890">
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-muted">Hotel / Branch</label>
                    <select name="hotel_id" class="form-select bg-light border-0 py-2 px-3 shadow-none">
                        <option value="">Select Location...</option>
                        @foreach($hotels as $hotel)
                            <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-muted">Department</label>
                    <select name="department" class="form-select bg-light border-0 py-2 px-3 shadow-none" required>
                        <option value="Housekeeping">Housekeeping</option>
                        <option value="Front Desk">Front Desk</option>
                        <option value="Maintenance">Maintenance</option>
                        <option value="Security">Security</option>
                        <option value="HR">HR</option>
                        <option value="Accounting">Accounting</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-muted">Position</label>
                    <input type="text" name="position" class="form-control bg-light border-0 py-2 px-3 shadow-none" placeholder="e.g. Senior Housekeeper" required>
                </div>
            </div>
            <div class="mt-5">
                <button type="submit" class="btn btn-primary px-5 rounded-pill shadow-sm">Save Employee</button>
            </div>
        </form>
    </div>
</div>
@endsection
