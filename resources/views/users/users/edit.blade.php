@extends('admin.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="mb-4">
        <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-light border-0 rounded-pill px-3 mb-3">
            <i class="fa-solid fa-arrow-left me-2"></i> Back to Users
        </a>
        <h1 class="h3 mb-0 fw-bold text-dark">Edit User: {{ $user->name }}</h1>
        <p class="text-muted small mb-0">Update account details and permissions for this user.</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                    <h5 class="fw-bold mb-0">Update Account Information</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">Full Name</label>
                                <input type="text" name="name" class="form-control bg-light border-0 shadow-none py-2 px-3" value="{{ old('name', $user->name) }}" required>
                                @error('name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">Email Address</label>
                                <input type="email" name="email" class="form-control bg-light border-0 shadow-none py-2 px-3" value="{{ old('email', $user->email) }}" required>
                                @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">Select Role</label>
                                <select name="role_id" class="form-select bg-light border-0 shadow-none py-2 px-3" required>
                                    @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('role_id') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-12">
                                <hr class="my-2 border-light">
                                <div class="alert alert-info border-0 shadow-none py-2 px-3 rounded-3 mt-2">
                                    <i class="fa-solid fa-circle-info me-2 small"></i>
                                    <span class="x-small">Leave password fields empty if you don't want to change the current password.</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">New Password</label>
                                <input type="password" name="password" class="form-control bg-light border-0 shadow-none py-2 px-3" placeholder="••••••••">
                                @error('password') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">Confirm New Password</label>
                                <input type="password" name="password_confirmation" class="form-control bg-light border-0 shadow-none py-2 px-3" placeholder="••••••••">
                            </div>
                        </div>

                        <div class="mt-5 d-flex gap-2">
                            <button type="submit" class="btn btn-primary px-5 rounded-pill shadow-sm">Save Changes</button>
                            <a href="{{ route('admin.users.index') }}" class="btn btn-light px-4 rounded-pill">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .x-small {
        font-size: 0.75rem;
    }
</style>
@endsection