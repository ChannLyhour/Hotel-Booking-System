<x-modal id="createHotelModal" title="Add New Hotel">
    <form action="{{ route('admin.hotels.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label small fw-bold">Hotel Name</label>
            <input type="text" name="name" class="form-control rounded-3" placeholder="Grand Royal Hotel" required>
        </div>
        <div class="mb-3">
            <label class="form-label small fw-bold">Address</label>
            <textarea name="address" class="form-control rounded-3" rows="3" placeholder="123 Luxury St, Beverly Hills" required></textarea>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label small fw-bold">City</label>
                <input type="text" name="city" class="form-control rounded-3" placeholder="Los Angeles" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label small fw-bold">Star Rating</label>
                <select name="star_rating" class="form-select rounded-3 shadow-none border">
                    <option value="1">1 Star</option>
                    <option value="2">2 Stars</option>
                    <option value="3">3 Stars</option>
                    <option value="4">4 Stars</option>
                    <option value="5" selected>5 Stars</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary w-100 rounded-3 py-2 mt-2">Create Hotel</button>
    </form>
</x-modal>
