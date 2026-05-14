@extends('admin.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="mb-4">
        <a href="{{ route('admin.staff.index') }}" class="btn btn-sm btn-light border-0 rounded-pill px-3 mb-3">
            <i class="fa-solid fa-arrow-left me-2"></i> Back to Staff Directory
        </a>
        <h1 class="h3 mb-0 fw-bold text-dark">Onboard New Staff</h1>
        <p class="text-muted small mb-0">Create a new staff member account and assign them to a hotel.</p>
    </div>

    <div class="card border-0 shadow-sm rounded-4 p-4">
        <form action="{{ route('admin.staff.store') }}" method="POST">
            @csrf
            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-muted">Full Name</label>
                    <input type="text" name="name" class="form-control bg-light border-0 py-2 px-3 shadow-none" placeholder="John Doe" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-muted">Email Address</label>
                    <input type="email" name="email" class="form-control bg-light border-0 py-2 px-3 shadow-none" placeholder="john.doe@hotel.com" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-muted">Phone Number</label>
                    <input type="text" name="phone" class="form-control bg-light border-0 py-2 px-3 shadow-none" placeholder="+1 234 567 890">
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-muted">Hotel Assignment</label>
                    <select name="hotel_id" class="form-select bg-light border-0 py-2 px-3 shadow-none" required>
                        <option value="">Select Hotel...</option>
                        @foreach($hotels as $hotel)
                            <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-muted">Department</label>
                    <select name="department" class="form-select bg-light border-0 py-2 px-3 shadow-none" required>
                        <option value="Front Office">Front Office</option>
                        <option value="Housekeeping">Housekeeping</option>
                        <option value="Food & Beverage">Food & Beverage</option>
                        <option value="Maintenance">Maintenance</option>
                        <option value="Administration">Administration</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-muted">Position</label>
                    <input type="text" name="position" class="form-control bg-light border-0 py-2 px-3 shadow-none" placeholder="e.g. Receptionist" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-muted">Assigned Role</label>
                    <select name="role_id" class="form-select bg-light border-0 py-2 px-3 shadow-none" required>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mt-5">
                <button type="submit" class="btn btn-primary px-5 rounded-pill shadow-sm">Onboard Staff Member</button>
            </div>
        </form>
    </div>
</div>
@endsection
