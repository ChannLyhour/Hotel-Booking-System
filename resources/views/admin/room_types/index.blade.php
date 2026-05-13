@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 fw-bold text-dark">Room Types</h1>
            <p class="text-muted small mb-0">Define and manage different categories of rooms.</p>
        </div>
        <button class="btn btn-primary px-4 rounded-pill shadow-sm" data-bs-toggle="modal" data-bs-target="#createRoomTypeModal">
            <i class="fa-solid fa-plus me-2"></i> Add Type
        </button>
    </div>

<x-room-type-list :roomTypes="$roomTypes" />

<x-room-type-create-modal />
@endsection
