@extends('admin.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="mb-4">
        <a href="{{ route('admin.guests.index') }}" class="btn btn-sm btn-light border-0 rounded-pill px-3 mb-3">

            <i class="fa-solid fa-arrow-left me-2"></i> Back to Guests
        </a>
        <h1 class="h3 mb-0 fw-bold text-dark">Register New Guest</h1>
        <p class="text-muted small mb-0">Add a new guest profile to the system.</p>
    </div>

    <div class="card border-0 shadow-sm rounded-4 p-4">
        <form action="{{ route('admin.guests.store') }}" method="POST">
            @csrf
            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-muted">First Name</label>
                    <input type="text" name="first_name" class="form-control bg-light border-0 py-2 px-3 shadow-none" placeholder="John" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-muted">Last Name</label>
                    <input type="text" name="last_name" class="form-control bg-light border-0 py-2 px-3 shadow-none" placeholder="Doe" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-muted">Email</label>
                    <input type="email" name="email" class="form-control bg-light border-0 py-2 px-3 shadow-none" placeholder="john@example.com" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-muted">Phone</label>
                    <input type="text" name="phone" class="form-control bg-light border-0 py-2 px-3 shadow-none" placeholder="+123456789" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-muted">Nationality</label>
                    <input type="text" name="nationality" class="form-control bg-light border-0 py-2 px-3 shadow-none" placeholder="American">
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-muted">Document Type</label>
                    <select name="id_document_type" class="form-select bg-light border-0 py-2 px-3 shadow-none">
                        <option value="Passport">Passport</option>
                        <option value="National ID">National ID</option>
                        <option value="Driver License">Driver License</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-muted">Document Number</label>
                    <input type="text" name="id_document_no" class="form-control bg-light border-0 py-2 px-3 shadow-none" placeholder="A12345678">
                </div>

                <div class="col-md-6">
                    <label class="form-label small fw-bold text-muted">VIP Tier</label>
                    <select name="vip_tier" class="form-select bg-light border-0 py-2 px-3 shadow-none">
                        <option value="Basic">Basic</option>
                        <option value="Silver">Silver</option>
                        <option value="Gold">Gold</option>
                    </select>
                </div>
            </div>
            <div class="mt-5">
                <button type="submit" class="btn btn-primary px-5 rounded-pill shadow-sm">Save Guest</button>
            </div>
        </form>
    </div>
</div>
@endsection