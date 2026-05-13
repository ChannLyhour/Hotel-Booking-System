@props(['roomTypes'])

<x-modal id="createRoomModal" title="Add New Room">
    <form action="{{ route('admin.rooms.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label small fw-bold">Room Type</label>
            <select name="room_type_id" class="form-select rounded-3 shadow-none border" required>
                @foreach($roomTypes as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="row">
            <div class="col-6 mb-3">
                <label class="form-label small fw-bold">Room Number</label>
                <input type="text" name="number" class="form-control rounded-3" placeholder="101" required>
            </div>
            <div class="col-6 mb-3">
                <label class="form-label small fw-bold">Floor</label>
                <input type="number" name="floor" class="form-control rounded-3" value="1" required>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label small fw-bold">Status</label>
            <select name="status" class="form-select rounded-3 shadow-none border" required>
                <option value="available">Available</option>
                <option value="cleaning">Cleaning</option>
                <option value="maintenance">Maintenance</option>
                <option value="occupied">Occupied</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary w-100 rounded-3 py-2 mt-2">Create Room</button>
    </form>
</x-modal>
