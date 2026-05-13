@props(['hotels' => \App\Models\Hotel::all()])

<x-modal id="createRoomTypeModal" title="New Room Type">
    <form action="{{ route('admin.room-types.store') }}" method="POST">
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
            <label class="form-label small fw-bold">Type Name</label>
            <input type="text" name="name" class="form-control rounded-3" placeholder="Deluxe Double" required>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label small fw-bold">Code</label>
                <input type="text" name="code" class="form-control rounded-3" placeholder="DD-01" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label small fw-bold">Max Occupancy</label>
                <input type="number" name="max_occupancy" class="form-control rounded-3" value="2" required>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label small fw-bold">Base Price ($)</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0">$</span>
                <input type="number" name="base_price_dollars" step="0.01" class="form-control rounded-end-3 border-start-0" placeholder="150.00" required>
            </div>
        </div>
        <button type="submit" class="btn btn-primary w-100 rounded-3 py-2 mt-2">Create Type</button>
    </form>
</x-modal>

