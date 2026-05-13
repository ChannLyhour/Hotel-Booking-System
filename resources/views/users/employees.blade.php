@extends('admin.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 fw-bold text-dark">Employee Management</h1>
            <p class="text-muted small mb-0">Manage regular employees and team distributions.</p>
        </div>
    </div>

    <div class="row g-4 mb-4">
        @php
            $departments = ['Housekeeping', 'Front Desk', 'Maintenance', 'Security'];
        @endphp
        @foreach($departments as $dept)
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 text-center p-4">
                <div class="avatar-lg bg-light rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                    <i class="fa-solid fa-building-user text-primary fs-4"></i>
                </div>
                <h6 class="fw-bold mb-1">{{ $dept }}</h6>
                <div class="text-muted x-small mb-3">Total: {{ rand(5, 20) }} Employees</div>
                <button class="btn btn-sm btn-light border-0 px-3 rounded-pill fw-medium">View Team</button>
            </div>
        </div>
        @endforeach
    </div>

    <x-card-table 
        title="Employee Directory" 
        :search="true" 
        :pagination="$employees">
        
        <x-slot:headers>
            <th class="ps-4">Employee</th>
            <th>Department</th>
            <th>Joined Date</th>
            <th>Schedule</th>
            <th class="text-end pe-4">Actions</th>
        </x-slot:headers>

        @forelse($employees as $employee)
        <tr>
            <td class="ps-4">
                <div class="d-flex align-items-center">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($employee->user->name) }}&background=10b981&color=fff" 
                         class="rounded-circle me-3" style="width: 40px; height: 40px;">
                    <div>
                        <div class="fw-bold text-dark">{{ $employee->user->name }}</div>
                        <div class="text-muted x-small">EMP-{{ strtoupper(substr($employee->id, 0, 8)) }}</div>
                    </div>
                </div>
            </td>
            <td><span class="badge bg-light text-dark fw-medium border">{{ $employee->department }}</span></td>
            <td><span class="small text-muted">{{ $employee->created_at->format('M d, Y') }}</span></td>
            <td>
                <div class="d-flex gap-1">
                    @php $days = ['M', 'T', 'W', 'T', 'F']; @endphp
                    @foreach($days as $day)
                        <span class="badge bg-primary-soft text-primary p-0 d-flex align-items-center justify-content-center rounded-circle" style="width: 20px; height: 20px; font-size: 0.6rem;">{{ $day }}</span>
                    @endforeach
                </div>
            </td>
            <td class="text-end pe-4">
                <button class="btn btn-link text-primary p-0 me-3 text-decoration-none small fw-bold">Manage</button>
                <button class="btn btn-sm btn-light rounded-circle shadow-none"><i class="fa-solid fa-ellipsis"></i></button>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="text-center py-5 text-muted">No employees found.</td>
        </tr>
        @endforelse
    </x-card-table>
</div>
@endsection
