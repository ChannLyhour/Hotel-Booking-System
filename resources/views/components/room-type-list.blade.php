@props(['roomTypes'])

<x-card-table :pagination="$roomTypes" :search="true">

    <x-slot:headers>
        <th class="ps-4">Type Name</th>
        <th>Occupancy</th>
        <th>Base Price</th>
        <th>Status</th>
        <th class="text-end pe-4">Actions</th>
    </x-slot:headers>

    @forelse($roomTypes as $type)
    <tr>
        <td class="ps-4">
            <div class="d-flex align-items-center">
                <div class="bg-primary-soft p-2 rounded-3 me-3 text-primary">
                    <i class="fa-solid fa-bed"></i>
                </div>
                <div>
                    <div class="fw-bold text-dark">{{ $type->name }}</div>
                    <div class="text-muted extra-small">{{ $type->code }}</div>
                </div>
            </div>
        </td>
        <td>
            <span class="text-dark"><i class="fa-solid fa-user-group me-1 text-muted"></i> {{ $type->max_occupancy }} persons</span>
        </td>
        <td><span class="fw-bold text-indigo">${{ number_format($type->base_price_cents / 100, 2) }}</span></td>
        <td>
            @if($type->is_active)
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
        <td colspan="5" class="text-center py-5 text-muted">No room types found.</td>
    </tr>
    @endforelse
</x-card-table>

