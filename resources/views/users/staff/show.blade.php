@extends('admin.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="mb-4 d-flex justify-content-between align-items-start">
        <div>
            <a href="{{ route('admin.staff.index') }}" class="btn btn-sm btn-light border-0 rounded-pill px-3 mb-3">
                <i class="fa-solid fa-arrow-left me-2"></i> Back to Directory
            </a>
            <h1 class="h3 mb-0 fw-bold text-dark">Staff Profile: {{ $staff->name }}</h1>
            <p class="text-muted small mb-0">Professional profile and assignment details.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.staff.edit', $staff->id) }}" class="btn btn-primary px-4 rounded-pill shadow-sm">
                <i class="fa-solid fa-user-pen me-2"></i> Edit Profile
            </a>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 text-center p-4 h-100">
                <div class="avatar-xl mx-auto mb-3">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($staff->name) }}&background=6366f1&color=fff&size=128"
                        class="rounded-circle shadow-sm" style="width: 120px; height: 120px;">
                </div>
                <h4 class="fw-bold mb-1">{{ $staff->name }}</h4>
                <div class="badge bg-indigo-soft text-indigo px-3 py-1 rounded-pill mb-3">
                    {{ $staff->position }}
                </div>

                <div class="text-start mt-4">
                    <div class="mb-3">
                        <label class="small text-muted d-block mb-1">Email</label>
                        <span class="text-dark fw-medium">{{ $staff->email }}</span>
                    </div>
                    <div class="mb-3">
                        <label class="small text-muted d-block mb-1">Phone</label>
                        <span class="text-dark fw-medium">{{ $staff->phone ?? 'Not Provided' }}</span>
                    </div>
                    <div class="mb-3">
                        <label class="small text-muted d-block mb-1">Hotel Assignment</label>
                        <span class="text-dark fw-medium">{{ $staff->hotel->name ?? 'None' }}</span>
                    </div>
                    <div class="mb-0">
                        <label class="small text-muted d-block mb-1">Department</label>
                        <span class="text-dark fw-medium">{{ $staff->department }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                <h5 class="fw-bold mb-4">Account Status</h5>
                <div class="row g-4">
                    <div class="col-sm-6">
                        <div class="p-3 bg-light rounded-3">
                            <div class="small text-muted mb-1">System Role</div>
                            <div class="fw-bold text-dark">{{ $staff->role->name ?? 'Guest' }}</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="p-3 bg-light rounded-3">
                            <div class="small text-muted mb-1">Availability</div>
                            @if($staff->is_active)
                            <div class="fw-bold text-success"><i class="fa-solid fa-circle-check me-1"></i> Active</div>
                            @else
                            <div class="fw-bold text-danger"><i class="fa-solid fa-circle-xmark me-1"></i> Inactive</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h5 class="fw-bold mb-4">Work Schedule</h5>
                @if($staff->work_schedule)
                <div class="table-responsive">
                    <table class="table table-sm border-0 mb-0">
                        <thead>
                            <tr class="text-muted small">
                                <th>Day</th>
                                <th>Shift</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($staff->work_schedule as $day => $shift)
                            <tr>
                                <td class="fw-bold">{{ $day }}</td>
                                <td>{{ $shift }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center py-5 bg-light rounded-3">
                    <i class="fa-solid fa-clock text-muted opacity-25 fs-1 mb-2"></i>
                    <p class="text-muted mb-0">No work schedule has been defined yet.</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
    .bg-indigo-soft {
        background-color: rgba(99, 102, 241, 0.1);
    }

    .text-indigo {
        color: #6366f1;
    }
</style>
@endsection