@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 fw-bold text-dark">Hotel Amenities</h1>
            <p class="text-muted small mb-0">Manage services and features provided by your hotels.</p>
        </div>
        <button class="btn btn-primary px-4 rounded-pill shadow-sm" data-bs-toggle="modal" data-bs-target="#createAmenityModal">
            <i class="fa-solid fa-plus me-2"></i> Add Amenity
        </button>
    </div>

<x-amenity-list :amenities="$amenities" />

<x-amenity-create-modal />
@endsection

@push('styles')
<style>
    .bg-indigo-soft { background-color: rgba(79, 70, 229, 0.1); }
    .text-indigo { color: #4f46e5; }
    .bg-success-soft { background-color: rgba(16, 185, 129, 0.1); }
    .bg-danger-soft { background-color: rgba(239, 68, 68, 0.1); }
</style>
@endpush
