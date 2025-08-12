<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ExternalApiClient;

class ExternalController extends Controller
{
    public function __construct(private ExternalApiClient $api) {}

    // COURTS
    public function courtsIndex()
    {
        try {
            $courts = $this->api->courts();
            return view('ext.courts-index', compact('courts'));
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to load courts');
        }
    }

    public function courtShow(string $id)
    {
        $court = $this->api->court($id);
        dd($court);
        abort_if(!$court, 404);
        return view('ext.court-show', compact('court'));
    }

    // BOOKING HOURS
    public function bookingHoursIndex()
    {
        $items = $this->api->bookingHours();
        return view('ext.booking-hours-index', ['bookingHours' => $items]);
    }

    public function bookingHourShow(string $id)
    {
        $bh = $this->api->bookingHour($id);
        abort_if(!$bh, 404);
        return view('ext.booking-hour-show', compact('bh'));
    }

    // CLIPS
    // public function clipsByBookingHour(string $bookingHourId)
    // {
    //     $clips = $this->api->clipsByBookingHour($bookingHourId);
    //     return view('ext.clips-by-bh', compact('clips', 'bookingHourId'));
    // }

    // public function clipByCourt(string $courtId, string $clipId)
    // {
    //     $clip = $this->api->clipByCourt($courtId, $clipId);
    //     abort_if(!$clip, 404);
    //     return view('ext.clip-by-court', compact('clip', 'courtId'));
    // }
}
