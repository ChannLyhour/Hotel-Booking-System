@extends('admin.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="mb-4 d-flex justify-content-between align-items-start">
        <div>
            <a href="{{ route('admin.employees.index') }}" class="btn btn-sm btn-light border-0 rounded-pill px-3 mb-3">
                <i class="fa-solid fa-arrow-left me-2"></i> Back to Employee List
            </a>
            <h1 class="h3 mb-0 fw-bold text-dark">Employee Profile</h1>
            <p class="text-muted small mb-0">Detailed information for employee {{ $employee->name }}.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.employees.edit', $employee->id) }}" class="btn btn-primary px-4 rounded-pill shadow-sm">
                <i class="fa-solid fa-user-pen me-2"></i> Edit Profile
            </a>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 text-center p-4">
                <div class="avatar-xl mx-auto mb-3">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($employee->name) }}&background=10b981&color=fff&size=128" 
                         class="rounded-circle shadow-sm" style="width: 120px; height: 120px;">
                </div>
                <h4 class="fw-bold mb-1">{{ $employee->name }}</h4>
                <div class="badge bg-success-soft text-success px-3 py-1 rounded-pill mb-3">
                    {{ $employee->position }}
                </div>
                
                <div class="text-start mt-4">
                    <div class="mb-3">
                        <label class="small text-muted d-block mb-1">Employee ID</label>
                        <span class="text-dark fw-bold">EMP-{{ strtoupper(substr($employee->id, 0, 8)) }}</span>
                    </div>
                    <div class="mb-3">
                        <label class="small text-muted d-block mb-1">Email</label>
                        <span class="text-dark fw-medium">{{ $employee->email }}</span>
                    </div>
                    <div class="mb-3">
                        <label class="small text-muted d-block mb-1">Phone</label>
                        <span class="text-dark fw-medium">{{ $employee->phone ?? 'Not Provided' }}</span>
                    </div>
                    <div class="mb-0">
                        <label class="small text-muted d-block mb-1">Joined Date</label>
                        <span class="text-dark fw-medium">{{ $employee->created_at->format('F d, Y') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                <h5 class="fw-bold mb-4">Organizational Details</h5>
                <div class="row g-4">
                    <div class="col-sm-6">
                        <div class="p-3 bg-light rounded-3">
                            <div class="small text-muted mb-1">Department</div>
                            <div class="fw-bold text-dark">{{ $employee->department }}</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="p-3 bg-light rounded-3">
                            <div class="small text-muted mb-1">Primary Location</div>
                            <div class="fw-bold text-dark">{{ $employee->hotel->name ?? 'Headquarters' }}</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="p-3 bg-light rounded-3">
                            <div class="small text-muted mb-1">Status</div>
                            @if($employee->is_active)
                                <div class="fw-bold text-success"><i class="fa-solid fa-circle-check me-1"></i> Active Duty</div>
                            @else
                                <div class="fw-bold text-danger"><i class="fa-solid fa-circle-xmark me-1"></i> Off Duty / Inactive</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="p-3 bg-light rounded-3">
                            <div class="small text-muted mb-1">System Role</div>
                            <div class="fw-bold text-dark">{{ $employee->role->name ?? 'Employee' }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h5 class="fw-bold mb-4">Work Schedule (Default)</h5>
                <div class="d-flex flex-wrap gap-2">
                    @php
                        $days = [
                            'Monday' => '09:00 - 17:00',
                            'Tuesday' => '09:00 - 17:00',
                            'Wednesday' => '09:00 - 17:00',
                            'Thursday' => '09:00 - 17:00',
                            'Friday' => '09:00 - 17:00',
                            'Saturday' => 'Off',
                            'Sunday' => 'Off'
                        ];
                    @endphp
                    @foreach($days as $day => $time)
                    <div class="border rounded-3 p-2 text-center" style="min-width: 100px;">
                        <div class="small text-muted fw-bold">{{ substr($day, 0, 3) }}</div>
                        <div class="small {{ $time == 'Off' ? 'text-danger' : 'text-primary fw-medium' }}">{{ $time }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-success-soft { background-color: rgba(16, 185, 129, 0.1); }
</style>
@endsection
