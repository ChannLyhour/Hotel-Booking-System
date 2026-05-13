@extends('admin.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 fw-bold text-dark">Roles & Permissions</h1>
            <p class="text-muted small mb-0">Define access levels and functional permissions for system users.</p>
        </div>
        <button class="btn btn-primary px-4 rounded-pill shadow-sm">
            <i class="fa-solid fa-shield-halved me-2"></i> Create New Role
        </button>
    </div>

    <div class="row g-4">
        @foreach($roles as $role)
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h5 class="fw-bold mb-1">{{ $role->name }}</h5>
                            <span class="badge bg-light text-muted border-0 fw-normal small">Slug: {{ $role->slug }}</span>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-light btn-sm rounded-circle shadow-none" data-bs-toggle="dropdown">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                                <li><a class="dropdown-item" href="#"><i class="fa-solid fa-pen me-2 small"></i> Edit Role</a></li>
                                <li><a class="dropdown-item text-danger" href="#"><i class="fa-solid fa-trash me-2 small"></i> Delete</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="text-muted small mb-2">Permissions Cache:</div>
                        <div class="d-flex flex-wrap gap-1">
                            @if($role->permissions_cache)
                                @foreach(array_slice($role->permissions_cache, 0, 5) as $perm)
                                    <span class="badge bg-primary-soft text-primary rounded-pill px-2 py-1" style="font-size: 0.7rem;">{{ $perm }}</span>
                                @endforeach
                                @if(count($role->permissions_cache) > 5)
                                    <span class="badge bg-light text-muted rounded-pill px-2 py-1" style="font-size: 0.7rem;">+{{ count($role->permissions_cache) - 5 }} more</span>
                                @endif
                            @else
                                <span class="text-muted italic small">No permissions assigned</span>
                            @endif
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-auto">
                        <div class="avatar-group d-flex">
                            <!-- Mock avatars for users in this role -->
                            <img src="https://i.pravatar.cc/150?u=1" class="rounded-circle border border-white" style="width: 24px; height: 24px; margin-left: -8px;">
                            <img src="https://i.pravatar.cc/150?u=2" class="rounded-circle border border-white" style="width: 24px; height: 24px; margin-left: -8px;">
                            <img src="https://i.pravatar.cc/150?u=3" class="rounded-circle border border-white" style="width: 24px; height: 24px; margin-left: -8px;">
                            <div class="rounded-circle bg-light border border-white d-flex align-items-center justify-content-center text-muted fw-bold" style="width: 24px; height: 24px; margin-left: -8px; font-size: 0.6rem;">+12</div>
                        </div>
                        <a href="#" class="btn btn-sm btn-outline-primary rounded-pill px-3">Manage</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 border-2 border-dashed d-flex align-items-center justify-content-center py-5" style="border-style: dashed !important; background-color: #f8f9fa;">
                <div class="text-center">
                    <div class="mb-3">
                        <i class="fa-solid fa-plus-circle fs-1 text-muted opacity-25"></i>
                    </div>
                    <h6 class="text-muted fw-bold">Add New Role</h6>
                    <p class="text-muted small px-4">Create custom access levels for your team.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5">
        <h5 class="fw-bold mb-4">Available Permissions</h5>
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">Permission Name</th>
                            <th>Guard</th>
                            <th>Description</th>
                            <th class="text-end pe-4">Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($permissions->take(10) as $permission)
                        <tr>
                            <td class="ps-4">
                                <code class="text-primary fw-bold">{{ $permission->resource }}:{{ $permission->action }}</code>
                            </td>
                            <td><span class="badge bg-light text-dark border fw-normal">System</span></td>
                            <td class="text-muted small">Allows {{ $permission->action }} on {{ $permission->resource }}</td>
                            <td class="text-end pe-4 small text-muted">{{ $permission->created_at->format('M d, Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
