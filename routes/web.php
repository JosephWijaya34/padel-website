<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExternalController;

Route::get('/', function () {
    return view('dashboard');
});

// Testing External API Routes
Route::prefix('external')->name('external.')->group(function () {
    // Courts Routes
    Route::get('/courts', [ExternalController::class, 'courtsIndex'])->name('courts.index');
    Route::get('/courts/{id}', [ExternalController::class, 'courtShow'])->name('courts.show');

    // Booking Hours Routes
    Route::get('/booking-hours', [ExternalController::class, 'bookingHoursIndex'])->name('booking-hours.index');
    Route::get('/booking-hours/{id}', [ExternalController::class, 'bookingHourShow'])->name('booking-hours.show');

    // Clips Routes (uncommented for testing)
    // Route::get('/clips/booking-hour/{bookingHourId}', [ExternalController::class, 'clipsByBookingHour'])->name('clips.by-booking-hour');
    // Route::get('/clips/court/{courtId}/clip/{clipId}', [ExternalController::class, 'clipByCourt'])->name('clips.by-court');
});
