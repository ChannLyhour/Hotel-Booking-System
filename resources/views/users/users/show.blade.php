@extends('admin.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="mb-4">
        <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-light border-0 rounded-pill px-3 mb-3">
            <i class="fa-solid fa-arrow-left me-2"></i> Back to Users
        </a>
        <h1 class="h3 mb-0 fw-bold text-dark">User Profile: {{ $user->name }}</h1>
        <p class="text-muted small mb-0">Detailed information about this system user.</p>
    </div>

    <div class="row g-4">
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 text-center p-4">
                <div class="avatar-xl mx-auto mb-3">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random&size=128"
                        class="rounded-circle shadow-sm" style="width: 120px; height: 120px;">
                </div>
                <h4 class="fw-bold mb-1">{{ $user->name }}</h4>
                <div class="badge bg-primary-soft text-primary px-3 py-1 rounded-pill mb-3">
                    {{ $user->role->name ?? 'No Role' }}
                </div>
                <div class="text-muted small mb-4">
                    <i class="fa-solid fa-envelope me-1"></i> {{ $user->email }}
                </div>
                <div class="d-grid">
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary rounded-pill py-2">
                        <i class="fa-solid fa-user-pen me-2"></i> Edit Profile
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                <h5 class="fw-bold mb-4">Account Information</h5>
                <div class="row g-4">
                    <div class="col-sm-6">
                        <label class="small fw-bold text-muted d-block mb-1">Full Name</label>
                        <p class="text-dark fw-medium">{{ $user->name }}</p>
                    </div>
                    <div class="col-sm-6">
                        <label class="small fw-bold text-muted d-block mb-1">Email Address</label>
                        <p class="text-dark fw-medium">{{ $user->email }}</p>
                    </div>
                    <div class="col-sm-6">
                        <label class="small fw-bold text-muted d-block mb-1">Role</label>
                        <p class="text-dark fw-medium">{{ $user->role->name ?? 'None' }}</p>
                    </div>
                    <div class="col-sm-6">
                        <label class="small fw-bold text-muted d-block mb-1">Account Created</label>
                        <p class="text-dark fw-medium">{{ $user->created_at->format('M d, Y') }} ({{ $user->created_at->diffForHumans() }})</p>
                    </div>
                    <div class="col-sm-6">
                        <label class="small fw-bold text-muted d-block mb-1">Last Updated</label>
                        <p class="text-dark fw-medium">{{ $user->updated_at->diffForHumans() }}</p>
                    </div>
                </div>

                <hr class="my-4 border-light">

                <h5 class="fw-bold mb-3 text-muted" style="font-size: 0.9rem;">Permission Summary (Via Role)</h5>
                <div class="d-flex flex-wrap gap-2">
                    @if($user->role && $user->role->permissions_cache)
                    @foreach($user->role->permissions_cache as $perm)
                    <span class="badge bg-light text-dark border fw-normal py-2 px-3 rounded-pill">{{ $perm }}</span>
                    @endforeach
                    @else
                    <span class="text-muted italic small">No granular permissions assigned to this role.</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-primary-soft {
        background-color: rgba(13, 110, 253, 0.1);
    }
</style>
@endsection