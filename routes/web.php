<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExternalController;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/court', function () {
    return view('cliplist');
});


// Testing External API Routes
// Route::prefix('external')->name('external.')->group(function () {
    // Courts Routes
    Route::get('/courts', [ExternalController::class, 'courtsIndex'])->name('courts.index');
    Route::get('/courts/{id}', [ExternalController::class, 'courtShow'])->name('courts.show');

    // Booking Hours Routes
    Route::get('/booking-hours', [ExternalController::class, 'bookingHoursIndex'])->name('booking-hours.index');
    Route::get('/booking-hours/{id}', [ExternalController::class, 'bookingHourShow'])->name('booking-hours.show');
    Route::get('/booking-hours/court/{courtId}', [ExternalController::class, 'bookingHoursByCourt'])->name('booking-hours.by-court');

    // Clips Routes
    Route::get('/clips/booking-hour/{bookingHourId}', [ExternalController::class, 'clipsByBookingHour'])->name('clips.by-booking-hour');
    Route::get('/clips/{clipId}/download', [ExternalController::class, 'redirectDownload'])->name('external.clips.download');
// });

