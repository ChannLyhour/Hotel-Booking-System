@extends('admin.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="mb-4 d-flex justify-content-between align-items-start">
        <div>
            <a href="{{ route('admin.room-types.index') }}" class="btn btn-sm btn-light border-0 rounded-pill px-3 mb-3">
                <i class="fa-solid fa-arrow-left me-2"></i> Back to Room Types
            </a>
            <h1 class="h3 mb-0 fw-bold text-dark">{{ $roomType->name }}</h1>
            <p class="text-muted small mb-0">Room Code: <span class="badge bg-light text-primary border">{{ $roomType->code }}</span> • {{ $roomType->hotel->name }}</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.room-types.edit', $roomType->id) }}" class="btn btn-outline-primary px-4 rounded-pill shadow-sm">
                <i class="fa-solid fa-pen-to-square me-2"></i> Edit Room Type
            </a>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <!-- Image Gallery -->
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                <div id="roomGallery" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @forelse($roomType->images ?? [] as $index => $image)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <img src="{{ $image }}" class="d-block w-100" style="height: 450px; object-fit: cover;" alt="Room Image {{ $index + 1 }}">
                        </div>
                        @empty
                        <div class="carousel-item active">
                            <img src="https://placehold.co/1200x600?text=No+Images+Available" class="d-block w-100" style="height: 450px; object-fit: cover;" alt="No Image">
                        </div>
                        @endforelse
                    </div>
                    @if(count($roomType->images ?? []) > 1)
                    <button class="carousel-control-prev" type="button" data-bs-target="#roomGallery" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#roomGallery" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                    @endif
                </div>
                <!-- Thumbnails -->
                @if(count($roomType->images ?? []) > 1)
                <div class="card-body bg-light py-3">
                    <div class="d-flex gap-2 overflow-auto pb-1">
                        @foreach($roomType->images as $index => $image)
                        <img src="{{ $image }}" class="rounded-3 cursor-pointer thumbnail-preview {{ $index == 0 ? 'active-thumbnail' : '' }}"
                            style="width: 80px; height: 60px; object-fit: cover;"
                            data-bs-target="#roomGallery" data-bs-slide-to="{{ $index }}">
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h5 class="fw-bold mb-4 text-dark">Description</h5>
                <p class="text-muted leading-relaxed">
                    {{ $roomType->description ?? 'No description provided for this room type.' }}
                </p>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                <h5 class="fw-bold mb-4 text-dark">Pricing & Capacity</h5>
                <div class="p-3 bg-light rounded-4 mb-3 text-center">
                    <div class="small text-muted mb-1">Base Rate</div>
                    <h3 class="fw-bold text-primary mb-0">${{ number_format($roomType->base_price_cents / 100, 2) }}</h3>
                    <div class="small text-muted">per night</div>
                </div>

                <div class="d-flex justify-content-between mb-3 pb-3 border-bottom">
                    <span class="text-muted"><i class="fa-solid fa-user-group me-2"></i> Max Occupancy</span>
                    <span class="fw-bold text-dark">{{ $roomType->max_occupancy }} Persons</span>
                </div>
                <div class="d-flex justify-content-between mb-3 pb-3 border-bottom">
                    <span class="text-muted"><i class="fa-solid fa-bed me-2"></i> Bed Type</span>
                    <span class="fw-bold text-dark">{{ $roomType->bed_type }}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span class="text-muted"><i class="fa-solid fa-toggle-on me-2"></i> Status</span>
                    <span class="badge {{ $roomType->is_active ? 'bg-success' : 'bg-danger' }} rounded-pill">
                        {{ $roomType->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h5 class="fw-bold mb-4 text-dark">Room Amenities</h5>
                <div class="d-flex flex-wrap gap-2">
                    @forelse($roomType->amenities ?? [] as $amenity)
                    <span class="badge bg-indigo-soft text-indigo px-3 py-2 rounded-pill fw-medium">
                        <i class="fa-solid fa-check me-1 small"></i> {{ $amenity }}
                    </span>
                    @empty
                    <p class="text-muted small mb-0">No amenities listed.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-indigo-soft {
        background-color: rgba(99, 102, 241, 0.1);
    }

    .text-indigo {
        color: #6366f1;
    }

    .leading-relaxed {
        line-height: 1.8;
    }

    .cursor-pointer {
        cursor: pointer;
    }

    .thumbnail-preview {
        opacity: 0.6;
        transition: all 0.2s;
        border: 2px solid transparent;
    }

    .thumbnail-preview:hover {
        opacity: 1;
    }

    .active-thumbnail {
        opacity: 1;
        border-color: #6366f1;
    }
</style>
@endsection