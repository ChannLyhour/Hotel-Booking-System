@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 fw-bold text-dark">Rooms Management</h1>
            <p class="text-muted small mb-0">Monitor and manage individual room units.</p>
        </div>
        <button class="btn btn-primary px-4 rounded-pill shadow-sm" data-bs-toggle="modal" data-bs-target="#createRoomModal">
            <i class="fa-solid fa-plus me-2"></i> Add Room
        </button>
    </div>

    <x-card-table 
        title="All Rooms" 
        :search="true" 
        :filter="true"
    >
        <x-slot:headers>
            <th class="ps-4">Room Number</th>
            <th>Type</th>
            <th>Floor</th>
            <th>Status</th>
            <th>Cleanliness</th>
            <th class="text-end pe-4">Actions</th>
        </x-slot:headers>

        @foreach($roomTypes as $type)
            @foreach($type->rooms as $room)
            <tr>
                <td class="ps-4">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary-soft p-2 rounded-3 me-3 text-primary">
                            <i class="fa-solid fa-door-open"></i>
                        </div>
                        <div class="fw-bold text-dark">#{{ $room->number }}</div>
                    </div>
                </td>
                <td>
                    <span class="badge bg-indigo-soft text-indigo rounded-pill px-3">{{ $type->name }}</span>
                </td>
                <td><span class="text-muted small">Floor {{ $room->floor }}</span></td>
                <td>
                    @php
                        $statusClass = match($room->status) {
                            'available' => 'bg-success',
                            'occupied' => 'bg-danger',
                            'cleaning' => 'bg-warning',
                            'maintenance' => 'bg-dark',
                            default => 'bg-secondary'
                        };
                    @endphp
                    <span class="badge {{ $statusClass }} rounded-pill px-3">{{ ucfirst($room->status) }}</span>
                </td>
                <td>
                    <span class="badge bg-light text-muted fw-normal border">{{ ucfirst($room->cleanliness_status) }}</span>
                </td>
                <td class="text-end pe-4">
                    <div class="d-flex justify-content-end gap-2">
                        <button class="btn btn-light btn-sm rounded-circle shadow-none"><i class="fa-solid fa-pen-to-square"></i></button>
                        <button class="btn btn-light btn-sm rounded-circle shadow-none text-danger"><i class="fa-solid fa-trash"></i></button>
                    </div>
                </td>
            </tr>
            @endforeach
        @endforeach
    </x-card-table>

</div>

<!-- Add Room Modal Placeholder -->
<x-room-create-modal :roomTypes="$roomTypes" />
@endsection

@push('styles')
<style>
    .h-px { height: 1px; }
    .fs-7 { font-size: 0.85rem; }
    .hover-lift:hover { transform: translateY(-5px); transition: transform 0.2s ease; }
</style>
@endpush
