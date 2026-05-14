@extends('admin.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="mb-4">
        <a href="{{ route('admin.room-types.index') }}" class="btn btn-sm btn-light border-0 rounded-pill px-3 mb-3">
            <i class="fa-solid fa-arrow-left me-2"></i> Back to Room Types
        </a>
        <h1 class="h3 mb-0 fw-bold text-dark">Create Room Type</h1>
        <p class="text-muted small mb-0">Define a new category of rooms for your hotel.</p>
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
        <form action="{{ route('admin.room-types.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-4">
                <div class="col-md-8">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">Room Type Name</label>
                            <input type="text" name="name" class="form-control bg-light border-0 py-2 px-3 shadow-none" placeholder="e.g. Deluxe Ocean Suite" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">Room Code</label>
                            <input type="text" name="code" class="form-control bg-light border-0 py-2 px-3 shadow-none" placeholder="e.g. DLX-OCN" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label small fw-bold text-muted">Hotel / Branch</label>
                            <select name="hotel_id" class="form-select bg-light border-0 py-2 px-3 shadow-none" required>
                                @foreach($hotels as $hotel)
                                <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold text-muted">Max Occupancy</label>
                            <input type="number" name="max_occupancy" class="form-control bg-light border-0 py-2 px-3 shadow-none" value="2" min="1" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold text-muted">Base Price ($)</label>
                            <input type="number" name="base_price" class="form-control bg-light border-0 py-2 px-3 shadow-none" placeholder="0.00" step="0.01" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold text-muted">Bed Type</label>
                            <select name="bed_type" class="form-select bg-light border-0 py-2 px-3 shadow-none">
                                <option value="King">King</option>
                                <option value="Queen">Queen</option>
                                <option value="Double">Double</option>
                                <option value="Twin">Twin</option>
                                <option value="Single">Single</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label small fw-bold text-muted">Description</label>
                            <textarea name="description" class="form-control bg-light border-0 py-2 px-3 shadow-none" rows="4" placeholder="Enter room type details..."></textarea>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-4 bg-light rounded-4 h-100">
                        <x-image-upload label="Room Images" name="images[]" id="imageInput" preview-id="imagePreview" :max-size="4 * 1024 * 1024" />


                        <hr class="my-4 opacity-10">

                        <label class="form-label small fw-bold text-muted d-block mb-3">Room Amenities</label>
                        <div class="row g-2">
                            @php
                            $commonAmenities = ['Wi-Fi', 'Air Conditioning', 'TV', 'Mini Bar', 'Coffee Maker', 'Safe', 'Hair Dryer', 'Ocean View', 'Balcony'];
                            @endphp
                            @foreach($commonAmenities as $amenity)
                            <div class="col-6">
                                <div class="form-check small">
                                    <input class="form-check-input" type="checkbox" name="amenities[]" value="{{ $amenity }}" id="amenity{{ $loop->index }}">
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
                <button type="submit" class="btn btn-primary px-5 rounded-pill shadow-sm">Save Room Type</button>
            </div>
        </form>
    </div>
</div>
@endsection