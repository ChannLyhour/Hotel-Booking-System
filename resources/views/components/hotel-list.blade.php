@props(['hotels'])

<x-card-table>
    <x-slot:headers>
        <th class="ps-4">Property Details</th>
        <th>Location</th>
        <th>Contact & Settings</th>
        <th>Status</th>
        <th class="text-end pe-4">Actions</th>
    </x-slot:headers>

    @forelse($hotels as $hotel)
    <tr>
        <td class="ps-4">
            <div class="d-flex align-items-center">
                <div class="bg-indigo-soft p-3 rounded-3 me-3 text-indigo">
                    <i class="fa-solid fa-building"></i>
                </div>
                <div>
                    <div class="fw-bold text-dark fs-6">{{ $hotel->name }}</div>
                    <div class="text-muted extra-small">ID: {{ substr($hotel->id, 0, 8) }}...</div>
                </div>
            </div>
        </td>
        <td>
            <div class="text-dark small fw-semibold">{{ $hotel->city }}, {{ $hotel->country }}</div>
            <div class="text-muted extra-small">{{ Str::limit($hotel->address, 40) }}</div>
        </td>
        <td>
            <div class="d-flex gap-2">
                <span class="badge bg-light text-dark fw-normal border"><i class="fa-solid fa-coins me-1"></i> {{ $hotel->currency_code }}</span>
                <span class="badge bg-light text-dark fw-normal border"><i class="fa-solid fa-globe me-1"></i> {{ $hotel->timezone }}</span>
            </div>
        </td>
        <td>
            @if($hotel->is_active)
                <span class="badge bg-success-soft text-success rounded-pill px-3 py-2"><i class="fa-solid fa-circle me-1 small"></i> Online</span>
            @else
                <span class="badge bg-danger-soft text-danger rounded-pill px-3 py-2"><i class="fa-solid fa-circle me-1 small"></i> Offline</span>
            @endif
        </td>
        <td class="text-end pe-4">
            <div class="d-flex justify-content-end gap-2">
                <button class="btn btn-light btn-sm rounded-3 px-3 border" data-bs-toggle="modal" data-bs-target="#editHotelModal{{ $loop->index }}">
                    <i class="fa-solid fa-pen-to-square me-1"></i> Edit
                </button>
                <form action="{{ route('admin.hotels.destroy', $hotel->id) }}" method="POST" onsubmit="return confirm('Delete this property?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-outline-danger btn-sm rounded-3 px-3">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </form>
            </div>
        </td>
    </tr>

    <!-- Edit Modal for each hotel -->
    <div class="modal fade" id="editHotelModal{{ $loop->index }}" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow rounded-4">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold">Edit Property: {{ $hotel->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body pt-3">
                    <form action="{{ route('admin.hotels.update', $hotel->id) }}" method="POST">
                        @csrf @method('PUT')
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label small fw-bold">Property Name</label>
                                <input type="text" name="name" class="form-control rounded-3" value="{{ $hotel->name }}" required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label small fw-bold">Address</label>
                                <input type="text" name="address" class="form-control rounded-3" value="{{ $hotel->address }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">City</label>
                                <input type="text" name="city" class="form-control rounded-3" value="{{ $hotel->city }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">Country</label>
                                <input type="text" name="country" class="form-control rounded-3" value="{{ $hotel->country }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">Currency (e.g. USD)</label>
                                <input type="text" name="currency_code" class="form-control rounded-3" value="{{ $hotel->currency_code }}" maxlength="3" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">Timezone</label>
                                <input type="text" name="timezone" class="form-control rounded-3" value="{{ $hotel->timezone }}" required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_active" value="1" {{ $hotel->is_active ? 'checked' : '' }}>
                                    <label class="form-check-label fw-bold small">Property is active and visible to public</label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-indigo w-100 rounded-3 py-2 mt-3">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @empty
    <tr>
        <td colspan="5" class="text-center py-5 text-muted">No properties found.</td>
    </tr>
    @endforelse
</x-card-table>

