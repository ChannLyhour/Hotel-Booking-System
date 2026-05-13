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
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary px-4 rounded-pill shadow-sm">
                <i class="fa-solid fa-user-plus me-2"></i> Add New User
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success border-0 shadow-sm rounded-3 mb-4">
        <i class="fa-solid fa-check-circle me-2"></i> {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger border-0 shadow-sm rounded-3 mb-4">
        <i class="fa-solid fa-exclamation-circle me-2"></i> {{ session('error') }}
    </div>
    @endif

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
    </div>

    <x-card-table
        title="All System Users"
        :search="true"
        :filter="true"
        :pagination="$users">

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
                    <div class="avatar-sm me-3">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random&color=fff"
                            alt="{{ $user->name }}"
                            class="rounded-circle"
                            style="width: 40px; height: 40px;">
                    </div>
                    <div>
                        <div class="fw-bold text-dark">{{ $user->name }} @if($user->id === auth()->id()) <span class="badge bg-light text-muted fw-normal x-small ms-1">You</span> @endif</div>
                        <div class="text-muted x-small">{{ $user->email }}</div>
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
                <div class="text-muted x-small">{{ $user->created_at->diffForHumans() }}</div>
            </td>
            <td>
                <div class="form-check form-switch">
                    <input class="form-check-input shadow-none" type="checkbox" checked disabled>
                    <span class="ms-1 small text-muted">Active</span>
                </div>
            </td>
            <td class="text-end pe-4">
                <div class="dropdown">
                    <button class="btn btn-light btn-sm rounded-circle shadow-none" data-bs-toggle="dropdown">
                        <i class="fa-solid fa-ellipsis-vertical"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-3">
                        <li><a class="dropdown-item py-2" href="{{ route('admin.users.edit', $user->id) }}"><i class="fa-solid fa-pen-to-square me-2 text-info small"></i> Edit User</a></li>
                        @if($user->id !== auth()->id())
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="dropdown-item py-2 text-danger"><i class="fa-solid fa-trash-can me-2 small"></i> Delete</button>
                            </form>
                        </li>
                        @endif
                    </ul>
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="text-center py-5 text-muted">No users found.</td>
        </tr>
        @endforelse
    </x-card-table>
</div>

<script>
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!confirm('Are you sure you want to delete this user? This action cannot be undone.')) {
                e.preventDefault();
            }
        });
    });
</script>

<style>
    .bg-primary-soft {
        background-color: rgba(13, 110, 253, 0.1);
    }

    .x-small {
        font-size: 0.75rem;
    }
</style>
@endsection