@props(['hotels' => \App\Models\Hotel::all()])

<x-modal id="createAmenityModal" title="New Hotel Amenity">
    <form action="{{ route('admin.amenities.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label small fw-bold">Hotel</label>
            <select name="hotel_id" class="form-select rounded-3 shadow-none border" required>
                @foreach($hotels as $hotel)
                    <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label small fw-bold">Amenity Name</label>
            <input type="text" name="name" class="form-control rounded-3" placeholder="Free Wi-Fi" required>
        </div>
        <div class="mb-3">
            <label class="form-label small fw-bold">Category</label>
            <input type="text" name="category" class="form-control rounded-3" placeholder="Connectivity">
        </div>
        <button type="submit" class="btn btn-primary w-100 rounded-3 py-2 mt-2">Add Amenity</button>
    </form>
</x-modal>

