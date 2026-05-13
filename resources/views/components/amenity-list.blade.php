@props(['amenities'])

<x-card-table>
    <x-slot:headers>
        <th class="ps-4">Amenity Name</th>
        <th>Category</th>
        <th>Hotel</th>
        <th>Status</th>
        <th class="text-end pe-4">Actions</th>
    </x-slot:headers>

    @forelse($amenities as $amenity)
    <tr>
        <td class="ps-4">
            <div class="d-flex align-items-center">
                <div class="bg-indigo-soft p-2 rounded-3 me-3 text-indigo">
                    <i class="fa-solid fa-sparkles"></i>
                </div>
                <div class="fw-bold text-dark">{{ $amenity->name }}</div>
            </div>
        </td>
        <td><span class="badge bg-light text-dark fw-medium border">{{ $amenity->category }}</span></td>
        <td><span class="small text-muted">{{ $amenity->hotel->name }}</span></td>
        <td>
            @if($amenity->is_active)
                <span class="badge bg-success-soft text-success rounded-pill px-3">Active</span>
            @else
                <span class="badge bg-danger-soft text-danger rounded-pill px-3">Inactive</span>
            @endif
        </td>
        <td class="text-end pe-4">
            <button class="btn btn-light btn-sm rounded-circle shadow-none"><i class="fa-solid fa-ellipsis-vertical"></i></button>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="5" class="text-center py-5 text-muted">No amenities found.</td>
    </tr>
    @endforelse
</x-card-table>

