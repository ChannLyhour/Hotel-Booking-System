@extends('admin.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="mb-4">
        <a href="{{ route('admin.users.roles') }}" class="btn btn-sm btn-light border-0 rounded-pill px-3 mb-3">
            <i class="fa-solid fa-arrow-left me-2"></i> Back to Roles
        </a>
        <h1 class="h3 mb-0 fw-bold text-dark">Create New Role</h1>
        <p class="text-muted small mb-0">Configure a new access level with specific permissions.</p>
    </div>

    <form action="{{ route('admin.users.roles.store') }}" method="POST">
        @csrf
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 p-4">
                    <h5 class="fw-bold mb-4">Role Details</h5>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Role Name</label>
                        <input type="text" name="name" class="form-control bg-light border-0 shadow-none py-2 px-3" placeholder="e.g. Receptionist" required>
                        @error('name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted">Slug</label>
                        <input type="text" name="slug" class="form-control bg-light border-0 shadow-none py-2 px-3" placeholder="e.g. receptionist" required>
                        @error('slug') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 shadow-sm">
                            <i class="fa-solid fa-plus me-2"></i> Create Role
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="fw-bold mb-0">Assign Permissions</h5>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="selectAllPermissions">
                            <label class="form-check-label small fw-bold text-primary" for="selectAllPermissions" style="cursor: pointer;">
                                Select All
                            </label>
                        </div>
                    </div>
                    <div class="row g-3">
                        @php
                            $resources = ['users', 'bookings', 'rooms', 'hotels', 'amenities', 'staff', 'guests'];
                            $actions = ['view', 'create', 'update', 'delete', 'cancel'];
                        @endphp
                        @foreach($resources as $resource)
                        <div class="col-md-6 col-xl-4">
                            <div class="card bg-light border-0 rounded-3 p-3 h-100">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h6 class="fw-bold text-dark small mb-0 text-capitalize d-flex align-items-center">
                                        <i class="fa-solid fa-folder-open me-2 text-primary opacity-50"></i> {{ $resource }}
                                    </h6>
                                    <input class="form-check-input select-group" type="checkbox" data-target="{{ $resource }}" title="Select all in {{ $resource }}">
                                </div>
                                @foreach($actions as $action)
                                    <div class="form-check mb-2">
                                        <input class="form-check-input permission-checkbox" type="checkbox" name="permissions[]" value="{{ $resource }}:{{ $action }}" id="add_perm_{{ $resource }}_{{ $action }}" data-group="{{ $resource }}">
                                        <label class="form-check-label small" for="add_perm_{{ $resource }}_{{ $action }}">
                                            {{ ucfirst($action) }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectAll = document.getElementById('selectAllPermissions');
        const checkboxes = document.querySelectorAll('.permission-checkbox');
        const groupSelects = document.querySelectorAll('.select-group');

        // Main Select All
        selectAll.addEventListener('change', function() {
            checkboxes.forEach(cb => cb.checked = this.checked);
            groupSelects.forEach(gs => gs.checked = this.checked);
        });

        // Group Select All
        groupSelects.forEach(gs => {
            gs.addEventListener('change', function() {
                const target = this.getAttribute('data-target');
                document.querySelectorAll(`.permission-checkbox[data-group="${target}"]`).forEach(cb => {
                    cb.checked = this.checked;
                });
                updateMainSelectAll();
            });
        });

        // Individual Checkbox Change
        checkboxes.forEach(cb => {
            cb.addEventListener('change', function() {
                updateGroupSelectAll(this.getAttribute('data-group'));
                updateMainSelectAll();
            });
        });

        function updateGroupSelectAll(group) {
            const groupCbs = document.querySelectorAll(`.permission-checkbox[data-group="${group}"]`);
            const groupSelect = document.querySelector(`.select-group[data-target="${group}"]`);
            const allChecked = Array.from(groupCbs).every(cb => cb.checked);
            groupSelect.checked = allChecked;
        }

        function updateMainSelectAll() {
            const allChecked = Array.from(checkboxes).every(cb => cb.checked);
            selectAll.checked = allChecked;
        }
    });
</script>
@endsection
