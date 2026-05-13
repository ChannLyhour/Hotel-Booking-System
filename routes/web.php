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
    
    Route::resource('amenities', HotelAmenityController::class);

    // User Management Routes
    Route::get('users/roles', [UserController::class, 'roles'])->name('users.roles');
    Route::get('users/roles/create', [UserController::class, 'createRole'])->name('users.roles.create');
    Route::get('users/roles/{role}/edit', [UserController::class, 'editRole'])->name('users.roles.edit');
    Route::post('users/roles', [UserController::class, 'storeRole'])->name('users.roles.store');
    Route::put('users/roles/{role}', [UserController::class, 'updateRole'])->name('users.roles.update');
    Route::delete('users/roles/{role}', [UserController::class, 'destroyRole'])->name('users.roles.destroy');

    Route::resource('users', UserController::class);
    Route::resource('guests', GuestController::class);
    Route::resource('staff', StaffController::class);
    Route::resource('employees', EmployeeController::class);
});
