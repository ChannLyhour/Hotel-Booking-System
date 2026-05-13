<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Admin\HotelController;
use App\Http\Controllers\Admin\RoomTypeController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\GuestController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\HotelAmenityController;
use App\Http\Controllers\Admin\UserController;

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', fn() => redirect()->route('home'));

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    Route::resource('hotels', HotelController::class);
    Route::resource('room-types', RoomTypeController::class);
    Route::resource('rooms', RoomController::class);
    Route::post('rooms/{room}/status', [RoomController::class, 'updateStatus'])->name('rooms.status');
    
    Route::resource('bookings', BookingController::class);
    Route::post('bookings/{booking}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');
    
    Route::resource('guests', GuestController::class);
    Route::resource('staff', StaffController::class);
    Route::resource('amenities', HotelAmenityController::class);

    // User Management Routes
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/guests', [UserController::class, 'guests'])->name('users.guests');
    Route::get('users/staff', [UserController::class, 'staff'])->name('users.staff');
    Route::get('users/employees', [UserController::class, 'employees'])->name('users.employees');
    Route::get('users/roles', [UserController::class, 'roles'])->name('users.roles');
});
