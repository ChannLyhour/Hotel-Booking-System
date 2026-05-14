@extends('admin.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="mb-4">
        <a href="{{ route('admin.employees.index') }}" class="btn btn-sm btn-light border-0 rounded-pill px-3 mb-3">
            <i class="fa-solid fa-arrow-left me-2"></i> Back to Employee List
        </a>
        <h1 class="h3 mb-0 fw-bold text-dark">Edit Employee: {{ $employee->name }}</h1>
        <p class="text-muted small mb-0">Update employee information and department assignment.</p>
    </div>

    <div class="card border-0 shadow-sm rounded-4 p-4">
        <form action="{{ route('admin.employees.update', $employee->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-muted">Full Name</label>
                    <input type="text" name="name" class="form-control bg-light border-0 py-2 px-3 shadow-none" value="{{ old('name', $employee->name) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-muted">Email Address</label>
                    <input type="email" name="email" class="form-control bg-light border-0 py-2 px-3 shadow-none" value="{{ old('email', $employee->email) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-muted">Phone Number</label>
                    <input type="text" name="phone" class="form-control bg-light border-0 py-2 px-3 shadow-none" value="{{ old('phone', $employee->phone) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-muted">Hotel / Branch</label>
                    <select name="hotel_id" class="form-select bg-light border-0 py-2 px-3 shadow-none">
                        <option value="">Select Location...</option>
                        @foreach($hotels as $hotel)
                            <option value="{{ $hotel->id }}" {{ $employee->hotel_id == $hotel->id ? 'selected' : '' }}>{{ $hotel->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-muted">Department</label>
                    <select name="department" class="form-select bg-light border-0 py-2 px-3 shadow-none" required>
                        @foreach(['Housekeeping', 'Front Desk', 'Maintenance', 'Security', 'HR', 'Accounting'] as $dept)
                            <option value="{{ $dept }}" {{ $employee->department == $dept ? 'selected' : '' }}>{{ $dept }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-muted">Position</label>
                    <input type="text" name="position" class="form-control bg-light border-0 py-2 px-3 shadow-none" value="{{ old('position', $employee->position) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-muted">Account Status</label>
                    <div class="form-check form-switch mt-2">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1" {{ $employee->is_active ? 'checked' : '' }}>
                        <label class="form-check-label small text-muted ms-2">Active Employee</label>
                    </div>
                </div>
            </div>
            <div class="mt-5">
                <button type="submit" class="btn btn-primary px-5 rounded-pill shadow-sm">Update Employee</button>
            </div>
        </form>
    </div>
</div>
@endsection
