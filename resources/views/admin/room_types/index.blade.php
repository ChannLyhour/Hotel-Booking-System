@extends('admin.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 fw-bold text-dark">Room Types</h1>
            <p class="text-muted small mb-0">Define and manage room categories, pricing, and amenities.</p>
        </div>
        <a href="{{ route('admin.room-types.create') }}" class="btn btn-primary px-4 rounded-pill shadow-sm">
            <i class="fa-solid fa-plus me-2"></i> Create Room Type
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success border-0 shadow-sm rounded-3 mb-4">
        <i class="fa-solid fa-check-circle me-2"></i> {{ session('success') }}
    </div>
    @endif

    <div class="row g-4">
        @forelse($roomTypes as $type)
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                <div class="position-relative">
                    @php
                    $firstImage = $type->images[0] ?? 'https://placehold.co/600x400?text=No+Image';
                    @endphp
                    <img src="{{ $firstImage }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="{{ $type->name }}">
                    <div class="position-absolute top-0 end-0 m-3">
                        <span class="badge {{ $type->is_active ? 'bg-success' : 'bg-danger' }} rounded-pill shadow-sm">
                            {{ $type->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <h5 class="card-title fw-bold mb-0 text-dark">{{ $type->name }}</h5>
                        <div class="text-primary fw-bold">${{ number_format($type->base_price_cents / 100, 2) }} <span class="text-muted small fw-normal">/night</span></div>
                    </div>
                    <div class="mb-3">
                        <span class="badge bg-light text-muted border px-2 py-1">{{ $type->code }}</span>
                        <span class="ms-2 small text-muted"><i class="fa-solid fa-user-group me-1"></i> Max {{ $type->max_occupancy }}</span>
                    </div>
                    <p class="card-text text-muted small mb-4 line-clamp-2">
                        {{ Str::limit($type->description, 100) }}
                    </p>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.room-types.show', $type->id) }}" class="btn btn-sm btn-light border flex-grow-1 rounded-pill">View Details</a>
                        <a href="{{ route('admin.room-types.edit', $type->id) }}" class="btn btn-sm btn-outline-primary rounded-pill"><i class="fa-solid fa-pen"></i></a>
                        <form action="{{ route('admin.room-types.destroy', $type->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill" onclick="return confirm('Delete this room type?')"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <i class="fa-solid fa-bed fs-1 text-muted opacity-25 mb-3"></i>
            <p class="text-muted">No room types found. Start by creating one.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>