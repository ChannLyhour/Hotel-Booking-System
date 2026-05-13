@extends('admin.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 fw-bold text-dark">User Management</h1>
            <p class="text-muted small mb-0">Overview of all system users, roles, and status.</p>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-outline-primary px-4 rounded-pill shadow-sm">
                <i class="fa-solid fa-download me-2"></i> Export
            </button>
            <button class="btn btn-primary px-4 rounded-pill shadow-sm">
                <i class="fa-solid fa-user-plus me-2"></i> Add New User
            </button>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-primary text-white">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle bg-white bg-opacity-25 p-3 me-3">
                        <i class="fa-solid fa-users fs-4"></i>
                    </div>
                    <div>
                        <div class="opacity-75 small">Total Users</div>
                        <div class="h4 mb-0 fw-bold">{{ $users->total() }}</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- More stats cards could go here -->
    </div>

    <x-card-table
        title="All System Users"
        :search="true"
        :filter="true"
        :pagination="$users">

        <x-slot:headerActions>
            <div class="btn-group">
                <button type="button" class="btn btn-sm btn-light border dropdown-toggle shadow-none" data-bs-toggle="dropdown">
                    Bulk Actions
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                    <li><a class="dropdown-item" href="#"><i class="fa-solid fa-lock me-2 text-muted small"></i> Deactivate</a></li>
                    <li><a class="dropdown-item text-danger" href="#"><i class="fa-solid fa-trash me-2 small"></i> Delete</a></li>
                </ul>
            </div>
        </x-slot:headerActions>

        <x-slot:headers>
            <th class="ps-4">User Details</th>
            <th>Role</th>
            <th>Joined Date</th>
            <th>Status</th>
            <th class="text-end pe-4">Actions</th>
        </x-slot:headers>

        @forelse($users as $user)
        <tr>
            <td class="ps-4">
                <div class="d-flex align-items-center">
                    <div class="avatar-sm me-3 position-relative">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random&color=fff"
                            alt="{{ $user->name }}"
                            class="rounded-circle"
                            style="width: 40px; height: 40px; object-fit: cover;">
                        <span class="position-absolute bottom-0 end-0 p-1 bg-success border border-white rounded-circle" style="width: 10px; height: 10px;"></span>
                    </div>
                    <div>
                        <div class="fw-bold text-dark">{{ $user->name }}</div>
                        <div class="text-muted x-small" style="font-size: 0.75rem;">{{ $user->email }}</div>
                    </div>
                </div>
            </td>
            <td>
                <span class="badge bg-primary-soft text-primary px-3 py-1 rounded-pill fw-medium">
                    {{ $user->role->name ?? 'No Role' }}
                </span>
            </td>
            <td>
                <div class="text-dark small fw-medium">{{ $user->created_at->format('M d, Y') }}</div>
                <div class="text-muted x-small" style="font-size: 0.75rem;">{{ $user->created_at->diffForHumans() }}</div>
            </td>
            <td>
                <div class="form-check form-switch">
                    <input class="form-check-input shadow-none" type="checkbox" checked>
                    <span class="ms-1 small text-muted">Active</span>
                </div>
            </td>
            <td class="text-end pe-4">
                <div class="dropdown">
                    <button class="btn btn-light btn-sm rounded-circle shadow-none p-0" style="width: 32px; height: 32px;" data-bs-toggle="dropdown">
                        <i class="fa-solid fa-ellipsis-vertical text-muted"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-3 overflow-hidden">
                        <li><a class="dropdown-item py-2" href="#"><i class="fa-solid fa-eye me-2 text-primary small"></i> View Profile</a></li>
                        <li><a class="dropdown-item py-2" href="#"><i class="fa-solid fa-pen-to-square me-2 text-info small"></i> Edit User</a></li>
                        <li>
                            <hr class="dropdown-divider my-1">
                        </li>
                        <li><a class="dropdown-item py-2 text-danger" href="#"><i class="fa-solid fa-trash-can me-2 small"></i> Delete</a></li>
                    </ul>
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="text-center py-5">
                <div class="mb-3">
                    <i class="fa-solid fa-users-slash fs-1 text-light"></i>
                </div>
                <h5 class="text-muted">No users found</h5>
                <p class="text-muted small">Try adjusting your filters or search terms.</p>
            </td>
        </tr>
        @endforelse
    </x-card-table>
</div>

<style>
    .bg-primary-soft {
        background-color: rgba(13, 110, 253, 0.1);
    }

    .x-small {
        font-size: 0.75rem;
    }

    .dropdown-item:hover {
        background-color: #f8f9fa;
    }

    .table> :not(caption)>*>* {
        border-bottom-color: #f1f3f5;
    }

    .card-table thead th {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #6c757d;
    }
</style>
@endsection