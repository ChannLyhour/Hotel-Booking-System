@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 fw-bold text-dark">Staff Directory</h1>
            <p class="text-muted small mb-0">Manage hotel employees and assignments.</p>
        </div>
        <button class="btn btn-primary px-4 rounded-pill shadow-sm">
            <i class="fa-solid fa-user-tie me-2"></i> Add Staff
        </button>
    </div>

    @php $staffMembers = \App\Models\Staff::with(['user', 'hotel'])->get(); @endphp

    <x-card-table>
        <x-slot:headers>
            <th class="ps-4">Employee</th>
            <th>Department</th>
            <th>Position</th>
            <th>Hotel</th>
            <th>Status</th>
            <th class="text-end pe-4">Actions</th>
        </x-slot:headers>

        @forelse($staffMembers as $staff)
        <tr>
            <td class="ps-4">
                <div class="d-flex align-items-center">
                    <img src="https://i.pravatar.cc/150?u={{ $staff->user->email }}" alt="Avatar" class="rounded-circle me-2" style="width: 32px; height: 32px;">
                    <div class="fw-bold text-dark">{{ $staff->user->name }}</div>
                </div>
            </td>
            <td><span class="small text-muted">{{ $staff->department }}</span></td>
            <td><span class="badge bg-light text-dark fw-medium border">{{ $staff->position }}</span></td>
            <td><span class="small">{{ $staff->hotel->name }}</span></td>
            <td>
                @if($staff->is_active)
                    <span class="badge bg-success-soft text-success rounded-pill px-3">Active</span>
                @else
                    <span class="badge bg-danger-soft text-danger rounded-pill px-3">On Leave</span>
                @endif
            </td>
            <td class="text-end pe-4">
                <button class="btn btn-light btn-sm rounded-circle shadow-none"><i class="fa-solid fa-ellipsis-vertical"></i></button>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center py-5 text-muted">No staff members found.</td>
        </tr>
        @endforelse
    </x-card-table>

</div>
@endsection
