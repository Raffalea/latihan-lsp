<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Customer\ReservationController;
use App\Http\Controllers\Admin\ReservationController as AdminReservation;

Route::get('/', function () {
    return view('auth.login');
});

Route::resource('rooms', RoomController::class);

Route::get('/katalog', [ReservationController::class, 'index'])->name('katalog')->middleware(['auth']);

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/reservations', [AdminReservation::class, 'index'])->name('admin.reservations.index');
    Route::patch('/reservations/{id}/approve', [AdminReservation::class, 'approve'])->name('admin.reservations.approve');
    Route::patch('/reservations/{id}/reject', [AdminReservation::class, 'reject'])->name('admin.reservations.reject');
});

Route::get('/admin/report', [AdminReservation::class, 'report'])->name('admin.report');

Route::middleware(['auth'])->group(function () {

    // Route Katalog
    Route::get('/katalog', [ReservationController::class, 'index'])->name('katalog');

    // Route History (TAMBAHKAN INI)
    Route::get('/my-bookings', [ReservationController::class, 'history'])->name('customer.history');

    // Route Create & Store
    Route::get('/reservasi/create/{room_id}', [ReservationController::class, 'create'])->name('reservasi.create');
    Route::post('/reservasi/store', [ReservationController::class, 'store'])->name('reservasi.store');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/booking/{room_id}', [ReservationController::class, 'create'])->name('reservasi.create');
    Route::post('/booking', [ReservationController::class, 'store'])->name('reservasi.store');
});
require __DIR__.'/auth.php';
