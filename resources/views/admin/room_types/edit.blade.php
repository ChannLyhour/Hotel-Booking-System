@extends('admin.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="mb-4">
        <a href="{{ route('admin.room-types.index') }}" class="btn btn-sm btn-light border-0 rounded-pill px-3 mb-3">
            <i class="fa-solid fa-arrow-left me-2"></i> Back to Room Types
        </a>
        <h1 class="h3 mb-0 fw-bold text-dark">Edit Room Type: {{ $roomType->name }}</h1>
        <p class="text-muted small mb-0">Update category details, pricing, and images.</p>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger border-0 shadow-sm rounded-3 mb-4">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4 p-4">
        <form action="{{ route('admin.room-types.update', $roomType->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row g-4">
                <div class="col-md-8">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">Room Type Name</label>
                            <input type="text" name="name" class="form-control bg-light border-0 py-2 px-3 shadow-none" value="{{ old('name', $roomType->name) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">Room Code</label>
                            <input type="text" name="code" class="form-control bg-light border-0 py-2 px-3 shadow-none" value="{{ old('code', $roomType->code) }}" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label small fw-bold text-muted">Hotel / Branch</label>
                            <select name="hotel_id" class="form-select bg-light border-0 py-2 px-3 shadow-none" required>
                                @foreach($hotels as $hotel)
                                <option value="{{ $hotel->id }}" {{ $roomType->hotel_id == $hotel->id ? 'selected' : '' }}>{{ $hotel->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold text-muted">Max Occupancy</label>
                            <input type="number" name="max_occupancy" class="form-control bg-light border-0 py-2 px-3 shadow-none" value="{{ old('max_occupancy', $roomType->max_occupancy) }}" min="1" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold text-muted">Base Price ($)</label>
                            <input type="number" name="base_price" class="form-control bg-light border-0 py-2 px-3 shadow-none" value="{{ old('base_price', $roomType->base_price_cents / 100) }}" step="0.01" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold text-muted">Bed Type</label>
                            <select name="bed_type" class="form-select bg-light border-0 py-2 px-3 shadow-none">
                                @foreach(['King', 'Queen', 'Double', 'Twin', 'Single'] as $bed)
                                <option value="{{ $bed }}" {{ $roomType->bed_type == $bed ? 'selected' : '' }}>{{ $bed }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label small fw-bold text-muted">Description</label>
                            <textarea name="description" class="form-control bg-light border-0 py-2 px-3 shadow-none" rows="4">{{ old('description', $roomType->description) }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-4 bg-light rounded-4 h-100">
                        <label class="form-label small fw-bold text-muted d-block mb-3">Current Images</label>
                        <div class="row g-2 mb-4">
                            @foreach($roomType->images ?? [] as $image)
                            <div class="col-4">
                                <img src="{{ $image }}" class="img-fluid rounded-3 shadow-sm" style="height: 60px; width: 100%; object-fit: cover;">
                            </div>
                            @endforeach
                        </div>

                        <x-image-upload label="Upload New Images (Replaces existing)" name="images[]" id="imageInput" preview-id="imagePreview" />


                        <hr class="my-4 opacity-10">

                        <label class="form-label small fw-bold text-muted d-block mb-3">Room Amenities</label>
                        <div class="row g-2">
                            @php
                            $commonAmenities = ['Wi-Fi', 'Air Conditioning', 'TV', 'Mini Bar', 'Coffee Maker', 'Safe', 'Hair Dryer', 'Ocean View', 'Balcony'];
                            $currentAmenities = $roomType->amenities ?? [];
                            @endphp
                            @foreach($commonAmenities as $amenity)
                            <div class="col-6">
                                <div class="form-check small">
                                    <input class="form-check-input" type="checkbox" name="amenities[]" value="{{ $amenity }}" id="amenity{{ $loop->index }}" {{ in_array($amenity, $currentAmenities) ? 'checked' : '' }}>
                                    <label class="form-check-label text-muted" for="amenity{{ $loop->index }}">
                                        {{ $amenity }}
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-5 text-end">
                <button type="submit" class="btn btn-primary px-5 rounded-pill shadow-sm">Update Room Type</button>
            </div>
        </form>
    </div>
</div>
@endsection