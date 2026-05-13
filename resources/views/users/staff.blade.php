@extends('admin.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 fw-bold text-dark">Hotel Staff</h1>
            <p class="text-muted small mb-0">Operational staff, assignments, and scheduling.</p>
        </div>
        <button class="btn btn-primary px-4 rounded-pill shadow-sm">
            <i class="fa-solid fa-user-plus me-2"></i> Onboard Staff
        </button>
    </div>

    <x-card-table 
        title="Active Staff Directory" 
        :search="true" 
        :pagination="$staff">
        
        <x-slot:headers>
            <th class="ps-4">Staff Member</th>
            <th>Hotel / Dept.</th>
            <th>Position</th>
            <th>Status</th>
            <th class="text-end pe-4">Actions</th>
        </x-slot:headers>

        @forelse($staff as $member)
        <tr>
            <td class="ps-4">
                <div class="d-flex align-items-center">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($member->user->name) }}&background=6366f1&color=fff" 
                         class="rounded-circle me-3" style="width: 40px; height: 40px;">
                    <div>
                        <div class="fw-bold text-dark">{{ $member->user->name }}</div>
                        <div class="text-muted x-small">{{ $member->user->email }}</div>
                    </div>
                </div>
            </td>
            <td>
                <div class="text-dark small fw-medium">{{ $member->hotel->name }}</div>
                <div class="badge bg-light text-muted border-0 fw-normal" style="font-size: 0.7rem;">{{ $member->department }}</div>
            </td>
            <td>
                <span class="badge bg-indigo-soft text-indigo px-3 py-1 rounded-pill">
                    {{ $member->position }}
                </span>
            </td>
            <td>
                @if($member->is_active)
                    <span class="d-flex align-items-center text-success small fw-medium">
                        <span class="p-1 bg-success rounded-circle me-2"></span> Active
                    </span>
                @else
                    <span class="d-flex align-items-center text-danger small fw-medium">
                        <span class="p-1 bg-danger rounded-circle me-2"></span> Inactive
                    </span>
                @endif
            </td>
            <td class="text-end pe-4">
                <button class="btn btn-sm btn-light border px-2 shadow-none"><i class="fa-solid fa-pen-to-square"></i></button>
                <button class="btn btn-sm btn-light border px-2 shadow-none text-danger"><i class="fa-solid fa-trash"></i></button>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="text-center py-5 text-muted">No staff members found.</td>
        </tr>
        @endforelse
    </x-card-table>
</div>

<style>
    .bg-indigo-soft { background-color: rgba(99, 102, 241, 0.1); }
    .text-indigo { color: #6366f1; }
</style>
@endsection
