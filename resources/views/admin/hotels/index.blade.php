@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 fw-bold text-dark">Properties</h1>
            <p class="text-muted small mb-0">Manage your hotel locations and property-specific configurations.</p>
        </div>
        <button class="btn btn-primary px-4 rounded-pill shadow-sm" data-bs-toggle="modal" data-bs-target="#createHotelModal">
            <i class="fa-solid fa-plus me-2"></i> Add Property
        </button>
    </div>

    <!-- Stats Row -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
                <div class="d-flex align-items-center">
                    <div class="bg-primary-soft p-3 rounded-circle me-3 text-primary">
                        <i class="fa-solid fa-hotel fs-4"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Total Properties</div>
                        <div class="h4 fw-bold mb-0">{{ $hotels->count() }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
                <div class="d-flex align-items-center">
                    <div class="bg-success-soft p-3 rounded-circle me-3 text-success">
                        <i class="fa-solid fa-circle-check fs-4"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Active</div>
                        <div class="h4 fw-bold mb-0">{{ $hotels->where('is_active', true)->count() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<x-hotel-list :hotels="$hotels" />

<x-hotel-create-modal />
@endsection

@push('styles')
<style>
    .bg-indigo-soft { background-color: rgba(79, 70, 229, 0.1); }
    .text-indigo { color: #4f46e5; }
    .btn-indigo { background-color: #4f46e5; color: white; }
    .btn-indigo:hover { background-color: #4338ca; color: white; }
    .bg-primary-soft { background-color: rgba(13, 110, 253, 0.1); }
    .bg-success-soft { background-color: rgba(25, 135, 84, 0.1); }
    .bg-danger-soft { background-color: rgba(220, 53, 69, 0.1); }
    .extra-small { font-size: 0.7rem; }
</style>
@endpush
