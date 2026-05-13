@extends('admin.layouts.app')

@section('content')
<div class="dashboard-container">
    <!-- Header -->
    <div class="dashboard-header">
        <div class="header-title">
            <h1>Rooms <span class="text-muted fs-5 fw-normal ms-2">for June</span> <i class="fa-solid fa-chevron-down fs-6 text-muted ms-1"></i></h1>
        </div>
        <div class="header-actions">
            <div class="view-toggle">
                <button class="btn active"><i class="fa-solid fa-bars-staggered me-2"></i> Timeline</button>
                <button class="btn"><i class="fa-solid fa-table-cells-large me-2"></i> Tiles</button>
            </div>
        </div>
    </div>

    <!-- Action Bar -->
    <div class="action-bar">
        <div class="search-wrapper">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" class="form-control border-0 shadow-sm" placeholder="Search rooms, guests...">
        </div>
        <button class="btn btn-light bg-white border shadow-sm px-4 rounded-3 fw-semibold">
            <i class="fa-solid fa-sliders me-2"></i> Filter
        </button>
    </div>

    <!-- Timeline View -->
    <div class="timeline-view shadow-sm">
        <!-- Timeline Header -->
        <div class="timeline-header">
            <div class="room-col">Room</div>
            <div class="days-row">
                @php
                    $days = [
                        ['Mon', '14/06'], ['Tue', '15/06'], ['Wed', '16/06'],
                        ['Thu', '17/06'], ['Fri', '18/06'], ['Sat', '19/06'],
                        ['Sun', '20/06'], ['Mon', '21/06'], ['Tue', '22/06']
                    ];
                @endphp
                @foreach($days as $day)
                    <div class="day-item">
                        <div class="day-name">{{ $day[0] }}</div>
                        <div class="day-date">{{ $day[1] }}</div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Timeline Body -->
        <div class="timeline-body">
            <!-- Econom Rooms -->
            <div class="category-row">Econom Rooms</div>
            <div class="room-row">
                <div class="room-info">
                    <div class="room-name">Room 1 / floor 1</div>
                    <div class="room-type">Single Bed</div>
                </div>
                <div class="timeline-slots">
                    @for($i=0; $i<9; $i++) <div class="slot"></div> @endfor
                    <div class="booking-card status-checked-in" style="left: 22%; width: 33%;">
                        <img src="https://i.pravatar.cc/150?u=liza" alt="Avatar">
                        <div class="booking-info">
                            <span class="guest-name">Liza Davidson</span>
                            <span class="status">Checked In</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="room-row">
                <div class="room-info">
                    <div class="room-name">Room 2 / floor 1</div>
                    <div class="room-type">Double Bed</div>
                </div>
                <div class="timeline-slots">
                    @for($i=0; $i<9; $i++) <div class="slot"></div> @endfor
                    <div class="booking-card status-new" style="left: 44%; width: 22%;">
                        <img src="https://i.pravatar.cc/150?u=alex" alt="Avatar">
                        <div class="booking-info">
                            <span class="guest-name">Alex Hamilton</span>
                            <span class="status">New Booking</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Standard Rooms -->
            <div class="category-row">Standard Rooms</div>
            <div class="room-row">
                <div class="room-info">
                    <div class="room-name">Room 3 / floor 1</div>
                    <div class="room-type">Deluxe Single</div>
                </div>
                <div class="timeline-slots">
                    @for($i=0; $i<9; $i++) <div class="slot"></div> @endfor
                    <div class="booking-card status-vip" style="left: 33%; width: 22%;">
                        <img src="https://i.pravatar.cc/150?u=ali" alt="Avatar">
                        <div class="booking-info">
                            <span class="guest-name">Ali Jackson</span>
                            <span class="status">Checked In</span>
                        </div>
                    </div>
                    <div class="booking-card status-new" style="left: 77%; width: 22%;">
                        <img src="https://i.pravatar.cc/150?u=olga" alt="Avatar">
                        <div class="booking-info">
                            <span class="guest-name">Olga Kramarenko</span>
                            <span class="status">New Booking</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="room-row">
                <div class="room-info">
                    <div class="room-name">Room 4 / floor 1</div>
                    <div class="room-type">Deluxe Double</div>
                </div>
                <div class="timeline-slots">
                    @for($i=0; $i<9; $i++) <div class="slot"></div> @endfor
                    <div class="booking-card status-pending" style="left: 55%; width: 22%;">
                        <img src="https://i.pravatar.cc/150?u=morgan" alt="Avatar">
                        <div class="booking-info">
                            <span class="guest-name">Morgan Free</span>
                            <span class="status">Pending</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="room-row">
                <div class="room-info">
                    <div class="room-name">Room 2 / floor 2</div>
                    <div class="room-type">Queen Suite</div>
                </div>
                <div class="timeline-slots">
                    @for($i=0; $i<9; $i++) <div class="slot"></div> @endfor
                    <div class="booking-card status-checked-in" style="left: 11%; width: 22%;">
                        <img src="https://i.pravatar.cc/150?u=alyona" alt="Avatar">
                        <div class="booking-info">
                            <span class="guest-name">Alyona Tregub</span>
                            <span class="status">Checked In</span>
                        </div>
                    </div>
                    <div class="booking-card status-checked-in" style="left: 66%; width: 22%;">
                        <img src="https://i.pravatar.cc/150?u=irina" alt="Avatar">
                        <div class="booking-info">
                            <span class="guest-name">Irina Blagod</span>
                            <span class="status">Checked In</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- VIP Rooms -->
            <div class="category-row">VIP Rooms</div>
            <div class="room-row">
                <div class="room-info">
                    <div class="room-name">Room 1 / floor 3</div>
                    <div class="room-type">Presidential Suite</div>
                </div>
                <div class="timeline-slots">
                    @for($i=0; $i<9; $i++) <div class="slot"></div> @endfor
                    <div class="booking-card status-vip" style="left: 55%; width: 33%;">
                        <img src="https://i.pravatar.cc/150?u=mike" alt="Avatar">
                        <div class="booking-info">
                            <span class="guest-name">Mike Joe</span>
                            <span class="status">Checked In</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
